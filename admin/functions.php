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
}

function users_online(){
    
    if(isset($_GET['onlineusers'])){
        global $connection;

        if(!$connection){
            session_start();
            include("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 30;
            $time_out = $time - $time_out_in_seconds;
    
            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);
    
                if($count == NULL){
                    mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
                }else{
                    mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
                }
            $users_online_query = mysqli_query ($connection, "SELECT * FROM users_online WHERE time  > '$time_out'");
            echo  $count_user = mysqli_num_rows($users_online_query);
        }
    }
}
users_online();


function confirm($result){
    global $connection;
    if(!$result){
        die("QUERY fAILED" . mysqli_error($connection));
    }
}

function insert_categories(){
    global $connection;

    if(isset($_POST['submit'])){
        $cat_title = $_POST["cat_title"];
    
        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        } else{
            $query = "INSERT INTO categories(cat_title)";
            $query .="VALUE('{$cat_title}')";

            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query){
                die("QUERY FAILED" . mysqli_error($connection));
            }
        }
    }

}

function findAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

     while($row = mysqli_fetch_assoc($select_categories)){
        
        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href ='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href ='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    };
}

function deleteCategories(){
    global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = '{$the_cat_id}'";
            $delete_query = mysqli_query($connection, $query);
            header("Location: categories.php"); //refreshening page - redirecting page on click
    }
}

function deleteImage($imageId, $imageName ,mysqli $connection){
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
        $path = "../images/postImages/" . $imageName;
        unlink($path);
    }
    
}

?>