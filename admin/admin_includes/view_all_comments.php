 <!-- Page Heading -->
 <?php include "modals/delete_comment_modal.php" ?>
 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Comments
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>
                    </div>
                </div>
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>UnapproveComments</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            
<?php
     global $connection;
     $query = "SELECT * FROM comments";
     $select_comments = mysqli_query($connection, $query);
 
      while($row = mysqli_fetch_assoc($select_comments)){
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_email = $row['comment_email'];      
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        
                        echo "<tr>";
                            echo "<td>{$comment_id}</td>";
                            echo "<td>{$comment_author}</td>";   
                            echo "<td>{$comment_content}</td>";
                            echo "<td>{$comment_email}</td>";
                            echo "<td>{$comment_status}</td>";     
    $query = "SELECT * FROM posts WHERE post_id={$comment_post_id}";
    $select_posts_id = mysqli_query($connection, $query);

     while($row = mysqli_fetch_assoc($select_posts_id)){
        $post_id = $row["post_id"];
        $post_title = $row["post_title"];

                            echo "<td><a href ='../post.php?p_id=$post_id'>{$post_title}</td>";   
     }                  
                            echo "<td>{$comment_date}</td>";
                            echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";      
                            echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";    
                            echo "<td><a rel='$comment_id' href='javascript:void(0)' class='js--delete-comment-link' >Delete</a></td>";
                            // echo "<td><a href='comments.php?delete_comment=$comment_id'>Delete</a></td>";   
                        echo "</tr>";
      }
?>
                               
                            
                        </tbody>
                        </table>
<?php
if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = '$the_comment_id' ";
    $update_status_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    confirm($update_status_query);
} 
?>
<?php
if(isset($_GET['unapprove'])){
    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = '$the_comment_id' ";
    $update_status_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    confirm($update_status_query);
} 
?>
<?php
if(isset($_GET['delete_comment'])){
    $the_comment_id = $_GET['delete_comment'];

    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    confirm($delete_query);
} 
?>

<script>
    $(document).ready(function(){
        $('.js--delete-comment-link').on('click', function(){
            var id = $(this).attr("rel");
            var delete_path = `comments.php?delete_comment=${id}`;
            $('.js--modal_delete_comment_link').attr("href", delete_path);
            $('#deleteCommentModalAdmin').modal('show')
        })
    });
</script>