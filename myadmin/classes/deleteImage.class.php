<?php 

session_start();
if($_SESSION['uname'] == NULL)
    {
        header("Location: ../../error/404");
    }
include_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

class deleteImage extends Dbh
{
    public function delete_img($delidz,$delidu)
    {
        $selectquery = "SELECT `image` from img_info WHERE img_id=? && img_uuid=?";
        $sth =$this->connect()->prepare($selectquery);
        $sth->execute(array($delidz,$delidu));
        $datas = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($datas as $key => $data) 
        {
            $unlinkimg = $data['image'];
            unlink($unlinkimg);
        }

        $delquery = "DELETE FROM `img_info` WHERE img_id=? && img_uuid=?";
        $stmt = $this->connect()->prepare($delquery);
        $stmt->execute(array($delidz,$delidu));
        $result = $stmt->execute(array($delidz,$delidu));
        if($result)
        {
            echo "<script> alert('Image Deleted !');
            window.setTimeout(function(){
                window.location.href = '../admin-dashboard/pages/modify-image';

            }, 0);
            </script>";
        }
        else{
            echo "<script> alert('Image Not Deleted !');
            window.setTimeout(function(){
                window.location.href = '../admin-dashboard/pages/modify-image';

            }, 0);
            </script>";
        }
    }
}


?>