<?php 
require_once('cascade_ws_ns/auth_sandbox.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name  = 'web-service-tutorial';
    $group_name = 'web-service-tutorial-group';
    $ms_container_name = 'Test Metadata Set Container';
    $folder_ms_name    = 'Folder';
    $page_ms_name      = 'Page';
    $group             = $cascade->getAsset( a\Group::TYPE, $group_name );
    
    // grant write access of Base Folder to group
    $cascade->grantAccess( 
        a\Folder::TYPE, '/', $site_name, // the base folder
        true,                            // applied to children
        $group,
        c\T::WRITE
    );
    
    // create folders, set metadata set, and access rights
    $folder_names = array(
        'templates', 'blocks', 'formats', 'images', 'files'
    );
    $base_folder  = 
        $cascade->getAsset( a\Site::TYPE, $site_name )->getBaseFolder();
    $ms           =
        $cascade->getAsset( 
            a\MetadataSet::TYPE, 
            $ms_container_name . '/' . $folder_ms_name, $site_name );

    foreach( $folder_names as $folder_name )
    {
        $folder = $cascade->getFolder( $folder_name, $site_name );
        
        if( is_null( $folder ) )
        {
            $folder = $cascade->
                createFolder(
                    $base_folder, // parent folder
                    $folder_name )->
                setMetadataSet( $ms )->
                setShouldBeIndexed( false )->   // all not indexable
                setShouldBePublished( false )-> // all not publishable
                edit(); // commit!!!
        }
    
        // publishable folders
        if( $folder_name == 'images' || $folder_name == 'files' )
        {
            $folder->setShouldBePublished( true )->edit(); // commit!!!
        }

        // read access only to templates and formats
        if( $folder_name == 'templates' || $folder_name == 'formats' )
        {
            $cascade->grantAccess( 
                a\Folder::TYPE, $folder_name, $site_name, // the folder
                true, $group, c\T::READ );
        }
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>