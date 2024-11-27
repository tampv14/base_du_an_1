<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>
<link rel="stylesheet" href="assets/css/style.css">
<main>
    <!-- hero slider area start -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/4.jpeg">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/5.jpeg">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/6.jpg">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->
        </div>
    </section>
    <!-- hero slider area end -->

    <!-- service policy area start -->
    
    <!-- service policy area end -->

    <!-- banner statistics area start -->
    <div class="banner-statistics-area">
        <div class="container">
            <div class="row row-20 mtn-20">
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <!-- <img src="assets/img/logo/logo2.jpg" alt="product banner"> -->
                        </a>
                        <!-- <div class="banner-content text-right">
                            <h5 class="banner-text1">BEAUTIFUL</h5>
                            <h2 class="banner-text2">Wedding<span>Rings</span></h2>
                            <a href="shop.html" class="btn btn-text">Shop Now</a>
                        </div> -->
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <!-- <img src="assets/img/logo/logo2.jpg" alt="product banner"> -->
                        </a>
                        <!-- <div class="banner-content text-center">
                            <h5 class="banner-text1">EARRINGS</h5>
                            <h2 class="banner-text2">Tangerine Floral <span>Earring</span></h2>
                            <a href="shop.html" class="btn btn-text">Shop Now</a>
                        </div> -->
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- banner statistics area end -->

    <!-- product area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm của shop</h2>
                        <p class="sub-title">Sản phẩm được cập nhật liên tục</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">

                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <?php foreach ($listSanPham as $key => $sanPham): ?>
                                        <!-- product item start -->
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a
                                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                    <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh']; ?>"
                                                        alt="product">
                                                    <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh']; ?>"
                                                        alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);

                                                    if ($tinhNgay->days <= 7) { ?>
                                                        <div class="product-label new">
                                                            <span>Mới</span>
                                                        </div>
                                                    <?php } ?>

                                                    <?php
                                                    if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <div class="product-label discount">
                                                            <span>Giảm giá</span>
                                                        </div>
                                                    <?php } ?>
                                                </div>

                                                <div class="cart-hover">
                                                    <button class="btn btn-cart">Chi tiết</button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <h6 class="product-name">
                                                    <a
                                                        href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                                </h6>
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
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product item end -->
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->
    <section class="feature-product section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Các sản phẩm được mua nhiều nhất</h2>
                        
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                        <!-- product item start -->
                        <div class="product-item">
                            <figure class="product-thumb">
                                
                                    <img class="pri-img" src="assets/img/product/product-6.jpg" alt="product">
                                    <img class="sec-img" src="assets/img/product/product-13.jpg" alt="product">
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>Trà sữa nhiệt đới</span>
                                    </div>
                                    <div class="product-label discount">
                                        <span>10%</span>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                class="pe-7s-search"></i></span></a>
                                </div>
                                <div class="cart-hover">
                                    <button class="btn btn-cart">Mua</button>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                    
                                </div>
                                
                                <h6 class="product-name">
                                    Trà sữa không đường</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">25.00đ</span>
                                    <span class="price-old"><del>30.00đ</del></span>
                                </div>
                            </div>
                        </div>
                        <!-- product item end -->

                        <!-- product item start -->
                        <div class="product-item">
                            <figure class="product-thumb">
                               
                                    <img class="pri-img" src="assets/img/product/product-10.jpg" alt="product">
                                    <img class="sec-img" src="assets/img/product/product-13.jpg" alt="product">
                                </a>
                                <div class="product-badge">
                                    
                                    <div class="product-label discount">
                                        <span>Trà sữa</span>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                class="pe-7s-search"></i></span></a>
                                </div>
                                <div class="cart-hover">
                                    <button class="btn btn-cart">Mua</button>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                   
                                </div>
                                
                                <h6 class="product-name">
                                Trà sữa</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">30.00đ</span>
                                    <span class="price-old"><del>40.00đ</del></span>
                                </div>
                            </div>
                        </div>
                        <!-- product item end -->

                        <!-- product item start -->
                        <div class="product-item">
                            <figure class="product-thumb">
                                
                                    <img class="pri-img" src="assets/img/product/product-8.jpg" alt="product">
                                    <img class="sec-img" src="assets/img/product/product-13.jpg" alt="product">
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>Trà sữa</span>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                class="pe-7s-search"></i></span></a>
                                </div>
                                <div class="cart-hover">
                                    <button class="btn btn-cart">Mua</button>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                    
                                </div>
                                
                                <h6 class="product-name">
                                Trà sữa</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">25.00đ</span>
                                    <span class="price-old"><del></del></span>
                                </div>
                            </div>
                        </div>
                        <!-- product item end -->

                        <!-- product item start -->
                        <div class="product-item">
                            <figure class="product-thumb">
                                
                                    <img class="pri-img" src="assets/img/product/product-16.jpg" alt="product">
                                    <img class="sec-img" src="assets/img/product/product-10.jpg" alt="product">
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>Trà sữa</span>
                                    </div>
                                    <div class="product-label discount">
                                        <span>15%</span>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                class="pe-7s-search"></i></span></a>
                                </div>
                                <div class="cart-hover">
                                    <button class="btn btn-cart">Mua</button>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                   
                                </div>
                               
                                <h6 class="product-name">
                                Trà sữa</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">35.00đ</span>
                                    <span class="price-old"><del>45.00đ</del></span>
                                </div>
                            </div>
                        </div>
                        <!-- product item end -->

                        <!-- product item start -->
                        <div class="product-item">
                            <figure class="product-thumb">
                                
                                    <img class="pri-img" src="assets/img/product/product-10.jpg" alt="product">
                                    <img class="sec-img" src="assets/img/product/product-9.jpg" alt="product">
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>Trà sữa</span>
                                    </div>
                                    <div class="product-label discount">
                                        <span>20%</span>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                class="pe-7s-search"></i></span></a>
                                </div>
                                <div class="cart-hover">
                                    <button class="btn btn-cart">Mua</button>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                    
                                </div>
                                
                                <h6 class="product-name">
                                Trà sữa</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">30.00đ</span>
                                    <span class="price-old"><del>35.00đ</del></span>
                                </div>
                            </div>
                        </div>
                        <!-- product item end -->

                        <!-- product item start -->
                        <div class="product-item">
                            <figure class="product-thumb">
                                
                                    <img class="pri-img" src="assets/img/product/product-6.jpg" alt="product">
                                    <img class="sec-img" src="assets/img/product/product-13.jpg" alt="product">
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>Trà sữa</span>
                                    </div>
                                    <div class="product-label discount">
                                        <span>10%</span>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                class="pe-7s-search"></i></span></a>
                                </div>
                                <div class="cart-hover">
                                    <button class="btn btn-cart">Mua</button>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                   
                                </div>
                                
                                <h6 class="product-name">
                                Trà sữa</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">40.00đ</span>
                                    <span class="price-old"><del>45.00đ</del></span>
                                </div>
                            </div>
                        </div>
                        <!-- product item end -->

                        <!-- product item start -->
                        <div class="product-item">
                            <figure class="product-thumb">
                                
                                    <img class="pri-img" src="assets/img/product/product-2.jpg" alt="product">
                                    <img class="sec-img" src="assets/img/product/product-17.jpg" alt="product">
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>Trà sữa</span>
                                    </div>
                                    <div class="product-label discount">
                                        <span>Trà sữa</span>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                class="pe-7s-search"></i></span></a>
                                </div>
                                <div class="cart-hover">
                                    <button class="btn btn-cart">Mua</button>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                   
                                </div>
                                
                                <h6 class="product-name">
                                Trà sữa</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">25.00đ</span>
                                    <span class="price-old"><del>35.00đ</del></span>
                                </div>
                            </div>
                        </div>
                        <!-- product item end -->

                        <!-- product item start -->
                        <div class="product-item">
                            <figure class="product-thumb">
                                
                                    <img class="pri-img" src="assets/img/product/product-3.jpg" alt="product">
                                    <img class="sec-img" src="assets/img/product/product-16.jpg" alt="product">
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>Trà sữa</span>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                class="pe-7s-search"></i></span></a>
                                </div>
                                <div class="cart-hover">
                                    <button class="btn btn-cart">Mua</button>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                   
                                </div>
                               
                                <h6 class="product-name">
                                Trà sữa</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">25.00đ</span>
                                    <span class="price-old"><del></del></span>
                                </div>
                            </div>
                        </div>
                        <!-- product item end -->

                        <!-- product item start -->
                        <div class="product-item">
                            <figure class="product-thumb">
                                
                                    <img class="pri-img" src="assets/img/product/product-13.jpg" alt="product">
                                    <img class="sec-img" src="assets/img/product/product-13.jpg" alt="product">
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>Trà sữa</span>
                                    </div>
                                    <div class="product-label discount">
                                        <span>15%</span>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                class="pe-7s-search"></i></span></a>
                                </div>
                                <div class="cart-hover">
                                    <button class="btn btn-cart">Mua</button>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                    
                                </div>

                                <h6 class="product-name">
                                    Trà sữa muối</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">25.00đ</span>
                                    <span class="price-old"><del>35.00đ</del></span>
                                </div>
                            </div>
                        </div>
                        <!-- product item end -->

                        <!-- product item start -->
                        <div class="product-item">
                            <figure class="product-thumb">
                                
                                    <img class="pri-img" src="assets/img/product/product-13.jpg" alt="product">
                                    <img class="sec-img" src="assets/img/product/product-14.jpg" alt="product">
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>Trà sữa</span>
                                    </div>
                                    <div class="product-label discount">
                                        <span>20%</span>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                class="pe-7s-search"></i></span></a>
                                </div>
                                <div class="cart-hover">
                                    <button class="btn btn-cart">Mua</button>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                    
                                </div>
                                
                                <h6 class="product-name">
                                    Trà sữa chân trâu</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">30.00đ</span>
                                    <span class="price-old"><del>45.00đ</del></span>
                                </div>
                            </div>
                        </div>
                        <!-- product item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- featured product area end -->

    <!-- testimonial area start -->
    
    <!-- testimonial area end -->

    <!-- group product start -->
    <section class="group-product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="group-product-banner">
                        <figure class="banner-statistics">
                            <a href="#">
                                <img src="assets/img/banner/prii.png" alt="product banner">
                            </a>
                            <div class="banner-content banner-content_style3 text-center">
                               
                               
                            </div>
                        </figure>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories-group-wrapper">
                        <!-- section title start -->
                        <div class="section-title-append">
                            <h4>Best seller</h4>
                            <div class="slick-append"></div>
                        </div>
                        <!-- section title start -->

                        <!-- group list carousel start -->
                        <div class="group-list-item-wrapper">
                            <div class="group-list-carousel">
                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-1.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa socola</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">25.00đ</span>
                                                <span class="price-old"><del>30.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-3.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa nhài sữa</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">30.00đ</span>
                                                <span class="price-old"><del>35.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-5.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa chân trâu</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">30.00đ</span>
                                                <span class="price-old"><del>35.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-7.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa hồng đào</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">20.00đ</span>
                                                <span class="price-old"><del>25.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-13.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa đài loan</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">40.00đ</span>
                                                <span class="price-old"><del>45.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-11.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa nhãn</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">30.00đ</span>
                                                <span class="price-old"><del>35.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-13.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">30.00đ</span>
                                                <span class="price-old"><del>40.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-15.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa trắng</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">30.00đ</span>
                                                <span class="price-old"><del>35.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->
                            </div>
                        </div>
                        <!-- group list carousel start -->
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories-group-wrapper">
                        <!-- section title start -->
                        <div class="section-title-append">
                            <h4>Sale</h4>
                            <div class="slick-append"></div>
                        </div>
                        <!-- section title start -->

                        <!-- group list carousel start -->
                        <div class="group-list-item-wrapper">
                            <div class="group-list-carousel">
                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-17.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa chân trâu</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">35.00đ</span>
                                                <span class="price-old"><del>40.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-16.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa đen</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">30.00đ</span>
                                                <span class="price-old"><del>35.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-10.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa nhài sữa</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">35.00đ</span>
                                                <span class="price-old"><del>45.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-11.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa đào</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">40.00đ</span>
                                                <span class="price-old"><del>50.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-7.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa hồng nhãn</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">30.00đ</span>
                                                <span class="price-old"><del>40.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-2.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa nhãn</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">20.00đ</span>
                                                <span class="price-old"><del>35.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-18.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa sầu riêng</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">40.00đ</span>
                                                <span class="price-old"><del>45.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->

                                <!-- group list item start -->
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            
                                                <img src="assets/img/product/product-14.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name">
                                                    Trà sữa</a></h5>
                                            <div class="price-box">
                                                <span class="price-regular">20.00đ</span>
                                                <span class="price-old"><del>30.00đ</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group list item end -->
                            </div>
                        </div>
                        <!-- group list carousel start -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- group product end -->

    <!-- latest blog area start -->
   
    <!-- latest blog area end -->

    <!-- brand logo area start -->
    <div class="brand-logo section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-logo-carousel slick-row-10 slick-arrow-style">
                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/5.jpg" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/6.jpg" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/5.jpg" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/6.jpg" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/5.jpg" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/6.jpg" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="service-policy section-padding">
        <div class="container">
            <div class="row mtn-30">
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-plane"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Giao hàng</h6>
                            <p>Miễn phí giao hàng</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-help2"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hỗ trợ</h6>
                            <p>Hỗ trợ 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-back"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hoàn tiền</h6>
                            <p>Hoàn tiền trong 30 ngày khi lỗi</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-credit"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Thanh toán</h6>
                            <p>Bảo mật thanh toán</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand logo area end -->
</main>





<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php' ?>