<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
$mode = 'dump';
$mode = 'get';
$mode = 'set';
//$mode = 'raw';
//$mode = "plugin";

try
{
    // with plugin, various # of params
    //$id = "e85799f78b7f08560139425cc23ede84";
    // no plugin
    //$id = "4332be908b7f085601aaf3b9ab389f68";
    // Test
    $id = "cdb841748b7f08560047808b2bbd015b"; 

    $af = a\AssetFactory::getAsset( $service, a\AssetFactory::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $af->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $af->dump( true );
            if( $mode != 'all' )
                break;

        case 'get':
            echo c\L::ID . $af->getId() . BR .
                 c\L::NAME . $af->getName() . BR .
                 c\L::PATH . $af->getPath() . BR .
                 c\L::PROPERTY_NAME . $af->getPropertyName() . BR .
                 c\L::SITE_NAME . $af->getSiteName() . BR .
                 c\L::TYPE . $af->getType() . BR .
                 
                 "Allow subfolder placement: " . 
                 $af->getAllowSubfolderPlacement() . BR .
                 "Applicable groups: " . 
                 $af->getApplicableGroups() . BR .
                 "Asset type: " . 
                 $af->getAssetType() . BR .
                 "Base asset ID: " . 
                 $af->getBaseAssetId() . BR .
                 "Base asset path: " . 
                 $af->getBaseAssetPath() . BR .
                 "Base asset recycled: " . 
                 $af->getBaseAssetRecycled() . BR .
                 "Folder placement position: " . 
                 $af->getFolderPlacementPosition() . BR .
                 "Overwrite: " . 
                 $af->getOverwrite() . BR .
                 c\L::PARENT_CONTAINER_ID . 
                 $af->getParentContainerId() . BR .
                 c\L::PARENT_CONTAINER_PATH . 
                 $af->getParentContainerPath() . BR .
                 "Placement folder ID: " . 
                 $af->getPlacementFolderId() . BR .
                 "Placement folder path: " . 
                 $af->getPlacementFolderPath() . BR .
                 "Placement folder recycled: " . 
                 $af->getPlacementFolderRecycled() . BR .
                 c\L::SITE_ID . 
                 $af->getSiteId() . BR .
                 c\L::SITE_NAME . 
                 $af->getSiteName() . BR .
                 "Workflow definition ID: " . 
                 $af->getWorkflowDefinitionId() . BR .
                 "Workflow definition path: " . 
                 $af->getWorkflowDefinitionPath() . BR .
                 "Workflow mode: " . 
                 $af->getWorkflowMode() . BR ;
                 
                 u\DebugUtility::dump( $af->getPluginNames() );
                 u\DebugUtility::dump( $af->getPluginStd() );
            
            if( $mode != 'all' )
                break;

        case 'set':
             $group_name = "cru";
             $group      = a\Asset::getAsset( $service, a\Group::TYPE, $group_name );
             $af->addGroup( $group )->edit();
             
             if( $af->isApplicableToGroup( $group ) )
             {
                 echo "Applicable to $group_name" . BR;
             }
             else
             {
                 echo "Not applicable to $group_name" . BR;
             }
             
             $af->removeGroup( $group )->edit()->dump( true );
             
             if( $af->isApplicableToGroup( $group ) )
             {
                 echo "Applicable to $group_name" . BR;
             }
             else
             {
                 echo "Not applicable to $group_name" . BR;
             }
             
             $af->setAllowSubfolderPlacement( true )->
                 setBaseAsset()->
                 setFolderPlacementPosition( 1 )->
                 setOverwrite( true )->
                 setPlacementFolder( $cascade->getFolder( "images", "cascade-admin" ) )->
                 setWorkflowMode( c\T::NONE )->
                 edit()->dump( true );
               
            if( $mode != 'all' )
                break;

        case 'plugin':
            $af->addPlugin( a\AssetFactory::CREATE_RESIZED_IMAGES_PLUGIN )->
                addPlugin( a\AssetFactory::FILE_LIMIT_PLUGIN )->
                dump( true );
        
            $af->setPluginParameterValue(
                    a\AssetFactory::CREATE_RESIZED_IMAGES_PLUGIN,
                    a\AssetFactory::CREATE_RESIZED_PARAM_WIDTH,
                    "foo" )->
                setPluginParameterValue(
                    a\AssetFactory::FILE_LIMIT_PLUGIN,
                    a\AssetFactory::FILE_LIMIT_PARAM_SIZE,
                    "13" )->
                dump( true );

            $af->removePlugin( a\AssetFactory::CREATE_RESIZED_IMAGES_PLUGIN )->dump( true );
            
            $af->addPlugin( a\AssetFactory::IMAGE_RESIZER_PLUGIN )->
                setPluginParameterValue(
                    a\AssetFactory::IMAGE_RESIZER_PLUGIN,
                    a\AssetFactory::IMAGE_RESIZER_PARAM_HEIGHT,
                    "45" )->
                setPluginParameterValue(
                    a\AssetFactory::IMAGE_RESIZER_PLUGIN,
                    a\AssetFactory::IMAGE_RESIZER_PARAM_WIDTH,
                    "80" )->
                dump( true );

            $af->removePlugin( a\AssetFactory::PAGE_NAME_CHARS_LIMIT_PLUGIN    )->dump( true );        
                
            $af->addPlugin( a\AssetFactory::STRUCTURED_DATA_FIELD_TO_SYSTEM_NAME_PLUGIN )->
                setPluginParameterValue(
                    a\AssetFactory::STRUCTURED_DATA_FIELD_TO_SYSTEM_NAME_PLUGIN,
                    a\AssetFactory::SD_FIELD_TO_SYSTEM_NAME_PARAM_FIELD_ID,
                    "those" )->
                dump( true );
                
            $af->removePluginParameter( 
                    a\AssetFactory::STRUCTURED_DATA_FIELD_TO_SYSTEM_NAME_PLUGIN,
                    a\AssetFactory::SD_FIELD_TO_SYSTEM_NAME_PARAM_FIELD_ID )->
                dump( true );
                        
            if( $mode != 'all' )
                break;
            
        case 'raw':
            $af = $service->retrieve( 
                $service->createId( 
                    c\T::ASSETFACTORY, $id ), c\P::ASSETFACTORY );
            
            echo S_PRE;
            u\DebugUtility::dump( $af );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>
