<?php
/*
This program can be used to report paths of all pages in a site.
*/
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = "imtpublic";
    
    $cascade->getSite( $site_name )->
        getBaseFolderAssetTree()->
            traverse(
                array( a\Page::TYPE => array( "assetTreeReportPagePath" ) )
            );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE;
}

function assetTreeReportPagePath(
    aohs\AssetOperationHandlerService $service, p\Child $child, 
    $params=NULL, &$results=NULL
)
{
    $type = $child->getType();
    
    if( $type != a\Page::TYPE )
        return;
        
    echo $child->getPathPath(), BR;
}
?>