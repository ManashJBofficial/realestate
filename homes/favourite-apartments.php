<?php
    include '../config.php';
    include_once '../myadmin/classes/dbh.class.php';
    include_once '../myadmin/classes/getData.class.php';
    $login_button = '';

    if(!isset($_SESSION['access_token']))
    {
        $login_button = '<a href="'.$google_client->createAuthUrl().'">Login With Google</a>';
    }
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
?>
<?php 
if(empty($_SESSION['user_id']))
{
    header('Location: ../error/404');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Parlay India</title>
    <link rel="icon" href="/realestate/assets/img/favicon.svg" sizes="any" type="image/svg+xml">

    <link href="../assets/user-asset/css/styles.css" rel="stylesheet">

    <link href="../assets/user-asset/css/colors.css" rel="stylesheet">

</head>

<body class="green-skin dashboard">

    <div id="preloader">
        <div class="preloader"><span></span><span></span></div>
    </div>


    <div id="main-wrapper">


        <div class="header header-light head-shadow">
            <div class="container">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class="nav-header">
                        <a class="nav-brand fixed-logo" href="#"><img src="../assets/img/parlay.svg" class="logo"
                                alt="" /></a>
                        <div class="nav-toggle"></div>
                    </div>
                    <div class="nav-menus-wrapper" style="transition-property: none;">
                        <ul class="nav-menu ">

                            <li><a href="../index">Home<span class="submenu-indicator"></span></a>
                            </li>

                            <li><a href="properties">View Apartments<span class="submenu-indicator"></span></a>
                            </li>

                            <li><a href="about-us">About Us<span class="submenu-indicator"></span></a>
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
                                        <a href="#"><i class="ti-bookmark"></i>Favourite
                                            Apartments</a>
                                        <a href="../logout">Logout</a>
                                    </div>
                                    <?php else: ?>
                                    <div class="mt-2">
                                        <a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#login"
                                            class="text-dark badge alert-primary p-3 fw-bold">Login&ensp;<i
                                                class="fas fa-sign-in-alt "></i></a>
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

        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">

                        <h2 class="ipt-title">Welcome!</h2>
                        <span
                            class="ipn-subtitle"><?=$_SESSION['user_first_name'].' '.$_SESSION['user_last_name']?></span>

                    </div>
                </div>
            </div>
        </div>

        <section class="bg-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="filter_search_opt">
                            <a href="javascript:void(0);" onclick="openFilterSearch()">Dashboard Navigation<i
                                    class="ml-2 ti-menu"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-3 col-md-12">

                        <div class="simple-sidebar sm-sidebar" id="filter_search">

                            <div class="search-sidebar_header">
                                <h4 class="ssh_heading"></h4>
                                <button onclick="closeFilterSearch()" class="w3-bar-item w3-button w3-large"><i
                                        class="ti-close"></i></button>
                            </div>

                            <div class="sidebar-widgets">
                                <div class="dashboard-navbar">

                                    <div class="d-user-avater">
                                        <img src="<?=$_SESSION['user_image']?>" alt="User Avatar" />
                                        <h4><?=$_SESSION['user_first_name'].' '.$_SESSION['user_last_name']?></h4>
                                        <span><?=$_SESSION['user_email_address']?></span>
                                    </div>

                                    <div class="d-navigation">
                                        <ul>
                                            <li class="active"><a href="#"><i class="ti-bookmark"></i>Favourite
                                                    Apartments</a></li>
                                            </li>
                                            <li><a href="../logout"><i class="ti-power-off"></i>Log Out</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12">
                        <div class="dashboard-wraper">

                            <div class="form-submit">
                                <h4>Favourite Apartments</h4>
                            </div>

                            <table class="property-table-wrap responsive-table bkmark">

                                <tbody>
                                    <?php 
                                        $obj = new getData();
                                        $datas=$obj->favApartments();
                                        foreach ($datas as $key => $data):
                                    ?>
                                    <tr>
                                        <td class="property-container <?=$data[$key]['fav_uuid']?>">
                                            <div class="title">
                                                <h4><a class="text-success"
                                                        href="../homes/property?pid=<?=$data[$key]['uuid']?>"><?=$data[$key]['apartment_name']?></a>
                                                </h4>
                                                <span><?=$data[$key]['addr_full']?></span>
                                                <span
                                                    class="table-property-price"><?=$data[$key]['sell_status']?></span>
                                            </div>
                                        </td>
                                        <td class="action <?=$data[$key]['fav_uuid']?>">
                                            <a id="<?=$data[$key]['fav_uuid']?>" class="delete del_apartment"
                                                type="button" onclick="delClick(this.id)"><i class="ti-close"></i>
                                                Remove</a>
                                        </td>

                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php                                    
                                    $newobj = new getData();
                                    $count=$newobj->favApartmentsCount();
                                    if(empty($count))
                                    {
                                        echo "You didn't saved any estates for now. Please save some estates to view here for later.";
                                        
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
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
                                    <li><a href="../index">Home</a></li>
                                    <li><a href="about-us">About Us</a></li>
                                    <li><a href="JavaScript:Void(0);" data-bs-toggle="modal"
                                            data-bs-target="#contactmodal">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget">
                                <h4 class="widget-title">The Highlights</h4>
                                <ul class="footer-menu">
                                    <li><a href="../index#featured-apartments">View Featured Apartments</a></li>
                                    <li><a href="properties">View All Apartments</a></li>


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
                                    <li><a href="../logout">Logout
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
                                        <img src="../assets/img/google-icon.svg" width="30" height="20">
                                        <?=$login_button;?>
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



        <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
    </div>


    <div class="toast-container position-absolute top-0 end-0 p-3">
        <div class="position-fixed bottom-0 start-50 translate-middle-x  p-3" style="z-index: 5">
            <div id="delete-success-toast" class="toast align-items-center text-white bg-red border-0" role="alert"
                aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
                <div class="d-flex">
                    <div class="toast-body">
                        Removed Successfully !
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/user-asset/js/jquery.min.js"></script>
    <script src="../assets/user-asset/js/popper.min.js"></script>
    <script src="../assets/user-asset/js/bootstrap.min.js"></script>
    <script src="../assets/user-asset/js/rangeslider.js"></script>
    <script src="../assets/user-asset/js/select2.min.js"></script>
    <script src="../assets/user-asset/js/jquery.magnific-popup.min.js"></script>
    <script src="../assets/user-asset/js/slick.js"></script>
    <script src="../assets/user-asset/js/slider-bg.js"></script>
    <script src="../assets/user-asset/js/imagesloaded.js"></script>

    <script src="../assets/user-asset/js/ajax-user-delete-apartment.js"></script>
    <script src="../assets/user-asset/js/custom.js"></script>


    <script>
    function openFilterSearch() {
        document.getElementById("filter_search").style.display = "block";
    }

    function closeFilterSearch() {
        document.getElementById("filter_search").style.display = "none";
    }
    </script>

    <script>
    $(document).ready(function() {
        $("#showbutton").click(function() {
            $("#showing").slideToggle("slow");
        });
    });
    </script>

</body>

</html>