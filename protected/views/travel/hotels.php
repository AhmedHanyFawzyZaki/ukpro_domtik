<?php
/* @var $this SiteController */
 
$this->pageTitle=Yii::app()->name;
?>


<div class="search">
<div class="container"> 
<div class="wrap">

<form role="form" class="form-horizontal fligh-form ">
      <div class="form-group">
       <div class="col-sm-3 first-input">
          <input type="text" placeholder="Paris, France" id="" class="form-control">
        </div>
        
        <div class="col-sm-2 second-input">
          <input type="email" placeholder="Depart" id="" class="form-control departure">
          <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/calender.png"></i>
        </div> 
        
         <div class="col-sm-2 second-input">
          <input type="email" placeholder="Return" id="" class="form-control departure">
          <i class="calender"><img alt="" src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/calender.png"></i>
        </div> 
        
        <div class="col-sm-2 second-input">
          <select class="form-control">
        <option>1 room</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
        </div> 
        
        <div class="col-sm-2 second-input">
          <select class="form-control">
        <option>2 guests</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
        </div> 
        
        <div class="col-sm-1 search-input"><button class="btn btn-default" type="submit">search</button></div>
       
      </div>
      
 
      
    </form>

</div>
</div>
</div><!--end search-->


<div class="container">
<div class="wrap">

<div class="col-md-12 col-xs-12 page-headers">
    	<ul class="page_path">
                    <li><a href="#">home</a> >></li>
                    <li><a href="#">cheap hotels</a> >></li>
                    <li><a href="#">destinations</a> >></li>
                    <li><a href="#">europe</a> >></li>
                    <li><a href="#">france</a> >></li>
                     <li class="active"><a href="#">Paris Hotels & Accommodation</a></li>
                     
                </ul>
    </div>
    
<div class="col-sm-3 col-xs-12 ">
<div class="left-pan">
<span class="border">Find hotel name </span>
<input class="form-control left-input" value=""  type="text">
<!--end find-->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="headingOne">
      <h4 class="panel-title h4-coll">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
  <span>Price</span>
        </a>
      </h4>
    </div>
<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
       <p class="amount" >
  
  <input type="text" id="price" readonly>
</p>
<div id="slider-price"></div>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="headingTwo">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <span>Star Ratings</span>
        </a>
      </h4>
    </div>
 <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
 <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> <div class="star-r">
   <i class="fa fa-star good"></i>
	 <i class="fa fa-star good"></i>
 <i class="fa fa-star good"></i>
<i class="fa fa-star good"></i>
<i class="fa fa-star good"></i>
    </div>
        </label>
      </div>
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> <div class="star-r">
   <i class="fa fa-star good"></i>
	 <i class="fa fa-star good"></i>
 <i class="fa fa-star good"></i>
<i class="fa fa-star good"></i>
<i class="fa fa-star poor"></i>
    </div>
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> <div class="star-r">
   <i class="fa fa-star good"></i>
	 <i class="fa fa-star good"></i>
 <i class="fa fa-star good"></i>
<i class="fa fa-star poor"></i>
<i class="fa fa-star poor"></i>
    </div>
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> <div class="star-r">
   <i class="fa fa-star good"></i>
	 <i class="fa fa-star good"></i>
<i class="fa fa-star poor"></i>
<i class="fa fa-star poor"></i>
<i class="fa fa-star poor"></i>

    </div>
        </label>
      </div>
    </div>
  </div>
   </div>
  </div>
  </div>
  <!--rating end-->
  <div class="clearfix"></div>
   <div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="headingsix">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
         <span>Themes</span>
        </a>
      </h4>
    </div>
    <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix">
      <div class="panel-body">
 
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Budget Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox">  Business Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Family Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Romantic Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> City Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group" >
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Budget Hotel
        </label>
      </div>
    </div></div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Budget Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Budget Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Budget Hotel
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Budget Hotel
        </label>
      </div>
    </div>
  </div>
   </div>
    </div>
  </div>
<div class="clearfix"></div>
 <div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="heading6">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
         <span>Accommodation Type</span>
        </a>
      </h4>
    </div>
    <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
      <div class="panel-body">

 <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">  Hostel / Backpackers
        </label>
      </div>
    </div>
  </div>
 <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox">  Hotel
        </label>
      </div>
    </div>
  </div>
 <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Motel
        </label>
      </div>
    </div>
  </div> 
 <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox">Resort
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Serviced Apartment

        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox">Villa
        </label>
      </div>
    </div>
  </div>	
</div>
</div>
</div>
<div class="clearfix"></div>
 <div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="headingseven">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
     <Span>Districts/Areas</Span>
        </a>
      </h4>
    </div>
    <div id="collapseseven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingseven">
      <div class="panel-body">

<div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Balboa Park
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Balboa Park
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Balboa Park
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Balboa Park
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Beach Cities
        </label>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
   <div class="clearfix"></div>
   <div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="heading8">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap8" aria-expanded="false" aria-controls="collap8">
    <span>Hotel Amenities</span>
        </a>
      </h4>
    </div>
    <div id="collap8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
      <div class="panel-body">
   
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Airconditioning
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Facilities for Disabled
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Highspeed Internet
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Non-smoking Rooms
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Parking
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Airconditioning
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Facilities for Disabled
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Highspeed Internet
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Non-smoking Rooms
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Parking
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Airconditioning
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Facilities for Disabled
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Highspeed Internet
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Non-smoking Rooms
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Parking
        </label>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
     <div class="clearfix"></div>
     <div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="heading9">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap9" aria-expanded="false" aria-controls="collap9">
  <span>Hotel Chains & Brands</span>
        </a>
      </h4>
    </div>
    <div id="collap9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading9">
      <div class="panel-body">
 
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Best Value Inn and Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Inns
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Courtyard by Marriot
        </label>
      </div>
    </div>
  </div>
   <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Best Value Inn and Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Inns
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Courtyard by Marriot
        </label>
      </div>
    </div>
  </div>
 <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Best Value Inn and Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Inns
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Courtyard by Marriot
        </label>
      </div>
    </div>
  </div>
 <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Best Value Inn and Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Inns
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Comfort Suites
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="checkbox">
        <label>
          <input type="checkbox">Courtyard by Marriot
        </label>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
	
<div class="clearfix"></div> 
  <div class="panel panel-default">
    <div class="panel-heading bg-coll" role="tab" id="heading10">
      <h4 class="panel-title h4-coll">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collap10" aria-expanded="false" aria-controls="collap10">
<span>Legend</span>
        </a>
      </h4>
    </div>
    <div id="collap10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading10">
      <div class="panel-body">

<p>
Prices shown are per room, per night and include all taxes and other applicable fees unless otherwise indicated upon booking.
++
<br/>
<br/>
These prices do not include all taxes and other applicable fees upon booking.
 </p>  



   
</div>
</div>
</div>
</div>
</div><!--end left-pan-->

  
    <!--end right-pan-->
   





    

</div>
<div class="col-sm-9">
	<div class="col-sm-12 col-xs-12 right-pan hotel-bg">

     <div class="col-sm-3"> <a href="#"><img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/hotel-3.jpg"></a>

    </div>
    <div class="col-sm-6">
     <h3><a href="#">Pyramids Park Resort Cairo </a></h3>
    <div class="star-r">
   <i class="fa fa-star good"></i>
	 <i class="fa fa-star good"></i>
 <i class="fa fa-star good"></i>
<i class="fa fa-star-half-o good"></i>
<i class="fa fa-star poor"></i>
    </div>
    <span class="tittel-h">Giza</span>
    
      <Span class="rat-num">71</Span>
     
   <Span class="rat-p">Mediocre</Span>  
   <div class="clearfix"></div>
   <p> <a href="#"  class="review-num">195   reviews</a></p>
   
     
    </div>
    <div class="col-sm-3 deal">
  <p>EGP329</p>
 <img src="<?php echo Yii::app()->getBaseUrl(true); ?>/img/logo.png">
    <a href="details" class="deal-btn" type="submit">View deal</a>
    </div>
   
    </div>
    
    
</div>

</div>
</div>