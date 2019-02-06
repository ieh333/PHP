<!-- xml version="1.0" encoding="UTF-8" -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Лизингови операции</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="./static/styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="./static/nivo-slider.css" type="text/css" media="screen" charset="utf-8"/>
</head>
<body> 
					<?php session_start(); ?>
    <div id="main">
    	<!-- header -->
    <div id="header">
		<div id="logo">
            <a href="#"><span class="logo_span">Лизингови операции</span><br />
			</a>
			<?php //if (isset($_SESSION['fullname']) )  echo("fullname" . $_SESSION['fullname'] ); ?>
        </div>
        <div class="header_imgs">
            <a href="#"><img src="images/img_l2.png" class="header_img" alt="" /></a>
            <a href="#"><img src="images/img_l3.png" class="header_img" alt="" /></a>
        </div>
    </div>
    <!-- top -->
    <div class="top">
        <div class="top_img">
		
			 <div id="wrapper">
				<div id="slider-wrapper">        
					<div id="slider" class="nivoSlider">
						<img src="images/top_img.jpg" alt="" />
						<img src="images/top_img2.jpg" alt=""/>
						<img src="images/top_img3.jpg" alt="" />
						<img src="images/top_img4.jpg" alt="" />
						<img src="images/top_img5.jpg" alt="" />
					</div>        
				</div>
			</div>
<script type="text/javascript" src="JS/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="JS/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
		
		</div><div style="clear: both; padding-top: 40px;"></div>
    </div>
    
    <!-- buttons -->
    <div id="buttons">
        <a href="index.php" class="but"  title="">Начало</a>
   
		<?php 
		if (!isset($_SESSION['uID'])) 
			{echo('<a href="login.php" class="but"  title="">Вход</a>');} 
		else 
			{echo('<a href="logout.php" class="but"  title="">Изход</a>');}
			//(". $_SESSION['fullname'] . ")
			?> 
		 <a href="#" class="but" title=""></a> 
		  <a href="#" class="but" title=""></a> 
        <a href="#" class="but" title="">За&nbsp;нас</a>
    </div>
	

    <!-- content -->
    
    <div id="content">
     <div id="content_top">
        	<div id="content_bott">
              	<div id="left">
                	<div class="left_title">Лизингови операции</div>
                    <ul class="left_ul">
                        <li><a href="vnoskiPreload.php">Определяне размера на лизинговите вноски </a></li>
                        <li><a href="EffectPreload.php">Ефективност на лизингодателя </a></li>
                        <li><a href="CompPreload.php">Съпоставка лизинг/покупка</a></li>
					</ul>                  
                    
                </div>