<?php 

namespace view;

//require_once("model/KFactorModel.php");

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

class PerformanceView {

	private static $numberOfDraws = 'PerformanceView::playerDraws';
	private static $numberOfWins = 'PerformanceView::numberOfWins';
	private static $numberOfDefeats = 'PerformanceView::numberOfDefeats';
	private static $averageRating = 'PerformanceView::averageRating';
	private static $calculate = 'PerformanceView::calculate';
	private static $messageId = 'PerformanceView::messageId';
	
	private $result='';
	

	
	public function __construct(){

		//$this->kfm = new \model\KFactorModel();
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


        if (!($this->getNumberOfWins()!="" && (int)$this->getNumberOfWins() == $this->getNumberOfWins() && ((int)$this->getNumberOfWins() >= 0 && (int)$this->getNumberOfWins() < 100)))
		{
            
				$validationError .= 'Number of wins can be between 0 and 99! <br />';
				
		}
		if (!($this->getNumberOfDraws()!="" && (int)$this->getNumberOfDraws() == $this->getNumberOfDraws() && ((int)$this->getNumberOfDraws() >= 0 && (int)$this->getNumberOfDraws() < 100)))
		{
                $validationError .=  'Number of draws can be between 0 and 99 <br />';

		}
		if (!($this->getNumberOfDefeats()!="" && (int)$this->getNumberOfDefeats() == $this->getNumberOfDefeats() && ((int)$this->getNumberOfDefeats() >= 0 && (int)$this->getNumberOfDefeats() < 100)))
		{
                $validationError .=  'Number of defeats can be between 0 and 99 <br />';

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
					<legend>Welcome to Rating performance calculator</legend>
					<br /><br />
					<div>
					<label for="' . self::$numberOfWins . '">Number of wins :</label>
					<input type="text" class="input" id="' . self::$numberOfWins . '" name="' . self::$numberOfWins . '" value="' . $this->getNumberOfWins() . '" />
					</div>
                    <br />
                    <div>
					<label for="' . self::$numberOfDraws . '">Number of draws :</label>
					<input type="text" class="input" id="' . self::$numberOfDraws . '" name="' . self::$numberOfDraws . '" value="' . $this->getNumberOfDraws() . '" />
					</div>
                    <br />
                    <div>
                    <label for="' . self::$numberOfDefeats . '">Number of defeats :</label>
					<input type="text" class="input" id="' . self::$numberOfDefeats . '" name="' . self::$numberOfDefeats . '" value="' . $this->getNumberOfDefeats() . '" />
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
					<div class="explanation">
				    <p>Performance rating is a hypothetical rating that would result from the games of a single event or rating period only. </p>
				    <p>Performance rating has no dependency of player actual rating.</p>
				    <p>Performance rating can be misleading, as player can have lower performance rating then actual rating but still make a plus in Elo change.</p>
				    <p>This happens when some of the oponents has a rating lower then actual rating-400. In rating change calculations this rating would be adjusted to rating-400</p>
		           </div>	
		</fieldset>		
		</form>';
	}
    
	// If Calculate button is pressed
	public function IsCalculatePosted() {
		return isset($_POST[self::$calculate]);
	}


	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getNumberOfWins() {
		//RETURN REQUEST VARIABLE: playerRating

		if(isset($_POST[self::$numberOfWins])) {

            return $_POST[self::$numberOfWins];

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
	public function getNumberOfDraws() {
		//RETURN REQUEST VARIABLE: numberOfGames

		if(isset($_POST[self::$numberOfDraws])) {

            return $_POST[self::$numberOfDraws];

        } 
        else {

            return '';
        }
	}
	public function getNumberOfDefeats() {
		//RETURN REQUEST VARIABLE: numberOfGames

		if(isset($_POST[self::$numberOfDefeats])) {

            return $_POST[self::$numberOfDefeats];

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

    /*
     * get succeed message
     */
    public function getResultSucced($result)
    { 
          $this->result = 'Rating performance against oponents with average Elo rating of  ' . $this->getAverageRating() . ' with ' . ($this->getNumberOfWins()+$this->getNumberOfDraws()/2) . ' points out of ' . ($this->getNumberOfDefeats()+$this->getNumberOfWins()+$this->getNumberOfDraws()) . ' games is: ' .$result  ;
    }

    /*
     * setter for result
     */
    public function setResult($result)
    {
          $this->result = $result;
    }
}