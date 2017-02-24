<?php
require "SQLopration.php";
require "Cryptos.php";
require "MailService.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Opration
 *
 * @author Asus
 */
class Opration {


    public function EXPC(){
        $ex =new SQLopration();
        $ex->EXPC();
    }

    public function get_fname($un)
    {
        $ex = new SQLopration();
        return $ex->get_fname($un);
    }

    public function Upload($file_name,$file_data,$u_id,$mode,$size,$date,$time,$exp_d,$exp_t){
        //upload file and provide key
        $crypt=new Cryptos();
        $mail=new MailService();
        $sql= new SQLopration();
        $getku=$crypt->Ency($file_name, $file_data);
        $rmail=$sql->get_mail($u_id);
        //send key by mail and text is remaining
        $mail->send_mail($file_name,$getku[0],$rmail);
        $sql->upload_file($u_id, $file_name,$getku[1],$mode,$size, $date, $time,$exp_d,$exp_t,$getku[0]);
        //cleaning inbound temprery
        $files = glob('in_t/'.$file_name);
        foreach($files as $file) {
            if (is_file($file))
                if (unlink($file) == false)
                    echo "<br> unable to deleat -> " . $file;//deleat file
        }
             //header("location:key_info.php?key='$getkey'&filename='$file_name'");
   }
   public  function speadtest()
   {
       $kb=1;
       flush();
       $time=explode(" ",microtime());
       $start=$time[0]+$time[1];
       $data="";
       for($x=0;$x<($kb*1024);$x++){
           $data.=chr(mt_rand(97,97+20));
       }
       flush();
       $time=explode(" ",microtime());
       $finish=$time[0]+$time[1];
       $del=$finish-$start;
       return round($kb/$del,0);
   }


    public function Download($uname, $key){

        //proceger for download file by key
        $sqlk= new SQLopration();
        echo " <br> keys=".$key." <br>";
        echo " <br> file=".$uname." <br>";
       if($sqlk->check_key($uname, $key) >0){
        $crypt=new Cryptos();
        $sql= new SQLopration();
        echo "condirm";
           ?>
           <div class="progress">
               <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                    aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width:99%">
                   Starting download
               </div>
           </div>
           <?php

           $crypt->Decy(($sql->get_fname($uname)),$uname, $key);

       }
       else
       {
           echo "key did not match";
           ?>
           <div class="progress">
               <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar"
                    aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width:89%">
                   key did not match
               </div>
           </div>
           <?php
           //header('location:home.php');
       }
    }
}

?>



