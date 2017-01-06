<?php
/*
This program is used to create destinations for a site.
The included admin_functions_rwd.php can be found in
https://github.com/wingmingchan/php-cascade-ws-ns-examples/blob/master/working-with-sites/
*/
require_once( 'auth_chanw.php' );
require_once( 'admin_functions_rwd.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$site_name = "news-dev";

try
{
    createDestinationForSites( $cascade, $site_name, "news" );
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