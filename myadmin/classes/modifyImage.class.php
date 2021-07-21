<?php 

session_start();
if($_SESSION['uname'] == NULL)
    {
        header("Location: ../../error/404");
    }
include_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

class modifyImage extends Dbh
{
    public function modify_img($delidc,$delidu)
    {
        $this->connect()->beginTransaction();
        try {

                        $selectquery = "SELECT `name`,`image`,`date_of_entry` from img_info WHERE img_id=? && img_uuid=?";
                        $sth =$this->connect()->prepare($selectquery);
                        $sth->execute(array($delidc,$delidu));
                        $datas = $sth->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach ($datas as $key => $data) 
                        {
                            $unlinkimg = $data['image'];
                                unlink($unlinkimg);
                        
                        }

                        date_default_timezone_set('Asia/Kolkata');
                        $t = date('d-m-Y H:i:s');
                        
                        $countfiles = count($_FILES['files']['name']);
                        $img_uuid = Uuid::uuid4();
                        $img_uuid = str_replace('-', '',  $img_uuid);                        
                        
                        $query = "UPDATE img_info SET  `name`=?,`image`=?, `last_edited_on`=? WHERE img_id=?";

                        
                        $statement = $this->connect()->prepare($query);
                        
                        for($i=0;$i<$countfiles;$i++){

                            $bytes = random_bytes(16);
                            $filename = $_FILES['files']['name'][$i];
                            $temp = explode(".", $filename);
                            $newfilename = bin2hex($bytes) . '.' . end($temp);
                            $target_file = '../../images/'.$newfilename;

                            $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                            $file_extension = strtolower($file_extension);

                            $valid_extension = array("png","jpeg","jpg");

                            if(in_array($file_extension, $valid_extension)){

                                if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){

                                $statement->execute(array($newfilename,$target_file,$t,$delidc));
                                $result = $statement->execute(array($newfilename,$target_file,$t,$delidc));
                                }
                            }
                        
                        }
                        $this->connect()->commit();

                        if($result) 
                        {
                        
                            echo "<script> alert('Update Successful !');
                            window.setTimeout(function(){
                                window.location.href = '../admin-dashboard/pages/modify-image';

                            }, 0);
                            </script>";

                        }
                        else{
                            
                            echo "<script>alert('Submission Failed / Wrong image formats given!');
                            window.setTimeout(function(){
                                window.location.href = '../admin-dashboard/pages/modify-imaage';

                            }, 0);
                            
                            </script>";
                        }          
        } catch (Exception $e) {
            $this->connect()->rollBack();
            echo "Failed: " . $e->getMessage();
        }
                        
    }
}

?>