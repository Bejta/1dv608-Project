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






//CREATE OBJECTS OF THE CONTROLLERS
$mc = new \controller\MasterController();

$mc->Run();
