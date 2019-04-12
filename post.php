<?php include 'includes/header.php';?>

<!-- Navigation -->
<?php include 'includes/navigation.php';?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->
            <?php
            //POST COUNTER
            if(isset($_GET['post_id'])){
                echo "fdsfsdfs";
                $post_id = $_GET['post_id'];
                $query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = {$post_id}";
                makeQuery($query);
            }

            //POST DISPLAYING
            $post_id = $_GET['post_id'];
            $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
            $post_query = makeQuery($query);
            while ($row = mysqli_fetch_assoc($post_query)) {
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_content = $row['post_content'];
                ?>

                <!-- Title -->
                <h1><?php echo $post_title;?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href=""><?php echo $post_author;?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date;?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">

                <hr>

                <!-- Post Content -->
                <img src="" alt="">
                <p><?php echo $post_content;?></p>

                <hr>

                <!-- Blog Comments -->

                <?php
                 if(isset($_POST['create_comment'])) {

                     $comment_author = $_POST['comment_author'];
                     $comment_email = $_POST['comment_email'];
                     $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);

                     if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                         $the_post_id = $_GET['post_id'];

                         $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES('{$the_post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved',  now())";
                         $insert_comment_query = makeQuery($query);

                         $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                         $query .= "WHERE post_id = $the_post_id";

                         $update_comment_count = makeQuery($query);
                     } else {
                         echo"<script>alert('Fields cannot be empty')</script>";
                     }
                 }


                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" role="form" method="post">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <label for="Author">E-mail</label>
                        <div class="form-group">
                            <input type="email" class="form-control" name="comment_email">
                        </div>

                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                $the_post_id = $_GET['post_id'];
                $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id";
                $select_comments_query = makeQuery($query);
                while ($row = mysqli_fetch_assoc($select_comments_query)) {
                    $comment_status = $row['comment_status'];
                    if($comment_status == 'approved') {
                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];
                        $comment_date = $row['comment_date'];

                        ?>
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author;?>
                                    <small><?php echo $comment_date;?></small>
                                </h4>
                                <?php echo $comment_content;?>
                            </div>
                        </div>

                        <?php
                    }

                }

                ?>

                <?php
            }

            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php';?>

    </div>
    <!-- /.row -->

    <hr>
    <?php include 'includes/footer.php';?>
