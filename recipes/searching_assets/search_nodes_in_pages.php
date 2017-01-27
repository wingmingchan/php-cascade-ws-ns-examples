<?php 
/*
This program shows how to search for a string in a specific node of pages
in a folder. The method call, with the node name as a part,
is passed into the global function as code. All paths of
pages where the string is found are stored in the $results array.
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
    $site_name = "cascade-admin";
    $params    = array();
    $params[ a\Page::TYPE ][ "needle" ] = "Format"; // string to search
    $params[ a\Page::TYPE ][ "method" ] = "getText('main-content-title')";
    
    $results   = array();
    
    $cascade->getAsset(
            a\Folder::TYPE, "/web-services/courses", $site_name
        )->getAssetTree()->traverse(
            array( 
                a\Page::TYPE => array( "assetTreeSearchForNeedleInHaystack" ) ),
            $params,
            $results
        );
    
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