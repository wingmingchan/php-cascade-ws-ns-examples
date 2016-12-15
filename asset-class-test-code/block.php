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
    // test static method
    $id = "06e401898b7ffe83765c5582e367462b";
    $block = a\Block::getBlock( $service, $id ); //->dump(); // no type info supplied
    
    echo a\Block::getBlockType( $service, $id ), BR;
    // get methods
    echo "Created by: ", $block->getCreatedBy(), BR,
         "Created on: ", $block->getCreatedDate(), BR,
         "Expiration folder ID: ", $block->getExpirationFolderId(), BR,
         "Expiration folder path: ", $block->getExpirationFolderPath(), BR,
         "Expiration folder recycled: ", u\StringUtility::boolToString(
             $block->getExpirationFolderRecycled() ), BR,
         "Last modified by: ", $block->getLastModifiedBy(), BR,
         "Last modified date: ", $block->getLastModifiedDate(), BR,
         "Metadata set ID: ", $block->getMetadataSetId(), BR,
         "Metadata set path: ", $block->getMetadataSetPath(), BR;
        
    u\DebugUtility::dump( $block->getDynamicFields() );
    u\DebugUtility::dump( $block->getMetadataStdClass() );
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Block" );
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