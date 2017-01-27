<?php
/*
This program shows how to search for a string in pages in a folder.
Only direct page children are searched. No recursion is involved.
All text nodes are searched, and the results array stores page paths
mapping to arrays of fully qualified identiers of nodes where
the string is found. Example:

array(5) {
  ["projects/web-services/courses/introductory-course/index"]=>
  array(1) {
    [0]=>
    string(20) "main-content-content"
  }
  ["projects/web-services/courses/introductory-course/introductory-lesson-1"]=>
  array(1) {
    [0]=>
    string(20) "main-content-content"
  }
  ["projects/web-services/courses/introductory-course/introductory-lesson-4"]=>
  array(1) {
    [0]=>
    string(20) "main-content-content"
  }
  ["projects/web-services/courses/introductory-course/introductory-lesson-6"]=>
  array(2) {
    [0]=>
    string(18) "main-content-title"
    [1]=>
    string(20) "main-content-content"
  }
  ["projects/web-services/courses/introductory-course/introductory-lesson-8"]=>
  array(1) {
    [0]=>
    string(20) "main-content-content"
  }
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
    // search for the string "Format" in all pages in a folder
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
            
            // store page paths as keys and array of FQI as values
            if( isset( $ids ) && count( $ids ) > 0 )
                $results[ $child->getPathPath() ] = $ids;
        }
    }
        
    u\DebugUtility::dump( $results );
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