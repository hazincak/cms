<span>
             <!-- Blog Search Well -->
             <div class="card border-light">
                    <div class="card-body">
                    <h4 class="card-title">Blog Search</h4>
                        <form action="search.php" method="post">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control">
                                <div class="input-group-append">
                                    <button name="submit" class="btn btn-default" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
             </div>
              <!-- Login -->
              <div class="card border-light">
                 <div class="card-body">
                 <h4 class="card-title">Login</h4>
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <input name="username" type="text" class="form-control <?php echo (!empty($_SESSION['username_err'])) ? 'is-invalid' : ''; ?>" placeholder = "Enter Username">
                            <span class='invalid-feedback'><?php echo $_SESSION['username_err'] ?></span>
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control <?php echo (!empty($_SESSION['password_err'])) ? 'is-invalid' : ''; ?>" placeholder = "Enter Password">
                            <div class='invalid-feedback'><?php echo $_SESSION['password_err'] ?></div>
                        </div>
                           <div class="col">
                               <button name="login" value ="Login" class = "btn btn-success btn-block">Login</button>
                           </div>
                           <hr>
                           <div class="col">
                               <a href="registration.php" class = "btn btn-light btn-block">No account? Register</a>
                           </div>
                    </form>
                 </div>
                 <!-- card-body -->
             </div>
             <!-- Blog Categories Cards -->
             <div class="card border-light">
                    <?php 
                        $query = "SELECT * FROM categories";
                        $select_categories_sidebar = mysqli_query($connection, $query);
                    ?>
                 <div class="card-body">
                 <h4 class="card-title" >Blog Categories</h4>
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
                <!-- card-body -->
             </div>
             <!-- card -->
</span>