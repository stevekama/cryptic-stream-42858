<?php 

function base_url(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'] .dirname($_SERVER['REQUEST_URI']).'/api/';
}

function redirect_to($new_location){
    header("Location: ".$new_location);
    exit;
}