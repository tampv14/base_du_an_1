<?php
class TinTucController
{
    private $model;

    public function __construct()
    {
        $this->model = new TinTuc(); // Khởi tạo model TinTuc
    }

    // Hiển thị danh sách tin tức
    public function danhSachTinTuc()
    {
        $news = $this->model->getAllTinTuc(); // Lấy danh sách tin tức từ model
        require_once './views/tintuc/TinTuc.php'; // Gửi dữ liệu đến view
    }

    // Hiển thị chi tiết tin tức
    public function detailTinTuc()
    {
        $id = $_GET['id'] ?? 0; // Lấy ID từ URL
        $id = intval($id);      // Đảm bảo ID là số nguyên

        $post = $this->model->getTinTucById($id); // Lấy tin tức từ model

        // Kiểm tra nếu bài viết không tồn tại
        if (!$post) {
            echo "<p>Bài viết không tồn tại!</p>";
            exit;
        }

        require_once './views/tintuc/detailTinTuc.php'; // Gửi dữ liệu đến view
    }
}