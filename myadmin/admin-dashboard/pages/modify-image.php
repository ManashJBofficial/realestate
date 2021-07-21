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

    <link rel="stylesheet" type="text/css" href="../../DataTables/datatables.min.css" />

    <link type="text/css" href="../../admin-asset/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        rel="stylesheet">

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
        <a class="navbar-brand mr-lg-5">
            <img class="navbar-brand-dark" src="" alt="parlay india logo" /> <img class="navbar-brand-light" src=""
                alt="parlay india logo" />
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
                            <li class="nav-item ">
                                <a href="modify-apartment" class="nav-link">
                                    <span class="sidebar-icon"><span class="fas fa-edit"></span></span>
                                    <span>Modify Apartment</span>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a href="#" class="nav-link">
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
                                <h1 class="h4">Modify Apartment Images</h1>
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
                                            <th class="border-0">Image</th>
                                            <th class="border-0">Apartment Name</th>
                                            <th class="border-0">Date of Upload</th>
                                            <th class="border-0">Last Edited On</th>
                                            <th class="border-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php               
                                            $obj = new getData();
                                            $datas=$obj->viewAllImages();

                                            foreach($datas as $key=>$data):
                                        ?>
                                        <tr>
                                            <td class="border-0">
                                                <?=$key + 1; ?>
                                            </td>
                                            <td class="border-0 font-weight-bold">
                                                <img src="../<?=$data[$key]['image'] ?>" width="300" height="200">
                                            </td>
                                            <td class="border-0">
                                                <?=$data[$key]['apartment_name']; ?>
                                            </td>
                                            <td class="border-0">
                                                <?=$data[$key]['date_of_entry']; ?>
                                            </td>
                                            <td class="border-0">
                                                <?=$data[$key]['last_edited_on']; ?>
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
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#change-modal<?=$data[$key]['img_id']; ?>"
                                                            type="submit" name="edit_submit" id="getInfo"><span
                                                                class="fas fa-edit mr-2"></span>Change</a>
                                                        <a class="dropdown-item text-danger" data-toggle="modal"
                                                            data-target="#delete-modal<?=$data[$key]['img_id']; ?>"><span
                                                                class="fas fa-trash-alt mr-2"></span>Delete</a>

                                                    </div>

                                                </div>
                                            </td>

                                        </tr>

                                        <div class=" modal fade" id="change-modal<?php echo $data[$key]['img_id']; ?>"
                                            tabindex="-1" aria-labelledby="delimglabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delimglabel">Change Old
                                                            Image</h5>
                                                    </div>
                                                    <form method="POST" enctype='multipart/form-data'
                                                        action="../../actions/modifyImage">
                                                        <input type="hidden" name="csrf_token"
                                                            value="<?php print_r($_SESSION['csrf_token']); ?>">
                                                        <div class=" modal-body">
                                                            <input type="hidden" name="imgid"
                                                                value="<?php echo $data[$key]['img_id']; ?>">
                                                            <input type="hidden" name="deluuid"
                                                                value="<?php echo $data[$key]['img_uuid']; ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Upload
                                                                    Images
                                                                </label>
                                                                <input class="form-control" type='file'
                                                                    name='files[]' />

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">

                                                            <button type="submit" name="ch_submit"
                                                                class="delbtn btn btn-sm btn-secondary text-white btn-danger">Change
                                                            </button>

                                                            <button type=" button"
                                                                class="btn btn-link text-danger ml-auto"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <div class=" modal fade " id="delete-modal<?=$data[$key]['img_id']; ?>"
                                            tabindex="-1" aria-labelledby="delimglabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delimglabel">Delete
                                                            Image</h5>
                                                    </div>
                                                    <form method="POST" enctype='multipart/form-data'
                                                        action="../../actions/deleteImage">
                                                        <input type="hidden" name="delimgid"
                                                            value="<?=$data[$key]['img_id']; ?>">
                                                        <input type="hidden" name="deluuid"
                                                            value="<?=$data[$key]['img_uuid']; ?>">
                                                        <div class="modal-body">Are you sure you
                                                            want to delete the image?</div>
                                                        <div class="modal-footer">

                                                            <button type="submit" name="delimage"
                                                                class="delbtn btn btn-sm btn-secondary text-white btn-danger">Delete
                                                            </button>

                                                            <button type=" button"
                                                                class="btn btn-link text-danger ml-auto"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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

    <script src="../../admin-asset/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <script src="../../admin-asset/js/script.js"></script>

</body>

</html>