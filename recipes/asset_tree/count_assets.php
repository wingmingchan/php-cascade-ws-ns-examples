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
    $id = '5f4521768b7f08ee76b12c4151634021';

    $at = $cascade->getAsset( a\Folder::TYPE, '5f4521768b7f08ee76b12c4151634021' )->
        getAssetTree();

    $function_array = array(
        a\DataDefinitionBlock::TYPE => array( c\F::COUNT ),
        a\FeedBlock::TYPE =>           array( c\F::COUNT ),
        a\IndexBlock::TYPE =>          array( c\F::COUNT ),
        a\TextBlock::TYPE =>           array( c\F::COUNT ),
        a\File::TYPE =>                array( c\F::COUNT ),
        a\Folder::TYPE =>              array( c\F::COUNT ),
        a\Page::TYPE =>                array( c\F::COUNT ),
        a\ScriptFormat::TYPE =>        array( c\F::COUNT ),
        a\Template::TYPE =>            array( c\F::COUNT ),
        a\XmlBlock::TYPE =>            array( c\F::COUNT ),
        a\XsltFormat::TYPE =>          array( c\F::COUNT ),
    );

    $results = array();

    $at->traverse( 
        $function_array, 
        array( c\F::SKIP_ROOT_CONTAINER => true ), // skip Base Folder
        $results );

    $keys = array_keys( $results[ c\F::COUNT ] );

    foreach( $keys as $key )
    {
        echo $key . ": There are " .
            $results[ c\F::COUNT ][ $key ] . " of them." . BR;
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>