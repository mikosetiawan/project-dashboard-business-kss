<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Menu;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Registrasi Gate secara dinamis untuk semua menu
        Menu::all()->each(function ($menu) {
            Gate::define("read {$menu->name}", function ($user) use ($menu) {
                return $user->can("read {$menu->name}");
            });

            // Tambahkan Gate lain untuk aksi lainnya
            Gate::define("create {$menu->name}", function ($user) use ($menu) {
                return $user->can("create {$menu->name}");
            });

            Gate::define("update {$menu->name}", function ($user) use ($menu) {
                return $user->can("update {$menu->name}");
            });

            Gate::define("delete {$menu->name}", function ($user) use ($menu) {
                return $user->can("delete {$menu->name}");
            });

            Gate::define("print {$menu->name}", function ($user) use ($menu) {
                return $user->can("print {$menu->name}");
            });
        });
    }
}