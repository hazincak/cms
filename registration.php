<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php
if(isset($_POST['submit'])){
    $message = "";
    $username_err = "";
    $query = "SELECT * FROM users";
    $select_users_query = mysqli_query($connection, $query);
    if(!$select_users_query){
        die("QUERY FAILED". mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_users_query)){
        $db_username = $row['username'];
        if($db_username == $_POST['username']){
            $username_err = "Username: '{$db_username}' already exists";
        }
    }

   if(empty($username_err)){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)){
        $username = mysqli_real_escape_string($connection,$username);
        $email = mysqli_real_escape_string($connection, $email);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $password = mysqli_real_escape_string($connection, $password);
    
        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);
    
        if(!$select_randsalt_query){
            die("QUERY FAILED" . mysqli_error($connection));
        }
    
        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $password = crypt($password, $salt);
        
        $query = "INSERT INTO users (username, user_firstname, user_lastname, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}','{$firstname}', '{$lastname}','{$email}','{$password}','subscriber')";
        $register_user_query = mysqli_query ($connection, $query);
        if(!$register_user_query){
            die("QUERY fAILED " . mysqli_error($connection) . ' ' . mysqli_error($connection));
        }
        $message = "Your Registration has been submitted";

    }else{
        // echo "<script>alert('Please fill in all fields');</script>";
        $message = "Fields cannot be empty";
    }

}else{
    $message = " ";
}
   }
    
 
?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 ">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class = "text-center"><?php if(isset($message)){echo $message;} ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" placeholder="Enter Desired Username">
                            <span class='invalid-feedback'><?php echo $username_err ?></span>
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter your first name">
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter your last name">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
