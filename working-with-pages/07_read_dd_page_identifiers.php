<?php
/*
This program shows how to retrieve fully qualified identifiers of nodes
on a page associated with a data definition.
These FQIs can be used to refer to structured data nodes found on a page.
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
	$page = $admin->getAsset( a\Page::TYPE, "681da2ca7f00000161e16fb03983fb1d" );
	u\DebugUtility::dump( $page->getIdentifiers() );
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