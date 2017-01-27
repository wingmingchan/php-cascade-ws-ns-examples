<?php 
/*
This program shows how to search for a string in script formats in a site.
To access the code of script formats, we have to call the method getScript.
The method call is passed into the global function as code. All paths of
scripts where the string is found are stored in the $results array.
*/
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = "_common_assets_wing";
    $params    = array();
    $params[ a\ScriptFormat::TYPE ][ "needle" ] = "processScript";
    $params[ a\ScriptFormat::TYPE ][ "method" ] = "getScript()";
    
    $results   = array();
    
    $cascade->getSite( $site_name )->getAssetTree()->
        traverse(
            array( 
                a\ScriptFormat::TYPE => array( "assetTreeSearchForNeedleInHaystack" ) ),
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