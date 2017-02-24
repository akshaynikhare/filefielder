<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Key
 *
 * @author Asus
 */

class Key {

   function KeyGen($kgc,$dgc){
      $keyout="";
       $k="";
       for($i=0;$i<16;$i++){
           $num1=ord($kgc[$i])+17;
           $num1=chr($num1);
           $num2=ord($dgc[$i])+26;
           $num2=chr($num2);
           $k=$num1.$num2;
           $keyout.=$k;
       }
      // echo "finalllllllllllll....".$keyout;
       return $keyout;
   }
   function GenKey($key){
       $kgc='';
       $dgc='';
       for($i=0;$i<32;$i++,$i++){
           $num=ord($key[$i])-17;
           $kgc.=chr($num);
           $num1=ord($key[$i+1])-26;
           $dgc.=chr($num1);
       }

       // echo  "kgc=".$kgc."<br>";
       //echo  "dgc=".$dgc."<br>";

       return array($kgc,$dgc);
   }

    function Rkey(){
        $num=  mt_rand(11111111, 99999999);
        $num2= mt_rand(11111111, 99999999);
        return (string)$num.$num2;
    }


}
?>

<!--
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form>
    <input type="text" name="key"/>
    <input type="submit" name="verify" value="verify"/>
</form>
<?php
/*

if(isset($_REQUEST['key'])){
    $key=$_REQUEST['key'];
    $k=new key();
    $gen=$k->KeyGen("644129891493868069","146723761135263704");


    echo "<br><br><br> now dwcoding<br><br><br>";
    $k->GenKey($gen);


}
*/
?>
</body>
</html>
-->