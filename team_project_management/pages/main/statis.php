<?php include('pages/processing/statis.php'); ?>
<div id="content-statis">
<ul class="box-info box-statis">
        <li class="box-info--statis hover">
            <i class='bx bxs-group count-project' ></i>
            <span class="text">
                <h3>Tổng dự án tham gia</h3>
                <p><?= $rows_count_prj['SoDuAn'] + $rows_count_prj2['SoDuAn'] ?></p>
            </span>
        </li>
        <li class="box-info--statis hover">
            <i class='bx bxs-clipboard-detail count-task'></i> 
            <span class="text">
                <h3>Tổng công việc được giao</h3>
                <p><?= $rows_count_task['SoCongViec'] ?></p>
            </span>
        </li>
        <li class="box-info--statis hover">
            <i class='bx bxs-star count-star' ></i>
            <span class="text">
                <h3>Đánh giá</h3>
                <div class="rate-statis">
                    <p><?= $rows_count_rating['DiemTrungBinh'] ?></p>
                    <i class='bx bxs-star' style="font-size: 1rem;width: 26px;height: 26px;"></i> 
                </div>
            </span>
        </li>
    </ul>
    <div class="chart-container">
        <canvas id="jobPieChart" class="hover"></canvas>
        <canvas id="jobBarChart" class="hover"></canvas>
    </div>
    <style>
        .chart-container canvas {
            max-width: 500px;
            max-height: 500px;
            margin: 20px auto;
        }
        .chart-container{
            display: flex;
            justify-content: space-around;
            padding-bottom: 20px;
            padding-top: 20px;
        }
        #jobPieChart, #jobBarChart {
            padding: 24px;
            background: var(--light);
            border-radius: 20px;
            align-items: center;
            grid-gap: 24px;
        }
        @media screen and (max-width: 1350px) {
            .chart-container {
                flex-direction: column;
            }

            .chart-container canvas {
                flex: 0 0 100%; /* Full chiều ngang */
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>                              
    <script>
        const labels_job = ['Công việc hoàn thành', 'Công việc chưa hoàn thành', 'Công việc quá hạn']
        const jobChartCtx = document.getElementById('jobPieChart').getContext('2d');
        const jobData = <?php echo json_encode($chartData); ?>;
        new Chart(jobChartCtx, {
            type: 'pie',
            data: {
                labels: labels_job,
                datasets: [{
                    label: 'Thu Nhập',
                    data: jobData,

                    backgroundColor: ['#3CB878', '#FD7238', '#DB504A'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const value = context.raw;
                                const percentage = ((value / total) * 100).toFixed(2);
                                return `${context.label}: ${percentage}% (${value})`;
                            }
                        }
                    },
                    datalabels: {
                        formatter: (value, context) => {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(2);
                            return `${percentage}%`;
                        },
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 12
                        }
                    }
                }
            },
            plugins: [ChartDataLabels], // Đặt plugin ngoài options
        });


        const labels_job2 = ['2021', '2022', '2023', '2024', '2025']
        const jobChartCtx2 = document.getElementById('jobBarChart').getContext('2d');
        const jobByYearData = <?php echo json_encode($dataByYear); ?>;
        new Chart(jobChartCtx2, {
            type: 'bar',
            data: {
                labels: labels_job2,
                datasets: [{
                    label: 'Số lượng công việc hoàn thành theo năm',
                    data: jobByYearData, 

                    backgroundColor: ['#3CB878'],
                }]
            },
        });
    </script>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="././js/download_pdf.js"></script>
