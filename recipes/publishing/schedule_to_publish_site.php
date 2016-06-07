<?php
/*
This program can be used to schedule publishing of a site.
*/
require_once( 'cascade_ws_ns/auth_batch.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
	$cascade->getSite( "22q" )->
		setScheduledPublishing( true, 
			a\ScheduledPublishing::TUESDAY, NULL, NULL, '03:00:00.000'  )->edit();
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>