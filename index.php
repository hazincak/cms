<?php include "includes/db.php" ?>
<?php include  "includes/header.php" ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">
        <div class="row mt-5">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php
$per_page = 2;
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page="";
}

if($page == "" || $page == 1){
    $page_1 = 0;
}else{
    $page_1 = ($page * $per_page) - $per_page;
}
?>



<?php 
    $post_query_count = "SELECT * FROM posts";
    $find_count = mysqli_query($connection, $post_query_count);
    $count = mysqli_num_rows($find_count);
    $count = ceil($count / $per_page);

    // $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
    $query = "SELECT posts.*, users.user_id, users.username FROM posts INNER JOIN users ON posts.post_user_id=users.user_id LIMIT $page_1, $per_page";
    $select_all_posts_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_all_posts_query)){
        $post_title = $row["post_title"];
        $post_short_description = $row['post_short_description'];
        $post_id = $row["post_id"];
        $post_author_id = $row['user_id'];
        $post_author = $row["username"];
        $post_date = $row["post_date"];
        $post_image = $row["post_image"];
        $post_content = substr($row["post_content"],0,150);
        $post_status = $row["post_status"];

        if($post_status == 'published'){

?>
                        <!-- First Blog Post -->

                        <div class="card mt-2"  >
                          <img class="card-img-top" src="images/<?php echo $post_image?>" alt="">
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
                                    <a class="btn btn-block" href="post.php?p_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                            </div>
                          </div>
                        </div>
                 
                       
                        <?php } } ?>
                   
            

            </div>
            <!-- md-8 column -->
            
                 <?php include "includes/sidebar.php" ?>
       

        </div>
        <!-- /.row -->
        <hr>
            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php for($i = 1; $i <= $count; $i++){
                                if($i == $page){
                                    echo "<li class='page-item-active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                                }else{
                                    echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                                }
                            } ?>
                        </ul>
                    </nav>
                </div>
            </div>
      <?php include  "includes/footer.php" ?>
