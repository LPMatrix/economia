<!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar3.jpg" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo ucfirst($userRow['username']); ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
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
                        <?php 
                            if ($userRow['user_level']==1) { ?>
                            <li class="">
                                <a href="category.php">
                                    <i class="fa fa-plus"></i> <span>Add category</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="admin.php">
                                    <i class="fa fa-plus"></i> <span>Manage</span>
                                </a>
                            </li>
                          <?php  }
                         ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>