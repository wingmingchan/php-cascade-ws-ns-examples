<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
$mode = 'rename';
//$mode = 'move';
$mode = 'get';
//$mode = 'raw';

try
{
    switch( $mode )
    {
        case 'all':
        case 'rename':
            $id = 'e233f1458b7ffe8364375ac786dcd9c8';
            $p  = $cascade->getAsset( a\Page::TYPE, $id );
            $p->rename( 'test3' );

            // exception: site cannot be renamed/moved
            try
            {
                $id   = '388e29ea8b7ffe83164c9314ead8aaa9';
                $site = $cascade->getAsset( a\Site::TYPE, $id );
                $site->rename( 'tuw_test_dev' );
            }
            catch( \Exception $e )
            {
                echo S_PRE . $e . E_PRE;
            }
                      
            if( $mode != 'all' )
                break;

        case 'move':
            // moving Base Folder: exception
            $id = '388e2b808b7ffe83164c9314a6f3cba9';
            $bf = $cascade->getAsset( a\Folder::TYPE, $id );
            
            try
            {
                $bf->move( $bf, false );
            }
            catch( \Exception $e )
            {
                echo S_PRE . $e . E_PRE;
            }
            
            $test1 = $cascade->getAsset( a\Folder::TYPE, 'e231348c8b7ffe8364375ac74bbbc6fb' );
            $test2 = $cascade->getAsset( a\Folder::TYPE, 'e2315d4d8b7ffe8364375ac7e674a4d2' );
            $test2->move( $test1, false );
           
            $page = $cascade->getAsset( a\Page::TYPE, 'e233f1458b7ffe8364375ac786dcd9c8' );
            
            if( $page->isInContainer( $test2 ) )
                $page->move( $test1, false );

            if( $mode != 'all' )
                break;
               
        case 'get':
            // site: exception
            $site_id = 'cascade-admin';
            $s       = $cascade->getAsset( a\Site::TYPE, $site_id );
            
            try
            {
                u\DebugUtility::dump( $s->getParentContainer() ); // exception
            }
            catch( e\WrongAssetTypeException $e )
            {
                echo S_PRE . $e . E_PRE;
            }

            // Base Folder
            $id = '388e2b808b7ffe83164c9314a6f3cba9';
            $bf = $cascade->getAsset( a\Folder::TYPE, $id );
            u\DebugUtility::dump( $bf->getParentContainer() ); // NULL

            // root metadata set container
            $id   = '388e2f428b7ffe83164c931489e357f1';
            $rmsc = $cascade->getAsset( a\MetadataSetContainer::TYPE, $id );
            u\DebugUtility::dump( $rmsc->getParentContainer() ); // NULL
            
            // metadata set container
            $id   = 'e10375238b7ffe8364375ac7a41ad6e3';
            $msc  = $cascade->getAsset( a\MetadataSetContainer::TYPE, $id );
            $msc->getParentContainer()->display();

            // folder
            $id = '38906a9f8b7ffe83164c9314b9bdebfd';
            $f  = $cascade->getAsset( a\Folder::TYPE, $id );
            $f->getParentContainer()->display();

            // data definition
            $id = '38a20d858b7ffe83164c931479486e6f';
            $dd = $cascade->getAsset( a\DataDefinition::TYPE, $id );
            $dd->getParentContainer()->display();
            echo $dd->getParentContainerId(), BR,
                 $dd->getParentContainerPath(), BR;
                 
            echo u\StringUtility::boolToString( $dd->isDescendantOf( $msc ) ), BR;

            if( $mode != 'all' )
                break;
    
        case 'raw':
        
            if( $mode != 'all' )
                break;
    }
    
        echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\ContainedAsset" );
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