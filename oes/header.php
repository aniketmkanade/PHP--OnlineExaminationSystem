<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>Online Examination System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="oes.css"/>
	<link rel="stylesheet" type="text/css" href="../oes.css"/>
	
	
        <script type="text/javascript" src="validate.js" ></script>
        <script type="text/javascript" src="cdtimer.js" ></script>
		
        <script type="text/javascript" src="../validate.js" ></script>
        <script type="text/javascript" src="../cdtimer.js" ></script>
		
		<link rel="stylesheet" type="text/css" media="all" href="calendar/jsDatePick.css" />
        <script type="text/javascript" src="calendar/jsDatePick.full.1.1.js"></script>
		
		<link rel="stylesheet" type="text/css" media="all" href="../calendar/jsDatePick.css" />
        <script type="text/javascript" src="../calendar/jsDatePick.full.1.1.js"></script>
  </head>
  <body>
	<?php
        if(isset($_GLOBALS['message'])) 	
        {
			echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
	?>
      <div id="container">
         
			<div class="header">
                <div title="Online Exam System" class="logo">&nbsp;</div>
				<h3 class="headtext"> &nbsp;Online Examination System </h3>
				<h4 class="tagLine"><i>...because Examination Matters</i></h4>
            </div>
		