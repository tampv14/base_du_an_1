<?php require_once 'views/layout/header.php'; ?>

<?php require_once 'views/layout/menu.php'; ?>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-padding">
        <div class="container" style="max-width: 40vw">
            <div class="member-area-from-wrap">
                <div class="row">
                    <!-- Login Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap">
                            <h5 class="text-center"> Liên Hệ</h5>
                            <?php if (isset($_SESSION['error'])) { ?>
                                <p class="text-danger login-box-msg text-center"><?= $_SESSION['error']; ?></p>
                            <?php } else { ?>
                               
                            <?php } ?>
                            <form action="<?= BASE_URL . '?act=them-lien-he' ?>" method="post">
                                <div class="single-input-item">
                                    <label for="email">Email:</label>
                                    <input type="email" placeholder="Email or Username" name="email" required />
                                </div>
                                <div class="single-input-item">
                                    <!-- <input type="noi_dung" placeholder="Enter your Noi dung" name="noi_dung" required /> -->
                                    <label for="noi_dung">Nội dung:</label>
                                    <textarea id="noi_dung" placeholder="Enter your Noi dung" name="noi_dung" rows="4"
                                        required></textarea>
                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn-sqr">Gửi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Login Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
</main>



               
               
            </div>
        </div>
    </div>
</div>
<!-- offcanvas mini cart end -->

<?php require_once 'views/layout/footer.php'; ?>