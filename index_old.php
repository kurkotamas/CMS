<?php include 'includes/header.php';?>

    <!-- Navigation -->
    <?php include 'includes/navigation.php';?>

    <!-- Page Content -->
    <div class="container">


        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                function dots($str) {
                    if(strlen($str) > 50) {
                        return "...";
                    }
                    return "";

                }
                
                $query = "SELECT * FROM posts";
                $select_all_posts_query = makeQuery($query);
                $published_posts = false;
                
                while($row = mysqli_fetch_assoc($select_all_posts_query)) {

                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_status = $row['post_status'];
                    $post_content = substr($row['post_content'], 0, 50) . dots($row['post_content']);

                    if($post_status == "published"){
                        $published_posts = true;

                    ?>


                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?post_author=<?php echo $post_author?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                        <a href="post.php?post_id=<?php echo $post_id?>">
                            <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                        </a>

                <hr>
                <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                   
                    <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
                   
            <?php } }

            if(!$published_posts) {

                echo "<h1 class='text-center'>SORRY NO POSTS</h1>";
            }

            ?>

                

               

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php';?>

        </div>
        <!-- /.row -->

        <hr>
<?php include 'includes/footer.php';?>
       