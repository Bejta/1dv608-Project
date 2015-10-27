<?php

namespace model;

class KFactorModel{

   private $KFactors = array(40,30,20,15,10);


	public function getKFactors(){
		return $this->KFactors;
	}
}