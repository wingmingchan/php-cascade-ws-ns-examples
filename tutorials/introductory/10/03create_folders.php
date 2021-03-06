<?php
require_once( 'auth_REST_SOAP.php' );
    
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name    = 'web-service-test';
    $group        =
        $cascade->getAsset( a\Group::TYPE, 'web-service-test-group' );
        
    // grant write access of Base Folder to group
    $cascade->grantAccess(
        $group,
        a\Folder::TYPE,   // the folder
        '/',              // base folder
        $site_name,       // site name of base folder
        true,             // applied to children
        c\T::WRITE        // level
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
            'Test Metadata Set Container/Folder', $site_name );
    
    foreach( $folder_names as $folder_name )
    {
        $folder = $cascade->
            createFolder(
                $base_folder, // parent folder
                $folder_name )->
            setMetadataSet( $ms )->
            setShouldBeIndexed( false )->   // all not indexable
            setShouldBePublished( false )-> // all not publishable
            edit(); // commit!!!
            
        // publishable folders
        if( $folder_name == 'images' || $folder_name == 'files' )
        {
            $folder->setShouldBePublished( true )->edit(); // commit!!!
        }
        
        // read access only to templates and formats
        if( $folder_name == 'templates' || $folder_name == 'formats' )
        {
            $cascade->grantAccess( 
                $group, a\Folder::TYPE, $folder_name, $site_name,
                true, c\T::READ );
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