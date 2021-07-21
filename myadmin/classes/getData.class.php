<?php 

class getData extends Dbh
{
    public function getTotalApartmentCount()
    {
        $query = "SELECT count(*) FROM estate_infos" ;
        $stmt =  $this->connect()->prepare($query);           
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    public function getCompletedApartmentCount()
    {
        $query = "SELECT count(*) FROM estate_infos WHERE apt_status=:completed " ;
        $stmt =  $this->connect()->prepare($query);   
        $completed='Completed';     
        $stmt->bindParam(':completed',$completed);         
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    public function getUnderConstructionApartmentCount()
    {
        $query = "SELECT count(*) FROM estate_infos WHERE apt_status=:under " ;
        $stmt =  $this->connect()->prepare($query);   
        $under='Under Construction';     
        $stmt->bindParam(':under',$under);          
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    public function getFutureApartmentCount()
    {
        $query = "SELECT count(*) FROM estate_infos WHERE apt_status=:future " ;
        $stmt =  $this->connect()->prepare($query);   
        $future='Future Project';     
        $stmt->bindParam(':future',$future);        
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    public function get1bhkApartmentCount()
    {
        $query = "SELECT count(*) FROM estate_infos WHERE size=:asize " ;
        $stmt =  $this->connect()->prepare($query);   
        $asize = '1 BHK' ;
        $stmt->bindParam(':asize',$asize);        
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    public function get2bhkApartmentCount()
    {
        $query = "SELECT count(*) FROM estate_infos WHERE size=:asize " ;
        $stmt =  $this->connect()->prepare($query);   
        $asize = '2 BHK' ;
        $stmt->bindParam(':asize',$asize);        
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    public function get3bhkApartmentCount()
    {
        $query = "SELECT count(*) FROM estate_infos WHERE size=:asize " ;
        $stmt =  $this->connect()->prepare($query);   
        $asize = '3 BHK' ;
        $stmt->bindParam(':asize',$asize);        
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    public function get4bhkApartmentCount()
    {
        $query = "SELECT count(*) FROM estate_infos WHERE size=:asize " ;
        $stmt =  $this->connect()->prepare($query);   
        $asize = '4 BHK' ;
        $stmt->bindParam(':asize',$asize);        
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    public function get12bhkApartmentCount()
    {
        $query = "SELECT count(*) FROM estate_infos WHERE size=:asize " ;
        $stmt =  $this->connect()->prepare($query);   
        $asize = '1-2 BHK' ;
        $stmt->bindParam(':asize',$asize);       
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    public function get23bhkApartmentCount()
    {
        $query = "SELECT count(*) FROM estate_infos WHERE size=:asize " ;
        $stmt =  $this->connect()->prepare($query);   
        $asize = '2-3 BHK' ;
        $stmt->bindParam(':asize',$asize);         
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    public function get34bhkApartmentCount()
    {
        $query = "SELECT count(*) FROM estate_infos WHERE size=:asize " ;
        $stmt =  $this->connect()->prepare($query);   
        $asize = '3-4 BHK' ;
        $stmt->bindParam(':asize',$asize);         
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    public function viewAllApartments()
    {
        $arr =array();
        $query = "SELECT * FROM estate_infos ORDER BY id DESC" ;
        $stmt =  $this->connect()->prepare($query);         
        $stmt->execute();
        $datas=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($datas as $key=>$data){
            $arr[]= $datas;
        }
        return $arr;
    }
    public function viewAllImages()
    {
        $arr =array();
        $query = "SELECT * FROM img_info LEFT JOIN estate_infos ON img_info.estate_infos_id = estate_infos.id ORDER BY img_id DESC";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($datas as $key=>$data){
            $arr[]= $datas;
        }
        return $arr;
    }
    public function getFeaturedApartments()
    {
        $arr =array();
        $query="SELECT i.*, e.*
        FROM estate_infos e
        join img_info i ON i.estate_infos_id = e.id
        JOIN (
            SELECT MIN(img_id) img_id, estate_infos_id FROM img_info GROUP BY estate_infos_id
        ) m
        WHERE i.img_id = m.img_id ORDER BY estate_infos_id DESC LIMIT 3";
        $stmt =  $this->connect()->prepare($query);         
        $stmt->execute();
        $datas=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($datas as $key=>$data){
            $arr[]= $datas;
        }
        return $arr;
    }
    public function getExploredApartments()
    {
        $arr =array();
        $query="SELECT i.*, e.*
        FROM estate_infos e
        join img_info i ON i.estate_infos_id = e.id
            JOIN (
                    SELECT MIN(img_id) img_id, estate_infos_id FROM img_info GROUP BY estate_infos_id
                ) m
        WHERE i.img_id = m.img_id ORDER BY estate_infos_id DESC LIMIT 6";
        $stmt =  $this->connect()->prepare($query);         
        $stmt->execute();
        $datas=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($datas as $key=>$data){
            $arr[]= $datas;
        }
        return $arr;
    }
    public function getLoadData()
    {
        $arr =array();
        $query="SELECT i.*, e.* FROM estate_infos e
                join img_info i ON i.estate_infos_id = e.id
                JOIN (SELECT MIN(img_id) img_id, estate_infos_id FROM img_info GROUP BY estate_infos_id) m
                WHERE i.img_id = m.img_id ORDER BY estate_infos_id DESC LIMIT ".$_POST['start'].",".$_POST['limit']."";
        $stmt=$this->connect()->prepare($query);
        $stmt->execute();
        $datas=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($datas as $key=>$data){
            $arr[]= $datas;
        }
        return $arr;
    }
    public function isApartmentIdCorrect()
    {
        $a=$_SERVER['REQUEST_URI'];
        $uri= substr($a, strpos($a, "=") + 1);
        $_SESSION['e_id'] = $_GET['pid'];
        $stmt=$this->connect()->prepare("SELECT count(uuid) from estate_infos WHERE uuid='".$uri."' LIMIT 1" );
        $stmt->execute();
        $count = $stmt->fetchColumn();      
        
        return $count;
    }
    public function getImage()
    {
        $arr =array();
        $query = "SELECT img_uuid,name,image,estate_infos_uuid FROM img_info WHERE estate_infos_uuid='".$_GET['pid']."'";
        $stmt=$this->connect()->prepare($query);
        $stmt->execute();
        $datas=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($datas as $key=>$data){
            $arr[]= $datas;
        }
        return $arr;
    }
    
    public function getAptDetails()
    {
        $arr =array();
        $query = "SELECT * FROM estate_infos WHERE uuid='".$_GET['pid']."'";
        $stmt=$this->connect()->prepare($query);
        $stmt->execute();
        $datas=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($datas as $key=>$data){
            $arr[]= $datas;
        }
        return $arr;
    }
    public function getGeoLocationDetails()
    {
        $arr =array();
        $query = "SELECT lat,lng FROM estate_infos WHERE uuid='".$_GET['pid']."'";
        $stmt=$this->connect()->prepare($query);
        $stmt->execute();
        $datas=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($datas as $key=>$data){
            $arr[]= $datas;
        }
        return $arr;
    }
    public function isApartmentSaved()
    {
        if(isset($_SESSION['user_id']))
        {
            $google_uid = $_SESSION['user_id'];
        }
        $euuid=$_SESSION['e_id'];
        $status=1;
        $q ="SELECT count(*) FROM fav_estate WHERE estate_infos_uuid=:euuid AND google_user_id=:gouid AND status=:status" ;
        $stmt = $this->connect()->prepare($q);
        $stmt->bindParam(':euuid', $euuid);
        $stmt->bindParam(':gouid', $google_uid);
        $stmt->bindParam(':status', $status,FILTER_SANITIZE_NUMBER_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    public function getApartmentName()
    {
        $arr =array();
        $query="SELECT apartment_name from estate_infos WHERE uuid='".$_GET['pid']."' LIMIT 1";
        $stmt=$this->connect()->prepare($query);
        $stmt->execute();
        $datas=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($datas as $key=>$data){
            $arr[]= $datas;
        }
        return $arr;
    }
    public function favApartments()
    {
        $arr =array();
        $query = "SELECT * FROM estate_infos INNER JOIN fav_estate 
                WHERE 
                estate_infos.uuid=fav_estate.estate_infos_uuid 
                AND fav_estate.google_user_id='".$_SESSION['user_id']."' 
                ORDER BY fav_estate.id DESC ";
        $stmt=$this->connect()->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        $datas=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($datas as $key=>$data){
            $arr[]= $datas;
        }
        return $arr;
    }
    public function favApartmentsCount()
    {
        $query = "SELECT * FROM estate_infos INNER JOIN fav_estate 
                WHERE 
                estate_infos.uuid=fav_estate.estate_infos_uuid 
                AND fav_estate.google_user_id='".$_SESSION['user_id']."' 
                ORDER BY fav_estate.id DESC ";
                $stmt =  $this->connect()->prepare($query);           
                $stmt->execute();
                $count = $stmt->rowCount();
                return $count;
    }
    

}