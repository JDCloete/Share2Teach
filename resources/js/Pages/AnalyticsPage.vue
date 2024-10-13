<template>

    <v-toolbar color="primary" dark>
        <img
            @click="goBack"
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSv6vyFZbiqMYZ5njBX94kjv3u0bq_QyUvQCIB0Qj9rhlI5ExI26FAlmU4c30jUUgTgFQQ&usqp=CAU"
            alt="Logo"
            class="mr-2 rounded-image"
            width="30"
            height="30"
            style="object-fit: cover; margin-left: 15px;"
        />

        <v-toolbar-title class="d-flex">Analytics Dashboard</v-toolbar-title>

        <v-spacer></v-spacer>

    </v-toolbar>

    <div>

        <div id="chart-container" style="width: 50%; height: 400px; margin: 0 auto; overflow: visible;">
        <canvas id="combinedUserChart" width="1200" height="600"></canvas>
        </div>
        <hr style="border-top: 1px solid #000; margin: 20px 0;">
        <div id="chart-container" style="width: 50%; height: 400px; margin: 0 auto; overflow: visible;">
        <canvas id="combinedDownloadsChart" width="1200" height="600"></canvas>
        </div>
        <hr style="border-top: 1px solid #000; margin: 20px 0;">
        <div id="chart-container" style="width: 50%; height: 400px; margin: 0 auto; overflow: visible;">
        <canvas id="combinedDocumentsChart" width="1200" height="600"></canvas>
        </div>
        <hr style="border-top: 1px solid #000; margin: 20px 0;">
        <div id="chart-container" style="width: 50%; height: 400px; margin: 0 auto; overflow: visible;">
        <canvas id="reportedDocumentsChart" width="1200" height="600"></canvas>
        </div>
        <hr style="border-top: 1px solid #000; margin: 20px 0;">
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

            const ctx = document.getElementById('combinedUserChart').getContext('2d');
            charts.combinedChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['User Statistics'],
                    datasets: [
                        {
                            label: 'Total Amount of Users',
                            data: [analyticsData.value.users || 0],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Users Registered Last Month',
                            data: [analyticsData.value.new_users_last_month || 0],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Users Registered Last Week',
                            data: [analyticsData.value.new_users_last_week || 0],
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Newly Registered Today',
                            data: [analyticsData.value.new_users_today || 0],
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true, // Ensures the chart adjusts to the container
                    maintainAspectRatio: false, // Allows height to be flexible
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Set the increment to 1
                            },
                            // Adding max to ensure it shows full range with the increment
                            suggestedMax: Math.max(analyticsData.value.users, analyticsData.value.new_users_today, analyticsData.value.new_users_last_week, analyticsData.value.new_users_last_month) + 2 // Adjust as needed
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'right', // This will move the labels to the left side of the chart
                            labels: {
                                boxWidth: 20, // Adjust the box size
                                padding: 20, // Space between label items
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: 40,  // Add padding to the left to avoid cutting off the legend text
                            right: 80, // Add padding to the right if needed
                            top: 40,
                            bottom: 40
                        }
                    }
                }
            });




            // Chart for Downloads
            const downloadsCtx = document.getElementById('combinedDownloadsChart').getContext('2d');
            charts.downloadsChart = new Chart(downloadsCtx, {
                type: 'bar',
                data: {
                    labels: ['Total Downloads'],
                    datasets: [
                        {
                            label: 'Total Downloads',
                            data: [analyticsData.value.downloads || 0],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Downloads Last Month',
                            data: [analyticsData.value.new_downloads_last_month || 0],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Downloads Last Week',
                            data: [analyticsData.value.new_downloads_last_week || 0],
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'New Downloads Today',
                            data: [analyticsData.value.new_downloads_today || 0],
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true, // Ensures the chart adjusts to the container
                    maintainAspectRatio: false, // Allows height to be flexible
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Set the increment to 1
                            },
                            // Adding max to ensure it shows full range with the increment
                            suggestedMax: Math.max(analyticsData.value.downloads, analyticsData.value.new_downloads_today, analyticsData.value.new_downloads_last_week, analyticsData.value.new_downloads_last_month) + 2 // Adjust as needed
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'right', // This will move the labels to the left side of the chart
                            labels: {
                                boxWidth: 20, // Adjust the box size
                                padding: 20, // Space between label items
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: 40,  // Add padding to the left to avoid cutting off the legend text
                            right: 80, // Add padding to the right if needed
                            top: 40,
                            bottom: 40
                        }
                    }
                }
            });

            // Chart for Documents
            const documentsCtx = document.getElementById('combinedDocumentsChart').getContext('2d');
            charts.documentsChart = new Chart(documentsCtx, {
                type: 'bar',
                data: {
                    labels: ['Total Documents'],
                    datasets: [
                        {
                            label: 'Total Documents',
                            data: [analyticsData.value.documents || 0],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Documents Last Month',
                            data: [analyticsData.value.new_documents_last_month || 0],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Documents Last Week',
                            data: [analyticsData.value.new_documents_last_week || 0],
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'New Documents Today',
                            data: [analyticsData.value.new_documents_today || 0],
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }

                    ]
                },
                options: {
                    responsive: true, // Ensures the chart adjusts to the container
                    maintainAspectRatio: false, // Allows height to be flexible
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Set the increment to 1
                            },
                            // Adding max to ensure it shows full range with the increment
                            suggestedMax: Math.max(analyticsData.value.documents, analyticsData.value.new_documents_today, analyticsData.value.new_documents_last_week, analyticsData.value.new_documents_last_month) + 2 // Adjust as needed
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'right', // This will move the labels to the left side of the chart
                            labels: {
                                boxWidth: 20, // Adjust the box size
                                padding: 20, // Space between label items
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: 40,  // Add padding to the left to avoid cutting off the legend text
                            right: 80, // Add padding to the right if needed
                            top: 40,
                            bottom: 40
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
                    datasets: [
                        {
                            label: 'Total Reports',
                            data: [analyticsData.value.reports || 0],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Reported Documents Last Month',
                            data: [analyticsData.value.new_reports_last_month || 0],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Reported Documents Last Week',
                            data: [analyticsData.value.new_reports_last_week || 0],
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'New Reports Today',
                            data: [analyticsData.value.new_reports_today || 0],
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }

                    ]
                },
                options: {
                    responsive: true, // Ensures the chart adjusts to the container
                    maintainAspectRatio: false, // Allows height to be flexible
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Set the increment to 1
                            },
                            // Adding max to ensure it shows full range with the increment
                            suggestedMax: Math.max(analyticsData.value.reports, analyticsData.value.new_reports_today, analyticsData.value.new_reports_last_week, analyticsData.value.new_reports_last_month) + 2 // Adjust as needed
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'right', // This will move the labels to the left side of the chart
                            labels: {
                                boxWidth: 20, // Adjust the box size
                                padding: 20, // Space between label items
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: 40,  // Add padding to the left to avoid cutting off the legend text
                            right: 80, // Add padding to the right if needed
                            top: 40,
                            bottom: 40
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
    },
    methods: {
        goBack() {
            window.history.back();
        },
    }
};
</script>

<style scoped>
#chart-container {
    width: 60%;  /* Limit container width to 60% for centering */
    height: 500px; /* Set fixed height for the container */
    margin: 0 auto; /* Center the container horizontally */
}
canvas {
    display: block;
    width: 100% !important;  /* Force canvas to take full width of container */
    height: 100% !important; /* Force canvas to take full height of container */
}
.rounded-image {
    width: 40px; /* Ensure width is set */
    height: 40px; /* Ensure height is set */
    border-radius: 50%; /* Make the image round */
    object-fit: cover; /* Maintain aspect ratio */
    overflow: hidden; /* Hide overflow */
}
</style>
