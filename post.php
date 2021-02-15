<?php include "includes/db.php" ?>
<?php include  "includes/header.php" ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php
if(isset($_GET["p_id"])){
$the_post_id=$_GET['p_id'];


$query = "SELECT posts.*, users.user_id, users.username FROM posts INNER JOIN users ON posts.post_user_id=users.user_id WHERE post_id = $the_post_id";
$select_all_posts_query = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_all_posts_query)){
    $post_title = $row["post_title"];
    $post_author = $row["username"];
    $post_date = $row["post_date"];
    $post_image = $row["post_image"];
    $post_content = $row["post_content"];
 } ?>
                      
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                        <hr>
                        <p><?php echo $post_content?></p>
                       
        
                        <hr>
                       
                        <?php } ?>
                                   <!-- Blog Comments -->
<?php
if(isset($_POST['create_comment'])){
    $the_post_id = $_GET['p_id'];
    $comment_user_id = $_SESSION['user_id'];
    $comment_content = $_POST['comment_content'];

    if(!empty($comment_content) ){
        $query ="INSERT INTO comments (comment_post_id, comment_user_id, comment_content, comment_status, comment_date)";
        $query .="VALUES ($the_post_id, $comment_user_id, '{$comment_content}', 'unapproved', now()) ";
    
        $create_comment_query = mysqli_query($connection, $query);
        if(!$create_comment_query){
            die("QUERY FAILED" . mysqli_error($connection));
        }
    
        $query = "UPDATE posts SET post_comment_count =+ 1 ";
        $query .= "WHERE post_id = $the_post_id ";
        $increase_comment_count = mysqli_query($connection, $query);
        if(!$increase_comment_count){
            die("QUERY FAILED" . mysqli_error($connection));
        }
    }else{
        echo "<script> alert('Fields cannot be empty')</script>";
    }

    
}
?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button 
                            type="submit" 
                            name="create_comment"  
                            class="btn btn-primary btn-block"
                            <?php
                                if(!isset($_SESSION['logged_in'])){
                                    echo 'disabled';
                                }
                            ?>
                            >Submit</button>
                            <?php
                                if(!isset($_SESSION['logged_in'])){
                                    echo '<div class="text-center"><small>Please Login to Comment</small></div>';
                                }
                            ?>
                    </form>
                </div>

                <hr>
    <?php
        if(isset($_GET["p_id"])){
            $the_post_id=$_GET['p_id'];
        $query = "SELECT *, users.user_id, users.username FROM comments INNER JOIN users ON comments.comment_user_id=users.user_id WHERE comment_post_id = {$the_post_id} ";
        $query .= "AND comment_status = 'approved' ";
        $query .= "ORDER BY comment_id DESC ";
        $select_comment_query = mysqli_query($connection, $query);
            if(!$select_comment_query){
                die("QUERY FAILED") . mysqli_error($select_comment_query);
            }
        
            while($row = mysqli_fetch_array($select_comment_query)){
                $comment_date = $row['comment_date'];
                $comment_content= $row['comment_content'];
                $comment_user_username= $row['username']; 
            
    ?>

                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_user_username; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                
   <?php }}?>
                
              
        
        </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

      <?php include  "includes/footer.php" ?>
