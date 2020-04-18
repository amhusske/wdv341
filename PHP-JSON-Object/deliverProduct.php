<?php
	
	require 'productContainerClass.php';
	
	$productObj = new ProductContainer();
	
	$productObj->set_name("PHP Textbook");
	$productObj->set_price("$129.95");
	$productObj->set_pages(329);
	$productObj->set_isbn("13-1234435690");

	$productObj->ProductName = $productObj->getName();
	$productObj->ProductPrice = $productObj->getPrice();
	$productObj->ProductPageCount = $productObj->getPages();
	$productObj->ProductISBN = $productObj->getIsbn();



//
	$returnObj = json_encode($productObj);	//create the JSON object
//	
	echo $returnObj;							//send results back to calling program
?>