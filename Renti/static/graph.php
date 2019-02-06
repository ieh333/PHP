<?php

// PHP Graph - find updates and more at: http://www.puremango.co.uk/2005/08/php_graph_18/

// generate random numbers for graph
session_start();
$seed = rand(200,450);

// for the demo:
$amounts = $_SESSION['arrChart'];

$coeffDivider= 10;
$grid_space = 500;
if (max($amounts) <2000)
{ $coeffDivider /= 2; $grid_space /= 2;} 
else
if (max($amounts) <5000)
{ $coeffDivider *= 1; $grid_space *= 1;} 
else
if (max($amounts) <10000)
{ $coeffDivider *= 2; $grid_space *= 2;} 
else
if (max($amounts) <20000)
{ $coeffDivider *= 4; $grid_space *= 4;} 
else
if (max($amounts) <30000)
{ $coeffDivider *= 8; $grid_space *= 8;} 
else
if (max($amounts) <100000)
{ $coeffDivider *= 16; $grid_space *= 16;} 
else
if (max($amounts) <1000000)
{ $coeffDivider *= 128; $grid_space *= 128;} 
else
{ $coeffDivider *= 256; $grid_space *= 256;} 

// sort amounts (lowest>highest)
// if(rand(0,1)>0.5) {
	// asort($amounts);
// }

// user defined vars:
// all measurements are in pixels

	// any less than 12 will cut off the text
	$bar_height = 20;//rand(12,20);

	// how many pixels to leave between bars (vertically)
	$bar_spacing = 8; //rand(1,10);

	// set grid spacing, any less than 25 will fudge the text. min 50 is preferable.
	//$valid_spacings = Array(50,100,150);
	//$grid_space = 1000;//$valid_spacings[rand(0,count($valid_spacings)-1)];

	// amount of space to give for bar titles (horizontally)
	$bar_title_space = 70;

	// (optional) title of graph
	//$graph_title = "Graph of random stuff. Refresh for more.";

	// vertical space to leave for title
	$graph_title_space = 20;

	// (optional) graph footer
	//$graph_footer = "Coded By ";

	// vertical space to leave for footer
	$graph_footer_space = 20;

	// colour of bars
	// 0=red, 1=green, 2=blue, 3=random
	$bar_colour = 0;//rand(0,2);

// end setup

// calculate required width and height of image
$pic_width = $bar_title_space+max($amounts)/$coeffDivider + 100;//($grid_space*1.5);
$pic_height = ($bar_height+$bar_spacing+2)*sizeof($amounts)+20+$graph_title_space+$graph_footer_space;

// create image
$pic = ImageCreate($pic_width+1,$pic_height+1);

// allocate colours
$white = ImageColorAllocate($pic,255,255,255);
$grey  = ImageColorAllocate($pic,200,200,200);
$lt_grey  = ImageColorAllocate($pic,210,210,210);
$black = ImageColorAllocate($pic,0,0,0);

// fill background of image with white
ImageFilledRectangle($pic,0,0,$pic_width,$pic_height,$white);

// draw graph title
//ImageString($pic,5,($pic_width/2)-(strlen($graph_title)*5),0,$graph_title,$black);

// draw graph footer
//ImageString($pic, 2,($pic_width/2)-(strlen($graph_footer)*3),$pic_height-$graph_footer_space, $graph_footer, $grey);

// draw grid markers
for($x_axis=$bar_title_space ; ($x_axis-$bar_title_space)<max($amounts)+$grid_space ; $x_axis+=$grid_space) {
	// draw vertical grid marker
	
	ImageLine($pic,($x_axis/$coeffDivider) + 63,$graph_title_space,$x_axis/$coeffDivider+ 63,$pic_height-$graph_footer_space,$grey);

	// draw horizontal line above grid numbers
	ImageLine($pic,$x_axis,($pic_height-$graph_footer_space-25),$x_axis-($bar_title_space+$grid_space),($pic_height-$graph_footer_space-25),$grey);

	// draw grid numbers
	ImageString($pic, 3, $x_axis/$coeffDivider+68, ($pic_height-$graph_footer_space-20), $x_axis-($bar_title_space), $black);
}

// draw bars
$y_axis=$graph_title_space;


	// for a nice smooth fade of colour.
	$col = 180;
	$decrement = intval($col/count($amounts));


foreach($amounts as $key=>$amount) {
	// write the bar title
	ImageString($pic, 2, ($bar_title_space-(strlen($key)*6)), $y_axis, $key, $black);

	// allocate a colour for this bar
		$col -= $decrement;
		if($bar_colour==0) {
			// faded red
			$tempCol = ImageColorAllocate($pic,255,$col,$col);
		} else if($bar_colour==1) {
			// faded green
			// 200 because green just looks too bright otherwise
			$tempCol = ImageColorAllocate($pic,$col,200,$col);
		} else if($bar_colour==2) {
			// faded blue
			$tempCol = ImageColorAllocate($pic,$col,$col,255);
		}
	
	//$amount /=10;
	// draw the bar
	ImageFilledRectangle($pic,($bar_title_space+1),$y_axis,$amount/$coeffDivider+$bar_title_space,($y_axis+$bar_height),$tempCol);

	if(($amount)<15) {
		// if it's a tiny amount, write the amount outside the bar in black
		ImageString($pic, 2, ($amount/$coeffDivider+3)+$bar_title_space, $y_axis, $amount, $black);
	} else {
		// or if over 20, write the amount inside the bar in white
		// the strlen stuff is to ensure number is aligned with the end of the bar. works quite well, too.
		ImageString($pic, 2, ($amount/$coeffDivider-(strlen($amount)*6))+$bar_title_space, $y_axis, $amount, $white);
	}

	// move down
	$y_axis+=($bar_spacing+1)+$bar_height;
}

//header("Content-type: image/png");

// output image
ImagePNG($pic);

// remove image from memory
ImageDestroy($pic);
?>