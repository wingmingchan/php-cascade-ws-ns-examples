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
//$mode = 'get';
//$mode = 'set';
//$mode = 'raw';
//$mode = 'add';
//$mode = 'remove';

try
{
    $id       = '1f21cf0c8b7ffe834c5fe91e6dde13c2'; // multiple text
    $dd_block = $cascade->getAsset( a\DataDefinitionBlock::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
             $dd_block->displayDataDefinition();
            //$dd_block->display();
           
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $dd_block->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            //u\DebugUtility::dump( $dd_block->getStructuredData()->toStdClass() );
            u\DebugUtility::dump( $dd_block->getStructuredData()->getIdentifiers() );
            
            $identifier = "test-multiple-text1";
            
            if( $dd_block->hasNode( $identifier ) )
                echo ( $dd_block->isMultiple( $identifier ) ? 
                    'Multiple' : 'Not multiple' ) . BR;
            
            if( $mode != 'all' )
                break;
            
        case 'set':
            $node_name = 'test-multiple-text1;1';
            
            if( $dd_block->hasNode( $node_name ) )
            {
                $dd_block->setText( 
                    $node_name, 
                    'New text for test-multiple-text1;1' )->edit();
                $text_node = $dd_block->getStructuredData()->
                    getStructuredDataNode( $node_name );
                echo $text_node->getText() . BR;
            }
            else
            {
                echo "Node not found" . BR;
            }
            
            $node_name = 'test-multiple-text2;0';

            if( $dd_block->hasNode( $node_name ) )
            {
                $dd_block->setText( 
                    $node_name, 
                    'New text for test-multiple-text2;0' )->edit();
                $text_node = $dd_block->getStructuredData()->
                    getStructuredDataNode( $node_name );
                echo $text_node->getText() . BR;
            }
            else
            {
                echo "Node not found" . BR;
            }

            if( $mode != 'all' )
                break;
                
        case 'add':
            $node_name = 'test-multiple-text2;0';
            
            if( $dd_block->hasNode( $node_name ) )
                $dd_block->appendSibling( $node_name )->edit();

            if( $mode != 'all' )
                break;
                
        case 'remove':
            $node_name = 'test-multiple-text2;0';
            
            if( $dd_block->hasNode( $node_name ) )
                $dd_block->removeLastSibling( $node_name )->edit();

            if( $mode != 'all' )
                break;
                
        case 'raw':
            $dd_block = $service->retrieve( 
                $service->createId( c\T::DATABLOCK, $id), c\P::DATABLOCK );

            u\DebugUtility::dump( $dd_block );

            if( $mode != 'all' )
                break;
    }
}
catch( \Exception $e )
{
    echo $e;
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE;
}
?>