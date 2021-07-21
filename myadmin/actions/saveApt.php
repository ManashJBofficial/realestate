<?php 
session_start();
include_once '../includes/autoloader.inc.php';
require_once('../../vendor/autoload.php');
use Ramsey\Uuid\Uuid;

$uuid = Uuid::uuid4();
$new_uuid = str_replace('-', '', $uuid);

try {
    $con = new Dbh();
    $dbcon=$con->connect();
    $euuid=$_SESSION['e_id'];
    if(isset($_SESSION['user_id']))
    {
    $google_uid = $_SESSION['user_id'];

        $q = "SELECT count(*) FROM fav_estate WHERE estate_infos_uuid=:euuid AND google_user_id=:gouid";
        $stmt = $dbcon->prepare($q);
        $stmt->bindParam(':euuid', $euuid);
        $stmt->bindParam(':gouid', $google_uid);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        // echo $count;
        if(empty($count)) {
            $status = 1;
            $query = "INSERT INTO fav_estate (fav_uuid,estate_infos_uuid,google_user_id,`status`) VALUES (:uuid,:euuid,:gouid,:status)";
            $stmt = $dbcon->prepare($query);
            $stmt->bindParam(':uuid',$new_uuid);
            $stmt->bindParam(':euuid',$euuid);
            $stmt->bindParam(':gouid',$google_uid);
            $stmt->bindParam(':status',$status);
            $result = $stmt->execute();
            if($result)
            {
                echo "Saved";
            }
        }
        else { 
            $q = "DELETE FROM fav_estate WHERE estate_infos_uuid=:euuid AND google_user_id=:gouid";
            $stmt = $dbcon->prepare($q);
            $stmt->bindParam(':euuid', $euuid);
            $stmt->bindParam(':gouid', $google_uid);
            $result = $stmt->execute();
            if($result)
            {
                echo "Save";
            }
        }

    }
    else{
        echo "Login to Save";
    }
} catch (PDOException $e) {
    echo $e;
}




?>