<?php include 'header.php'; ?>
<?php 

    $error_message = '';
    $message = '';
if (isset($_POST['review'])) {

    $id = $_POST['id'];
    $review = trim($_POST['message']);
    $period = date('M Y');
    $product = trim($_POST['product']);
    if ($review == "") {
        $error_message = 'Review is required!';
    }else {
         $stmt = $app->runQuery("INSERT INTO review(message, product, `date`, user_id) VALUES (:message, :product, :period, :user_id)");
         $stmt->bindParam("message", $review);
         $stmt->bindParam("user_id", $id);
         $stmt->bindParam("period", $period);
         $stmt->bindParam("product", $product);
         $stmt->execute();

         $message = 'You have successfully posted';
    }
}

if (isset($_POST['add'])) {
    $category = $_POST['category'];

    if ($category == "") {
        $error_message = 'Category is required';
    }else {
         $cat_date = date("Y:m:d");
         $stmt = $app->runQuery("INSERT INTO categories(category,cat_date) VALUES (:category,:cat_date)");
         $stmt->bindParam("category", $category);
         $stmt->bindParam("cat_date", $cat_date);
         $stmt->execute();

         $message = 'You have successfully added a category';
    }
}

 ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php include 'sidebar.php'; ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Add</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                            
                            <div class="col-sm-6">
                                <?php
            if ($error_message != "") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $error_message . '</div>';
            }
            elseif($message != ''){
               echo '<div class="alert alert-success"><strong></strong> ' . $message . '</div>';
            }
            ?>
                            <!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-upload"></i>
                                    <h3 class="box-title">Add Category</h3>
                                </div>
                                <div class="box-body">
                                    <form action="category.php" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="category" placeholder="Category"/>
                                        </div>
                                        <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-info" id="sendEmail" type="submit" name="add">Add <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                                </form>
                                </div>
                                
                            </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="box-info">
                            <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                        $stmt3 = $app->runQuery("SELECT * FROM categories");
                                        $stmt3->execute();
                                    while ($row=$stmt3->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['category']; ?></td>
                                                <td class="btn-group"><button data-toggle="modal" data-target="#myModal<?php echo $row['id']; ?>" class="btn btn-info">Edit</button><button class="btn btn-danger">Delete</button></td>
                                            </tr>
                                        </tbody>

        <div class="modal" id="myModal<?php echo $row['id']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Category</h4>
              </div>
              <div class="modal-body">
            <div class="box">
            <!-- form start -->
            <form role="form" action="{{ url('/note/create') }}" method="post">

                <div class="form-group">
                  <label for="exampleInputEmail1">Category</label>
                  <input type="text" class="form-control" name="category" value="<?=  $row['category']; ?>">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
            </div>
            </form>
             </div>
            </div>
            
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    </div>
        <!-- /.modal -->

                                        <?php } ?>
                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    </div>

                    </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <?php include 'footer.php'; ?>

    </body>
</html>