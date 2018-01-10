<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = "about-test";
    $site      = $cascade->getSite( $site_name );

    // clear all permissions
    $cascade->clearPermissions( a\Site::TYPE, $site_name, NULL, true );
    
    // get base folder
    $base_folder = $site->getBaseFolder();
    
    // grant write permission to user
    $user = $cascade->getAsset( a\User::TYPE, 'wing' );
    $cascade->grantAccess(
        $user,
        a\Folder::TYPE,
        $base_folder->getId(),
        NULL,  // site name
        true,  // applied to children
        c\T::WRITE
    );
    
    // grant write permission to group
    $group = $cascade->getAsset( a\Group::TYPE, 'test-ws-group' );
    $cascade->grantAccess(
        $group,
        a\Folder::TYPE,
        "/",
        $site_name,
        true,
        c\T::WRITE
    );

    // set all to read
    $cascade->setAllLevel( 
        a\Folder::TYPE,
        $base_folder->getId(),
        NULL,
        c\T::READ, 
        true  // applied to children
    );
    
    // set all to none for a specific folder
    $cascade->setAllLevel( 
        a\Folder::TYPE,
        '_cascade',
        $site_name,
        c\T::NONE, 
        true  // applied to children
    );    

    // grant read permission to the group for a specific folder
    $group = $cascade->getAsset( a\Group::TYPE, 'test-ws-group' );
    $cascade->grantAccess(
        $group,
        a\Folder::TYPE,
        "_cascade/formats",
        $site_name,
        true,
        c\T::READ
    );
   
    u\DebugUtility::dumpRESTCommands( $service );    
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