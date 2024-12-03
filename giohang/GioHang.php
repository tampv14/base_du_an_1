<?php 
require_once './helpers/format.php';
require_once 'layout/header.php';
require_once 'layout/menu.php';
$tong_tien_gio_hang = 0;
?>

<main>
    <!-- Phần breadcrumb -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>?act=san-pham">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Phần giỏ hàng chính -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Bảng giỏ hàng -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Ảnh sản phẩm</th>
                                        <th class="pro-title">Tên sản phẩm</th>
                                        <th class="pro-price">Giá tiền</th>
                                        <th class="pro-quantity">Số lượng</th>
                                        <th class="pro-subtotal">Tổng tiền</th>
                                        <th class="pro-update">Cập nhật</th>

                                        <th class="pro-remove">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($chiTietGioHang)): ?>
                                        <?php foreach ($chiTietGioHang as $sanPham): ?>
                                            <tr>
                                                <td class="pro-thumbnail">
                                                    <a href="<?= BASE_URL ?>?act=chi-tiet-san-pham&id=<?= $sanPham['san_pham_id'] ?>">
                                                        <img class="img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>" />
                                                    </a>
                                                </td>
                                                <td class="pro-title">
                                                    <a href="<?= BASE_URL ?>?act=chi-tiet-san-pham&id=<?= $sanPham['san_pham_id'] ?>">
                                                        <?= htmlspecialchars($sanPham['ten_san_pham']) ?>
                                                    </a>
                                                </td>
                                                <td class="pro-price" data-price="<?= $sanPham['gia_khuyen_mai'] > 0 ? $sanPham['gia_khuyen_mai'] : $sanPham['gia_san_pham'] ?>">
                                                    <span>
                                                        <?php
                                                        $gia_hien_thi = $sanPham['gia_khuyen_mai'] > 0 ? $sanPham['gia_khuyen_mai'] : $sanPham['gia_san_pham'];
                                                        echo formatprice($gia_hien_thi) . ' đ';
                                                        ?>
                                                    </span>
                                                </td>
                                                <td class="pro-quantity">
                                                    <div class="pro-qty">
                                                        <button type="button" class="btn-qty decrease">-</button>
                                                        <input type="number" 
                                                               value="<?= htmlspecialchars($sanPham['so_luong']) ?>" 
                                                               min="1"
                                                               max="<?= $this->modelSanPham->getSoLuongTonKho($sanPham['san_pham_id']) ?>"
                                                               class="quantity-input"
                                                               data-id="<?= $sanPham['san_pham_id'] ?>"
                                                               data-stock="<?= $this->modelSanPham->getSoLuongTonKho($sanPham['san_pham_id']) ?>"
                                                               readonly>
                                                        <button type="button" class="btn-qty increase">+</button>
                                                    </div>
                                                </td>
                                                <td class="pro-subtotal">
                                                    <span>
                                                        <?php
                                                        $gia_san_pham = $sanPham['gia_khuyen_mai'] > 0 ? $sanPham['gia_khuyen_mai'] : $sanPham['gia_san_pham'];
                                                        $tong_tien = $gia_san_pham * $sanPham['so_luong'];
                                                        $tong_tien_gio_hang += $tong_tien;
                                                        echo formatprice($tong_tien) . ' đ';
                                                        ?>
                                                    </span>
                                                </td>
                                                 <!-- Thêm cột cập nhật -->
    <td class="pro-update">
        <button type="button" class="btn-update" onclick="updateCartItem(this)" 
                data-id="<?= $sanPham['san_pham_id'] ?>"
                data-price="<?= $sanPham['gia_khuyen_mai'] > 0 ? $sanPham['gia_khuyen_mai'] : $sanPham['gia_san_pham'] ?>">
            <i class="fa fa-refresh"></i> Cập nhật
        </button>
    </td>
                                                <td class="pro-remove">
                                                    <a href="<?= BASE_URL ?>?act=xoa-san-pham-gio-hang&id=<?= $sanPham['san_pham_id'] ?>" 
                                                       onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Giỏ hàng của bạn đang trống</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Phần tính toán giỏ hàng -->
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Tổng đơn hàng</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Tổng tiền sản phẩm</td>
                                            <td><?= formatprice($tong_tien_gio_hang) . ' đ' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phí giao hàng</td>
                                            <td>50 VNĐ</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Tổng thanh toán</td>
                                            <td class="total-amount"><?= formatprice($tong_tien_gio_hang + 50) . ' đ' ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <?php if (!empty($chiTietGioHang)): ?>
                                <a href="<?= BASE_URL .'?act=thanh-toan' ?>" class="btn btn-sqr d-block">Tiến hành thanh toán</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const formatter = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    });

    // Hàm tìm element chứa text
    function findElementByText(text) {
        return Array.from(document.getElementsByTagName('td'))
            .find(el => el.textContent.trim() === text);
    }

    // Xử lý cho mỗi sản phẩm trong giỏ hàng
    document.querySelectorAll('.pro-qty').forEach(container => {
        const input = container.querySelector('.quantity-input');
        const decreaseBtn = container.querySelector('.decrease');
        const increaseBtn = container.querySelector('.increase');
        const row = container.closest('tr');
        const updateBtn = row.querySelector('.btn-update');
        
        const maxStock = parseInt(input.dataset.stock);
        const price = parseFloat(row.querySelector('.pro-price').dataset.price);

        //
        
        
        // Cập nhật tổng tiền của một sản phẩm
        function updateProductTotal() {
            const quantity = parseInt(input.value);
            const total = price * quantity;
            row.querySelector('.pro-subtotal span').textContent = 
                formatter.format(total).replace('₫', '') + ' đ';
        }

        // Cập nhật tổng tiền giỏ hàng
        function updateCartTotal() {
            let total = 0;
            document.querySelectorAll('.pro-subtotal span').forEach(cell => {
                const value = parseFloat(cell.textContent.replace(/[^\d]/g, ''));
                total += value;
            });

            // Cập nhật tổng tiền sản phẩm
            const totalProductsCell = findElementByText('Tổng tiền sản phẩm');
            if (totalProductsCell && totalProductsCell.nextElementSibling) {
                totalProductsCell.nextElementSibling.textContent = 
                    formatter.format(total).replace('₫', '') + ' đ';
            }

            // Cập nhật tổng thanh toán
            const totalAmount = document.querySelector('.total-amount');
            if (totalAmount) {
                totalAmount.textContent = formatter.format(total + 50).replace('₫', '') + ' đ';
            }
        }

        // Xử lý nút giảm
        decreaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                updateProductTotal();
                updateBtn.classList.add('pending');
            }
        });

        // Xử lý nút tăng
        increaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(input.value);
            if (currentValue < maxStock) {
                input.value = currentValue + 1;
                updateProductTotal();
                updateBtn.classList.add('pending');
            } else {
                alert('Số lượng đã đạt giới hạn tồn kho');
            }
        });

        // Xử lý nút cập nhật
        updateBtn.addEventListener('click', async function() {
            const quantity = parseInt(input.value);
            
            try {
                updateBtn.disabled = true;
                updateBtn.innerHTML = '<i class="fa fa-refresh fa-spin"></i> Đang cập nhật';

                const response = await fetch('<?= BASE_URL ?>?act=update-gio-hang', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `san_pham_id=${input.dataset.id}&so_luong=${quantity}`
                });

                if (!response.ok) throw new Error('Có lỗi xảy ra khi cập nhật');

                updateCartTotal();
                updateBtn.classList.remove('pending');
                showNotification('Cập nhật giỏ hàng thành công!');

            } catch (error) {
                showNotification(error.message, 'error');
            } finally {
                updateBtn.disabled = false;
                updateBtn.innerHTML = '<i class="fa fa-refresh"></i> Cập nhật';
            }
        });
    });

    // Hiển thị thông báo
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
});
</script>

<style>
<
.btn-update, .btn-delete {
    padding: 6px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #fff;
    transition: all 0.3s ease;
    font-size: 14px;
}

.btn-update {
    color: #28a745;
    border-color: #28a745;
}

.btn-update:hover {
    background: #28a745;
    color: white;
}

.btn-delete {
    color: #dc3545;
    border-color: #dc3545;
}

.btn-delete:hover {
    background: #dc3545;
    color: white;
}

.btn-update.pending {
    background: #ffc107;
    border-color: #ffc107;
    color: #000;
}

/* Thêm style cho các cột mới */
.pro-update, .pro-remove {
    text-align: center;
    vertical-align: middle;
}

/* Style cho notification */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 25px;
    border-radius: 4px;
    z-index: 1000;
    animation: slideIn 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.notification.success {
    background: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

.notification.error {
    background: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
</style>
</styl>

<style>
.pro-qty {
    display: flex;
    align-items: center;
    justify-content: center; /* Căn giữa theo chiều ngang */
    gap: 5px;
}

.btn-qty {
    width: 25px;
    height: 25px;
    border: 1px solid #ddd;
    background: #f8f9fa;
    cursor: pointer;
    display: flex;
    align-items: center;     /* Căn giữa nội dung theo chiều dọc */
    justify-content: center; /* Căn giữa nội dung theo chiều ngang */
    font-size: 14px;
    padding: 0;
    line-height: 1;
    border-radius: 3px;
}

.btn-qty:hover {
    background: #e9ecef;
}

.quantity-input {
    width: 40px;
    height: 25px;
    text-align: center;
    border: 1px solid #ddd;
    padding: 0;
    font-size: 14px;
    border-radius: 3px;
    margin: 0 2px;
}

.quantity-input:read-only {
    background-color: #fff;
}

/* Loại bỏ mũi tên tăng giảm mặc định của input number */
.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.quantity-input[type=number] {
    -moz-appearance: textfield;
}
</style>

<?php 
require_once 'layout/miniCart.php';
require_once 'layout/footer.php';
?>