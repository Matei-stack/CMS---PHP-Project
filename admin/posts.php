<?php include "includes/admin_header.php";

?>


<!-- Navigation -->

<?php include "includes/admin_navigation.php"; ?>


<div id="wrapper">

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Bun venit
                        <small>Autor</small>
                    </h1>



                    <?php


                    if (isset($_GET['source'])) {

                        $source = $_GET['source'];
                    }else{

                        $source = '';

                    }
                    switch($source) {

                        case 'add_post';
                        include "includes/add_post.php";
                        break;

                        case 'edit_post';
                        include "includes/edit_post.php";
                        break;

                        case '3';
                        echo "DA: 3";
                        break;

                        case '4';
                        echo "DA: 4";
                        break;

                        default:

                        include "includes/view_all_posts.php";

                        break;

                    }

                    


                    ?>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>

<?php include "includes/admin_footer.php"; ?>