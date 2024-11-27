<?php
class TinTuc {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllTinTuc() {
        $sql = "SELECT id, tieu_de, noi_dung, anh, ngay_dang 
                FROM tin_tucs 
                WHERE trang_thai = 1 
                ORDER BY ngay_dang DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTinTucById($id) {
        $sql = "SELECT id, tieu_de, noi_dung, anh, ngay_dang 
                FROM tin_tucs 
                WHERE id = :id AND trang_thai = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}