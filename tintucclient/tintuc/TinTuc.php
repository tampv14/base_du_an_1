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
                                <li class="breadcrumb-item active">Tin Tức</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="news-container">
                <h1 class="news-main-title">Tin Tức & Sự Kiện</h1>
                
                <?php if (!empty($news)): ?>
                    <div class="news-featured">
                        <?php 
                        $featuredNews = array_shift($news);
                        ?>
                        <div class="featured-card">
                            <?php if (!empty($featuredNews['anh'])): ?>
                                <div class="featured-image">
                                    <img src="<?= htmlspecialchars($featuredNews['anh']) ?>" 
                                         alt="<?= htmlspecialchars($featuredNews['tieu_de']) ?>">
                                </div>
                            <?php endif; ?>
                            <div class="featured-content">
                                <span class="featured-label">Tin Nổi Bật</span>
                                <h2 class="featured-title">
                                    <a href="index.php?act=chi-tiet-tin-tuc&id=<?= htmlspecialchars($featuredNews['id']) ?>">
                                        <?= htmlspecialchars($featuredNews['tieu_de']) ?>
                                    </a>
                                </h2>
                                <p class="featured-excerpt">
                                    <?= nl2br(htmlspecialchars(substr($featuredNews['noi_dung'], 0, 300))) ?>...
                                </p>
                                <div class="featured-meta">
                                    <span class="news-date">
                                        <i class="far fa-calendar-alt"></i>
                                        <?= date('d/m/Y', strtotime($featuredNews['ngay_dang'])) ?>
                                    </span>
                                    <a href="index.php?act=chi-tiet-tin-tuc&id=<?= htmlspecialchars($featuredNews['id']) ?>" 
                                       class="btn-read-more">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="news-grid">
                        <?php foreach ($news as $item): ?>
                            <div class="news-card">
                                <?php if (!empty($item['anh'])): ?>
                                    <div class="news-image">
                                        <img src="<?= htmlspecialchars($item['anh']) ?>" 
                                             alt="<?= htmlspecialchars($item['tieu_de']) ?>">
                                    </div>
                                <?php endif; ?>
                                
                                <div class="news-content">
                                    <h3 class="news-title">
                                        <a href="index.php?act=chi-tiet-tin-tuc&id=<?= htmlspecialchars($item['id']) ?>">
                                            <?= htmlspecialchars($item['tieu_de']) ?>
                                        </a>
                                    </h3>
                                    <p class="news-excerpt">
                                        <?= nl2br(htmlspecialchars(substr($item['noi_dung'], 0, 150))) ?>...
                                    </p>
                                    <div class="news-meta">
                                        <span class="news-date">
                                            <i class="far fa-calendar-alt"></i>
                                            <?= date('d/m/Y', strtotime($item['ngay_dang'])) ?>
                                        </span>
                                        <a href="index.php?act=chi-tiet-tin-tuc&id=<?= htmlspecialchars($item['id']) ?>" 
                                           class="btn-read-more">
                                            Xem thêm
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-news">
                        <p>Hiện chưa có tin tức nào!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<style>
.news-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.news-main-title {
    font-size: 2.5rem;
    color: #333;
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
}

.news-main-title:after {
    content: '';
    display: block;
    width: 80px;
    height: 4px;
    background: linear-gradient(to right, #c29958, #b38a49);
    margin: 1rem auto;
    border-radius: 2px;
}

.news-featured {
    margin-bottom: 4rem;
}

.featured-card {
    display: flex;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.featured-image {
    flex: 0 0 50%;
    position: relative;
    overflow: hidden;
}

.featured-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.featured-card:hover .featured-image img {
    transform: scale(1.05);
}

.featured-content {
    flex: 1;
    padding: 2rem;
    display: flex;
    flex-direction: column;
}

.featured-label {
    display: inline-block;
    background: #c29958;
    color: #fff;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.featured-title {
    font-size: 1.8rem;
    margin-bottom: 1rem;
}

.featured-title a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.featured-title a:hover {
    color: #c29958;
}

.featured-excerpt {
    color: #666;
    line-height: 1.8;
    margin-bottom: 2rem;
    flex-grow: 1;
}

.featured-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
}

.news-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
}

.news-card:hover {
    transform: translateY(-5px);
}

.news-image {
    height: 200px;
    overflow: hidden;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.news-card:hover .news-image img {
    transform: scale(1.05);
}

.news-content {
    padding: 1.5rem;
}

.news-title {
    font-size: 1.25rem;
    margin-bottom: 1rem;
}

.news-title a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.news-title a:hover {
    color: #c29958;
}

.news-excerpt {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.news-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.news-date {
    color: #888;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-read-more {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #c29958;
    color: #fff;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.btn-read-more:hover {
    background: #b38a49;
    transform: translateX(5px);
}

.no-news {
    text-align: center;
    padding: 3rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

.no-news p {
    color: #666;
    font-size: 1.1rem;
}

@media (max-width: 992px) {
    .featured-card {
        flex-direction: column;
    }

    .featured-image {
        height: 300px;
    }

    .news-main-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .news-grid {
        grid-template-columns: 1fr;
    }

    .featured-title {
        font-size: 1.5rem;
    }

    .news-main-title {
        font-size: 1.8rem;
    }
}
</style>

<?php require_once 'views/layout/footer.php'; ?>