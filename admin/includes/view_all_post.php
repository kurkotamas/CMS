<?php include "./functions_posts.php"; ?>

<?php

//RESET VIEW
if(isset($_GET['reset_views'])) {
    $reset_view_id = $_GET['reset_views'];
    $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = {$reset_view_id}";
    makeQuery($query);


}

if(isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {

        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                makeQuery($query);
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                makeQuery($query);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                makeQuery($query);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = {$postValueId}";
                $select_posts = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_posts)) {
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                    //$post_content = mysqli_real_escape_string($connection, $post_content);
                }

                $query = "INSERT INTO posts(post_author, post_title, post_category_id, post_status, post_image, post_tags, post_comment_count, post_date, post_content) VALUES ('{$post_author}', '{$post_title}', '$post_category_id', '{$post_status}', '{$post_image}', '{$post_tags}', '$post_comment_count', '{$post_date}', '{$post_content}' )";
                makeQuery($query);


                break;
        }

    }
}

?>

<form action="" method="post">
    <div id="bulkOptionsContainer" class="col-xs-4" style="padding: 0px">

        <select class="form-control" name="bulk_options" id="" style="padding: 0px">
            <option value="" >Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>

    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>

    <table class="table table-bordered table-hover">
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
            <th>Delete</th>
            <th>Edit</th>
            <th>Views</th>
        </tr>
        </thead>
        <tbody>

        <?php

        $query = "SELECT * FROM posts ORDER BY post_id DESC ";
        $select_categories = mysqli_query($connection, $query);


        while($row = mysqli_fetch_assoc($select_categories)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_view_count = $row['post_view_count'];
            echo "<tr>";

            ?>

            <td><input  class='checkBoxes' type='checkbox' name="checkBoxArray[]" value="<?php echo $post_id?>"></td>

            <?php

            echo "<td>$post_id</td>";
            echo "<td>$post_author</td>";
            echo "<td>$post_title</td>";
            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
            $category_name_query = makeQuery($query);
            while ($row_cat = mysqli_fetch_assoc($category_name_query)) {
                $post_category_name = $row_cat['cat_title'];
                echo "<td>$post_category_name</td>";
            }


            echo "<td>$post_status</td>";
            echo "<td><img width='100' src='../images/$post_image'></td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comment_count</td>";
            echo "<td>$post_date</td>";
            echo "<td><a href='../post.php?post_id=$post_id'>View Post</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?delete_post_id=$post_id'>Delete</a></td>";
            echo "<td><a href='posts.php?source=edit_post&edit_post_id=$post_id'>Edit</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to reset?');\" href='posts.php?reset_views=$post_id'>$post_view_count</a></td>";
            echo "</tr>";
        }

        ?>

        <?php
        deletePosts();
        ?>


        </tbody>
    </table>
</form>