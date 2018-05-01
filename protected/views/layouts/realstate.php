<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Uk Pro.Solutions LTD">
    <title>EXCLUSIVE LUXE</title>
    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Documentation extras -->
<link href="css/style.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">
<link href="css/open-sans.css" rel='stylesheet'>
<link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
<!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
<![endif]-->

<!-- Favicons -->
<link rel="shortcut icon" href="favicon.png">
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div class="container">
<div class="wrap">
<header class="header">
	<div class="col-md-4 logo col-sm-7 col-xs-12">
    	<a href="category.html" class=""><img src="img/logo.png" alt="Exclusive luxe"></a>
    </div>
    <div class="col-md-5 col-md-offset-3 col-sm-5 col-xs-12">
    	<div class="row login-div">
        <a class="register animated fadeInDown delay-05s" href="Register.html">SELLER SIGN UP</a>
    	<a class="join animated fadeInDown delay-07s" data-toggle="modal" data-target="#join-modal" href="#join-modal">JOIN</a>
        </div>
        
    </div>
</header>

<!-- Join Modal -->
<div class="modal fade" id="join-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Join</h4>
      </div>
      
      <div class="modal-body">
        <form role="form">
          <div class="form-group">    
            <input class="form-control" placeholder="Enter email" type="email" name="email" id="email" value="" title="Please fill out this field with your email address." required / >
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" title="Minmimum 5 letters or numbers." required />
          </div>
          <div class="form-group">
           <span class="login-link">Already a member: <a href="login.html" class="close login" data-dismiss="modal" data-toggle="modal" data-target="#login-modal">Login</a></span>
          </div>
          <button type="submit" class="btn btn-default log-btn">Join</button>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Join Modal -->


<!--Login Modal-->


<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="login-icon"><img src="img/login-icon.png" alt="" /></span>Login</h4>
      </div>
      <div class="modal-body">
        <form role="form" action="dashboard.html">
          <div class="form-group">    
            <input class="form-control" placeholder="Enter email" type="email" name="email" id="email" value="" title="Please fill out this field with your email address." required >
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" title="Minmimum 5 letters or numbers." required>
          </div>
          <div class="form-group">
           <span class="login-link">Don't have an account ? <a href="register.html">Register</a></span>
          </div>
          <button type="submit" class="btn btn-default log-btn">login</button>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!--end Login Modal-->


<nav class="navbar navbar-default" role="navigation">
 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#"><img src="img/nav/m1.png" class="animated fadeIn delay-02s">CLOTHES  &  ACCESSORIES</a></li>
        <li><a href="#"><img src="img/nav/m2.png" class="animated fadeIn delay-02s">TRAVEL</a></li>
        <li><a href="#"><img src="img/nav/m3.png" class="animated fadeIn delay-02s">COSMETIC</a></li>
        <li><a href="#"><img src="img/nav/m4.png" class="animated fadeIn delay-02s">jewelry</a></li>
        <li><a href="#"><img src="img/nav/m5.png" class="animated fadeIn delay-02s">MOTOR</a></li>
        <li><a href="#"><img src="img/nav/m6.png" class="animated fadeIn delay-02s">HOME DÉCOR</a></li>
        <li><a href="#"><img src="img/nav/m7.png" class="animated fadeIn delay-02s">ELECTRONICS</a></li>
        <li><a href="#"><img src="img/nav/m8.png" class="animated fadeIn delay-02s">KIDS</a></li>
        <li><a href="#"><img src="img/nav/m9.png" class="animated fadeIn delay-02s">LYFESTYLE</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="img/nav/m10.png" class="animated fadeIn delay-02s">REAL STATE</a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
</nav>
<nav class="navbar navbar-default main-nav" role="navigation">
 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">For Sale</a></li>
        <li><a href="#">To Rent</a></li>
        <li><a href="#">Current Values</a></li>
        <li><a href="#">Sold Prices</a></li>
        <li><a href="#">New Homes</a></li>
        <li><a href="#">Commericals</a></li>
        <li><a href="#">Find Agents</a></li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Property Advice</a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
</nav>



 <?php 
			 echo $content; 	
			 ?>
			


<footer class="footer">
<div class="container">
<div class="wrap">
<div class="col-md-2">
<ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
      <li><span class="ul-title">company:</span></li>
      <li><a href="static_col_1.html">about us</a></li>
      <li><a href="contact.html">contact us</a></li>
      <li><a href="static_col_2.html">privacy policy</a></li>
      <li><a href="static_col_3.html">terms of use</a></li>  
    </ul>
    </div>
    
    <div class="col-md-2">
<ul style="max-width: 300px; margin-top:30px;" class="nav nav-pills nav-stacked">
      
      <li><a href="static_col_1.html">buttons & badges</a></li>
      <li><a href="static_col_2.html">mobile apps</a></li>
      <li><a href="faq.html">faqs</a></li>
      <li><a href="static_col_1.html">in the news</a></li>
      <li><a href="static_col_3.html">pro centre</a></li>  
    </ul>
    </div>
    
    <div class="col-md-3" style="width:18% !important;">
<ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
      <li><span class="ul-title">category:</span></li>
      <li><a href="#">CLOTHES  &  ACCESSORIES</a></li>
      <li><a href="#">TRAVEL</a></li>
      <li><a href="#">COSMETIC</a></li>
      <li><a href="#">JEWLERY</a></li>
      <li><a href="#">MOTOR</a></li>
      <li><a href="#">HOME DÉCOR</a></li>  
    </ul>
    </div>
    
    <div class="col-md-2">
<ul style="max-width: 300px; margin-top:30px;" class="nav nav-pills nav-stacked">
      
      <li><a href="#">ELECTRONICS</a></li>
      <li><a href="#">KIDS</a></li>
      <li><a href="#">LYFESTYLE</a></li>
      <li><a href="#">REAL STATE</a></li>
        
    </ul>
    </div>
    
    <div class="col-md-3 col-sm-12 pull-right">
    <div class="logo">
    <a class="" href="category.html"><img alt="Exclusive luxe" src="img/logo.png"></a>
    </div><!--end logo-->
    
    <ul class="isocial boot-tooltip pull-right" id="social">
    <li><a class="face" data-original-title="facebok" data-toggle="tooltip" href="#"></a></li>
    <li><a class="twitter" data-original-title="twitter" data-toggle="tooltip" href="#"></a></li>
    <li><a class="linkdin" data-original-title="mail" data-toggle="tooltip" href="#"></a></li>
    <li><a class="instagram" data-original-title="instgram" data-toggle="tooltip" href="#"></a></li>
    <li><a class="google" data-original-title="youtube" data-toggle="tooltip" href="#"></a></li>
    
    </ul>
    </div>
    <div class="col-md-12">
     <p class="download pull-right"><a href="#">Download Our Application: Exclusive App</a> | <a href="#">Instgram App</a></p>
     <p class="download pull-right">copyright © 2014 . All Rights Reserved . UK pro solutions ltd</p>
    </div>

</div>
</div>
</footer>



    <!-- JS and analytics only. -->
    <!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/star-rating.js" type="text/javascript"></script>
<script src='js/jquery.elevatezoom.js'></script>
<script>
$(document).ready(function() {

	$('.wp2').waypoint(function() {
		$('.wp2').addClass('animated fadeInUp');
	}, {
		offset: '75%'
	});
	
	$('.wp4').waypoint(function() {
		$('.wp4').addClass('animated fadeInRight');
	}, {
		offset: '75%'
	});
	
	$('.wp3').waypoint(function() {
		$('.wp3').addClass('animated fadeInRight');
	}, {
		offset: '75%'
	});
	
});
</script>

<script>
function myFunction() {
    $('#pp_uploader').click();
}
</script>

<script>

$('.cart').mouseover(function() {
        $(this).addClass('open');

        $('.cart-list').mouseover(function() {
            $(this).parent().addClass('open');
		
        });
    });


    $('.cart').mouseleave(function() {
        $(this).removeClass('open');
    });



</script>


 <script>
		$('.fav_icon').click(function(){
			$(this).toggleClass('add_fav');
			$(this).toggleClass('add_fav_solid');
			});
		
	</script>


    
    <script>
//initiate the plugin and pass the id of the div containing gallery img 
$("#zoom_03").elevateZoom({
	gallery:'gallery_01', 
	cursor: 'pointer', 
	galleryActiveClass: 'active', 
	imageCrossfade: true, 
	zoomType: "inner",
	loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'}); 
	//pass the img to Fancybox 
	$("#zoom_03").bind("click", function(e) { 
	var ez = $('#zoom_03').data('elevateZoom');	
	$.fancybox(ez.getGalleryList()); return false; 
	}); 
	
</script>
 <link rel="stylesheet" href="css/jquery-ui.css">

  <script src="js/jquery-ui.js"></script>
 <script>
  $(function() {
    $( "#slider-price" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#price" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#price" ).val( "$" + $( "#slider-price" ).slider( "values", 0 ) +
      " - $" + $( "#slider-price" ).slider( "values", 1 ) );
  });
  
  $(function() {
    $( "#slider-age" ).slider({
      range: true,
      min: 0,
      max: 80,
      values: [ 0, 80 ],
      slide: function( event, ui ) {
        $( "#age" ).val(  ui.values[ 0 ]+ " - " + ui.values[ 1 ]+ "Years" );
      }
    });
    $( "#age" ).val(  $( "#slider-age" ).slider( "values", 0 ) + " - " + $( "#slider-age" ).slider( "values", 1 )+
      "Years"  );
  });
  </script>
   <script>

$('.dropdown').mouseover(function() {
        $(this).addClass('open');
    });
    $('.dropdown').mouseleave(function() {
        $(this).removeClass('open');
    });
</script>
</body>
<!-- InstanceEnd --></html>
