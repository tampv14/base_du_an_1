<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>

<div class="container mt-4">
    <?php if ($chitietdonhang): ?>
        <h2>Đơn hàng #<?= htmlspecialchars($chitietdonhang['ma_don_hang']) ?></h2>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Tổng quan đơn hàng</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Ngày đặt:</strong> <?= htmlspecialchars($chitietdonhang['ngay_dat']) ?></p>
                        <p><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($chitietdonhang['phuong_thuc_thanh_toan']) ?></p>
                        <p><strong>Trạng thái:</strong> <?= htmlspecialchars($chitietdonhang['ten_trang_thai']) ?></p>
                        <p><strong>Tổng thanh toán:</strong> <?= number_format($chitietdonhang['tong_tien'], 0, ',', '.') ?> VNĐ</p>


                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Thông tin khách hàng</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Họ tên:</strong> <?= htmlspecialchars($chitietdonhang['ten_nguoi_nhan']) ?></p>
                        <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($chitietdonhang['sdt_nguoi_nhan']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($chitietdonhang['emai_nguoi_nhan']) ?></p>
                        <p><strong>Địa chỉ giao hàng:</strong> <?= htmlspecialchars($chitietdonhang['dia_chi_nguoi_nhan']) ?></p>
                        <p><strong>Ghi chú:</strong> <?= htmlspecialchars($chitietdonhang['ghi_chu']) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3>Chi tiết sản phẩm</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sanpham as $sp): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= BASE_URL . htmlspecialchars($sp['hinh_anh']) ?>" 
                                             alt="<?= htmlspecialchars($sp['ten_san_pham']) ?>" 
                                             style="width: 50px; margin-right: 10px;">
                                        <?= htmlspecialchars($sp['ten_san_pham']) ?>
                                    </div>
                                </td>
                                <td><?= number_format($sp['don_gia'], 0, ',', '.') ?> VNĐ</td>
                                <td><?= htmlspecialchars($sp['so_luong']) ?></td>
                                <td><?= number_format($sp['thanh_tien'], 0, ',', '.') ?> VNĐ</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            Không tìm thấy thông tin đơn hàng
        </div>
    <?php endif; ?>
</div>

<?php require_once 'views/layout/footer.php'; ?>