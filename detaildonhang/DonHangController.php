<?php
class DonHangController
{
    private $model;

    public function __construct()
    {
        $this->model = new DonHang(); // Khởi tạo model DonHang
    }

// <<<<<<< Tabnine <<<<<<<
    public function donHang()
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }

        $tai_khoan_id = $_SESSION['user']['id'];
        $donhang = $this->model->getDonHangByUserId($tai_khoan_id); // Lấy danh sách đơn hàng

        // Kiểm tra xem $donhang có phải là mảng không//+
        if (!is_array($donhang)) {//+
            $donhang = []; // Nếu không phải mảng, gán là mảng rỗng//+
        }//+
//+
        // Truyền dữ liệu đơn hàng vào view//+
        $data = [//+
            'donhang' => $donhang//+
        ];//+
        require_once './views/donhang/DonHang.php';
    }
// >>>>>>> Tabnine >>>>>>>// {"source":"chat"}

    public function chiTietDonHang()
    {
        try {
            // Kiểm tra đăng nhập
            if (empty($_SESSION['user_client'])) {
                $_SESSION['error'] = 'Vui lòng đăng nhập để xem chi tiết đơn hàng';
                header('Location: ' . BASE_URL . '?act=login');
                exit();
            }

            // Kiểm tra ID đơn hàng
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                throw new Exception('Không tìm thấy mã đơn hàng');
            }

            $don_hang_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
            if (!$don_hang_id) {
                throw new Exception('Mã đơn hàng không hợp lệ');
            }

            // Lấy thông tin đơn hàng
            $result = $this->model->getChiTietDonHang($don_hang_id);
            
            if (!$result) {
                throw new Exception('Không tìm thấy thông tin đơn hàng');
            }

            $chitietdonhang = $result['don_hang'];
            $sanpham = $result['san_pham'];

            // Kiểm tra quyền xem đơn hàng
            if ($chitietdonhang['tai_khoan_id'] != $_SESSION['user_client']['id']) {
                throw new Exception('Bạn không có quyền xem đơn hàng này');
            }

            require_once './views/donhang/detailDonHang.php';
            
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL . '?act=don-hang');
            exit();
        }
    }
    public function huyDonHang()
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }

        // Lấy ID đơn hàng từ URL và tài khoản người dùng
        $don_hang_id = $_GET['id'];
        $tai_khoan_id = $_SESSION['user']['id'];

        // Gọi model để hủy đơn hàng
        $result = $this->model->huyDonHang($don_hang_id, $tai_khoan_id);

        if ($result) {
            $_SESSION['message'] = 'Hủy đơn hàng thành công.';
        } else {
            $_SESSION['message'] = 'Hủy đơn hàng thất bại. Vui lòng thử lại.';
        }

        // Chuyển hướng về trang danh sách đơn hàng
        header('Location: ' . BASE_URL . '?act=don-hang');
        exit();
    }
    public function daNhanDonHang()
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }
    
        // Lấy ID đơn hàng từ URL và tài khoản người dùng
        $don_hang_id = $_GET['id'];
        $tai_khoan_id = $_SESSION['user']['id'];
    
        // Gọi model để cập nhật trạng thái đơn hàng
        $result = $this->model->daNhanDonHang($don_hang_id, $tai_khoan_id);
    
        if ($result) {
            $_SESSION['message'] = 'Đã xác nhận nhận hàng thành công.';
        } else {
            $_SESSION['message'] = 'Không thể xác nhận nhận hàng. Vui lòng thử lại.';
        }
    
        // Chuyển hướng về trang danh sách đơn hàng
        header('Location: ' . BASE_URL . '?act=don-hang');
        exit();
    }

}


