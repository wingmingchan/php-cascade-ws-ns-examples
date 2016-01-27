<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = "Page"; // control flag

try
{
    $site_name = 'cascade-admin';
    
    switch( $mode )
    {
        case "DataDefinitionBlock":
        
            // col-openx
            $block =     $cascade->getAsset( 
                a\DataBlock::TYPE, '980c4a3b8b7f0856015997e491d1b113' );
                
            echo "Data definition" . BR;
            $block->displayDataDefinition();
            // get related data definition
            $dd    = $block->getDataDefinition();
            $dd->displayXml();
            
            // get block properties
            echo "Metadata" . BR;
            $md = $block->getMetadata();
            u\DebugUtility::dump( $md->toStdClass() );
            
            echo "Structured data" . BR;
            $sd = $block->getStructuredData();
            u\DebugUtility::dump( $sd->toStdClass() );
            
            echo "Subscribers" . BR;
            // subscribers, Identifier objects
            u\DebugUtility::dump( $block->getSubscribers() );
            
            echo "Fully qualified identifiers" . BR;
            // identifiers of structured data
            u\DebugUtility::dump( $block->getIdentifiers() );
            break;
            
        case "Page":
        
            // index page
            $page     = $cascade->getAsset( 
                a\Page::TYPE, '980d70d98b7f0856015997e4b00790fe' );
            // get related assets
            echo "Configuration set" . BR;
            $cs       = $page->getConfigurationSet();
            $cs->display();
            
            echo "Content type" . BR;
            $ct       = $page->getContentType();
            $ct->display();
            
            echo "Data definition" . BR;
            $dd       = $page->getDataDefinition();
            $dd->display();
            
            echo "Metadata set" . BR;
            $ms       = $page->getMetadataSet();
            $ms->display();
            
            echo "Configuration/output" . BR;
            $rwd      = $cs->getPageConfiguration( 'RWD' );
            $rwd->display();
            
            echo "Template" . BR;
            $template = $rwd->getTemplate();
            $template->display();
            
            echo "Page regions" . BR;
            u\DebugUtility::dump( $template->getRegionNames() );
            
            echo "Page-level blocks and formats" . BR;
            u\DebugUtility::dump( $page->getPageLevelRegionBlockFormat() );
            
            // get page properties
            echo "Metadata" . BR;
            $md = $page->getMetadata();
            u\DebugUtility::dump( $md->toStdClass() );
            
            echo "Dynamic fields" . BR;
            $fns = $md->getDynamicFieldNames();
            u\DebugUtility::dump( $fns );
            
            echo "Structured data" . BR;
            $sd = $page->getStructuredData();
            u\DebugUtility::dump( $sd->toStdClass() );
            
            echo "Fully qualified identifiers" . BR;
            // identifiers of structured data
            u\DebugUtility::dump( $page->getIdentifiers() );
            // get data from a node
            echo $page->getText( "main-content-title" ) . BR;

            // subscribers
            echo "Subscribers" . BR;
            u\DebugUtility::dump( $page->getSubscribers() );
            
            break;
                
        case "Site":
            $site = $cascade->getSite( $site_name );
            // get the base folder
            $base_folder = $site->getBaseFolder()->dump( true );
            // content type container
            echo $site->getRootContentTypeContainerId() . BR;
            break;
            
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>