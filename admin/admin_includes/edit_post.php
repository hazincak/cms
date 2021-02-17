
<?php 
if(isset($_GET['p_id'])){
   $the_post_id = $_GET['p_id'];
}

$query = "SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.post_user_id = users.user_id WHERE post_id = {$the_post_id} ";
$select_posts_by_id = mysqli_query($connection, $query);

 while($row = mysqli_fetch_assoc($select_posts_by_id)){
   $post_id = $row['post_id'];
   $post_author = $row['username'];
   $post_title = $row['post_title'];
   $post_short_description = $row['post_short_description'];
   $post_category_id = $row['post_category_id'];
   $post_date = $row['post_date'];
   $post_content = $row['post_content'];
   $post_preparation_time = $row['post_prep_time'];
   $post_cooking_time = $row['post_cook_time'];
   $post_servings = $row['post_servings'];
   $post_status = $row['post_status'];
   $post_image = $row['post_image'];
   $post_tags = $row['post_tags'];
   $post_comment_count = $row['post_comment_count'];
 }
?>
<?php

if(isset($_POST['update_post'])){
    $post_title = escape( $_POST['title']);
    $post_short_description = escape($_POST['post_short_description']);
    $post_category_id = escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);
    
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);

    $post_preparation_time = escape($_POST['preparation_time']);
    $post_cooking_time = escape($_POST['cooking_time']);
    $post_servings = escape($_POST['servings']);

    
    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        $select_image=mysqli_query($connection,$query);
        while($row = mysqli_fetch_array($select_image)){
            $post_image = $row['post_image'];
        }
    }

    // Count total files
    $countfiles = count($_FILES['file']['name']);
    // Looping all files
    for($i=0;$i<$countfiles;$i++){
    $filename = $_FILES['file']['name'][$i];
    // Upload file
    move_uploaded_file($_FILES['file']['tmp_name'][$i],'../images/postImages/'.$filename);
    $query = "INSERT INTO images (image_name, image_post_id)";
    $query .= "VALUES('{$filename}','{$the_post_id}')";
    $attach_image_query = mysqli_query($connection, $query);
    confirm($attach_image_query);
  }

  $ingredients = $_POST['ingredient'];
    $trimmed_array = array_map('trim', $ingredients);
    foreach($trimmed_array as $ingredient){
        $ingredient_description = $ingredient;
        $query = "INSERT INTO ingredients (ingredient_description, ingredient_post_id)";
        $query .= "VALUES('{$ingredient_description}','{$the_post_id}')"; 
        $attach_ingredients_query = mysqli_query($connection, $query);
        confirm($attach_ingredients_query);
  }

   $query ="UPDATE posts SET ";
   $query .="post_title ='{$post_title}', ";
   $query .="post_category_id ='{$post_category_id}', ";
   $query .="post_date = now(), ";
   $query .="post_status ='{$post_status}', ";
   $query .="post_tags ='{$post_tags}', ";
   $query .="post_content ='{$post_content}', ";
   $query .="post_prep_time ='{$post_preparation_time}', ";
   $query .="post_cook_time ='{$post_cooking_time}', ";
   $query .="post_servings ='{$post_servings}', ";
   $query .="post_image ='{$post_image}' ";
   $query .="WHERE post_id = {$the_post_id} ";

    $update_post = mysqli_query($connection, $query);   
    confirm($update_post);  
    echo "<p class='bg-success'>Post Updated. <a href ='../post.php?p_id={$the_post_id}'>View Post</a>&nbspor&nbsp<a href='posts.php'>Edit More Posts</a></p>";
}
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for ="title">Post Title</label>
            <div><input value="<?php echo $post_title; ?>" type ="text" class="form-control" name="title"></div>
    </div>
    <div class="form-group">
        <label for ="post_short_description">Recipe Short Description</label>
        <div><input type ="text" value="<?php echo $post_short_description; ?>" class="form-control" name="post_short_description"  required></div>
    </div>
    <div class="form-group">
        <label>Post Category</label>
            <select class="form-control" name="post_category" id="">
<?php 
 $query = "SELECT * FROM categories";
 $select_categories = mysqli_query($connection, $query);

// confirm($select_categories);

  while($row = mysqli_fetch_assoc($select_categories)){
    $cat_id = $row["cat_id"];
    $cat_title = $row["cat_title"];

        echo"<option value = '{$cat_id}'>{$cat_title}</option>";
  }
?>

                </select>            
    </div>
    <div class="form-group">
        <label for ="post_author">Post Author</label>
            <input disabled value="<?php echo $post_author; ?>" name="post_author" type ="text" class="form-control" >
    </div>
    <div class="form-group">
        <label for ="post_status">Post Status</label>
            <select class="form-control" name="post_status" id="">
                <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
                <?php
                if ($post_status == "published"){
                    echo "<option value='draft'>Draft</option>";
                }else{
                    echo "<option value='published'>Publish</option>";
                }
                ?>
            </select>
    </div>
    <div class="form-group">
        <label for ="image">Post Main Image</label>
            <div><img width= 100   src="../images/<?php echo $post_image?>"></div>
            <div><input type ="file" style="margin-top: 3px"  name="image"></div>
    </div>
    <div class="form-group">
        <label>Delete Recipe Images</label>
        <div class="row">
            
             <?php 
             $query = "SELECT * FROM images WHERE image_post_id=$the_post_id";
             $select_posts_images = mysqli_query($connection, $query);
             while($row = mysqli_fetch_assoc($select_posts_images)){
                 $image_name = $row['image_name'];
                 $image_id = $row['image_id'];
                 echo "
                 <span class='js--image-block'>
                    <div class='col-md-1 '>
                       <img class='img-responsive' style='max-width:150px'   src='../images/postImages/$image_name'>
                       <button data-imageId=$image_id  data-imageName = $image_name class='btn btn-secondary js--delete-image-button'>Delete image</button>
                    </div>
                </span>";
             }
             confirm($select_posts_images);
             ?>
        </div>
    </div>
    <div class="form-group js--image-container">
        <label for="file">Add More Recipe Images</label>
        <input type="file" class="form-control-file mb-2" name="file[]"/>
    </div>
    <button type="button" class="btn btn-secondary btn-sm js--add-image-button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add image</button>
    <hr>
    <div class="form-group">
        <div class="row">
             <div class="col-md-6">
             <label>Delete Ingredients</label>
                <ul class="list-group">
                    <?php
                       $query = "SELECT * FROM ingredients WHERE ingredient_post_id = $the_post_id";
                       $select_posts_ingredients = mysqli_query($connection, $query);
                       while($row = mysqli_fetch_assoc($select_posts_ingredients)){
                           $ingredient_name = $row['ingredient_description'];
                           $ingredient_id = $row['ingredient_id'];
                           echo "
                           <li class='list-group-item js--ingredient-block'>
                                <span><a type='button' data-ingredientId=$ingredient_id data-postId=$the_post_id class='btn btn-danger js--delete-ingredient-button'><span class='glyphicon glyphicon-remove'></a></span> 
                                {$ingredient_name}
                           </li>
                           ";
                       }
                       confirm($select_posts_images);
                    ?>
                </ul>
             </div>
             <div class="col-md-6">
                <label>Add Ingredients Amount And Description</label>
                <div class="row js--ingredients-block">
                    <input 
                        type="text"
                        class="form-control" 
                        name="ingredient[]" 
                        placeholder="Enter ingredient amount and description"
                        />     
                </div>
                <div>
                    <button type="button" name="addButton" style="margin-top: 5px;" class="btn btn-success btn-block btn-sm js--add-ingredient-button"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add ingredient</button>
                </div>              
             </div>
        </div>
        
    </div>
    <div class="row">
      <div class="col-md-4">
      <label for ="preparation_time">Preparation time</label>
        <select name="preparation_time" class="form-control" required>
          <option value="<?php echo $post_preparation_time; ?>" selected><?php echo $post_preparation_time; ?> minutes</option>
          <option value="5">5 minutes</option>
          <option value="10">10 minutes</option>
          <option value="15">15 minutes</option>
          <option value="30">30 minutes</option>
          <option value="60">60 minutes</option>
          <option value="90">90 minutes</option>
          <option value="120">120 minutes</option>
          <option value="160">160 minutes</option>
        </select>
      </div>
      <div class="col-md-4 form-group">
        <label for="cooking_time" >Cooking time</label>
        <select name="cooking_time" class="form-control" required>
        <option value="<?php echo $post_cooking_time; ?>" selected><?php echo $post_cooking_time; ?> minutes</option>
          <option value="5">5 minutes</option>
          <option value="10">10 minutes</option>
          <option value="15">15 minutes</option>
          <option value="30">30 minutes</option>
          <option value="60">60 minutes</option>
          <option value="90">90 minutes</option>
          <option value="120">120 minutes</option>
          <option value="160">160 minutes</option>
        </select>
      </div>
      <div class="col-md-4 form-group">
        <label for="servings">Servings</label>
        <select name="servings" class="form-control" required>
        <option value="<?php echo $post_servings; ?>" selected><?php echo $post_servings; ?></option>
          <option value="1" >1</option>
          <option value="2" >2</option>
          <option value="3" >3</option>
          <option value="4" >4</option>
          <option value="5" >5</option>
          <option value="6" >6</option>
          <option value="7" >7</option>
          <option value="8" >8</option>
        </select>
      </div>
  </div>
    
    <div class="form-group">
        <label for ="post_tags">Post Tags</label>
            <input value="<?php echo $post_tags; ?>" type ="text" class="form-control" name="post_tags">
    </div>
    <div class = "form-group">
        <label for ="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows ="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <div><input class="btn btn-primary" type="submit" name="update_post" value="Update Post"></div>
    </div>


</form>
<script>
$(document).ready(function(){
    $('.js--add-image-button').click(function(){
        $('.js--image-container').append('<input class="form-control-file" style="margin-top: 3px" type="file" name="file[]"/>')
      });
    $('.js--add-ingredient-button').click(function(){
        $('.js--ingredients-block').append(`
            
                <label>New Ingredient</label>
                <input 
                  type="text"
                  class="form-control" 
                  name="ingredient[]" 
                  placeholder="Enter ingredient amount and description">
            
        `)
      });
    $('.js--delete-image-button').click(function(){
        var clickedElement = $(this);
        var imageId = $(clickedElement).attr('data-imageId');
        var imageName = $(clickedElement).attr('data-imageName');
        $.ajax({
                url:"functions.php",
                type:"post",
                data: {
                    method: "deleteImage",
                    imageId: imageId,
                    imageName: imageName
                },
                success: function(response){
                   if(response === 'success'){
                    $(clickedElement).closest('.js--image-block').remove();
                   }
                }
            })

    });
    $('.js--delete-ingredient-button').click(function (){
        var clickedElement = $(this);
        var ingredientId = $(clickedElement).attr('data-ingredientId');

            $.ajax({
                url:"functions.php",
                type:"post",
                dataType: 'json',
                data: {
                    method: "deleteIngredient",
                    ingredientId: ingredientId,
                },
                success: function(response){
                         if(response === 'success'){
                         $(clickedElement).closest('.js--ingredient-block').remove();
                        }                   
                    }
                   
                
            })

    });

    


})

// <a  href='posts.php?deleteImage={$image_id}&p_id={$the_post_id}' class='btn btn-secondary'>Delete image</a>
</script>
        