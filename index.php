<?php 
session_start();
require('dbconnect.php');
$db = DB();
require 'lib/library.php';
$app = new DemoLib();

    $stmt1 = $app->runQuery("SELECT * FROM review LIMIT 6");
    $stmt1->execute();

    $stmt3 = $app->runQuery("SELECT * FROM review");
    $stmt3->execute();
    //$reviewRow=$stmt1->fetch(PDO::FETCH_ASSOC);

    $stmt4 = $app->runQuery("SELECT * FROM categories");
    $stmt4->execute();

?>

        
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<!--         <style type="text/css">
                @media screen and (max-width: 992px) {
              .relative {
                position: relative;
              }
              .row-offcanvas-right .sidebar-offcanvas {
                right: -220px;
              }
              .row-offcanvas-left .sidebar-offcanvas {
                left: -220px;
              }
              .row-offcanvas-right.active {
                right: 220px;
              }
              .row-offcanvas-left.active {
                left: 220px;
              }
              .sidebar-offcanvas {
                left: 0;
              }
              body.fixed .sidebar-offcanvas {
                margin-top: 50px;
                left: -220px;
              }
              body.fixed .row-offcanvas-left.active .navbar {
                left: 220px !important;
                right: 0;
              }
              body.fixed .row-offcanvas-left.active .sidebar-offcanvas {
                left: 0px;
              }
            }

        </style> -->
    </head>

        <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
               Economia
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <?php 
                                if (isset($_SESSION['user_id'])) {
                                        $user=$_SESSION['user_id'];
                                        $stmt = $app->runQuery("SELECT * FROM users WHERE user_id=:user");
                                        $stmt->execute(array(":user"=>$user));
                                        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
                                 ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo ucfirst($userRow['username']); ?> <i class="caret"></i></span>
                            </a>
                                <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar3.jpg" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo ucfirst($userRow['username']); ?>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center col-xs-offset-4">
                                        <!-- <a href="#">Followers</a> -->
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                             <?php   }
                             else{ ?>
                                
                                    <li class="">
                                        <a href="login.php">
                                            <i class="fa fa-sign-in"></i> <span>Login</span>
                                        </a>
                                    </li>
                                
                            <?php }
                             ?>
                            
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas col-xs-2">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <?php 
                        if (isset($_SESSION['user_id'])) { ?>
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar3.jpg" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo ucfirst($userRow['username']); ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="home.php">
                                <i class="fa fa-dashboard"></i> <span>Home</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="post.php">
                                <i class="fa fa-comment"></i> <span>Post</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <ol class="breadcrumb">
                        <?php 
                            while ($product=$stmt4->fetch(PDO::FETCH_ASSOC)) { ?>

                                <li style="padding: 5px;"><a href="topic.php?cat=<?php echo $product['id']; ?>"><?php echo $product['category']; ?></a></li>
                                <?php  }
                            ?>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                        <?php 
                        while ($reviewRow=$stmt1->fetch(PDO::FETCH_ASSOC)) { 
                                    $user = $reviewRow['user_id'];
                                    $topic = $reviewRow['topic'];

                                    $stmt2 = $app->runQuery("SELECT * FROM users WHERE user_id=:user_id");
                                    $stmt2->execute(array(":user_id"=>$user));
                                    $row=$stmt2->fetch(PDO::FETCH_ASSOC);

                                    $stmt4 = $app->runQuery("SELECT * FROM categories WHERE id=:topic");
                                    $stmt4->bindParam("topic", $topic);
                                    $stmt4->execute();
                                    $row1=$stmt4->fetch(PDO::FETCH_ASSOC);
                            ?>
                       <div class="col-sm-4">
                            <!-- Map box -->
                            <div class="box box-solid box-primary">
                                <div class="box-header">

                                    <i class="fa fa-user"></i>
                                    <h3 class="box-title">
                                        <?php echo ucfirst($row['username']); ?>
                                    </h3>
                                </div>
                                <div class="box-body"  style="height:">
                                    <p><?php echo $reviewRow['message']; ?></p>
                                </div><!-- /.box-body-->
                                <div class="box-footer">
                                    <a class="btn bg-blue btn-circle" href="home.php"><i class="fa fa-thumbs-o-up"></i></a>
                                    <button class="btn btn-default"><?php echo $reviewRow['date']; ?></button>
                                    <button class="btn bg-pink"><?php echo $row1['category']; ?></button>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo substr(trim($reviewRow['message']),0, 140); ?> economia.com" class="btn bg-aqua btn-circle" data-show-count="false" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <button class="btn bg-light-blue btn-circle" id="shareBtn"><i class="fa fa-facebook"></i></button>
                                    <a href="home.php" class="">Read more</a>
                                </div>
                            </div>
                            <!-- /.box -->
                            </div>
                            
                           <?php }  ?>
                          
                           
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <?php include 'footer.php'; ?>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        <script>
  document.getElementById('shareBtn').onclick = function() {
            
  FB.ui({
    method: 'share',
    display: 'popup',
    href: 'http://jozi.com.ng',
    description: 'Share your thoughts',
  }, function(response){});
}
</script>
    </body>
</html>
