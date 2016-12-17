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
    $site_name   = "cascade-admin";
    $folder_path = "standard-model/source";
    
    // get the groups and users
    $team   = $cascade->getAsset(
        a\Group::TYPE, "Site-CWT-Designers" );
    $cru    = $cascade->getAsset( a\Group::TYPE, "cru" );
        
    $thomas = $cascade->getAsset( a\User::TYPE, "thomaspe" );
    $wing   = $cascade->getAsset( a\User::TYPE, "chanw" );
    
    
    
    // get the AccessRightsInformation object
    $ari = $cascade->getAccessRights(
        a\Folder::TYPE, $folder_path, $site_name );
        
    // display information
    $ari->display();
    u\DebugUtility::dump( $ari->getIdentifier() );
    u\DebugUtility::dump( $ari->getAclEntries() );
    echo $ari->getAllLevel(), BR;
    echo u\StringUtility::getCoalescedString(
        $ari->getGroupLevel( $cru ) ), BR;
    echo u\StringUtility::getCoalescedString(
        $ari->getUserLevel( $thomas ) ), BR;
    echo u\StringUtility::boolToString(
        $ari->hasGroup( $cru ) ), BR; 
    echo u\StringUtility::boolToString(
        $ari->hasUser( $thomas ) ), BR; 
        
        
    // clear all access rights
    // $ari->clearPermissions();
    
    // deny access to groups
    // $ari->denyAccessToAllGroups();
    
    // access rights assignments
    $ari->addUserWriteAccess( $wing );
    $ari->addUserReadAccess( $thomas );
    $ari->addGroupReadAccess( $team );
    // $ari->addGroupReadAccess( $cru );
    $ari->denyGroupAccess( $cru );
    
    // an alternative way of assignment
    $ari->setAccessRights( $cru, c\T::READ );
    
    $ari->setAllLevel( c\T::NONE );
    
    // commit all changes
    $cascade->setAccessRights( $ari, true );
    u\DebugUtility::dump( $ari );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}

/*
Useful code templates:
    u\ReflectionUtility::showMethodSignatures( 
        "cascade_ws_utility\ReflectionUtility" );
        
    u\ReflectionUtility::showMethodSignature( 
        "cascade_ws_asset\Page", "edit" );
        
    u\ReflectionUtility::showMethodDescription( 
        "cascade_ws_utility\ReflectionUtility", "getMethodInfoByName", true );
        
    u\ReflectionUtility::showMethodExample( 
        "cascade_ws_utility\ReflectionUtility", "getMethodInfoByName", true );
        
    u\DebugUtility::dump( $page );
    u\DebugUtility::out( "Hello" );
    
    $cascade->getAsset( a\Page::TYPE, "389b32a68b7ffe83164c931497b7bc24" )->dump( true );
*/
?>