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
    echo "<p class='bg-success'>Post Created. <a href ='post.php?p_id={$the_post_id}'>View Post</a>&nbspor&nbsp<a href='userOptions.php?source=create_post'>Add More Posts</a></p>";
}

?>



<h3>Create post</h3>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="post_title">Post title</label>
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
      <label for ="image">Post Image</label>
      <input type ="file" class="form-control-file" name="image">
    </div>
    <div class="form-group">
        <label for ="post_tags">Post Tags</label>
            <div><input type ="text" class="form-control" name="post_tags"></div>
    </div>
    <div class = "form-group">
        <label for ="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="textarea" cols="30" rows ="10"></textarea>
    </div>
    <button type="submit" name="create_draft_post" class="btn btn-primary">Submit</button>
</form>