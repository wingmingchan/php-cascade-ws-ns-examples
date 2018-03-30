<?php
/*
This program is used to create a new group 
by copying the information of an existing group,
and to copy access information to the new group.
Ten types of assets will be affected:
    DataDefinitionBlock::TYPE, 
    FeedBlock::TYPE, 
    IndexBlock::TYPE, 
    TextBlock::TYPE, 
    XmlBlock::TYPE, 
    File::TYPE,
    Folder::TYPE,
    Page::TYPE,
    Reference::TYPE,
    Symlink::TYPE
The program also changes asset factory settings.

Ultimate goal: to rename a group.
After running this program, delete the old group.
*/
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time = time();

try
{
    u\DebugUtility::setTimeSpaceLimits();
    
    // the site to be associated with the new group
    $site_name      = "cancer";
    $site           = $admin->getSite( $site_name );
    $old_group_name = "cancer";
    $old_group      = $admin->getAsset( a\Group::TYPE, $old_group_name );
    $new_group_name = "test-new-group";
    
    // create the new group
    $admin->copyGroup( $old_group, $new_group_name );
    $new_group = $admin->getAsset( a\Group::TYPE, $new_group_name )->dump();
/*/
    // copy read access
    $admin->copyGroupReadAccess(
        $old_group, $new_group, "cancer", "_cascade/blocks/quarantine/nav" );
        
    // copy write access
    $admin->copyGroupWriteAccess(
        $old_group, $new_group, "cancer", "_cascade/blocks/quarantine/nav" );
/*/
    $admin->copyAFGroupAccess( $old_group, $new_group, $site_name );
    
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Error $er ) 
{
    echo S_PRE . $er . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}
?>