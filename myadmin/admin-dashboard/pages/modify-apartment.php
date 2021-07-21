<?php

session_start();
$x=$_SESSION['uname'];


if($_SESSION['uname'] == NULL)
{
    header("Location: ../../../error/404");
}
include '../../classes/dbh.class.php';

include '../../classes/getData.class.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="../../admin-asset/img/favicon.svg" sizes="any" type="image/svg+xml">

    <link rel="stylesheet" type="text/css" href="../../../DataTables/datatables.min.css" />
    <link type="text/css" href="../../admin-asset/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../../DataTables/datatables.min.css" />

    <link type="text/css" href="../../admin-asset/css/admin-dashboard-style.css" rel="stylesheet">

    <style>
    .bottom-wrapper {
        margin-top: -1.5em;
    }

    .top-wrapper {
        margin-bottom: 2em;
    }

    .first-wrapper {
        margin-bottom: -2.5em;
    }

    .modal {
        overflow: auto !important;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-md-none">
        <a class="navbar-brand mr-lg-5" href="../index.html">
            <img class="navbar-brand-dark" src="" alt="logo" /> <img class="navbar-brand-light" src="" alt="logo" />
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
                                <div class="user-avatar lg-avatar mr-4">
                                    <img src="" class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                                </div>
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
                            <li class="nav-item">
                                <a href="add-apartment" class="nav-link">
                                    <span class="sidebar-icon"><span class="far fa-plus-square"></span></span>
                                    <span>Add Apartment</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="view-apartment" class=" nav-link">
                                    <span class="sidebar-icon"><span class="fas fa-eye"></span></span>
                                    <span>View All Apartments</span>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a href="#" class="nav-link">
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
                                <h1 class="h4">Modify Apartment Details</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card border-light shadow-sm my-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" style="width:100%;"
                                    class="table table-centered table-nowrap mb-0 rounded nowrap table-hover">
                                    <thead class="thead-light">

                                        <tr>
                                            <th class="border-0">Sl No.</th>
                                            <th class="border-0">Apartment Name</th>
                                            <th class="border-0">Address (Short)</th>
                                            <th class="border-0">Address (Full)</th>
                                            <th class="border-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php               
                                        $obj = new getData();
                                        $datas=$obj->viewAllApartments();

                                        foreach($datas as $key=>$data):
                                        ?>

                                        <!-- Item -->
                                        <tr>
                                            <td class="border-0">
                                                <?php echo $key + 1; ?>
                                            </td>
                                            <td class="border-0 font-weight-bold">
                                                <?php echo $data[$key]['apartment_name']; ?>
                                            </td>
                                            <td class="border-0">
                                                <?php echo $data[$key]['addr_short']; ?>
                                            </td>
                                            <td class="border-0">
                                                <?php echo $data[$key]['addr_full']; ?>
                                            </td>
                                            <td class="border-0">
                                                <div class="btn-group">
                                                    <button
                                                        class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="icon icon-sm">
                                                            <span class="fas fa-ellipsis-h icon-dark"></span>
                                                        </span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item get_id" data-toggle="modal"
                                                            data-target="#modal-form<?php echo $data[$key]['uuid']; ?>"
                                                            type="submit" name="edit_submit" id="getInfo"><span
                                                                class="fas fa-edit mr-2"></span>Edit</a>
                                                        <a class="dropdown-item text-danger" data-toggle="modal"
                                                            data-target="#deleterow<?php echo $data[$key]['uuid']; ?>"><span
                                                                class="fas fa-trash-alt mr-2"></span>Delete</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>


                                        <?php endforeach; ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php               
                        $obj = new getData();
                        $datas=$obj->viewAllApartments();

                        foreach($datas as $key=>$data):
                    ?>
                    <!-- Modal Content -->
                    <div class=" modal fade" id="modal-form<?php echo $data[$key]['uuid']; ?>" tabindex="-1"
                        role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <div class="card border-light shadow-sm components-section">
                                                <div class="card-body">


                                                    <form action="../../actions/modify" method="POST"
                                                        enctype='multipart/form-data'>
                                                        <input type="hidden" name="csrf_token"
                                                            value="<?php echo($_SESSION['csrf_token']); ?>">
                                                        <div class="row mb-4">
                                                            <div class="col-lg-6 col-sm-6 ">
                                                                <input name='id'
                                                                    value='<?php echo $data[$key]['id']; ?>'
                                                                    type='hidden'>
                                                                <input name='uuid'
                                                                    value='<?php echo $data[$key]['uuid']; ?>'
                                                                    type='hidden'>
                                                                <div class="mb-4 ">
                                                                    <label>Apartment
                                                                        Name</label>
                                                                    <input type="text" class="form-control"
                                                                        name="apartment_name"
                                                                        value="<?php echo $data[$key]['apartment_name']; ?>"
                                                                        required>
                                                                </div>
                                                                <div class="mb-4 ">
                                                                    <label>Apartment
                                                                        Address(Short)</label>
                                                                    <input type="text" class="form-control"
                                                                        name="addr_short"
                                                                        value="<?php echo $data[$key]['addr_short']; ?>"
                                                                        required>
                                                                </div>
                                                                <div class="mb-4 ">
                                                                    <label>Landmark</label>
                                                                    <input type="text" class="form-control"
                                                                        name="landmark"
                                                                        value="<?php echo $data[$key]['landmark']; ?>"
                                                                        required>
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label class="my-1 mr-2">Size</label>
                                                                    <select class="form-select" name="size" required>

                                                                        <option
                                                                            <?php if (isset($data[$key]['size']) && $data[$key]['size'] == "1-2 BHK") {?>
                                                                            selected="selected" <?php }?>
                                                                            value="1-2 BHK">1-2 BHK</option>

                                                                        <option
                                                                            <?php if (isset($data[$key]['size']) && $data[$key]['size'] == "2-3 BHK") {?>
                                                                            selected="selected" <?php }?>
                                                                            value="2-3 BHK">
                                                                            2-3 BHK
                                                                        </option>
                                                                        <option
                                                                            <?php if (isset($data[$key]['size']) && $data[$key]['size'] == "3-4 BHK") {?>
                                                                            selected="selected" <?php }?>
                                                                            value="3-4 BHK">
                                                                            3-4 BHK
                                                                        </option>
                                                                        <option
                                                                            <?php if (isset($data[$key]['size']) && $data[$key]['size'] == "1 BHK") {?>
                                                                            selected="selected" <?php }?> value="1 BHK">
                                                                            1 BHK
                                                                        </option>
                                                                        <option
                                                                            <?php if (isset($data[$key]['size']) && $data[$key]['size'] == "2 BHK") {?>
                                                                            selected="selected" <?php }?> value="2 BHK">
                                                                            2 BHK
                                                                        </option>
                                                                        <option
                                                                            <?php if (isset($data[$key]['size']) && $data[$key]['size'] == "3 BHK") {?>
                                                                            selected="selected" <?php }?> value="3 BHK">
                                                                            3 BHK
                                                                        </option>
                                                                        <option
                                                                            <?php if (isset($data[$key]['size']) && $data[$key]['size'] == "4 BHK") {?>
                                                                            selected="selected" <?php }?> value="4 BHK">
                                                                            4 BHK
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-4 " required>
                                                                    <label>Total
                                                                        no of
                                                                        flats</label>
                                                                    <input type="text" class="form-control"
                                                                        name="total_no_of_flat"
                                                                        value="<?php echo $data[$key]['total_no_of_flat']; ?>">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label>Latitude</label>
                                                                    <input class="form-control"
                                                                        placeholder="Enter Latitude of the apartment"
                                                                        value="<?php echo $data[$key]['lat']; ?>"
                                                                        name="lat" rows="4" required>
                                                                </div>
                                                                <div class="mb-4 " required>
                                                                    <label>Total
                                                                        no of
                                                                        flats</label>
                                                                    <input type="text" class="form-control"
                                                                        name="total_no_of_flat"
                                                                        value="<?php echo $data[$key]['total_no_of_flat']; ?>">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label>Distance
                                                                        to nearest
                                                                        School in
                                                                        km</label>
                                                                    <input class="form-control"
                                                                        value="<?php echo $data[$key]['nearest_school']; ?>"
                                                                        name="nearest_school" rows="4" required>
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label>Distance
                                                                        to nearest
                                                                        Hospital in
                                                                        km</label>
                                                                    <input class="form-control"
                                                                        value="<?php echo $data[$key]['nearest_hospital']; ?>"
                                                                        name="nearest_hospital" rows="4" required>
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label>Distance
                                                                        to nearest
                                                                        Park
                                                                        in
                                                                        km</label>
                                                                    <input class="form-control"
                                                                        value="<?php echo $data[$key]['nearest_park']; ?>"
                                                                        name="nearest_park" rows="4" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Upload
                                                                        Images
                                                                        (Multiple)</label>
                                                                    <input class="form-control" type='file'
                                                                        name='files[]' multiple />

                                                                </div>

                                                            </div>
                                                            <div class="col-lg-6 col-sm-6">
                                                                <div class="mb-4">
                                                                    <label>Pincode</label>
                                                                    <input class="form-control"
                                                                        value="<?php echo $data[$key]['pincode']; ?>"
                                                                        name="pincode" rows="4" required>
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label>Apartment
                                                                        Address(Full)</label>
                                                                    <textarea class="form-control"
                                                                        value="<?php echo $data[$key]['addr_full']; ?>"
                                                                        name="addr_full" rows="4"
                                                                        required><?php echo $data[$key]['addr_full']; ?></textarea>
                                                                </div>


                                                                <fieldset>
                                                                    <legend class="h6">
                                                                        Status
                                                                    </legend>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="apt_status" value="Future Project"
                                                                            <?php if (isset($data[$key]['apt_status']) && $data[$key]['apt_status'] == "Future Project") {?>
                                                                            <?php echo "checked"; ?> <?php }?>>
                                                                        <label class="form-check-label">
                                                                            Future
                                                                            Project
                                                                            (Open
                                                                            for
                                                                            Booking)
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="apt_status" value="Under Construction"
                                                                            <?php if (isset($data[$key]['apt_status']) && $data[$key]['apt_status'] == "Under Construction") {?>
                                                                            <?php echo "checked"; ?> <?php }?>>
                                                                        <label class="form-check-label"
                                                                            for="under_construction">
                                                                            Under
                                                                            Construction
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="apt_status" value="Completed"
                                                                            <?php if (isset($data[$key]['apt_status']) && $data[$key]['apt_status'] == "Completed") {?>
                                                                            <?php echo "checked"; ?> <?php }?>>
                                                                        <label class="form-check-label" for="completed">
                                                                            Completed
                                                                        </label>
                                                                    </div>

                                                                </fieldset>

                                                                <fieldset>
                                                                    <legend class="h6">
                                                                        Sell Status
                                                                    </legend>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="sell_status" value="Open for Booking"
                                                                            <?php if (isset($data[$key]['sell_status']) && $data[$key]['sell_status'] == "Open for Booking") {?>
                                                                            <?php echo "checked"; ?> <?php }?>>
                                                                        <label class="form-check-label">
                                                                            Open for Booking
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="sell_status" value="Sold"
                                                                            <?php if (isset($data[$key]['sell_status']) && $data[$key]['sell_status'] == "Sold") {?>
                                                                            <?php echo "checked"; ?> <?php }?>>
                                                                        <label class="form-check-label">
                                                                            Sold
                                                                        </label>
                                                                    </div>

                                                                </fieldset>

                                                                <div class="mb-4">

                                                                    <label>Longitide</label>
                                                                    <input class="form-control"
                                                                        value="<?php echo $data[$key]['lng']; ?>"
                                                                        name="lng" rows="4" required>
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label>Distance
                                                                        to nearest
                                                                        College in
                                                                        km</label>
                                                                    <input class="form-control"
                                                                        placeholder="Enter the Distance to nearest College (ex.2, 2.5,3 ,5 etc)"
                                                                        name="nearest_college"
                                                                        value="<?php echo $data[$key]['nearest_college']; ?>"
                                                                        rows="4" required>
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label>Distance
                                                                        to
                                                                        nearest
                                                                        Police
                                                                        station in
                                                                        km</label>
                                                                    <input class="form-control"
                                                                        placeholder="Enter the Distance to nearest Police Station (ex.2, 2.5,3 ,5 etc)"
                                                                        value="<?php echo $data[$key]['nearest_police_station']; ?>"
                                                                        name="nearest_police_station" rows="4" required>
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label>Distance
                                                                        to nearest
                                                                        Bus
                                                                        stop in
                                                                        km</label>
                                                                    <input class="form-control"
                                                                        placeholder="Enter the Distance to nearest Police Station (ex.2, 2.5,3 ,5 etc)"
                                                                        name="nearest_bus_stop"
                                                                        value="<?php echo $data[$key]['nearest_bus_stop']; ?>"
                                                                        rows="4" required>
                                                                </div>


                                                            </div>
                                                            <div>
                                                                <button class="btn btn-success text-center"
                                                                    name="submit" type="submit">Submit</button>
                                                            </div>
                                                            <label class="form-check-label">
                                                                <span class="text-danger align-middle"
                                                                    id="errorMsg"></span>
                                                            </label>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>

                    <?php               
                        $obj = new getData();
                        $datas=$obj->viewAllApartments();
                        foreach($datas as $key=>$data):
                    ?>


                    <!-- Modal Content -->
                    <div class="modal fade" id="deleterow<?php echo $data[$key]['uuid']; ?>" tabindex="-1" role="dialog"
                        aria-labelledby="modal-default" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="h6 modal-title">Delete Record</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="../../actions/delete">
                                    <input type="hidden" name="delid" value="<?=$data[$key]['uuid']; ?>">
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete the selected row
                                            of data?</p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="d_submit"
                                            class="btn btn-sm btn-secondary text-white btn-danger">
                                            Delete
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of Modal Content -->
                    <?php endforeach; ?>
                    <footer class="footer section py-5">
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                                <p class="mb-0 text-center text-xl-left">Copyright ©
                                    <span class="current-year"></span>
                                    <a class="text-primary font-weight-normal" href="" target="_blank">Parlay India</a>
                                </p>
                            </div>


                        </div>
                    </footer>
                </main>
            </div>
        </div>
    </div>


    <script src="../../DataTables/jquery.min.js"></script>

    <script type="text/javascript" src="../../DataTables/datatables.min.js"></script>


    <script>
    $(document).ready(function() {
        $('#data-table').DataTable({
            "scrollX": true,
            "dom": '<"first-wrapper"l><"top-wrapper"f>rti<"bottom-wrapper"p>'

        });
    });
    </script>


    <script src="../../admin-asset/vendor/popper.js/dist/umd/popper.min.js">
    </script>
    <script src="../../admin-asset/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="../../admin-asset/vendor/onscreen/dist/on-screen.umd.min.js"></script>

    <script src="../../admin-asset/vendor/nouislider/distribute/nouislider.min.js"></script>

    <script src="../../admin-asset/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <script src="../../admin-asset/vendor/simplebar/dist/simplebar.min.js"></script>

    <script src="../../admin-asset/js/script.js"></script>

</body>

</html>