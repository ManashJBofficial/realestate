<?php 

session_start();
include_once  '../includes/autoloader.inc.php';


$x=$_SESSION['uname'];
// header("Cache-Control", "no-store, no-cache, must-revalidate");
header('Cache-Control: no-cache, must-revalidate');

if($_SESSION['uname'] == NULL && $_SESSION['role'] != 1)
{
    header("Location: ../../error/404");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script language="javascript" type="text/javascript">
    window.history.forward();
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../admin-asset/img/favicon.svg" sizes="any" type="image/svg+xml">
    <!-- Fontawesome -->
    <link type="text/css" href="../admin-asset/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="../admin-asset/vendor/notyf/notyf.min.css" rel="stylesheet">

    <!-- Main CSS -->
    <link type="text/css" href="../admin-asset/css/admin-dashboard-style.css" rel="stylesheet">


</head>

<body>

    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-md-none">
        <a class="navbar-brand mr-lg-5" href="">
            <h5 class="text-white">Parlay</h5>
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-md-none collapsed" type="button" data-toggle="collapse"
                data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container-fluid bg-soft">
        <div class="row">
            <div class="col-12">
                <nav id="sidebarMenu" class="sidebar d-md-block bg-primary text-white collapse" data-simplebar>
                    <div class="sidebar-inner px-4 pt-3">
                        <div
                            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                            <div class="d-flex align-items-center">

                                <div class="d-block">
                                    <h2 class="h6">Hello,Admin</h2>
                                    <a href="../actions/logout" class="btn btn-secondary text-dark btn-xs"><span
                                            class="mr-2"><span class="fas fa-sign-out-alt"></span></span>Logout</a>
                                </div>
                            </div>
                            <div class="collapse-close d-md-none">
                                <a href="#sidebarMenu" class="fas fa-times" data-toggle="collapse"
                                    data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true"
                                    aria-label="Toggle navigation"></a>
                            </div>
                        </div>
                        <ul class="nav flex-column">
                            <h4 class="text-center my-5">Admin Panel</h4>
                            <li class="nav-item active">
                                <a href="#" class="nav-link">
                                    <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                                    <span>Overview</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="pages/add-apartment" class="nav-link">
                                    <span class="sidebar-icon"><span class="far fa-plus-square"></span></span>
                                    <span>Add Apartment</span>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="pages/view-apartment" class="nav-link">
                                    <span class="sidebar-icon"><span class="fas fa-eye"></span></span>
                                    <span>View All Apartments</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="pages/modify-apartment" class="nav-link">
                                    <span class="sidebar-icon"><span class="fas fa-edit"></span></span>
                                    <span>Modify Apartment</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="pages/modify-image" class="nav-link">
                                    <span class="sidebar-icon"><span class="fas fa-image"></span></span>
                                    <span>Modify Images</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>


                <main class="content">

                    <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark pl-0 pr-2 pb-0 ">
                        <div class="container-fluid px-0">
                            <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                                <div class="d-flex">

                                </div>
                                <!-- Navbar links -->
                                <ul class="navbar-nav align-items-center">

                                    <li class="nav-item dropdown">
                                        <a class="nav-link pt-1 px-0" href="#" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <div class="media d-flex align-items-center">

                                                <div
                                                    class="media-body ml-2 text-dark align-items-center d-none d-lg-block">
                                                    <span class="mb-0 font-small font-weight-bold">Hello,
                                                        Admin</span></span>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dashboard-dropdown dropdown-menu-right mt-2">
                                            <a class="dropdown-item font-weight-bold" href="../actions/logout"><span
                                                    class="fas fa-sign-out-alt text-danger"></span>Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                    <div class="container">
                        <div class="row justify-content-md-center mt-5">
                            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                <div class="card border-light shadow-sm">
                                    <div class="card-body">
                                        <?php               
                                        $data = new getData();
                                        $count=$data->getTotalApartmentCount();
                                        ?>
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div
                                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <div
                                                    class="icon icon-shape icon-md icon-shape-blue rounded mr-4 mr-sm-0">
                                                    <span class="far fa-building"></span>
                                                </div>
                                                <div class="d-sm-none">
                                                    <h2 class="h6">Total Apartments</h2>
                                                    <h3 class="mb-1"><?= $count ?></h3>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h6">Total Apartmens</h2>
                                                    <h3 class="mb-1"><?= $count ?></h3>
                                                </div>
                                                <!-- <small>This number represents total number of estates of Parlay.</small> -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                <div class="card border-light shadow-sm">
                                    <div class="card-body">
                                        <?php               
                                        $data = new getData();
                                        $count2=$data->getCompletedApartmentCount();
                                        ?>
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div
                                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <div class="icon icon-shape icon-md icon-shape-success rounded mr-4">
                                                    <span class="fas fa-check"></span>
                                                </div>
                                                <div class="d-sm-none">
                                                    <h2 class="h6">Completed Apartments</h2>
                                                    <h3 class="mb-1"><?= $count2 ?></h3>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h6">Completed Apartments</h2>
                                                    <h3 class="mb-1"><?= $count2 ?></h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                <div class="card border-light shadow-sm">
                                    <div class="card-body">
                                        <?php               
                                        $data = new getData();
                                        $count3=$data->getUnderConstructionApartmentCount();
                                        ?>
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div
                                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <div class="icon icon-shape icon-md icon-shape-secondary rounded mr-4">
                                                    <span class="fas fa-hard-hat"></span>
                                                </div>
                                                <div class="d-sm-none">
                                                    <h2 class="h6">Under Construction</h2>
                                                    <h3 class="mb-1"><?= $count3 ?></h3>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h6">Under Construction</h2>
                                                    <h3 class="mb-1"><?= $count3 ?></h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-md-center">

                            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                <div class="card border-light shadow-sm">
                                    <div class="card-body">
                                        <?php               
                                        $data = new getData();
                                        $count4=$data->getFutureApartmentCount();
                                        ?>
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div
                                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <div
                                                    class="icon icon-shape icon-md icon-shape-light text-dark rounded mr-4 mr-sm-0">
                                                    <span class="far fa-clock"></span>
                                                </div>
                                                <div class="d-sm-none">
                                                    <h2 class="h6">Future Apartments</h2>
                                                    <h3 class="mb-1"><?= $count4 ?></h3>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h6">Future Apartments</h2>
                                                    <h3 class="mb-1"><?= $count4 ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                <div class="card border-light shadow-sm">
                                    <div class="card-body">
                                        <?php               
                                        $data = new getData();
                                        $count5=$data->get1bhkApartmentCount();
                                        ?>
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div
                                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <div
                                                    class="icon icon-shape icon-md icon-shape-light text-dark rounded mr-4">
                                                    <span class="fas fa-building"></span>
                                                </div>
                                                <div class="d-sm-none">
                                                    <h2 class="h6">1 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count5 ?></h3>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h6">1 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count5 ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                <div class="card border-light shadow-sm">
                                    <div class="card-body">
                                        <?php               
                                        $data = new getData();
                                        $count6=$data->get2bhkApartmentCount();
                                        ?>
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div
                                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <div class="icon icon-shape icon-md icon-shape-blue rounded mr-4">
                                                    <span class="fas fa-building"></span>
                                                </div>
                                                <div class="d-sm-none">
                                                    <h2 class="h6">2 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count6 ?></h3>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h6">2 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count6 ?></h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">

                            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                <div class="card border-light shadow-sm">
                                    <div class="card-body">
                                        <?php               
                                        $data = new getData();
                                        $count7=$data->get3bhkApartmentCount();
                                        ?>
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div
                                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <div
                                                    class="icon icon-shape icon-md icon-shape-blue rounded mr-4 mr-sm-0">
                                                    <span class="fas fa-building"></span>
                                                </div>
                                                <div class="d-sm-none">
                                                    <h2 class="h6">3 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count7 ?></h3>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h6">3 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count7 ?></h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                <div class="card border-light shadow-sm">
                                    <div class="card-body">
                                        <?php               
                                        $data = new getData();
                                        $count8=$data->get4bhkApartmentCount();
                                        ?>
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div
                                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <div class="icon icon-shape icon-md icon-shape-success rounded mr-4">
                                                    <span class="fas fa-building"></span>
                                                </div>
                                                <div class="d-sm-none">
                                                    <h2 class="h6">4 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count8 ?></h3>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h6">4 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count8 ?></h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                <div class="card border-light shadow-sm">
                                    <div class="card-body">
                                        <?php               
                                        $data = new getData();
                                        $count10=$data->get12bhkApartmentCount();
                                        ?>
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div
                                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <div
                                                    class="icon icon-shape icon-md icon-shape-secondary rounded mr-4 mr-sm-0">
                                                    <span class="fas fa-building"></span>
                                                </div>
                                                <div class="d-sm-none">
                                                    <h2 class="h6">1-2 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count10 ?></h3>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h6">1-2 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count10 ?></h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">

                            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                <div class="card border-light shadow-sm">
                                    <div class="card-body">
                                        <?php               
                                        $data = new getData();
                                        $count11=$data->get23bhkApartmentCount();
                                        ?>
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div
                                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <div class="icon icon-shape icon-md icon-shape-info rounded mr-4"><span
                                                        class="fas fa-building"></span></div>
                                                <div class="d-sm-none">
                                                    <h2 class="h6">2-3 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count11 ?></h3>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h6">2-3 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count11 ?></h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                                <div class="card border-light shadow-sm">
                                    <div class="card-body">
                                        <?php               
                                        $data = new getData();
                                        $count12=$data->get34bhkApartmentCount();
                                        ?>
                                        <div class="row d-block d-xl-flex align-items-center">
                                            <div
                                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                                <div class="icon icon-shape icon-md icon-shape-success rounded mr-4">
                                                    <span class="fas fa-building"></span>
                                                </div>
                                                <div class="d-sm-none">
                                                    <h2 class="h6">3-4 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count12 ?></h3>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-7 px-xl-0">
                                                <div class="d-none d-sm-block">
                                                    <h2 class="h6">3-4 BHK Apartments</h2>
                                                    <h3 class="mb-1"><?= $count12 ?></h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">

                        <div class="btn-toolbar mb-2 mb-md-0">

                        </div>
                    </div>
                    <div class="table-settings mb-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col col-md-6 col-lg-3 col-xl-4">

                            </div>
                            <div class="col-4 col-md-2 col-xl-1 pl-md-0 text-right">

                            </div>
                        </div>
                    </div>

                    <footer class="footer section py-5">
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                                <p class="mb-0 text-center text-xl-left">Copyright ©<span class="current-year"></span>
                                    <a class="text-primary font-weight-normal" href="" target="_blank">Parlay India</a>
                                </p>
                            </div>
                        </div>
                    </footer>
                </main>
            </div>
        </div>



    </div>


    <!-- Core -->
    <script src="../admin-asset/vendor/popper.js/dist/umd/popper.min.js">
    </script>
    <script src="../admin-asset/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Vendor JS -->
    <script src="../admin-asset/vendor/onscreen/dist/on-screen.umd.min.js"></script>

    <!-- Slider -->
    <script src="../admin-asset/vendor/nouislider/distribute/nouislider.min.js"></script>

    <!-- Jarallax -->
    <script src="../admin-asset/vendor/jarallax/dist/jarallax.min.js"></script>

    <!-- Smooth scroll -->
    <script src="../admin-asset/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <!-- Count up -->
    <script src="../admin-asset/vendor/countup.js/dist/countUp.umd.js"></script>

    <!-- Notyf -->
    <script src="../admin-asset/vendor/notyf/notyf.min.js"></script>

    <!-- Datepicker -->
    <script src="../admin-asset/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

    <!-- Simplebar -->
    <script src="../admin-asset/vendor/simplebar/dist/simplebar.min.js"></script>

    <!-- Volt JS -->
    <script src="../admin-asset/js/script.js"></script>



</body>

</html>