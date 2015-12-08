<?php

  $postId = $_GET["id"];

  require_once("./post.php");
  $post = new Post();
  $postsdata = $post->getPostDetails($postId);

  foreach($postsdata as $data){
      $postdata = $data;
  }

    $date = $postdata["time"];
                
    $d = strtotime($date);
    $dt = getdate($d);
    $formattedDate = $dt["mday"]. " ". $dt["month"]. " ". $dt["year"];

    $comments  = $post->getCommentsDetail($postId);
    $maxPosts = $post->getLastEntry();

    $comments = $post->getCommentsDetail($_GET["id"]);
?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <!--=============================================== 
    Template Design By WpFreeware Team.
    Author URI : http://www.wpfreeware.com/
    ====================================================-->

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>UHS : Forum</title>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/icon" href="img/wpf-favicon.png"/>

    <!-- CSS
    ================================================== -->       
    <!-- Bootstrap css file-->
     <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome css file-->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Superslide css file-->
    <link rel="stylesheet" href="css/superslides.css">
    <!-- Slick slider css file -->
    <link href="css/slick.css" rel="stylesheet"> 
    <!-- Circle counter cdn css file -->
    <link rel='stylesheet' href='css/circle.css'>  
    <!-- smooth animate css file -->
    <link rel="stylesheet" href="css/animate.css"> 
    <!-- preloader -->
    <link rel="stylesheet" href="css/queryLoader.css" type="text/css" />
    <!-- gallery slider css -->
    <link type="text/css" media="all" rel="stylesheet" href="css/jquery.tosrus.all.css" />    
    <!-- Default Theme css file -->
    <link id="switcher" href="css/themes/default-theme.css" rel="stylesheet">
    
    <!-- Main structure css file -->
    <link href="style.css" rel="stylesheet">
    
    <!-- Google fonts 
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>   
    <link href='http://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>    
    -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 
  </head>
  <body>

    <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"></a>
    <!-- END SCROLL TOP BUTTON -->

    <!--=========== BEGIN HEADER SECTION ================-->
    <header id="header">
      <!-- BEGIN MENU -->
      <div class="menu_area">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation"> 
          <div class="container">
          <div class="navbar-header">
            <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- LOGO -->
            <!-- TEXT BASED LOGO -->
            <a class="navbar-brand" href="index.html">Uyo <span>High School</span></a>            
            <!-- IMG BASED LOGO  -->
             <!-- <a class="navbar-brand" href="index.html"><img src="img/logo.png" alt="logo"></a>  -->           
                   
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
               <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="gallery.html">Gallery</a></li>                
                <li><a href="blog-archive.php?id=1">Forums</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>           
          </div><!--/.nav-collapse -->
          </div>     
        </nav>  
      </div>
      <!-- END MENU -->    
    </header>
    <!--=========== END HEADER SECTION ================--> 

    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <section  class="blend-color">
      
    </section>
    <!--=========== END COURSE BANNER SECTION ================-->
    
    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <section id="courseArchive">
      <div class="container">
        <div class="row">
          <!-- start course content -->
          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="courseArchive_content">
              <!-- start blog archive  -->
              <div class="row">
                <!-- start single blog -->
                <div class="col-lg-12 col-12 col-sm-12">
                  <div class="single_blog">

                    <?php if ($postdata["image"]!=""){ ?>


                    <div class="blogimg_container">
                      <a href="<?php echo $postdata["image"]; ?>" class="blog_img" >
                        <img alt="img" src="<?php echo $postdata["image"]; ?>">
                      </a>
                    </div>

                    <?php } ?>
                    <h2 class="blog_title"><?php echo $postdata["title"]; ?></h2>
                    <div class="blog_commentbox">
                      <p><i class="fa fa-user"></i>Uyo High School</p>
                      <p><i class="fa fa-calendar"></i><?php echo $formattedDate ?></p>
                      <span class="comments_format"><i class="fa fa-comments"></i> <?php $totalComm =  $post->getCommentsTotal($_GET["id"]); echo $totalComm; ?> Comment<?php if($totalComm>1){echo "s";} ?></span>
                    </div>
                   
                      <?php echo $postdata["post"]; ?>
                      <br/><br/><br/>

                    
                  </div>

                   <h1 id="comments_title"><?php $totalComm =  $post->getCommentsTotal($_GET["id"]); echo $totalComm; ?> Comment<?php if($totalComm>1){echo "s";} ?></h1>

                  <?php foreach($comments as $comment){ 

                      $date = $comment["date"];
                
                      $d = strtotime($date);
                      $dt = getdate($d);
                      $formattedDate = $dt["month"] . " ". $dt["mday"]. ", ". $dt["year"]. " At ". date("h:i A", $d);
                    ?>


                    <div class="info-space">
                        <div class="arrow"></div>
                          <div class="well">
                            
                                <h3><?php echo $comment["name"]?></h3>
                                <h4><?php echo $formattedDate ?></h4>
                                <p><?php echo $comment["message"] ?></p>
                                
                            
                          </div>
                    </div> 

                    <?php } ?>


                  <!-- single blog nex & prev button -->
                  <div class="single_blog_prevnext">

                    <?php if($_GET["id"]!=1){ ?>
                       <a class="prev_post wow fadeInLeft" href='<?php echo "blog-single.php?id=" . ($_GET["id"]-1); ?>'<i class="fa fa-angle-left"></i>Previous Post</a>

                    <?php } ?>

                     <?php if($_GET["id"]!=$maxPosts){ ?>

                       <a class="next_post wow fadeInRight" href='<?php echo "blog-single.php?id=" . ($_GET["id"]+1); ?>'<i class="fa fa-angle-right"></i>Next Post</a>

                    <?php } ?>

                    


                   
                  
                  </div>
                </div>
                <!-- End single blog -->                
              </div>
              <!-- end blog archive  -->
              <br/> <br/><br/><br/>
                    
            </div>


            
                            <div class="status alert alert-success" style="display: none"></div>
                            <div class="message_heading">
                                <h4>Leave a Comment</h4>
                                <p>The Fields marked <span style="color:red;">*</span> are required</p>
                            </div> 
      
                            <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="processform.php" role="form">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Name <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" name="name" required="required" maxLength="30">
                                        </div>
                                        <div class="form-group">
                                            <label>Email </label>
                                            <input type="email" class="form-control" name="email" maxLength="30">
                                        </div>
                                                     
                                    </div>
                                    <div class="col-sm-7">                        
                                        <div class="form-group">
                                            <label>Message <span style="color:red;">*</span></label>
                                            <textarea name="message" id="message" required="required" class="form-control" rows="8" maxLength="200"></textarea>
                                            <input type="hidden" name="id" value='<?php echo $_GET["id"] ?>' />
                                        </div>                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>     
                       
          </div>




          <!-- End course content -->

          <!-- start course archive sidebar -->
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="courseArchive_sidebar">
              <!-- start single sidebar -->
              <div class="single_sidebar">
                <h2>Popular posts <span class="fa fa-angle-double-right"></span></h2>
                <ul class="news_tab">
                  <li>
                    <div class="media">
                      <div class="media-left">
                        <a href="#" class="news_img">
                          <img alt="img" src="img/news.jpg" class="media-object">
                        </a>
                      </div>
                      <div class="media-body">
                       <a href="#">Uyo High School Interhouse Sports</a>
                       <span class="feed_date">27.02.15</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="media">
                      <div class="media-left">
                        <a href="#" class="news_img">
                          <img alt="img" src="img/news.jpg" class="media-object">
                        </a>
                      </div>
                      <div class="media-body">
                       <a href="#">PTA meeting</a>
                       <span class="feed_date">28.02.15</span>                
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="media">
                      <div class="media-left">
                        <a href="#" class="news_img">
                          <img alt="img" src="img/news.jpg" class="media-object">
                        </a>
                      </div>
                      <div class="media-body">
                       <a href="#">End of year Party</a>
                       <span class="feed_date">28.02.15</span>                
                      </div>
                    </div>
                  </li>                  
                </ul>
              </div>
              <!-- End single sidebar -->
              <!-- start single sidebar -->
             
              
            </div>
          </div>
          <!-- start course archive sidebar -->
        </div>
      </div>
    </section>
    <!--=========== END COURSE BANNER SECTION ================-->
    
    <!--=========== BEGIN FOOTER SECTION ================-->
    <footer id="footer">
      <!-- Start footer top area -->
      <div class="footer_top">
        <div class="container">
          <div class="row">
            <div class="col-ld-4  col-md-4 col-sm-4">
              <div class="single_footer_widget">
                <h3>Our Motto</h3>
                <p>Grip Knowledge fast with a sense of direction.</p>
              </div>
            </div>
            <div class="col-ld-4  col-md-4 col-sm-4">
              <div class="single_footer_widget">
                <h3>Community</h3>
                <ul class="footer_widget_nav">
                  <li><a href="#">Our Staffs</a></li>
                  <li><a href="">Events</a></li>
                </ul>
              </div>
            </div>
           
            <div class="col-ld-4  col-md-3 col-sm-4">
              <div class="single_footer_widget">
                <h3>Social Links</h3>
                <ul class="footer_social">
                  <li><a data-toggle="tooltip" data-placement="top" title="Facebook" class="soc_tooltip" href="#"><i class="fa fa-facebook"></i></a></li>
                 
                  <li><a data-toggle="tooltip" data-placement="top" title="Twitter" class="soc_tooltip"  href="#"><i class="fa fa-twitter"></i></a></li>
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End footer top area -->

      <!-- Start footer bottom area -->
      <div class="footer_bottom">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="footer_bootomLeft">
                <p> Copyright &copy; All Rights Reserved</p>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <!-- End footer bottom area -->
    </footer>

  

    <!-- Javascript Files
    ================================================== -->

    <!-- initialize jQuery Library -->
    <script src="js/jquery.min.js"></script>
    <!-- Preloader js file -->
    <script src="js/queryloader2.min.js" type="text/javascript"></script>
    <!-- For smooth animatin  -->
    <script src="js/wow.min.js"></script>  
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- slick slider -->
    <script src="js/slick.min.js"></script>
    <!-- superslides slider -->
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.animate-enhanced.min.js"></script>
    <script src="js/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>   
    <!-- for circle counter -->
    <script src='js/circle.js'></script>
    <!-- Gallery slider -->
    <script type="text/javascript" language="javascript" src="js/jquery.tosrus.min.all.js"></script>   
   
    <!-- Custom js-->
    <script src="js/custom.js"></script>

 
  
  </body>
</html>