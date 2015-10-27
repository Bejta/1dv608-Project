<?php

namespace view;

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');


class NavigationView{

	private static $changeLink = "Ratingchangecalculator";
    private static $performanceLink = "Ratingperformancecalculator";
    private static $expectedscoreLink = "Expectedscorecalculator";
	private static $indexLink = '';

	public function changePressed() { 
      return isset($_GET[self::$changeLink]);
    }

	public function performancePressed() { 
	      return isset($_GET[self::$performanceLink]);
	}

    public function expectedscorePressed() { 
          return isset($_GET[self::$expectedscoreLink]);
    }

    
	/*****************
	 ****
	 **** Function decides if user opened some of the calculators or is on the index page...
	 **** Returns link(s) according to that.
	 ****
	 ****************/   
	public function show(){

		if($this->IfCalculatorPosted()==true){
			return $this->generateIndexLink();
		}
		else{
			return $this->generateCalculatorLinks();
		}
	}
    
    /*****************
	 ****
	 **** Render links to different calculators
	 ****
	 ****************/   
    public function generateCalculatorLinks(){
    	return "<div>
	      		  <a href='?" . self::$changeLink . "'>Rating change calculator</a><br />
	      		  <a href='?" . self::$performanceLink . "'>Rating performance calculator</a><br />
	      		  <a href='?" . self::$expectedscoreLink . "'>Expected score calculator</a><br />
      		  </div>";
    }
    
    
    /*****************
	 ****
	 **** Checks if any link of calculator is pressed, if not.
	 ****
	 ****************/   
    public function IfCalculatorPosted(){
    	if(isset($_GET[self::$changeLink]) || isset($_GET[self::$performanceLink])|| isset($_GET[self::$expectedscoreLink])){
    		return true;
    	}
    	return false;
    }


    /*****************
	 ****
	 **** Render link to Index page
	 ****
	 ****************/   
	public function generateIndexLink() {
        return "<a href='?" . self::$indexLink . "'>Go to start page</a><br />";
 	}

 	public function backToIndex(){
		header('Location:/?');
	}
}