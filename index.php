<!doctype html>
<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '@Fl011326');
define('DB_NAME', 'pebbles_elementary');

// Connect to database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
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
  <!--[if lt IE 10
      ]><link
        type="text/css"
        href="https./css/main.css?v=1686343533"
        rel="stylesheet"
      />
    <![endif]-->
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
  <!--[if lt IE 9]>
      <script src="https./vendor/html5shiv/html5shiv.js?v=1686343533"></script>
      <script src="./ui/vendor/respond/respond.min.js"></script>
      <link
        href="https./vendor/respond/respond-proxy.html"
        id="respond-proxy"
        rel="respond-proxy" />
      <link
        href="./ui/vendor/respond/respond.proxy.gif"
        id="respond-redirect"
        rel="respond-redirect" />
      <script src="./ui/vendor/respond/respond.proxy.js"></script
    ><![endif]-->
  <!--[if lt IE 10]> <![endif]-->
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
  <title>Pebbles Elementary - Home</title>
  <link rel="canonical" href="index.html" />
  <meta name="custom_styles" content="[]" />
  <meta name="static_url" content="https./" />
  <meta name="cdn_img_url" content="" />
</head>

<body
  class="page-main-page page-home app-site pebbles_deluxe_theme tenant-type-unknown sj sj_preview has-side-menu">
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
    <!--         <div class="date-box">Your new design will be uploaded in:
            <div id="counter">...</div>
            <div class="contact_text">Please contact Delivery Team on <br> 0113 3200 750 if you have any queries. </div>
            <div class="close">X</div>
        </div> -->
    <div class="page">
      <div class="header-wrapper wrapper">
        <div class="header-inner inner">
          <div
            class="search-bar info-bar"
            style="display: none"
            data-identify="search">
            <div class="search">
              <form class="form-inline" action="#" method="GET">
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
            <div class="telephone-data">
              <p class="theme-telephone">
                <i class="fa-phone fa fa-fw"></i> +263 785 005 471
              </p>
            </div>
            <i class="fa fa-times-circle info-close" aria-hidden="true"></i>
          </div>
          <div
            class="mail-bar info-bar"
            style="display: none"
            data-identify="mail">
            <div class="mail-data">
              <p class="theme-email">
                <i class="fa-envelope fa fa-fw"></i>
                pebbleselementary@gmail.com
              </p>
            </div>
            <i class="fa fa-times-circle info-close" aria-hidden="true"></i>
          </div>
          <div
            class="translate-bar info-bar"
            style="display: none"
            data-identify="translate">
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
            <script type="text/javascript"></script>

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
              <a href="index.html" class="logo-link">
                <div class="theme-school-logo">
                  <img src="./img/cdn/logo.png" />
                </div>
              </a>
              <div class="site-name-strap">
                <h1 class="theme-site-name">Pebbles Elementary</h1>
                <p class="theme-strap-line">Welcome</p>
              </div>
              <!-- end of site-name-strap -->
            </div>
            <div class="right-box">
              <div class="nav">
                <ul class="root dropdown">
                  <li class="item1 current-item-root first-item current-item">
                    <a href="index.php">Home</a>
                  </li>
                  <li class="item2">
                    <a href="key-information.html">Key Information</a>
                  </li>
                  <li class="item3 parent">
                    <a href="about-us.html">About Us</a>

                  </li>
                  <li class="item4">
                    <a href="parents.php">Parents</a>
                  </li>
                  <li class="item5">
                    <a href="contact-us.html">Contact Us</a>
                  </li>
                  <li class="item6 last-item">
                    <a href="gallery.php">Gallery</a>
                  </li>
                </ul>
              </div>
              <!-- end of nav -->
            </div>
            <!-- end of right-box -->
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
                    <li class="item1 current-item-root first current">
                      <a href="index.html">Home</a>
                    </li>
                    <li class="item2">
                      <a href="key-information.html">Key Information</a>
                    </li>
                    <li class="item3 parent">
                      <a href="about-us.html">About Us</a>
                      <ul>
                        <li class="item1 first last">
                          <a href="#">Staff</a>
                        </li>
                      </ul>
                    </li>
                    <li class="item4">
                      <a href="parents.html">Parents</a>
                    </li>
                    <li class="item5">
                      <a href="contact-us.html">Contact Us</a>
                    </li>
                    <li class="item6 last">
                      <a href="gallery.php">Gallery</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- end of nav mobile -->
          </div>
        </div>
        <!--end of header-inner -->
        <div class="slideshow-wrapper">
          <div id="theme-slideshow">
            <div id="theme-slideshow-images">
              <img src="./img/cdn/slideshow-1920x480.jpg" />
            </div>
          </div>
          <div class="slideshow-content">
            <h5>Welcome to</h5>
            <h1 class="theme-site-name">Pebbles Elementary</h1>
          </div>
        </div>
        <!-- end of slideshow-wrapper -->
      </div>
      <!--end of header-wrapper -->
      <div class="site_quicklinks">
        <div class="site_quicklinks_inner">
          <div
            class="search-btn info-btn"
            title="Search"
            data-identify="search">
            <i class="fa fa-search" aria-hidden="true"></i>
          </div>
          <div
            class="tel-btn info-btn"
            title="Telephone"
            data-identify="telephone">
            <i class="fa fa-phone" aria-hidden="true"></i>
          </div>
          <div
            class="translate-btn info-btn"
            title="Translate"
            data-identify="translate">
            <i class="fa fa-globe" aria-hidden="true"></i>
          </div>
          <div class="mail-btn info-btn" title="Email" data-identify="mail">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </div>
          <div class="theme-social">
            <a
              href="#"
              title="Facebook"
              class="theme-social-icon theme-facebook"
              target="_blank"><span class="fa-stack fa-1x">
                <i class="fa fa-square fa-stack-2x sj-icon-background"></i>
                <i
                  class="fa fa-facebook fa-stack-1x fa-inverse sj-icon-foreground"></i> </span></a><a
              href="#"
              title="Twitter"
              class="theme-social-icon theme-twitter"
              target="_blank"><span class="fa-stack fa-1x">
                <i class="fa fa-square fa-stack-2x sj-icon-background"></i>
                <i
                  class="fa fo-twitter-x fa-stack-1x fa-inverse sj-icon-foreground"></i> </span></a>
          </div>
        </div>
      </div>
      <div class="content-wrapper wrapper">
        <ol class="bs3-breadcrumb">
          <li class="bs3-active">Home</li>
        </ol>
        <div class="content-inner inner">
          <div class="content">
            <div
              id="sj-outer-row-id-1"
              class="bs3-clearfix sj-outer-row sj-outer-row-1 sj-outer-row-odd">
              <div
                class="bs3-clearfix sj-content-row sj-content-row-1 sj-content-row-odd">
                <div class="column column-2col-1">
                  <div id="element_126031428" class="element element-image">
                    <div class="sj_element_image">
                      <div id="sj_element_image_126031428">
                        <img
                          src="./img/assets/welcome-19909469.jpg"
                          alt=""
                          title=""
                          class="sj-block-center"
                          style="" />
                      </div>
                      <script>
                        SJ.CMSFrontend.Elements.image(
                          "sj_element_image_126031428",
                        );
                      </script>
                    </div>
                  </div>
                </div>
                <div class="column column-2col-2">
                  <div id="element_126031425" class="element element-text">
                    <h1>Welcome Message</h1>
                    <p>
                      <span style="font-weight: 400">Welcome to Pebbl Elementary School. This website is designed to give families a warm introduction to our school community and to highlight the activities, values, and learning experiences we offer. Beyond these pages, you will discover a digital window into our classrooms, where we celebrate student growth and keep our families deeply connected to the heartbeat of our school. Whether you are looking for important updates or a glimpse into your child's creative projects, this space is built to support our shared mission: fostering a joyful, inclusive environment where every learner can thrive.
                      </span>
                    </p>
                    <p style="text-align: left">
                      <br /><span style="font-weight: 400">If you have any problems or questions you can contact
                        our support team on </span><a href="mailto:info@pebbleselementary.ac.zw"><span style="font-weight: 400">info@pebbleselementary.ac.zw</span></a><span style="font-weight: 400"> 24 hours a day.</span>
                    </p>
                    <!-- <ul>
                        <li style="text-align: justify">
                          <a
                            href="#"
                            title="Click here for the Colours page"
                            data-link-file-name=""
                            data-element-type="link"
                            >Click here for the Colours page</a
                          >
                        </li> -->
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div
              id="sj-outer-row-id-2"
              class="bs3-clearfix sj-outer-row sj-outer-row-2 sj-outer-row-even">
              <div
                class="bs3-clearfix sj-content-row sj-content-row-2 sj-content-row-even">
                <div class="column column-1col">
                  <div id="element_126031427" class="element element-image">
                    <div class="sj_element_image">
                      <div id="sj_element_image_126031427">
                        <a href="#"><img
                            src="./img/assets/ql1---hare.png"
                            alt="Colours"
                            title="Colours"
                            class="sj-block-center"
                            style="" />
                          <div
                            style="text-align: center"
                            class="sj_element_image_caption sj-block-center">
                            Colours
                          </div>
                        </a>
                      </div>
                      <script>
                        SJ.CMSFrontend.Elements.image(
                          "sj_element_image_126031427",
                        );
                      </script>
                    </div>
                  </div>
                  <div id="element_126031431" class="element element-image">
                    <div class="sj_element_image">
                      <div id="sj_element_image_126031431">
                        <a href="#"><img
                            src="./img/assets/ql2---squirrel.png"
                            alt="Contact Us"
                            title="Contact Us"
                            class="sj-block-center"
                            style="" />
                          <div
                            style="text-align: center"
                            class="sj_element_image_caption sj-block-center">
                            Contact Us
                          </div>
                        </a>
                      </div>
                      <script>
                        SJ.CMSFrontend.Elements.image(
                          "sj_element_image_126031431",
                        );
                      </script>
                    </div>
                  </div>
                  <div id="element_126031432" class="element element-image">
                    <div class="sj_element_image">
                      <div id="sj_element_image_126031432">
                        <a href="about-us.html"><img
                            src="./img/assets/ql3---hedgehog.png"
                            alt="About Us"
                            title="About Us"
                            class="sj-block-center"
                            style="" />
                          <div
                            style="text-align: center"
                            class="sj_element_image_caption sj-block-center">
                            About Us
                          </div>
                        </a>
                      </div>
                      <script>
                        SJ.CMSFrontend.Elements.image(
                          "sj_element_image_126031432",
                        );
                      </script>
                    </div>
                  </div>
                  <div id="element_126031433" class="element element-image">
                    <div class="sj_element_image">
                      <div id="sj_element_image_126031433">
                        <a href="#"><img
                            src="./img/assets/ql4---owl.png"
                            alt="Parents"
                            title="Parents"
                            class="sj-block-center"
                            style="" />
                          <div
                            style="text-align: center"
                            class="sj_element_image_caption sj-block-center">
                            Parents
                          </div>
                        </a>
                      </div>
                      <script>
                        SJ.CMSFrontend.Elements.image(
                          "sj_element_image_126031433",
                        );
                      </script>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              id="sj-outer-row-id-3"
              class="bs3-clearfix sj-outer-row sj-outer-row-3 sj-outer-row-odd">
              <div
                class="bs3-clearfix sj-content-row sj-content-row-3 sj-content-row-odd">
                <div class="column column-1col">
                  <div id="element_126031429" class="element element-news">
                    <div class="sj_element_news">
                      <h2 class="news_title">Latest News</h2>
                      <h3>
                        <a href="#" class="feedlink" target="_blank"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i
                              class="fa fa-rss fa-stack-1x fa-inverse"></i></span></a>
                        <div class="clear"></div>
                      </h3>
                      <ul>
                        <?php
                        // Fetch latest 5 published news articles
                        $sql = "SELECT id, title, content, featured_image, author, publish_date 
                                  FROM news_articles 
                                  WHERE is_published = 1 
                                  ORDER BY publish_date DESC 
                                  LIMIT 5";
                        $result = $conn->query($sql);

                        if ($result && $result->num_rows > 0) {
                          while ($article = $result->fetch_assoc()) {
                            // Strip HTML tags and limit text to first 200 characters
                            $excerpt = strip_tags($article['content']);
                            $excerpt = substr($excerpt, 0, 200);
                            if (strlen(strip_tags($article['content'])) > 200) {
                              $excerpt .= '...';
                            }

                            // Set default image if none exists
                            $image = $article['featured_image'] ? 'admin/' . $article['featured_image'] : './img/cdn/news-thumbnail-500x500.jpg';
                        ?>
                            <li>
                              <div class="sj_news_miniature">
                                <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" />
                              </div>
                              <div class="sj_news_link">
                                <a href="news-article.php?id=<?php echo $article['id']; ?>"><?php echo htmlspecialchars($article['title']); ?></a>
                              </div>
                              <div class="sj_news_text">
                                <?php echo htmlspecialchars($excerpt); ?>
                              </div>
                            </li>
                          <?php
                          }
                        } else {
                          ?>
                          <li>
                            <div class="sj_news_text">
                              No news articles available at this time.
                            </div>
                          </li>
                        <?php
                        }
                        ?>
                      </ul>
                      <a href="#index">Further Articles &raquo;</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              id="sj-outer-row-id-4"
              class="bs3-clearfix sj-outer-row sj-outer-row-4 sj-outer-row-even">
              <div
                class="bs3-clearfix sj-content-row sj-content-row-4 sj-content-row-even">
                <div class="column column-1col">
                  <div id="element_126031426" class="element element-map">
                    <div class="sj_element_map">
                      <div
                        id="sj_element_map_126031426"
                        class="sj-block-center"
                        style="max-width: 100%px; height: 450px"></div>
                      <script>
                        SJ.CMSFrontend.Elements.map(
                          "sj_element_map_126031426",
                          "",
                          "53.796790",
                          "-1.545300",
                        );
                      </script>
                    </div>
                  </div>
                  <div id="element_126031430" class="element element-text">
                    <p>popup-box</p>
                    <p>
                      Welcome to Pebbles Elementary School.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end of content -->
        </div>
        <!--end of content-inner -->
      </div>
      <!--end of content-wrapper -->
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
            <!-- end of footer-left -->
            <div id="footer_map"></div>
          </div>
          <!-- end of footer container -->
          <!--end of footer-inner -->
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
          <script type="text/javascript">
            var disableStr = "ga-disable-wa-cookie-warning";
            if (
              typeof $.cookie("analitics_enabled") === "undefined" ||
              $.cookie("analitics_enabled") !== "1"
            ) {
              window[disableStr] = true;
            }
          </script>

          <section
            id="ccc"
            style="z-index: 9999"
            slider-optin=""
            dark=""
            slideout=""
            left=""
            close-button=""
            custom-branding="">
            <div id="ccc-overlay"></div>

            <button id="ccc-icon" aria-controls="ccc-module" accesskey="c">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                x="0px"
                y="0px"
                viewBox="0 0 72.5 72.5"
                enable-background="new 0 0 72.5 72.5"
                xml:space="preserve">
                <title>Cookie Control Icon</title>
                <g id="triangle">
                  <path d="M0,0l72.5,72.5H0V0z"></path>
                </g>
                <g id="star">
                  <path
                    d="M33.2,51.9l-3.9-2.6l1.6-4.4l-4.7,0.2L25,40.6l-3.7,2.9l-3.7-2.9l-1.2,4.5l-4.7-0.2l1.6,4.4l-3.9,2.6l3.9,2.6l-1.6,4.4l4.7-0.2l1.2,4.5l3.7-2.9l3.7,2.9l1.2-4.5l4.7,0.2l-1.6-4.4L33.2,51.9z M24.6,55.3c-0.3,0.4-0.8,0.8-1.3,1s-1.1,0.3-1.9,0.3c-0.9,0-1.7-0.1-2.3-0.4s-1.1-0.7-1.5-1.4c-0.4-0.7-0.6-1.6-0.6-2.6c0-1.4,0.4-2.5,1.1-3.3c0.8-0.8,1.8-1.1,3.2-1.1c1.1,0,1.9,0.2,2.6,0.7s1.1,1.1,1.4,2L23,50.9c-0.1-0.3-0.2-0.5-0.3-0.6c-0.1-0.2-0.3-0.4-0.5-0.5s-0.5-0.2-0.7-0.2c-0.6,0-1.1,0.2-1.4,0.7c-0.2,0.4-0.4,0.9-0.4,1.7c0,1,0.1,1.6,0.4,2c0.3,0.4,0.7,0.5,1.2,0.5c0.5,0,0.9-0.1,1.2-0.4s0.4-0.7,0.6-1.2l2.3,0.7C25.2,54.3,25,54.8,24.6,55.3z"></path>
                </g>
              </svg>
            </button>

            <div id="ccc-module" role="region">
              <div id="ccc-content">
                <div id="cc-panel" class="ccc-panel ccc-panel-1 visible">
                  <h2 id="ccc-title">Our use of cookies</h2>
                  <p id="ccc-intro">
                    We use necessary cookies to make our site work. We'd also
                    like to set optional analytics cookies to help us improve
                    it. We won't set optional cookies unless you enable them.
                    Using this tool will set a cookie on your device to
                    remember your preferences.
                  </p>
                  <div id="ccc-statement">
                    <p>
                      For more detailed information about the cookies we use,
                      see our
                      <a
                        target="_blank"
                        rel="noopener"
                        href="#"
                        class="ccc-link ccc-tabbable">
                        Cookies page<span class="ccc-svg-element">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            version="1.1"
                            data-icon="external-link"
                            viewBox="0 0 32 40"
                            x="0px"
                            y="0px">
                            <title>Cookie Control Link Icon</title>
                            <path
                              d="M32 0l-8 1 2.438 2.438-9.5 9.5-1.063 1.063 2.125 2.125 1.063-1.063 9.5-9.5 2.438 2.438 1-8zm-30 3c-.483 0-1.047.172-1.438.563-.391.391-.563.954-.563 1.438v25c0 .483.172 1.047.563 1.438.391.391.954.563 1.438.563h25c.483 0 1.047-.172 1.438-.563.391-.391.563-.954.563-1.438v-15h-3v14h-23v-23h15v-3h-16z"></path>
                          </svg>
                        </span>
                      </a>
                    </p>
                  </div>
                  <div id="ccc-button-holder">
                    <button
                      id="ccc-recommended-settings"
                      class="ccc-notify-button ccc-button-solid ccc-tabbable">
                      Accept all cookies
                    </button>
                    <button
                      id="ccc-reject-settings"
                      class="ccc-notify-button ccc-link ccc-tabbable">
                      Reject all cookies
                    </button>
                  </div>
                  <hr />
                  <h3 id="ccc-necessary-title">Necessary cookies</h3>
                  <p id="ccc-necessary-description">
                    Necessary cookies enable core functionality such as
                    security, network management, and accessibility. You may
                    disable these by changing your browser settings, but this
                    may affect how the website functions.
                  </p>
                  <hr />
                  <div id="ccc-optional-categories">
                    <div data-index="0" class="optional-cookie">
                      <h3 class="optional-cookie-header">
                        Analytics cookies
                      </h3>
                      <div class="checkbox-toggle ccc-tabbable">
                        <label
                          for="analytics_cookies"
                          class="checkbox-toggle-label">
                          <span class="invisible" for="analytics_cookies">Analytics cookies toggle</span>
                          <input
                            class="checkbox-toggle-input"
                            type="checkbox"
                            id="analytics_cookies" />
                          <span class="checkbox-toggle-on">On</span>
                          <span class="checkbox-toggle-off">Off</span>
                          <span
                            class="checkbox-toggle-toggle"
                            data-index="0"></span>
                        </label>
                      </div>
                      <p>
                        We'd like to set Google Analytics cookies to help us
                        to improve our website by collecting and reporting
                        information on how you use it. The cookies collect
                        information in a way that does not directly identify
                        anyone. For more information on how these cookies
                        work, please see our 'Cookies page'.
                      </p>
                      <div class="ccc-alert"></div>
                      <hr />
                      <div id="ccc-statement">
                        <p>
                          We use cookies to provide you with the best
                          experience on our website. Read our Privacy Policy
                          to find out more.
                          <a
                            target="_blank"
                            rel="noopener"
                            href="#"
                            class="ccc-link ccc-tabbable">
                            Policy page<span class="ccc-svg-element">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                version="1.1"
                                data-icon="external-link"
                                viewBox="0 0 32 40"
                                x="0px"
                                y="0px">
                                <title>Cookie Control Link Icon</title>
                                <path
                                  d="M32 0l-8 1 2.438 2.438-9.5 9.5-1.063 1.063 2.125 2.125 1.063-1.063 9.5-9.5 2.438 2.438 1-8zm-30 3c-.483 0-1.047.172-1.438.563-.391.391-.563.954-.563 1.438v25c0 .483.172 1.047.563 1.438.391.391.954.563 1.438.563h25c.483 0 1.047-.172 1.438-.563.391-.391.563-.954.563-1.438v-15h-3v14h-23v-23h15v-3h-16z"></path>
                              </svg>
                            </span>
                          </a>
                        </p>
                      </div>
                      <hr />
                    </div>
                  </div>
                  <div id="ccc-end">
                    <div>
                      <button
                        id="ccc-dismiss-button"
                        class="ccc-notify-button ccc-button-solid ccc-tabbable">
                        Save and close
                      </button>
                    </div>
                  </div>
                  <div id="ccc-info" class="ccc-info"></div>
                </div>
              </div>
            </div>
          </section>

          <script>
            (function() {
              var ws = document.createElement("script");
              ws.type = "text/javascript";
              ws.async = true;
            });
          </script>
          <script type="text/javascript">
            var sj2_font_family_list = {
              Poppins: "Poppins"
            };
          </script>
        </div>
      </div>
    </div>
    <!-- end of page -->
  </div>
  <!-- end of page-wrapper -->
  <!-- Jord G -->
</body>

</html>