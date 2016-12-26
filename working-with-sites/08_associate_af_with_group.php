<?php
$start_time = time();
/*
This program shows how to traverse a container,
and possibly modify its contents.
It can be used as a frame to house useful code.
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

u\DebugUtility::setTimeSpaceLimits();

try
{
    $site_name = "cascade-database";
    $site = $cascade->getSite( $site_name );
    $group = $cascade->getAsset( a\Group::TYPE, "cru" );
    
    $site->getRootAssetFactoryContainerAssetTree()->
        traverse(
            array(
                // associate asset factories with method
                a\AssetFactory::TYPE => 
                    array( "assetTreeAssociateAssetFactoryWithGroups" ) ),
            // the parameters passed into the method
            // there can be more than one group passed in
            array( "groups" => array( $group ) )
        );
        
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}

function assetTreeAssociateAssetFactoryWithGroups(
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    // get the type
    $type = $child->getType();
    
    // skip if not an asset factory
    if( $type != a\AssetFactory::TYPE )
        return;
        
    // check if there are groups passed in
    if( is_null( $params ) ||
        !is_array( $params ) ||
        !isset( $params[ "groups" ] ) ||
        !is_array( $params[ "groups" ] ) )
    {
    	throw new Exception( "An array of groups must be passed in." );
    }
    
    // get the groups
    $groups = $params[ "groups" ];
        
    // get the asset factory
    $at = $child->getAsset( $service );
    
    foreach( $groups as $group )
    {
        // add the groups to the asset factory
    	$at->addGroup( $group );
    	// or remove the group
    	//$at->removeGroup( $group );
    }
    
    // commit the changes
    $at->edit();
}
?>