<?php
// Include minimal config for database connection only
// This is a simplified version for the public-facing gallery page
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'pebbles_elementary';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Database connection failed");
}

// Fetch all gallery sections with their photos
$sections = $conn->query("SELECT * FROM gallery_sections ORDER BY display_order");
$gallery_data = [];
if ($sections && $sections->num_rows > 0) {
    while ($section = $sections->fetch_assoc()) {
        $photos = $conn->query("SELECT * FROM gallery_photos WHERE section_id = " . $section['id'] . " ORDER BY display_order");
        $section['photos'] = [];
        if ($photos && $photos->num_rows > 0) {
            while ($photo = $photos->fetch_assoc()) {
                $section['photos'][] = $photo;
            }
        }
        $gallery_data[] = $section;
    }
}
$conn->close();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="ie lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="ie ie7"> <![endif]-->
<!--[if IE 8]>         <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9|!IE]><!-->
<html>
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
    <link href="./fonts/nunito.css" rel="stylesheet" />
    <link href="./vendor/aos/aos.css" rel="stylesheet" />
    <script src="./vendor/aos/aos.js"></script>
    <link
        type="text/css"
        href="./css/fermions-payload.css?v=1704724204"
        rel="stylesheet" />
    <link
        type="text/css"
        href="./css/bosons-payload.css?v=1686344492"
        rel="stylesheet" />
    <link
        type="text/css"
        href="./vendor/mediaelement/mediaelementplayer.min.css?v=1686344493"
        rel="stylesheet" />
    <link
        type="text/css"
        href="./css/sj._cmsfrontend.css?v=1686344492"
        rel="stylesheet" />
    <link
        type="text/css"
        href="./css/sj.sitesfrontend.css?v=1686344492"
        rel="stylesheet" />
    <link
        type="text/css"
        href="./css/print.css?v=1686344492"
        rel="stylesheet"
        media="print" />
    <!--[if lt IE 10
      ]><link
        type="text/css"
        href="./css/main.css?v=1686344492"
        rel="stylesheet"
      />
    <![endif]-->
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/core.css?v=1697188321"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/calendar.css?v=1697112485"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/hamburgers.css?v=1697112485"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/slick.css?v=1697112485"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/slick-theme.css?v=1697112486"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/layout.css?v=1697188321"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/mobile-layout.css?v=1697188321"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/mobile_nav_core.css?v=1697112486"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/mobile_nav_layout.css?v=1697112486"
        rel="stylesheet" />
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/default.js?v=1697112486"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/detectr.min.js?v=1697112485"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/dropdown.js?v=1697112486"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/jquery.slicknav.js?v=1697112486"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/slideshow-built-in.js?v=1697112486"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/slick.min.js?v=1697112486"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/page-load.js?v=1697112486"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/aos-config.js?v=1697112486"></script>
    <title>Pebbles Elementary - Gallery</title>
    <link rel="canonical" href=".//gallery" />
    <meta name="custom_styles" content="[]" />
    <meta name="static_url" content="./" />
    <meta name="cdn_img_url" content="https://img.cdn.schooljotter2.com/" />
</head>

<body
    class="page-sub-themes app-site pebbles_deluxe_theme tenant-type-unknown sj sj_preview has-side-menu">
    <div class="popup-wrapper" style="display: none">
        <div class="popup-box">
            <i class="fa fa-times-circle" id="closepop"></i>
        </div>
    </div>
    <div class="preloader-wrapper">
        <div class="preloader">
            <div class="lds-grid">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <div class="page-wrapper wrapper">
        <div class="page">
            <div class="header-wrapper wrapper">
                <div class="header-inner inner">
                    <div
                        class="search-bar info-bar"
                        style="display: none"
                        data-identify="search">
                        <div class="search">
                            <form class="form-inline" action="/pages/search" method="GET">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input
                                                    class="site-search"
                                                    type="text"
                                                    name="q"
                                                    value=""
                                                    placeholder="Click to search"
                                                    speech="speech"
                                                    x-webkit-speech="x-webkit-speech"
                                                    onspeechchange="this.form.submit();"
                                                    onwebkitspeechchange="this.form.submit();" />
                                            </td>
                                            <td>
                                                <button
                                                    type="submit"
                                                    name=""
                                                    value="Search"
                                                    class="btn">
                                                    <i class="fa-search fa fa-fw"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <i class="fa fa-times-circle info-close" aria-hidden="true"></i>
                    </div>
                    <div
                        class="tel-bar info-bar"
                        style="display: none"
                        data-identify="telephone">
                        <div class="tel">
                            <div class="contact_heading">Call us on</div>
                            <div class="contact_subheading">+263 785 005 471</div>
                        </div>
                        <i class="fa fa-times-circle info-close" aria-hidden="true"></i>
                    </div>
                    <div
                        class="email-bar info-bar"
                        style="display: none"
                        data-identify="email">
                        <div class="email">
                            <div class="contact_heading">Email us on</div>
                            <div class="contact_subheading">pebbleselementary@gmail.com</div>
                        </div>
                        <i class="fa fa-times-circle info-close" aria-hidden="true"></i>
                    </div>
                    <div class="logo">
                        <a href="index.html" class="logo-img"> </a>
                    </div>
                    <div class="header-content">
                        <nav class="navbar navbar-default navbar-static">
                            <ul class="nav navbar-nav navbar-left">
                                <li>
                                    <a class="item" href="index.html">Home</a>
                                </li>
                                <li>
                                    <a class="item" href="about-us.html">About Us</a>
                                </li>
                                <li>
                                    <a class="item active" href="gallery.html">Gallery</a>
                                </li>
                                <li>
                                    <a class="item" href="key-information.html">Information</a>
                                </li>
                                <li>
                                    <a class="item" href="contact-us.html">Contact</a>
                                </li>
                                <li>
                                    <a class="item" href="parents.html">Parents</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="content-wrapper wrapper">
                <div class="content-header" style="">
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Gallery</li>
                        </ol>
                    </div>
                    <div class="page-header">
                        <div class="inner">
                            <h1 class="page-title">Gallery</h1>
                        </div>
                    </div>
                </div>
                <div class="content-inner inner">
                    <div class="page-content">
                        <div>
                            <div class="page-content-area">
                                <p>Discover the creative highlights and memorable moments from Pebbles Elementary through our gallery.</p>

                                <?php if (!empty($gallery_data)): ?>
                                    <?php foreach ($gallery_data as $section): ?>
                                        <div style="margin-bottom: 40px;">
                                            <h2 style="color: #667eea; margin-bottom: 20px; font-size: 24px;">
                                                <?php echo htmlspecialchars($section['section_name']); ?>
                                            </h2>

                                            <?php if (!empty($section['description'])): ?>
                                                <p style="color: #666; margin-bottom: 20px;">
                                                    <?php echo htmlspecialchars($section['description']); ?>
                                                </p>
                                            <?php endif; ?>

                                            <?php if (!empty($section['photos'])): ?>
                                                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
                                                    <?php foreach ($section['photos'] as $photo): ?>
                                                        <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.3s;">
                                                            <img
                                                                src="<?php echo htmlspecialchars($photo['photo_path']); ?>"
                                                                alt="<?php echo htmlspecialchars($photo['photo_title']); ?>"
                                                                style="width: 100%; height: 250px; object-fit: cover; display: block;" />
                                                            <div style="padding: 15px;">
                                                                <h3 style="margin: 0 0 10px 0; color: #333; font-size: 16px;">
                                                                    <?php echo htmlspecialchars($photo['photo_title']); ?>
                                                                </h3>
                                                                <?php if (!empty($photo['photo_description'])): ?>
                                                                    <p style="margin: 0; color: #666; font-size: 14px;">
                                                                        <?php echo htmlspecialchars($photo['photo_description']); ?>
                                                                    </p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php else: ?>
                                                <p style="color: #999; font-style: italic;">No photos in this section yet.</p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p style="color: #999; text-align: center; margin: 40px 0;">Gallery is currently empty.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-wrapper wrapper">
                <div class="footer-inner inner">
                    <div class="footer-top">
                        <div class="footer-left">
                            <span class="label">Contact us</span>
                        </div>
                        <div class="footer-right">
                            <div class="contact_subheading">+263 785 005 471 | +263 774 347 536</div>
                            <div class="contact_subheading">1930 Holy Crest, Mainway Meadows (1st), Waterfalls, Harare</div>
                            <div class="contact_subheading">pebbleselementary@gmail.com</div>
                        </div>
                    </div>
                    <div class="footer-bottom">
                        <div class="footer-content">
                            <div class="copy-right">© 2024 Pebbles Elementary School. All Rights Reserved.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/sj.sitesfrontend.js"></script>
</body>

</html>