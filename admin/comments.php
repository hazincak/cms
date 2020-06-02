<?php include "admin_includes/admin_header.php" ?>
<body>

    <div id="wrapper">
    <!-- Navigation -->
        <?php include "admin_includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                 <!-- Page Heading -->
                 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Comments
                            <small>Logged in as:&nbsp<?php echo $_SESSION['username'] ?></small>
                        </h1>
                    </div>
                </div>
                       
<?php
if(isset($_GET['source'])){
    $source = $_GET['source'];
}else{
    $source = "";
}

switch($source){
    case'add_comment':
        include "admin_includes/add_posts.php";
    break;
    case'edit_comment':
        include "admin_includes/edit_post.php";
    break;
    default: 
    include "admin_includes/view_all_comments.php";

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
