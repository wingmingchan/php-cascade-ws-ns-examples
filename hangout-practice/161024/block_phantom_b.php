<?php

require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

/*
Phantom nodes of type B in blocks:
The asset cannot be read at all, hence there is no fix.

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><soapenv:Body><readResponse xmlns="http://www.hannonhill.com/ws/ns/AssetOperationService">
<readReturn>
<asset xsi:nil="true" />
<message xsi:nil="true" />
<success>false</success>
</readReturn></readResponse></soapenv:Body></soapenv:Envelope>
*/

try
{
	$block = $service->retrieve(
	    $service->createId( a\DataBlock::TYPE, "ec29d12c8b7ffe832dc7cebea81e066f" ) );
	//$block = $cascade->getAsset(
	    //a\DataBlock::TYPE, "ec29d12c8b7ffe832dc7cebea81e066f" );
	u\DebugUtility::dump( $block );
	
	echo $service->getLastResponse();
}
catch( \Exception $e ) 
{
  echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
	echo S_PRE . $er . E_PRE; 
}
?>