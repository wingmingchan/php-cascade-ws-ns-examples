<?php
/*
This file contains admin functions used by other programs.
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

function setSitePermissions( a\Cascade $cascade, string $new_name )
{
    // set group abilities
    $new_group = $cascade->getAsset( a\Group::TYPE, $new_name );
    $new_group->
        setWysiwygAllowFontFormatting( true )->
        setWysiwygAllowTextFormatting( true )->
        setWysiwygAllowImageInsertion( true )->
        setWysiwygAllowTableInsertion( true )->
        setWysiwygAllowFontAssignment( false )->
        setWysiwygAllowViewSource( false )->edit();
    
    // the web team designers
    $cwt = "CWT-Designers";

    $applied_to_children     = true;
    $not_applied_to_children = false;
    $cascade_path            = "/_cascade";

    $cascade_blocks_path         = $cascade_path . "/blocks";
    $cascade_blocks_data_path    = $cascade_blocks_path . "/data";
    $cascade_blocks_upstate_path = $cascade_blocks_path . "/upstate";

    $extra_path = "/_extra";
    $links_path = "/_links";

    $right_column_path             = "/_right-column";
    $footer_contact_path           = "/_footer-contact";
    $site_info_path                = "/_site-info";
    $asset_factory_container_path  = "/Upstate";
    $htaccess_path                 = "/tmp.htaccess";
    
    setAccessRightsForAssetForAllLevel( $cascade, 
        a\Folder::TYPE, c\T::ROOT_PATH, $new_name, c\T::READ, $applied_to_children );

    // step 1: Base Folder
    // cwt: write
    setAccessRightsForAsset(
        $cascade, a\Folder::TYPE, c\T::ROOT_PATH, $new_name,
        a\Group::TYPE, $cwt, c\T::WRITE, $applied_to_children );
    // new group: write
    setAccessRightsForAsset(
        $cascade, a\Folder::TYPE, c\T::ROOT_PATH, $new_name,
        a\Group::TYPE, $new_name, c\T::WRITE, $applied_to_children, c\T::READ );
        
    // step 2: _cascade and sub-folders
    // cwt: write
    setAccessRightsForAsset(
        $cascade, a\Folder::TYPE, $cascade_path, $new_name,
        a\Group::TYPE, $cwt, c\T::WRITE, $applied_to_children );
    // new group: read, all: read    
    setAccessRightsForAsset(
        $cascade, a\Folder::TYPE, $cascade_path, $new_name,
        a\Group::TYPE, $new_name, c\T::READ, $applied_to_children, c\T::READ );
        
    // the blocks folder
    // all: none
    setAccessRightsForAssetForAllLevel( 
        $cascade, a\Folder::TYPE, $cascade_blocks_path, $new_name, c\T::NONE, $applied_to_children );
    // the data folder
    // cwt: write
    setAccessRightsForAsset( 
        $cascade, a\Folder::TYPE, $cascade_blocks_data_path, $new_name,
        a\Group::TYPE, $cwt, c\T::WRITE, $applied_to_children );
    // new group: read
    setAccessRightsForAsset( 
        $cascade, a\Folder::TYPE, $cascade_blocks_data_path, $new_name,
        a\Group::TYPE, $new_name, c\T::READ, $applied_to_children );
    
    // step 3: 
    // _extra
    // no groups can access _extra
    removeAccessRightsFromAllGroupsForAsset( $cascade, a\Folder::TYPE, $extra_path, $new_name, $applied_to_children );
    // _links
    // cwt: write, new group: read, all: none
    setAccessRightsForAsset( 
        $cascade, a\Folder::TYPE, $links_path, $new_name,
        a\Group::TYPE, $cwt, c\T::WRITE, $applied_to_children );
    setAccessRightsForAsset( 
        $cascade, a\Folder::TYPE, $links_path, $new_name,
        a\Group::TYPE, $new_name, c\T::READ, $applied_to_children, c\T::NONE );

    // step 4: 3 configuration blocks
    // new group: read, all: none
    setAccessRightsForAsset( 
        $cascade, a\DataBlock::TYPE, $right_column_path, $new_name, 
        a\Group::TYPE, $new_name, c\T::READ, $not_applied_to_children, c\T::NONE );
        
    setAccessRightsForAsset( 
        $cascade, a\DataBlock::TYPE, $footer_contact_path, $new_name,
        a\Group::TYPE, $new_name, c\T::READ, $not_applied_to_children, c\T::NONE );
        
    setAccessRightsForAsset( 
        $cascade, a\DataBlock::TYPE, $site_info_path, $new_name,
        a\Group::TYPE, $new_name, c\T::READ, $not_applied_to_children, c\T::NONE );

    // step 5: Base Folder again
    // new group: read, all: read
    setAccessRightsForAsset( 
        $cascade, a\Folder::TYPE, c\T::ROOT_PATH, $new_name,
        a\Group::TYPE, $new_name, c\T::READ, $not_applied_to_children, c\T::READ );

    // step 6: asset factories
    setAvailableToGroupsForAssetFactoryContainer( $cascade, $new_name );
    
    // step 7: tmp.htaccess
    $file = $cascade->getFile( $htaccess_path, $new_name );
    
    if( $file != NULL )
    {
        $ari = $cascade->getAccessRights( a\File::TYPE, $htaccess_path, $new_name );
        $ari->addGroupReadAccess( a\Asset::getAsset( $cascade->getService(), a\Group::TYPE, $cwt ) );
        $ari->addGroupReadAccess( a\Asset::getAsset( $cascade->getService(), a\Group::TYPE, $new_name ) );
        $ari->setAllLevel( c\T::NONE );
        $cascade->setAccessRights( $ari, $not_applied_to_children ); 
    }
}

function setAccessRightsForAsset( 
    a\Cascade $cascade, 
    string $type, string $path, string $site_name,
    string $access_type, string $access_name, string $access_level, 
    bool $applied_to_children, string $all_level=NULL ) 
{
    $ari = $cascade->getAccessRights( $type, $path, $site_name );
    $group_user = $cascade->getAsset( $access_type, $access_name );
    $ari->setAccessRights( $group_user, $access_level );
    
    if( isset( $all_level ) )
        $ari->setAllLevel( $all_level );
        
    $cascade->setAccessRights( $ari, $applied_to_children );
}

function removeAccessRightsFromAllGroupsForAsset(
    a\Cascade $cascade,
    string $type, string $path, string $site_name,
    bool $applied_to_children )
{
    $ari = $cascade->getAccessRights( $type, $path, $site_name );
    $ari->denyAccessToAllGroups()->setAllLevel( c\T::NONE );
    $cascade->setAccessRights( $ari, $applied_to_children );
}

function setAccessRightsForAssetForAllLevel( 
    a\Cascade $cascade, string $type, string $path, string $site_name, 
    string $all_level, bool $applied_to_children )
{
    $ari = $cascade->getAccessRights( $type, $path, $site_name );
    $ari->setAllLevel( $all_level );
    $cascade->setAccessRights( $ari, $applied_to_children );
}

function setAvailableToGroupsForAssetFactoryContainer(
    a\Cascade $cascade, string $site_name, string $group_name='' )
{
    // retrieve CWT-Designers
    $cwt = $cascade->getAsset( a\Group::TYPE, "CWT-Designers" );
    
    // the new asset factory container
    $afc_paths = array( "Create", "Upload" );
    
    foreach( $afc_paths as $afc_path )
    {
        $afc = $cascade->getAsset( a\AssetFactoryContainer::TYPE, $afc_path, $site_name );

        // fix the group name
        if( $group_name == '' )
        {
            $group_name = $site_name;
        }
    
        // add group to container
        $group = $cascade->getAsset( a\Group::TYPE, $group_name );
        $afc->addGroup( $cwt )->addGroup( $group )->edit();

        // get all asset factories
        $af_children = $afc->getChildren();
    
        // add group to each asset factory
        foreach( $af_children as $child )
        {
            // get asset factory
            $af = $child->getAsset( $cascade->getService() );
            $af->addGroup( $cwt )->addGroup( $group )->edit();
        }
    }
}

function createDestinationForSites(
    a\Cascade $cascade, string $site_name, string $group_name='' )
{
    // normally site and group are assigned the same name
    if( $group_name == '' )
    {
        $group_name = $site_name;
    }
    
    $web_transport = $cascade->getAsset( a\FtpTransport::TYPE, '57abc6cd8b7f0856006702a06dafeb80' );
    $www_transport = $cascade->getAsset( a\FtpTransport::TYPE, '6e0d1f298b7f0856015997e48a8179fc' );
    
    $destination_parent = 
        $cascade->getAsset( a\SiteDestinationContainer::TYPE, '/', $site_name );
    $group = $cascade->getAsset( a\Group::TYPE, $group_name );
    $cwt   = $cascade->getAsset( a\Group::TYPE, "CWT-Designers" );
        
    $web_destination = $cascade->getDestination( a\Destination::TYPE, $site_name . '-web', $site_name );
    
    if( $web_destination == NULL )
    {
        // create destination
        $destination = $cascade->createDestination(
            $destination_parent,
            $site_name . '-web',
            $web_transport
        )->
        setDirectory( $site_name )->
        setWebUrl( "http://web.upstate.edu/" . $site_name )->
        setCheckedByDefault( true )->
        enable()->
        addGroup( $group )->
        addGroup( $cwt )->
        edit();
    }
    
    $www_destination = $cascade->getDestination( a\Destination::TYPE, $site_name . '-www', $site_name );
    
    if( $www_destination == NULL )
    {
        // create destination
        $destination = $cascade->createDestination(
            $destination_parent,
            $site_name . '-www',
            $www_transport
        )->
        setDirectory( $site_name )->
        setWebUrl( "http://www.upstate.edu/" . $site_name )->
        disable()->
        addGroup( $group )->
        addGroup( $cwt )->
        edit();
    }
}
?>