<?php 
require_once './helpers/format.php';
require_once 'layout/header.php';
require_once 'layout/menu.php';
$tong_tien_gio_hang = 0;

?>

<main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= BASE_URL?>"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- checkout main wrapper start -->
        <div class="checkout-page-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Checkout Login Coupon Accordion Start -->
                        <div class="checkoutaccordion" id="checkOutAccordion">
                           

                            <div class="card">
                                <h6>Thêm mã giảm giá <span data-bs-toggle="collapse" data-bs-target="#couponaccordion">Click
                                            Nhập mã giảm giá</span></h6>
                                <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                                    <div class="card-body">
                                        <div class="cart-update-option">
                                            <div class="apply-coupon-wrapper">
                                                <form action="#" method="post" class=" d-block d-md-flex">
                                                    <input type="text" placeholder="Enter Your Coupon Code" required />
                                                    <button class="btn btn-sqr">Apply Coupon</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Checkout Login Coupon Accordion End -->
                    </div>
                </div>
                <form action="<?= BASE_URL ?>?act=post-thanh-toan" method="POST">
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Thông tin người nhận</h5>
                            <div class="billing-form-wrap">
                               
          

                                    <div class="single-input-item">
                                        <label for="ten_nguoi_nhan" class="required">Tên người nhận</label>
                                        <input type="text" id="ten_nguoi_nhan" name="ten_nguoi_nhan" 
                                               value="<?= htmlspecialchars($user['ho_ten']) ?>" required />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="emai_nguoi_nhan" class="required">Email</label>
                                        <input type="email" id="emai_nguoi_nhan" name="emai_nguoi_nhan" 
                                               value="<?= htmlspecialchars($user['email']) ?>" required />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="sdt_nguoi_nhan" class="required">Số điện thoại</label>
                                        <input type="text" id="sdt_nguoi_nhan" name="sdt_nguoi_nhan" 
                                               value="<?= htmlspecialchars($user['so_dien_thoai']) ?>" required />
                                    </div>
                                    <div class="single-input-item">
                                        <label for="dia_chi_nguoi_nhan" class="required">Địa chỉ</label>
                                        <input type="text" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan" 
                                               value="<?= htmlspecialchars($user['dia_chi']) ?>" required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="ghi_chu">Ghi chú</label>
                                        <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="3"></textarea>
                                    </div>
                                
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Details -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Thông tin đơn hàng</h5>
                            <div class="order-summary-content">

                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       
                                        <?php foreach ($chiTietGioHang as $sanPham):
                                             ?>
                                             <td><a href=""><?= $sanPham['ten_san_pham']?> <strong> * <?= $sanPham['so_luong'] ?></a>

                                             
                                           
                                                </td>
                                                <td> 
                                                    <?php
                                                        $gia_san_pham = $sanPham['gia_khuyen_mai'] > 0 ? $sanPham['gia_khuyen_mai'] : $sanPham['gia_san_pham'];
                                                        $tong_tien = $gia_san_pham * $sanPham['so_luong'];
                                                        $tong_tien_gio_hang += $tong_tien;
                                                        echo formatprice($tong_tien) . ' đ';
                                                        ?>
                                                        </td>
                                            </tr>
                                        <?php endforeach; ?>
                                           
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Tổng đơn hàng</td>
                                                <td><strong><?= formatprice($tong_tien_gio_hang) .'đ';?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                <td class="d-flex justify-content-center">
                                                   <strong>50đ</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tổng tiền đơn hàng</td>
                                                <input type="hidden" name="tong_tien" value="<?= $tong_tien_gio_hang + 50  ?>">
                                                <td><strong><?= formatprice($tong_tien_gio_hang + 50) . ' đ' ?></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cod" name="phuong_thuc_thanh_toan" 
                                                       value="1" class="custom-control-input" checked />
                                                <label class="custom-control-label" for="cod">Thanh toán khi nhận hàng</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="banking" name="phuong_thuc_thanh_toan" 
                                                       value="2" class="custom-control-input" />
                                                <label class="custom-control-label" for="banking">Chuyển khoản</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="summary-footer-area">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="terms" required />
                                            <label class="custom-control-label" for="terms">Xác nhận đặt hàng</label>
                                        </div>
                                        <button type="submit" class="btn btn-sqr">Đặt hàng</button>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- checkout main wrapper end -->
    </main>

<?php 
require_once 'layout/miniCart.php';
require_once 'layout/footer.php';
?>