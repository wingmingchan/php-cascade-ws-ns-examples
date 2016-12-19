<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
$mode = 'display';
//$mode = 'dump';
$mode = 'get';
//$mode = 'set';
//$mode = 'unset';
//$mode = 'raw';

try
{
    $id = "a55d61298b7f0856002a5e11de80a550"; // test
    $t  = $cascade->getAsset( a\Template::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $t->display();
            $t->displayXml();
            
            if( $mode != 'all' )
                break;
               
        case 'dump':
            $t->dump( true );
            
            echo S_PRE;
            var_dump( $t->getPageRegionStdForPageConfiguration() );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;
                
        case 'get':

            echo $t->getCreatedBy(), BR;
            echo $t->getCreatedDate(), BR;
            echo u\StringUtility::getCoalescedString( $t->getFormatId() ), BR;
            echo u\StringUtility::getCoalescedString( $t->getFormatPath() ), BR;
            echo u\StringUtility::boolToString( $t->getFormatRecycled() ), BR;
            echo $t->getLastModifiedBy(), BR;
            echo $t->getLastModifiedDate(), BR;
            echo u\StringUtility::getCoalescedString( $t->getTargetId() ), BR;
            echo u\StringUtility::getCoalescedString( $t->getTargetPath() ), BR;

            $f = $t->getFormat();
            
            if( $f != NULL )
            {
                $f->display();
            }
            
            //u\DebugUtility::dump( $t->getPageRegion( 'STORAGE' ) );
            
            $block = $t->getPageRegionBlock( 'STORAGE' );
            
            if( isset( $block ) )
                $block->dump();
            
            $format = $t->getPageRegionFormat( 'STORAGE' );
            
            //echo $t->getXml(), BR;
            echo u\StringUtility::boolToString( $t->hasPageRegion( 'STORAGE' ) ), BR;
            
            //if( isset( $format ) )
                //$format->dump();
                
            //u\DebugUtility::dump( $t->getPageRegionNames() );
            //u\DebugUtility::dump( $t->getPageRegions() );
            //u\DebugUtility::dump( $t->getPageRegionStdForPageConfiguration() );
            
            if( $mode != 'all' )
                break;
                
        case 'set':
            $format_id = "4ad593f38b7f085600a28ff77fe83c04";
            $format    = $cascade->getAsset( a\XsltFormat::TYPE, $format_id );
        
/*
            $xml = <<<XML
<system-region name="DEFAULT"/>
XML;
*/
            //$t->setXML( $xml )->edit();
            $t->setFormat( $format )->edit();
            $t->displayXML();
            
            $pr = $t->getPageRegion( 'DEFAULT' );
            
            $index_block_id = 'fd2784aa8b7f08560159f3f03da5653d';
            $format_id      = 'fd27c1988b7f08560159f3f012c360e7';
            $index_block    = $cascade->getAsset( a\IndexBlock::TYPE, $index_block_id );
            $format         = $cascade->getAsset( a\XsltFormat::TYPE, $format_id );
            
            $pr->setBlock( $index_block );
            $pr->setFormat( $format );
            $t->edit()->dump();
            
            if( $mode != 'all' )
                break;
                
        case 'unset':
            $t->setFormat( NULL );
            $t->setPageRegionBlock( 'DEFAULT', NULL )->
                setPageRegionFormat( 'DEFAULT', NULL )->
                edit()->dump();
            
            if( $mode != 'all' )
                break;
                
        case 'raw':
            // these two should show identical structure
            $t->dump();
        
            $t_std = $service->retrieve( $service->createId( 
                c\T::TEMPLATE, $id ), c\P::TEMPLATE );
            echo S_PRE;
            var_dump( $t_std );
            echo E_PRE;
        
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Template" );
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
