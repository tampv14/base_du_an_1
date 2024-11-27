<?php
require_once './models/Order.php';

class AdminBaoCaoThongKeController {
    private $orderModel;
    
    public function __construct() {
        $this->orderModel = new Order();
    }

    public function home() {
        try {
            $currentMonth = date('m');
            $currentYear = date('Y');
            
            // Get statistics data
            $monthlyStats = $this->orderModel->getMonthlyStats($currentMonth, $currentYear);
            $yearlyStats = $this->orderModel->getYearlyStats($currentYear);
            $topProducts = $this->orderModel->getTopSellingProducts($currentMonth, $currentYear);
            
            // Set default values if null
            $monthlyStats = $monthlyStats ?: [
                'total_orders' => 5000000 ,
                'revenue' => 5600000,
                'avg_order_value' => 234000,
                'unique_customers' => 409640,
                'total_items_sold' => 3453,
                'highest_order' => 90023
            ];
            
            $yearlyStats = $yearlyStats ?: [];
            
            // Pass data to view
            $data = [
                'monthlyStats' => $monthlyStats,
                'yearlyStats' => $yearlyStats,
                'topProducts' => $topProducts
            ];
            
            require_once './views/baocao/home.php';
        } catch (Exception $e) {
            error_log("Error in AdminBaoCaoThongKeController: " . $e->getMessage());
            header("Location: index.php?error=statistics_error");
        }
    }
}
?>