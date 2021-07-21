<!DOCTYPE html>
<html lang="en">

<head>
    <title>Error 500</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Fontawesome -->
    <link type="text/css" href="/realEstate/myadmin/admin-asset/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        rel="stylesheet">

    <!-- Main CSS -->
    <link type="text/css" href="/realEstate/myadmin/admin-asset/css/admin-dashboard-style.css" rel="stylesheet">

    <script type="text/javascript">
    setTimeout(() => {
        window.location.href = '/realEstate/index';
    }, 4000);
    </script>
</head>

<body>
    <main>
        <section class="vh-100 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row align-items-center ">
                    <div class="col-12 col-lg-5 order-2 order-lg-1 text-center text-lg-left">
                        <h1 class="mt-5">Something has gone <span class="text-primary">seriously</span> wrong</h1>
                        <p class="lead my-4">It's always time for a coffee break. We should be back by the time you
                            finish your coffee.</p>
                        <a class="btn btn-primary animate-hover" href="/realEstate/index""><i
                                class=" fas fa-chevron-left mr-3 pl-2 animate-left-3"></i>Go
                            back home</a>
                    </div>
                    <div
                        class="col-12 col-lg-7 order-1 order-lg-2 text-center d-flex align-items-center justify-content-center">

                        <img class="img-fluid w-75" src="/realEstate/assets/user-asset/img/500.svg"
                            alt="500 Server Error">

                    </div>
                </div>
            </div>
        </section>
    </main>


</body>

</html>