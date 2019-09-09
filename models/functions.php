<?php 

function base_url(){
    $url = "https://cryptic-stream-42858.herokuapp.com/";
    return $url;
}

function redirect_to($new_location){
    header("Location: ".$new_location);
    exit;
}