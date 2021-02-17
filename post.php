<?php include "includes/db.php" ?>
<?php include  "includes/header.php" ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php
if(isset($_GET["p_id"])){
$the_post_id=$_GET['p_id'];


$query = "SELECT posts.*, users.user_id, users.username FROM posts INNER JOIN users ON posts.post_user_id=users.user_id WHERE post_id = $the_post_id";
$select_all_posts_query = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_all_posts_query)){
    $post_title = $row["post_title"];
    $post_author = $row["username"];
    $post_prep_time = $row['post_prep_time'];
    $post_cook_time = $row['post_cook_time'];
    $post_date = $row["post_date"];
    $post_image = $row["post_image"];
    $post_content = $row["post_content"];

    $recipe_total_time = (int)$post_prep_time + (int)$post_cook_time;
 } ?>
                      
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title?></a>
                        </h2>
                        <div class="d-flex justify-content-between">
                            <div><h6><?php echo $post_date?></h6></div>
                            <div><h6> by <a href="index.php"><?php echo $post_author?></a></h6></div>
                        </div>
                        <hr>
                        <img class="img-fluid" src="images/<?php echo $post_image?>" alt="">
                        <hr>
                        <h5>Recipe details</h5>
                        <p><i class="fas fa-hourglass-start"></i>&nbsp;Preparation time:&nbsp;<?php echo $post_prep_time; ?>&nbsp;minutes</p>
                        <p><i class="fas fa-hourglass-half"></i>&nbsp;Cooking time:&nbsp;<?php echo $post_cook_time;?>&nbsp;minutes</p>
                        <p><i class="fas fa-hourglass-end"></i>&nbsp;Total time:&nbsp;<?php echo $recipe_total_time ?>&nbsp;minutes</p>
                        <hr>
                        <h5>Ingredients</h5>
                        <?php
                            $query = "SELECT * FROM ingredients WHERE ingredient_post_id = $the_post_id ";
                            $select_all_post_ingredients = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_assoc($select_all_post_ingredients)){
                                $ingredient_description = $row['ingredient_description'];
                                echo "<p>$ingredient_description</p>";
                            }
                            confirm($select_all_post_ingredients); 
                        ?>
                        <hr>
                        <h5>Directions</h5>
                        <p><?php echo $post_content?></p>
                        <hr>
                        <h5>Recipe photos</h5>
	                      <div class="row">
	                      	<div class="row">
                              <?php
                                  $query = "SELECT * FROM images where image_post_id = $the_post_id";
                                  $select_all_post_images = mysqli_query($connection, $query);
                                  while($row = mysqli_fetch_assoc($select_all_post_images)){
                                    $image_name = $row['image_name'];
                                    echo "
                                    <div class='col-lg-3 col-md-4 col-xs-6 thumb'>
                                      <a class='thumbnail' href='#' data-image-id='' data-toggle='modal' data-title=''
                                         data-image='images/postImages/$image_name'
                                         data-target='#image-gallery'>
                                          <img class='img-fluid img-thumbnail' style='height: 90px; width: 180px'
                                               src='images/postImages/$image_name'
                                               alt='Another alt text'>
                                      </a>
                                    </div>
                                    ";
                                  }
                                
                              ?>

                              </div>
                                
                                
                              <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h4 class="modal-title" id="image-gallery-title"></h4>
                                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                              <img id="image-gallery-image" class="img-fluid col-md-12" src="">
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                              </button>
                                
                                              <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                              </button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
	                      </div>

                       
                        <?php } ?>
                                   <!-- Blog Comments -->
<?php
if(isset($_POST['create_comment'])){
    $the_post_id = $_GET['p_id'];
    $comment_user_id = $_SESSION['user_id'];
    $comment_content = $_POST['comment_content'];

    if(!empty($comment_content) ){
        $query ="INSERT INTO comments (comment_post_id, comment_user_id, comment_content, comment_status, comment_date)";
        $query .="VALUES ($the_post_id, $comment_user_id, '{$comment_content}', 'unapproved', now()) ";
    
        $create_comment_query = mysqli_query($connection, $query);
        if(!$create_comment_query){
            die("QUERY FAILED" . mysqli_error($connection));
        }
    
        $query = "UPDATE posts SET post_comment_count =+ 1 ";
        $query .= "WHERE post_id = $the_post_id ";
        $increase_comment_count = mysqli_query($connection, $query);
        if(!$increase_comment_count){
            die("QUERY FAILED" . mysqli_error($connection));
        }
    }else{
        echo "<script> alert('Fields cannot be empty')</script>";
    }

    
}
?>
                <!-- Comments Form -->
                <div class="card border-light">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button 
                            type="submit" 
                            name="create_comment"  
                            class="btn btn-primary btn-block"
                            <?php
                                if(!isset($_SESSION['logged_in'])){
                                    echo 'disabled';
                                }
                            ?>
                            >Submit</button>
                            <?php
                                if(!isset($_SESSION['logged_in'])){
                                    echo '<div class="text-center"><small>Please Login to Comment</small></div>';
                                }
                            ?>
                    </form>
                </div>

                <hr>
    <?php
        if(isset($_GET["p_id"])){
            $the_post_id=$_GET['p_id'];
        $query = "SELECT *, users.user_id, users.username FROM comments INNER JOIN users ON comments.comment_user_id=users.user_id WHERE comment_post_id = {$the_post_id} ";
        $query .= "AND comment_status = 'approved' ";
        $query .= "ORDER BY comment_id DESC ";
        $select_comment_query = mysqli_query($connection, $query);
            if(!$select_comment_query){
                die("QUERY FAILED") . mysqli_error($select_comment_query);
            }
        
            while($row = mysqli_fetch_array($select_comment_query)){
                $comment_date = $row['comment_date'];
                $comment_content= $row['comment_content'];
                $comment_user_username= $row['username']; 
            
    ?>

                <div>
                    <div>
                        <h4 class="media-heading"><?php echo $comment_user_username; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                
   <?php }}?>
                
              
        
        </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

      <?php include  "includes/footer.php" ?>

<script>
let modalId = $('#image-gallery');

$(document)
  .ready(function () {

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
      $('#show-previous-image, #show-next-image')
        .show();
      if (counter_max === counter_current) {
        $('#show-next-image')
          .hide();
      } else if (counter_current === 1) {
        $('#show-previous-image')
          .hide();
      }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }

          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
        });

      function updateGallery(selector) {
        let $sel = selector;
        current_image = $sel.data('image-id');
        $('#image-gallery-title')
          .text($sel.data('title'));
        $('#image-gallery-image')
          .attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGallery($(this));
        });
    }
  });

// build key actions
$(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });

</script>