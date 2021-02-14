<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home page</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php 
                        $query = "SELECT * FROM categories";
                        $select_all_categories_query = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($select_all_categories_query)){
                            $cat_title = $row["cat_title"];
                            $cat_id = $row["cat_id"];

                            echo "<li><a href='category.php?category=$cat_id&category_name=$cat_title'>{$cat_title}</a></li>";

                        };
                    ?>
                    <li><a href="registration.php">Registration</a></li>
<?php
if(isset($_SESSION['username'])){
    echo " <li class='dropdown'>
    <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-user'></i> '{$_SESSION['username']}' <b class='caret'></b></a>
    <ul class='dropdown-menu'>
        <li>
            <a href='userOptions.php?source=profile'><i class='fa fa-fw fa-user'></i> Profile</a>
        </li>
        <li>
            <a href='userOptions.php?source=all_posts'><i class='fa fa-fw fa-user'></i> My posts</a>
        </li>
        <li>
            <a href='userOptions.php?source=create_post'><i class='fa fa-fw fa-user'></i> Add post</a>
        </li>
        <li class='divider'></li>
        <li>
            <a href='includes/logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a>
        </l";
}

?>
                
                    </ul>
                </li>
               

                </li>
<?php
if(isset($_SESSION['user_role'])){
    if(isset($_GET['p_id'])){
       $the_post_id = $_GET['p_id'];
        echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
    }

}
?>
                    
                </ul>

            </div>
          
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>