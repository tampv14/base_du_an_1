<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập nhật đơn hàng #<?= htmlspecialchars($donHang['ma_don_hang']) ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <?= htmlspecialchars($_SESSION['success']) ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?php 
                            if (is_array($_SESSION['error'])) {
                                foreach ($_SESSION['error'] as $error) {
                                    echo htmlspecialchars($error) . '<br>';
                                }
                            } else {
                                echo htmlspecialchars($_SESSION['error']);
                            }
                            ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin đơn hàng</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= BASE_URL_ADMIN ?>?act=sua-don-hang" method="post" id="editOrderForm">
                                <input type="hidden" name="don_hang_id" value="<?= htmlspecialchars($donHang['id']) ?>">
                                
                                <div class="form-group">
                                    <label for="ten_nguoi_nhan">Tên người nhận <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ten_nguoi_nhan" name="ten_nguoi_nhan" 
                                           value="<?= htmlspecialchars($donHang['ten_nguoi_nhan']) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="sdt_nguoi_nhan">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="sdt_nguoi_nhan" name="sdt_nguoi_nhan" 
                                           value="<?= htmlspecialchars($donHang['sdt_nguoi_nhan']) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="emai_nguoi_nhan">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="emai_nguoi_nhan" name="email_nguoi_nhan" 
                                           value="<?= htmlspecialchars($donHang['emai_nguoi_nhan']) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="dia_chi_nguoi_nhan">Địa chỉ <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan" 
                                              rows="3" required><?= htmlspecialchars($donHang['dia_chi_nguoi_nhan']) ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="ghi_chu">Ghi chú</label>
                                    <textarea class="form-control" id="ghi_chu" name="ghi_chu" 
                                              rows="3"><?= htmlspecialchars($donHang['ghi_chu']) ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="trang_thai_id">Trạng thái đơn hàng <span class="text-danger">*</span></label>
                                    <select name="trang_thai_id" id="trang_thai_id" class="form-control" required>
                                        <?php foreach ($listTrangThaiDonHang as $trangThai): ?>
                                            <option value="<?= htmlspecialchars($trangThai['id']) ?>" 
                                                <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?>
                                                <?= $trangThai['id'] < $donHang['trang_thai_id'] ? 'disabled' : '' ?>>
                                                <?= htmlspecialchars($trangThai['ten_trang_thai']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Cập nhật
                                    </button>
                                    <a href="<?= BASE_URL_ADMIN ?>?act=don-hang" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Quay lại
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once 'views/layout/footer.php'; ?>

<script>
document.getElementById('editOrderForm').addEventListener('submit', function(e) {
    const requiredFields = ['ten_nguoi_nhan', 'sdt_nguoi_nhan', 'emai_nguoi_nhan', 'dia_chi_nguoi_nhan', 'trang_thai_id'];
    let hasError = false;

    requiredFields.forEach(field => {
        const element = document.getElementById(field);
        if (!element.value.trim()) {
            element.classList.add('is-invalid');
            hasError = true;
        } else {
            element.classList.remove('is-invalid');
        }
    });

    if (hasError) {
        e.preventDefault();
        alert('Vui lòng điền đầy đủ thông tin bắt buộc');
    }
});
</script>