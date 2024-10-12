<template>
    <div>
        <h1>Analytics Dashboard</h1>
        <canvas id="combinedChart" width="1200" height="600"></canvas>
        <canvas id="downloadsChart"></canvas>
        <canvas id="documentsChart"></canvas>
        <canvas id="reportedDocumentsChart"></canvas>
    </div>
</template>

<script>
import {ref, onMounted} from 'vue';
import {Chart, registerables} from 'chart.js';

// Register all necessary components (including scales)
Chart.register(...registerables);

export default {
    name: 'AnalyticsPage',
    setup() {
        const analyticsData = ref({});
        const charts = {}; // Object to hold chart instances

        const fetchAnalyticsData = async () => {
            try {
                const response = await fetch('/api/analytics');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                analyticsData.value = await response.json();
                updateCharts(); // Call updateCharts after data is fetched
            } catch (error) {
                console.error("Error fetching analytics data:", error);
            }
        };

        // Function to update charts with fetched data
        const updateCharts = () => {
            // Destroy existing charts if they exist
            Object.values(charts).forEach(chart => {
                if (chart) {
                    chart.destroy();
                }
            });

            const ctx = document.getElementById('combinedChart').getContext('2d');
            charts.combinedChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Users'],
                    datasets: [
                        {
                            label: 'Total Users',
                            data: [analyticsData.value.users || 0],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'New Users Last Month',
                            data: [analyticsData.value.new_users_last_month || 0],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'New Users Last Week',
                            data: [analyticsData.value.new_users_last_week || 0],
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'New Users Today',
                            data: [analyticsData.value.new_users_today || 0],
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: true, // Prevent the chart from maintaining its aspect ratio
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Set the increment to 1
                            },
                            // Adding max to ensure it shows full range with the increment
                            suggestedMax: Math.max(analyticsData.value.users, analyticsData.value.new_users_today, analyticsData.value.new_users_last_week, analyticsData.value.new_users_last_month) + 2 // Adjust as needed
                        }
                    }
                }
            });




            // Chart for Downloads
            const downloadsCtx = document.getElementById('downloadsChart').getContext('2d');
            charts.downloadsChart = new Chart(downloadsCtx, {
                type: 'bar',
                data: {
                    labels: ['Total Downloads'],
                    datasets: [{
                        label: 'Downloads',
                        data: [analyticsData.value.downloads || 0],
                        backgroundColor: ['rgba(81,148,230,0.2)'],
                        borderColor: ['rgb(81,148,230,1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: true, // Prevent the chart from maintaining its aspect ratio
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Set the increment to 1
                            },
                            // Adding max to ensure it shows full range with the increment
                            suggestedMax: Math.max(analyticsData.value.users, analyticsData.value.new_users_today, analyticsData.value.new_users_last_week, analyticsData.value.new_users_last_month) + 2 // Adjust as needed
                        }
                    }
                }
            });

            // Chart for Documents
            const documentsCtx = document.getElementById('documentsChart').getContext('2d');
            charts.documentsChart = new Chart(documentsCtx, {
                type: 'bar',
                data: {
                    labels: ['Total Documents'],
                    datasets: [{
                        label: 'Documents',
                        data: [analyticsData.value.documents || 0],
                        backgroundColor: ['rgba(255, 159, 64, 0.2)'],
                        borderColor: ['rgba(255, 159, 64, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: true, // Prevent the chart from maintaining its aspect ratio
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Set the increment to 1
                            },
                            // Adding max to ensure it shows full range with the increment
                            suggestedMax: Math.max(analyticsData.value.users, analyticsData.value.new_users_today, analyticsData.value.new_users_last_week, analyticsData.value.new_users_last_month) + 2 // Adjust as needed
                        }
                    }
                }
            });

            // Chart for Reported Documents
            const reportedDocumentsCtx = document.getElementById('reportedDocumentsChart').getContext('2d');
            charts.reportedDocumentsChart = new Chart(reportedDocumentsCtx, {
                type: 'bar',
                data: {
                    labels: ['Reported Documents'],
                    datasets: [{
                        label: 'Reports',
                        data: [analyticsData.value.reported_documents || 0],
                        backgroundColor: ['rgba(255, 99, 132, 0.2)'],
                        borderColor: ['rgba(255, 99, 132, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: true, // Prevent the chart from maintaining its aspect ratio
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Set the increment to 1
                            },
                            // Adding max to ensure it shows full range with the increment
                            suggestedMax: Math.max(analyticsData.value.users, analyticsData.value.new_users_today, analyticsData.value.new_users_last_week, analyticsData.value.new_users_last_month) + 2 // Adjust as needed
                        }
                    }
                }
            });
        };

        onMounted(() => {
            fetchAnalyticsData();
            setInterval(fetchAnalyticsData, 5000); // Refresh data every 5 seconds
        });

        return {
            analyticsData,
        };
    }
};
</script>

<style scoped>
canvas {
    max-width: 600px;
    margin: 20px auto;
}
</style>
