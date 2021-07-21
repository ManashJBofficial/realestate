<?php 
session_start();

class adminLogin extends Dbh
{
    public function login($uname,$pass,$role)
    {
            $uname = $_POST['uname'];   
            $pass = md5($_POST['pass']);
            $role = $_POST['role'];

            $sql ="SELECT username,`password`,`role` from google_users WHERE username=:uname && `password`=:pass && `role`=:role";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':uname',$uname);
            $stmt->bindParam(':pass',$pass);
            $stmt->bindParam(':role',$role);
            $stmt->execute();
    
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            $count = $stmt->rowCount();
            if($count >0){
                $_SESSION["uname"] = $_POST["uname"];
                $_SESSION["role"] = $_POST["role"];
    
                header("location:../admin-dashboard/dashboard");
            }
            else{
                echo "<script>alert('WRONG USERNAME OR PASSWORD !')</script>";
            
            ?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=../index">
<?php 
        }
        
    }
        
    }

?>