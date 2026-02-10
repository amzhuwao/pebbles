<?php
require_once __DIR__ . '/admin/config.php';

if (!isset($conn) || !($conn instanceof mysqli)) {
    die('Database connection not available.');
}

// Fetch published news articles
$news_query = "SELECT id, title, content, featured_image, author, publish_date FROM news_articles WHERE is_published = 1 ORDER BY publish_date DESC";
$news_result = $conn->query($news_query);
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
    <title>Pebbles Elementary - News</title>
    <link rel="canonical" href="./news.php" />
    <style>
        .news-cards {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .news-card {
            background: #ffffff;
            border: 1px solid #e6e6e6;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .news-thumb {
            width: 100%;
            height: 180px;
            background: #f3f5f7;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .news-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .news-thumb--empty span {
            color: #9aa0a6;
            font-size: 0.9em;
        }

        .news-card-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            height: 100%;
        }

        .news-card-title a {
            color: #2c2c2c;
            font-weight: 700;
            text-decoration: none;
        }

        .news-card-title a:hover {
            text-decoration: underline;
        }

        .news-card-meta {
            font-size: 0.85em;
            color: #666666;
        }

        .news-card-excerpt {
            color: #444444;
        }

        .news-card-footer {
            margin-top: auto;
        }
    </style>
</head>

<body class="page-news app-site pebbles_deluxe_theme tenant-type-unknown sj sj_preview has-side-menu">
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
                                    <li class="item6 current-item-root current-item">
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
                                        <h2 class="news_title">Latest News</h2>
                                        <ul class="news-cards">
                                            <?php
                                            if ($news_result && $news_result->num_rows > 0) {
                                                while ($news = $news_result->fetch_assoc()) {
                                                    $preview_text = strip_tags($news['content']);
                                                    if (strlen($preview_text) > 240) {
                                                        $preview_text = substr($preview_text, 0, 240) . '...';
                                                    }
                                                    $published_on = $news['publish_date'] ? date('F j, Y', strtotime($news['publish_date'])) : '';
                                                    echo '<li class="news-card">';

                                                    if (!empty($news['featured_image'])) {
                                                        echo '<div class="news-thumb">';
                                                        echo '<img src="' . htmlspecialchars($news['featured_image']) . '" alt="' . htmlspecialchars($news['title']) . '" />';
                                                        echo '</div>';
                                                    } else {
                                                        echo '<div class="news-thumb news-thumb--empty"><span>No image</span></div>';
                                                    }

                                                    echo '<div class="news-card-body">';
                                                    echo '<div class="news-card-title"><a href="news-article.php?id=' . (int)$news['id'] . '">' . htmlspecialchars($news['title']) . '</a></div>';

                                                    if (!empty($news['author']) || !empty($published_on)) {
                                                        echo '<div class="news-card-meta">';
                                                        echo htmlspecialchars(trim(($news['author'] ?? '') . (!empty($news['author']) && !empty($published_on) ? ' • ' : '') . $published_on));
                                                        echo '</div>';
                                                    }

                                                    echo '<div class="news-card-excerpt">' . htmlspecialchars($preview_text) . '</div>';
                                                    echo '<div class="news-card-footer">';
                                                    echo '<a href="news-article.php?id=' . (int)$news['id'] . '">Read more &raquo;</a>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</li>';
                                                }
                                            } else {
                                                echo '<li class="news-card"><div class="news-card-body"><div class="news-card-excerpt">No news articles available at this time.</div></div></li>';
                                            }
                                            ?>
                                        </ul>
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