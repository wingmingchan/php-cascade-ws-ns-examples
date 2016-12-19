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
//$mode = 'metadata';
//$mode = 'set';
//$mode = 'raw';
//$mode = 'search';

try
{
    $id = "17d404608b7ffe834304cee2fc7c8313"; // test-xhtml
    $xb = $cascade->getAsset( a\DataDefinitionBlock::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            if( !$xb->hasStructuredData() )
            {
                $xb->displayXHTML();
            }
            else
            {
                // exception
                var_dump( $xb->getDataDefinition() );
            }
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $xb->dump();
            if( $mode != 'all' )
                break;
                
        case 'get':
            if( !$xb->hasStructuredData() )
            {
                echo $xb->getXHTML();
            }
            
            if( $mode != 'all' )
                break;
                
        case 'set':
            if( !$xb->hasStructuredData() )
            {
                $xb->setXhtml( "<p>New text for the block.</p>")->edit();
                echo $xb->getXHTML();
            }
            
            if( $mode != 'all' )
                break;
                
        case 'search':
            if( !$xb->hasStructuredData() )
            {
                echo $xb->searchXHTML( "New" ) ? 
                    "string found" : "string not found";
                echo $xb->getXHTML();
                if( $xb->searchXHTML( "New" ) )
                {
                    $xb->replaceXHTMLByPattern( '/New/', 'Old' )->edit();
                }
            }
            
            if( $mode != 'all' )
                break;
                
        case 'raw':
            $xb = $service->retrieve( $service->createId( 
                c\T::DATABLOCK, $id ), c\P::DATABLOCK );

            u\DebugUtility::dump( $xb );

            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\DataDefinitionBlock" );
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