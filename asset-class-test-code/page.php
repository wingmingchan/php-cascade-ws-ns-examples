<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
$mode = 'dump';
//$mode = 'get';
//$mode = 'copy';
//$mode = 'is';
//$mode = 'metadata';
//$mode = 'set';
//$mode = 'move';
//$mode = 'raw';
//$mode = 'none';

try
{
    $id = "1f2401dc8b7ffe834c5fe91ec8c91543";
    $p  = $cascade->getAsset( a\Page::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $p->display();
            $p->displayDataDefinition();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $p->dump();
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "Dumping the set of identifiers:" . BR;
            u\DebugUtility::dump( $p->getIdentifiers() );
            
            $node_name = 'content-group;0;content-group-block-floating';
            
            if( $p->hasNode( $node_name ) )
            {
                echo "The value is: " . $p->getText( $node_name ) . BR;
            }
            
            $node_name = 'content-group;0;content-group-chooser';
            
            if( $p->hasNode( $node_name ) )
            {
                $node_type = $p->getNodeType( $node_name );
                
                echo "The type is: " . $node_type . BR;
                
                if( $node_type == c\T::ASSET )
                {
                    $asset_type = $p->getAssetNodeType( $node_name );
                    echo "The asset type is: " . $asset_type . BR;
                }
            }
            
/**/            
            echo "Configuration set:" . BR;
            $p->getConfigurationSet()->display();
            
            echo $p->getConfigurationSet()->
                        getDefaultConfiguration()->getName() . BR;
            echo $p->getConfigurationSet()->getDefaultConfiguration()->
                    getOutputExtension() . BR;
            
            

            echo "Data definition:" . BR;
            $p->getDataDefinition()->display();
/*
            echo "Metadata set:" . BR;
            $p->getMetadataSet()->display();

            echo "Template of Desktop:" . BR;
            $t = $p->getConfigurationSet()
                ->getPageConfigurationTemplate( 'Desktop' )
                ->dump();
*/
            if( $mode != 'all' )
                break;
                
        case 'is':
            echo "Dumping the set of identifiers:" . BR;
            u\DebugUtility::dump( $p->getIdentifiers() );
            
            $node_name = 'content-group;0'; // group
            $node_name = "main-content-title"; // normal text, no text type
            $node_name = "main-content-content"; // WYSIWYG
            // radiobutton
            $node_name = "content-group;2;content-group-margin-bottom"; 
            $node_name = "content-group;0;content-group-chooser"; // block
            //$node_name = "main-content-image"; // file
            
            if( $p->isAssetNode( $node_name ) )
            {
                echo "This is an asset node" . BR;
                
                $asset_type = $p->getAssetNodeType( $node_name );
                echo "The asset type is: " . $asset_type . BR;
                
                if( $asset_type == c\T::BLOCK )
                {
                    echo "The block ID is: " . 
                        $p->getBlockId( $node_name ) . BR;
                }
            }
            else
            {
                echo "This is not a asset node" . BR;
            }
            
            if( $p->isGroupNode( $node_name ) )
            {
                echo "This is a group node" . BR;
            }
            else
            {
                echo "This is not a group node" . BR;
            }
            
            if( $p->isTextNode( $node_name ) )
            {
                echo "This is a text node" . BR;
                echo "The text type is: " . 
                    $p->getTextNodeType( $node_name ) . BR;
                
                if( $p->isWYSIWYG( $node_name ) )
                {
                    echo "This is a WYSIWYG". BR;
                }
            }
            else
            {
                echo "This is not a text node" . BR;
            }
            
            if( $mode != 'all' )
                break;
                
        case 'set':
            // work with DEFAULT first
            $node_name = 'content-group;0;content-group-chooser';
            
            $block_id     = '96f745cb8b7f0856002a5e11a2199545';
            $text_block = $cascade->getAsset( a\TextBlock::TYPE, $block_id );
            
            if( $p->hasNode( $node_name ) )
            {
                $node_type = $p->getNodeType( $node_name );
                
                if( $node_type == c\T::ASSET )
                {
                    $asset_type = $p->getAssetNodeType( $node_name );
                    
                    if( $asset_type == c\T::BLOCK )
                    {
                        $p->setBlock( $node_name, $text_block );
                    }
                }
            }
            
/*
            $node_name = 'main-content-content';
             
            if( $p->hasNode( $node_name ) && 
                $p->getNodeType( $node_name ) == c\T::TEXT &&
                $p->isWYSIWYG( $node_name )
            )
            {
                $text = $p->getText( $node_name );
                $text .= "<p>Another paragraph.</p>";
                $p->setText( $node_name, $text )->edit();
            }
*/            
            // add another content-group
            $node_name = $node_name = 'content-group;0';
            //$p->appendSibling( $node_name )->edit();

            // regions
            //u\DebugUtility::dump( $p->getPageRegionNames( 'Desktop' ) );
            
            //$p->removeLastSibling( $node_name )->edit();
            u\DebugUtility::dump( $p->getIdentifiers() );
            
            
            if( $p->hasPageRegion( 'Desktop', "TOP GRAPHICS" ) )
            {
                $slide_show_id = '968587d38b7f08560081f1439f7e4b5d';
                $slide_show_block = 
                    $cascade->getAsset(
                        a\DataDefinitionBlock::TYPE, $slide_show_id );
                // the wrong one
                //$format_id = 'e39283268b7f0856015997e4069c17ea';
                // the right one
                $format_id = '470207d98b7f0856015997e487d78571'; 
                $format = $cascade->getAsset( a\XsltFormat::TYPE, $format_id );
                
                // attach the slide show to the region
                // this will have no effect because of the next line
                $p->setRegionBlock( 
                    'Desktop', "TOP GRAPHICS", $slide_show_block );
                //$p->setRegionBlock( 'Desktop', "TOP GRAPHICS", NULL );
                
                // set noBlock
                //$p->setRegionNoBlock( 'Desktop', "TOP GRAPHICS", true );
                
                // attach the format to the region
                $p->setRegionFormat( 'Desktop', "TOP GRAPHICS", $format )->
                    //setRegionNoFormat( 'Desktop', "TOP GRAPHICS", false )->
                    edit();
            }
            else
            {
                echo "Top graphic not found" . BR;
            }
            
            //$p->setShouldBePublished( false )->edit();
            //$p->setShouldBePublished( true )->edit()->publish();
            $p->setMaintainAbsoluteLinks( true )->edit();
     
            if( $mode != 'all' )
                break;
                
        case 'metadata':
            $m = $p->getMetadata();
            
            u\DebugUtility::dump( $m->getDynamicFieldNames() );
            
            $field_name = "exclude-from-left";
            //var_dump( $m->getDynamicFieldPossibleValues( $field_name ) );
            $m->setDynamicFieldValues( $field_name, '' );
            $field_name = "exclude-from-menu";
            $m->setDynamicFieldValues( $field_name, NULL );
            $p->edit();

            if( $mode != 'all' )
                break;
                
        case 'copy':
            $parent     = $p->getParentFolder();
            $new_page = $p->copy( $parent, 'test3' );
            $new_page->display();
            
            if( $mode != 'all' )
                break;
                
        case 'raw':
            //$p->dump();
        
            $p_std = $service->retrieve( $service->createId( 
                c\T::PAGE, $id ), c\P::PAGE );
                
            u\DebugUtility::dump( $p_std );
        
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Page" );
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