<?php
if(isset($_POST['create_draft_post'])){

    $post_title = escape($_POST['title']);
    $post_author_id = $_SESSION['user_id'];
    $post_category_id = escape($_POST['post_category']);
    
    
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = escape(date('d-m-y'));
    // $post_comment_count = ;

    move_uploaded_file($post_image_temp, "images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_user_id, post_date, post_image, post_content, post_tags, post_status)";
    $query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author_id}',now(),'{$post_image}','{$post_content}','{$post_tags}','draft')";

    $create_post_query = mysqli_query($connection, $query);

    confirm($create_post_query);
    $the_post_id = mysqli_insert_id($connection);//pulls out last created ID.
    
    // Count total files
    $countfiles = count($_FILES['file']['name']);
    // Looping all files
    for($i=0;$i<$countfiles;$i++){
    $filename = $_FILES['file']['name'][$i];
    
    // Upload file
    move_uploaded_file($_FILES['file']['tmp_name'][$i],'images/postImages/'.$filename);
     
    $query = "INSERT INTO images (image_path, image_post_id)";
    $query .= "VALUES('{$filename}','{$the_post_id}')";

    $attach_image_query = mysqli_query($connection, $query);

    confirm($attach_image_query);

  }
    
    
    
    echo "<p class='bg-success'>Post Created. <a href ='post.php?p_id={$the_post_id}'>View Post</a>&nbspor&nbsp<a href='userOptions.php?source=create_post'>Add More Posts</a></p>";
}


  
 

?>



<h3>Create recipe</h3>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="post_title">Recipe title</label>
      <input type="text" class="form-control" id="post_title" name="title"  placeholder="Enter title">
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select class="form-control" name="post_category" id="">
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
      <label for ="image">Recipe main image</label>
      <input type ="file" class="form-control-file" name="image">
    </div>
    <div class="form-group js--image-block">
      <label for="file">Recipe images</label>
      <input type="file" class="form-control-file mb-2" name="file[]"/>
    </div>
    <button type="button" class="btn btn-secondary btn-sm js--add-image-button"><i class="fas fa-plus"></i>Add image</button>
    <hr>
    <div class="row js--ingredients-block">
        <div class="col-md-2 form-group">
            <label for="ingredient['quantity']" >Amount</label>
            <input 
                type="text" 
                rel="tooltip" 
                title="Examples: 1, 2 or ½ and ¼ " 
                data-toggle="tooltip" 
                data-placement="bottom" 
                class="form-control" 
                id="ingredient_quantity"  
                name="ingredient['quantity']" 
                value="Amount">
        </div>
        <div class="col-md-2 form-group">
            <label for="ingredient['unit']" >Unit</label>
            <input 
                type="text" 
                rel="tooltip" 
                title="Examples: G, Kg, Cup or Tablespoons" 
                data-toggle="tooltip" 
                data-placement="bottom" 
                class="form-control" 
                name="ingredient['unit']" 
                placeholder="Unit">
        </div>
        <div class="col-md-8 form-group">
            <label for="ingredient['description']" >Ingredient description</label>
            <input 
              type="text"
              rel="tooltip" 
              title="Example: ...warm milk (110 degrees F/45 degrees C)" 
              data-toggle="tooltip" 
              data-placement="bottom"  
              class="form-control" 
              name="ingredient['description']" 
              placeholder="Enter description">
        </div>
    </div>
    <div>
          <button type="button" name="addButton" class="btn btn-success btn-sm js--add-ingredient-button"><i class="fas fa-plus"></i>&nbsp;Add ingredient</button>
    </div>
    <hr>
    <div class="form-group">
        <label for ="post_tags">Recipe tags</label>
        <div><input type ="text" class="form-control" name="post_tags"></div>
    </div>
    <div class = "form-group">
        <label for ="post_content">Recipe preparation</label>
        <textarea class="form-control" name="post_content" id="textarea" cols="30" rows ="10"></textarea>
    </div>
    <button type="submit" name="create_draft_post" class="btn btn-primary btn-block">Submit</button>
</form>



<script>
   $(document).ready( function() {
      $('.js--add-image-button').click(function(){
        $('.js--image-block').append('<input class="form-control-file mb-2" type="file" name="file[]"/>')
      });

      $('.js--add-ingredient-button').click(function(){
        $('.js--ingredients-block').append(`
        <div class="col-md-2 form-group">
            <label for="ingredient['quantity']" >Amount</label>
            <input 
                type="text" 
                rel="tooltip" 
                title="Examples: 1, 2 or ½ and ¼ " 
                data-toggle="tooltip" 
                data-placement="bottom" 
                class="form-control" 
                id="ingredient_quantity"  
                name="ingredient['quantity']" 
                value="Amount">
        </div>
        <div class="col-md-2 form-group">
            <label for="ingredient['unit']" >Unit</label>
            <input 
                type="text" 
                rel="tooltip" 
                title="Examples: G, Kg, Cup or Tablespoons" 
                data-toggle="tooltip" 
                data-placement="bottom" 
                class="form-control" 
                name="ingredient['unit']" 
                placeholder="Unit">
        </div>
        <div class="col-md-7 form-group">
            <label for="ingredient['description']" >Ingredient description</label>
            <input 
              type="text"
              rel="tooltip" 
              title="Example: ...warm milk (110 degrees F/45 degrees C)" 
              data-toggle="tooltip" 
              data-placement="bottom"  
              class="form-control" 
              name="ingredient['description']" 
              placeholder="Enter description">
        </div>  
        `)
      });






$('input[rel="tooltip"]').tooltip();

   })
</script>