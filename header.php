<?php
require_once __DIR__ . '/admin/config.php';
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
    <link type="text/css" href="./css/fermions-payload.css" rel="stylesheet" />
    <link type="text/css" href="./css/bosons-payload.css" rel="stylesheet" />
    <link
        type="text/css"
        href="./vendor/mediaelement/mediaelementplayer.min.css"
        rel="stylesheet" />
    <link type="text/css" href="./css/sj._cmsfrontend.css" rel="stylesheet" />
    <link type="text/css" href="./css/sj.sitesfrontend.css" rel="stylesheet" />
    <link
        type="text/css"
        href="./css/print.css"
        rel="stylesheet"
        media="print" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/core.css"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/calendar.css"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/hamburgers.css"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/slick.css"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/slick-theme.css"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/mobile_nav_core.css"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/mobile_nav_layout.css"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/layout.css"
        rel="stylesheet" />
    <link
        type="text/css"
        id="theme-stylesheet"
        href="./bespokethemes/pebbles_deluxe_theme/css/mobile-layout.css"
        rel="stylesheet" />
    <script>
        var i18nLang = "en-gb";
    </script>
    <script type="text/javascript" src="./js/payloads/sun-payload.js"></script>
    <script
        type="text/javascript"
        src="./js/payloads/venus-payload.js"></script>
    <script type="text/javascript" src="./js/sj.sitesfrontend.js"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/detectr.min.js"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/default.js"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/dropdown.js"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/jquery.slicknav.js"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/slideshow-built-in.js"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/slick.min.js"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/page-load.js"></script>
    <script
        type="text/javascript"
        src="./bespokethemes/pebbles_deluxe_theme/js/aos-config.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
    <title>Gallery - Pebbles Elementary</title>
    <link rel="canonical" href="gallery.html" />
</head>

<body
    class="page-gallery-page page-gallery app-site pebbles_deluxe_theme tenant-type-unknown sj sj_preview has-side-menu">
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
                    <div class="search-bar info-bar" style="display: none" data-identify="search">
                        <div class="search">
                            <form class="form-inline" action="#" method="GET">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input class="site-search" type="text" name="q" value="" placeholder="Click to search" speech="speech" x-webkit-speech="x-webkit-speech" onspeechchange="this.form.submit();" onwebkitspeechchange="this.form.submit();" />
                                            </td>
                                            <td>
                                                <button type="submit" name="" value="Search" class="btn">
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
                    <div class="tel-bar info-bar" style="display: none" data-identify="telephone">
                        <div class="telephone-data">
                            <p class="theme-telephone">
                                <i class="fa-phone fa fa-fw"></i> +263 785 005 471
                            </p>
                        </div>
                        <i class="fa fa-times-circle info-close" aria-hidden="true"></i>
                    </div>
                    <div class="mail-bar info-bar" style="display: none" data-identify="mail">
                        <div class="mail-data">
                            <p class="theme-email">
                                <i class="fa-envelope fa fa-fw"></i>
                                pebbleselementary@gmail.com
                            </p>
                        </div>
                        <i class="fa fa-times-circle info-close" aria-hidden="true"></i>
                    </div>
                    <div class="translate-bar info-bar" style="display: none" data-identify="translate">
                        <div class="theme-translate" id="google_translate_element2"></div>
                        <script type="text/javascript">
                            function googleTranslateElementInit2() {
                                new google.translate.TranslateElement({
                                        pageLanguage: "en",
                                        autoDisplay: false,
                                    },
                                    "google_translate_element2",
                                );
                            }
                        </script>
                        <script type="text/javascript">
                            /* <![CDATA[ */
                            eval(
                                (function(p, a, c, k, e, r) {
                                    e = function(c) {
                                        return (
                                            (c < a ? "" : e(parseInt(c / a))) +
                                            ((c = c % a) > 35 ?
                                                String.fromCharCode(c + 29) :
                                                c.toString(36))
                                        );
                                    };
                                    if (!"".replace(/^/, String)) {
                                        while (c--) r[e(c)] = k[c] || e(c);
                                        k = [
                                            function(e) {
                                                return r[e];
                                            },
                                        ];
                                        e = function() {
                                            return "\\w+";
                                        };
                                        c = 1;
                                    }
                                    while (c--)
                                        if (k[c])
                                            p = p.replace(
                                                new RegExp("\\b" + e(c) + "\\b", "g"),
                                                k[c],
                                            );
                                    return p;
                                })(
                                    "6 7(a,b){n{4(2.9){3 c=2.9(\"o\");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s('t'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a=='')v;3 b=a.w('|')[1];3 c;3 d=2.x('y');z(3 i=0;i<d.5;i++)4(d[i].A=='B-C-D')c=d[i];4(2.j('k')==E||2.j('k').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,'m');7(c,'m')}}",
                                    43,
                                    43,
                                    "||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500".split(
                                        "|",
                                    ),
                                    0, {},
                                ),
                            );
                            /* ]]> */
                        </script>
                        <i class="fa fa-times-circle info-close" aria-hidden="true"></i>
                    </div>
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
                                    <li class="item7 last-item current-item">
                                        <a href="gallery.php">Gallery</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="nav-mobile">
                            <div class="menu-btn">
                                <button class="hamburger hamburger--elastic" type="button">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                            <div class="nav-mobile-wrapper">
                                <div class="menu-btn close">
                                    <button class="hamburger hamburger--elastic" type="button">
                                        <span class="hamburger-box">
                                            <span class="hamburger-inner"></span>
                                        </span>
                                    </button>
                                </div>
                                <div class="nav-mobile-inner">
                                    <ul class="root standard">
                                        <li class="item1 first current">
                                            <a href="index.php">Home</a>
                                        </li>
                                        <li class="item2">
                                            <a href="key-information.php">Key Information</a>
                                        </li>
                                        <li class="item3 parent">
                                            <a href="about-us.php">About Us</a>
                                        </li>
                                        <li class="item4">
                                            <a href="parents.html">Parents</a>
                                        </li>
                                        <li class="item5">
                                            <a href="contact-us.html">Contact Us</a>
                                        </li>
                                        <li class="item6">
                                            <a href="news.php">News</a>
                                        </li>
                                        <li class="item7 last">
                                            <a href="gallery.php">Gallery</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slideshow-wrapper">
                    <div id="theme-slideshow">
                        <div id="theme-slideshow-images">
                            <img src="./img/cdn/slideshow-1920x480.jpg" />
                        </div>
                    </div>
                    <div class="slideshow-content">
                        <h5>Browse Our</h5>
                        <h1 class="theme-site-name">Photo Gallery</h1>
                    </div>
                </div>
            </div>
            <div class="site_quicklinks">
                <div class="site_quicklinks_inner">
                    <div class="search-btn info-btn" title="Search" data-identify="search">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                    <div class="tel-btn info-btn" title="Telephone" data-identify="telephone">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </div>
                    <div class="translate-btn info-btn" title="Translate" data-identify="translate">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                    </div>
                    <div class="mail-btn info-btn" title="Email" data-identify="mail">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="theme-social">
                        <a href="#" title="Facebook" class="theme-social-icon theme-facebook" target="_blank"><span class="fa-stack fa-1x">
                                <i class="fa fa-square fa-stack-2x sj-icon-background"></i>
                                <i class="fa fa-facebook fa-stack-1x fa-inverse sj-icon-foreground"></i> </span></a><a href="#" title="Twitter" class="theme-social-icon theme-twitter" target="_blank"><span class="fa-stack fa-1x">
                                <i class="fa fa-square fa-stack-2x sj-icon-background"></i>
                                <i class="fa fo-twitter-x fa-stack-1x fa-inverse sj-icon-foreground"></i> </span></a>
                    </div>
                </div>
            </div>
            <div class="content-wrapper wrapper">

                <div class="content-inner inner">
                    <div class="content">