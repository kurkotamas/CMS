<?php include "includes/admin_header.php" ?>

<?php

if(isset($_POST['update_profile'])) {

    $user_id = $_SESSION['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE user_id = '{$user_id}'";
    makeQuery($query);

}

?>

    <div id="wrapper">



    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>





    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>

                    </h1>
                    <?php
                    if(isset($_SESSION['username'])) {

                        $username = $_SESSION['username'];
                        $query = "SELECT * FROM users WHERE username = '{$username}' ";
                        $select_user_profile_query = makeQuery($query);

                        while($row = mysqli_fetch_assoc($select_user_profile_query)) {

                            $user_id = $row['user_id'];
                            $username = $row['username'];
                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            $user_password = $row['user_password'];
                            $user_email = $row['user_email'];
                            $user_role = $row['user_role'];
                            $user_image = $row['user_image'];

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
                            <input value="<?php echo $user_password; ?>" type="text" class="form-control" name="user_password">
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                        </div>
                    </form>

                    <?php


                        }

                    }

                    ?>



                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>





    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>