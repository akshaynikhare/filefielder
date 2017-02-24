<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function file_create($fpath){
//create new file
    $handle=  fopen($fpath, 'w');
    fclose($handle);
}

function file_write($fpath,$data){
    $handle=  file_put_contents($fpath, $data);
    //fclose($handle);
}

function file_read($fpath){
    //$myfile=  fopen($fpath, 'r');
   $data= file_get_contents($fpath);
   // $data=  fread($myfile, filesize($myfile));
   // fclose($myfile);
    return $data;
}

?>



