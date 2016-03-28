<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
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
    $id       = '7de421e58b7f08560139425cb4de43ce'; // multiple text
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
            echo S_PRE;
            //var_dump( $dd_block->getStructuredData()->toStdClass() );
            var_dump( $dd_block->getStructuredData()->getIdentifiers() );
            echo E_PRE;
            
            $identifier = "test-multiple-text1";
            echo ( $dd_block->isMultiple( $identifier ) ? 
                'Multiple' : 'Not multiple' ) . BR;
            
            if( $mode != 'all' )
                break;
            
        case 'set':
            $field_name = 'test-multiple-text1;1';
            
            if( $dd_block->hasNode( $field_name ) )
            {
                $dd_block->setText( 
                    $field_name, 
                    'New text for test-multiple-text1;1' )->edit();
                $text_node = $dd_block->getStructuredData()->
                    getStructuredDataNode( $field_name );
                echo $text_node->getText() . BR;
            }
            else
            {
                echo "Node not found" . BR;
            }
            
            $field_name = 'test-multiple-text2;0';
            
            if( $dd_block->hasNode( $field_name ) )
            {
                $dd_block->setText( 
                    $field_name, 
                    'New text for test-multiple-text2;0' )->edit();
                $text_node = $dd_block->getStructuredData()->
                    getStructuredDataNode( $field_name );
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
            $dd_block->appendSibling( $node_name )->edit();

            if( $mode != 'all' )
                break;
                
        case 'remove':

            $node_name = 'test-multiple-text2;0';
            $dd_block->removeLastSibling( $node_name )->edit();

            if( $mode != 'all' )
                break;
                
        case 'raw':
            $dd_block = $service->retrieve( 
                $service->createId( c\T::DATABLOCK, $id), c\P::DATABLOCK );

            echo S_PRE;
            var_dump( $dd_block );
            echo E_PRE;

            if( $mode != 'all' )
                break;
    }

}
catch( \Exception $e )
{
    echo $e;
}
?>
