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
    $start_time = time();
    $site_name          = "standard-model";
    $format_name        = "db";
    $format_parent_path = "_cascade/blocks/format";
    $format_parent      = $admin->getAsset(
        a\Folder::TYPE, $format_parent_path, $site_name );
    $page_name          = "db_php_code";
    $page_parent_path   = "source";
    $page_parent        = $admin->getAsset(
        a\Folder::TYPE, $page_parent_path, $site_name );
    
    // create the format
    $format = $admin->createFormat( $format_parent, $format_name, a\ScriptFormat::TYPE,
        "##" );
    $ct = $admin->getAsset( a\ContentType::TYPE, 'dcbe90de8b7f08ee67410e21acf39749' );
    // create the page and attach the format to the page
    $page   = $admin->createXhtmlPage( $page_parent, $page_name, "", $ct )->
        setRegionFormat( 'XML' , 'DEFAULT', $format )->edit();
    
    // add DB code to the format
    $script = "<code>
#import( 'site://_brisk/core/library/velocity/chanw/chanw-database-utilities' )
#if( !\$chanwConnection || \$chanwConnection.isClosed() )
    #chanwGetDatabaseStatement
#end
#set( \$sql = 'select distinct id, name from cxml_site order by name ' )
#chanwGetResultSet( \$sql )
#chanwGetRecordListFromResultSet( \$chanwGetResultSet )
#set( \$void = \$globalStringBuffer.append( '\$view=array(' ) )
#foreach( \$siteIdName in \$chanwGetRecordListFromResultSet )
#set( \$siteId = \$siteIdName[ 0 ] )
#set( \$siteName = \$siteIdName[ 1 ] )
#set( \$sql = \"select count( distinct id ) from cxml_foldercontent where siteid='\$siteId' and assettype='PAG' and isrecycled=0 and iscurrentversion=1\" )
#chanwGetResultSet( \$sql )
#chanwGetRecordListFromResultSet( \$chanwGetResultSet )
#set( \$void = \$globalStringBuffer.append( \"'\$siteName'=>\$chanwGetRecordListFromResultSet[ 0 ][ 0 ],\" ) )
#end
#set( \$void = \$globalStringBuffer.append( \");\" ) )
\$globalStringBuffer.toString()
#chanwCleanUp
</code>";
    $format->setScript( $script )->edit();
    // wait for format to be edited
    sleep( 2 );
    // publish the page and wait
    $page->publish();
    sleep( 5 );
    // read the published page and get the published PHP code
    $url = "http://www.upstate.edu/$site_name/$page_parent_path/$page_name.xml";
    $content = str_replace( '<code>', '', file_get_contents( $url ) );
    $content = str_replace( '</code>', '', $content );
    $content = str_replace( '&gt;', '>', $content );
    // evaluate the code and get the array
    eval( $content );
    // output the array
    u\DebugUtility::dump( $view );
    u\DebugUtility::outputDuration( $start_time );
    
    // clean up
    // unpublish the page
    // delete the page
    // delete the format
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