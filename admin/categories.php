<?php include "includes/admin_header.php";

?>
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
                        <small>Autor</small>
                    </h1>
                    <div class="col-xs-6">
                        <?php

                        insert_categories();

                        ?>


                        <form action="" method="post">

                            <div class="form-group">
                                <label for="cat_title"> Adaugare Categorii</label>
                                <input class="form-control" type="text" name="cat_title">

                            </div>
                            <div class="form-group">

                                <input class="btn btn-primary" type="submit" name="submit" value="Adaugare categorie">

                            </div>


                        </form>


                        <?php // update 

                        if (isset($_GET['edit'])) {

                            $cat_id = $_GET['edit'];
                            include "includes/edit_categories.php";
                        } ?>

                    </div>


                    <div class="col-xs-6">



                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Titlu categorie</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php // Gasire categorii

                                gasire_categorii();

                                //stergere query


                                stergere_categorii();

                                ?>

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>

<?php include "includes/admin_footer.php"; ?>