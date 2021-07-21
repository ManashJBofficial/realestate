<?php

    include('../config.php');
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

$obj = new getData();
$count=$obj->isApartmentIdCorrect();
if($count !=1)
{
    header('Location:../error/404');
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

    </script>

    <link rel="icon" href="/realestate/assets/img/favicon.svg" sizes="any" type="image/svg+xml">

    <link href="../assets/user-asset/css/styles.css" rel="stylesheet">

    <link href="../assets/user-asset/css/colors.css" rel="stylesheet">

</head>

<body class="green-skin">

    <div id="preloader">
        <div class="preloader"><span></span><span></span></div>
    </div>


    <div id="main-wrapper">

        <div class="header header-light head-shadow">
            <div class="container">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class=" nav-header me-5">
                        <a class="nav-brand fixed-logo" href="#"><img src="../assets/img/parlay.svg" class="logo"
                                alt="" /></a>
                        <div class="nav-toggle"></div>
                    </div>
                    <div class="nav-menus-wrapper" style="transition-property: none;">
                        <ul class="nav-menu ">

                            <li><a href="../index">Home<span class="submenu-indicator"></span></a>
                            </li>

                            <li class="active"><a href="properties">View Apartments<span
                                        class="submenu-indicator"></span></a>
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
                                        <a href="favourite-apartments"><i class="ti-bookmark"></i>Favourite
                                            Apartments</a>
                                        <a href="../logout">Logout</a>
                                    </div>
                                    <?php else: ?>
                                    <div class="mt-2">
                                        <a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#login"
                                            class="text-dark badge alert-light p-3 fw-bold">
                                            <img src="../assets/img/google-icon.svg" width="30" height="20">&ensp;SIGNUP
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


        <div class="row">

            <div class="col-12">

                <div class="featured_slick_gallery gray">

                    <div class="featured_slick_gallery-slide">
                        <?php 
                            $obj = new getData();
                            $datas=$obj->getImage();
							foreach ($datas as $key => $data):
                        ?>
                        <div class="featured_slick_padd">
                            <a href="realestate/<?=$data[$key]['image']  ?>" class="mfp-gallery">
                                <img src="realestate/<?=$data[$key]['image'] ?>" class="img-fluid mx-auto" alt="" />
                            </a>

                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>

            </div>

        </div>

        <section class="gray-simple">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <?php 
                            $obj = new getData();
                            $datas=$obj->getAptDetails();
							foreach ($datas as $key => $data):
                        ?>
                        <div class="property_block_wrap style-2 p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="prt-detail-title-desc">
                                        <span class="prt-types sale mb-2"><?=$data[$key]['apt_status']?></span>
                                        <h3 class="my-2"><?=$data[$key]['apartment_name']?></h3>
                                        <span class="my-2"><i
                                                class="lni-map-marker"></i><?=$data[$key]['addr_full']?></span>
                                        <h3 class="prt-price-fix my-2"><i class="fas fa-rupee-sign"></i> Price on
                                            Request</sub>
                                        </h3>
                                        <p>Landmark: <?=$data[$key]['landmark']?></p>
                                        <p>Pincode: <?=$data[$key]['pincode']?></p>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex flex-column justify-content-start align-items-end">
                                    <button type="submit" class="btn btn-theme-light-2 rounded" data-bs-toggle="modal"
                                        data-bs-target="#single_prop_contact">
                                        <i class="fas fa-envelope"></i>&ensp;&nbsp;
                                        Contact
                                    </button>
                                </div>
                            </div>


                        </div>


                        <div class="property_block_wrap style-2">

                            <div class="property_block_wrap_header">
                                <a data-bs-toggle="collapse" data-parent="#features" data-bs-target="#clOne"
                                    aria-controls="clOne" href="javascript:void(0);" aria-expanded="false">
                                    <h4 class="property_block_title">Detail & Features</h4>
                                </a>
                            </div>
                            <div id="clOne" class="panel-collapse collapse show mt-3" aria-labelledby="clOne"
                                aria-expanded="true">
                                <div class="block-body">

                                    <ul class="deatil_features">
                                        <li><strong>Size:</strong><?=$data[$key]['size']?></li>
                                        <li><strong>Total No of Flats:</strong><?=$data[$key]['total_no_of_flat']?></li>
                                        <!-- <li><strong>Areas:</strong>-</li> -->
                                        <li><strong>Status</strong><?=$data[$key]['apt_status']?></li>



                                    </ul>
                                    <?php endforeach; ?>

                                </div>
                            </div>

                        </div>

                        <div class="property_block_wrap style-2">

                            <div class="property_block_wrap_header">
                                <a data-bs-toggle="collapse" data-parent="#clSev" data-bs-target="#clSev"
                                    aria-controls="clOne" href="javascript:void(0);" aria-expanded="true"
                                    class="collapsed">
                                    <h4 class="property_block_title">Gallery</h4>
                                </a>
                            </div>


                            <div id="clSev" class="panel-collapse mt-3" aria-expanded="true">
                                <div class="block-body">
                                    <ul class="list-gallery-inline">

                                        <?php 
                                            $obj = new getData();
                                            $datas=$obj->getImage();
                                            foreach ($datas as $key => $data):
                                        ?>
                                        <li>
                                            <a href="../myadmin/upload/<?=$data[$key]['image'] ?>" class="mfp-gallery">
                                                <img src="../myadmin/upload/<?=$data[$key]['image'] ?>"
                                                    class="img-fluid mx-auto" alt="" />
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="property_block_wrap style-2">

                            <div class="property_block_wrap_header ">
                                <a data-bs-toggle="collapse" data-parent="#nearby" data-bs-target="#clNine"
                                    aria-controls="clNine" href="javascript:void(0);" aria-expanded="true">
                                    <h4 class="property_block_title">Distance To</h4>
                                </a>
                            </div>

                            <?php 
                                $obj = new getData();
                                $datas=$obj->getAptDetails();
                                foreach ($datas as $key => $data):
                            ?>
                            <div id="clNine" class="panel-collapse collapse show mt-3" aria-expanded="true">
                                <div class="block-body">

                                    <div class="nearby-wrap">
                                        <div class="nearby_header">
                                            <div class="nearby_header_first">
                                                <h5>Nearest School</h5>
                                            </div>
                                            <div class="nearby_header_last">
                                                <div class="nearby_powerd">
                                                    <?=$data[$key]['nearest_school'] ?>
                                                    KM
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="nearby-wrap">
                                        <div class="nearby_header">
                                            <div class="nearby_header_first">
                                                <h5>Nearest College</h5>
                                            </div>
                                            <div class="nearby_header_last">
                                                <div class="nearby_powerd">
                                                    <?=$data[$key]['nearest_college'] ?>
                                                    KM
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="nearby-wrap">
                                        <div class="nearby_header">
                                            <div class="nearby_header_first">
                                                <h5>Nearest Hospital</h5>
                                            </div>
                                            <div class="nearby_header_last">
                                                <div class="nearby_powerd">
                                                    <?=$data[$key]['nearest_hospital'] ?>
                                                    KM
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="nearby-wrap">
                                        <div class="nearby_header">
                                            <div class="nearby_header_first">
                                                <h5>Nearest Police Station</h5>
                                            </div>
                                            <div class="nearby_header_last">
                                                <div class="nearby_powerd">
                                                    <?=$data[$key]['nearest_police_station'] ?>
                                                    KM
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="nearby-wrap">
                                        <div class="nearby_header">
                                            <div class="nearby_header_first">
                                                <h5>Nearest Park</h5>
                                            </div>
                                            <div class="nearby_header_last">
                                                <div class="nearby_powerd">
                                                    <?=$data[$key]['nearest_park'] ?>
                                                    KM
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="nearby-wrap">
                                        <div class="nearby_header">
                                            <div class="nearby_header_first">
                                                <h5>Nearest Bus Stop</h5>
                                            </div>
                                            <div class="nearby_header_last">
                                                <div class="nearby_powerd">
                                                    <?=$data[$key]['nearest_bus_stop'] ?>
                                                    KM
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>



                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 ">

                        <div class="like_share_wrap b-0 ">
                            <ul class="like_share_list">
                                <li><a href="JavaScript:Void(0);" class="btn btn-likes" data-toggle="tooltip"
                                        data-bs-toggle="modal" data-bs-target="#sharemodal"
                                        data-original-title="Share"><i class="fas fa-share"></i>Share</a></li>
                                <li><a class="btn btn-likes" data-toggle="tooltip" data-original-title="Save"
                                        id="saveApartment" type="button"><i class="fas fa-heart"></i>
                                        <?php 
                                            $obj = new getData();
                                            $datas=$obj->isApartmentSaved();     
                                        ?>
                                        <?php if (!empty($datas)) { ?>
                                        Saved
                                        <?php } else { ?>
                                        Save
                                        <?php } ?>

                                    </a>
                                </li>

                            </ul>
                        </div>

                        <div class="details-sidebar">
                            <div class="sides-widget">
                                <div class="home-map fl-wrap">
                                    <div class="hm-map-container fw-map">

                                        <?php 
                                            $obj = new getData();
                                            $datas=$obj->getGeoLocationDetails();
                                            foreach ($datas as $key => $data):
                                        ?>
                                        <iframe width="100%" height="100%" style="border:0" loading="lazy"
                                            allowfullscreen
                                            src="https://www.google.com/maps/embed/v1/place?q=<?=$data[$key]['lat'];?>,<?=$data[$key]['lng'];?>&key=AIzaSyA-5ewPMkNavV2DqI_J39G4jFzZoaEQ20U"></iframe>
                                        <?php endforeach;?>

                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-widgets">

                                <h4>Featured Property</h4>

                                <div class="sidebar_featured_property">
                                    <?php 
                                            $obj = new getData();
                                            $datas=$obj->getFeaturedApartments();
                                            foreach ($datas as $key => $data):
                                        ?>
                                    <div class="sides_list_property">
                                        <div class="sides_list_property_thumb">
                                            <a href="property.php?pid=<?=$data[$key]['uuid']?>">
                                                <img src="../myadmin/upload/<?=$data[$key]['image'] ?>"
                                                    class="img-fluid" alt="">
                                            </a>
                                        </div>
                                        <div class="sides_list_property_detail">
                                            <h4><a href="homes/property.php?pid=<?=$data[$key]['uuid']?>">
                                                    <?=$data[$key]['apartment_name']; ?></a></h4>
                                            <span><i class="ti-location-pin"></i><?=$data[$key]['addr_short']?></span>
                                            <div class="lists_property_price">
                                                <div class="lists_property_types">
                                                    <div class="property_types_vlix sale"><?=$data[$key]['apt_status']?>
                                                    </div>
                                                </div>
                                                <div class="lists_property_price_value">
                                                    <h4><i class="fas fa-rupee-sign"></i> on Request</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>

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

        <!-- Share Modal -->
        <div class="modal fade" id="sharemodal" tabindex="-1" role="dialog" aria-labelledby="registermodal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content" id="registermodal">
                    <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <h4 class="modal-header-title">Share</h4>

                        <div class="social-login mb-3">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4>Link</h4>

                                <div class="form-group">
                                    <input type="text" id="myInput" class="form-control text-start linkToCopy "
                                        value="<?=$_SERVER['HTTP_HOST'].$_SESSION['url']?>" />
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-sm " id="myInput" onclick="copyToClipboard()">
                                        <i class="far fa-copy"></i>&ensp;Copy
                                        Link</button>
                                </div>

                            </div>
                        </div>
                        <div class="modal-divider"><span>Or share via</span></div>
                        <div class="text-center">
                            <a href="https://api.whatsapp.com/send?text=<?=urlencode($_SERVER['HTTP_HOST'].$_SESSION['url'])?>"
                                target="_blank">
                                <img src="../assets/img/whatsapp.svg" width="100" height="50" />
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
            <div id="liveToast" class="toast align-items-center text-white bg-green border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        Link Copied Successfully !
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="single_prop_contact" tabindex="-1" role="dialog" aria-labelledby="registermodal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content" id="registermodal">
                    <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <h4 class="modal-header-title">Contact</h4>
                        <form role="form" id="single_contact_form">
                            <input type="hidden" name="csrf_token" id="csrf_tokens"
                                value="<?php echo($_SESSION['csrf_token']); ?>">
                            <div class="form-group">
                                <?php 
                                            $obj = new getData();
                                            $datas=$obj->getApartmentName();
                                            foreach ($datas as $key => $data):
                                        ?>
                                <input type="hidden" class="form-control" placeholder="Apartment Name"
                                    value="<?=$data[$key]['apartment_name']?>" name="apt_name" id="apt_name">
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group">
                                <label class="required">Name</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" class="form-control" placeholder="Your Name" name="s_name"
                                        id="s_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="required">Email</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" class="form-control" placeholder="Your email address"
                                        name="s_email" id="s_email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="required">Mobile No.</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-mobile"></i>
                                    <input type="tel" class="form-control" placeholder="Your Mobile No." maxlength="10"
                                        name="s_mobile" id="s_mobile" pattern="\d*"
                                        oninvalid="this.setCustomValidity('Please Enter Valid Mobile Number')"
                                        onchange="try{setCustomValidity('')}catch(e){}" oninput="setCustomValidity(' ')"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="required">Description</label>
                                <textarea class="form-control" name="s_desc"
                                    id="s_desc">I'm interested in this property.</textarea>
                            </div>
                            <button class="btn btn-black btn-md rounded full-width" type="submit" id="s_submit"
                                name="s_submit">Send Message</button>
                        </form>
                        <div class="modal-divider"><span>Or Message us via Whatapp</span></div>
                        <div class="text-center">
                            <h5><i class="fab fa-whatsapp fa-lg" style="color:#25D366"></i>&ensp;(+91)
                                9678085035 /
                                (+91)
                                9678085037</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

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
                                        <img src="../assets/img/google-icon.svg" width="30" height="20">
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

        <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>


    </div>

    <div class="position-fixed bottom-0 start-50 translate-middle-x p-3" style="z-index: 5">
        <div id="msg-sent-success-toast" class="toast align-items-center text-white bg-blue border-0" role="alert"
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
    <div class="toast-container position-absolute top-0 end-0 p-3">
        <div class="position-fixed bottom-0 start-50 translate-middle-x p-3" style="z-index: 5">
            <div id="save-success-toast" class="toast align-items-center text-white bg-success border-0" role="alert"
                aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
                <div class="d-flex">
                    <div class="toast-body">
                        Saved Successfully !
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
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
    <script src="../assets/user-asset/js/lightbox.js"></script>
    <script src="../assets/user-asset/js/btnloadmore.js"></script>
    <script src="../assets/user-asset/js/ajax-load-data.js"></script>
    <script src="../assets/user-asset/js/ajax-contact-form.js"></script>
    <script src="../assets/user-asset/js/save-apartment.js"></script>
    <script src="../assets/user-asset/js/ajax-mail-from-estate.js"></script>
    <script src="../assets/user-asset/js/ajax-contact-form.js"></script>
    <script src="../assets/user-asset/js/custom.js"></script>

    <script>
    function copyToClipboard() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */
        document.execCommand("copy");
        $('#sharemodal').modal('hide');
        $('#liveToast').toast('show');
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