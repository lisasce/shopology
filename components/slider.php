<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessMIX.php';
?>
	
<div class="col-3 d-none d-lg-block d-xl-block cards">
	
	<img class="w-100 h-100" src="../img/card2.PNG" alt="Card3">
	
</div>
<div id="carouselExampleIndicators" class="carousel slide col-lg-6 col-md-12 col-sm-12 discount" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <img src="../img/pub1.jpg" class="d-block h-100 mw-100" alt="...">
	    </div>
	    <div class="carousel-item">
	      <img src="../img/pub2.jpg" class="d-block h-100 mw-100" alt="...">
	    </div>
	    <div class="carousel-item">
	      <img src="../img/pub4.jpg" class="d-block h-100 mw-100" alt="...">
	    </div>
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
</div>

<div class="col-3 d-none d-lg-block d-xl-block cards">
	
		<img class="w-100 h-100" src="../img/card3.PNG" alt="Card3">
	
</div>


