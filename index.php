<?php
include_once './myadmin/includes/autoloader.inc.php';

include 'config.php';

$login_button = '';

if(!isset($_SESSION['access_token']))
{
    $login_button = '<a href="'.$google_client->createAuthUrl().'">Login With Google</a>';
}

?>
<?php 
if(isset($_SESSION['user_id']))
{
    $x=$_SESSION['user_id'];
}
else{
    $x =bin2hex(random_bytes(8));
}
$key=bin2hex(random_bytes(32));
$token =hash_hmac('sha256',$x,$key);
$_SESSION['csrf_token'] = $token;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Parlay India</title>

    <link rel="icon" href="/realestate/assets/img/favicon.svg" sizes="any" type="image/svg+xml">

    <link href="assets/user-asset/css/styles.css" rel="stylesheet">

    <link href="assets/user-asset/css/colors.css" rel="stylesheet">

    <script src="assets/user-asset/js/jquery.min.js"></script>


</head>

<body class="green-skin">

    <div id="preloader">
        <div class="preloader"><span></span><span></span></div>
    </div>

    <div id="main-wrapper">

        <div class="header header-transparent change-logo">
            <div class="container">
                <nav id="navigation" class="navigation navigation-landscape">

                    <div class="nav-header me-5">
                        <a class="nav-brand static-logo" href="#"><img src="assets/img/parlay-lights.svg" class="logo"
                                alt="" /></a>
                        <a class="nav-brand fixed-logo" href="#"><img src="assets/img/parlay.svg" class="logo"
                                alt="" /></a>
                        <div class=" nav-toggle">
                        </div>
                    </div>
                    <div class="nav-menus-wrapper" style="transition-property: none;">

                        <ul class="nav-menu ">

                            <li class="active"><a href="#">Home<span class="submenu-indicator"></span></a>
                            </li>

                            <li><a href="homes/properties">View Apartments<span class="submenu-indicator"></span></a>
                            </li>

                            <li><a href="homes/about-us">About Us<span class="submenu-indicator"></span></a>
                            </li>

                            <li class=" add-listing light">
                                <a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#contactmodal">
                                    Contact Us</a>
                            </li>

                        </ul>
                        <ul class="nav-menu nav-menu-social align-to-right">
                            <li>
                                <div class="btn-group account-drop">
                                    <?php  if($login_button == ''): ?>
                                    <div class="text-dark badge alert-primary px-3 fw-bold">
                                        <button type="button" class="btn btn-order-by-filt dropdown-toggle active "
                                            id="showbutton">

                                            <div class="agent-photo"><img src="<?=$_SESSION['user_image']?>"
                                                    alt="User avatar" width="30" height="30" style="border-radius:50%;">
                                            </div>&ensp;
                                            <span class="fs-6 text-dark fw-bold ">
                                                Hi, <?=$_SESSION['user_first_name']?></span>

                                        </button>
                                    </div>
                                    <div class="dropdown-menu pull-right animated flipInX" id="showing">
                                        <a href="./homes/favourite-apartments"><i class="ti-bookmark"></i>Favourite
                                            Apartments</a>
                                        <a href="logout">Logout</a>
                                    </div>
                                    <?php else: ?>
                                    <div class="mt-2">
                                        <a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#login"
                                            class="text-dark badge alert-light p-3 fw-bold">
                                            <img src="assets/img/google-icon.svg" width="30" height="20">&ensp;SIGNUP
                                            /
                                            SIGNIN
                                        </a>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </li>
                        </ul>

                    </div>
                </nav>
            </div>
        </div>
        <div class="clearfix"></div>


        <div class="image-bottom hero-banner" data-overlay="0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-md-11 col-sm-12">
                        <div class="inner-banner-text text-center">

                            <h2><span class="font-normal">Find Your</span><span class="text-green"> Dream Home.</span>
                            </h2>
                            <p class="lead-i">Affordable Apartments all across Guwahati
                            </p>
                        </div>


                    </div>

                </div>

            </div>

        </div>
        <div style="position:relative;">
            <div class="custom-shape-divider-bottom-1617184772">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                    preserveAspectRatio="none">
                    <path
                        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                        class="shape-fill"></path>
                </svg>
            </div>
        </div>

        <section>
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-10 text-center">
                        <div class="sec-heading center mb-4">
                            <h2>Real Estate & Builders Company for more than 13+ years ...</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php               
                    $data = new getData();
                    $count=$data->getTotalApartmentCount();
                    ?>

                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="achievement-wrap">
                            <div class="achievement-content">
                                <h4><?= $count ?></h4>
                                <p>Completed Apartments</p>
                            </div>
                        </div>
                    </div>
                    <?php               
                    $data = new getData();
                    $count=$data->getCompletedApartmentCount();
                    ?>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="achievement-wrap">
                            <div class="achievement-content">
                                <h4><?=$count ?></h4>
                                <p>Apartment Sales</p>
                            </div>
                        </div>
                    </div>
                    <?php               
                    $data = new getData();
                    $count=$data->getUnderConstructionApartmentCount();
                    ?>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="achievement-wrap">
                            <div class="achievement-content">
                                <h4><?=$count ?></h4>
                                <p>Apartments Under Construction</p>
                            </div>
                        </div>
                    </div>
                    <?php               
                    $data = new getData();
                    $count=$data->getFutureApartmentCount();
                    ?>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="achievement-wrap">
                            <div class="achievement-content">
                                <h4><?=$count ?></h4>
                                <p>Future Apartments</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </section>
        <div style="position:relative;">
            <div class="custom-shape-divider-top-1617380858">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                    preserveAspectRatio="none">
                    <path
                        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                        class="shape-fill"></path>
                </svg>
            </div>
        </div>

        <div class="clearfix"></div>

        <section class="bg-light" id="featured-apartments">

            <div class="container mt-5">

                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-10 text-center">
                        <div class="sec-heading center mb-4">
                            <h2>Featured Apartments</h2>
                            <p class="mt-2">Our Recent Apartments to buy from !</p>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php               
                                $objj = new getData();
                                $datas=$objj->getFeaturedApartments();
                                foreach($datas as $key=>$data):
                            ?>
                    <div class="col-lg-4 col-md-12">

                        <div class="single-items">
                            <div class="property-listing shadow-sm property-2 border">

                                <div class="listing-img-wrapper">
                                    <div class="list-img-slide">
                                        <div class="click">

                                            <a href="homes/property?pid=<?=$data[$key]['uuid']?>">
                                                <img src="myadmin/upload/<?=$data[$key]['image'] ?>"
                                                    class="img-fluid mx-auto" alt="apartment"
                                                    style="width:100%;height:100%;" /></a>
                                        </div>

                                    </div>
                                </div>

                                <div class="listing-detail-wrapper">
                                    <div class="listing-short-detail-wrap">
                                        <div class="listing-short-detail">

                                            <h4 class="listing-name verified"><a
                                                    href="homes/property?pid=<?=$data[$key]['uuid']?>">
                                                    <?=$data[$key]['apartment_name']; ?>
                                                </a>
                                            </h4>
                                            <span class="property-type">
                                                <?php if($data[$key]['sell_status'] == 'Sold'):?>
                                                <span class="prt-types sale">Status:
                                                    <?=$data[$key]['sell_status']; ?>
                                                </span>
                                                <?php else:?>
                                                <span class="prt-types green-sale">Status:
                                                    <?=$data[$key]['sell_status']; ?>
                                                </span>
                                                <?php endif?>
                                            </span>
                                        </div>
                                        <div class="listing-short-detail-flex">
                                            <h6 class="listing-card-info-price">Price On Request</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="listing-detail-footer">
                                    <div class="footer-first">
                                        <div class="foot-location"><img src="assets/img/pin.svg" width="18"
                                                alt="" /><?=$data[$key]['addr_full']; ?></div>
                                    </div>
                                    <div class="footer-flex">
                                        <a href="homes/property?pid=<?=$data[$key]['uuid']?>" class="prt-view">View</a>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                    <?php endforeach; ?>

                </div>

            </div>

        </section>
        <div style="position:relative;">
            <div class="custom-shape-divider-top-1617381308">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                    preserveAspectRatio="none">
                    <path
                        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                        class="shape-fill"></path>
                </svg>
            </div>
        </div>

        <section class="bg-white">
            <div class="container mt-5">

                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-10 text-center">
                        <div class="sec-heading center">
                            <h2>Explore Apartments</h2>
                        </div>
                    </div>
                </div>

                <div class="row list-layout">
                    <?php               
                                $newobj = new getData();
                                $datas=$newobj->getExploredApartments();
                                foreach($datas as $key=>$data):
                            ?>
                    <!-- Single Property Start -->
                    <div class="col-lg-6 col-md-12">
                        <div class="property-listing property-1">

                            <div class="listing-img-wrapper">
                                <a href="homes/property?pid=<?=$data[$key]['uuid']?>">

                                    <img src="myadmin/upload/<?=$data[$key]['image'] ?>" class="img-fluid mx-auto"
                                        alt="" />
                                </a>
                            </div>

                            <div class="listing-content">

                                <div class="listing-detail-wrapper-box">
                                    <div class="listing-detail-wrapper">
                                        <div class="listing-short-detail">
                                            <h4 class="listing-name"><a
                                                    href="homes/property?pid=<?=$data[$key]['uuid']?>">
                                                    <?=$data[$key]['apartment_name']; ?>
                                                </a></h4>
                                            <?php if($data[$key]['sell_status'] == 'Sold'):?>
                                            <span class="prt-types sale">Status:
                                                <?=$data[$key]['sell_status']; ?>
                                            </span>
                                            <?php else:?>
                                            <span class="prt-types green-sale">Status:
                                                <?=$data[$key]['sell_status']; ?>
                                            </span>
                                            <?php endif?>

                                        </div>
                                        <div class="list-price">
                                            <h6 class="listing-card-info-price"><i class="fas fa-rupee-sign"></i>
                                                On Request
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="price-features-wrapper">
                                    <div class="list-fx-features">
                                        <div class="listing-card-info-icon">
                                            <div class="inc-fleat-icon"><i class="far fa-building"></i>
                                            </div><?=$data[$key]['apt_status']; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="listing-footer-wrapper">
                                    <div class="listing-locate">
                                        <span class="listing-location"><i
                                                class="ti-location-pin"></i><?=$data[$key]['addr_short']?></span>
                                    </div>
                                    <div class="listing-detail-btn">
                                        <a href="homes/property?pid=<?=$data[$key]['uuid']?>" class="more-btn">View</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- Single Property End -->
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <a href="homes/properties" class="btn btn-theme-light rounded">Browse More
                            Properties</a>
                    </div>
                </div>

            </div>
        </section>

        <section class="theme-bg call-to-act-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="call-to-act">
                            <div class="call-to-act-head">
                                <h3>Trouble finding your dream house?</h3>
                                <span>We'll help you to choose the right home for you.</span>
                            </div>
                            <a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#contactmodal"
                                class="btn btn-call-to-act">Get Free Consultation</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <footer class="dark-footer skin-dark-footer">
            <div>
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget">
                                <!-- <img src="assets/img/logo-light.png" class="img-footer" alt="" /> -->
                                <h1 class="text-secondary">Parlay</h1>
                                <div class="footer-add">
                                    <p>Maniram Dewan Road, Bamunimaidan</p>
                                    <p> Guwahati - 781021, Assam, India.</p>
                                    <p>House No 201, Opp Cpwd Office </p>
                                    <p>+91 9678085035 / +91 9678085037</p>
                                    <p><a href="mailto:parlayindia1@gmail.com">parlayindia1@gmail.com</a></p>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget">
                                <h4 class="widget-title">Navigations</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">Home</a></li>

                                    <li><a href="homes/about-us">About Us</a></li>
                                    <li><a href="JavaScript:Void(0);" data-bs-toggle="modal"
                                            data-bs-target="#contactmodal">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget">
                                <h4 class="widget-title">The Highlights</h4>
                                <ul class="footer-menu">
                                    <li><a href="#featured-apartments">View Featured Apartments</a></li>
                                    <li><a href="homes/properties">View All Apartments</a></li>


                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget">
                                <h4 class="widget-title">Account</h4>
                                <ul class="footer-menu">
                                    <?php  if(empty($_SESSION['user_id'])): ?>
                                    <li><a href="JavaScript:Void(0);" data-bs-toggle="modal"
                                            data-bs-target="#login">Login
                                        </a></li>
                                    <?php else: ?>
                                    <li><a href="logout">Logout
                                        </a></li>
                                    <?php endif;?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-4 col-md-4">
                            <p class="mb-0">All Rights Reserved © 2021 Parlay India
                            </p>
                        </div>

                        <div class="col-lg-4 col-md-4 text-right">
                            <ul class="footer-bottom-social">
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                                <li><a href="#"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <p class="mb-0">Designed & Built By
                                <a href="https://devmj.netlify.app" target="_blank">
                                    <span class="text-light hover-overlay">Manash Jyoti Baruah</span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <!-- Log In Modal -->
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content" id="registermodal">
                    <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <h4 class="modal-header-title">Log In</h4>

                        <div class="social-login mb-3">
                            <ul class="d-flex justify-content-center g-signin2">

                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- <i class="fab fa-google" style="color:#DB4437"></i>&ensp; -->
                                        <img src="assets/img/google-icon.svg" width="30" height="20">
                                        <?=$login_button; ?>

                                        </img>
                                    </div>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade signup" id="contactmodal" tabindex="-1" role="dialog" aria-labelledby="hiremodal"
            aria-hidden="true">
            <div class=" modal-sm modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content" id="sign-up">
                    <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <h4 class="modal-header-title">Contact</h4>
                        <div class="login-form">
                            <form role="form" id="contact_form">
                                <input type="hidden" name="csrf_token" id="csrf_token"
                                    value="<?php echo($_SESSION['csrf_token']); ?>">
                                <div class="row">

                                    <div class="col-lg-7 col-md-7">
                                        <div class="form-group">
                                            <label class="required">Name</label>
                                            <input type="text" class="form-control simple" placeholder="Your Name"
                                                name="c_name" id="c_name" required>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">

                                                    <label class="required">Mobile No.</label>
                                                    <input type="tel" class="form-control" placeholder="Your Mobile No."
                                                        maxlength="10" name="c_mobile" id="c_mobile" pattern="\d*"
                                                        oninvalid="this.setCustomValidity('Please Enter Valid Mobile Number')"
                                                        onchange="try{setCustomValidity('')}catch(e){}"
                                                        oninput="setCustomValidity(' ')" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="required">Email</label>
                                                    <input type="email" class="form-control simple"
                                                        placeholder="Your Email Address" name="c_email" id="c_email"
                                                        required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="required">Subject</label>
                                            <input type="text" class="form-control simple"
                                                placeholder="Subject of the Message" name="c_subject" id="c_subject"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label class="required">Message</label>
                                            <textarea class="form-control simple" placeholder="Your Message"
                                                name="c_msg" id="c_msg" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-theme-light-2 rounded" type="submit" id="c_submit"
                                                name="c_submit">Send Message
                                            </button>
                                        </div>

                                    </div>

                                    <div class="col-lg-5 col-md-5">
                                        <div class="contact-info">
                                            <div class="cn-info-detail">
                                                <div class="cn-info-icon">
                                                    <i class="ti-home"></i>&ensp;&ensp;
                                                </div>
                                                <div class="cn-info-content">
                                                    <h4 class="cn-info-title">Reach Us</h4>
                                                    Maniram Dewan Road, Bamunimaidan
                                                    Guwahati - 781021, Assam, India.
                                                    House No 201, Opp Cpwd Office
                                                </div>
                                            </div>

                                            <div class="cn-info-detail">
                                                <div class="cn-info-icon">
                                                    <i class="ti-email"></i>
                                                </div>
                                                <div class="cn-info-content">
                                                    <h4 class="cn-info-title">Drop A Mail
                                                    </h4>
                                                    <a href="mailto:parlayindia1@gmail.com">parlayindia1@gmail.com</a>
                                                </div>
                                            </div>

                                            <div class="cn-info-detail">
                                                <div class="cn-info-icon">
                                                    <i class="ti-mobile"></i>
                                                </div>
                                                <div class="cn-info-content">
                                                    <h4 class="cn-info-title">Call or
                                                        Whatsapp Us</h4>
                                                    +91 9678085035 / +91 9678085037
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>


    </div>

    <div class="position-fixed bottom-0 start-50 translate-middle-x p-3" style="z-index: 5">
        <div id="msg-sent-success-toast" class="toast align-items-center text-white bg-green border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Message Sent Successfully !
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 start-50 translate-middle-x p-3" style="z-index: 5">
        <div id="msg-sent-failed-toast" class="toast align-items-center text-white bg-red border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Message did not Sent !
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="position-fixed bottom-0 start-50 translate-middle-x p-3" style="z-index: 5">
        <div id="msg-csrf-failed-toast" class="toast align-items-center text-white bg-red border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    CSRF Token Mismatch ! Please reload the Page
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
        <div id="signup-success-toast" class="toast align-items-center text-white bg-blue border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Account created Successfully !
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
    function close_login() {
        $('#login').modal('toggle');
    }

    function close_signup() {
        $('#signup').modal('toggle');
    }
    </script>

    <script>
    $(document).ready(function() {
        $("#showbutton").click(function() {
            $("#showing").slideToggle("slow");
        });
    });
    </script>

    <script src="assets/user-asset/js/popper.min.js"></script>
    <script src="assets/user-asset/js/bootstrap.min.js"></script>
    <script src="assets/user-asset/js/rangeslider.js"></script>
    <script src="assets/user-asset/js/select2.min.js"></script>
    <script src="assets/user-asset/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/user-asset/js/slick.js"></script>
    <script src="assets/user-asset/js/slider-bg.js"></script>
    <script src="assets/user-asset/js/lightbox.js"></script>
    <script src="assets/user-asset/js/imagesloaded.js"></script>

    <script src="assets/user-asset/js/ajax-contact-form.js"></script>
    <script src="assets/user-asset/js/custom.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->


</body>

</html>