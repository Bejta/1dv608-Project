<?php

namespace controller;




require_once("view/LayoutView.php");
require_once("view/NavigationView.php");
require_once("view/PerformanceView.php");
require_once("view/RatingChangeView.php");
require_once("view/ExpectedScoreView.php");
require_once("view/IndexView.php");
require_once("model/PlayerModel.php");


class MasterController{

	

	public function __construct()
	{

	}

	public function Run(){

		//CREATE OBJECTS OF THE VIEWS
		$v = new \view\IndexView();
		$fv = new \view\FooterView();
		$lv = new \view\LayoutView();
		$nv = new \view\NavigationView();
		$pv = new \view\PerformanceView();
		$rcv = new \view\RatingChangeView();
		$esv = new \view\ExpectedScoreView();

		//CREATE OBJECT OF THE MODEL
		$pm = new \model\PlayerModel();

        
        /******
         ***
         *** Checks if performance link is pressed...
         *** Then checks if calculate button is pressed. If not, just renders performance calculator page...
         *** If calculate is pressed, checks user inputs in validation function, and then if everything is ok, renders result.
         ***
         ******/
		if($nv->performancePressed()){

			if($pv->IsCalculatePosted()){

				$flag=$pv->validation();

		    	if($flag=="ok"){

				     $pv->getResultSucced($pm->CalculatePerformance($pv->getNumberOfWins(),$pv->getNumberOfDraws(),$pv->getNumberOfDefeats(),$pv->getAverageRating()));

				}
		    	else{

		            $pv->setResult($flag);

				}	
			}

      		$lv->render($nv,$pv,$fv);
      		
	    }

	    /******
         ***
         *** Checks if rating change link is pressed...
         *** Then checks if calculate button is pressed. If not, just renders rating change calculator page...
         *** If calculate is pressed, checks user inputs in validation function, and then if everything is ok, renders result.
         ***
         ******/
	    if($nv->changePressed()){

	    	if($rcv->IsCalculatePosted()){

	    		$flag=$rcv->validation();

		    	if($flag=="ok"){
	    		
	    		     $rcv->getResultSucced($pm->CalculateRatingChange($rcv->getPOSTKFactor(),$rcv->getNumberOfPoints(),$pm->CalculateExpectedResult($rcv->getAverageRating(),$rcv->getPlayerRating(),$rcv->getNumberOfGames())));
	    		}
	    		else{

		            $rcv->setResult($flag);
				}	
	    	}

	        $lv->render($nv,$rcv,$fv);
	        
	    }

	    /******
         ***
         *** Checks if expected score link is pressed...
         *** Then checks if calculate button is pressed. If not, just renders expected score calculator page...
         *** If calculate is pressed, checks user inputs in validation function, and then if everything is ok, renders result.
         ***
         ******/
	    if($nv->expectedscorePressed()){
            
		    if($esv->IsCalculatePosted()){
                
                $flag=$esv->validation();
                
		    	if($flag=="ok"){
                    
		    		$esv->getResultSucced($pm->CalculateExpectedResult($esv->getAverageRating(),$esv->getPlayerRating(),$esv->getNumberOfGames()));

		    	}
		    	else{

		            $esv->setResult($flag);

				}	
		    }
		    
	        $lv->render($nv,$esv,$fv);
	       
	    }

	    /********
	     ***
	     *** If no calculator links are pressed, loads start page.
	     ***
	     ********/
	    else if (!$nv->IfCalculatorPosted()){
	      	$lv->render($nv,$v,$fv);
	      	
	    }

	}
}