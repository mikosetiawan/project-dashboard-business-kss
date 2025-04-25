<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Services\AccurateHelperService;
use App\Services\AccurateInvoice;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // dd(Auth::user());
        // $this->authorize('read Dashboard');

        // echo 'dashboard';
        // die();

        $helper = new AccurateHelperService();
        $invoiceService = new AccurateInvoice();

        $isTokenExist = $helper->isAccessTokenExist();

        if (empty($isTokenExist)) { // jika belum pernah generate access token sama sekali
            $scope = config('accurate.scope');
            return $helper->ouath2Authorization($scope);
        }

        $accessToken = $isTokenExist['access_token'];

        $getDBSession = $helper->getDBSession($accessToken);

        if (isset($getDBSession['error'])) {
            echo '<h2>' . $getDBSession['error'] . '</h2>';
            die();
        }

        $xSessionId = $getDBSession['session_id'];
        $host = $getDBSession['accurate_host'];

        $getListInvoice = $invoiceService->getListInvoice($host, $accessToken, $xSessionId);

        if (isset($getListInvoice['error'])) {
            echo '<pre>';
            print_r('error when getting list invoice: ' . $getListInvoice['error']);
            die();
        }

        $totalInvoice = 0;

        foreach ($getListInvoice['d'] as $idxInvoice => $valInvoice) {
            $totalInvoice += $valInvoice['totalAmount'];
        }

        $menus = Menu::orderBy('order')->get();
        return view('pages.index', compact('menus', 'totalInvoice'));
    }

    public function show(Menu $menu)
    {
        $this->authorize("read {$menu->name}");
        return view('pages.show', compact('menu'));
    }
}
