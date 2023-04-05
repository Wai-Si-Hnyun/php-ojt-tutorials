function createChart(chartData, chartLabel) {
    const labels = Object.keys(chartData);
    const values = Object.values(chartData);

    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: chartLabel,
                    data: values,
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            if (Number.isInteger(value)) {
                                return value;
                            }
                        },
                    }
                }
            }
        },
    })
}

function createYearlyChart(data) {
    createChart(data, '# Yearly Created Post');
}

function createMonthlyChart(data) {
    createChart(data, '# Monthly Created Post');
}

function createWeeklyChart(data) {
    createChart(data, '# Weekly Created Post');
}