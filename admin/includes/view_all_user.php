<?php include "./functions_posts.php"; ?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Username</th>
            <th>E-mail</th>
            <th>Role</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>

    <?php


    $query = "SELECT * FROM users";
    $select_users = makeQuery($query);

    while($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];

        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$username</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_role</td>";
        echo "<td><a href='users.php?admin_id=$user_id'>Admin</a></td>";
        echo "<td><a href='users.php?subscriber_id=$user_id'>Subscriber</a></td>";
        echo "<td><a href='users.php?delete_user_id=$user_id'>Delete</a></td>";
        echo "<td><a href='users.php?source=edit_user&edit_user_id=$user_id'>Edit</a></td>";
        echo "</tr>";
    }

    ?>

    <?php
    if(isset($_GET['delete_user_id'])) {
        $delete_user_id = $_GET['delete_user_id'];
        $query = "DELETE FROM users WHERE user_id = $delete_user_id";
        makeQuery($query);
        header("Location: users.php");
    }
    if(isset($_GET['edit_user'])) {
        $delete_user_id = $_GET['delete_user_id'];
        $query = "DELETE FROM users WHERE user_id = $delete_user_id";
        makeQuery($query);
        header("Location: users.php");
    }
    if(isset($_GET['admin_id'])) {
        $admin_id = $_GET['admin_id'];
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$admin_id}";
        makeQuery($query);
        header("Location: users.php");
    }
    if(isset($_GET['subscriber_id'])) {
        $subscriber_id = $_GET['subscriber_id'];
        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$subscriber_id}";
        makeQuery($query);
        header("Location: users.php");
    }

    ?>


    </tbody>
</table>