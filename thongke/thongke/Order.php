<?php
class Order {
    private $db;
    
    public function __construct() {
        require_once './config/database.php';
        $this->db = new Database();
    }
    
    public function getMonthlyStats($month, $year) {
        $query = "SELECT 
                    COUNT(DISTINCT o.id) as total_orders,
                    SUM(o.total_amount) as revenue,
                    AVG(o.total_amount) as avg_order_value,
                    COUNT(DISTINCT o.customer_id) as unique_customers,
                    SUM(oi.quantity) as total_items_sold,
                    MAX(o.total_amount) as highest_order
                 FROM orders o
                 LEFT JOIN order_items oi ON o.id = oi.order_id
                 WHERE MONTH(o.order_date) = ? 
                 AND YEAR(o.order_date) = ?
                 AND o.status = 'completed'";
                 
        return $this->db->query($query, [$month, $year]);
    }
    
    public function getYearlyStats($year) {
        $query = "SELECT 
                    MONTH(o.order_date) as month,
                    COUNT(DISTINCT o.id) as total_orders,
                    SUM(o.total_amount) as revenue,
                    COUNT(DISTINCT o.customer_id) as unique_customers,
                    SUM(oi.quantity) as total_items_sold
                 FROM orders o
                 LEFT JOIN order_items oi ON o.id = oi.order_id
                 WHERE YEAR(o.order_date) = ?
                 AND o.status = 'completed'
                 GROUP BY MONTH(o.order_date)
                 ORDER BY MONTH(o.order_date)";
                 
        return $this->db->queryAll($query, [$year]);
    }
    
    public function getTopSellingProducts($month, $year, $limit = 5) {
        $query = "SELECT 
                    p.name as product_name,
                    SUM(oi.quantity) as total_quantity,
                    SUM(oi.subtotal) as total_revenue
                 FROM order_items oi
                 JOIN orders o ON oi.order_id = o.id
                 JOIN products p ON oi.product_id = p.id
                 WHERE MONTH(o.order_date) = ?
                 AND YEAR(o.order_date) = ?
                 AND o.status = 'completed'
                 GROUP BY p.id, p.name
                 ORDER BY total_quantity DESC
                 LIMIT ?";
                 
        return $this->db->queryAll($query, [$month, $year, $limit]);
    }
}
?>