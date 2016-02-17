<?php

namespace Leasing\CoreBundle\APIutils\Paymaya;

class Checkout
{
	//Sandbox
    private $publicKey = "pk-iaioBC2pbY6d3BVRSebsJxghSHeJDW4n6navI7tYdrN";
    private $secret = "sk-uh4ZFfx9i0rZpKN6CxJ826nVgJ4saGGVAH9Hk7WrY6Q";
    private $endPoint = "https://api.paymaya.com/sandbox/checkout/v1/checkouts";

    public function initiateCheckout($data)
    {
    	$uspas = $this->publicKey.':';
    	$key = base64_encode($uspas);
    	$auth = "Authorization: Basic ".$key;

    	$headers = array(
    		'Content-Type: application/json',
    		$auth
    	);

    	/*$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $this->endPoint);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_HEADER, FALSE);
    	curl_setopt($ch, CURLOPT_POST, TRUE);
    	//curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    	curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		  \"totalAmount\": {
		    \"currency\": \"PHP\",
		    \"value\": \"6404.90\",
		    \"details\": {
		      \"discount\": \"300.00\",
		      \"serviceCharge\": \"50.00\",
		      \"shippingFee\": \"200.00\",
		      \"tax\": \"691.60\",
		      \"subtotal\": \"5763.30\"
		    }
		  },
		  \"buyer\": {
		    \"firstName\": \"Juan\",
		    \"middleName\": \"dela\",
		    \"lastName\": \"Cruz\",
		    \"contact\": {
		      \"phone\": \"+63(2)1234567890\",
		      \"email\": \"paymayabuyer1@gmail.com\"
		    },
		    \"shippingAddress\": {
		      \"line1\": \"9F Robinsons Cybergate 3\",
		      \"line2\": \"Pioneer Street\",
		      \"city\": \"Mandaluyong City\",
		      \"state\": \"Metro Manila\",
		      \"zipCode\": \"12345\",
		      \"countryCode\": \"PH\"
		    },
		    \"billingAddress\": {
		      \"line1\": \"9F Robinsons Cybergate 3\",
		      \"line2\": \"Pioneer Street\",
		      \"city\": \"Mandaluyong City\",
		      \"state\": \"Metro Manila\",
		      \"zipCode\": \"12345\",
		      \"countryCode\": \"PH\"
		    },
		    \"ipAddress\": \"125.60.148.241\"
		  },
		  \"items\": [
		    {
		      \"name\": \"Canvas Slip Ons\",
		      \"code\": \"CVG-096732\",
		      \"description\": \"Shoes\",
		      \"quantity\": \"3\",
		      \"amount\": {
		        \"value\": \"1621.10\",
		        \"details\": {
		          \"discount\": \"100.00\",
		          \"subtotal\": \"1721.10\"
		        }
		      },
		      \"totalAmount\": {
		        \"value\": \"4863.30\",
		        \"details\": {
		          \"discount\": \"300.00\",
		          \"subtotal\": \"5163.30\"
		        }
		      }
		    },
		    {
		      \"name\": \"PU Ballerina Flats\",
		      \"code\": \"CVR-096RE2\",
		      \"description\": \"Shoes\",
		      \"quantity\": \"1\",
		      \"amount\": {
		        \"value\": \"600.00\"
		      },
		      \"totalAmount\": {
		        \"value\": \"600.00\"
		      }
		    }
		  ],
		  \"redirectUrl\": {
		    \"success\": \"http://shop.someserver.com/success?id=6319921\",
		    \"failure\": \"http://shop.someserver.com/failure?id=6319921\",
		    \"cancel\": \"http://shop.someserver.com/cancel?id=6319921\"
		  },
		  \"requestReferenceNumber\": \"000141386713\",
		  \"metadata\": {}
		}");

    	//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json",
		  "Authorization: Basic cGstaWFpb0JDMnBiWTZkM0JWUlNlYnNKeGdoU0hlSkRXNG42bmF2STd0WWRyTjo="
		));
		//curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_CAINFO, "/Users/dexterloor/Documents/Projects/leasing/sf_leasing/src/Leasing/CoreBundle/APIutils/Paymaya/paymaya-certificate.crt");
		//curl_setopt($ch, CURLOPT_SSLVERSION, 1);

    	$response = curl_exec($ch);*/

    	$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://api.paymaya.com/sandbox/checkout/v1/checkouts");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_POST, TRUE);

		curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		  \"totalAmount\": {
		    \"currency\": \"PHP\",
		    \"value\": \"6404.90\",
		    \"details\": {
		      \"discount\": \"300.00\",
		      \"serviceCharge\": \"50.00\",
		      \"shippingFee\": \"200.00\",
		      \"tax\": \"691.60\",
		      \"subtotal\": \"5763.30\"
		    }
		  },
		  \"buyer\": {
		    \"firstName\": \"Juan\",
		    \"middleName\": \"dela\",
		    \"lastName\": \"Cruz\",
		    \"contact\": {
		      \"phone\": \"+63(2)1234567890\",
		      \"email\": \"paymayabuyer1@gmail.com\"
		    },
		    \"shippingAddress\": {
		      \"line1\": \"9F Robinsons Cybergate 3\",
		      \"line2\": \"Pioneer Street\",
		      \"city\": \"Mandaluyong City\",
		      \"state\": \"Metro Manila\",
		      \"zipCode\": \"12345\",
		      \"countryCode\": \"PH\"
		    },
		    \"billingAddress\": {
		      \"line1\": \"9F Robinsons Cybergate 3\",
		      \"line2\": \"Pioneer Street\",
		      \"city\": \"Mandaluyong City\",
		      \"state\": \"Metro Manila\",
		      \"zipCode\": \"12345\",
		      \"countryCode\": \"PH\"
		    },
		    \"ipAddress\": \"125.60.148.241\"
		  },
		  \"items\": [
		    {
		      \"name\": \"Canvas Slip Ons\",
		      \"code\": \"CVG-096732\",
		      \"description\": \"Shoes\",
		      \"quantity\": \"3\",
		      \"amount\": {
		        \"value\": \"1621.10\",
		        \"details\": {
		          \"discount\": \"100.00\",
		          \"subtotal\": \"1721.10\"
		        }
		      },
		      \"totalAmount\": {
		        \"value\": \"4863.30\",
		        \"details\": {
		          \"discount\": \"300.00\",
		          \"subtotal\": \"5163.30\"
		        }
		      }
		    },
		    {
		      \"name\": \"PU Ballerina Flats\",
		      \"code\": \"CVR-096RE2\",
		      \"description\": \"Shoes\",
		      \"quantity\": \"1\",
		      \"amount\": {
		        \"value\": \"600.00\"
		      },
		      \"totalAmount\": {
		        \"value\": \"600.00\"
		      }
		    }
		  ],
		  \"redirectUrl\": {
		    \"success\": \"http://shop.someserver.com/success?id=6319921\",
		    \"failure\": \"http://shop.someserver.com/failure?id=6319921\",
		    \"cancel\": \"http://shop.someserver.com/cancel?id=6319921\"
		  },
		  \"requestReferenceNumber\": \"000141386713\",
		  \"metadata\": {}
		}");

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json",
		  "Authorization: Basic cGstaWFpb0JDMnBiWTZkM0JWUlNlYnNKeGdoU0hlSkRXNG42bmF2STd0WWRyTjo="
		));

		$response = curl_exec($ch);

		echo "<pre>";
		var_dump(curl_errno($ch));
		var_dump(curl_error($ch));
		exit;

    	curl_close($ch);
    	exit;
    }
}

?>