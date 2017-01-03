<?php 
/*
This program shows how to find an asset with a certain name.
*/
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $results = array();

    $cascade->getAsset( a\Site::TYPE, 'cascade-admin' )->
        getBaseFolderAssetTree()->traverse(
            array( a\DataBlock::TYPE => array( c\F::SEARCH_BY_NAME ) ),
            array( c\F::SEARCH_BY_NAME => 
                array( a\DataBlock::TYPE => array( 'name'=> 'monster_with_phantom' ) ) ),
            $results
        );

    u\DebugUtility::dump( $results );
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