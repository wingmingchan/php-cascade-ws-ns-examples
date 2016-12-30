<?php
/*
This program shows how to grant access of folders to users and groups.
*/
require_once('auth_chanw.php');
    
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = 'cascade-admin-old';
    // get the site
    $site = $cascade->getSite( $site_name );
    
    // clear all permissions
    // clearPermissions( string $type, string $id_path, string $site_name = NULL, 
    // bool $applied_to_children = false )
    $cascade->clearPermissions( a\Site::TYPE, $site_name, NULL, true );
    
    // get base folder
    $base_folder = $site->getBaseFolder();
    $cascade->clearPermissions( a\Folder::TYPE, $base_folder->getId(), "", true );
    
    // grant write permission to user
    $user = $cascade->getAsset( a\User::TYPE, 'chanw' );
    // grantAccess( cascade_ws_asset\Asset $a, string $type, string $id_path, 
    // string $site_name = NULL, bool $applied_to_children = false, string $level = "read" )
    $cascade->grantAccess(
        $user,
        a\Folder::TYPE,
        $base_folder->getId(),
        NULL,  // site name
        true,  // applied to children
        c\T::WRITE
    );

    // grant write permission to group
    $group = $cascade->getAsset( a\Group::TYPE, 'CWT-Designers' );
    $cascade->grantAccess(
        $group,
        a\Folder::TYPE,
        $base_folder->getId(),
        NULL,
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
        '980d6c018b7f0856015997e4ef87e537',
        NULL,
        c\T::NONE, 
        true  // applied to children
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
?>