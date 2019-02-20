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
    // display wsdl:binding
    u\DebugUtility::dump(
        u\XmlUtility::replaceBrackets( $service->getBinding() ) );

    // display the complexType page
    u\DebugUtility::dump(
        u\XmlUtility::replaceBrackets(
            $service->getComplexTypeXMLByName( "page" ) ) );
    
    // display the simpleType searchFieldString
    u\DebugUtility::dump(
        u\XmlUtility::replaceBrackets(
            $service->getSimpleTypeXMLByName( "searchFieldString" ) ) );
}
catch( \Exception $e )
{
    echo S_PRE, $e, E_PRE;
}
catch( \Error $er )
{
    echo S_PRE, $er, E_PRE;
}
?>