<?php include "includes/db.php" ?>
<?php include  "includes/header.php" ?>
 <!-- Navigation -->
 <?php include "includes/navigation.php"?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
<?php
if(isset($_GET['source'])){
    $source = $_GET['source'];
}else{
    $source = "";
}

switch($source){
    case'add_post':
        include "admin_includes/add_posts.php";
    break;
    case'edit_post':
        include "admin_includes/edit_post.php";
    break;
    default: 
    include "admin_includes/view_all_posts.php";
break;
}



?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php include "admin_includes/admin_footer.php" ?>
</body>

</html>
