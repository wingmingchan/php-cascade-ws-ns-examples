<?php
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $file = $cascade->getAsset( a\File::TYPE, "081f5b248b7ffe8339ce5d137fcdb3f8" );
    
    // the color will be #ff0000, not #ffffff
    $file->setText( "body{color:#ff0000}" )->
        setData( "body{color:#ffffff}" )->edit()->dump();
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