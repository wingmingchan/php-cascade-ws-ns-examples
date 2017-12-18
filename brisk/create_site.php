<?php
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    require_once( "brisk_info.php" );
    u\DebugUtility::setTimeSpaceLimits();
    
    $www_upstate_url = "http://www.upstate.edu/";
    $web_upstate_url = "http://web.upstate.edu/";
    
    $cwt_designers = $cascade->getAsset( a\Group::TYPE, "CWT-Designers" );
    
    $site_name = "new_test";
    // by default, the directory name is the same, but it could be different
    $dir_name  = $site_name;
    $seed_name = "_brisk_rwd4_seed";

    // Site-Publisher
    $site_publisher_role = $cascade->getRole( 50 );
    
    // step 1: group
    // the new group and new site should have the same name
    $group = $cascade->getGroup( $site_name );
    
    // if the group does not exist, create it
    if( is_null( $group ) )
    {
        $group = $cascade->createGroup( $site_name, "Default" );
    }
    
    // step 2: site
    try
    {
        $site = $cascade->getSite( $site_name );
    }
    catch( e\NoSuchSiteException $e )
    {
        // if the site does not exist, create a copy of the seed site
        if( is_null( $site ) )
        {
            $seed_site = $cascade->getSite( $seed_name );
            $site      = $cascade->copySite( $seed_site, $site_name, 25 );
        }
    }
    
    // default metadata set
    if( $site->getDefaultMetadataSetId() != $brisk_default_ms_id )
    {
        $site->setDefaultMetadataSet( 
            $cascade->getAsset( a\MetadataSet::TYPE, $brisk_default_ms_id )
        );
    }
    // site settings
    $site->
        // recyble bin expiration
        setRecycleBinExpiration( a\Site::FIFTEEN )->
        // site role and group
        addGroupToRole( $site_publisher_role, $group )->
        // URL
        setUrl( $web_upstate_url . $dir_name )->
        edit();
        
    // step 3: destinations
    $destination_name = $site_name;
    
    if( strpos( $destination_name, "-dev" ) !== false )
    {
        $destination_name = substr( $destination_name, 0, 
            strlen( $destination_name ) - strlen( "-dev" ) );
    }
    
    $web_destination = $cascade->getDestination( "seed-web", $site_name );
    
    if( !is_null( $web_destination ) )
    {
        $cascade->renameAsset( $web_destination, $destination_name . "-web" );
        $web_destination->setDirectory( $dir_name )->
            addGroup( $cwt_designers )->addGroup( $group )->
            setWebUrl( $web_upstate_url . $dir_name )->
            setCheckedByDefault( true )->
            edit();
    }
        
    $www_destination = $cascade->getDestination( "seed-www", $site_name );

    if( !is_null( $www_destination ) )
    {    
        $cascade->renameAsset( $www_destination, $destination_name . "-www" );
        $www_destination->setDirectory( $dir_name )->
            addGroup( $cwt_designers )->addGroup( $group )->
            setWebUrl( $www_upstate_url . $dir_name )->
            setCheckedByDefault( false )->
            edit();
    }
        
    // step 4: site nav
    $internal_nav_feed_block = 
        $cascade->getFeedBlock( "_extra/internal-nav-feed", $site_name );
        
    if( !is_null( $internal_nav_feed_block ) )
    {
        $internal_nav_feed_block->setFeedURL(
            $web_upstate_url . $dir_name . "/_extra/internal-nav.php" )->edit();
    }
    else
    {
        echo "Site nav not set up properly", BR;
    }
    
    // step 5: access rights
    // entire site
    $base_folder_ari = $cascade->getAccessRights( a\Folder::TYPE, "/", $site_name );
    $base_folder_ari->addGroupWriteAccess( $cwt_designers );
    $base_folder_ari->addGroupWriteAccess( $group );
    $cascade->setAccessRights( $base_folder_ari, true );

    // code blocks
    $cascade_blocks_code_ari = $cascade->getAccessRights(
        a\Folder::TYPE, "_cascade/blocks/code", $site_name );
    $cascade_blocks_code_ari->addGroupReadAccess( $cwt_designers );
    $cascade_blocks_code_ari->addGroupReadAccess( $group );
    $cascade->setAccessRights( $cascade_blocks_code_ari, true );
    
    // _extra
    $cascade_extra_ari = $cascade->getAccessRights(
        a\Folder::TYPE, "_extra", $site_name );
    $cascade_extra_ari->addGroupWriteAccess( $cwt_designers );
    $cascade_extra_ari->addGroupReadAccess( $group );
    $cascade->setAccessRights( $cascade_extra_ari, true );
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