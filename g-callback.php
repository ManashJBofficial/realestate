<?php
error_reporting(0);
require_once(__DIR__ . '/vendor/autoload.php');
use Ramsey\Uuid\Uuid;
//Include Configuration File
include('config.php');
include('myadmin/classes/connection.php');

$uuid = Uuid::uuid4();
$new_uuid = str_replace('-', '', $uuid);

if(isset($_GET["code"]))
{

        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
        $_SESSION['grefresh_token']=json_decode($google_client->getRefreshToken());

        if(!isset($token['error']))
        {

            $google_client->setAccessToken($token['access_token']);
            
            $_SESSION['access_token'] = $token['access_token'];

            $google_service = new Google_Service_Oauth2($google_client);
            $_SESSION['refresh_token'] = $google_client->getRefreshToken();

            $data = $google_service->userinfo->get();

            var_dump($data);
            
            if(!empty($data['given_name']))
            {
            $_SESSION['user_first_name'] = $data['given_name'];
            }

            if(!empty($data['family_name']))
            {
            $_SESSION['user_last_name'] = $data['family_name'];
            }

            if(!empty($data['email']))
            {
            $_SESSION['user_email_address'] = $data['email'];
            }

            if(!empty($data['gender']))
            {
            $_SESSION['user_gender'] = $data['gender'];
            }

            if(!empty($data['picture']))
            {
                $_SESSION['user_image'] = $data['picture'];
            }
            if(!empty($data['id']))
            {
                $_SESSION['user_id'] = $data['id'];
            }

            $check_if_user_exists = "SELECT COUNT(*) AS count from google_users where email = :email_id";
            $stmt = $dbcon->prepare($check_if_user_exists);
            $stmt->bindValue(":email_id",$data['email']);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $result = json_decode($result,true);     
            if($result[0]["count"] > 0) {
            // User Exist 
                $_SESSION["new_user"] = "no";

            }
            else{
                $rol=0;

                $add_new_user_in_db = "INSERT INTO `google_users` (`role`,`first_name`,`last_name`, `email`,`google_id`) VALUES (:role,:f_name, :l_name, :mail,:g_id)";
                $sth = $dbcon->prepare($add_new_user_in_db);
                $sth->bindValue(":role", 0);
                $sth->bindValue(":f_name", $data['given_name']);
                $sth->bindValue(":l_name", $data['family_name']);
                $sth->bindValue(":mail", $data['email']);
                $sth->bindValue(":g_id", $data['id']);
                $sth->execute();
                $result = $sth->rowCount();
                if ($result > 0) {
                    $_SESSION["new_user"] = "yes";
                }
            }
            
        }
        elseif($google_client->isAccessTokenExpired()){
            $google_client->refreshToken($_SESSION['grefresh_token']);
    
        }
   
        
}

if(isset($_SESSION['url'])){
    $newurl=$_SESSION['url'];
    header('Location: '.$newurl);
} else {
    header('Location: index.php');
    exit();
}




?>