<?php
/*
This program is used to find pages with blocks attached to
a specific block chooser.
*/
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time = time();

try
{
    u\DebugUtility::setTimeSpaceLimits();
    $results = array();
    
    $site_ids = $admin->getSites();
    
    foreach( $site_ids as $site_id )
    {
        $site_name = $site_id->getPathPath();
        $results[ $site_name ] = array();
        
        $site_id->getAsset( $service )->
        //$admin->getSite( $site_name )->
            getBaseFolderAssetTree()->
            traverse( 
                array( a\Page::TYPE => array( "assetTreeReportPagesWithPageLevelOverride" ) ), 
                NULL, 
                $results[ $site_name ] );
    }
    
    u\DebugUtility::dump( $results );
    
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

function assetTreeReportPagesWithPageLevelOverride(
    aohs\AssetOperationHandlerService $service,
    p\Child $child, array $params=NULL, array &$results=NULL )
{
    // skip irrelevant children
    $type  = $child->getType();
    
    if( $type != a\Page::TYPE && $type != a\DataDefinitionBlock::TYPE )
    {
        return;
    }

    try
    {
        $page = $child->getAsset( $service );
        
        if( !is_null( $page->getBlock( "admin-group;page-level-override" ) ) )
        {
            $results[] = $child->getPathPath();
        }
    }
    // xhtml pages
    catch( e\WrongPageTypeException $e )
    {
        return;
    }
    // drafts
    catch( e\NullAssetException $e )
    {
        return;
    }
}
?>