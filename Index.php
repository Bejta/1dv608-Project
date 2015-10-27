<?php

//INCLUDE THE FILES NEEDED...
require_once('controller/MasterController.php');
require_once("view/LayoutView.php");
require_once("view/NavigationView.php");
require_once("view/PerformanceView.php");
require_once("view/RatingChangeView.php");
require_once("view/ExpectedScoreView.php");
require_once("view/IndexView.php");
require_once("view/FooterView.php");


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');



//CREATE OBJECTS OF THE CONTROLLERS
$mc = new \controller\MasterController();

$mc->Run();
