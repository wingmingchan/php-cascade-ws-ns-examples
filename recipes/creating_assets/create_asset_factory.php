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
    $site_name         = 'web-service-tutorial';
    $group_name        = 'web-service-tutorial-group';
    $af_container_name = 'Site Managers';
    $af_container      = $cascade->getAssetFactoryContainer( $af_container_name, $site_name );

    if( is_null( $af_container ) )
    {
        // create asset factory container
        $af_container = $cascade->createAssetFactoryContainer(
            $cascade->getAsset( 
                a\AssetFactoryContainer::TYPE, '/', $site_name ),
            $af_container_name
        );
    }
    
    $group = $cascade->getAsset( a\Group::TYPE, $group_name );
    
    // grant access to container
    $ari = $cascade->getAccessRights( 
        a\AssetFactoryContainer::TYPE, $af_container_name, $site_name );
    $ari->addGroupReadAccess( $group );     // read access
    $cascade->setAccessRights( $ari );
    
    $ba_folder_name = '_base-assets';
    $ba_folder      = $cascade->getFolder( $ba_folder_name, $site_name );
    
    if( is_null( $ba_folder ) )
    {
        $base_folder = 
            $cascade->getAsset( a\Site::TYPE, $site_name )->getBaseFolder();
        
        // create base assets folder
        $ba_folder = 
            $cascade->
                createFolder(
                    $base_folder, // parent folder
                    $ba_folder_name )->
                setShouldBeIndexed( false )->   // all not indexable
                setShouldBePublished( false )-> // all not publishable
                edit(); // commit!!!
    }

    $ba_page_name = 'new-page';
    $ba_page      = $cascade->getPage( $ba_folder_name . '/' . $ba_page_name, $site_name );
    
    if( is_null( $ba_page ) )
    {
        // create base page
        $ba_page = $cascade->getAsset( a\Page::TYPE, 'test', $site_name )->
            copy( $ba_folder, 'new-page' );
    }
    
    $af_name = 'New Page';
    $af      = $cascade->getAssetFactory( $af_container_name . '/' . $af_name, $site_name );
    
    if( is_null( $af ) )
    {
        // create asset factory
        $af =
            $cascade->
                createAssetFactory(
                    $af_container, // container
                    $af_name,      // name
                    a\Page::TYPE,  // asset type
                    c\T::NONE      // workflow mode
                )->
                setBaseAsset( $ba_page )->
                addGroup( $group )->
                edit();
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