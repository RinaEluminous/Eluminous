<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/favicon.ico">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- owlcarousel -->
    <link rel="stylesheet" href="assets/owlcarousel/owlcarousel.min.css">
    <!-- style custom css -->
    <link rel="stylesheet" href="css/style.css">
    <title>POS Doctor</title>
    <?php if($_SERVER['HTTP_HOST'] == 'eluminoustechnologies.com' || $_SERVER['HTTP_HOST'] == 'dev.eluminousdev.com'){ ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124927455-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-124927455-1');
    </script>
    <!-- Google Tag Manager -->
    <script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-55PLZGM');
    </script>
    <?php }?>
</head>

<body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-55PLZGM" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- Navigation Start -->
    <header>
        <div class="container">
            <div class="wrapper">
                <div class="logo">
                    <a href="index.php">
                        <img src="images/pos-docor-logo.png" alt="Pos Docor Logo">
                    </a>
                </div>
                <button id="desk_btn" class="desk_btn">
                    <span></span>
                </button>
                <nav class="sidebar">
                    <button id="menu_btn" class="sidebarBtn toggle">
                        <span></span>
                    </button>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#dashboard">Dashboard</a></li>
                        <li><a href="#avg_customer">Avg Customer Results</a></li>
                        <li><a href="#why_pos">Why Pos Doctor</a></li>
                        <li><a href="#testimonials">Testimonials</a></li>
                        <li><a href="#casestudy">Case Studies</a></li>
                        <li><a href="#faq">FAQ</a></li>
                        <li><a href="#get_in">Get In Touch</a></li>
                    </ul>
                </nav>
                <div class="menu_overlay"></div>
            </div>
        </div>
    </header>
    <!-- Navigation End -->