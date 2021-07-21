<?php
session_start();

include_once '../../vendor/autoload.php';
if($_SESSION['uname'] == NULL)
        {
            header("Location: ../../error/404");
        }
use Ramsey\Uuid\Uuid;

class addApartment extends Dbh {
    public function add_apt($apartment_name,$addr_short,$addr_full,$landmark,$pincode,$size,$apt_status,
    $sell_status,$total_no_of_flat,$lat,$lng,$nearest_school,$nearest_college,$nearest_hospital,
    $nearest_police_station,$nearest_park,$nearest_bus_stop){
        
    $uuid = Uuid::uuid4();
    $new_uuid = str_replace('-', '', $uuid);
    $this->connect()->beginTransaction();
    
    try {

    $query = "INSERT INTO estate_infos(uuid,apartment_name, addr_short, addr_full, landmark, pincode, size, apt_status,sell_status, total_no_of_flat, lat, lng, date_of_entry, nearest_school, nearest_college, nearest_hospital, nearest_police_station, nearest_park, nearest_bus_stop) VALUES (:uuid,:apartment_name,:addr_short,:addr_full,:landmark,:pincode,:size,:apt_status,:sell_status,:total_no_of_flat,:lat,:lng,:date_of_entry,:nearest_school,:nearest_college,:nearest_hospital,:nearest_police_station,:nearest_park,:nearest_bus_stop)";
    $stmt = $this->connect()->prepare($query);
    $stmt->bindParam(':uuid',$new_uuid);
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
    $stmt->bindParam(':date_of_entry', $date_of_entry);
    $stmt->bindParam(':nearest_school', $nearest_school);
    $stmt->bindParam(':nearest_college', $nearest_college);
    $stmt->bindParam(':nearest_hospital', $nearest_hospital);
    $stmt->bindParam(':nearest_police_station', $nearest_police_station);
    $stmt->bindParam(':nearest_park', $nearest_park);
    $stmt->bindParam(':nearest_bus_stop', $nearest_bus_stop);
    
    $stmt->execute();
    
    $estate_infos_id = $this->connect()->lastInsertId();
    $estate_infos_uuid = $new_uuid;

    $countfiles = count($_FILES['files']['name']);

    $query = "INSERT INTO img_info (img_uuid,name,image,estate_infos_id,estate_infos_uuid) VALUES(?,?,?,?,?)";

    $statement = $this->connect()->prepare($query);
    for ($i = 0; $i < $countfiles; $i++) {
        $img_uuid[$i] = Uuid::uuid4();
        $img_uuid[$i] = str_replace('-', '',  $img_uuid[$i]);                         
    }
    
    for($i=0;$i<$countfiles;$i++){
        $bytes = random_bytes(16);

        $filename = $_FILES['files']['name'][$i];
        $temp = explode(".", $filename);
        $newfilename = bin2hex($bytes) . '.' . end($temp);

        $target_file = '../../images/'.$newfilename;

        $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);

        $valid_extension = array("png","jpeg","jpg");

        if(in_array($file_extension, $valid_extension))
        {
        
            if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){
                
            $statement->execute(array( $img_uuid[$i],$newfilename,$target_file,$estate_infos_id,$estate_infos_uuid));
            // Compress Image
            // compressImage($_FILES['files']['tmp_name'],$target_file,60);

            // Compress image
            // function compressImage($source, $destination, $quality) {

            //     $info = getimagesize($source);
            
            //     if ($info['mime'] == 'image/jpeg') 
            //     $image = imagecreatefromjpeg($source);
            
            //     elseif ($info['mime'] == 'image/gif') 
            //     $image = imagecreatefromgif($source);
            
            //     elseif ($info['mime'] == 'image/png') 
            //     $image = imagecreatefrompng($source);
            
            //     imagejpeg($image, $destination, $quality);
            
            // }
            }
        }
        else{
            echo '<script>alert("Image Not inserted OR Wrong Image Format ! Valid format: png,jpg,jpeg")</script>';
        }
    }
    $this->connect()->commit();

    if($stmt)
    {                                
        echo "<script> alert('Apartment added successfully !');
            window.setTimeout(function(){
            window.location.href = '../admin-dashboard/pages/add-apartment';}, 0);
            </script>";
    } 
    else{
        echo "<script>alert('Something Went Wrong !');
                window.setTimeout(function(){
                window.location.href = '../admin-dashboard/pages/add-apartment';
                }, 0);</script>";
    }
    
    } catch (Exception $e) {
        $this->connect()->rollBack();
        echo "Failed: " . $e->getMessage();
        
    }
    }
}