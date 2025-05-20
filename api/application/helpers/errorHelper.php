<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');


function custom_error_log($msg, $file = null, $class = null, $function = null){
    // __FILE__, __CLASS__, __FUNCTION__
    $file_path = FCPATH."error/".date('d-m-Y').'error_log.log';
    $logMsg = date('d-m-Y')." ".$msg;
    
    if(!file_exists($file_path)){
        $error_file = fopen($file_path,'w');
    }else{
        $error_file = fopen($file_path,'a');
    }

        if($file != null){
            //Add file where error was generated
            $logMsg .= " FILE : " . $file . "\n";
        }
        if($class != null){
            //Add class where error was generated
            $logMsg .= " CLASS : " . $class . "\n";
        }
        if($function != null){
            //Add function where error was generated
            $logMsg .= " FUNCTION : " . $function . "\n";
        }

        $result = fwrite($error_file,$logMsg);
        fclose($error_file);
}



?>