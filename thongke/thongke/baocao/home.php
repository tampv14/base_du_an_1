<?php require './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Báo cáo thống kê đơn hàng</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                Có lỗi xảy ra khi tải dữ liệu thống kê. Vui lòng thử lại sau.
            </div>
            <?php endif; ?>
            
            <!-- Monthly Statistics -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>Tổng đơn hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>120</h3>
                            <p>Đơn hoàn thành</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>20</h3>
                            <p>Đơn chờ xử lý</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>10</h3>
                            <p>Đơn đã hủy</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Yearly Chart -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thống kê đơn hàng theo tháng</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="yearlyOrderChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hardcoded sample data
    const yearlyData = [
        { month: 1, completed_orders: 45, pending_orders: 8, cancelled_orders: 3 },
        { month: 2, completed_orders: 52, pending_orders: 6, cancelled_orders: 4 },
        { month: 3, completed_orders: 48, pending_orders: 10, cancelled_orders: 2 },
        { month: 4, completed_orders: 60, pending_orders: 5, cancelled_orders: 3 },
        { month: 5, completed_orders: 55, pending_orders: 7, cancelled_orders: 5 },
        { month: 6, completed_orders: 65, pending_orders: 8, cancelled_orders: 4 },
        { month: 7, completed_orders: 70, pending_orders: 6, cancelled_orders: 3 },
        { month: 8, completed_orders: 75, pending_orders: 9, cancelled_orders: 4 },
        { month: 9, completed_orders: 68, pending_orders: 7, cancelled_orders: 5 },
        { month: 10, completed_orders: 72, pending_orders: 8, cancelled_orders: 3 },
        { month: 11, completed_orders: 80, pending_orders: 10, cancelled_orders: 4 },
        { month: 12, completed_orders: 85, pending_orders: 12, cancelled_orders: 5 }
    ];
    
    if (yearlyData.length > 0) {
        const months = yearlyData.map(item => {
            const monthNames = ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6', 'Th7', 'Th8', 'Th9', 'Th10', 'Th11', 'Th12'];
            return monthNames[item.month - 1];
        });
        
        const completedOrders = yearlyData.map(item => item.completed_orders || 0);
        const pendingOrders = yearlyData.map(item => item.pending_orders || 0);
        const cancelledOrders = yearlyData.map(item => item.cancelled_orders || 0);
        
        const ctx = document.getElementById('yearlyOrderChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Đơn hoàn thành',
                        data: completedOrders,
                        backgroundColor: 'rgba(40, 167, 69, 0.7)',
                        borderColor: 'rgb(40, 167, 69)',
                        borderWidth: 1,
                        stack: 'Stack 0'
                    },
                    {
                        label: 'Đơn chờ xử lý',
                        data: pendingOrders,
                        backgroundColor: 'rgba(255, 193, 7, 0.7)',
                        borderColor: 'rgb(255, 193, 7)',
                        borderWidth: 1,
                        stack: 'Stack 0'
                    },
                    {
                        label: 'Đơn đã hủy',
                        data: cancelledOrders,
                        backgroundColor: 'rgba(220, 53, 69, 0.7)',
                        borderColor: 'rgb(220, 53, 69)',
                        borderWidth: 1,
                        stack: 'Stack 0'
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y + ' đơn';
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tháng',
                            color: '#666',
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        stacked: true,
                        title: {
                            display: true,
                            text: 'Số lượng đơn hàng',
                            color: '#666',
                            font: {
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    } else {
        document.getElementById('yearlyOrderChart').parentElement.innerHTML = 
            '<div class="alert alert-info">Không có dữ liệu thống kê cho năm hiện tại.</div>';
    }
});
</script>

</body>
</html>