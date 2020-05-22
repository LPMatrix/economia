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
         $stmt = $app->runQuery("INSERT INTO review(message, topic, `date`, user_id) VALUES (:message, :product, :period, :user_id)");
         $stmt->bindParam("message", $review);
         $stmt->bindParam("user_id", $id);
         $stmt->bindParam("period", $period);
         $stmt->bindParam("product", $product);
         $stmt->execute();

         $message = 'You have successfully posted';
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
                        <li><a href="#"><i class="fa fa-dashboard"></i> Post</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

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
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Review</h3>
                                </div>
                                <div class="box-body">
                                    <form action="post.php" method="post">
                                        <div class="form-group">
                                            <label>Categories</label>
                                            <select class="form-control" name="product">
                                                <?php 
                                                    $stmt5 = $app->runQuery("SELECT * FROM categories");
                                                    $stmt5->execute();

                                                    while ($cat=$stmt5->fetch(PDO::FETCH_ASSOC)) { ?>
                                                       <option value="<?php echo $cat['id']; ?>"><?php echo $cat['category']; ?></option>
                                                  <?php  }
                                                 ?>
                                                
                                            </select>
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Review" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="message"></textarea>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $userRow['user_id']; ?> ">
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-info" id="sendEmail" type="submit" name="review">Post <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                                </form>
                            </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <?php include 'footer.php'; ?>

    </body>
</html>