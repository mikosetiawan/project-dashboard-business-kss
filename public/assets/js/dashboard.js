// public/js/dashboard.js
document.addEventListener('DOMContentLoaded', function() {
    // Data for current year (2025)
    const currentYearData = {
        revenue: [10, 12, 9.5, 11.2, 13.5, 14.8, 12.5, 13.2, 15, 14.2, 13.8, 16.5],
        invoice: [8.5, 10.3, 8.2, 9.8, 11.7, 12.9, 10.8, 11.5, 13.1, 12.4, 12, 14.3],
        accrue: [7.2, 8.8, 7, 8.4, 10.1, 11.2, 9.3, 9.9, 11.3, 10.7, 10.4, 12.4],
        totals: {
            revenue: 156.2,
            invoice: 135.5,
            accrue: 117.7
        }
    };

    // Format currency for display
    function formatTotalCurrency(value) {
        return 'Rp ' + value.toFixed(1) + '.000.000,-';
    }

    // Set the stats card values for current year
    document.getElementById('revenue-total').textContent = formatTotalCurrency(currentYearData.totals.revenue);
    document.getElementById('invoice-total').textContent = formatTotalCurrency(currentYearData.totals.invoice);
    document.getElementById('accrue-total').textContent = formatTotalCurrency(currentYearData.totals.accrue);
});