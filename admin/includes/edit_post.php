<?php include "./functions_posts.php"; ?>
<?php

if(isset($_POST['update_post'])) {
    updatePost();
}
if(isset($_GET['edit_post_id'])){
    editPost();
}
?>


