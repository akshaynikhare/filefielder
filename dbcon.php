<?php
function dbcon($table){
$con = mysqli_connect("localhost","root","",$table);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else {
      return $con;
  }
}


//will deleat flag downn keys in dbase
function delete(){
    $conn=new mysqli("localhost","root","","ecloud");
    if($conn->connect_error)
    {
        die("failed to comment to database".$conn->connect_error);
    }
    $d=date("Y-m-d");
    $delete=$conn->query("DELETE FROM upload WHERE date<'$d' AND flag=0");
}




  ?>
