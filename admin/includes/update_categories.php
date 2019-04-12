<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>
        <?php
        if(isset($_GET['edit'])) {
            editCategories();
        }

        if(isset($_POST['update_category'])) {
            updateCategories();
        }
        ?>



    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>

</form>