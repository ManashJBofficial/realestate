<?php 

session_start();
if($_SESSION['uname'] == NULL)
    {
        header("Location: ../../error/404");
    }
include_once '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

class modifyApartment extends Dbh
{
    public function modify_apt($id,$uuid,$apartment_name,$addr_short,$addr_full,$landmark,$pincode,$size,$apt_status,
    $sell_status,$total_no_of_flat,$lat,$lng,$nearest_school,$nearest_college,$nearest_hospital,
    $nearest_police_station,$nearest_park,$nearest_bus_stop){
        $xuuid = Uuid::uuid4();
        $new_uuid = str_replace('-', '', $xuuid);
        try {

    $updatequery = "UPDATE `estate_infos` SET 
                                
                                `apartment_name`=:apartment_name,
                                `addr_short`=:addr_short,
                                `addr_full`=:addr_full,
                                `landmark`=:landmark,
                                `pincode`=:pincode,
                                `size`=:size,
                                `apt_status`=:apt_status,
                                `sell_status`=:sell_status,
                                `total_no_of_flat`=:total_no_of_flat,
                                `lat`=:lat,
                                `lng`=:lng,
                                `nearest_school`=:nearest_school,
                                `nearest_college`=:nearest_college,
                                `nearest_hospital`=:nearest_hospital,
                                `nearest_police_station`=:nearest_police_station,
                                `nearest_park`=:nearest_park,
                                `nearest_bus_stop`=:nearest_bus_stop 
                                WHERE id=:id && uuid=:uuid";
                                $stmt = $this->connect()->prepare($updatequery);
                                $stmt->bindParam(':id', $id);
                                $stmt->bindParam(':uuid', $uuid);
                                $stmt->bindParam(':apartment_name',$apartment_name);
                                $stmt->bindParam(':addr_short', $addr_short);
                                $stmt->bindParam(':addr_full', $addr_full);
                                $stmt->bindParam(':landmark', $landmark);
                                $stmt->bindParam(':pincode', $pincode);
                                $stmt->bindParam(':size', $size);
                                $stmt->bindParam(':apt_status', $apt_status);
                                $stmt->bindParam(':sell_status', $sell_status);
                                $stmt->bindParam(':total_no_of_flat', $total_no_of_flat);
                                $stmt->bindParam(':lat', $lat);
                                $stmt->bindParam(':lng', $lng);
                                $stmt->bindParam(':nearest_school', $nearest_school);
                                $stmt->bindParam(':nearest_college', $nearest_college);
                                $stmt->bindParam(':nearest_hospital', $nearest_hospital);
                                $stmt->bindParam(':nearest_police_station', $nearest_police_station);
                                $stmt->bindParam(':nearest_park', $nearest_park);
                                $stmt->bindParam(':nearest_bus_stop', $nearest_bus_stop);
                                $stmt->execute();
                                $result = $stmt->execute();

                                $estate_infos_id = $id;
                                
                                $countfiles = count($_FILES['files']['name']);
                                
                                $query = "INSERT INTO img_info (img_uuid,name,image,estate_infos_id) VALUES(?,?,?,?)";

                                $statement = $this->connect()->prepare($query);
                                for ($i = 0; $i < $countfiles; $i++) {
                                    $img_uuid[$i] = Uuid::uuid4();
                                    $img_uuid[$i] = str_replace('-', '',  $img_uuid[$i]);                         
                                }
                                
                                for($i=0;$i<$countfiles;$i++){
                                    $bytes = random_bytes(16);
                                    $ra=uniqid('image');
                                    
                                    $filename = $_FILES['files']['name'][$i];
                                    $temp = explode(".", $filename);
                                    $newfilename = bin2hex($bytes) . '.' . end($temp);
                                    
                                    $target_file = '../../images/'.$newfilename;                           
                                    $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                                    $file_extension = strtolower($file_extension);

                                    
                                    $valid_extension = array("png","jpeg","jpg");

                                    if(in_array($file_extension, $valid_extension)){

                                    
                                        if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){

                                            
                                        $statement->execute(array($img_uuid[$i],$newfilename,$target_file,$estate_infos_id));

                                        }
                                    }
                                
                                }
                                
                                $img_query ="UPDATE img_info SET estate_infos_uuid=:new_uuid WHERE estate_infos_id=:id" ;
                                $sti =$this->connect()->prepare($img_query);
                                $sti->bindParam(':id', $id);
                                $sti->bindParam(':new_uuid', $uuid);
                                $sti->execute();

                                if($result) 
                                {
                                
                                    echo "<script> alert('Update Successful !');
                                    window.setTimeout(function(){
                                        window.location.href = '../admin-dashboard/pages/modify-apartment';

                                    }, 0);
                                    </script>";

                                }
                                else{
                                    
                                    echo "<script>alert('Submission Failed !');
                                    window.setTimeout(function(){
                                        window.location.href = '../admin-dashboard/pages/modify-apartment';

                                    }, 0);
                                    
                                    </script>";
                                }
        } 
        catch (Exception $e) {
            echo "Failed: " . $e->getMessage();  
        }
    }
}