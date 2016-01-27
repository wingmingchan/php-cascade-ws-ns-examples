<?php 
require_once('cascade_ws_ns/auth_sandbox.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'Page'; // control flag

try
{
    $site_name = 'web-service-tutorial';

    switch( $mode )
    {
        case 'Site':
            $cascade->getSite( $site_name )->
                setUrl( 'www.upstate.edu/' . $site_name )->
                setLinkCheckerEnabled( false )->
                setExternalLinkCheckOnPublish( false )->
                setRecycleBinExpiration( a\Site::THIRTY )->
                edit();
            break;
            
        case 'TextBlock':
            // check if the meatadata set Block exists
            $ms_container_name = 'Test Metadata Set Container';
            $ms_name           = 'Block';
            $ms                = $cascade->getMetadataSet( 
                $ms_container_name . '/' . $ms_name, $site_name );
            
            if( is_null( $ms ) )
            {
                $ms = $cascade->createMetadataSet(
                    $cascade->getAsset( 
                        a\MetadataSetContainer::TYPE, $ms_container_name, $site_name ),
                    $ms_name );
            }
            
            $block = $cascade->getAsset( a\TextBlock::TYPE, 'blocks/title', $site_name )->
                setMetadataSet( $ms );
                
            $md = $block->getMetadata();
            $md->setSummary( 'This is a text block' )->
                setAuthor( 'Wing' )->
                setDisplayName( 'Text Block' );
            //$block->setMetadata( $md );
            $block->edit();
            
            //u\DebugUtility::dump( $block->getMetadata()->toStdClass() );
            break;
            
        case 'Page':
            $site_name   = 'cascade-admin';
            $folder_name = 'test-folder';
            $page_name   = 'file';
            
            $copy = $cascade->getPage( a\Page::TYPE, $folder_name . '/' . $page_name, $site_name );
            
            if( is_null( $copy ) )
            {
                $source_page_name   = 'projects/web-services/oop/classes/asset-classes/file';
        
                // copy the page to the test folder
                $page = $cascade->getAsset( a\Page::TYPE, $source_page_name, $site_name );
                $copy = $page->copy(
                    $cascade->getAsset( a\Folder::TYPE, $folder_name, $site_name ),
                    $page_name
                );
            }
            
            //u\DebugUtility::dump( $copy->getIdentifiers() );
            
            $node_name = "main-content-title";
            echo $copy->getText( $node_name ), BR;
            
            if( $copy->isTextNode( $node_name ) )
            {
                $copy->setText( $node_name, 'A New Title Here' );
            }
            
            $node_name = "content-group;2;content-group-content";
            
            if( $copy->isTextNode( $node_name ) )
            {
                $copy->setText( $node_name, '<p>New content here.</p>' );
            }
            
            $copy->edit();
        
            break;
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>