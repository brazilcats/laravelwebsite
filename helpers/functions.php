<?php

function filterItemsByStoreId(array $items, $storeId)
{
	return array_filter($items, function($line) use($storeId){
		return $line['store_id'] == $storeId;
	});
}

function formatPriceToDatabase($price)
{
	return str_replace(['.', ','], ['', '.'], $price);
}

function phone_number_format($number) {
	// Allow only Digits, remove all other characters.
	$number = preg_replace("/[^\d]/","",$number);
   
	// get number length.
	$length = strlen($number);
   
   // if number = 10
 //  if($length == 11) {
	
//	preg_match( '/^\+\d(\d{2})(\d{5})(\d{4})$/', $number,  $matches ) )
//	{
//		$result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
//		return $result;
//	}
	//$number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "--", $number);
	//$number = preg_replace("/^\d(\d{2})(\d{5})(\d{4})$/", "-", $number);
   //} else {
	//   $number = $length;
  // }
	
	return $number;
   
  }

  function formatPhoneNumber($phoneNumber) {
    $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);

    if(strlen($phoneNumber) > 10) {
        //$countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
        $areaCode = substr($phoneNumber, -11, 2);
        $nextThree = substr($phoneNumber, -9, 5);
        $lastFour = substr($phoneNumber, -4, 4);

        $phoneNumber = ' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 2);
        $nextThree = substr($phoneNumber, 3, 4);
        $lastFour = substr($phoneNumber, 6, 4);

        $phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 7) {
        $nextThree = substr($phoneNumber, 0, 3);
        $lastFour = substr($phoneNumber, 3, 4);

        $phoneNumber = $nextThree.'-'.$lastFour;
    }

    return $phoneNumber;
}