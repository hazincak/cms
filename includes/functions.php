<?php

if(isset($_POST['method'])){
    include "../includes/db.php"; 
    $calledMethod = $_POST['method'];
    $ingredientId;
    $imageId;
    $imageName;

    if(isset($_POST['ingredientId'])){
        $ingredientId = $_POST['ingredientId'];
    };

    if(isset($_POST['imageId'])){
        $imageId = $_POST['imageId'];
        $imageName = $_POST['imageName'];
    };

    switch ($calledMethod) {
        case "deleteIngredient":
            $calledMethod = null;
            deleteIngredient($ingredientId, $connection);
            break ;  /* Exit only the switch. */
        case "deleteImage":
            $calledMethod = null;
            deleteImage($imageId, $imageName, $connection);
            break;
        default:
            break;
    }
}

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

function deleteImage($imageId, $imageName, mysqli $connection){
    $query = "DELETE FROM images WHERE image_id = $imageId";
    $delete_image_query = mysqli_query($connection, $query);
    confirm($delete_image_query);
    deleteImageFromProjectFolder($imageName);
    echo 'success';
}


function deleteIngredient($ingredientId, mysqli $connection){
    $query = "DELETE FROM ingredients WHERE ingredient_id = $ingredientId";
    $delete_ingredient_query = mysqli_query($connection, $query);
    confirm($delete_ingredient_query);
    echo json_encode('success');
}

function deleteImageFromProjectFolder($imageName){
    if($imageName == null){
        return;
    }else{
        $path = "../../images/postImages/" . $imageName;
        unlink($path);
    }
   
}

?>