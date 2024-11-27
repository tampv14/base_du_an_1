<?php
class AdminDonHang {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }
   


    public function getAllDonHang()
    {
        try {
            $sql = 'SELECT don_hang.*, trang_thai_don_hangs.ten_trang_thai
                    FROM don_hang
                    INNER JOIN trang_thai_don_hangs ON don_hang.trang_thai_id = trang_thai_don_hangs.id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function getDetailDonHang($id)
    {
        try {
            $sql = 'SELECT don_hang.*,
                           trang_thai_don_hangs.ten_trang_thai,
                           tai_khoan.ho_ten,
                           tai_khoan.email,
                           tai_khoan.so_dien_thoai,
                           phuong_thuc_thanh_toans.ten_phuong_thuc
                    FROM don_hang
                    INNER JOIN trang_thai_don_hangs ON don_hang.trang_thai_id = trang_thai_don_hangs.id
                    INNER JOIN tai_khoan ON don_hang.tai_khoan_id = tai_khoan.id
                    INNER JOIN phuong_thuc_thanh_toans ON don_hang.phuong_thuc_thanh_toan = phuong_thuc_thanh_toans.id
                    WHERE don_hang.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function getListSpDonHang($id)
    {
        try {
            $sql = 'SELECT chi_tiet_don_hang.*, san_phams.ten_san_pham
                    FROM chi_tiet_don_hang
                    INNER JOIN san_phams ON chi_tiet_don_hang.san_pham_id = san_phams.id
                    WHERE chi_tiet_don_hang.don_hang_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function getAllTrangThaiDonHang()
    {
        try {
            $sql = 'SELECT * FROM trang_thai_don_hangs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function updateDonHang(
        $id,
        $ten_nguoi_nhan,
        $sdt_nguoi_nhan,
        $email_nguoi_nhan,
        $dia_chi_nguoi_nhan,
        $ghi_chu,
        $trang_thai_id
    ) {
        try {
            $sql = 'UPDATE don_hang
                    SET ten_nguoi_nhan = :ten_nguoi_nhan,
                        sdt_nguoi_nhan = :sdt_nguoi_nhan,
                        email_nguoi_nhan = :email_nguoi_nhan,
                        dia_chi_nguoi_nhan = :dia_chi_nguoi_nhan,
                        ghi_chu = :ghi_chu,
                        trang_thai_id = :trang_thai_id
                    WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                ':email_nguoi_nhan' => $email_nguoi_nhan,
                ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                ':ghi_chu' => $ghi_chu,
                ':trang_thai_id' => $trang_thai_id,
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    public function getDonHangFromKhachHang($id)
    {
        try {
            $sql = 'SELECT don_hang.*, trang_thai_don_hangs.ten_trang_thai
                    FROM don_hang
                    INNER JOIN trang_thai_don_hangs ON don_hang.trang_thai_id = trang_thai_don_hangs.id
                    WHERE don_hang.tai_khoan_id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
}