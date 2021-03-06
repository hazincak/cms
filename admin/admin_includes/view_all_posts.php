 <!-- Page Heading -->
<?php
include("modals/delete_post_modal.php");

if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $postValueId){
        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options){
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                $update_to_published_status = mysqli_query($connection, $query);
                confirm($update_to_published_status);
            break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                $update_to_draft_status = mysqli_query($connection, $query);
                confirm($update_to_draft_status);
            break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                $delete_post = mysqli_query($connection, $query);
                confirm($delete_post);
            break;
        }
    }
}
?>
    <form action ="" method ="post">
        <table class="table table-bordered table-hover">
            
        
            <div class="form-group col-xs-4">
                <select class ="form-control" name="bulk_options"  id="">
                    <option value="">Select Options</option>
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class = "col-xs-4">
                <input type="submit" name ="submit" class="btn btn-success" value = "Apply">
                <a class = "btn btn-primary" href = "posts.php?source=add_post">Add New </a>
            </div>

                                    <thead>
                                        <tr>
                                            <th><input id="selectAllBoxes" type="checkbox"></th>
                                            <th>Id</th>
                                            <th>Author</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Tags</th>
                                            <th>Comments</th>
                                            <th>Date</th>
                                            <th>View Post</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>

        <?php
             global $connection;
             $query = "SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.post_user_id=users.user_id";
             $select_posts = mysqli_query($connection, $query);

              while($row = mysqli_fetch_assoc($select_posts)){
                $post_id = $row['post_id'];
                $post_author = $row['username'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_date = $row['post_date'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
            
                                echo "<tr>";
                                echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value ='$post_id'></td>";
                                echo "<td>{$post_id}</td>";
                                echo "<td>{$post_author}</td>";   
                                echo "<td>{$post_title}</td>";
            $query = "SELECT * FROM categories WHERE cat_id={$post_category_id}";
            $select_categories_id = mysqli_query($connection, $query);
            
             while($row = mysqli_fetch_assoc($select_categories_id)){
                $cat_id = $row["cat_id"];
                $cat_title = $row["cat_title"];
            
                                echo "<td>{$cat_title}</td>";   
             }                

                                echo "<td>{$post_status}</td>";  
                                echo "<td><img src ='../images/{$post_image}' width='100'></td>";  
                                echo "<td>{$post_tags}</td>";   
                                echo "<td>{$post_comment_count}</td>";
                                echo "<td>{$post_date}</td>";
                                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";      
                                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";      
                                echo "<td><a rel='$post_id' href='javascript:void(0)' class='js--delete-link' >Delete</a></td>";
                                // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?deleteModal={$post_id}'>Delete</a></td>";   
                                echo "</tr>";
              }
        ?>


                                </tbody>
                                </table>
    </form>
<?php
if(isset($_GET['delete'])){
    $the_post_id = escape($_GET['delete']);

    $query = "DELETE FROM posts where post_id = {$the_post_id}";
    $delete_query = mysqli_query($connection, $query);
    confirm($delete_query);
    header("Location: posts.php");
} 
?>


<script>
    $(document).ready(function(){
        $('.js--delete-link').on('click', function(){
            var id = $(this).attr("rel");
            var delete_path = `posts.php?delete=${id}`;
            
            $('.js--modal_delete_link').attr("href", delete_path);
            $('#deletePostModalAdmin').modal('show')
        })
    });
</script>