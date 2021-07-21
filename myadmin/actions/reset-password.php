<?php 
    include '../classes/dbh.class.php';
    require_once "../../vendor/autoload.php" ;
    error_reporting(0);
    use Ramsey\Uuid\Uuid;

    $uuid = Uuid::uuid4();
    $new_uuid = str_replace('-', '', $uuid);

    $code =$_GET["code"];
    
    if(!isset($_GET["code"])){
    exit("Can't find page!");
    }
    $obj=new Dbh();
    $dbcon=$obj->connect();
    $sth = $dbcon->prepare("SELECT emailid FROM reset_password where code=:code");
    $sth->bindParam(':code',$code);
    $sth->execute();

    $result = $sth->fetch(PDO::FETCH_OBJ);
    $final_result =$result->emailid;
    $count = $sth->rowCount();
    if($count ==0){
        exit("Can not Find Page");
    }

    if(isset($_POST['new_password_update'])){
        
        $new_uname = $_POST['new_uname'];
        $pw =  $_POST['new_pass'];
        $pwd = md5($pw);
        $nl = 'NULL';
        $stmt = $dbcon->prepare("UPDATE google_users SET user_uuid=:new_uuid, username=:new_uname, `password`=:new_pass,google_id =:nl WHERE email=:final_result");
        $stmt->bindParam(':new_uuid',$new_uuid);
        $stmt->bindParam(':new_uname',$new_uname);
        $stmt->bindParam(':new_pass',$pwd);
        $stmt->bindParam(':nl',$nl);
        $stmt->bindParam(':final_result', $final_result);
        $stmt->execute();
        
        if($stmt){
            $emid = "emailid";
            
            $stmt = $dbcon->prepare("UPDATE reset_password SET code =NULL, emailid=NULL where emailid=:emid");
            $stmt->bindParam(':emid',$emid);

            $stmt->execute();
            exit("Password Updated. Now login with the new Password");
        }
        else{
            exit("Something went wrong");
        }
    }

   
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Parlay India</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link type="text/css" href="../admin-asset/vendor/notyf/notyf.min.css" rel="stylesheet">

    <link type="text/css" href="../admin-asset/css/admin-dashboard-style.css" rel="stylesheet">


</head>

<body class="bg-soft">
    <main>

        <section class="vh-lg-100 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div
                            class="signin-inner my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <h1 class="h3 mb-4">Reset password</h1>
                            <form method="POST">
                                <div class="mb-4">
                                    <label for="new_uname">Enter New Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon4"><span
                                                class="fas fa-user-tie"></span></span>
                                        <input type="text" name="new_uname" placeholder="New Username"
                                            class="form-control" id="new_uname" required autofocus>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="new_pass">Enter New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon4"><span
                                                class="fas fa-unlock-alt"></span></span>
                                        <input type="password" name="new_pass" placeholder="New Password"
                                            class="form-control" id="new_pass" required autofocus>
                                    </div>
                                </div>

                                <button type="submit" name="new_password_update" value="Update password"
                                    class="btn btn-block btn-primary">Reset
                                    password</button>
                            </form>
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <span class="font-weight-normal">
                                    Go back to the
                                    <a href="../index" class="font-weight-bold">login page</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="../admin-asset/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin-asset/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="../admin-asset/vendor/onscreen/dist/on-screen.umd.min.js"></script>

    <script src="../admin-asset/vendor/nouislider/distribute/nouislider.min.js"></script>

    <script src="../admin-asset/vendor/jarallax/dist/jarallax.min.js"></script>

    <script src="../admin-asset/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>


    <script src="../admin-asset/js/script.js"></script>


</body>

</html>