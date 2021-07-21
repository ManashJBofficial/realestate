<?php 

session_start();
if($_SESSION['uname'] == NULL)
    {
        header("Location: ../../error/404");
    }

class deleteFavApt extends Dbh
{
    public function delete_fav_apt($fav_id)
    {
        try {
            if(isset($_SESSION['user_id']))
            {
            $google_uid = $_SESSION['user_id'];
            $fav_id = $_POST['id'];
        
            $q = "SELECT count(*) FROM fav_estate WHERE fav_uuid=:fid AND google_user_id=:gouid LIMIT 1";
            $stmt = $this->connect()->prepare($q);
            $stmt->bindParam(':fid', $fav_id);
            $stmt->bindParam(':gouid', $google_uid);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            
            if(!empty($count)) {
                $q = "DELETE FROM fav_estate WHERE fav_uuid=:fid AND google_user_id=:gouid";
                $stmt = $this->connect()->prepare($q);
                $stmt->bindParam(':fid', $fav_id);
                $stmt->bindParam(':gouid', $google_uid);
                $result = $stmt->execute();
                if($result)
                {
                    echo "Deleted";
                }
                else{
                    echo "Not Deleted";
        
                }
            }
            
            }
        }
            catch(Exception $e){
                echo $e;
            }
    }
}