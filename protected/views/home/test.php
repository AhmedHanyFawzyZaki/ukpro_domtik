
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Uk Pro.Solutions LTD">
        <script type="text/javascript" src="/yiiprojects/team-b/finaldomotikk/assets/e01bc32f/jquery.js"></script>
<script type="text/javascript" src="/yiiprojects/team-b/finaldomotikk/assets/e01bc32f/jquery.yiiactiveform.js"></script>
<script type="text/javascript" src="/yiiprojects/team-b/finaldomotikk/js/jquery.js"></script>
<script type="text/javascript" src="/yiiprojects/team-b/finaldomotikk/js/bootstrap.js"></script>
<title>EXCLUSIVE LUXE - Details Kids</title>

                    <link href="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/css/kids/bootstrap.css" rel="stylesheet">
            <link href="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/css/kids/font-awesome.css" rel="stylesheet">
            <!-- Documentation extras -->
            <link href="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/css/kids/style.css" rel="stylesheet">
            <link href="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/css/kids/animate.css" rel="stylesheet">
            <link href="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/css/kids/open-sans.css" rel='stylesheet'>
            <link href="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/css/kids/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
            

        <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

        <!-- Favicons -->
        <link rel="shortcut icon" href="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/logo.png"> 
    </head>

    <body>
        <div class="container">
            <div class="wrap">
                <header class="header">
                    <div class="col-md-4 logo col-sm-7 col-xs-12">
                        <a href="http://192.168.1.200/yiiprojects/team-b/finaldomotikk" class=""><img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/general/logo.png" alt="Exclusive luxe"></a>
                    </div>
                    <div class="col-md-5 col-md-offset-3 col-sm-5 col-xs-12">
                            <div class="row login-div">
                                <a class="register animated fadeInDown delay-05s" href="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/users/dashboard">Dashboard Area</a>
                                <a class="join animated fadeInDown delay-07s"   href="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/home/logout">Logout</a>
                            </div>
                        <div class="row search-part">
                                                        <div class="cart">
                                    </a>
   
                                   
                                  <a href="cart.html" class="cart-icon dropdown-toggle animated fadeInUp" data-toggle="dropdown" id="mycart">
            	<span>0</span>
            </a>      
                                       
                                 <ul aria-labelledby="mycart" role="menu" class="dropdown-menu cart-list">
                                        <li class="view"><a href="cart.html">View My Cart</a></li>
                                         
                                       

                                       
                                        </li>

                                    </ul>
                                </div>
                            <form class="form-inline animated fadeInUp">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                                        <input class="form-control" type="email" placeholder="Search">
                                    </div>
                                </div>
                            </form>
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
<form class="bs-docs-example form-horizontal" id="user-register-form" action="/yiiprojects/team-b/finaldomotikk/index.php/home/join" method="post">                                <div id="reg-error-div" class="alert btn-danger" style="display: none;color:#FFF"></div>
                                <div class="form-group">
<input class="form-control" id="email" placeholder="Enter email" title="Please fill out this field with your email." required="required" name="User[email]" type="text" maxlength="255" />                                    <div class="errorMessage" id="User_email_em_" style="display:none"></div>                                </div>
                                <div class="form-group">
<input class="form-control" id="email" placeholder="Enter user name" title="Please fill out this field with your user name." required="required" name="User[username]" type="text" maxlength="50" />                                    <div class="errorMessage" id="User_username_em_" style="display:none"></div>                                </div>
                                <div class="form-group">
<input class="form-control" placeholder="Enter Password" title="Please fill out this field with password." required="required" name="User[password]" id="User_password" type="password" maxlength="250" />                                    <div class="errorMessage" id="User_password_em_" style="display:none"></div>                                </div>
                                <div class="form-group">
                                    <span class="login-link">Already a member: <a  class="close login" data-dismiss="modal" data-toggle="modal" data-target="#login-modal">Login</a></span>
                                </div>
                                <!--                                    <button type="submit" class="btn btn-default log-btn">Join</button>-->
<input id="reg" class="btn btn-default log-btn" type="submit" name="yt0" value="Join" />                                </form>                            </div>

                        </div>
                    </div>
                </div>
                <!--end Join Modal -->


                <!--Login Modal-->
                <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel"><span class="login-icon"><img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/login-icon.png" alt="" /></span>Login</h4>
                            </div>
                            <div class="modal-body">
<form class="bs-docs-example form-horizontal" id="login-form" action="/yiiprojects/team-b/finaldomotikk/index.php/home/Login" method="post">                                <div id="login-error-div" class="errorMessage" style="display: none;"></div>
                                <div class="form-group">
<input class="form-control" id="email" placeholder="Enter username" title="Please fill out this field with your username." required="required" name="LoginForm[username]" type="text" />                                    <div class="errorMessage" id="LoginForm_username_em_" style="display:none"></div>                                </div>
                                <div class="form-group">
<input class="form-control" placeholder="Enter Password" title="Please fill out this field with password." required="required" name="LoginForm[password]" id="LoginForm_password" type="password" />                                    <div class="errorMessage" id="LoginForm_password_em_" style="display:none"></div>                                </div>
                                <div class="form-group">
                                    <span class="login-link">Don't have an account ? <a href="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/home/register">Register</a></span>
                                </div>
<input id="login" class="btn btn-default log-btn" type="submit" name="yt1" value="Log In" />
                                </form>                            </div>

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
                                <li><a href="/yiiprojects/team-b/finaldomotikk/cloths"><img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/general/nav/m1.png" class="animated fadeIn delay-02s">CLOTHES & ACCESSORIES</a></li>
                                                                <li><a href="/yiiprojects/team-b/finaldomotikk/travel"><img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/general/nav/m2.png" class="animated fadeIn delay-02s">TRAVEL</a></li>
                                                                <li><a href="/yiiprojects/team-b/finaldomotikk/cosmetic"><img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/general/nav/m3.png" class="animated fadeIn delay-02s">COSMETIC</a></li>
                                                                <li><a href="/yiiprojects/team-b/finaldomotikk/jewlery"><img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/general/nav/m4.png" class="animated fadeIn delay-02s">JEWLERY</a></li>
                                                                <li><a href="/yiiprojects/team-b/finaldomotikk/motor"><img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/general/nav/m5.png" class="animated fadeIn delay-02s">MOTOR</a></li>
                                                                <li><a href="/yiiprojects/team-b/finaldomotikk/homedecor"><img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/general/nav/m6.png" class="animated fadeIn delay-02s">HOME DÉCOR</a></li>
                                                                <li><a href="/yiiprojects/team-b/finaldomotikk/electronics"><img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/general/nav/m7.png" class="animated fadeIn delay-02s">ELECTRONICS</a></li>
                                                                <li><a href="/yiiprojects/team-b/finaldomotikk/kids"><img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/general/nav/m8.png" class="animated fadeIn delay-02s">KIDS</a></li>
                                                                <li><a href="/yiiprojects/team-b/finaldomotikk/lifestyle"><img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/general/nav/m9.png" class="animated fadeIn delay-02s">LYFESTYLE</a></li>
                                                                <li><a href="/yiiprojects/team-b/finaldomotikk/realstate"><img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/general/nav/m10.png" class="animated fadeIn delay-02s">REAL STATE</a></li>
                                                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
                
                
</div>
</div>

<div class="main_menu animated fadeInDown delay-05s">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="wrap">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="collapse-1">
                    <ul class="nav navbar-nav">
                        
                                    <li class="dropdown">
                                        <a href="/yiiprojects/team-b/finaldomotikk/kids/category?cat_id=12" class="dropdown-toggle">Diapering</a>
                                        <ul class="dropdown-menu" role="menu"><li><a href="/yiiprojects/team-b/finaldomotikk/kids/subCategory?subcat_id=24">Subcat 1</a></li>
                                        </ul>
                                    </li>                        
                                    <li class="dropdown">
                                        <a href="/yiiprojects/team-b/finaldomotikk/kids/category?cat_id=13" class="dropdown-toggle">feeding & nursing</a>
                                        <ul class="dropdown-menu" role="menu"><li><a href="/yiiprojects/team-b/finaldomotikk/kids/subCategory?subcat_id=25">Subcat 2</a></li>
                                        </ul>
                                    </li>                        
                                    <li class="dropdown">
                                        <a href="/yiiprojects/team-b/finaldomotikk/kids/category?cat_id=14" class="dropdown-toggle">Bath, skin & healther care</a>
                                        <ul class="dropdown-menu" role="menu"><li><a href="/yiiprojects/team-b/finaldomotikk/kids/subCategory?subcat_id=26">Subcat 3</a></li>
                                        </ul>
                                    </li>                        
                                    <li class="dropdown">
                                        <a href="/yiiprojects/team-b/finaldomotikk/kids/category?cat_id=15" class="dropdown-toggle">toys & gaming</a>
                                        <ul class="dropdown-menu" role="menu"><li><a href="/yiiprojects/team-b/finaldomotikk/kids/subCategory?subcat_id=27">Subcat 4</a></li>
                                        </ul>
                                    </li>                        
                                    <li class="dropdown">
                                        <a href="/yiiprojects/team-b/finaldomotikk/kids/category?cat_id=16" class="dropdown-toggle">foot wear</a>
                                        <ul class="dropdown-menu" role="menu"><li><a href="/yiiprojects/team-b/finaldomotikk/kids/subCategory?subcat_id=28">Subcat 5</a></li>
                                        </ul>
                                    </li>                        
                                    <li class="dropdown">
                                        <a href="/yiiprojects/team-b/finaldomotikk/kids/category?cat_id=17" class="dropdown-toggle">clothes & fashion</a>
                                        <ul class="dropdown-menu" role="menu"><li><a href="/yiiprojects/team-b/finaldomotikk/kids/subCategory?subcat_id=29">Subcat 6</a></li>
                                        </ul>
                                    </li>                        
                                    <li class="dropdown">
                                        <a href="/yiiprojects/team-b/finaldomotikk/kids/category?cat_id=18" class="dropdown-toggle">baby gear & nursery</a>
                                        <ul class="dropdown-menu" role="menu"><li><a href="/yiiprojects/team-b/finaldomotikk/kids/subCategory?subcat_id=30">Subcat 7</a></li>
                                        </ul>
                                    </li>                        
                                    <li class="dropdown">
                                        <a href="/yiiprojects/team-b/finaldomotikk/kids/category?cat_id=19" class="dropdown-toggle">birthday & gifts</a>
                                        <ul class="dropdown-menu" role="menu"><li><a href="/yiiprojects/team-b/finaldomotikk/kids/subCategory?subcat_id=31">Subcat 8</a></li>
                                        </ul>
                                    </li>                        
                                    <li class="dropdown">
                                        <a href="/yiiprojects/team-b/finaldomotikk/kids/category?cat_id=20" class="dropdown-toggle">books, CDs & school supplies</a>
                                        <ul class="dropdown-menu" role="menu"><li><a href="/yiiprojects/team-b/finaldomotikk/kids/subCategory?subcat_id=32">Subcat 9</a></li>
                                        </ul>
                                    </li>                        
                                    <li class="dropdown">
                                        <a href="/yiiprojects/team-b/finaldomotikk/kids/category?cat_id=21" class="dropdown-toggle">mum & maternity</a>
                                        <ul class="dropdown-menu" role="menu"><li><a href="/yiiprojects/team-b/finaldomotikk/kids/subCategory?subcat_id=33">Subcat 10</a></li>
                                        </ul>
                                    </li>                        
                                    <li class="dropdown">
                                        <a href="/yiiprojects/team-b/finaldomotikk/kids/category?cat_id=22" class="dropdown-toggle">super savers</a>
                                        <ul class="dropdown-menu" role="menu"><li><a href="/yiiprojects/team-b/finaldomotikk/kids/subCategory?subcat_id=34">Subcat 11</a></li>
                                        </ul>
                                    </li>                                            </ul>


                </div><!-- /.navbar-collapse -->

            </div><!-- /.container-fluid -->
        </div>
    </nav>
</div>
    <div class="container">
        <div class="wrap">
            <div class="col-md-12 col-xs-12 pages">
                <ul class="page_path wp4 delay-05s animated fadeInRight">
                    <li><a href="javascript:void(0);">Categories</a> >> </li>
                    <li><a href="/kids">kids</a> >> </li>
                    <li class="active"><a href="/kids/category?cat_id=13">feeding & nursing</a></li>
                </ul>
            </div>
        </div>
    </div>
            
<div class="container">
    <div class="wrap">

        <div class="col-md-6" style="padding:0">
            <!-- main slider carousel -->
            <img id="zoom_03" class="slider-zoom" src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/small/image1.png" data-zoom-image="img/large/image1.jpg"/> 
            <div id="gallery_01">
                <a href="#" data-image="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/small/image1.png" data-zoom-image="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/large/image1.jpg" > 
                    <img id="img_01" src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/thumb/image1.jpg" /> 
                </a> 
                <a href="#" data-image="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/small/image2.png" data-zoom-image="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/large/image2.jpg"> 
                    <img id="img_01" src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/thumb/image2.jpg" /> 
                </a> 
                <a href="#" data-image="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/small/image3.png" data-zoom-image="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/large/image3.jpg"> 
                    <img id="img_01" src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/thumb/image3.jpg" /> 
                </a> 
                <a href="#" data-image="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/small/image4.png" data-zoom-image="img/large/image4.jpg"> 
                    <img id="img_01" src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/thumb/image4.jpg" /> 
                </a> 
            </div>  
        </div>

            <div class="col-md-6 col-xs-12 wp4 delay-05s">
                <p class="main_item_name">Product 2</p>
                <p class="main_item_price">90 GBP</p>
                <div class="main_item_specs">
                    <form class="form-horizontal" role="form" method="post" action="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/home/cart">
                        <div class="form-group">
                            <label class="col-sm-2 control-label item_specs_lbl wp4 delay-05s animated fadeInRight">Color</label>
                            <div class="col-sm-10">
                                <select class="form-control item_select">
                                    <option></option>
                                                                            <option>Red</option>
                                                                            <option>Yellow</option>
                                                                    </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label item_specs_lbl wp4 delay-07s animated fadeInRight">Size</label>
                            <div class="col-sm-10">
                                <select class="form-control item_select">
                                    <option></option>
                                                                            <option>3 to 4 years</option>
                                                                            <option>1</option>
                                                                            <option>2</option>
                                                                    </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label item_specs_lbl wp4 delay-09s">Quantity</label>
                            <div class="col-sm-10">
                                <input name="quantity" required="true" value="1">
                                <input name="id" hidden="true" value="477">
                                <input name="cat_id" hidden="true" value="13">
                            </div>
                        </div>

                        <div class="form-group wp4 delay-1s">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn item_specs_btn" type="submit">
                                <img src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/kids/add_to_cart.png" />
                                Add To Cart</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="prod_collapse">
                    <a  data-toggle="collapse" data-target="#item_desc" class="coll_title">
                      Product description
                    </a>

                    <div id="item_desc" class="collapse">
                        <p class="prod_desc wp4 delay-05s">tets test</p>
                    </div>

                </div>
                <div class="prod_collapse">
                    <a data-toggle="collapse" data-target="#item_rev" class="coll_title">Reviews</a>
                    <div id="item_rev" class="collapse">
                        <p class="prod_desc">
                                                           
                                <div class="add-review">
                                    <form id="add-review" class="collapse" method="post" action="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/kids/addReview">
                                        <textarea class="form-control" rows="3" name="comment"></textarea>
                                        <input id="input-21e" value="0" type="number" class="rating" min=0 max=5 step=1 data-size="xs" name="rate">
                                        <input name="product" hidden="true" value="477">
                                        <button class="btn add-review-link" type="submit">ADD</button>
                                    </form>
                                </div>
                                <button class="btn add-review-link" data-toggle="collapse" data-target="#add-review">Add your review</button>
                        </p>
                    </div>
                </div>
            </div>
    </div>

</div>
</div>
</div>

<footer class="footer">
    <div class="container">
        <div class="wrap">
            <div class="col-md-2">

                <ul style="max-width: 300px;" class="nav nav-pills nav-stacked">


                    
                        <li><span class="ul-title">Company</span></li>
                                                    <li><a href="/yiiprojects/team-b/finaldomotikk/home/faq">faqs</a></li>
                            <li><a href="/yiiprojects/team-b/finaldomotikk/home/contact">contact us</a></li>
                                                
                            <li><a href="/yiiprojects/team-b/finaldomotikk/about-us">About Us</a></li>
                        
                            <li><a href="/yiiprojects/team-b/finaldomotikk/about-site">About Site</a></li>
                        
                        <li><span class="ul-title">Policy</span></li>
                                                
                            <li><a href="/yiiprojects/team-b/finaldomotikk/privacy-policy">Privacy Policy</a></li>
                        
                            <li><a href="/yiiprojects/team-b/finaldomotikk/terms-of-condition">Terms Of Condition</a></li>
                        

                </ul>
            </div>

            <div class="col-md-2">
                <ul style="max-width: 300px; margin-top:30px;" class="nav nav-pills nav-stacked">

                    <li><a href="static_col_1.html">buttons & badges</a></li>
                    <li><a href="static_col_2.html">mobile apps</a></li>
                    <li><a href="static_col_1.html">in the news</a></li>
                    <li><a href="static_col_3.html">pro centre</a></li>  
                </ul>
            </div>

            <div class="col-md-3" style="width:18% !important;">
                <ul style="max-width: 300px;" class="nav nav-pills nav-stacked">
                    <li><span class="ul-title">category:</span></li>
                    

                        <li><a href="/yiiprojects/team-b/finaldomotikk/cloths">CLOTHES & ACCESSORIES</a></li>



                        <li><a href="/yiiprojects/team-b/finaldomotikk/travel">TRAVEL</a></li>



                        <li><a href="/yiiprojects/team-b/finaldomotikk/cosmetic">COSMETIC</a></li>



                        <li><a href="/yiiprojects/team-b/finaldomotikk/jewlery">JEWLERY</a></li>



                        <li><a href="/yiiprojects/team-b/finaldomotikk/motor">MOTOR</a></li>



                        <li><a href="/yiiprojects/team-b/finaldomotikk/homedecor">HOME DÉCOR</a></li>

                </ul>
            </div>

            <div class="col-md-2">
                <ul style="max-width: 300px; margin-top:30px;" class="nav nav-pills nav-stacked">
                                            <li><a href="/yiiprojects/team-b/finaldomotikk/electronics">ELECTRONICS</a></li>
                        <li><a href="/yiiprojects/team-b/finaldomotikk/kids">KIDS</a></li>
                        <li><a href="/yiiprojects/team-b/finaldomotikk/lifestyle">LYFESTYLE</a></li>
                        <li><a href="/yiiprojects/team-b/finaldomotikk/realstate">REAL STATE</a></li>

                </ul>
            </div>

            <div class="col-md-3 col-sm-12 pull-right">
                <div class="logo">
                    <a class="" href="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/home"><img alt="Exclusive luxe" src="http://192.168.1.200/yiiprojects/team-b/finaldomotikk/img/general/logo.png"></a>
                </div><!--end logo-->

                <ul class="isocial boot-tooltip pull-right" id="social">
                    <li><a class="face" data-original-title="facebok" data-toggle="tooltip" href="http://www.facebook.com/" target="blank"></a></li>
                    <li><a class="twitter" data-original-title="twitter" data-toggle="tooltip" href="http://twitter.com/" target="blank"></a></li>
                    <li><a class="linkdin" data-original-title="mail" data-toggle="tooltip" href="http://www.google.com" target="blank"></a></li>
                    <li><a class="instagram" data-original-title="instgram" data-toggle="tooltip" href="http://pinterest.com" target="blank"></a></li>
                    <li><a class="google" data-original-title="youtube" data-toggle="tooltip" href="http://www.google.com" target="blank"></a></li>

                </ul>
            </div>
            <div class="col-md-12">
                <p class="download pull-right">Download Our Application: <a href="http://www.google.com">Exclusive App</a> | <a href="http://www.google.com">Instgram App</a></p>
                <p class="download pull-right">copyright © 2014 . All Rights Reserved . UK pro solutions ltd</p>
            </div>

        </div>
    </div>
</footer>


<!-- JS and analytics only. -->
<!-- Bootstrap core JavaScript
================================================== -->
<script src="/yiiprojects/team-b/finaldomotikk/js/waypoints.min.js"></script>
<script src="/yiiprojects/team-b/finaldomotikk/js/bootstrap.js"></script>



<script src="/yiiprojects/team-b/finaldomotikk/js/star-rating.js" type="text/javascript"></script>
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

    $('.dropdown').mouseover(function() {
        $(this).addClass('open');
    });
    $('.dropdown').mouseleave(function() {
        $(this).removeClass('open');
    });

</script>


<script>
    $('.fav_icon').click(function() {
        $(this).toggleClass('add_fav');
        $(this).toggleClass('add_fav_solid');
    });

</script>
<script>
    $('.coll_title').click(function()
    {
        $(this).toggleClass('coll_title_in');
    });
</script>


<script src="/yiiprojects/team-b/finaldomotikk/js/jquery-ui.js"></script>
<link rel="stylesheet" href="/yiiprojects/team-b/finaldomotikk/css/cosmetic/jquery-ui.css">
<script src='/yiiprojects/team-b/finaldomotikk/js/jquery.elevatezoom.js'></script>
<script>
//initiate the plugin and pass the id of the div containing gallery img 
    $("#zoom_03").elevateZoom({
        gallery: 'gallery_01',
        cursor: 'pointer',
        galleryActiveClass: 'active',
        imageCrossfade: true,
        zoomType: "inner",
        loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});
    //pass the img to Fancybox 
    $("#zoom_03").bind("click", function(e) {
        var ez = $('#zoom_03').data('elevateZoom');
        $.fancybox(ez.getGalleryList());
        return false;
    });

</script>


<script>

    $('.toggle-big1').click(function() {
        $('.toggle-div1').addClass('open');
        $('.toggle-div2').removeClass('open');
        $('.toggle-div3').removeClass('open');
        $('.toggle-big1').addClass('active');
        $('.toggle-big2').removeClass('active');
        $('.toggle-big3').removeClass('active');
    });

    $('.toggle-big2').click(function() {
        $('.toggle-div2').addClass('open');

        $('.toggle-div1').removeClass('open');
        $('.toggle-div3').removeClass('open');
        $('.toggle-big2').addClass('active');
        $('.toggle-big1').removeClass('active');
        $('.toggle-big3').removeClass('active');
    });


    $('.toggle-big3').click(function() {
        $('.toggle-div3').addClass('open');

        $('.toggle-div2').removeClass('open');
        $('.toggle-div1').removeClass('open');
        $('.toggle-big3').addClass('active');
        $('.toggle-big1').removeClass('active');
        $('.toggle-big2').removeClass('active');
    });
</script>

<script type="text/javascript">
/*<![CDATA[*/
jQuery(function($) {
jQuery('body').on('click','#reg',function(){jQuery.ajax({'beforeSend':function(){
                                             $("#reg").attr("disabled",true);
            },'complete':function(){
                                             //$("#user-register-form").each(function(){ this.reset();});
                                             $("#reg").attr("disabled",false);
                                        },'success':function(data){
				   				var x=data.split("*-*");
                                             if(x[0] == "wrong"){
												 $("#reg-error-div").show();
                                                $("#reg-error-div").html("<h5>Register failed!</h5>");$("#reg-error-div").append(x[1]);

                                      }
          else{
			   	$("#user-register-form").html("<h4 style=\"color:red;text-align:center;\">Congratulation, your account has been created, you can login now.</h4>");
                //parent.location.href = "/yiiprojects/team-b/finaldomotikk/users/editprofile";

                                             }

                                        },'type':'POST','url':'/yiiprojects/team-b/finaldomotikk/index.php/home/join','cache':false,'data':jQuery(this).parents("form").serialize()});return false;});
jQuery('#user-register-form').yiiactiveform({'validateOnSubmit':true,'attributes':[{'id':'User_email','inputID':'User_email','errorID':'User_email_em_','model':'User','name':'email','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {


if(jQuery.trim(value)!='' && !value.match(/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/)) {
	messages.push("Email is not a valid email address.");
}


if(jQuery.trim(value)!='') {
	
if(value.length>255) {
	messages.push("Email is too long (maximum is 255 characters).");
}

}

}},{'id':'User_username','inputID':'User_username','errorID':'User_username_em_','model':'User','name':'username','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {

if(jQuery.trim(value)!='') {
	
if(value.length>50) {
	messages.push("Username is too long (maximum is 50 characters).");
}

}

}},{'id':'User_password','inputID':'User_password','errorID':'User_password_em_','model':'User','name':'password','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {

if(jQuery.trim(value)!='') {
	
if(value.length>250) {
	messages.push("Password is too long (maximum is 250 characters).");
}

}

}}],'errorCss':'error'});
jQuery('body').on('click','#login',function(){jQuery.ajax({'beforeSend':function(){
                                             $("#login").attr("disabled",true);
            },'complete':function(){
                                             $("#login-form").each(function(){ this.reset();});
                                             $("#login").attr("disabled",false);
                                        },'success':function(data){
                                             //var obj = jQuery.parseJSON(data);
                                             if(data == "wrong"){
												 $("#login-error-div").show();
                                                $("#login-error-div").html("<h4>Login failed! Please try again.</h4>");$("#login-error-div").append("");

                                      }
          else{

			   $("#login-form").html("<h4>Login Successful! Please Wait...</h4>");
                                         parent.location.href = "/yiiprojects/team-b/finaldomotikk/home/index";

                                             }

                                        },'type':'POST','url':'/yiiprojects/team-b/finaldomotikk/index.php/home/login','cache':false,'data':jQuery(this).parents("form").serialize()});return false;});
jQuery('#login-form').yiiactiveform({'validateOnSubmit':true,'validateOnChange':true,'validateOnType':false,'attributes':[{'id':'LoginForm_username','inputID':'LoginForm_username','errorID':'LoginForm_username_em_','model':'LoginForm','name':'username','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {

if(jQuery.trim(value)=='') {
	messages.push("Username cannot be blank.");
}

}},{'id':'LoginForm_password','inputID':'LoginForm_password','errorID':'LoginForm_password_em_','model':'LoginForm','name':'password','enableAjaxValidation':false,'clientValidation':function(value, messages, attribute) {

if(jQuery.trim(value)=='') {
	messages.push("Password cannot be blank.");
}

}}],'errorCss':'error'});
});
/*]]>*/
</script>
</body>
</html>
  
