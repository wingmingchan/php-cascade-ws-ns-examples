<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
/*
    $page = $cascade->
        getAsset( a\Page::TYPE, '9a8018248b7f0856011c5ec6f014d5a5' ); // lesson 6
    
    // search for a string
    $result = $page->searchText( "Format and Page" );
    
    if( isset( $result ) )
        u\DebugUtility::dump( $result ); // "main-content-title"
    else
        echo "String not found" . BR;
        
                
    // search for another string
    $result = $page->searchText( "Format" );
    
    if( isset( $result ) )
        u\DebugUtility::dump( $result ); // "main-content-title", "main-content-content"
    else
        echo "String not found" . BR;
*/

    // search for "Format" in all pages in a folder
    $needle  = "Format";
    $results = array();
    
    // get the folder
    $folder = $cascade->getAsset( 
        a\Folder::TYPE, '656b0f818b7f0856013130df77dce712' );
    // get children
    $children = $folder->getChildren();
    
    foreach( $children as $child )
    {
        if( $child->getType() == a\Page::TYPE )
        {
            $page = $child->getAsset( $service );
            $ids  = $page->searchText( $needle );
            
            if( isset( $ids ) && count( $ids ) > 0 )
                $results[] = $child->getPathPath();
        }
    }
        
    u\DebugUtility::dump( $results );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>