<?php 

	$paypal = new \PayPal\Rest\ApiContext(
	        new \PayPal\Auth\OAuthTokenCredential(
	            'AYxgecDrmR7HHV1crZb2t_Fc5N56rEQZJwu1OmUGjPycrMMKoSHepe87R2vW2P9J3m1PwJzRN9jWKDV4',     // ClientID
	            'EL959jdtJ6ulfxtVLTqTLfqRMR1Hh2NYmrRnSvyVV7vfchDv2TcGg7kxNQ7Wp0MOCWXPhngokAt-LR9m'      // ClientSecret
	        )
	);