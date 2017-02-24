<?php
require "dbcon.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class SQLopration{



    public function EXPC()
    {
       $cn =dbcon("ecloud");
        $query = mysqli_query($cn, "SELECT * FROM file ");

        if($query!="") {
            while ($row = mysqli_fetch_array($query)) {
                if ($row["mode"] == 'T') {
                    if ((date("Y-m-d") >= $row["exp_date"])) {
                        //echo date("H:i:s") . "    >      " . $row["exp_time"];
                        if (date("h:i:s") >= $row["exp_time"]) {
                            // echo "<br> expired";
                            $fq=mysqli_query($cn,"UPDATE file SET flag = '0' WHERE file.id =".$row['id']);
                            $files = "files/" . $row["fname"];
                            if (is_file($files))
                                if (unlink($files) == false)
                                    $ar['error'] = "unable to deleat -> " . $row["fname"];  //deleat file
                        } else {
                            //echo " <br>     time is still not completed          time to expire  " . $row["exp_time"];

                        }
                    } else {
                        //  echo "  <br>    file will not expire today        expire date  ".$row["exp_date"];

                    }
                }//else
                // echo "perminent file ".$row['fname'];
            }
        }

    }

  function add_user($username,$password,$user,$email,$ph){
      //add user
      $con = dbcon("ecloud");
      $query = mysqli_query($con, "INSERT INTO users(username, password, name,email,ph,status) VALUES ('$username','$password','$user','$email','$ph','no')");
			if($query !="")
                        {
                           echo "<script> alert('User Registerd Successful'); window.location.href='index.php'; </script>  " ;
                            
                        }
  }
  
  function add_admin(){
      //add admin
       $con = dbcon("ecloud");
  }
  function upload_file($user,$fname,$uname,$mode,$size,$date,$time,$exp_d,$exp_t,$key){

       $con = dbcon("ecloud");
     $query 		= mysqli_query($con, "INSERT INTO file(user_id,fname,uname,mode,date,time,exp_date,exp_time,size) VALUES ('$user','$fname','$uname','$mode','$date','$time','$exp_d','$exp_t','$size')");
      $query        = mysqli_query($con, "INSERT INTO fkeys(uname,keyx) VALUES ('$uname','$key')");
      $con->close();
                       
  }

  function get_fname($uname){
       $con =dbcon("ecloud");
      $query = mysqli_query($con, "SELECT fname FROM file WHERE  uname='$uname'");
      while($row = mysqli_fetch_array($query)) {
          return $row["fname"];
      }
      return 0;

  }

    function get_uname_size($uname){
        $con =dbcon("ecloud");
        $query = mysqli_query($con, "SELECT * FROM file WHERE  uname='$uname'");
        while($row = mysqli_fetch_array($query)) {
            return $row["size"];
        }
            return 0;
    }

  function check_key($uname,$key)
  {
      $con = dbcon("ecloud");
      $query = mysqli_query($con, "SELECT * FROM fkeys WHERE  uname='$uname'AND keyx='$key'");
      //echo var_dump($query);
      if($query!="")
      {
          $num_row = mysqli_num_rows($query);
          if ($num_row == 1) {
              return true;
          }
      }

      return false;
  }
  function get_mail($u_id){
      $con = dbcon("ecloud");
        $query = mysqli_query($con, "SELECT * FROM users WHERE  id='$u_id'");
       $row1=mysqli_fetch_array($query);
        $email=$row1['email'];
             //email of user retrived

   return $email;
  }
}
?>