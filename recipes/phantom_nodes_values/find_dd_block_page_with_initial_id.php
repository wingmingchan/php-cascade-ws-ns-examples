<?php
/*
When a phantom node is encountered, normally the execution of a program will terminate
with a message, saying that a certain field name does not exist. The message only gives
the initial part of the id string of the block or page. To be able to locate the asset, we need
to have the complete id string. Use this program to find the id of that block or page.

Example:
#5 /global/data/webfs/php_include/cascade_ws_ns/property_classes/Child.class.php(62): 
cascade_ws_asset\Asset::getAsset(Object(cascade_ws_AOHS\AssetOperationHandlerService), 'block_XHTML_DAT...', '832e853a8b7f08e...')

Copy the partial id string and paste it as the value of $initial_id. Note that besides the partial id,
the site name is also required. Once the full id is found, paste it into the URL field and hand-edit 
the block or page to fix the problem.
*/
require_once( 'cascade_ws_ns/auth_chanw.php' );
require_once( '/webfs/www/nosync/cascade/admin_functions_rwd.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $initial_id  = "344fe2498b7f085";
    $site_name   = "cascade-admin";
    
    $cascade->getAsset( a\Site::TYPE, $site_name )->getBaseFolderAssetTree()->
        traverse( 
            array( a\DataBlock::TYPE  => array( "assetTreeFindDDBlockPageWithIntialId" ),
                   a\Page::TYPE       => array( "assetTreeFindDDBlockPageWithIntialId" ) ),
            array( "partial-id" => $initial_id ) );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}

function assetTreeFindDDBlockPageWithIntialId( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    if( !isset( $params[ 'partial-id' ] ) )
        throw new \Exception( "The id is not included" );
    
    $partial_id = $params[ 'partial-id' ];
    
    $type = $child->getType();
    
    if( $type != a\DataBlock::TYPE && $type != a\Page::TYPE )
        return;
        
    $id = $child->getId();
    
    if( !u\StringUtility::startsWith( $id, $partial_id ) )
    {
        return;
    }
    else
    {
        echo $id;
    }
}
?>