<?php include "includes/db.php" ?>
<?php include  "includes/header.php" ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
            <h1 class="page-header">
              User options
              <small>Logged in as:&nbsp<?php echo $_SESSION['username'] ?></small>
            </h1>
            <?php
                  if(isset($_GET['source'])){
                      $source = $_GET['source'];
                  }else{
                      $source = "";
                  }

                  switch($source){
                      case'profile':
                          include "includes/user_profile.php";
                      break;
                      case'all_posts':
                          include "includes/all_user_posts.php";
                      break;
                      case'edit_post':
                        include "includes/edit_post.php";
                      break;
                      case'create_post':
                        include "includes/create_post.php";
                      break;
                      default: 
                      include "includes/all_user_posts.php";
                  break;
                  }
                  ?>
               
            </div>
            
           

        </div>
        <!-- /.row -->


      <?php include  "includes/footer.php" ?>