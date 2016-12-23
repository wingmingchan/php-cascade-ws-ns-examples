<?php 
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // read the list
    $url      = "cascade_table_names.xml";
    $contents = file_get_contents( $url );
    $contents = str_replace( "<data>", "", $contents );
    $contents = str_replace( "</data>", "", $contents );
    $contents = str_replace( "[", "", $contents );
    $contents = str_replace( "]", "", $contents );
    $contents = str_replace( " ", "", $contents );
    $contents = strtolower( $contents );
    
    // get table names
    $table_names = u\StringUtility::getExplodedStringArray( ",", $contents );
    
    //u\DebugUtility::dump( $table_names );
    
    // "cxml_aclentry"
    $page   = $cascade->getAsset( a\Page::TYPE, "282f633b8b7f08ee1870341e57b47237" );
    $folder = $cascade->getAsset( a\Folder::TYPE, "280853688b7f08ee1870341e0a783d3c" );
    
    foreach( $table_names as $table_name )
    {
        // the first page exists already
        if( $table_name == "cxml_aclentry" )
            continue;
            
        // create a page for each table
        $new_page = $page->copy( $folder, $table_name );
        //$new_page = $cascade->getPage( $table_name, "cascade-database" );
        
        if( !is_null( $new_page ) )
            $new_page->getMetadata()->setTitle( $table_name )->
                setDisplayName( $table_name )->getHostAsset()->
                setText( "main-content-title", $table_name )->
                edit();
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