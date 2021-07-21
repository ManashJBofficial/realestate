<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="admin-asset/img/favicon.svg" sizes="any" type="image/svg+xml">

    <link type="text/css" href="admin-asset/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <link type="text/css" href="admin-asset/vendor/notyf/notyf.min.css" rel="stylesheet">

    <link type="text/css" href="admin-asset/css/admin-dashboard-style.css" rel="stylesheet">


</head>

<body class="bg-soft">
    <main>

        <section class="vh-lg-100 d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div
                            class="signin-inner my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Admin Signin</h1>
                            </div>
                            <form action="actions/login" class="mt-4" method="POST">

                                <div class="form-group mb-4">
                                    <label for="uname">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><span
                                                class="fas fa-user-tie"></span></span>
                                        <input type="text" class="form-control" id="uname" placeholder="Your Username"
                                            autofocus required name="uname">
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" id="role" name="role" value="1">
                                <div class="form-group">
                                    <div class="form-group mb-4">
                                        <label for="pass">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2"><span
                                                    class="fas fa-unlock-alt"></span></span>
                                            <input type="password" placeholder="Your Password" class="form-control"
                                                id="pass" name="pass" required>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-block btn-primary" name="submit">Sign in</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>


    <!-- Core -->
    <!-- <script src="vendor/popper.js/dist/umd/popper.min.js"></script> -->
    <script src="admin-asset/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Vendor JS -->
    <!-- <script src="vendor/onscreen/dist/on-screen.umd.min.js"></script> -->

    <!-- Slider -->
    <script src="admin-asset/vendor/nouislider/distribute/nouislider.min.js"></script>

    <!-- Jarallax -->
    <!-- <script src="vendor/jarallax/dist/jarallax.min.js"></script> -->

    <!-- Smooth scroll -->
    <script src="admin-asset/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <!-- Count up -->
    <script src="admin-asset/vendor/countup.js/dist/countUp.umd.js"></script>

    <!-- Notyf -->
    <script src="admin-asset/vendor/notyf/notyf.min.js"></script>

    <!-- Charts -->
    <script src="admin-asset/vendor/chartist/dist/chartist.min.js"></script>
    <script src="admin-asset/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

    <!-- Datepicker -->
    <script src="admin-asset/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

    <!-- Simplebar -->
    <script src="admin-asset/vendor/simplebar/dist/simplebar.min.js"></script>

    <script src="assets/js/script.js"></script>


</body>

</html>