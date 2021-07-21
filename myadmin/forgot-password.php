<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Parlay India</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="apple-touch-icon" sizes="120x120" href="../../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../../assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <link type="text/css" href="admin-asset/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">


    <link type="text/css" href="admin-asset/css/admin-dashboard-style.css" rel="stylesheet">


</head>

<body class="bg-soft">
    <main>

        <section class="vh-lg-100 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div
                            class="signin-inner my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <h1 class="h3">Forgot your password?</h1>
                            <p class="mb-4">Don't fret! Just type in your email and we will send you a code to reset
                                your password!</p>
                            <form action="actions/reqReset" method="POST">
                                <div class="mb-4">
                                    <label for="email">Your Email</label>
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control" id="email" required
                                            autofocus autocomplete="off">
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-block btn-primary">Recover
                                    password</button>
                            </form>
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <span class="font-weight-normal">
                                    Go back to the
                                    <a href="index" class="font-weight-bold">login page</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="admin-asset/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="admin-asset/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="admin-asset/vendor/jarallax/dist/jarallax.min.js"></script>
    <script src="admin-asset/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="admin-asset/js/script.js"></script>


</body>

</html>