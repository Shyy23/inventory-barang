document.addEventListener("DOMContentLoaded", async function () {
    try {
        // Fetch Data dari API Laravel
        const response = await fetch("/api/chart-data");

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const result = await response.json();
        // console.log("Data diterima dari API:", result); // Debugging

        if (
            !result.chartBarang ||
            !result.chartBarang.data ||
            !result.chartBarang.labels
        ) {
            console.error(
                "Error: Struktur data chartBarang tidak ditemukan",
                result,
            );
            throw new Error("Data tidak valid dari server");
        }

        if (
            !result.chartKategori ||
            !Array.isArray(result.chartKategori.data)
        ) {
            console.error(
                "Error: Struktur data chartKategori tidak ditemukan",
                result,
            );
            throw new Error("Data tidak valid dari server");
        }
        const stocks = result.chartBarang.data;
        const labels = result.chartBarang.labels;
        const labelsKategori = result.chartKategori.data.map(
            (category) => category.category_name,
        );
        const dataKategori = result.chartKategori.data.map(
            (category) => category.total,
        );

        // Init canvas
        const ctx1 = document
            .getElementById("chartStockBarang")
            .getContext("2d");
        const ctx2 = document
            .getElementById("categoryPieChart")
            .getContext("2d");

        // Ambil warna dari variabel CSS
        const rootStyles = getComputedStyle(document.documentElement);
        const redColor = rootStyles.getPropertyValue("--red-clr").trim();
        const yellowColor = rootStyles.getPropertyValue("--yellow-clr").trim();
        const blueColor = rootStyles.getPropertyValue("--blue-clr").trim();
        const purpleColor = rootStyles.getPropertyValue("--purple-clr").trim();
        const textColor = rootStyles.getPropertyValue("--text-clr").trim();
        const primaryColor = rootStyles

            .getPropertyValue("--primary-clr")
            .trim();

        const backgroundColors = [
            rootStyles.getPropertyValue("--red-2-clr").trim(),
            rootStyles.getPropertyValue("--yellow-2-clr").trim(),
            rootStyles.getPropertyValue("--blue-2-clr").trim(),
            rootStyles.getPropertyValue("--purple-2-clr").trim(),
            rootStyles.getPropertyValue("--green-2-clr").trim(),
            rootStyles.getPropertyValue("--orange-2-clr").trim(),
        ];
        // 🎯 Chart 1: Bar Chart (Stok Barang)
        new Chart(ctx1, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Stok Barang",
                        data: stocks,
                        backgroundColor: function (context) {
                            const value = context.raw;
                            return value < 5
                                ? redColor
                                : value < 8
                                  ? yellowColor
                                  : primaryColor;
                        },
                        borderRadius: ".25rem",
                        borderColor: "transparent",
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: {
                            color: textColor,
                            autoSkip: false,
                            maxRotation: 0,
                            minRotation: 0,
                            font: { size: 10 },
                            callback: function (value, index) {
                                return labels[index].split(" ");
                            },
                        },
                        grid: { display: false },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 8,
                            font: { size: 12 },
                        },
                        grid: { color: "rgba(255, 255, 255, 0.2)" },
                    },
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true },
                },
            },
        });

        new Chart(ctx2, {
            type: "pie",
            data: {
                labels: labelsKategori,
                datasets: [
                    {
                        label: "Jumlah Barang",
                        data: dataKategori,
                        backgroundColor: backgroundColors,
                        borderColor: "transparent",
                        borderWidth: 3,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function (context) {
                                const label = context.label || "";
                                const value = context.raw || 0;

                                const total = context.dataset.data.reduce(
                                    (a, b) => a + b,
                                    0,
                                );
                                const percentage = (
                                    (value / total) *
                                    100
                                ).toFixed(1);
                                return `${label}: ${value} barang (${percentage}%)`;
                            },
                        },
                    },
                },
            },
        });
    } catch (error) {
        console.error("Error fetching data: ", error);
    }
});
