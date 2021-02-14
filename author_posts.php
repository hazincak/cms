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
$the_post_author_id=$_GET['user_id'];
$the_post_author=$_GET['author'];

echo "<h1>All posts by {$the_post_author}</h1>";

$query = "SELECT * FROM posts WHERE post_user_id ='{$the_post_author_id}' ";
$select_all_posts_query = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_all_posts_query)){
    $post_title = $row["post_title"];
    $post_date = $row["post_date"];
    $post_image = $row["post_image"];
    $post_content = $row["post_content"];
  ?>
                      
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title?></a>
                        </h2>
                        <p class="lead">
                            by&nbsp<?php echo $the_post_author?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span>&nbsp;<?php echo $post_date?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                        <hr>
                        <p><?php echo $post_content?></p>
                       
        
                        <hr>
                       
                        <?php } } ?>
                                

        
    </div>    
        
        
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        
        <!-- /.row -->

        <hr>

      <?php include  "includes/footer.php" ?>
