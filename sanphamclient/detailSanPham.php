<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <?php foreach ($listAnhSanPham as $key => $SanPham): ?>
                                        <div class="pro-large-img img-zoom">
                                            <img src="<?= BASE_URL . $SanPham['link_hinh_anh'] ?>" alt="product-details" />
                                        </div>
                                    <?php endforeach ?>
                                </div>
                              
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <a href=""><?= $sanPham['ten_danh_muc']; ?></a>
                                    </div>
                                    <h3 class="product-name"><?= $sanPham['ten_san_pham']; ?></h3>
                                    <div class="ratings d-flex">
                                    <div class="pro-review">
                                            <?php $countComment = count($listBinhLuan); ?>
                                            <span><?= $countComment . ' bình luận' ?></span>
                                        </div>
                                    </div>
                                    <div class="price-box">
                                        <?php
                                        if ($sanPham['gia_khuyen_mai']) { ?>
                                            <span
                                                class="price-regular"><?= $sanPham['gia_khuyen_mai'] . 'đ'; ?></span>
                                            <span
                                                class="price-old"><del><?= $sanPham['gia_san_pham'] . 'đ'; ?></del></span>
                                        <?php } else { ?>
                                            <span
                                                class="price-old"><del><?= $sanPham['gia_san_pham'] . 'đ'; ?></del></span>
                                        <?php } ?>
                                        <!-- <span class="price-regular">$70.00</span>
                                        <span class="price-old"><del>$90.00</del></span> -->
                                    </div>

                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span> Sản phẩm còn trong kho: <?= $sanPham['so_luong'] ?></span>
                                    </div>
                                    <p class="pro-desc"><?= $sanPham['mo_ta'] ?></p>
                                    <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="post">
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h6 class="option-title">Số lượng:</h6>
                                            <div class="quantity">
                                                <input type="hidden" name="san_pham_id" value="<?= $sanPham['id']; ?>">
                                                <div class="pro-qty d-flex">
                                                    <!-- <button class="dec qtybtn">-</button> -->
                                                    <input type="text" value="1" name="so_luong">
                                                    <!-- <button class="inc qtybtn">+</button> -->
                                                </div>
                                            </div>
                                            <div class="action_link">
                                                <button class="btn btn-cart2" >Thêm giỏ hàng</button>
                                            </div>
                                        </div>
                                        <p>
                                        Trà sữa là 1 loại thức uống quen thuộc với nhiều người, nhất là các bạn trẻ. Tuy nhiên bạn đã biết có bao nhiêu loại trà sữa và dùng trà nào để pha ngon không? Hôm nay, chuyên mục Mẹo vào bếp của Điện máy XANH sẽ cùng bạn tìm hiểu về trà sữa là gì và giải đáp các thắc mắc này nha.
                                        </p>
                                        </form>


                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-bs-toggle="tab" href="#tab_three">Bình luận
                                                (<?= $countComment; ?>)</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">

                                        <div class="tab-pane fade show active" id="tab_three">
                                            <?php foreach ($listBinhLuan as $binhLuan): ?>
                                                <div class="total-reviews">
                                                    <div class="rev-avatar">
                                                        <img src="<?= BASE_URL . $binhLuan['anh_dai_dien'] ?>" alt="">

                                                    </div>
                                                    <div class="review-box">

                                                        <div class="post-author">
                                                            <p><span><?= $binhLuan['ho_ten'] ?> -
                                                                </span><?= $binhLuan['ngay_dang'] ?> </p>
                                                        </div>
                                                        <p><?= $binhLuan['noi_dung'] ?></p>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                            <form action="#" class="review-form">
                                                <div class="form-group row">
                                                    <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                            Nội dung bình luận</label>
                                                        <textarea class="form-control" required></textarea>

                                                    </div>
                                                </div>

                                                <div class="buttons">
                                                    <button class="btn btn-sqr" type="submit">Bình luận</button>
                                                </div>
                                            </form> <!-- end of review-form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related products area start -->
    
                        <!-- product item end -->


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related products area end -->
</main>

<?php require_once 'layout/miniCart.php'; ?>

<?php require_once 'layout/footer.php'; ?>