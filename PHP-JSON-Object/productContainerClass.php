<?php

    class ProductContainer {

        private $productName = "";

        private $productPrice = "";

        private $productPageCount;

        private $productISBN = "";

        function public__construct($inName, $inPrice){
            $this->set_name($inName);
            $this->set_price($inPrice);
        }

        //Setters

        public function set_name($inName){
            $this->productName = $inName;
        }

        public function set_price($inPrice){
            $this->productPrice = $inPrice;
        }

        public function set_pages($inPages){
            $this->productPageCount = $inPages;
        }

        public function set_isbn($inIsbn){
            $this->productISBN = $inIsbn;
        }

        //Getters

        public function getName(){
            return $this->productName;
        }

        public function getPrice(){
            return $this->productPrice;
        }

        public function getPages(){
            return $this->productPageCount;
        }

        public function getIsbn(){
            return $this->productISBN;
        }


    }

?>