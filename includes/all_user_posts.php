<h3>All my posts</h3>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
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
            $query = "SELECT * from posts WHERE post_user_id = {$_SESSION['user_id']}";
            $select_all_user_posts = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_all_user_posts)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_date = $row['post_date'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                    echo "<tr>";
                        echo "<td>{$post_title}</td>";
                        $query = "SELECT * FROM categories WHERE cat_id={$post_category_id}";
                        $select_categories_id = mysqli_query($connection, $query);

                         while($row = mysqli_fetch_assoc($select_categories_id)){
                            $cat_id = $row["cat_id"];
                            $cat_title = $row["cat_title"];
                        
                            echo "<td>{$cat_title}</td>";   
                         }
                        echo "<td>{$post_status}</td>";
                        echo "<td><img src ='images/{$post_image}' width='100'></td>";
                        echo "<td>{$post_tags}</td>";
                        echo "<td>{$post_comment_count}</td>";
                        echo "<td>{$post_date}</td>";
                        echo "<td><a href='post.php?p_id={$post_id}'>View Post</a></td>";      
                        echo "<td><a href='useroptions.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";       
                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='userOptions.php?delete={$post_id}'>Delete</a></td>";
                    echo "</tr>";
            }
            ?>
        </tbody>
        <?php
            if(isset($_GET['delete'])){
                $the_post_id = escape($_GET['delete']);
            
                $query = "DELETE FROM posts where post_id = {$the_post_id}";
                $delete_query = mysqli_query($connection, $query);
                confirm($delete_query);
                echo "<p class='bg-danger'>Post Deleted!</p>";
                header("refresh:3");
            } 
    ?>

    </table>
</div>