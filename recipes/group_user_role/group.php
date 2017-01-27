<?php 
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $group_name = "CWT-Designers";
    $group = $cascade->getAsset( a\Group::TYPE, $group_name );
    
    // display all users in group
    echo $group->getUsers(), BR;
    
    // add and remove a user
    $user = $cascade->getAsset( a\User::TYPE, "chanw" );
    $group->addUser( $user );
    echo $group->getUsers(), BR;

    $group->removeUser( $user );    
    echo $group->getUsers(), BR;
    
    // display role
    echo $group->getRole(), BR;
    
    // test existence of a user
    echo u\StringUtility::boolToString( $group->hasUser( $user ) ), BR;
    echo u\StringUtility::boolToString( $group->hasUserName( "chanw" ) ), BR;
    
    // set various flags
    $group->
        setWysiwygAllowFontAssignment( false )->            
        setWysiwygAllowFontFormatting( false )->            
        setWysiwygAllowImageInsertion( true )->            
        setWysiwygAllowTableInsertion( true )->            
        setWysiwygAllowTextFormatting( false )->            
        setWysiwygAllowViewSource( true )->            
        edit();
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