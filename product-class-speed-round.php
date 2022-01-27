<?php

	class Product{

		private $title;
		private $description;
		private $price;
		private $weight;

		public function __construct($args = array()){

			$defaults = array(
				'title' => 'default',
				'description' => 'default',
				'price' => 5,
				'weight' => array(
					'value' => 5,
					'units' => 'lbs'
				)
			);

			$args = array_merge($defaults, $args);

			$this->title = $args['title'];
			$this->description = $args['description'];
			$this->price = $args['price'];
			$this->weight = $args['weight'];
		}

		// Getter functions:
		public function get_title(){return $this->title;}
		public function get_description(){return $this->description;}
		public function get_price(){return $this->price;}
		public function get_weight(){return $this->weight;}

		// Setter functions:
		public function set_title($title){$this->title = $title;}
		public function set_description($des){$this->description = $des;}
		public function set_price($price){$this->price = $price;}
		public function set_weight($weight){$this->weight = $weight;}

		// Convert lbs to oz, return error if some other unit is used
		protected function convert_to_oz(){
			if($this->weight['units'] != 'oz'){
				if($this->weight['units'] != 'lbs'){
					return 'error, not pounds or oz';
				}
				$this->weight['value'] = $this->weight['value'] * 16;
				$this->weight['units'] = 'oz';
			}
		}
	}

	class Product_Shipped extends Product{

		private $shipping_per_oz = .7;
		private $tax = .1025;

		// Return the price of shipping
		private function check_item_shipping(){
			
			$this->convert_to_oz();
			$weight = $this->get_weight();
			return $weight['value'] * $this->shipping_per_oz;
		}

		// Return the items tax based on it's price
		private function check_item_tax(){

			return $this->get_price() * $this->tax;
		}

		// Get a list of costs and a total price in an array
		public function get_price_array(){

			$price_array = array(
				'price' => $this->get_price(),
				'tax' => $this->check_item_tax(),
				'shipping' => $this->check_item_shipping(),
				'total' => $this->get_price()
					+ $this->check_item_tax() 
					+ $this->check_item_shipping()
			);

			return $price_array;
		}
	}

	$playstation = new Product_Shipped(array(
		'title' => 'PlayStation',
		'description' => 'Gaming Console',
		'price' => 500,
		'weight' => array(
			'value' => 6,
			'units' => 'lbs'
		)
	));

	?><pre><?php

	print_r($playstation->get_price_array());

	?></pre><?php

	$ddr_machine = new Product_Shipped(array(
		'title' => 'DDR Machine',
		'description' => 'Dance Dance Revolution Gaming system',
		'price' => 1500,
		'weight' => array(
			'value' => 500,
			'units' => 'lbs'
		)
	));

	?><pre><?php

	print_r($ddr_machine->get_price_array());

	?></pre><?php

	$drift_car = new Product_Shipped(array(
		'title' => 'Drift Car',
		'description' => "It's a car for drifting!",
		'price' => 10000,
		'weight' => array(
			'value' => 2600,
			'units' => 'lbs'
		)
	));

	?><pre><?php

	print_r($drift_car->get_price_array());

	?></pre>