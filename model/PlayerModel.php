<?php

namespace model;

class playerModel{

	private $maximumEloDifference=400;


	/****
     ****
     * For calculation purposes, every oponent who is rated more then 400 Elo points
     * counts as rating 400 points (the same rule apply for average rating).
     * The same rule apply for Elo higher then 400 points then players Elo.
     ****
     ****/

	public function CalculateExpectedResult($averageRating,$rating,$numberOfGames){
        
        if($rating-$averageRating >$this->maximumEloDifference){
        	$averageRating=$rating-$this->maximumEloDifference;
        }
        else if($averageRating-$rating>$this->maximumEloDifference){
        	$averageRating=$rating+$this->maximumEloDifference;
        }

        $expectedScore = 1 / (1 + (pow(10,(($averageRating - $rating) / $this->maximumEloDifference))));
        $expectedScore=number_format(($expectedScore*$numberOfGames), 2, '.', '');
		
		return (float)$expectedScore;
	}

	public function CalculateRatingChange($kfactor,$score,$expectedscore){

		$ratingChange=number_format(($kfactor*($score-$expectedscore)),2, '.', '');

		return (float)$ratingChange;
	}

	public function CalculatePerformance($wins,$draws,$defeats,$averageRating){

		$ratingPerformance=number_format((($averageRating*($wins+$draws+$defeats))+$this->maximumEloDifference*($wins-$defeats))/($wins+$draws+$defeats),2, '.', '');


		return (float)$ratingPerformance;
	}
}