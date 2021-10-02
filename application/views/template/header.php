<!DOCTYPE html>
<html>
	<head>
		<!--[if lte IE 8]><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /><![endif]-->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>GPA version 2.0</title>
		<link href="<?php echo css_url('style');?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo css_url('fullcalendar');?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo css_url('karma-golden');?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo css_url('secondary-golden');?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo css_url('jquery-ui-1.8.23.custom');?>" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="#"/>
		<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="<?php echo css_url('ie8');?>/><![endif]-->
		<link href="<?php echo css_url('standard');?>" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="<?php echo js_url('jquery-1.4.2.min');?>"></script>
		<script type="text/javascript" src="<?php echo js_url('karma');?>"></script>
		
		<script type="text/javascript" src="<?php echo js_url('jquery');?>"></script>
		<script type="text/javascript" src="<?php echo js_url('jquery.ui.core');?>"></script>
		<script type="text/javascript" src="<?php echo js_url('jquery.ui.widget');?>"></script>
		<script type="text/javascript" src="<?php echo js_url('jquery.ui.datepicker');?>"></script>
		<script type="text/javascript" src="<?php echo js_url('jquery.ui.datepicker-fr');?>"></script>
		<script type="text/javascript" src="<?php echo js_url('jquery.dataTables');?>"></script>
		<script type="text/javascript" src="<?php echo js_url('fullcalendar');?>"></script>
		<script type="text/javascript" src="<?php echo js_url('jquery.validate');?>"></script>
		<script> 
			jQuery(function() {
				jQuery( "#dte_debut" ).datepicker();
				jQuery( "#dte_fin" ).datepicker();
			});
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div class="top-block">
					<div class="top-holder">
					<!-- ***************** - Top Toolbar Left Side - ***************** -->
 						<div class="sub-nav">
 						</div><!-- end sub-nav -->
 						<!-- ***************** - END Top Toolbar Left Side - ***************** -->
						<!-- ***************** - Top Toolbar Right Side - ***************** -->
						<div class="sub-nav2">
						</div><!-- end sub-nav2 -->
						<!-- ***************** - END Top Toolbar Right Side - ***************** -->
					</div><!-- end top-holder -->
				</div><!-- end top-block -->
				<div class="header-holder">
					<div class="rays">
						<div class="header-area">
						<!-- ***************** - LOGO - ***************** -->
							<a href="<?php echo site_url();?>" class="logo">
								<img src="<?php echo img_url('gpa.png');?>" alt="GPA" />
							</a>
						<!-- ***************** - END LOGO - ***************** -->
