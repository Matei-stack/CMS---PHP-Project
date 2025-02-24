<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">CMS ADMIN</a>
    </div>
    <!-- Top Menu Items -->

   

    <ul class="nav navbar-right top-nav">

<!-- <li><a href="">Utilizatori activi: <?php //echo online_users(); ?> </a></li> -->
<li><a href="">Utilizatori activi: <span class="usersonline"></span> </a></li>

        <li><a href="../index.php">Home</a></li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
            
            <?php

            if(isset($_SESSION['username'])){

                echo $_SESSION['username'];

            }

            ?>
            
            
            
            
            <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profil </a>
                </li>


                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Deconectare </a>
                </li>
            </ul>
        </li>
    </ul>


    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="./posts.php">Vizualizare articole</a>
                    </li>
                    <li>
                        <a href="posts.php?source=add_post">Adaugare articol</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i> Categorii</a>
            </li>

            <li class="">
                <a href="comments.php"><i class="fa fa-fw fa-file"></i> Comentarii</a>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Utilizatori <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="users.php">Vizualizare utilizatori</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user">Adaugare utilizatori</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profil</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>