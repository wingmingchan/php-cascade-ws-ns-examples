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
    $at = $cascade->getFolder( "39d4cc568b7ffe834c5fe91ecdc40728" )->
        getAssetTree();
        
    if( $at->hasChildren() )
        echo "The tree has children", BR;
        
    //echo $at->toListString();
    
    //echo S_PRE, u\XmlUtility::replaceBrackets( $at->toXml() ), E_PRE;
    
    $results = array();
    
    $at->traverse(
        array( a\Page::TYPE => array( "assetTreeCount" ) ),
        NULL,
        $results
    );
    
    u\DebugUtility::dump( $results );
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\AssetTree" );
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