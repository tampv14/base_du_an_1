<?php
class DonHang
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // Hàm kết nối database
    }

    public function getDonHangByUserId($tai_khoan_id)
    {
        try {
            // Validate đầu vào
            $tai_khoan_id = filter_var($tai_khoan_id, FILTER_VALIDATE_INT);
            if (!$tai_khoan_id) {
                return false;
            }

            // Lấy thông tin đơn hàng và sắp xếp theo thời gian mới nhất
            $sql = "SELECT dh.*, 
                           tt.ten_trang_thai,
                           tt.id as trang_thai_id,
                           tk.ho_ten,
                           dh.id as don_hang_id,
                           dh.ngay_dat
                    FROM don_hang dh
                    LEFT JOIN trang_thai_don_hangs tt ON dh.trang_thai_id = tt.id
                    LEFT JOIN tai_khoans tk ON dh.tai_khoan_id = tk.id
                    WHERE dh.tai_khoan_id = :tai_khoan_id
                    ORDER BY dh.id DESC, dh.ngay_dat DESC"; // Sắp xếp theo ID và ngày đặt giảm dần

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':tai_khoan_id', $tai_khoan_id, PDO::PARAM_INT);
            $stmt->execute();
            $donhang = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($donhang)) {
                return [];
            }

            // Lấy chi tiết sản phẩm cho mỗi đơn hàng
            foreach ($donhang as &$dh) {
                $sql = "SELECT ct.*, 
                               sp.ten_san_pham, 
                               sp.hinh_anh, 
                               sp.gia_san_pham,
                               (ct.so_luong * ct.don_gia) as thanh_tien
                        FROM chi_tiet_don_hang ct
                        INNER JOIN san_phams sp ON ct.san_pham_id = sp.id
                        WHERE ct.don_hang_id = :don_hang_id
                        ORDER BY ct.id DESC"; // Sắp xếp chi tiết đơn hàng theo ID giảm dần

                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':don_hang_id', $dh['id'], PDO::PARAM_INT);
                $stmt->execute();
                $dh['san_pham'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            return $donhang;

        } catch (Exception $e) {
            error_log('Lỗi lấy đơn hàng: ' . $e->getMessage());
            return false;
        }
    }
    


    // Lấy chi tiết đơn hàng theo ID và tài khoản
    public function getChiTietDonHang($don_hang_id)
    {
        try {
            // Lấy thông tin đơn hàng
            $sql = "SELECT dh.*, 
                           tt.ten_trang_thai,
                           pttt.ten_phuong_thuc as phuong_thuc_thanh_toan
                    FROM don_hang dh
                    LEFT JOIN trang_thai_don_hangs tt ON dh.trang_thai_id = tt.id
                    LEFT JOIN phuong_thuc_thanh_toans pttt ON dh.phuong_thuc_thanh_toan_id = pttt.id
                    WHERE dh.id = :don_hang_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':don_hang_id', $don_hang_id, PDO::PARAM_INT);
            $stmt->execute();
            
            $donhang = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$donhang) {
                return false;
            }

            // Lấy chi tiết sản phẩm
            $sql = "SELECT ct.*, 
                           sp.ten_san_pham,
                           sp.hinh_anh,
                           (ct.so_luong * ct.don_gia) as thanh_tien
                    FROM chi_tiet_don_hang ct
                    INNER JOIN san_phams sp ON ct.san_pham_id = sp.id
                    WHERE ct.don_hang_id = :don_hang_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':don_hang_id', $don_hang_id, PDO::PARAM_INT);
            $stmt->execute();
            
            $sanpham = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'don_hang' => $donhang,
                'san_pham' => $sanpham
            ];
            
        } catch (Exception $e) {
            error_log('Lỗi lấy chi tiết đơn hàng: ' . $e->getMessage());
            return false;
        }
    }

    //
     public function addDonHang($tai_khoan_id, $ten_nguoi_nhan, $emai_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $tong_tien, $phuong_thuc_thanh_toan, $ngay_dat, $ma_don_hang, $trang_thai_id)
    {
        try {
            // Kiểm tra tài khoản ID
            if (!$tai_khoan_id) {
                throw new Exception('ID tài khoản không hợp lệ');
            }

            $sql = 'INSERT INTO don_hang (
                tai_khoan_id, 
                ten_nguoi_nhan, 
                emai_nguoi_nhan, 
                sdt_nguoi_nhan, 
                dia_chi_nguoi_nhan, 
                ghi_chu, 
                tong_tien, 
                phuong_thuc_thanh_toan_id, 
                ngay_dat, 
                ma_don_hang,
                trang_thai_id
            ) VALUES (
                :tai_khoan_id,
                :ten_nguoi_nhan,
                :emai_nguoi_nhan,
                :sdt_nguoi_nhan,
                :dia_chi_nguoi_nhan,
                :ghi_chu,
                :tong_tien,
                :phuong_thuc_thanh_toan_id,
                :ngay_dat,
                :ma_don_hang,
                :trang_thai_id
            )';

            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id,
                ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                ':emai_nguoi_nhan' => $emai_nguoi_nhan,
                ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                ':ghi_chu' => $ghi_chu,
                ':tong_tien' => $tong_tien,
                ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan,
                ':ngay_dat' => $ngay_dat,
                ':ma_don_hang' => $ma_don_hang,
                ':trang_thai_id' => $trang_thai_id
            ]);

            if ($result) {
                return $this->conn->lastInsertId();
            }
            return false;
        } catch (Exception $e) {
            error_log('Lỗi thêm đơn hàng: ' . $e->getMessage());
            return false;
        }
    }
    public function huyDonHang($don_hang_id, $tai_khoan_id)
    {
        $sql = "UPDATE don_hang
            SET trang_thai_id = 9-- Đã hủy
            WHERE id = :don_hang_id AND tai_khoan_id = :tai_khoan_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':don_hang_id', $don_hang_id, PDO::PARAM_INT);
        $stmt->bindParam(':tai_khoan_id', $tai_khoan_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function addChiTietDonHang($don_hang_id, $san_pham_id, $so_luong, $don_gia)
    {
        try {
            // Validate đầu vào
            $don_hang_id = filter_var($don_hang_id, FILTER_VALIDATE_INT);
            $san_pham_id = filter_var($san_pham_id, FILTER_VALIDATE_INT);
            $so_luong = filter_var($so_luong, FILTER_VALIDATE_INT);
            $don_gia = filter_var($don_gia, FILTER_VALIDATE_FLOAT);

            if (!$don_hang_id || !$san_pham_id || !$so_luong || !$don_gia) {
                throw new Exception('Dữ liệu đầu vào không hợp lệ');
            }

            // Tính thành tiền
            $thanh_tien = $so_luong * $don_gia;

            // Thêm chi tiết đơn hàng
            $sql = "INSERT INTO chi_tiet_don_hang (
                        don_hang_id,
                        san_pham_id,
                        so_luong,
                        don_gia,
                        thanh_tien
                    ) VALUES (
                        :don_hang_id,
                        :san_pham_id,
                        :so_luong,
                        :don_gia,
                        :thanh_tien
                    )";

            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindValue(':don_hang_id', $don_hang_id, PDO::PARAM_INT);
            $stmt->bindValue(':san_pham_id', $san_pham_id, PDO::PARAM_INT);
            $stmt->bindValue(':so_luong', $so_luong, PDO::PARAM_INT);
            $stmt->bindValue(':don_gia', $don_gia, PDO::PARAM_STR);
            $stmt->bindValue(':thanh_tien', $thanh_tien, PDO::PARAM_STR);

            // Thực hiện thêm
            if (!$stmt->execute()) {
                throw new Exception('Không thể thêm chi tiết đơn hàng');
            }

            // Cập nhật số lượng sản phẩm trong kho
            $sql = "UPDATE san_phams 
                    SET so_luong = so_luong - :so_luong 
                    WHERE id = :san_pham_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':so_luong', $so_luong, PDO::PARAM_INT);
            $stmt->bindValue(':san_pham_id', $san_pham_id, PDO::PARAM_INT);
            
            if (!$stmt->execute()) {
                throw new Exception('Không thể cập nhật số lượng sản phẩm');
            }

            return true;

        } catch (Exception $e) {
            error_log('Lỗi thêm chi tiết đơn hàng: ' . $e->getMessage());
            return false;
        }
    }
    public function daNhanDonHang($don_hang_id, $tai_khoan_id)
    {
        $sql = "UPDATE don_hang
            SET trang_thai_id = 6 -- Đã nhận
            WHERE id = :don_hang_id AND tai_khoan_id = :tai_khoan_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':don_hang_id', $don_hang_id, PDO::PARAM_INT);
        $stmt->bindParam(':tai_khoan_id', $tai_khoan_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}


