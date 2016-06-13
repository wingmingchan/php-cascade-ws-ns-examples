<?php
/*
This program shows how to map data.
The two data definitions involved:
Old: old_data_definition
New: new_data_definition

identifiers of the source:

array(5) {
  [0]=>
  string(6) "header"
  [1]=>
  string(7) "wysiwyg"
  [2]=>
  string(6) "sports"
  [3]=>
  string(7) "text4;0"
  [4]=>
  string(7) "text4;1"
}

idenfifiers of the target:

array(6) {
  [0]=>
  string(13) "content-group"
  [1]=>
  string(16) "content-group;h1"
  [2]=>
  string(21) "content-group;content"
  [3]=>
  string(11) "hobby-group"
  [4]=>
  string(17) "hobby-group;hobby"
  [5]=>
  string(19) "hobby-group;text4;0"
}
*/

require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try 
{
    $new_dd = $cascade->getAsset( 
        a\DataDefinition::TYPE, "49f695968b7f08ee1ac4a4a7c324eacc" );
        
    $dd_block = $cascade->getAsset( 
        a\DataDefinitionBlock::TYPE, "4a0b84158b7f08ee1ac4a4a743f37c9f" );

    // step 1: get a new StructuredData object from the new data definition
    $new_sd = $new_dd->getStructuredDataObject();
        
    
        
    //u\DebugUtility::dump( $new_sd->getPossibleValues( ) );
    
    
    
    $map = array(
        "header"  => "content-group;h1",
        "wysiwyg" => "content-group;content",
        "sports"  => "hobby-group;hobby"
    );
    
    foreach( $map as $old_node => $new_node )
    {
        // step 2: copy data from non-multiple nodes
        if( $dd_block->isText( $old_node ) )
        {
            if( $dd_block->isTextBox( $old_node ) || $dd_block->isWYSIWYG( $old_node ) )
            {
                $new_sd->setText( $new_node, $dd_block->getText( $old_node ) );
            }
            // mapping checkbox to radio
            // need to make sure only one value is mapped
            elseif( $dd_block->isCheckbox( $old_node ) )
            {
                // get default value of the radio
                $attrs       = $new_dd->getField( $new_node );
                $default_val = $attrs[ "default" ];
                
                // use default
                if( $dd_block->getText( $old_node ) == "" )
                {
                    $new_sd->setText( $default_val );
                }
                // use the first value
                else
                {
                    $str_array = 
                        u\StringUtility::getExplodedStringArray( ";", $dd_block->getText( $old_node ) );
                        
                    $new_val = $str_array[ 0 ];
                    $new_val = substr( $new_val, 24 ); // cut out prefix
                    $new_sd->setText( $new_node, $new_val );
                }
            }
        }
    }
    
    // step 3: multiple nodes
    $num_of_nodes = $dd_block->getNumberOfSiblings( "text4;0" );
    $new_sd->createNInstancesForMultipleField( $num_of_nodes, "hobby-group;text4;0" );
    
    for( $i = 0; $i < $num_of_nodes; $i++ )
    {
        $new_sd->setText( "hobby-group;text4;" . $i, $dd_block->getText( "text4;" . $i ) );
    }
    
    $dd_block->setStructuredData( $new_sd );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
}
?>