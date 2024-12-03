<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>

<main>
    <!-- Thêm phần hiển thị thông báo -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <?php if (!is_array($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <div class="container">
        <?php if (!empty($donhang)): ?>
            <?php foreach ($donhang as $item): ?>
                <div class="order-item">
                    <h3>Mã đơn hàng: <?= htmlspecialchars($item['ma_don_hang'] ?? '') ?></h3>
                    <!-- <h4>Khách hàng: <?= htmlspecialchars($item['ho_ten'] ?? '') ?></h4> -->

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $hiddenProductCount = 0;
                            if (!empty($item['san_pham'])):
                                foreach ($item['san_pham'] as $index => $san_pham):
                            ?>
                                <tr class="<?= $index === 0 ? 'first-product' : 'hidden-product' ?>" 
                                    <?= $index !== 0 ? 'style="display: none;"' : '' ?>>
                                    <td>
                                        <img src="<?= htmlspecialchars($san_pham['hinh_anh'] ?? '') ?>" 
                                             alt="<?= htmlspecialchars($san_pham['ten_san_pham'] ?? '') ?>">
                                    </td>
                                    <td><?= htmlspecialchars($san_pham['ten_san_pham'] ?? '') ?></td>
                                    <td><?= number_format($san_pham['gia_san_pham'] ?? 0, 0, ',', '.') ?> VNĐ</td>
                                    <td><?= htmlspecialchars($san_pham['so_luong'] ?? '') ?></td>
                                    <td><?= number_format($san_pham['thanh_tien'] ?? 0, 0, ',', '.') ?> VNĐ</td>
                                    <td><?= htmlspecialchars($item['ten_trang_thai'] ?? '') ?></td>
                                </tr>
                            <?php
                                    if ($index !== 0) $hiddenProductCount++;
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>

                    <!-- Hiển thị thông báo nếu có sản phẩm ẩn -->
                    <?php if ($hiddenProductCount > 0): ?>
                        <p class="show-more-toggle">
                            <strong>Sản phẩm khác:</strong> <?= $hiddenProductCount ?>
                            <a href="#" class="toggle-products">Hiện thêm</a>
                        </p>
                    <?php endif; ?>

                    <p><strong>Ngày đặt:</strong> <?= htmlspecialchars($item['ngay_dat'] ?? '') ?></p>
                    <!-- <p><strong>Trạng thái:</strong> <?= htmlspecialchars($item['trang_thai']['ten_trang_thai'] ?? '') ?></p> -->
                    <div class="action-buttons">
                        <a href="<?= BASE_URL ?>?act=chi-tiet-don-hang&id=<?= htmlspecialchars($item['don_hang_id'] ?? '') ?>"
                           class="detail-btn">Xem chi tiết</a>

                        <?php if (($item['trang_thai_id'] ?? 0) == 1): ?>
                            <a href="<?= BASE_URL ?>?act=huy-don-hang&id=<?= htmlspecialchars($item['id'] ?? '') ?>" 
                               class="delete-btn"
                               onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                                Hủy đơn hàng
                            </a>
                            
                        <?php else: ?>
                           
                            
                            <span class="cancel-btn-disabled">
                                
                                <?= ($item['trang_thai_id'] ?? 0) == 9 ? 'Đã hủy' : 'Không thể hủy' ?>
                            </span>
                            
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info">
                <p>Không có đơn hàng nào!</p>
            </div>
        <?php endif; ?>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const toggleButtons = document.querySelectorAll('.toggle-products');

    toggleButtons.forEach((button) => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const parent = button.closest('.order-item');
            const hiddenRows = parent.querySelectorAll('.hidden-product');

            hiddenRows.forEach(row => row.style.display = 'table-row'); // Hiển thị sản phẩm ẩn
            button.style.display = 'none'; // Ẩn nút "Hiện thêm"
        });
    });
});

</script>


<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f4f4;
        color: #444;
        padding: 40px 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .breadcrumb-area {
        background-color: #f4f4f4;
        padding: 10px 0;
    }

    .breadcrumb-wrap nav ul.breadcrumb {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: flex-start;
        gap: 10px;
        font-size: 16px;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: #333;
    }

    .breadcrumb-item a:hover {
        color: #c29958;
    }

    .breadcrumb-item.active {
        font-weight: bold;
        color: #c29958;
    }

    .order-item {
        border-bottom: 2px solid #ddd;
        padding-bottom: 30px;
        margin-bottom: 30px;
        text-align: left;
    }

    .order-item h3 {
        font-size: 24px;
        color: #c29958;
    }

    .order-item h4 {
        font-size: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th,
    .table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        border-right: 1px solid #ddd; /* Thêm đường kẻ giữa các cột */
    }

    .table th:last-child,
    .table td:last-child {
        border-right: none; /* Loại bỏ đường kẻ bên phải cột cuối cùng */
    }

    .table th {
        background-color: #c29958;
        color: #fff;
    }

    .table td img {
        width: 80px;
        height: 80px;
        object-fit: cover;
    }

    .detail-btn,
    .delete-btn {
        margin-top: 20px;
        padding: 10px 25px;
        border-radius: 5px;
        text-decoration: none;
        color: #fff;
    }

    .detail-btn {
        background-color: #c29958;
    }

    .delete-btn {
        background-color: #dd0000;
    }

    .cancel-btn-disabled {
        margin-top: 20px;
        padding: 10px 25px;
        background-color: #999999;
        color: #fff;
        border-radius: 5px;
    }
    .hidden-product {
    display: none; /* Ẩn sản phẩm ngoài sản phẩm đầu tiên */
}

.first-product {
    display: table-row; /* Hiển thị sản phẩm đầu tiên */
}

.show-more-toggle {
    margin-top: 10px;
    font-size: 16px;
    color: #555;
}

.show-more-toggle .toggle-products {
    color: #c29958;
    text-decoration: none;
    cursor: pointer;
}

.show-more-toggle .toggle-products:hover {
    text-decoration: underline;
}

.alert {
    margin: 20px;
    padding: 15px;
    border-radius: 4px;
    position: relative;
}

.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

.alert-dismissible .btn-close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 15px;
    color: inherit;
    background: transparent;
    border: 0;
    cursor: pointer;
}

</style>

<?php require_once 'views/layout/footer.php'; ?>
