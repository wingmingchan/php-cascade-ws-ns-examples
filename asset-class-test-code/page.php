<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

//$mode = 'all';
$mode = 'display';
//$mode = 'dump';
$mode = 'get';
$mode = 'copy';
$mode = 'is';
$mode = 'metadata';
//$mode = 'set';
$mode = 'raw';
//$mode = 'none';

try
{
    $id = "29b846a88b7f08ee2969788831c112a6";
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
            
            u\DebugUtility::dump( $p->getIdentifiers() );
            
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
            
            echo "Configuration set:" . BR;
            $p->getConfigurationSet()->display();
            
            echo $p->getConfigurationSet()->
                        getDefaultConfiguration()->getName() . BR;
            echo $p->getConfigurationSet()->getDefaultConfiguration()->
                    getOutputExtension() . BR;

            echo "Data definition:" . BR;
            $p->getDataDefinition()->display();

            if( $mode != 'all' )
                break;
                
        case 'is':
            echo "Dumping the set of identifiers:" . BR;
            u\DebugUtility::dump( $p->getIdentifiers() );
            
            $node_name = "pre-main-group";     // group
            $node_name = "main-group;h1";      // normal text, no text type
            $node_name = "main-group;wysiwyg"; // WYSIWYG
            $node_name = "main-group;mul-pre-h1-chooser;0"; // block
            
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
                echo "This is not an asset node" . BR;
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
            //u\DebugUtility::dump( $p->getIdentifiers() );
            $p->setText( "main-group;h1", "New Title" )->edit();
        
            // chooser
            $node_name = "main-group;mul-pre-h1-chooser;0";
            
            if( $p->hasNode( $node_name ) )
            {
            
                $node_type = $p->getNodeType( $node_name );
                
                if( $node_type == c\T::ASSET )
                {
                    $asset_type = $p->getAssetNodeType( $node_name );
                    
                    if( $asset_type == c\T::BLOCK )
                    {
                        $block_id     = '818347538b7f08ee22f3b7d13a216538';
                        $text_block = $cascade->getAsset( a\TextBlock::TYPE, $block_id );
                        $p->setBlock( $node_name, $text_block )->edit();
                    }
                }
            }
            
            $node_name = "main-group;wysiwyg";
             
            if( $p->hasNode( $node_name ) && 
                $p->getNodeType( $node_name ) == c\T::TEXT &&
                $p->isWYSIWYG( $node_name )
            )
            {
                $text = $p->getText( $node_name );
                $text .= "<p>Another paragraph.</p>";
                $p->setText( $node_name, $text )->edit();
            }

            $p->setShouldBePublished( false );
            $p->setMaintainAbsoluteLinks( false )->edit();

            if( $mode != 'all' )
                break;
                
        case 'metadata':
            $m = $p->getMetadata();
            
            u\DebugUtility::dump( $m->getDynamicFieldNames() );
            
            $field_name = "exclude-from-left-folder-nav";
            //var_dump( $m->getDynamicFieldPossibleValues( $field_name ) );
            $m->setDynamicFieldValues( $field_name, '' );
            $field_name = "exclude-from-menu";
            $m->setDynamicFieldValues( $field_name, NULL );
            $p->edit()->dump();
            
            if( $mode != 'all' )
                break;
                
        case 'copy':
            $parent     = $p->getParentFolder();
            $new_page = $p->copy( $parent, 'test3' );
            $new_page->display();
            
            if( $mode != 'all' )
                break;
                
        case 'raw':
            $p_std = $service->retrieve( $service->createId( c\T::PAGE, $id ) );
                
            u\DebugUtility::dump( $p_std );
        
            if( $mode != 'all' )
                break;
    }
    
    //echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Page" );
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