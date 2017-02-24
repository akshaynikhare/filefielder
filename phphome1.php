<?php
include "Opration.php";
$op= new Opration();
$op->EXPC();
session_start();
if($_SESSION["id"]) {}
else
{
    header("Location:index.php");
}

header('Content-Type:application/json');
$ar=array();

function adays($date,$days){
    $date=strtotime("+".$days."days",strtotime($date));
    return date("Y-m-d",$date);
}
function atime($time,$h,$m){
    $tm=strtotime("+".(($h*60)+$m)."minutes",strtotime($time));
    return date("H:i:s",$tm);
}


if(!isset($_POST['functionname'])){$ar['error']='No function name';}
if(!isset($_POST['pname'])){$ar['error']='No function name';}

if(!isset($ar['error'])){
    switch ($_POST['functionname']){
        case 'uplink':
            if(!$_POST['pname']||!$_POST['mode']){
                $ar['error']="error in argument";
            }else
            {
               // $ar['result']=add(2,5);

                //////////////////////////////////////////////////////////////////////////////////////

                $user=$_SESSION["id"];
                $pfile=$_POST['pname'];
                $mode=$_POST['mode'];
                $day=$_POST['days'];
                $hr=$_POST['hours'];
                $mi=$_POST['min'];
                $size=$_POST['size'];
                $handle = fopen("pfiles/".$pfile, "rb");
                $contents = fread($handle, filesize("pfiles/".$pfile));
                fclose($handle);
                $task=new Opration();
                if($contents&& $pfile&&$user&&$mode) {
                    $task->Upload($pfile, $contents, $user, $mode,$size,date("Y-m-d"), date("H:i:sa"),adays(date("Y-m-d"),$day),atime(date("H:i:sa"),$hr,$mi));
                    $files = "pfiles/" . $pfile;
                    if (is_file($files))
                        if (unlink($files) == false)
                            $ar['error']="unable to deleat -> " . $file;  //deleat file
                }
          ////////////////////////////////////////////////////////////////////////////////////
            }
            break;

        default:
            $ar['error']="no functon found ".$_POST['functionname'].' !';
            break;
    }
}
