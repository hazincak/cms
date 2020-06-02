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
                        Users
                        <small>Logged in as:&nbsp<?php echo $_SESSION['username'] ?></small>
                    </h1>
                       
<?php
if(isset($_GET['source'])){
    $source = $_GET['source'];
}else{
    $source = "";
}

switch($source){
    case'add_user':
        include "admin_includes/add_user.php";
    break;
    case'edit_user':
        include "admin_includes/edit_user.php";
    break;
    default: 
    include "admin_includes/view_all_users.php";

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
