<?php 

function base_url(){
    $url = "http://34.215.237.227/api/";
    return $url;
}

function redirect_to($new_location){
    header("Location: ".$new_location);
    exit;
}