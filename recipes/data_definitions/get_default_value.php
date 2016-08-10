<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try 
{
    $dd = $cascade->getAsset( 
        a\DataDefinition::TYPE, "5f4526a58b7f08ee76b12c41cf8ffc56" );

    $attrs = $dd->getField( "choose-type" );
    
    if( isset( $attrs[ 'default' ] ) )
    {
        echo $attrs[ 'default' ];
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
}
?>