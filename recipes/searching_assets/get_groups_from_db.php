<?php
/*
This program shows how to publish an XML page containing PHP code,
instantiating an array named $groups which stores all group names,
which are drawn from the Cascade database.
Here is the Velocity code used in the format attached to the XML page:

#import( 'site://_common_assets/formats/library/velocity/chanw_library_import' )
#import( 'site://_common_assets/formats/library/velocity/upstate_database' )

$globalStringBuffer.setLength( 0 )
#set( $void   = $globalStringBuffer.append( "$groups=array(" ) )

#foreach( $group in $upstateGroupName )
    #set( $void = $globalStringBuffer.append( '"' ).append( $group ).append( '",' ) )
#end

#set( $void = $globalStringBuffer.append( ");" ) )
$globalStringBuffer.toString()
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $service->publish(
    	$service->createId( a\Page::TYPE, "dc38a61f8b7f08ee730dda355f92f4ce" ) );
    sleep( 5 );
    $content = file_get_contents(
        "http://www.upstate.edu/cascade-admin/intra/xml/group_php.xml" );
    $content = str_replace( "<system-region name=\"DEFAULT\">", "" , $content );
    $content = str_replace( "</system-region>", "" , $content );
    $content = trim( $content );
    eval( $content );
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