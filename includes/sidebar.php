<div class="col-md-4">
             <!-- Blog Search Well -->
             <div class="well">
                 <h4>Blog Search</h4>
                 <form action="search.php" method="post">
                     <div class="input-group">
                         <input name="search" type="text" class="form-control">
                         <span class="input-group-btn">
                             <button name="submit" class="btn btn-default" type="submit">
                                 <span class="glyphicon glyphicon-search"></span>
                             </button>
                         </span>
                     </div>
                 </form>
                 <!-- /.input-group -->
             </div>
              <!-- Login -->
              <div class="well">
                 <h4>Login</h4>
                 <form action="includes/login.php" method="post">
                     <div class="form-group">
                         <input name="username" type="text" class="form-control <?php echo (!empty($_SESSION['username_err'])) ? 'is-invalid' : ''; ?>" placeholder = "Enter Username">
                         <span class='invalid-feedback'><?php echo $_SESSION['username_err'] ?></span>
                     </div>
                     <div class="form-group">
                         <input name="password" type="password" class="form-control <?php echo (!empty($_SESSION['password_err'])) ? 'is-invalid' : ''; ?>" placeholder = "Enter Password">
                         <span class='invalid-feedback'><?php echo $_SESSION['password_err'] ?></span>
                     </div>
                        <div class="col">
                            <button name="login" value ="Login" class = "btn btn-success btn-block">Login</button>
                        </div>
                        <div class="col">
                            <a href="registration.php" class = "btn btn-light btn-block">No account? Register</a>
                        </div>
                 </form>
                 <!-- /.input-group -->
             </div>
             <!-- Blog Categories Well -->
             <div class="well">
                    <?php 
                        $query = "SELECT * FROM categories";
                        $select_categories_sidebar = mysqli_query($connection, $query);
                    ?>
                 <h4>Blog Categories</h4>
                 <div class="row">
                     <div class="col-lg-12">
                         <ul class="list-unstyled">
                         <?php 
                         while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                            $cat_title = $row["cat_title"];
                            $cat_id = $row["cat_id"];
                            echo "<li><a href='category.php?category=$cat_id&category_name=$cat_title'>{$cat_title}</a></li>";
                        };
                        ?>
                       
                         </ul>
                     </div>
                 </div>
                 <!-- /.row -->
             </div>
             <!-- well -->
</div>
<!-- col-md-4 -->