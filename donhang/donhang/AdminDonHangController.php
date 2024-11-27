<?php
class AdminDonHangController {
    private $modelDonHang;

    public function __construct() {
        $this->modelDonHang = new AdminDonHang();
    }

    public function danhSachDonHang() {
        $listDonHang = $this->modelDonHang->getAllDonHang();
        require_once './views/donhang/listDonHang.php';
    }

    public function detailDonHang() {
        $don_hang_id = isset($_GET['id_don_hang']) ? (int)$_GET['id_don_hang'] : 0;
        if (!$don_hang_id) {
            $_SESSION['error'] = 'ID đơn hàng không hợp lệ';
            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }

        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        
        if (!$donHang) {
            $_SESSION['error'] = 'Không tìm thấy đơn hàng';
            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
        
        require_once './views/donhang/detailDonHang.php';
    }

    public function updateTrangThai() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error'] = 'Phương thức không hợp lệ';
            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }

        $don_hang_id = isset($_POST['don_hang_id']) ? (int)$_POST['don_hang_id'] : 0;
        $trang_thai_id = isset($_POST['trang_thai_id']) ? (int)$_POST['trang_thai_id'] : 0;

        if (!$don_hang_id || !$trang_thai_id) {
            $_SESSION['error'] = 'Dữ liệu không hợp lệ';
            header('Location: ' . BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang=' . $don_hang_id);
            exit();
        }

        if ($this->modelDonHang->updateTrangThaiDonHang($don_hang_id, $trang_thai_id)) {
            $_SESSION['success'] = 'Cập nhật trạng thái đơn hàng thành công';
        } else {
            $_SESSION['error'] = 'Cập nhật trạng thái đơn hàng thất bại';
        }

        header('Location: ' . BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang=' . $don_hang_id);
        exit();
    }

    public function formEditDonHang() {
        $id = isset($_GET['id_don_hang']) ? (int)$_GET['id_don_hang'] : 0;
        if (!$id) {
            $_SESSION['error'] = 'ID đơn hàng không hợp lệ';
            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }

        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        
        if ($donHang) {
            require_once './views/donhang/editDonHang.php';
            $this->deleteSessionError();
        } else {
            $_SESSION['error'] = 'Không tìm thấy đơn hàng';
            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
    }

    public function postEditDonHang() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error'] = 'Phương thức không hợp lệ';
            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }

        $don_hang_id = isset($_POST['don_hang_id']) ? (int)$_POST['don_hang_id'] : 0;
        $ten_nguoi_nhan = trim($_POST['ten_nguoi_nhan'] ?? '');
        $sdt_nguoi_nhan = trim($_POST['sdt_nguoi_nhan'] ?? '');
        $email_nguoi_nhan = trim($_POST['email_nguoi_nhan'] ?? '');
        $dia_chi_nguoi_nhan = trim($_POST['dia_chi_nguoi_nhan'] ?? '');
        $ghi_chu = trim($_POST['ghi_chu'] ?? '');
        $trang_thai_id = isset($_POST['trang_thai_id']) ? (int)$_POST['trang_thai_id'] : 0;

        $errors = [];
        if (empty($ten_nguoi_nhan)) $errors['ten_nguoi_nhan'] = 'Tên người nhận không được để trống';
        if (empty($sdt_nguoi_nhan)) $errors['sdt_nguoi_nhan'] = 'Số điện thoại không được để trống';
        if (empty($email_nguoi_nhan)) $errors['emai_nguoi_nhan'] = 'Email không được để trống';
        if (empty($dia_chi_nguoi_nhan)) $errors['dia_chi_nguoi_nhan'] = 'Địa chỉ không được để trống';
        if (!$trang_thai_id) $errors['trang_thai_id'] = 'Phải chọn trạng thái đơn hàng';

        if (!empty($errors)) {
            $_SESSION['error'] = $errors;
            header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
            exit();
        }

        if ($this->modelDonHang->updateDonHang(
            $don_hang_id,
            $ten_nguoi_nhan,
            $sdt_nguoi_nhan,
            $email_nguoi_nhan,
            $dia_chi_nguoi_nhan,
            $ghi_chu,
            $trang_thai_id
        )) {
            $_SESSION['success'] = 'Cập nhật đơn hàng thành công';
        } else {
            $_SESSION['error'] = 'Cập nhật đơn hàng thất bại';
        }

        header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
        exit();
    }

    private function deleteSessionError() {
        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }
    }
}