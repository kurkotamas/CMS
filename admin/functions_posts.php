<?php

function deletePosts(){
    global $connection;
    if (isset($_GET['delete_post_id'])) {
        $delete_post_id = $_GET['delete_post_id'];
        $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
        $delete_post_query = mysqli_query($connection, $query);
        confirmQuery($delete_post_query);
        header("Location: posts.php");

        //query to delete the comments
        $query = "DELETE FROM comments WHERE comment_post_id = $delete_post_id";
        makeQuery($query);
    }
}
function editPost() {
    global $connection;
    $edit_post_id = $_GET['edit_post_id'];

    $query = "SELECT * FROM posts WHERE post_id = {$edit_post_id} ";
    $edit_post_query = mysqli_query($connection, $query);
    confirmQuery($edit_post_query);

    while($row = mysqli_fetch_assoc($edit_post_query)) {
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
            </div>
            <div class="form-group">
                <select name="post_category_id" id="">
                    <?php

                    $query = "SELECT * FROM categories";
                    $select_categories_id = mysqli_query($connection, $query);

                    confirmQuery($select_categories_id);

                    while($row = mysqli_fetch_assoc($select_categories_id)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        echo "<option value='{$cat_id}'>{$cat_title}</option>";

                    }
                    ?>
                </select>

            </div>
            <div class="form-group">
                <label for="title">Post Author</label>
                <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
            </div>
            <div class="form-group">
                <select name="post_status" id="">
                    <option value="none">None</option>
                    <option selected ="selected" value="published">Published</option>
                </select>
            </div>
            <div class="form-group">
                <label for=""></label>
                <img width='200' src='../images/<?php echo $post_image; ?>'>"
                <input type="file" name = "image">
            </div>
            <div class="form-group">
                <label for="post_tags">Post Tags</label>
                <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
            </div>
            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea class="form-control" name="post_content" id="" cols="30" rows="10">
                    <?php echo $post_content; ?>
            </textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
            </div>
        </form>

        <?php
    }
}
function updatePost() {
    global $connection;
    $edit_post_id = $_GET['edit_post_id'];
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image" );
    if(empty($post_image)) {
        $query = "SELECT post_image FROM posts WHERE post_id = {$edit_post_id}";
        $edit_image_query = mysqli_query($connection, $query);
        confirmQuery($edit_image_query);

        while ($row = mysqli_fetch_assoc($edit_image_query)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = '{$edit_post_id}' ";


    $update_query = mysqli_query($connection, $query);

    confirmQuery($update_query);
    echo "<p class='bg-success'>Post Updated <a href='../post.php?post_id={$edit_post_id}'>View Post</a> or <a href='posts.php'> Edit More Posts</a></p>";
}
function addPost(){
    global $connection;
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image" );

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')" ;

    $create_post_query = mysqli_query($connection, $query);

    confirmQuery($create_post_query);
    $last_post_id = mysqli_insert_id($connection);

    echo "<p class='bg-success'>Post Created <a href='../post.php?post_id={$last_post_id}'>View Post</a> or <a href='posts.php'> Edit More Posts</a></p>";
}
