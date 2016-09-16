<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name     = "ws-tutorial-wing";
    $block_name    = "test-metadata";
    $parent_folder = $cascade->getAsset( a\Folder::TYPE, "blocks", $site_name );
    $tb            = $cascade->getTextBlock( $block_name, $site_name );
    
    if( is_null( $tb ) )
        $tb = $cascade->createTextBlock( $parent_folder, $block_name, "Some text" );
        
    // the current metadata
    $old_m = $tb->getMetadata();
    // set some fields
    $old_m->setAuthor( "Wing" )->
        setStartDate( "2016-09-16T00:00:00" )->
        getHostAsset()->edit();
        
    // the new metadata set and new metadata
    $new_ms = $cascade->getAsset( 
        a\MetadataSet::TYPE, "My Test Metadata Set", $site_name );
    $new_m  = $new_ms->getMetadata();
    
    // map the wired fields
    p\Metadata::copyWiredFields( $old_m, $new_m );
    
    // set both metadata set and metadata
    $tb->setMetadataSet( $new_ms )->setMetadata( $new_m );
        
    // work with the new metadata
    $m = $tb->getMetadata();
    
    $field_name = "languages";
    
    if( $m->hasDynamicField( $field_name ) )
    {
        $m->setDynamicField( $field_name, array( "English", "Spanish" ) );
    }
    
    $tb->edit()->dump();
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