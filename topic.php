<?php include 'header.php'; 
      $cat_id=@$_GET['cat'];

    if(isset($_GET['article'], $_GET['id'])){
    $article = $_GET['article'];
    $id = (int)$_GET['id'];

    $stmt4 = $app->runQuery("INSERT INTO articles_likes(article,user) VALUES(:article, :user)");
    $stmt4->bindParam("article",$article);
    $stmt4->bindParam("user",$id);
    $stmt4->execute();
}

    $stmt5 = $app->runQuery("SELECT * FROM review WHERE topic=:cat_id ORDER BY id DESC");
    $stmt5->bindParam("cat_id", $cat_id);
    $stmt5->execute();

?>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '1943069379054940',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.11'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php include 'sidebar.php'; ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header hidden-lg hidden-sm">
                    <ol class="breadcrumb">
                        <?php 
                            while ($product=$stmt31->fetch(PDO::FETCH_ASSOC)) { ?>
                        <li><a href="topic.php?cat=<?php echo $product['id']; ?>""><?php echo $product['category']; ?></a></li>
                        <?php  }
                            ?>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                           <div class="col-sm-3 hidden-xs" style="float: right">
                               <div class="box box-solid box-info">
                                <div class="box-header">

                                    <i class="fa fa-tag"></i>
                                    <h3 class="box-title">
                                        Topics
                                    </h3>
                                </div>
                           <?php 
                            while ($product=$stmt3->fetch(PDO::FETCH_ASSOC)) { ?>

                                <div class="box-body">
                                    <p><a href="topic.php?cat=<?php echo $product['id']; ?>"><?php echo $product['category']; ?></a></p>
                                </div><!-- /.box-body-->
                                <?php  }
                            ?>
                                <div class="box-footer">
                                </div>
                            </div>

                           </div>
                           <div class="col-sm-9">
                        <?php 
                        while ($reviewRow=$stmt5->fetch(PDO::FETCH_ASSOC)) { 
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
                       
                            <!-- Map box -->
                            <div class="box box-solid box-primary">
                                <div class="box-header">

                                    <i class="fa fa-user"></i>
                                    <h3 class="box-title">
                                        <?php echo ucfirst($row['username']); ?>
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <p><?php echo $reviewRow['message']; ?></p>
                                </div><!-- /.box-body-->
                                <div class="box-footer">
                                    <a class="btn bg-green btn-circle" href="home.php?article=<?php echo $reviewRow['id']; ?>&id=<?php echo $user; ?>"><i class="fa fa-thumbs-o-up"></i></a>
                                    <span> 9 likes</span>
                                    <button class="btn btn-default"><?php echo $reviewRow['date']; ?></button>
                                    <button class="btn btn-warning"><?php echo $row1['category']; ?></button>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo substr(trim($reviewRow['message']),0, 140); ?> economia.com" class="btn bg-aqua btn-circle" data-show-count="false" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <button class="btn bg-light-blue btn-circle" id="shareBtn"><i class="fa fa-facebook"></i></button>
                                    <a href="single.php?pst=<?php echo $reviewRow['id']; ?>" class="btn bg-purple btn-circle"><i class="fa fa-reply"></i></a>
                                </div>
                            </div>
                            <!-- /.box -->
                            

                            
                           <?php }  ?>
                          </div>
                           
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <?php include 'footer.php'; ?>
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