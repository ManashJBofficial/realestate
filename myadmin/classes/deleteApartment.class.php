<?php 

session_start();
if($_SESSION['uname'] == NULL)
    {
        header("Location: ../../error/404");
    }
include_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

class deleteApartment extends Dbh
{
    public function delete_apt($delidz)
    {
        // $delidz = $_POST['delid'];
        $selectquery = "SELECT `image` from img_info WHERE estate_infos_uuid=? ";
        $sth =$this->connect()->prepare($selectquery);
        $sth->execute(array($delidz));
        $datas = $sth->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($datas as $key => $data) 
        {
            $unlinkimg = $data['image'];
            unlink($unlinkimg);
        }

        $delquery = "DELETE `estate_infos`,`img_info` FROM `estate_infos` INNER JOIN `img_info` ON estate_infos.uuid=img_info.estate_infos_uuid WHERE uuid=? ";
        $stmt = $this->connect()->prepare($delquery);
        $stmt->execute(array($delidz));
        $result = $stmt->execute(array($delidz));
        if($result)
        {
            echo "<script> alert('Apartment Deleted !');
            window.setTimeout(function(){
                window.location.href = '../admin-dashboard/pages/modify-apartment';

            }, 0);
            </script>";
            
        }
        else{
            echo "<script> alert('Apartment Not Deleted!');
            window.setTimeout(function(){
                window.location.href = '../admin-dashboard/pages/modify-apartment';

            }, 0);
            </script>";
        }
    }
}

?>