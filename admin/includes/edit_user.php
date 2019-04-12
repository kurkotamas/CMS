<?php

if(isset($_POST['update_user'])) {
    $user_id = $_GET['edit_user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


    if(!empty($user_password)) {
        //echo "alma";
        $query = "SELECT randSalt FROM users WHERE user_id = {$user_id} ";
        $select_randsalt_query = makeQuery($query);
        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password, $salt);

        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$hashed_password}' ";
        $query .= "WHERE user_id = '{$user_id}'";
        makeQuery($query);
    } else {
        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}' ";
        $query .= "WHERE user_id = {$user_id}";
        makeQuery($query);
    }

}
if(isset($_GET['edit_user_id'])){
    $edit_user_id = $_GET['edit_user_id'];

    $query = "SELECT * FROM users WHERE user_id = {$edit_user_id} ";
    $edit_user_query = mysqli_query($connection, $query);
    confirmQuery($edit_user_query);

    while($row = mysqli_fetch_assoc($edit_user_query)) {
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        ?>
        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Firstname</label>
                <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
            </div>
            <div class="form-group">
                <label for="title">Lastname</label>
                <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
            </div>
            <div class="form-group">
                <select name="user_role" id="">
                    <option value="<?php echo $user_role?>"><?php echo $user_role?></option>
                    <?php

                    if($user_role == 'admin') {
                        echo " <option value=\"subscriber\">subscriber</option>";
                    } else {
                        echo "<option value=\"admin\">admin</option>";

                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Username</label>
                <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="title">E-mail</label>
                <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
            </div>
            <div class="form-group">
                <label for="title">Password</label>
                <input type="text" class="form-control" name="user_password">
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_user" value="Edit User">
            </div>
        </form>

        <?php
    }

}


