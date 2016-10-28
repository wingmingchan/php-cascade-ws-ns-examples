<?php
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $template = $cascade->getAsset(
        a\Template::TYPE, "255a45c38b7ffe3b00a7e343dd8f41cb" );
    $region = $template->getPageRegion( "FOOTER NAVIGATION" );
    //u\DebugUtility::dump( $region );
/*
    $region->display();
    echo $region->getId(), BR;
    echo $region->getName(), BR;
    
    $block = $region->getBlock();
    $format = $region->getFormat();
    //echo u\StringUtility::boolToString( is_null( $block ) ), BR;
    //echo u\StringUtility::boolToString( is_null( $format ) ), BR;
    
    echo u\StringUtility::getCoalescedString( $region->getBlockId() ), BR;
    echo u\StringUtility::getCoalescedString( $region->getBlockPath() ), BR;
    echo u\StringUtility::boolToString( $region->getBlockRecycled() ), BR;
    
    echo u\StringUtility::getCoalescedString( $region->getFormatId() ), BR;
    echo u\StringUtility::getCoalescedString( $region->getFormatPath() ), BR;
    echo u\StringUtility::boolToString( $region->getFormatRecycled() ), BR;
    
    echo u\StringUtility::boolToString( $region->getNoBlock() ), BR;
    echo u\StringUtility::boolToString( $region->getNoFormat() ), BR;
*/    
    
    $region->
        setBlock(
            $cascade->getAsset(
                a\TextBlock::TYPE, "0bc94b1f8b7ffe83006a5cefe3ab1dac" ) )->
        setFormat(
            $cascade->getAsset(
                a\ScriptFormat::TYPE, "0bcf8ce48b7ffe83006a5cef7d7c12f5" ) )->
        setNoBlock( true )->
        setNoFormat( true );
    
    u\DebugUtility::dump( $region->toStdClass() );
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