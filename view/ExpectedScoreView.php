<?php 

namespace view;



class ExpectedScoreView {

	private static $playerRating = 'ExpectedScoreView::playerRating';
	private static $numberOfGames = 'ExpectedScoreView::numberOfGames';
	private static $averageRating = 'ExpectedScoreView::averageRating';
	private static $calculate = 'ExpectedScoreView::calculate';
	private static $messageId = 'ExpectedScoreView::messageId';
	private $result='';

	public function response() {

		$response = $this->generateExpectedScoreFormHTML($this->result);
		
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

	
	public function generateExpectedScoreFormHTML($result) {
		return '<form method="post"> 

		<fieldset>
					<legend>Expected score calculator</legend>
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
				    <p>Expected score shows how many points player need to achive in order to keep his/her Elo Rating without changes. Every result under or over expected score will result in change in elo. </p>
		            <p>The situation is more then often that expected score is not an integer or half-integer, which means that player will eaither lose or win rating.</p>
		           </div>
		</fieldset>		
		</form>';
	}

	// If Calculate button is pressed
	public function IsCalculatePosted() {
		return isset($_POST[self::$calculate]);
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
          $this->result = 'Expected score for player rated ' . $this->getPlayerRating() . ' against ' . $this->getNumberOfGames() . ' oponents that are rated ' . $this->getAverageRating() . ' in average is: ' .$result  ;
    }

    /*
     * setter for result
     */
    public function setResult($result)
    {
          $this->result = $result;
    }
}