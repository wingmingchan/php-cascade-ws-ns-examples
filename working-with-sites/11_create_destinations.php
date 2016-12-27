<?php
/*
This program uses a function defined in admin_functions_rwd.php
to create destinations for a site and grants access to a group.
*/
require_once( 'admin_functions_rwd.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = "cascade-database";

    createDestinationForSites(
        $cascade,
        $site_name,
        "cru" // group name
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