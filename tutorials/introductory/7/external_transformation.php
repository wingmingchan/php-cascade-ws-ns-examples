<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $xml  = $admin->getAsset(
        a\XmlBlock::TYPE, "c1c150508b7f08ee4fe76bb8883e80b5" )->getXml();
    $xsl  = $admin->getAsset(
        a\XsltFormat::TYPE, "c1cdc7488b7f08ee4fe76bb8b0635d4a" )->getXml();
    $xslt = new XSLTProcessor();
    
    $xslt->importStylesheet( new SimpleXMLElement( $xsl ) );
    echo $xslt->transformToXml( new SimpleXMLElement( $xml ) );
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