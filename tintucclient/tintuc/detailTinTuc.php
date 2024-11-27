<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>

<main>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="index.php?act=danh-sach-tin-tuc">Tin Tức</a></li>
                                <li class="breadcrumb-item active"><?= htmlspecialchars($post['tieu_de']) ?></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <article class="news-detail">
                <h1 class="news-title"><?= htmlspecialchars($post['tieu_de']) ?></h1>
                
                <div class="news-meta">
                    <span class="news-date">
                        <i class="far fa-calendar-alt"></i>
                        <?= date('d/m/Y', strtotime($post['ngay_dang'])) ?>
                    </span>
                </div>

                <?php if (!empty($post['anh'])): ?>
                    <div class="news-featured-image">
                        <img src="<?= htmlspecialchars($post['anh']) ?>" 
                             alt="<?= htmlspecialchars($post['tieu_de']) ?>">
                    </div>
                <?php endif; ?>

                <div class="news-content">
                    <?= nl2br(htmlspecialchars($post['noi_dung'])) ?>
                </div>

                <div class="news-footer">
                    <a href="index.php?act=danh-sach-tin-tuc" class="btn-back">
                        </i> Quay lại danh sách
                    </a>
                </div>
            </article>
        </div>
    </div>
</main>

<style>
.news-detail {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
}

.news-title {
    font-size: 2rem;
    color: #333;
    margin-bottom: 1rem;
    line-height: 1.4;
}

.news-meta {
    color: #666;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.news-date {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.news-featured-image {
    margin: 2rem 0;
    border-radius: 8px;
    overflow: hidden;
}

.news-featured-image img {
    width: 100%;
    height: auto;
    display: block;
}

.news-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #444;
    margin-bottom: 2rem;
}

.news-footer {
    margin-top: 3rem;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: #c29958;
    color: #fff;
    border-radius: 4px;
    text-decoration: none;
    transition: background 0.3s ease;
}

.btn-back:hover {
    background: #b38a49;
}

@media (max-width: 768px) {
    .news-detail {
        padding: 1rem;
        margin: 1rem;
    }

    .news-title {
        font-size: 1.5rem;
    }

    .news-content {
        font-size: 1rem;
    }
}
</style>

<?php require_once 'views/layout/footer.php'; ?>