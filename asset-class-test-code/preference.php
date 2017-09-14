<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
	$preference = $cascade->getPreference();
	u\DebugUtility::dump( $preference->toStdClass() );
	
	//u\DebugUtility::dump( $preference->getMap() );
	
	$names      = $preference->getNames();
	u\DebugUtility::dump( $names );

	$common     = array();
	$difference = array();
	
	foreach( $preference->toStdClass()->preference as $pref )
	{
		if( !in_array( $pref->name, $common ) )
		{
			$common[] = $pref->name;
		}
		else
		{
			$difference[] = $pref->name;
		}
	}
	
	u\DebugUtility::dump( $difference );
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Preference" );
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