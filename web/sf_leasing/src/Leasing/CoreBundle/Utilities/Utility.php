<?php

namespace Leasing\CoreBundle\Utilities;

use Leasing\CoreBundle\Utilities\Constant as C;

class Utility
{
	public static function generateCode($len, $extra = null)
	{
		$code = "";
        $code .= $extra;
        
        $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        shuffle($seed);
        
        foreach (array_rand($seed, $len) as $k) {
            $code .= $seed[$k];
        }
        
        return $code;
	}

	public static function mobileFormat($numbers)
    {
        $numbers = trim($numbers);
        $numbers = str_replace(" ", "", $numbers);
        $numbers = preg_replace("/[^0-9]/","", $numbers);
        $numbers = substr($numbers, -10);
        $numbers = "63".$numbers;
        
        return $numbers;
    }

    public static function cleanMobile($numbers)
    {
        $numbers = trim($numbers);
        $numbers = str_replace(" ", "", $numbers);
        $numbers = preg_replace("/[^0-9]/","", $numbers);
        
        return $numbers;
    }
}

?>