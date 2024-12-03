<?php

class HomeController
{
    public $modelSanPham;

    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDangKy;
    public $modelDonhang;
    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }

    public function home()
    {
        // echo 'Đây là home';
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }


    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        // var_dump($sanPham); die();
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        // var_dump($listAnhSanPham); die();
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);
        // var_dump($listSanPhamCungDanhMuc); die;
        if ($sanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header('location: ' . BASE_URL);
            exit();
        }
    }


    // login
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        // require_once './base-xuong-thu-cung/views/auth/formLogin.php';

        deleteSessionError();
        exit();
    }



    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if (is_array($user)) {
                // Lưu thông tin người dùng vào session
                $_SESSION['user_client'] = $user;  // Lưu toàn bộ thông tin người dùng vào session

                // Kiểm tra vai trò người dùng để chuyển hướng
                if ($user['vai_tro'] == 1) {
                    // Nếu là admin, chuyển đến trang quản trị
                    $_SESSION['user_admin'] = $user;  // Lưu thông tin admin
                    header('Location:' . BASE_URL_ADMIN);  // Chuyển đến trang quản trị
                    exit();
                } else {
                    // Nếu là khách hàng, chuyển đến trang chủ
                    header('Location:' . BASE_URL);  // Chuyển đến trang chủ
                    exit();
                }
            } else {
                // Lỗi đăng nhập
                $_SESSION['error'] = $user;
                $_SESSION['flash'] = true;
                header('Location:' . BASE_URL . '?act=login');
                exit();
            }
        }
    }






    public function Logout()
    {
        // Kiểm tra nếu người dùng là admin hoặc client
        if (isset($_SESSION['user_client'])) {
            // Đăng xuất người dùng client
            session_destroy();

            // Hiển thị thông báo và chuyển hướng về trang client
            echo "<script>
                    alert('Đăng xuất thành công');
                    window.location.href = '" . BASE_URL . "';
                  </script>";
            exit();
        } elseif (isset($_SESSION['user_admin'])) {
            // Đăng xuất người dùng admin
            session_destroy();

            // Hiển thị thông báo và chuyển hướng về trang admin
            echo "<script>
                    alert('Đăng xuất thành công');
                    window.location.href = '" . BASE_URL_ADMIN . "';
                  </script>";
            exit();
        } else {
            // Nếu không có session, chuyển hướng về trang chủ hoặc login
            header('Location: ' . BASE_URL);
            exit();
        }
    }


////////////////////////////////////////////////////////////
public function addGioHang() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            // Bước 1: Kiểm tra đăng nhập
            if (!isset($_SESSION['user_client'])) {
                throw new Exception('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng');
            }

            // Bước 2: Lấy và kiểm tra dữ liệu đầu vào
            $user = $_SESSION['user_client'];
            $san_pham_id = isset($_POST['san_pham_id']) ? (int)$_POST['san_pham_id'] : 0;
            $so_luong = isset($_POST['so_luong']) ? (int)$_POST['so_luong'] : 0;

            if ($so_luong <= 0) {
                throw new Exception('Số lượng sản phẩm không hợp lệ');
            }

            // Bước 3: Xử lý giỏ hàng
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            if (!$gioHang) {
                // 3.1: Tạo giỏ hàng mới nếu chưa có
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                if (!$gioHangId) {
                    throw new Exception('Không thể tạo giỏ hàng');
                }
                $gioHang = ['id' => $gioHangId];
            }

            // Bước 4: Thêm sản phẩm vào giỏ hàng
            $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
            
            // Bước 5: Thông báo thành công
            $_SESSION['success'] = 'Thêm sản phẩm vào giỏ hàng thành công';

        } catch (Exception $e) {
            // Bước 6: Xử lý lỗi
            $_SESSION['error'] = $e->getMessage();
        }

        // Bước 7: Chuyển hướng về trang trước
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: ' . BASE_URL);
        }
        exit();
    }
}

    ////////////////////////////////////
    public function gioHang() {
        if (!isset($_SESSION['user_client'])) {
            header("Location:" . BASE_URL . '?act=login');
            exit();
        }

        $user = $_SESSION['user_client'];
        if (!isset($user['id'])) {
            $_SESSION['error'] = 'Không tìm thấy thông tin người dùng';
            header("Location:" . BASE_URL);
            exit();
        }

        $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
        if (!$gioHang) {
            $gioHangId = $this->modelGioHang->addGioHang($user['id']);
            if (!$gioHangId) {
                $_SESSION['error'] = 'Không thể tạo giỏ hàng';
                header("Location:" . BASE_URL);
                exit();
            }
            $gioHang = ['id' => $gioHangId];
        }

        $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
        require_once './views/gioHang.php';
    }


    ///////////////////////////////////
    public function xoaSanPhamGioHang() {
        if (!isset($_SESSION['user_client'])) {
            header("Location:" . BASE_URL . '?act=login');
            exit();
        }
    
        $user = $_SESSION['user_client'];
        if (!isset($user['id'])) {
            $_SESSION['error'] = 'Không tìm thấy thông tin người dùng';
            header("Location:" . BASE_URL);
            exit();
        }
    
        $san_pham_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$san_pham_id) {
            $_SESSION['error'] = 'Thông tin sản phẩm không hợp lệ';
            header("Location:" . BASE_URL . '?act=gio-hang');
            exit();
        }
    
        $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
        if (!$gioHang) {
            $_SESSION['error'] = 'Không tìm thấy giỏ hàng';
            header("Location:" . BASE_URL . '?act=gio-hang');
            exit();
        }
    
        $result = $this->modelGioHang->deleteCartItem($gioHang['id'], $san_pham_id);
        if ($result) {
            $_SESSION['success'] = 'Đã xóa sản phẩm khỏi giỏ hàng';
        } else {
            $_SESSION['error'] = 'Không thể xóa sản phẩm khỏi giỏ hàng';
        }
    
        header("Location:" . BASE_URL . '?act=gio-hang');
        exit();
    }
    


    public function thanhToan(){
        if (!isset($_SESSION['user_client'])) {
            header("Location:" . BASE_URL . '?act=login');
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            exit();
        }

        $user = $_SESSION['user_client'];
        if (!isset($user['id'])) {
            $_SESSION['error'] = 'Không tìm thấy thông tin người dùng';
            header("Location:" . BASE_URL);
            exit();
        }

        $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
        if (!$gioHang) {
            $gioHangId = $this->modelGioHang->addGioHang($user['id']);
            if (!$gioHangId) {
                $_SESSION['error'] = 'Không thể tạo giỏ hàng';
                header("Location:" . BASE_URL);
                exit();
            }
            $gioHang = ['id' => $gioHangId];
        }

        $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
       
       
        require_once './views/thanhToan.php';
    }
    public function postThanhToan() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                // Kiểm tra user đăng nhập
                if (!isset($_SESSION['user_client'])) {
                    throw new Exception('Vui lòng đăng nhập để đặt hàng');
                }

                $user = $_SESSION['user_client'];
                
                // Lấy thông tin từ form
                $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
                $emai_nguoi_nhan = $_POST['emai_nguoi_nhan'];
                $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
                $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
                $ghi_chu = $_POST['ghi_chu'];
                $tong_tien = $_POST['tong_tien'];
                $phuong_thuc_thanh_toan = $_POST['phuong_thuc_thanh_toan'];
                $ngay_dat = date('Y-m-d H:i:s');
                $trang_thai_id = 1;
                $ma_don_hang = 'DH' . rand(1000, 9999);

                // Lấy thông tin giỏ hàng
                $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
                if (!$gioHang) {
                    throw new Exception('Không tìm thấy giỏ hàng');
                }

                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                if (empty($chiTietGioHang)) {
                    throw new Exception('Giỏ hàng trống');
                }

                // Thêm đơn hàng
                $don_hang_id = $this->modelDonHang->addDonHang(
                    $user['id'],
                    $ten_nguoi_nhan,
                    $emai_nguoi_nhan,
                    $sdt_nguoi_nhan,
                    $dia_chi_nguoi_nhan,
                    $ghi_chu,
                    $tong_tien,
                    $phuong_thuc_thanh_toan,
                    $ngay_dat,
                    $ma_don_hang,
                    $trang_thai_id
                );

                if (!$don_hang_id) {
                    throw new Exception('Không thể tạo đơn hàng');
                }

                // Thêm chi tiết đơn hàng
                foreach ($chiTietGioHang as $item) {
                    $don_gia = $item['gia_khuyen_mai'] > 0 ? $item['gia_khuyen_mai'] : $item['gia_san_pham'];
                    $thanh_tien = $don_gia * $item['so_luong'];
                    
                    $result = $this->modelDonHang->addChiTietDonHang(
                        $don_hang_id,
                        $item['san_pham_id'],
                        $item['so_luong'],
                        $don_gia
                    );

                    if (!$result) {
                        throw new Exception('Không thể thêm chi tiết đơn hàng');
                    }
                }

                // Xóa giỏ hàng
                $this->modelGioHang->deleteChiTietGioHang($gioHang['id']);

                $_SESSION['success'] = "Đặt hàng thành công! Mã đơn hàng của bạn là: " . $ma_don_hang;
                header("Location:" . BASE_URL . "?act=don-hang");
                exit();

            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header("Location:" . BASE_URL . "?act=thanh-toan");
                exit();
            }
        }
    }
    public function updateGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $san_pham_id = $_POST['san_pham_id'] ?? 0;
            $so_luong = $_POST['so_luong'] ?? 0;
            
            try {
                // Lấy giỏ hàng hiện tại của user
                $user_id = $_SESSION['user']['id'] ?? 0;
                $gioHang = $this->modelGioHang->getGioHangFromUser($user_id);
                
                if ($gioHang) {
                    // Cập nhật số lượng
                    $result = $this->modelGioHang->updateSoLuong(
                        $gioHang['id'],
                        $san_pham_id,
                        $so_luong
                    );
                    
                    if ($result) {
                        echo json_encode(['status' => 'success']);
                        exit;
                    }
                }
                
                echo json_encode(['status' => 'error', 'message' => 'Không thể cập nhật giỏ hàng']);
                exit;
                
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                exit;
            }
        }
    }

}



