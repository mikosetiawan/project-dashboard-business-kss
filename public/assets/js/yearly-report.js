/**
 * Yearly Report Dashboard
 * Handles the visualization of yearly financial data with interactive charts and tables
 */
document.addEventListener("DOMContentLoaded", function () {
    // Constants
    const MONTHS_SHORT = [
        "Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];
    const MONTHS_FULL = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    const CHART_COLORS = {
        revenue: "#4e73df",
        invoice: "#1cc88a",
        accrue: "#36b9cc",
    };

    // State variables
    let currentYear = "2025";
    let currentChartType = "bar";
    let yearlyChart;

    // Utility function to calculate totals from array
    const calculateTotal = (arr) => arr.reduce((sum, value) => sum + value, 0);

    // Data for multiple years (totals will be calculated dynamically)
    const yearlyData = {
        2025: {
            revenue: [10, 12, 9.5, 11.2, 13.5, 14.8, 12.5, 13.2, 15, 14.2, 13.8, 16.5],
            invoice: [8.5, 10.3, 8.2, 9.8, 11.7, 12.9, 10.8, 11.5, 13.1, 12.4, 12, 14.3],
            accrue: [7.2, 8.8, 7, 8.4, 10.1, 11.2, 9.3, 9.9, 11.3, 10.7, 10.4, 12.4],
            get totals() {
                return {
                    revenue: calculateTotal(this.revenue),
                    invoice: calculateTotal(this.invoice),
                    accrue: calculateTotal(this.accrue),
                };
            }
        },
        2024: {
            revenue: [9.5, 11.2, 8.8, 10.5, 12.8, 13.9, 11.8, 12.5, 14.2, 13.5, 13.0, 15.6],
            invoice: [8.0, 9.7, 7.7, 9.2, 11.1, 12.2, 10.2, 10.9, 12.4, 11.8, 11.4, 13.6],
            accrue: [6.8, 8.3, 6.6, 7.9, 9.6, 10.5, 8.8, 9.4, 10.7, 10.1, 9.8, 11.7],
            get totals() {
                return {
                    revenue: calculateTotal(this.revenue),
                    invoice: calculateTotal(this.invoice),
                    accrue: calculateTotal(this.accrue),
                };
            }
        },
        2023: {
            revenue: [8.7, 10.3, 8.0, 9.7, 11.8, 12.8, 10.9, 11.5, 13.1, 12.4, 12.0, 14.3],
            invoice: [7.3, 8.9, 7.0, 8.5, 10.2, 11.2, 9.4, 10.0, 11.4, 10.8, 10.5, 12.5],
            accrue: [6.2, 7.6, 6.0, 7.2, 8.8, 9.7, 8.1, 8.6, 9.8, 9.3, 9.0, 10.8],
            get totals() {
                return {
                    revenue: calculateTotal(this.revenue),
                    invoice: calculateTotal(this.invoice),
                    accrue: calculateTotal(this.accrue),
                };
            }
        },
        2022: {
            revenue: [7.9, 9.4, 7.3, 8.8, 10.8, 11.7, 9.9, 10.5, 12.0, 11.3, 11.0, 13.1],
            invoice: [6.7, 8.1, 6.4, 7.7, 9.3, 10.2, 8.6, 9.1, 10.4, 9.9, 9.6, 11.4],
            accrue: [5.7, 7.0, 5.5, 6.6, 8.0, 8.8, 7.4, 7.9, 9.0, 8.5, 8.3, 9.9],
            get totals() {
                return {
                    revenue: calculateTotal(this.revenue),
                    invoice: calculateTotal(this.invoice),
                    accrue: calculateTotal(this.accrue),
                };
            }
        },
        2021: {
            revenue: [7.2, 8.6, 6.7, 8.0, 9.9, 10.7, 9.0, 9.6, 11.0, 10.3, 10.0, 12.0],
            invoice: [6.1, 7.4, 5.8, 7.0, 8.5, 9.3, 7.8, 8.3, 9.5, 9.0, 8.7, 10.4],
            accrue: [5.2, 6.4, 5.0, 6.0, 7.3, 8.0, 6.7, 7.2, 8.2, 7.7, 7.5, 9.0],
            get totals() {
                return {
                    revenue: calculateTotal(this.revenue),
                    invoice: calculateTotal(this.invoice),
                    accrue: calculateTotal(this.accrue),
                };
            }
        },
    };

    // DOM Elements
    const elements = {
        yearlyChart: document.getElementById("yearlyChart"),
        tableBody: document.getElementById("comparisonTableBody"),
        revenueTotal: document.querySelectorAll("#revenue-total"),
        invoiceTotal: document.querySelectorAll("#invoice-total"),
        accrueTotal: document.querySelectorAll("#accrue-total"),
        yearLabels: document.querySelectorAll(".year-label"),
        toggleViewBtn: document.getElementById("toggleViewYearly"),
        chartView: document.getElementById("chartViewYearly"),
        tableView: document.getElementById("tableViewYearly"),
        chartTypeButtons: document.querySelectorAll('[data-chart-type][data-target="yearly"]'),
        yearPills: document.querySelectorAll(".year-pill"),
        yearDropdownToggle: document.getElementById("yearDropdownToggle"),
        yearDropdownMenu: document.getElementById("yearDropdownMenu"),
        yearSearchInput: document.getElementById("yearSearchInput"),
        yearDropdownItems: document.getElementById("yearDropdownItems"),
    };

    // Utility Functions
    const formatters = {
        currency: (value) => `Rp ${value.toFixed(1)}.000.000,-`,
        totalCurrency: (value) => `Rp ${value.toFixed(1)}.000.000,-`,
    };

    // Rest of your functions remain largely the same, but I'll update initializeChart for completeness
    function initializeChart() {
        if (!elements.yearlyChart) return;

        const ctx = elements.yearlyChart.getContext("2d");
        const config = createChartConfig();
        yearlyChart = new Chart(ctx, config);
    }

    function createChartConfig() {
        return {
            type: currentChartType,
            data: {
                labels: MONTHS_SHORT,
                datasets: [
                    {
                        label: "Revenue",
                        data: yearlyData[currentYear].revenue,
                        backgroundColor: CHART_COLORS.revenue,
                        borderColor: CHART_COLORS.revenue,
                        borderWidth: 2,
                    },
                    {
                        label: "Invoice",
                        data: yearlyData[currentYear].invoice,
                        backgroundColor: CHART_COLORS.invoice,
                        borderColor: CHART_COLORS.invoice,
                        borderWidth: 2,
                    },
                    {
                        label: "Accrue",
                        data: yearlyData[currentYear].accrue,
                        backgroundColor: CHART_COLORS.accrue,
                        borderColor: CHART_COLORS.accrue,
                        borderWidth: 2,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "top",
                        labels: {
                            boxWidth: 12,
                            usePointStyle: true,
                            pointStyle: "circle",
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let value = context.raw;
                                return `${context.dataset.label}: ${formatters.currency(value)}`;
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        grid: { display: false, drawBorder: false },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return `Rp ${value} Jt`;
                            },
                        },
                        grid: { color: "rgba(0, 0, 0, 0.05)", drawBorder: false },
                    },
                },
            },
        };
    }

    function updateTableData(year) {
        if (!elements.tableBody || !yearlyData[year]) return;

        elements.tableBody.innerHTML = "";

        const calculateDifference = (current, previous) => {
            const diff = current - previous;
            return diff !== 0
                ? `<span class="${diff > 0 ? "text-success" : "text-danger"}">(${diff > 0 ? "+" : ""}${diff.toFixed(1)})</span>`
                : "-";
        };

        const prevYear = (parseInt(year) - 1).toString();
        const hasPrevYear = yearlyData[prevYear];

        for (let i = 0; i < MONTHS_SHORT.length; i++) {
            const revenue = yearlyData[year].revenue[i];
            const invoice = yearlyData[year].invoice[i];
            const accrue = yearlyData[year].accrue[i];

            const prevRevenue = hasPrevYear ? yearlyData[prevYear].revenue[i] : null;
            const prevInvoice = hasPrevYear ? yearlyData[prevYear].invoice[i] : null;
            const prevAccrue = hasPrevYear ? yearlyData[prevYear].accrue[i] : null;

            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${MONTHS_FULL[i]}</td>
                <td class="revenue">${formatters.currency(revenue)} ${hasPrevYear ? calculateDifference(revenue, prevRevenue) : ""}</td>
                <td class="invoice">${formatters.currency(invoice)} ${hasPrevYear ? calculateDifference(invoice, prevInvoice) : ""}</td>
                <td class="accrue">${formatters.currency(accrue)} ${hasPrevYear ? calculateDifference(accrue, prevAccrue) : ""}</td>
                <td><button class="btn btn-sm btn-warning view-month-details" data-month="${i}" data-year="${year}">Detail</button></td>
            `;
            elements.tableBody.appendChild(row);
        }

        const detailButtons = elements.tableBody.querySelectorAll(".view-month-details");
        detailButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const month = this.dataset.month;
                const selectedYear = this.dataset.year;
                showMonthDetails(selectedYear, month);
            });
        });

        // if (!elements.tableBody.parentElement.querySelector("tfoot")) {
        //     const tfoot = document.createElement("tfoot");
        //     tfoot.innerHTML = `
        //         <tr class="table-info">
        //             <td>Total</td>
        //             <td id="table-revenue-total">${formatters.totalCurrency(yearlyData[year].totals.revenue)}</td>
        //             <td id="table-invoice-total">${formatters.totalCurrency(yearlyData[year].totals.invoice)}</td>
        //             <td id="table-accrue-total">${formatters.totalCurrency(yearlyData[year].totals.accrue)}</td>
        //             <td></td>
        //         </tr>
        //     `;
        //     elements.tableBody.parentElement.appendChild(tfoot);
        // }
    }

    function showMonthDetails(year, monthIndex) {
        const monthName = MONTHS_FULL[monthIndex];
        const data = yearlyData[year];

        let existingModal = document.getElementById("monthDetailsModal");
        if (existingModal) existingModal.remove();

        const modal = document.createElement("div");
        modal.id = "monthDetailsModal";
        modal.className = "modal fade";
        modal.setAttribute("tabindex", "-1");
        modal.setAttribute("aria-labelledby", "monthDetailsModalLabel");
        modal.setAttribute("aria-hidden", "true");

        modal.innerHTML = `
            <div class="modal-dialog" style="width: 100%; max-width: 90%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="monthDetailsModalLabel">${monthName} ${year} Financial Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 class="fw-bold mb-3">Detail Information</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pekerjaan</th>
                                        <th scope="col">Nama Customer</th>
                                        <th scope="col">No.CO</th>
                                        <th scope="col">Tanggal CO</th>
                                        <th scope="col">No.DO</th>
                                        <th scope="col">Tanggal DO</th>
                                        <th scope="col">Nominal Invoice</th>
                                        <th scope="col">Status Invoice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td>Sewa Kapal Alpine</td><td>PT. Salam</td><td>CO.102301230</td><td>12/12/2025</td><td>DO.192737912</td><td>23/02/2025</td><td>Rp. 1.200.000.00</td><td>Terkirim</td></tr>
                                    <tr><td>2</td><td>Sewa Kapal Alpine</td><td>PT. Salam</td><td>CO.102301230</td><td>12/12/2025</td><td>DO.192737912</td><td>23/02/2025</td><td>Rp. 1.200.000.00</td><td>Terkirim</td></tr>
                                    <tr><td>3</td><td>Sewa Kapal Alpine</td><td>PT. Salam</td><td>CO.102301230</td><td>12/12/2025</td><td>DO.192737912</td><td>23/02/2025</td><td>Rp. 1.200.000.00</td><td>Terkirim</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(modal);
        const bootstrapModal = new bootstrap.Modal(modal, { backdrop: true, keyboard: true });
        bootstrapModal.show();

        modal.addEventListener("hidden.bs.modal", function () {
            bootstrapModal.dispose();
            modal.remove();
        }, { once: true });
    }

    function updateTotals(year) {
        if (!yearlyData[year]) return;

        elements.revenueTotal.forEach((element) => {
            if (element) element.textContent = formatters.totalCurrency(yearlyData[year].totals.revenue);
        });
        elements.invoiceTotal.forEach((element) => {
            if (element) element.textContent = formatters.totalCurrency(yearlyData[year].totals.invoice);
        });
        elements.accrueTotal.forEach((element) => {
            if (element) element.textContent = formatters.totalCurrency(yearlyData[year].totals.accrue);
        });
        elements.yearLabels.forEach((label) => label.textContent = year);
    }

    function updateChartData(year) {
        if (!yearlyChart || !yearlyData[year]) return;

        yearlyChart.data.datasets[0].data = yearlyData[year].revenue;
        yearlyChart.data.datasets[1].data = yearlyData[year].invoice;
        yearlyChart.data.datasets[2].data = yearlyData[year].accrue;
        yearlyChart.update();
    }

    function changeChartType(type) {
        if (!yearlyChart) return;

        currentChartType = type;
        yearlyChart.config.type = type;

        if (type === "line") {
            yearlyChart.data.datasets.forEach((dataset) => {
                dataset.backgroundColor = "rgba(255,255,255,0)";
                dataset.tension = 0.3;
                dataset.pointBackgroundColor = dataset.borderColor;
                dataset.pointRadius = 4;
                dataset.pointHoverRadius = 6;
            });
        } else if (type === "bar") {
            yearlyChart.data.datasets.forEach((dataset) => {
                dataset.backgroundColor = dataset.borderColor;
                dataset.pointRadius = 0;
            });
        }
        yearlyChart.update();
    }

    function switchYear(year) {
        if (!yearlyData[year]) return;

        currentYear = year;
        elements.yearPills.forEach((pill) => {
            pill.classList.remove("active");
            if (pill.getAttribute("data-year") === year) pill.classList.add("active");
        });
        updateChartData(year);
        updateTableData(year);
        updateTotals(year);
    }

    function toggleView() {
        if (elements.chartView.classList.contains("d-none")) {
            elements.chartView.classList.remove("d-none");
            elements.tableView.classList.add("d-none");
            elements.toggleViewBtn.innerHTML = '<i class="fas fa-table"></i> Show Table';
            setTimeout(() => yearlyChart.update(), 50);
        } else {
            elements.chartView.classList.add("d-none");
            elements.tableView.classList.remove("d-none");
            elements.toggleViewBtn.innerHTML = '<i class="fas fa-chart-bar"></i> Show Chart';
        }
    }

    function populateYearDropdown() {
        if (!elements.yearDropdownItems) return;

        elements.yearDropdownItems.innerHTML = "";
        const years = Object.keys(yearlyData).sort((a, b) => b - a);

        years.forEach((year) => {
            const isActive = year === currentYear;
            const dropdownItem = document.createElement("button");
            dropdownItem.className = `year-dropdown-item${isActive ? " active" : ""}`;
            dropdownItem.setAttribute("data-year", year);
            dropdownItem.textContent = year;

            dropdownItem.addEventListener("click", function () {
                const selectedYear = this.getAttribute("data-year");
                elements.yearDropdownItems.querySelectorAll(".year-dropdown-item").forEach((item) => item.classList.remove("active"));
                this.classList.add("active");
                switchYear(selectedYear);
                elements.yearDropdownMenu.classList.remove("show");
            });

            elements.yearDropdownItems.appendChild(dropdownItem);
        });
    }

    function filterYearDropdownItems(searchTerm) {
        if (!elements.yearDropdownItems) return;

        const items = elements.yearDropdownItems.querySelectorAll(".year-dropdown-item");
        items.forEach((item) => {
            const year = item.textContent;
            item.style.display = year.toLowerCase().includes(searchTerm) ? "block" : "none";
        });
    }

    function checkOverflow() {
        const pillsContainer = document.getElementById("yearPills");
        const dropdown = document.querySelector(".year-dropdown");
        if (!pillsContainer || !dropdown) return;

        dropdown.style.display = "";
        const containerWidth = pillsContainer.clientWidth;
        const pills = pillsContainer.querySelectorAll(".year-pill");
        let totalPillsWidth = 0;

        pills.forEach((pill) => {
            const style = window.getComputedStyle(pill);
            const width = pill.offsetWidth + parseFloat(style.marginLeft || 0) + parseFloat(style.marginRight || 0);
            totalPillsWidth += width;
        });
        totalPillsWidth += (pills.length - 1) * 8;

        dropdown.style.display = (totalPillsWidth > containerWidth || window.innerWidth < 768) ? "block" : "none";
    }

    function setupEventListeners() {
        if (elements.toggleViewBtn) elements.toggleViewBtn.addEventListener("click", toggleView);
        elements.chartTypeButtons.forEach((button) => {
            button.addEventListener("click", function () {
                elements.chartTypeButtons.forEach((btn) => btn.classList.remove("active"));
                this.classList.add("active");
                changeChartType(this.getAttribute("data-chart-type"));
            });
        });
        elements.yearPills.forEach((pill) => {
            pill.addEventListener("click", function () {
                switchYear(this.getAttribute("data-year"));
            });
        });
        if (elements.yearDropdownToggle && elements.yearDropdownMenu) {
            elements.yearDropdownToggle.addEventListener("click", function (event) {
                event.stopPropagation();
                elements.yearDropdownMenu.classList.toggle("show");
                if (elements.yearDropdownMenu.classList.contains("show")) populateYearDropdown();
            });
        }
        document.addEventListener("click", function (event) {
            if (elements.yearDropdownToggle && elements.yearDropdownMenu &&
                !elements.yearDropdownToggle.contains(event.target) &&
                !elements.yearDropdownMenu.contains(event.target)) {
                elements.yearDropdownMenu.classList.remove("show");
            }
        });
        if (elements.yearSearchInput) {
            elements.yearSearchInput.addEventListener("input", function () {
                filterYearDropdownItems(this.value.toLowerCase());
            });
        }
        window.addEventListener("load", checkOverflow);
        window.addEventListener("resize", checkOverflow);
    }

    function init() {
        initializeChart();
        updateTableData(currentYear);
        updateTotals(currentYear);
        setupEventListeners();
    }

    init();
});