<?php
require_once __DIR__ . '/admin/config.php';

if (!isset($conn) || !($conn instanceof mysqli)) {
    die('Database connection not available.');
}

$article_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$article = null;

if ($article_id > 0) {
    $stmt = $conn->prepare("SELECT id, title, content, featured_image, author, publish_date FROM news_articles WHERE is_published = 1 AND id = ? LIMIT 1");
    $stmt->bind_param("i", $article_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $article = $result->fetch_assoc();
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
    <link href="./fonts/nunito.css" rel="stylesheet" />
    <link href="./vendor/aos/aos.css" rel="stylesheet" />
    <script src="./vendor/aos/aos.js"></script>
    <link type="text/css" href="./css/fermions-payload.css?v=1704724204" rel="stylesheet" />
    <link type="text/css" href="./css/bosons-payload.css?v=1686344492" rel="stylesheet" />
    <link type="text/css" href="./vendor/mediaelement/mediaelementplayer.min.css?v=1686344493" rel="stylesheet" />
    <link type="text/css" href="./css/sj._cmsfrontend.css?v=1686344492" rel="stylesheet" />
    <link type="text/css" href="./css/sj.sitesfrontend.css?v=1686344492" rel="stylesheet" />
    <link type="text/css" href="./css/print.css?v=1686344492" rel="stylesheet" media="print" />
    <link type="text/css" id="theme-stylesheet" href="./bespokethemes/pebbles_deluxe_theme/css/core.css?v=1697188321" rel="stylesheet" />
    <link type="text/css" id="theme-stylesheet" href="./bespokethemes/pebbles_deluxe_theme/css/calendar.css?v=1697112485" rel="stylesheet" />
    <link type="text/css" id="theme-stylesheet" href="./bespokethemes/pebbles_deluxe_theme/css/hamburgers.css?v=1697112485" rel="stylesheet" />
    <link type="text/css" id="theme-stylesheet" href="./bespokethemes/pebbles_deluxe_theme/css/slick.css?v=1697112485" rel="stylesheet" />
    <link type="text/css" id="theme-stylesheet" href="./bespokethemes/pebbles_deluxe_theme/css/slick-theme.css?v=1697112485" rel="stylesheet" />
    <link type="text/css" id="theme-stylesheet" href="./bespokethemes/pebbles_deluxe_theme/css/mobile_nav_core.css?v=1697112485" rel="stylesheet" />
    <link type="text/css" id="theme-stylesheet" href="./bespokethemes/pebbles_deluxe_theme/css/mobile_nav_layout.css?v=1697112485" rel="stylesheet" />
    <link type="text/css" id="theme-stylesheet" href="./bespokethemes/pebbles_deluxe_theme/css/layout.css?v=1699015231" rel="stylesheet" />
    <link type="text/css" id="theme-stylesheet" href="./bespokethemes/pebbles_deluxe_theme/css/mobile-layout.css?v=1698664610" rel="stylesheet" />
    <script>
        var i18nLang = 'en-gb';
    </script>
    <script type="text/javascript" src="./js/payloads/sun-payload.js?v=1748503802"></script>
    <script type="text/javascript" src="./js/payloads/venus-payload.js?v=1732008004"></script>
    <script type="text/javascript" src="./js/sj.sitesfrontend.js?v=1686344493"></script>
    <script type="text/javascript" src="./bespokethemes/pebbles_deluxe_theme/js/detectr.min.js?v=1697112486"></script>
    <script type="text/javascript" src="./bespokethemes/pebbles_deluxe_theme/js/default.js?v=1697112486"></script>
    <script type="text/javascript" src="./bespokethemes/pebbles_deluxe_theme/js/dropdown.js?v=1697112486"></script>
    <script type="text/javascript" src="./bespokethemes/pebbles_deluxe_theme/js/jquery.slicknav.js?v=1697112486"></script>
    <script type="text/javascript" src="./bespokethemes/pebbles_deluxe_theme/js/slideshow-built-in.js?v=1697112486"></script>
    <script type="text/javascript" src="./bespokethemes/pebbles_deluxe_theme/js/slick.min.js?v=1697112486"></script>
    <script type="text/javascript" src="./bespokethemes/pebbles_deluxe_theme/js/page-load.js?v=1697112486"></script>
    <script type="text/javascript" src="./bespokethemes/pebbles_deluxe_theme/js/aos-config.js?v=1697112486"></script>
    <title>Pebbles Elementary - News Article</title>
    <link rel="canonical" href="./news-article.php<?php echo $article_id ? '?id=' . $article_id : ''; ?>" />
</head>

<body class="page-news-article app-site pebbles_deluxe_theme tenant-type-unknown sj sj_preview has-side-menu">
    <div class="page-wrapper wrapper">
        <div class="page">
            <div class="header-wrapper wrapper">
                <div class="header-inner inner">
                    <div class="header-details">
                        <div class="school-details">
                            <a href="index.php" class="logo-link">
                                <div class="theme-school-logo">
                                    <img src="./img/cdn/logo.png" />
                                </div>
                            </a>
                            <div class="site-name-strap">
                                <h1 class="theme-site-name">Pebbles Elementary</h1>
                                <p class="theme-strap-line">Welcome</p>
                            </div>
                        </div>
                        <div class="right-box">
                            <div class="nav">
                                <ul class="root dropdown">
                                    <li class="item1 first-item">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="item2">
                                        <a href="key-information.php">Key Information</a>
                                    </li>
                                    <li class="item3 parent">
                                        <a href="about-us.php">About Us</a>
                                    </li>
                                    <li class="item4">
                                        <a href="parents.php">Parents</a>
                                    </li>
                                    <li class="item5">
                                        <a href="contact-us.html">Contact Us</a>
                                    </li>
                                    <li class="item6">
                                        <a href="news.php">News</a>
                                    </li>
                                    <li class="item7 last-item">
                                        <a href="gallery.php">Gallery</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-wrapper wrapper">
                <div class="content-inner inner">
                    <div class="content">
                        <div class="bs3-clearfix sj-content-row">
                            <div class="column column-1col">
                                <div class="element element-news">
                                    <div class="sj_element_news">
                                        <?php if ($article) { ?>
                                            <h2 class="news_title"><?php echo htmlspecialchars($article['title']); ?></h2>
                                            <?php
                                            $published_on = $article['publish_date'] ? date('F j, Y', strtotime($article['publish_date'])) : '';
                                            if (!empty($article['author']) || !empty($published_on)) {
                                                echo '<div class="sj_news_text" style="font-size: 0.9em; color: #666; margin-bottom: 12px;">';
                                                echo htmlspecialchars(trim(($article['author'] ?? '') . (!empty($article['author']) && !empty($published_on) ? ' • ' : '') . $published_on));
                                                echo '</div>';
                                            }
                                            ?>
                                            <?php if (!empty($article['featured_image'])) { ?>
                                                <div style="margin: 10px 0 16px;">
                                                    <img src="<?php echo htmlspecialchars($article['featured_image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" style="max-width: 100%; height: auto;" />
                                                </div>
                                            <?php } ?>
                                            <div class="sj_news_text">
                                                <?php echo $article['content']; ?>
                                            </div>
                                            <div class="sj_news_text" style="margin-top: 16px;">
                                                <a href="news.php">&laquo; Back to News</a>
                                            </div>
                                        <?php } else { ?>
                                            <h2 class="news_title">Article not found</h2>
                                            <div class="sj_news_text">This article is unavailable or no longer published.</div>
                                            <div class="sj_news_text" style="margin-top: 16px;">
                                                <a href="news.php">&laquo; Back to News</a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-wrapper wrapper">
                <div class="footer-inner inner">
                    <h2 class="contact">Get in Touch</h2>
                    <div class="footer-container">
                        <div class="footer-left">
                            <div class="footer-left-content">
                                <h1 class="theme-site-name">Pebbles Elementary</h1>
                                <p class="theme-address">
                                    <i class="fa-map-marker fa fa-fw"></i> 1930 Holy Crest,
                                    Mainway Meadows (1st), Waterfalls, Harare
                                </p>
                                <p class="theme-telephone">
                                    <i class="fa-phone fa fa-fw"></i> +263 785 005 471
                                </p>
                                <p class="theme-email">
                                    <i class="fa-envelope fa fa-fw"></i>
                                    pebbleselementary@gmail.com
                                </p>
                            </div>
                        </div>
                        <div id="footer_map"></div>
                    </div>
                </div>
                <div class="awards-inner">
                    <div class="footer-images">
                        <img src="./img/cdn/footer-1-1200x200.jpg" /><img
                            src="./img/cdn/footer-2-1200x200.jpg" /><img src="./img/cdn/footer-3-1200x200.jpg" /><img
                            src="./img/cdn/footer-4-1200x200.jpg" />
                    </div>
                </div>
                <div class="copyright">
                    <span class="theme-copyright">&copy; 2026 Pebbles Elementary</span>.<br /><span class="theme-created-by">
                        <a href="./admin/index.php">Administer Site</a></span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
if (isset($conn)) {
    $conn->close();
}
?>