<?php include "includes/db.php" ?>
<?php include  "includes/header.php" ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"?>
    <?php
    if(isset($_GET['category'])){
        $post_category_id = $_GET['category'];
        $post_category_name = $_GET['category_name'];
    }
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                <?php echo $post_category_name; ?>
            </h1>
                    <?php 

                        $query = "SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.post_user_id=users.user_id WHERE post_category_id = $post_category_id";
                        $select_all_posts_query = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($select_all_posts_query)){
                            $post_title = $row["post_title"];
                            $post_id = $row["post_id"];
                            $post_short_description = $row['post_short_description'];
                            $post_author = $row["username"];
                            $post_date = $row["post_date"];
                            $post_image = $row["post_image"];
                            $post_status = $row["post_status"];
                            $post_content = substr($row["post_content"],0,150);
                            if($post_status == 'published'){
                            ?>
                            
                 
                            <div class="card mt-2" style="width: 100%;">
                          <img class="card-img-tom" src="images/<?php echo $post_image?>" alt="">
                          <div class="card-body">
                            <h5 class="card-title text-center"><a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title?></a></h5>
                            <p class="card-text text-center"><?php echo $post_short_description?></p>
                            <div class="d-flex justify-content-center">
                                <div>Added on&nbsp;<?php echo $post_date?></div>
                                <div>&nbsp;by <a href="author_posts.php?author=<?php echo $post_author?>&user_id=<?php echo $post_author_id?>&p_id=<?php echo $post_id;?>"><?php echo $post_author?></a></div>
                            </div>
                            <hr>
                            <div class="row justify-content-center">
                                <div class="col-6 text-center">
                                    <a class="btn-full btn-block" href="post.php?p_id=<?php echo $post_id?>">Read More</a>
                                </div>
                            </div>
                          </div>
                        </div>
                       
                        <?php } }?>
               
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

      <?php include  "includes/footer.php" ?>
