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
    $sites = $admin->getSites();
    //$counter = 0;
    
    foreach( $sites as $site_id )
    {
        $service->publish( $site_id->toStdClass() );
/*        
        $counter++;
        
        if( $counter >= 1 )
            break;
*/
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