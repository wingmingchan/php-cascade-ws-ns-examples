<?php
/*
This program shows how to search for a string in a page.
All text nodes are searched, and the result array stores
fully qualified identiers of nodes where the string is found. Example:

array(2) {
  [0]=>
  string(18) "main-content-title"
  [1]=>
  string(20) "main-content-content"
}
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
    $page = $cascade->
        getAsset( a\Page::TYPE, '9a8018248b7f0856011c5ec6f014d5a5' ); // lesson 6
    
    // search for a string
    $result = $page->searchText( "Format and Page" );
    
    if( isset( $result ) )
        u\DebugUtility::dump( $result );
    else
        echo "String not found" . BR;
        
                
    // search for another string
    $result = $page->searchText( "Format" );
    
    if( isset( $result ) )
        u\DebugUtility::dump( $result );
    else
        echo "String not found" . BR;
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