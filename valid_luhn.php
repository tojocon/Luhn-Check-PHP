<?php
// valid_luhn.php - outputs the validity of a number by applying the Luhn Checksum
// example command line usage:
//       php valid_luhn.php 79927398713 
// outputs: 79927398713 is valid.
// author: Toby Jones

$num = (string)$argv[1];
$is_valid_luhn = false;

// basic sanity check
if ( strlen( $num ) > 2 && is_numeric( $num ) ){
    $is_valid_luhn = check( $num );
}

$out = "\n".$num;
if ($is_valid_luhn ){
    $out .= ' is valid.';
}else{
    $out .= ' is not valid.';    
}
echo $out."\n";




// check() implments Luhn algorithm
function check( $num ){

    // a check digit should be added to the end so collect it
    $num_arr = str_split( $num );
    $last_element = array_pop( $num_arr );
    $sum = 0;

    // every other element starting with first from the end gets doubled
    // reverse the order for convenient foreach loop and first double at position 0
    $reversed_arr = array_reverse( $num_arr );
    $count=0;
    foreach( $reversed_arr as $digit ){
        
        if( $count % 2 === 0 ){
            $val=  2 * intval($digit);
            if ( $val > 9 ){
                $val = $val - 9;
            }
        }else{
            $val = intval( $digit );
        }
   
        $sum += $val;
        $count++;
    }
    
    //add the checksum digit
    $sum += intval( $last_element );
    return ($sum % 10 == 0);
}


