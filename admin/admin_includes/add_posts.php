<?php

if(isset($_POST['create_post'])){
    $post_title = escape($_POST['title']);
    $post_short_description = escape($_POST['post_short_description']);
    $post_author_id = $_SESSION['user_id'];
    $post_category_id = escape($_POST['post_category']);
    $post_status = escape( $_POST['post_status']);
    
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = escape(date('d-m-y'));
    
    $post_preparation_time = escape($_POST['preparation_time']);
    $post_cooking_time = escape($_POST['cooking_time']);
    $post_servings = escape($_POST['servings']);

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_short_description, post_user_id, post_date, post_image, post_content, post_prep_time, post_cook_time, post_servings, post_tags, post_status)";
    $query .= "VALUES('{$post_category_id}','{$post_title}','{$post_short_description}','{$post_author_id}',now(),'{$post_image}','{$post_content}','{$post_preparation_time}','{$post_cooking_time}','{$post_servings}','{$post_tags}','draft')";

    $create_post_query = mysqli_query($connection, $query);
    $the_post_id = mysqli_insert_id($connection);

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

    confirm($create_post_query);
    $the_post_id = mysqli_insert_id($connection);//pulls out last created ID.
    echo "<p class='bg-success'>Post Created. <a href ='../post.php?p_id={$the_post_id}'>View Post</a>&nbspor&nbsp<a href='posts.php'>Add More Posts</a></p>";
}
?>




<h3>Create recipe</h3>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="post_title">Recipe Title</label>
      <input type="text" class="form-control" id="post_title" name="title"  placeholder="Enter title" required>
    </div>
    <div class="form-group">
        <label for ="post_short_description">Recipe Short Description</label>
        <div><input type ="text" class="form-control" name="post_short_description" placeholder="Enter short recipe description" required></div>
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select class="form-control" name="post_category" id="" required>
      <?php 
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_categories)){
          $cat_id = $row["cat_id"];
          $cat_title = $row["cat_title"];
              echo"<option value = '{$cat_id}'>{$cat_title}</option>";
        }
      ?>
      </select>
    </div>
    <div class="form-group">
        <label for ="post_status">Post Status</label>
        <select name = "post_status">
            <option value ="draft">Post Status</option>
            <option value ="published">Publish</option>
            <option value ="draft">Draft</option>
        </select>
            
    </div>
    <div class="form-group">
      <label for ="image">Recipe main image</label>
      <input type ="file" class="form-control-file" name="image" required>
    </div>
    <div class="form-group js--image-block">
      <label for="file">Recipe images</label>
      <input type="file" class="form-control-file mb-2" name="file[]" required/>
    </div>
    <button type="button" class="btn btn-secondary btn-sm js--add-image-button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add image</button>
    <hr>
    <div class="row js--ingredients-block">
        <div class="col-md-12 form-group">
            <label>Ingredient amount and description</label>
            <input 
              type="text"
              class="form-control" 
              name="ingredient[]" 
              placeholder="Enter description"
              />
             
        </div>
    </div>
    <div>
          <button type="button" name="addButton" class="btn btn-success btn-sm js--add-ingredient-button"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add ingredient</button>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-4">
      <label for ="preparation_time">Preparation time</label>
        <select name="preparation_time" class="form-control" required>
          <option selected disabled>Choose preparation time</option>
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
          <option selected disabled>Choose cooking time</option>
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
          <option selected disabled>Choose servings</option>
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
  <!-- row -->
  <div class="form-group">
        <label for ="post_tags">Post Tags</label>
        <div><input type ="text" class="form-control" name="post_tags" required></div>
  </div>
  <div class = "form-group">
        <label for ="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows ="30" ></textarea>
  </div>
  <button type="submit" name="create_post" class="btn btn-primary btn-block">Submit</button>
</form>



<script>
   $(document).ready( function() {

      $('.js--add-image-button').click(function(){
        $('.js--image-block').append('<input class="form-control-file mb-2" type="file" name="file[]"/>')
      });

      $('.js--add-ingredient-button').click(function(){
        $('.js--ingredients-block').append(`
        <div class="col-md-12 form-group">
            <label>Ingredient amount description</label>
            <input 
              type="text"
              class="form-control" 
              name="ingredient[]" 
              placeholder="Enter ingredient amount and description">
        </div>  
        `)
      });
   });

</script>