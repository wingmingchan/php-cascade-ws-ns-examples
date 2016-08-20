<?php
/*
This program shows how to use the newly added cascade_ws_utility\ReflectionUtility class.
To run this example, upgrade the library to make the class available to MAMP.

After running this example, find out more about the class by checking out 
the available methods.
*/
require_once('auth_tutorial.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    //u\ReflectionUtility::showMethodSignatures( 
        //"cascade_ws_asset\Page" );
        
    u\ReflectionUtility::showMethodExample( 
        "cascade_ws_utility\ReflectionUtility", "showMethodSignatures" );    
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>