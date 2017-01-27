<?php
/*
This program shows how to search for all groups.
At most 250 groups will be returned, unless we are willing to
use characters and wildcard like "a*".
*/
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $groups = $cascade->getGroups();
    
    u\DebugUtility::dump( $groups );
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