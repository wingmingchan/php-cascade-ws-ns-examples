<?php
/*
This program can be used to generate a list of PHP assignments
to a variable named $site_name like this:

$site_name = "22q";
$site_name = "9000ny";
$site_name = "Shared-Pages";

This list can be copied and pasted into a program that should be run
against every site manually. The last assignment (e.g. $site_name = "Shared-Pages";)
will take effect, and the code will be executed against the Shared-Pages site. When the
program finishes executing, remove the last assignment, and the program can be
executed again, applied to the 9000ny site instead.
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
    $site_ids = $admin->getSites();
    
    foreach( $site_ids as $site_id )
    {
        echo '$' . 'site_name = ' . '"' . $site_id->getPathPath() . '";' . BR . "\n";
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