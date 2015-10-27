<?php

namespace model;

class ExpectedScoreDAL{

/****************
 ***** Encapsulate path to the JSON file
 ***************/
	private static $file = file_get_contents('model/DAL/data/ExpectedScore.json');

    
/*****************
 ****
 **** Function that reads JSON file in array, and returns it.
 ****
 ****************/    
	public function getExpectedScores{
    
        $expectedScores = json_decode($file, true);
        return $expectedScores;

	}

}