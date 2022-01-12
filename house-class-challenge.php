<?php

	class House{
		public $bedrooms;
		public $bathrooms;
		public $squareFootage;
		public $isExpensive;

		public function __construct($bedrooms = 1, $bathrooms = 1, $squareFootage = 500, $isExpensive = false){
			$this->bedrooms = $bedrooms;
			$this->bathrooms = $bathrooms;
			$this->squareFootage = $squareFootage;
			$this->isExpensive = $isExpensive;
		}
		
		function materialCost(){
			return $this->isExpensive ? $this->squareFootage * 50 : $this->squareFootage * 5;
		}
		
		function laborCost(){return $this->squareFootage * .2;}

		function newFloorTotal(){return $this->laborCost() + $this->materialCost();}
	}

	$myHouse = new House(1, 1, 600);

	echo '<p>My-House Material Cost: ' . $myHouse->materialCost(true) . '</p>';
	echo '<p>My-House Labor Cost: ' . $myHouse->laborCost() . '</p>';
	echo '<p>My-House Total Flooring Cost: ' . $myHouse->newFloorTotal() . '</p>';
	
	$yourHouse = new House(2, 2, 1600, true);

	echo '<p>My-House Material Cost: ' . $yourHouse->materialCost(true) . '</p>';
	echo '<p>My-House Labor Cost: ' . $yourHouse->laborCost() . '</p>';
	echo '<p>My-House Total Flooring Cost: ' . $yourHouse->newFloorTotal() . '</p>';