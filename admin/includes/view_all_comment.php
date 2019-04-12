<?php include "./functions_posts.php"; ?>
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>In Respons to</th>
        <th>Author</th>
        <th>E-mail</th>
        <th>Content</th>
        <th>Status</th>
        <th>Date</th>
        <th>In Response to</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>

    <?php
    if(isset($_GET['approve_comment_id'])) {
        $approve_comment_id = $_GET['approve_comment_id'];
        $query = "DELETE FROM comments WHERE comment_id = $approve_comment_id";
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approve_comment_id";
        makeQuery($query);
    }
    if(isset($_GET['unapprove_comment_id'])) {
        $unapprove_comment_id = $_GET['unapprove_comment_id'];
        $query = "DELETE FROM comments WHERE comment_id = $unapprove_comment_id";
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapprove_comment_id";
        makeQuery($query);
    }

    if(isset($_GET['delete_comment_id'])) {
        $delete_comment_id = $_GET['delete_comment_id'];
        $query = "SELECT * FROM comments WHERE comment_id = $delete_comment_id";
        $query_select_comment = makeQuery($query);
        $the_post_id = mysqli_fetch_assoc($query_select_comment)['comment_post_id'];
            $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $the_post_id";
            makeQuery($query);

        $query = "DELETE FROM comments WHERE comment_id = $delete_comment_id";
        makeQuery($query);

    }


    $query = "SELECT * FROM comments";
    $select_categories = makeQuery($query);

    while($row = mysqli_fetch_assoc($select_categories)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_content = $row['comment_content'];
        $comment_date = $row['comment_date'];

        echo "<tr>";
        echo "<td>$comment_id</td>";
        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $post_title_query = makeQuery($query);
        while($row_post = mysqli_fetch_assoc($post_title_query)) {
            $post_title = $row_post['post_title'];
            echo "<td><a href='../post.php?post_id=$comment_post_id'>$post_title</a></td>";
        }
        echo "<td>$comment_author</td>";
        echo "<td>$comment_email</td>";
        echo "<td>$comment_content</td>";
        echo "<td>$comment_status</td>";
        echo "<td>$comment_date</td>";
        echo "<td>Some Title</td>";
        echo "<td><a href='comments.php?approve_comment_id=$comment_id'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove_comment_id=$comment_id'>Unapprove</a></td>";
        echo "<td><a href='comments.php?delete_comment_id=$comment_id'>Delete</a></td>";
        echo "<td><a href='comments.php?source=edit_comment&edit_comment_id=$comment_id'>Edit</a></td>";
        echo "</tr>";
    }

    ?>

    <?php
    deletePosts();
    ?>


    </tbody>
</table>