@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('') }}assets/css/report.css">

    <div id="wrapper" class="w-100">
        @include('layouts.sidebar')
        <div id="content-wrapper" class="d-flex flex-column w-100">
            <div id="content" class="flex-grow-1">
                @include('layouts.topbar')
                <div class="container-fluid p-3 p-md-4">
                    <div
                        class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Report</li>
                            </ol>
                        </nav>
                        <a type="button" class="btn btn-warning bi bi-arrows-fullscreen mt-3 mt-md-0"
                            data-bs-toggle="modal" data-bs-target="#reportTableModal"> Show Screens
                        </a>
                    </div>

                    <div class="dashboard-container">
                        @include('components.reports.year-selector')
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="row g-3">
                                    <div class="col-lg-5 col-12">
                                        @include('components.reports.stats-cards')
                                    </div>
                                    <div class="col-lg-7 col-12">
                                        @include('components.reports.chart-container')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Table -->
                    <div class="modal fade" id="reportTableModal" data-bs-backdrop="static" tabindex="-1"
                        aria-labelledby="reportTableModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" style="max-width: 95vw; width: 100%;">
                            <div class="modal-content" style="height: 95vh;">
                                <div class="modal-header bg-dark text-white">
                                    <h5 class="modal-title fw-bold" id="reportTableModalLabel">Report Data</h5>
                                    <div class="ms-auto d-flex align-items-center">
                                        <button type="button" class="btn btn-light btn-sm me-2" id="fullscreenBtn">
                                            <i class="bi bi-arrows-fullscreen"></i>
                                        </button>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="modal-body p-0 d-flex flex-column" style="height: calc(100% - 60px);">
                                    <div class="p-3" id="monthSelectorContainer">
                                        <div class="row mb-3">
                                            <div class="col-md-3 col-12">
                                                <select name="month" id="monthSelect" class="form-select">
                                                    <option value="" disabled selected>- Pilih Bulan -</option>
                                                    <option value="januari">Januari</option>
                                                    <option value="februari">Februari</option>
                                                    <option value="maret">Maret</option>
                                                    <option value="april">April</option>
                                                    <option value="mei">Mei</option>
                                                    <option value="juni">Juni</option>
                                                    <option value="juli">Juli</option>
                                                    <option value="agustus">Agustus</option>
                                                    <option value="september">September</option>
                                                    <option value="oktober">Oktober</option>
                                                    <option value="november">November</option>
                                                    <option value="desember">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive flex-grow-1 m-0" style="overflow-y: auto;">
                                        <table class="table table-bordered table-striped table-hover m-0" id="reportTable">
                                            <thead class="table-dark position-sticky top-0">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Pekerjaan</th>
                                                    <th>Nama Customer</th>
                                                    <th>No. CO</th>
                                                    <th>Tanggal CO</th>
                                                    <th>No. DO</th>
                                                    <th>Tanggal DO</th>
                                                    <th>Nominal Invoice</th>
                                                    <th>Status Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBody">
                                                <!-- Data akan diisi melalui JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="p-3">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-center mb-0" id="pagination">
                                                <!-- Pagination akan diisi melalui JavaScript -->
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('components.logout')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="{{ asset('') }}assets/js/yearly-report.js"></script>

    <script>
        // Data sampel (bisa diganti dengan data dari backend)
        const reportData = [{
                no: 1,
                pekerjaan: "Sewa Kapal Alpine",
                customer: "PT. Salam",
                co: "CO.102301230",
                tgl_co: "12/01/2025",
                do: "DO.192737912",
                tgl_do: "23/01/2025",
                nominal: "Rp. 1.200.000,00",
                status: "Terkirim"
            },
            {
                no: 2,
                pekerjaan: "Pemeliharaan Mesin",
                customer: "CV. Maju Jaya",
                co: "CO.102301231",
                tgl_co: "15/02/2025",
                do: "DO.192737913",
                tgl_do: "25/02/2025",
                nominal: "Rp. 2.500.000,00",
                status: "Belum Terkirim"
            },
            {
                no: 3,
                pekerjaan: "Transportasi Barang",
                customer: "PT. Logistik Nusantara",
                co: "CO.102301232",
                tgl_co: "20/03/2025",
                do: "DO.192737914",
                tgl_do: "30/03/2025",
                nominal: "Rp. 3.750.000,00",
                status: "Terkirim"
            },
            {
                no: 4,
                pekerjaan: "Sewa Gudang",
                customer: "PT. Prima Solusi",
                co: "CO.102301233",
                tgl_co: "05/04/2025",
                do: "DO.192737915",
                tgl_do: "15/04/2025",
                nominal: "Rp. 1.800.000,00",
                status: "Dibatalkan"
            },
            {
                no: 5,
                pekerjaan: "Jasa Konsultasi",
                customer: "CV. Berkah Abadi",
                co: "CO.102301234",
                tgl_co: "10/05/2025",
                do: "DO.192737916",
                tgl_do: "20/05/2025",
                nominal: "Rp. 4.000.000,00",
                status: "Terkirim"
            },
            {
                no: 6,
                pekerjaan: "Pengiriman Kontainer",
                customer: "PT. Samudra Jaya",
                co: "CO.102301235",
                tgl_co: "15/06/2025",
                do: "DO.192737917",
                tgl_do: "25/06/2025",
                nominal: "Rp. 5.500.000,00",
                status: "Belum Terkirim"
            },
            {
                no: 7,
                pekerjaan: "Sewa Kapal Tanker",
                customer: "PT. Energi Laut",
                co: "CO.102301236",
                tgl_co: "20/07/2025",
                do: "DO.192737918",
                tgl_do: "30/07/2025",
                nominal: "Rp. 6.200.000,00",
                status: "Terkirim"
            },
            {
                no: 8,
                pekerjaan: "Pemeliharaan Kapal",
                customer: "CV. Lautan Sejahtera",
                co: "CO.102301237",
                tgl_co: "25/08/2025",
                do: "DO.192737919",
                tgl_do: "05/09/2025",
                nominal: "Rp. 2.300.000,00",
                status: "Terkirim"
            },
        ];

        const itemsPerPage = 5; // Jumlah item per halaman
        let currentPage = 1;
        let autoPaginationInterval = null;

        function renderTable(data, page) {
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const paginatedData = data.slice(start, end);

            const tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';

            paginatedData.forEach(item => {
                const row = `
                    <tr>
                        <td>${item.no}</td>
                        <td>${item.pekerjaan}</td>
                        <td>${item.customer}</td>
                        <td>${item.co}</td>
                        <td>${item.tgl_co}</td>
                        <td>${item.do}</td>
                        <td>${item.tgl_do}</td>
                        <td>${item.nominal}</td>
                        <td>${item.status}</td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        function renderPagination(data) {
            const totalPages = Math.ceil(data.length / itemsPerPage);
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            // Previous button
            pagination.innerHTML += `
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage - 1}); return false;">Previous</a>
                </li>
            `;

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                pagination.innerHTML += `
                    <li class="page-item ${currentPage === i ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>
                    </li>
                `;
            }

            // Next button
            pagination.innerHTML += `
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage + 1}); return false;">Next</a>
                </li>
            `;
        }

        function changePage(page) {
            const totalPages = Math.ceil(reportData.length / itemsPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderTable(reportData, currentPage);
                renderPagination(reportData);
            }
        }

        function startAutoPagination() {
            stopAutoPagination(); // Hentikan interval sebelumnya jika ada
            autoPaginationInterval = setInterval(() => {
                const totalPages = Math.ceil(reportData.length / itemsPerPage);
                currentPage = currentPage >= totalPages ? 1 : currentPage + 1;
                renderTable(reportData, currentPage);
                renderPagination(reportData);
            }, 5000); // 10 detik
        }

        function stopAutoPagination() {
            if (autoPaginationInterval) {
                clearInterval(autoPaginationInterval);
                autoPaginationInterval = null;
            }
        }

        // Fullscreen handling
        const modal = document.getElementById('reportTableModal');
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        const monthSelectorContainer = document.getElementById('monthSelectorContainer');
        const fullscreenIcon = fullscreenBtn.querySelector('i');
        const closeButton = modal.querySelector('.btn-close');
        const bsModal = new bootstrap.Modal(modal);

        fullscreenBtn.addEventListener('click', function() {
            if (!document.fullscreenElement) {
                modal.requestFullscreen().then(() => {
                    fullscreenIcon.classList.remove('bi-arrows-fullscreen');
                    fullscreenIcon.classList.add('bi-fullscreen-exit');
                    monthSelectorContainer.style.display = 'none';
                });
            } else {
                document.exitFullscreen().then(() => {
                    fullscreenIcon.classList.remove('bi-fullscreen-exit');
                    fullscreenIcon.classList.add('bi-arrows-fullscreen');
                    monthSelectorContainer.style.display = 'block';
                });
            }
        });

        document.addEventListener('fullscreenchange', function() {
            const modalDialog = document.querySelector('#reportTableModal .modal-dialog');
            if (document.fullscreenElement) {
                modalDialog.style.maxWidth = '100vw';
                modalDialog.style.height = '100vh';
                modalDialog.style.margin = '0';
            } else {
                modalDialog.style.maxWidth = '95vw';
                modalDialog.style.height = 'auto';
                modalDialog.style.margin = '1.75rem auto';
            }
        });

        closeButton.addEventListener('click', function() {
            if (document.fullscreenElement) {
                document.exitFullscreen().then(() => bsModal.hide());
            } else {
                bsModal.hide();
            }
        });

        // Initialize table and pagination when modal is shown
        modal.addEventListener('shown.bs.modal', function() {
            renderTable(reportData, currentPage);
            renderPagination(reportData);
            startAutoPagination(); // Mulai auto pagination saat modal dibuka
        });

        // Stop auto pagination when modal is hidden
        modal.addEventListener('hidden.bs.modal', function() {
            stopAutoPagination(); // Hentikan auto pagination saat modal ditutup
        });

        // Responsive table styling
        const style = document.createElement('style');
        style.textContent = `
            @media (max-width: 768px) {
                .table-responsive {
                    font-size: 0.8rem;
                }
                .table th, .table td {
                    padding: 0.5rem;
                }
                #wrapper, #content-wrapper {
                    min-width: 100%;
                }
            }
            .table-responsive {
                width: 100%;
            }
            .modal-content {
                width: 100%;
            }
        `;
        document.head.appendChild(style);
    </script>
@endsection
