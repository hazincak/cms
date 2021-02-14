<?php

function escape($string){

global $connection;

return mysqli_real_escape_string($connection, trim($string));
};

function confirm($result){
    global $connection;
    if(!$result){
        die("QUERY fAILED" . mysqli_error($connection));
    }
}

?>