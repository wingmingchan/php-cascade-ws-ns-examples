<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
$mode = 'get';
//$mode = 'set';
//$mode = 'raw';
//$mode = 'none';

try
{
    $id = 'wing';
    $u  = $cascade->getAsset( a\User::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $u->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $u->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "Username: " . $u->getUsername(), BR .
                 "Full name: " . u\StringUtility::getCoalescedString(
                     $u->getFullName() ), BR;
            echo $u->getAuthType(), BR;
            echo u\StringUtility::getCoalescedString( $u->getDefaultGroup() ), BR;
            echo u\StringUtility::getCoalescedString( $u->getDefaultSiteId() ), BR;
            echo u\StringUtility::getCoalescedString( $u->getDefaultSiteName() ), BR;
            echo u\StringUtility::boolToString( $u->getEnabled() ), BR;
            echo $u->getEmail(), BR;
            echo $u->getGroups(), BR;
            echo $u->getRole(), BR;
            echo $u->getPassword(), BR;
            echo u\StringUtility::boolToString( $u->isInGroup(
                $cascade->getAsset( a\Group::TYPE, "Administrators" )
            ) ), BR;
            
            //$u->joinGroup( $cascade->getAsset( a\Group::TYPE, "cru" ) );
            //$u->leaveGroup( $cascade->getAsset( a\Group::TYPE, "cru" ) );
            $u->setDefaultGroup( $cascade->getAsset( a\Group::TYPE, "cru" ) )->edit();
            $u->dump();

            if( $mode != 'all' )
                break;
        
        case 'set':
            $g = $cascade->getAsset( a\Group::TYPE, 'demo' );
            $u->
                setFullName( 'Wing Ming Chan' )->
                setPassword( '************' )->
                setEmail( 'chanw' )->
                disable()->
                enable()->
                setDefaultGroup( $g )->
                setDefaultSite( 
                    $cascade->getAsset(
                        a\Site::TYPE,
                        'ede8ade68b7f08560139425c36d7307f' ) )->
                edit();
            //$u->joinGroup( $g );

            if( $mode != 'all' )
                break;
        
        case 'raw':            
            $user_id = 'chanw-test';
            $user_std = $service->retrieve( 
                $service->createId( c\T::USER, $user_id ), c\P::USER );
/*
            $user_std->password = "chanw-test";
            $asset->user = $user_std;
            $service->edit( $asset );
            
            if( !$service->isSuccessful() )
            {
                echo $service->getMessage();
            }
*/            
            u\DebugUtility::dump( $user_std );
       
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\TwitterConnector" );
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