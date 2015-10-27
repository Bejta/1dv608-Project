<?php 

namespace view;

require_once("model/KFactorModel.php");

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

class RatingChangeView {

	private static $playerRating = 'RatingChangeView::playerRating';
	private static $numberOfGames = 'RatingChangeView::numberOfGames';
	private static $numberOfPoints = 'RatingChangeView::numberOfPoints';
	private static $averageRating = 'RatingChangeView::averageRating';
	private static $calculate = 'RatingChangeView::calculate';
	private static $messageId = 'RatingChangeView::messageId';
	private static $value = 'RatingChangeView::value';
	private $kfm;
	private $result='';
	private $selected='' ;

	
	public function __construct(){

		$this->kfm = new \model\KFactorModel();
	}

	public function response() {

		$response = $this->generateRatingChangeFormHTML($this->result);
		
		return $response;
	}

	/*
     *
     * Validation of user input
     *
     */
	public function validation(){

        $validationError='';


        if (!($this->getPlayerRating()!="" && (int)$this->getPlayerRating() == $this->getPlayerRating() && ((int)$this->getPlayerRating() > 800 && (int)$this->getPlayerRating() <3000)))
		{
            
				$validationError .= 'Player rating should be positive number between 800 and 3000! <br />';
				
		}
		if(!((int)$this->getNumberOfGames() == $this->getNumberOfGames() && ((int)$this->getNumberOfGames() > 0 && (int)$this->getNumberOfGames() < 100)))
		{
                $validationError .=  'Number of games should be positive number between 1 and 100! <br />';

		}
		if (!($this->getNumberOfPoints()!="" && (int)($this->getNumberOfPoints()*2) == ($this->getNumberOfPoints()*2) && ((int)$this->getNumberOfPoints() <= (int)$this->getNumberOfGames())))
		{
                $validationError .=  'Number of points should be positive half-integer or integer between 0 and number of games <br />';

		}
	   if (!($this->getAverageRating()!="" && (int)$this->getAverageRating() == $this->getAverageRating() && ((int)$this->getAverageRating() > 800 && (int)$this->getAverageRating() <3000)))
		{
				$validationError .= 'Average rating should be positive number between 800 and 3000! <br />';
		}

        if($validationError=='')
        {

        	$validationError = "ok";
        }
		return $validationError;

    }

	
	public function generateRatingChangeFormHTML($result) {
		return '<form method="post"> 

		<fieldset>
					<legend>Rating change calculator</legend>
					<br /><br />
					<div>
					<label for="' . self::$playerRating . '">Enter player rating :</label>
					<input type="text" class="input" id="' . self::$playerRating . '" name="' . self::$playerRating . '" value="' . $this->getPlayerRating() . '" />
					</div>
                    <br />
                    <div>
					<label for="' . self::$numberOfGames . '">Number of games :</label>
					<input type="text" class="input" id="' . self::$numberOfGames . '" name="' . self::$numberOfGames . '" value="' . $this->getNumberOfGames() . '" />
					</div>
                    <br />
                    <div>
                    <label for="' . self::$numberOfPoints . '">Number of points :</label>
					<input type="text" class="input" id="' . self::$numberOfPoints . '" name="' . self::$numberOfPoints . '" value="' . $this->getNumberOfPoints() . '" />
					</div>
                    <br />
                    <div>
                    <label for="kfactor">K-Factor :</label>
                    '.$this->setKFactorSelected().'
                    <select class="inputSelect" name = "kfactor">
					'.$this->getKFactor($this->selected).'
					</select>
					</div>
					<br />
					<div>
					<label for="' . self::$averageRating . '">Average rating of oponents :</label>
					<input type="text" class="input" id="' . self::$averageRating . '" name="' . self::$averageRating . '" value="' . $this->getAverageRating() . '" />
					</div>
                    <br />
                    <div>
					<input type="submit" class="command" name="' . self::$calculate . '" value="calculate" />
					</div>
					<br /><br />
					<div>
					<p class="message" id="' . self::$messageId . '">' . $result . '</p>
					</div>
					<br /><br />
		</fieldset>
		<div class="explanation">
		   <p>K is the development coefficient. </p>
		   <br />
		   <p>K = 40 for a player new to the rating list until he has completed events with at least 30 games </p>
		   <p>K = 20 as long as a players rating remains under 2400. </p>
		   <p>K = 10 once a players published rating has reached 2400 and remains at that level subsequently, even if the rating drops below 2400.</p>
		   <p>K = 40 for all players until their 18th birthday, as long as their rating remains under 2300. </p>
		   <p>K = 20 for RAPID and BLITZ ratings all players.</p>
		</div>		
		</form>';
	}
    
    /*
     *
     *
     *
     */
	private function getKFactor($selected){
		$option='';
		foreach($this->kfm->getKFactors() as $key => $value){

			if($selected == $value){
				$option .= '<option value="'.$value.'" selected>'.$value.'</option>';
			}
			else{
				$option .= '<option value="'.$value.'">'.$value.'</option>';
			}
		}
		return $option;
	}

	// If Calculate button is pressed
	public function IsCalculatePosted() {
		return isset($_POST[self::$calculate]);
	}

	public function setKFactorSelected(){
			if(isset($_POST['kfactor'])){
			$this->selected = $_POST['kfactor'];
		}
	}

	public function getPOSTKFactor(){
		return $_POST['kfactor'];
	}

	public function getValue(){
		if (isset($_POST[self::$value])) {
      	return ($_POST[self::$value]);
   		 }
	}

	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getPlayerRating() {
		//RETURN REQUEST VARIABLE: playerRating

		if(isset($_POST[self::$playerRating])) {

            return $_POST[self::$playerRating];

        } 
        else {

            return '';
        }
	}
	public function getAverageRating() {
		//RETURN REQUEST VARIABLE: averageRating

		if(isset($_POST[self::$averageRating])) {

            return $_POST[self::$averageRating];

        } 
        else {

            return '';
        }
	}
	public function getNumberOfGames() {
		//RETURN REQUEST VARIABLE: numberOfGames

		if(isset($_POST[self::$numberOfGames])) {

            return $_POST[self::$numberOfGames];

        } 
        else {

            return '';
        }
	}
	public function getNumberOfPoints() {
		//RETURN REQUEST VARIABLE: numberOfGames

		if(isset($_POST[self::$numberOfPoints])) {

            return $_POST[self::$numberOfPoints];

        } 
        else {

            return '';
        }
	}

	/*
     * Resets result!
     */
    public function resetResult()
    {
       $result = '';
    }

    public function getResultSucced($result)
    { 
    	if ($result>0){
    		$this->result = 'Player with rating  ' . $this->getPlayerRating() . ' against ' . $this->getNumberOfGames() . ' oponents that are rated ' . $this->getAverageRating() . ' in average won: ' .$result . ' rating points.'  ;

    	}
    	else if ($result<0){
    		$this->result = 'Player with rating  ' . $this->getPlayerRating() . ' against ' . $this->getNumberOfGames() . ' oponents that are rated ' . $this->getAverageRating() . ' in average lose: ' .$result . ' rating points.'  ;

    	}
    	else if ($result==0){
    		$this->result = 'Player performed exactly as expected and his Elo rating will not be changed' ;
    	}
          
    }

    /*
     * setter for result
     */
    public function setResult($result)
    {
          $this->result = $result;
    }
}