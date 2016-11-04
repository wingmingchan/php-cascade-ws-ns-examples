<?php
/*
This program is used to change the URLs of all symlinks in all sites.
*/
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    /*
    // to process all sites
    $sites = $cascade->getSites();
    
    foreach( $sites as $site_id )
    {
        $site = $cascade->getSite( $site_id->getPathPath() );
    }
    */
    
    // process a single site
    $site = $cascade->getSite( "velocity-test" );
    $base_folder_asset_tree = $site->getBaseFolderAssetTree();

    /*
    // supply $params to map symlink names to URLs
    $params = array();
    $params[ 'symlink_map' ] = array(
        'google'  => 'http://www.google.com/',
        'nbcnews' => 'http://www.nbcnews.com/'
    );
    */

    $base_folder_asset_tree->traverse(
        array( a\Symlink::TYPE =>
            array( "assetTreeSetLinkURLForSymlink" ) ) //,
            // $params
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

function assetTreeSetLinkURLForSymlink(
    aohs\AssetOperationHandlerService $service,
    p\Child $child, array $params=NULL, array &$results=NULL )
{
    /*
    // if a map is not supplied, quit
    if( !isset( $param[ 'symlink_map' ] ) )
        throw new \Exception( "A symlink map is required" );
        
    // get the map
    $symlink_map = $param[ 'symlink_map' ];
    */
    
    // get the child type
    $type = $child->getType();
   
    // get out if not symlink
    if( $type != a\Symlink::TYPE )
        return;
   
    // get the symlink asset
    $symlink = $child->getAsset( $service );
    
    // get the url
    // $url = $symlink_map[ $symlink->getName() ];
    
    // do whatever you need to do with symlink
    $symlink->setLinkURL( "http://www.google.com/" )->edit();
    // $symlink->setLinkURL( $url )->edit();
}
?>