<?php
/*
This program is used to fill in the mandatory page title and h1.
Note that the method call $page->getText fails
if the page is absolutely blank. When a page contains
no contents at all, the structured data object is also
blank. My library will treat such a page as an XHTML page,
not a page associated with a data definition. Manually fill in
some data so that the structured data becomes visible.
*/
$start_time = time();

require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

u\DebugUtility::setTimeSpaceLimits();

try
{
    $site_name = "hrintra";
    $at = $cascade->getSite( $site_name )->getAssetTree();

    $at->traverse(
        array( a\Page::TYPE => array( "assetTreeSetPageDisplayName" ) )
    );
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Error $er )
{
	echo S_PRE . $er . E_PRE; 
    u\DebugUtility::outputDuration( $start_time );
}

function assetTreeSetPageDisplayName(
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, array $params=NULL, array &$results=NULL
)
{
    $type = $child->getType();
    
    if( $type != a\Page::TYPE )
        return;
        
    $default_title = "THIS PAGE NEEDS A TITLE";
    
    $page = $child->getAsset( $service );
        
    $page_md    = $page->getMetadata();
    $page_title = $page_md->getTitle();
    $page_h1    = $page->getText( "main-content-title" );
    
    if( $page_title == "" || $page_h1 == "" )
    {
        if( $page_title == "" )
            $page_md->setTitle( $default_title );
            
        if( $page_h1 == "" )
            $page->setText( "main-content-title", $default_title );
            
        $page->edit();
    }
}
?>