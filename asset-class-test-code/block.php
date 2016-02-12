<?php 
require_once('cascade_ws_ns/auth_chanw.php');
use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;
try
{
    // test static method
    $id = "980c2b7e8b7f0856015997e4b5924ca1";
    $block = a\Block::getBlock( $service, $id )->dump( true ); // no type info supplied
    echo a\Block::getBlockType( $service, $id ), BR;
    
    // get methods
    echo "Created by: ", $block->getCreatedBy(), BR,
        "Created on: ", $block->getCreatedDate(), BR,
        "Expiration folder ID:", $block->getExpirationFolderId();
        
    u\DebugUtility::dump( $block->getDynamicFields() );
    u\DebugUtility::dump( $block->getMetadataStdClass() );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>