<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- Brand and toggle get grouped for better mobile display -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
                <a class="navbar-brand" href="index.php">Home page</a>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav mr-auto">
                    <?php 
                        $query = "SELECT * FROM categories";
                        $select_all_categories_query = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($select_all_categories_query)){
                            $cat_title = $row["cat_title"];
                            $cat_id = $row["cat_id"];

                            echo "<li class='nav-item'><a class='nav-link' href='category.php?category=$cat_id&category_name=$cat_title'>{$cat_title}</a></li>";

                        };

                    ?>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php
                        if(!isset($_SESSION['logged_in'])){
                            echo "<li><a href='registration.php'>Registration</a></li>";
                        };
                        if(isset($_SESSION['username'])){
                            echo " <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-user'></i>Logged in as: {$_SESSION['username']} <b class='caret'></b></a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' href='userOptions.php?source=profile'><i class='fa fa-fw fa-user'></i> Profile</a>
                                <a class='dropdown-item' href='userOptions.php?source=all_posts'><i class='fa fa-fw fa-user'></i> My posts</a>
                                <a class='dropdown-item' href='userOptions.php?source=create_post'><i class='fa fa-fw fa-user'></i> Add post</a>
                                <div class='dropdown-divider'></div>       
                                <a class='dropdown-item' href='includes/logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a>
                            </div>";
                        };

                        if(isset($_SESSION['username'])){
                            if($_SESSION['user_role'] =='admin'){
                                echo "<li class='nav-item'><a class='nav-link' href='admin/index.php'>Admin</a></li>";
                            }
                        };
                    ?>        
                </ul>
                            

            </div>
          
            <!-- /.navbar-collapse -->
    </nav>