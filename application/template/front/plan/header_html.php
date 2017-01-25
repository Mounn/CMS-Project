<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $title; ?></title>
	<meta name="keywords" content="<?php echo $keywords;?>" />
	<meta name="description" content="<?php echo $description; ?>" />
	<link rel="stylesheet" href="<?php echo base_url();?>application/template/front/plan/style.css" type="text/css" media="screen, projection" />
</head>

<body>

<div id="wrapper">

	<div id="header">
        <h1 id="logo"><a href="<?php echo base_url(); ?>"><?php echo $sitename; ?> </a></h1>
	</div><!-- #header-->
	<div id="menu">
		<ul id="nav">
            <?php show_menu(); ?>
		</ul>
	    </div>