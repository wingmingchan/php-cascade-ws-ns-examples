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
    $results = array();

    // get all data definition blocks with a certain radio button selected
    $cascade->getAsset( a\Folder::TYPE, 'ede7fca98b7f08560139425c897612d8' )->
        getAssetTree()->traverse(
            array( a\DataBlock::TYPE => 
                array( c\F::REPORT_DATA_DEFINITION_FLAG ) ), 
            array( c\F::REPORT_DATA_DEFINITION_FLAG => array(
                a\DataBlock::TYPE => array( 'display' => 'No' ) ) ),
            $results );
            
    if( count( $results[ c\F::REPORT_DATA_DEFINITION_FLAG ]
        [ a\DataBlock::TYPE ] ) > 0 )
    {
        foreach( $results[ c\F::REPORT_DATA_DEFINITION_FLAG ]
            [ a\DataBlock::TYPE ] as $child )
        {
            // get the block object
            // $block = $child->getAsset( $service );
            // do something with the block
            
            // just echo the ID
            echo $child->getId() . BR;
        }
    }
    else
    {
        echo "There are none." . BR;
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>