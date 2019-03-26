<?php 
/*
This program shows how to list all assets within a folder.
There are two ways to show the result: either as a list, or
as an XML document.
*/
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $at = $admin->getAsset( a\Folder::TYPE, '506024598b7f08ee0c71f5c09776dbb5' )->
        getAssetTree();
        
    // output the list
    echo $at->toListString();
    // output the XML
    echo S_PRE, u\XmlUtility::replaceBrackets( $at->toXml() ), E_PRE;  
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