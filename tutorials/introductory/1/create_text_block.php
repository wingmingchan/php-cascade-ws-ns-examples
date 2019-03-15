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
    $parent = $cascade->getAsset( a\Folder::TYPE, "54713b9e8b7ffe83552dce4f21a3d6e8" );
    $block  = $cascade->createTextBlock(
        $parent,
        "new-block",
        "Some data string"
    );
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