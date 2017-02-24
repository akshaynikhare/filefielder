<?php

include 'Key.php';
include 'FileOp.php';
include 'download.php';

class Cryptos {
public function Ency($file_name,$file_data){
    //encrypt proceger
    $kk=new Key();
    $kgc=  $kk->Rkey();
    $dgc=  $kk->Rkey();
    $Ename=$file_name.'_'.$kgc;
    $Edata=$this->mc_encrypt($file_data,$dgc);
    $kkk=new Key();
    $final_key=$kkk->KeyGen($kgc,$dgc);
    file_create("files/".$Ename);
    file_write("files/".$Ename, $Edata);
    $fd[0]=$final_key;
    $fd[1]=$kgc;
    return $fd;
}
public function Decy($filename,$fileun, $key)
{
   $fname= $fileun;
   $fdata=  file_read("files/".$filename.'_'.$fileun);
   $kkkk=new Key();
   $keya=$kkkk->GenKey($key);
   $kgc=$keya[0];
    $dgc=$keya[1];
    echo "<br><br>kgc=   ".$kgc;
    echo "<br><br>dgc=   ".$dgc;
    $fname=$this->mc_decrypt($fname,$kgc);
    $fdata=$this->mc_decrypt($fdata,$dgc);
    file_create("out_t/".$filename);
    file_write("out_t/".$filename, $fdata);
    echo "<br>staring download...";
    output_file("out_t/".$filename,$filename);



}

//encryption proceger
public  function mc_encrypt($encrypt, $key)
    {
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key = pack('A*', $key);
        $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
        $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);

        return $encoded;

    }


// Decrypt Function
public function mc_decrypt($decrypt, $key)
{

    $decrypt = explode('|', $decrypt.'|');
    $decoded = base64_decode($decrypt[0]);
    $iv = base64_decode($decrypt[1]);
    if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
    $key = pack('A*', $key);
    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
    $mac = substr($decrypted, -64);
    $decrypted = substr($decrypted, 0, -64);
    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
    if($calcmac!==$mac){ return false; }
    $decrypted = unserialize($decrypted);
    return $decrypted;

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
<form >
    <input type="text" name="key"/>
    <input type="submit" name="verify" value="verify"/>
</form>
<?php
/*
if (isset($_REQUEST['verify'])){


    $taskd=new Cryptos();
    $taskd->Download("he.txt", "DKJLAQHOGRHLBKCNIQDMBNDJENFOJNFN");
}
*/
?>
</body>
</html>
-->
