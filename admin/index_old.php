<?php include "includes/admin_header.php" ?>

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
                        <small><?php echo $_SESSION['username']?></small>
                    </h1>

                </div>
            </div>
            <!-- /.row -->

            <?php
            $query = "SELECT * FROM posts";
            $select_all_posts = makeQuery($query);
            $post_counts = mysqli_num_rows($select_all_posts);

            $query = "SELECT * FROM comments";
            $select_all_comments = makeQuery($query);
            $comment_counts = mysqli_num_rows($select_all_comments);

            $query = "SELECT * FROM users";
            $select_all_users = makeQuery($query);
            $user_counts = mysqli_num_rows($select_all_users);

            $query = "SELECT * FROM categories";
            $select_all_categories = makeQuery($query);
            $category_counts = mysqli_num_rows($select_all_categories);

            ?>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $post_counts?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $comment_counts?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $user_counts?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $category_counts?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">

                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            <?php
                                $element_text = ['Active Posts', 'Categories', 'Users', 'Comments'];
                                $element_count = [$post_counts, $category_counts, $user_counts, $comment_counts];
                                echo "['Element', 'Count'],";
                                for($i = 0; $i < 4; $i++) {
                                    echo "['{$element_text[$i]}', {$element_count[$i]}]";
                                    if($i !== 3){
                                        echo ", ";
                                    }

                                }

                            ?>
                        ]);

                        var options = {
                            title: 'Chart'
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                        chart.draw(data, options);
                    }
                </script>

                <div id="piechart" style="width: 900px; height: 500px;"></div>

        </div>
        <!-- /.container-fluid -->

    </div>





    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>