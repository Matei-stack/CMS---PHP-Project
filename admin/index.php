<?php include "includes/admin_header.php"; ?>
<div id="wrapper">


   

    <!-- Navigation -->

    <?php include "includes/admin_navigation.php"; ?>



    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">


                    <h1 class="page-header">
                        Bun venit



                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                   


                </div>
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $query = "SELECT * FROM posts";
                                    $select_all_post = mysqli_query($connection, $query);
                                    $post_count = mysqli_num_rows($select_all_post);
                                    echo "<div class='huge'>{$post_count}</div>";

                                    ?>

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


                                    <?php

                                    $query = "SELECT * FROM comments";
                                    $select_all_comm = mysqli_query($connection, $query);
                                    $comm_count = mysqli_num_rows($select_all_comm);
                                    echo "<div class='huge'>$comm_count</div>";


                                    ?>


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


                                    <?php

                                    $query = "SELECT * FROM users";
                                    $select_all_users = mysqli_query($connection, $query);
                                    $user_count = mysqli_num_rows($select_all_users);
                                    echo "<div class='huge'>$user_count</div>";


                                    ?>


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

                                    <?php

                                    $query = "SELECT * FROM categories";
                                    $select_all_cat = mysqli_query($connection, $query);
                                    $cat_count = mysqli_num_rows($select_all_cat);
                                    echo "<div class='huge'>$cat_count</div>";


                                    ?>


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


            <?php

            $query = "SELECT * FROM posts WHERE post_status='Publicat'";
            $select_all_pub_posts = mysqli_query($connection, $query);
            $post_pub_count = mysqli_num_rows($select_all_pub_posts);

            $query = "SELECT * FROM posts WHERE post_status='draft'";
            $select_all_draft_posts = mysqli_query($connection, $query);
            $post_draft_count = mysqli_num_rows($select_all_draft_posts);

            $query = "SELECT * FROM comments WHERE comment_status='Neaprobat'";
            $select_all_draft_comms = mysqli_query($connection, $query);
            $comm_draft_count = mysqli_num_rows($select_all_draft_comms);

            $query = "SELECT * FROM users WHERE user_role='abonat'";
            $select_all_sub = mysqli_query($connection, $query);
            $sub_count = mysqli_num_rows($select_all_sub);

            ?>



            <div class="row">

                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],

                            <?php

                            $element_text = ['Articole', 'Articole in editare', 'Articole publicate', 'Comentarii', 'Comentarii neaprobate', 'Utilizatori', 'Abonati', 'Categorii'];
                            $element_count = [$post_count, $post_draft_count, $post_pub_count, $comm_count, $comm_draft_count, $user_count, $sub_count, $cat_count];

                            for ($i = 0; $i < 8; $i++) {

                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }


                            ?>
                            // ['Post', 1000],

                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>

<?php include "includes/admin_footer.php"; ?>