<?php
/*
This program shows how to grant access of folders to users and groups.
*/
require_once('cascade_ws_ns/auth_chanw.php');
    
use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
    $site_name = 'test1';
    // get the site
    $site = $cascade->getSite( $site_name );
    
    // clear all permissions
    $cascade->clearPermissions( a\Site::TYPE, $site_name, NULL, true );
    
    // get base folder
    $base_folder = $site->getBaseFolder();
    $cascade->clearPermissions( a\Folder::TYPE, $base_folder->getId(), NULL, true );
    
    // grant write permission to user
    $user = $cascade->getAsset( a\User::TYPE, 'chanw' );
    $cascade->grantAccess(
        a\Folder::TYPE,
        $base_folder->getId(),
        NULL,  // site name
        true,  // applied to children
        $user,
        c\T::WRITE
    );

    // grant write permission to group
    $group = $cascade->getAsset( a\Group::TYPE, 'CWT-Designers' );
    $cascade->grantAccess(
        a\Folder::TYPE,
        $base_folder->getId(),
        NULL,
        true,
        $group,
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
        '81b5dd038b7f085601c13fc4c315ff42',
        NULL,
        c\T::NONE, 
        true  // applied to children
    );
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>