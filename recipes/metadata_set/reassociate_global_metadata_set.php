<?php
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $default_ms = $cascade->getAsset( 
        a\MetadataSet::TYPE, "ROOT_metadataset" );
    $asset_ids = $default_ms->getSubscribers();
    
    $asset_ms_map = array(
        a\DataBlock::TYPE => $cascade->getAsset( 
            a\MetadataSet::TYPE, "5f4526018b7f08ee76b12c413ab40518" ),
        a\TextBlock::TYPE => $cascade->getAsset( 
            a\MetadataSet::TYPE, "5f4526018b7f08ee76b12c413ab40518" ),
        a\FeedBlock::TYPE => $cascade->getAsset( 
            a\MetadataSet::TYPE, "5f4526018b7f08ee76b12c413ab40518" ),
        a\IndexBlock::TYPE => $cascade->getAsset( 
            a\MetadataSet::TYPE, "5f4526018b7f08ee76b12c413ab40518" ),
        a\XmlBlock::TYPE => $cascade->getAsset( 
            a\MetadataSet::TYPE, "5f4526018b7f08ee76b12c413ab40518" ),
        a\File::TYPE => $cascade->getAsset( 
            a\MetadataSet::TYPE, "5f4525fa8b7f08ee76b12c41f1334e21" ),
        a\Folder::TYPE => $cascade->getAsset( 
            a\MetadataSet::TYPE, "5f4526098b7f08ee76b12c412063f8b8" ),
        a\Symlink::TYPE => $cascade->getAsset( 
            a\MetadataSet::TYPE, "5f45261b8b7f08ee76b12c416580b064" )
    );
    
    $count = 0;
    
    foreach( $asset_ids as $asset_id )
    {
        // base folder of Global
        if( $asset_id->getId() == 'ROOT' )
            continue;
            
        $asset = $asset_id->getAsset( $service );
        $asset->setMetadataSet(
            $asset_ms_map[ $asset->getType() ] );
        $count++;
        
        // do 10 at a time
        if( $count == 10 )
        {
            break;
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
?>