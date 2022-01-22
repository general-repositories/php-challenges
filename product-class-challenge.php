<?php
	class Products{
		private $title;
		private $description;

		protected $price;
		protected $weight;

		public function __construct($title = 'default', $description = 'default', $price = 10){
			$this->title = $title;
			$this->description = $description;
			$this->price = $price;
		}

		// setters
		public function set_title($title){$this->title = $title;}
		public function set_description($description){$this->description = $description;}
		public function set_price($price){$this->price = $price;}

		// getters
		public function get_title(){return $this->title;}
		public function get_description(){return $this->description;}
		public function get_price(){return $this->price;}

		protected function set_weight($lbs){

			$ounces = $lbs * 16;

			$this->weight = $ounces;
		}
	}

	class Product_W_Price extends Products{
		private $shipping_per_ounce = 0.7;
		private $shipping;

		private $tax = .1025;

		private $total_price;

		private function set_shipping(){
			$this->shipping = $this->weight * $this->shipping_per_ounce;
		}

		private function get_shipping(){return $this->shipping;}

		private function calc_tax(){return $this->price * $this->tax;}

		public function total_price($lbs){
			$this->set_weight($lbs);
			$this->set_shipping();

			$taxes = $this->calc_tax();
			$shipping = $this->get_shipping();
			$total = $this->price + $taxes + $shipping;

			$prices = array(
				'taxes' => $taxes,
				'shipping' => $shipping,
				'total' => $total
			);

			return $prices;
		}
	}

	$playstation = new Product_W_Price('PlayStation', 'Gaming Console', 500);

	print_r($playstation->total_price(6));