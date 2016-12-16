<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

//$mode = 'all';
$mode = 'display';
//$mode = 'dump';
$mode = 'get';
$mode = 'set';
//$mode = 'raw';

try
{
    $g  = $cascade->getAsset( a\Group::TYPE, "hrintra" );
    //$g->addUser( $cascade->getAsset( a\User::TYPE, 'chanw' ) )->edit()->dump();
    //$g->addUserName( 'chanw' )->edit()->dump();
    //$g->removeUserName( 'chanw' )->edit()->dump();
    //$g->removeUser( $cascade->getAsset( a\User::TYPE, 'chanw' ) )->edit()->dump();

    switch( $mode )
    {
        case 'all':
        case 'display':
            $g->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $g->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo u\StringUtility::getCoalescedString( $g->getCssClasses() ), BR;
            echo u\StringUtility::getCoalescedString(
                $g->getGroupAssetFactoryContainerId() ), BR;
            echo u\StringUtility::getCoalescedString(
                $g->getGroupAssetFactoryContainerPath() ), BR;
            echo u\StringUtility::getCoalescedString( $g->getGroupBaseFolderId() ), BR;
            echo u\StringUtility::getCoalescedString( $g->getGroupBaseFolderPath() ), BR;
            echo u\StringUtility::boolToString( $g->getGroupBaseFolderRecycled() ), BR;
            
            echo $g->getGroupName(), BR;
            echo u\StringUtility::getCoalescedString( $g->getGroupStartingPageId() ), BR;
            echo u\StringUtility::getCoalescedString(
                $g->getGroupStartingPagePath() ), BR;
            echo u\StringUtility::boolToString( $g->getGroupStartingPageRecycled() ), BR;
            echo $g->getId(), BR;
            echo $g->getName(), BR;
            echo $g->getRole(), BR;
            echo $g->getUsers(), BR;
            
            echo u\StringUtility::boolToString( $g->getWysiwygAllowFontAssignment() ), BR;
            echo u\StringUtility::boolToString( $g->getWysiwygAllowFontFormatting() ), BR;
            echo u\StringUtility::boolToString( $g->getWysiwygAllowImageInsertion() ), BR;
            echo u\StringUtility::boolToString( $g->getWysiwygAllowTableInsertion() ), BR;
            echo u\StringUtility::boolToString( $g->getWysiwygAllowTextFormatting() ), BR;
            echo u\StringUtility::boolToString( $g->getWysiwygAllowViewSource() ), BR;
           
            echo u\StringUtility::boolToString(
                $g->hasUser( $cascade->getAsset( a\User::TYPE, 'chanw' ) ) ), BR;
            echo u\StringUtility::boolToString( $g->hasUserName( 'chanw' ) ), BR;

            if( $mode != 'all' )
                break;
        
        case 'set':
            $g->
                //addUser( User::getAsset( $service, 'chanw-test' ) )->
                //removeUser( User::getAsset( $service, 'chanw-test' ) )->
                setWysiwygAllowFontAssignment( false )->            
                setWysiwygAllowFontFormatting( false )->            
                setWysiwygAllowImageInsertion( true )->            
                setWysiwygAllowTableInsertion( true )->            
                setWysiwygAllowTextFormatting( false )->            
                setWysiwygAllowViewSource( true )->            
                edit()->dump();

            if( $mode != 'all' )
                break;
        
        case 'raw':
            $g_std = $service->retrieve( $service->createId( 
                c\T::GROUP, $id ), c\P::GROUP );
                
            u\DebugUtility::dump( $g_std );
       
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Group" );
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