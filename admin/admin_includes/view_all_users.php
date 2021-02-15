<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <!-- <th>Date</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            
<?php
     global $connection;
     $query = "SELECT * FROM users";
     $select_users = mysqli_query($connection, $query);
 
      while($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname= $row['user_firstname'];      
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        
        
                        echo "<tr>";
                            echo "<td>{$user_id}</td>";
                            echo "<td>{$username}</td>";   
                            echo "<td>{$user_firstname}</td>";
                            echo "<td>{$user_lastname}</td>";
                            echo "<td>{$user_email}</td>";     
    // $query = "SELECT * FROM posts WHERE post_id={$comment_post_id}";
    // $select_posts_id = mysqli_query($connection, $query);

    //  while($row = mysqli_fetch_assoc($select_posts_id)){
    //     $post_id = $row["post_id"];
    //     $post_title = $row["post_title"];

    //                         echo "<td><a href ='../post.php?p_id=$post_id'>{$post_title}</td>";   
    //  }                  
                            echo "<td>{$user_role}</td>";    
                            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to make this user admin?');\" href='users.php?change_to_admin={$user_id}'>Admin</a></td>";      
                            echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
                            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";       
                            echo "<td><a rel='$user_id' href='javascript:void(0)' class='js--delete-user-link' >Delete</a></td>";
                            // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?');\" href='users.php?delete_user={$user_id}'>Delete</a></td>";   
                        echo "</tr>";
      }
?>
                               
                            
                        </tbody>
                        </table>
<?php

include('modals/delete_user_modal.php');

if(isset($_GET['change_to_admin'])){
    $the_user_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = '$the_user_id' ";
    $update_user_role_query = mysqli_query($connection, $query);
    header("Location: users.php");
    confirm($update_user_role_query);
} 
?>
<?php
if(isset($_GET['change_to_sub'])){
    $the_user_id = $_GET['change_to_sub'];

    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = '$the_user_id' ";
    $update_user_role_query = mysqli_query($connection, $query);
    header("Location: users.php");
    confirm($update_user_role_query);
} 
?>
<?php
if(isset($_GET['delete_user'])){

    if(isset($_SESSION['user_role'])){
        $the_user_id = mysqli_real_escape_string($connection,  $_GET['delete_user']);

    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
    $delete_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
    confirm($delete_query);
    }
} 
?>

<script>
    $(document).ready(function(){
        $('.js--delete-user-link').on('click', function(){
            var id = $(this).attr("rel");
            var delete_path = `users.php?delete_user=${id}`;
            
            $('.js--modal_delete_user_link').attr("href", delete_path);
            $('#deleteUserModalAdmin').modal('show')
        })
    });
</script>