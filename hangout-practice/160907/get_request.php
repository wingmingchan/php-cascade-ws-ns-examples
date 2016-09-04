<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $cascade->getAsset( a\TextBlock::TYPE, "388fa7a58b7ffe83164c93149320e775" );
    echo u\XMLUtility::replaceBrackets( $service->getLastRequest() );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}
/*
<?xml version="1.0" encoding="UTF-8"?> 
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" 
    xmlns:ns1="http://www.hannonhill.com/ws/ns/AssetOperationService">
  <SOAP-ENV:Body>
    <ns1:read>
      <ns1:authentication>
        <ns1:password>password</ns1:password>
        <ns1:username>username</ns1:username>
      </ns1:authentication>
      <ns1:identifier>
        <ns1:id>388fa7a58b7ffe83164c93149320e775</ns1:id>
        <ns1:type>block_TEXT</ns1:type>
      </ns1:identifier>
    </ns1:read>
  </SOAP-ENV:Body>
</SOAP-ENV:Envelope> 
*/
?>