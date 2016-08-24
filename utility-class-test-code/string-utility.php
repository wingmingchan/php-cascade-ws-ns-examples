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
	echo ( u\StringUtility::startsWith( "Hello", "He" ) ? "yes" : "no" ), BR;
	
	echo ( u\StringUtility::startsWith( "Hello", "e" ) ? "yes" : "no" ), BR;

	echo u\StringUtility::removeSiteNameFromPath( "site://cascade-admin/web-services/api/utility-classes/debug-utility" ), BR;

	echo u\StringUtility::getParentPathFromPath( "/web-services/api/utility-classes/debug-utility" ), BR;

	echo u\StringUtility::getNameFromPath( "/web-services/api/utility-classes/debug-utility" ), BR;

	echo u\StringUtility::getMethodName( "structuredData" ), BR;

	u\DebugUtility::dump( u\StringUtility::getExplodedStringArray( ";", "this;0;that;3;these" ) );

	echo u\StringUtility::getFullyQualifiedIdentifierWithoutPositions( "this;0;that;3;these" ), BR;

	echo ( u\StringUtility::endsWith( "Hello", "lo" ) ? "yes" : "no" ), BR;
	
	echo ( u\StringUtility::endsWith( "Hello", "l" ) ? "yes" : "no" ), BR;
	
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_utility\StringUtility", true );
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