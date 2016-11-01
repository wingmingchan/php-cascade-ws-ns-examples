<?php
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    /*
    A map mapping site names to group names. It assumes that a site is mapped onto 
    a single group. Possible to have a site name mapped onto an array of group names.
    
    $site_group_map = array(
        "medicine" => "medicine",
    );
    */
    
    /*
    An array for names to be processed.
    Or create an array for sites to be skipped.
    */
    $site_to_processed = array(
        "medicine"
    );

    $sites = $cascade->getSites();
    
    foreach( $sites as $site )
    {
        // or not in an array
        if( in_array( $site->getPathPath(), $site_to_processed ) )
        {
            // process the site
            
            // first, get the group; replace $site->getPathPath() with a group name
            $group = $cascade->getAsset( a\Group::TYPE, $site->getPathPath() );
            
            // second, create the asset tree and parameters
            $at = $cascade->getSite( 
                $site->getPathPath() )->getRootAssetFactoryContainerAssetTree();
            
            $params = array();
            // if there are more than one group, then pass in an array instead
            $params[ "group" ] = $group;
            
            // traverse the tree in every site
            $at->traverse(
                array( a\AssetFactory::TYPE => 
                    array( "assetTreeAssignGroupToAssetFactory" ) ),
                $params
            );
        }
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}

function assetTreeAssignGroupToAssetFactory( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    // get the child type
    $type = $child->getType();
    
    // get out if not asset factory
    if( $type != a\AssetFactory::TYPE )
        return;

    // the group must be supplied
    if( !is_array( $params ) || !isset( $params[ 'group' ] ) )
        throw new e\NullAssetException( 
            S_SPAN . "The group must be supplied" . E_SPAN );
            
    // retrieve the group; this can in fact be an array
    // if so, loop through each group
    $group = $params[ 'group' ];
    
    // associate group with asset factory
    //$child->getAsset( $service )->addGroup( $group )->edit();
    
    // for the moment, just output some info
    echo $child->getAsset( $service )->getName(), BR;
    echo $group->getName(), BR;       
}
?>