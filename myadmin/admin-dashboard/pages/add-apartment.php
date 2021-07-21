<?php 

session_start();
$x=$_SESSION['uname'];
$key=bin2hex(random_bytes(32));
$token =hash_hmac('sha256',$x,$key);
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();

if($_SESSION['uname'] == NULL)
{
    header("Location: ../../../error/404");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="../../admin-asset/img/favicon.svg" sizes="any" type="image/svg+xml">

    <link type="text/css" href="../../admin-asset/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        rel="stylesheet">

    <link type="text/css" href="../../admin-asset/vendor/notyf/notyf.min.css" rel="stylesheet">

    <link type="text/css" href="../../admin-asset/css/admin-dashboard-style.css" rel="stylesheet">


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
                                    <a href="../../actions/logout" class="btn btn-secondary text-dark btn-xs"><span
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
                            <li class="nav-item ">
                                <a href="../dashboard" class="nav-link">
                                    <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                                    <span>Overview</span>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a href="#" class="nav-link">
                                    <span class="sidebar-icon"><span class="far fa-plus-square"></span></span>
                                    <span>Add Apartment</span>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="view-apartment" class="nav-link">
                                    <span class="sidebar-icon"><span class="fas fa-eye"></span></span>
                                    <span>View All Apartments</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="modify-apartment" class="nav-link">
                                    <span class="sidebar-icon"><span class="fas fa-edit"></span></span>
                                    <span>Modify Apartment</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="modify-image" class="nav-link">
                                    <span class="sidebar-icon"><span class="fas fa-image"></span></span>
                                    <span>Modify Images</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>

                <main class="content">

                    <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark pl-0 pr-2 pb-0">
                        <div class="container-fluid px-0">
                            <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                                <div class="d-flex">

                                </div>
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
                                            <a class="dropdown-item font-weight-bold" href="../../actions/logout"><span
                                                    class="fas fa-sign-out-alt text-danger"></span>Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                    <div class="py-4">
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                            <div class="mb-3 mb-lg-0">
                                <h1 class="h4">Add New Apartment Details</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card border-light shadow-sm components-section">
                                <div class="card-body">
                                    <form method="POST" enctype='multipart/form-data' action="../../actions/add">
                                        <input type="hidden" name="csrf_token"
                                            value="<?php echo($_SESSION['csrf_token']); ?>">
                                        <div class="row mb-4">
                                            <div class="col-lg-6 col-sm-6 ">

                                                <div class="mb-4 ">
                                                    <label for="apartment_name">Apartment Name</label>
                                                    <input type="text" class="form-control" id="apartment_name"
                                                        name="apartment_name" placeholder="Enter apartment name"
                                                        required>
                                                </div>
                                                <div class="mb-4 ">
                                                    <label for="addr_short">Apartment Address(Short)</label>
                                                    <input type="text" class="form-control" id="addr_short"
                                                        name="addr_short"
                                                        placeholder="Enter apartment short address (ex.Vetapara,Khanapara,Hatigaon etc)"
                                                        required>
                                                </div>
                                                <div class="mb-4 ">
                                                    <label for="landmark">Landmark</label>
                                                    <input type="text" class="form-control" id="landmark"
                                                        name="landmark" placeholder="Enter landmark" required>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="my-1 mr-2" for="size">Size</label>
                                                    <select class="form-select" id="size" name="size" required>
                                                        <option selected>Open this select menu</option>
                                                        <option value="1-2 BHK">1-2 BHK</option>
                                                        <option value="2-3 BHK">2-3 BHK</option>
                                                        <option value="3-4 BHK">3-4 BHK</option>
                                                        <option value="1 BHK">1 BHK</option>
                                                        <option value="2 BHK">2 BHK</option>
                                                        <option value="3 BHK">3 BHK</option>
                                                        <option value="4 BHK">4 BHK</option>
                                                    </select>
                                                </div>
                                                <div class="mb-4 " required>
                                                    <label for="total_no_of_flat">Total no of flats</label>
                                                    <input type="number" class="form-control" id="total_no_of_flat"
                                                        name="total_no_of_flat"
                                                        placeholder="Total no of flats in the Apartment">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="lat">Latitude</label>
                                                    <input type="number" step="any" class="form-control"
                                                        placeholder="Enter Latitude of the apartment" id="lat"
                                                        name="lat" rows="4" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="nearest_school">Distance to nearest School in km</label>
                                                    <input type="number" step="any" class="form-control"
                                                        placeholder="Enter the Distance to nearest School (ex.2, 2.5,3 ,5 etc)"
                                                        id="nearest_school" name="nearest_school" rows="4" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="nearest_hospital">Distance to nearest Hospital in
                                                        km</label>
                                                    <input type="number" step="any" class="form-control"
                                                        placeholder="Enter the Distance to nearest Hospital (ex.2, 2.5,3 ,5 etc)"
                                                        id="nearest_hospital" name="nearest_hospital" rows="4" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="nearest_park">Distance to nearest Park in
                                                        km</label>
                                                    <input type="number" step="any" class="form-control"
                                                        placeholder="Enter the Distance to nearest Park (ex.2, 2.5,3 ,5 etc)"
                                                        id="nearest_park" name="nearest_park" rows="4" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="img_info" class="form-label">Upload Images
                                                        (Multiple)</label>
                                                    <input class="form-control" id="img_info" type='file' name='files[]'
                                                        multiple required />

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <div class="mb-4">
                                                    <label for="pincode">Pincode</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="Enter pincode" id="pincode" name="pincode" rows="4"
                                                        required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="addr_full">Apartment Address(Full)</label>
                                                    <textarea class="form-control" placeholder="Enter full address..."
                                                        id="addr_full" name="addr_full" rows="4" required></textarea>
                                                </div>
                                                <fieldset>
                                                    <legend class="h6">Status</legend>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="apt_status"
                                                            id="future_project" value="Future Project" checked>
                                                        <label class="form-check-label" for="future_project">
                                                            Future Project
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="apt_status"
                                                            id="under_construction" value="Under Construction">
                                                        <label class="form-check-label" for="under_construction">
                                                            Under Construction
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="apt_status"
                                                            id="completed" value="Completed">
                                                        <label class="form-check-label" for="completed">
                                                            Completed
                                                        </label>
                                                    </div>
                                                </fieldset>

                                                <fieldset>
                                                    <legend class="h6">Sell Status</legend>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sell_status"
                                                            id="open_for_booking" value="Open for Booking" checked>
                                                        <label class="form-check-label" for="open_for_booking">
                                                            Open for Booking
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sell_status"
                                                            id="sold" value="Sold">
                                                        <label class="form-check-label" for="sold">
                                                            Sold
                                                        </label>
                                                    </div>
                                                </fieldset>
                                                <div class="mb-4">
                                                    <label for="lng">Longitide</label>
                                                    <input type="number" step="any" class="form-control"
                                                        placeholder="Enter longitude of the apartment" id="lng"
                                                        name="lng" rows="4" required>
                                                </div>

                                                <div class="mb-4">
                                                    <label for="nearest_college">Distance to nearest College in
                                                        km</label>
                                                    <input type="number" step="any" class="form-control"
                                                        placeholder="Enter the Distance to nearest College (ex.2, 2.5,3 ,5 etc)"
                                                        id="nearest_college" name="nearest_college" rows="4" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="nearest_police_station">Distance to nearest Police
                                                        station in
                                                        km</label>
                                                    <input type="number" step="any" class="form-control"
                                                        placeholder="Enter the Distance to nearest Police Station (ex.2, 2.5,3 ,5 etc)"
                                                        id="nearest_police_station" name="nearest_police_station"
                                                        rows="4" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="nearest_bus_stop">Distance to nearest Bus
                                                        stop in
                                                        km</label>
                                                    <input type="number" step="any" class="form-control"
                                                        placeholder="Enter the Distance to nearest Police Station (ex.2, 2.5,3 ,5 etc)"
                                                        id="nearest_bus_stop" name="nearest_bus_stop" rows="4" required>
                                                </div>


                                            </div>
                                            <div>
                                                <button class="btn btn-success text-center" name="submit" type="submit"
                                                    value="submit">Submit</button>
                                            </div>
                                            <label class="form-check-label">
                                                <span class="text-danger align-middle" id="errorMsg"></span>
                                            </label>
                                        </div>


                                    </form>
                                    <div class="row mb-5 mb-lg-5">

                                    </div>
                                    <div class="row justify-content-between">

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


    <script src="../../admin-asset/vendor/popper.js/dist/umd/popper.min.js">
    </script>
    <script src="../../admin-asset/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="../../admin-asset/vendor/onscreen/dist/on-screen.umd.min.js"></script>

    <script src="../../admin-asset/vendor/nouislider/distribute/nouislider.min.js"></script>

    <script src="../../admin-asset/vendor/jarallax/dist/jarallax.min.js"></script>

    <script src="../../admin-asset/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <script src="../../admin-asset/js/script.js"></script>



</body>

</html>