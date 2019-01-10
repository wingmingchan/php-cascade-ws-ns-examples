<?php
/*
This program shows how to work with shared fields.
*/

require_once( 'auth_soap_c8.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $sf = $admin->getAsset( a\SharedField::TYPE, "cf516637ac1e001b36b86cda03974a63" )->dump();
    
    $subscribers = $sf->getSubscribers();
    //u\DebugUtility::dump( $subscribers );
    
    // dump the data definitions associated with this shared field
    foreach( $subscribers as $dd )
    {
        $dd->getAsset( $service )->dump();
    }
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