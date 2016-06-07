<?php
/*
This program is used to convert a site, from RWD1 to RWD2.
RWD1 uses XSLT exclusively, whereas RWD2 uses Velocity.
When working with a large site, it is better to work with a folder at a time 
when converting pages, hence the line (line 31) retrieving a folder.
*/
require_once( 'cascade_ws_ns/auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

// site to be converted
$site_name = "cascade-admin";

// global assets
$common_assets_site_name    = "_common_assets";
$block_ms_name              = "Block";
$folder_ms_name             = "Folder";
$ct_name                    = "RWD";
$base_folder_name           = "/";
$cascade_blocks_folder_name = "_cascade/blocks";

try
{
    // retrieve relevant assets
    //$base_folder   = $cascade->getAsset( a\Folder::TYPE, $base_folder_name, $site_name );
    $folder        = $cascade->getAsset( a\Folder::TYPE, "1e625a698b7f08ee4bf67273d923c647" );
    $blocks_folder = $cascade->getAsset( a\Folder::TYPE, $cascade_blocks_folder_name, $site_name );
    $block_ms      = $cascade->getAsset( a\MetadataSet::TYPE, $block_ms_name, $common_assets_site_name );
    $folder_ms     = $cascade->getAsset( a\MetadataSet::TYPE, $folder_ms_name, $common_assets_site_name );
    $ct            = $cascade->getAsset( a\ContentType::TYPE, $ct_name, $common_assets_site_name );
    
    // before running this script, back up the site first!!!
    
    $step = 2;

    switch( $step )
    {
        case 1: // associate blocks and folders with metadata sets
            $function_array = array(
                a\DataBlock::TYPE  => array( c\F::ASSOCIATE_WITH_METADATA_SET ),
                a\FeedBlock::TYPE  => array( c\F::ASSOCIATE_WITH_METADATA_SET ),
                a\IndexBlock::TYPE => array( c\F::ASSOCIATE_WITH_METADATA_SET ),
                a\TextBlock::TYPE  => array( c\F::ASSOCIATE_WITH_METADATA_SET ),
                a\Folder::TYPE     => array( c\F::ASSOCIATE_WITH_METADATA_SET )
            );
    
            $param_array = array(
                a\DataBlock::TYPE  => array( a\MetadataSet::TYPE => $block_ms ),
                a\FeedBlock::TYPE  => array( a\MetadataSet::TYPE => $block_ms ),
                a\IndexBlock::TYPE => array( a\MetadataSet::TYPE => $block_ms ),
                a\TextBlock::TYPE  => array( a\MetadataSet::TYPE => $block_ms ),
                a\Folder::TYPE     => array( a\MetadataSet::TYPE => $folder_ms ),
            );
            
            $base_folder->getAssetTree()->
                traverse( $function_array, $param_array );

            //$base_folder->setMetadataSet( $folder_ms )->dump( true );
            $base_folder->getMetadata()->setDisplayName( "Base Folder" )->
                getHostAsset()->edit();
    
            break;

        case 2: // switch content type and fix the metadata of normal pages
            //$base_folder->getAssetTree()->
            $folder->getAssetTree()->
                traverse( array( a\Page::TYPE => array( "assetTreeSwitchContentTypeForRWD" ) ),
                          array( "ct" => $ct )
                );
            
            break;
            
        case 3: // switch data definitions of two data blocks
            $js_dd_name = "Local JavaScript Picker";
            $js_dd      =
                $cascade->getAsset( a\DataDefinition::TYPE, $js_dd_name, $common_assets_site_name );
            $st         = new p\StructuredData( $js_dd->getStructuredData(), $service, $js_dd->getId() );
            
            $local_js_picker_name  = "_cascade/blocks/data/local-javascript-picker";
            $local_js_picker_block = 
                $cascade->getAsset( a\DataBlock::TYPE, $local_js_picker_name, $site_name );
            $local_js_picker_block->setStructuredData( $st );

            $css_dd_name = "Local Stylesheet";
            $css_dd      =
                $cascade->getAsset( a\DataDefinition::TYPE, $css_dd_name, $common_assets_site_name );
            $st          = new p\StructuredData( $css_dd->getStructuredData(), $service, $css_dd->getId() );
            $node_name   = "local-stylesheet-chooser";
            
            $local_stylesheet_name  = "_cascade/blocks/data/local-stylesheet";
            $local_stylesheet_block = 
                $cascade->getAsset( a\DataBlock::TYPE, $local_stylesheet_name, $site_name );
            
            $file_id = $local_stylesheet_block->getFileId( $node_name );
            
            if( isset( $file_id ) )
            {
                $css_file = $cascade->getAsset( a\File::TYPE, $file_id );
                $st->setFile( $node_name, $css_file );
            }
            $local_stylesheet_block->setStructuredData( $st );
                
            break;
            
        case 4: // config blocks
            $base_folder->getAssetTree()->
                traverse( array( a\DataBlock::TYPE => array( "assetTreeSwitchDataDefinitionForBlock" ) ),
                          array( "cascade" => $cascade )
                );

            break;
        case 5: // asset factories
            // retrieve asset factories
            $link_af   = $cascade->getAsset( a\AssetFactory::TYPE, "Upstate/New External Link", $site_name );
            $folder_af = $cascade->getAsset( a\AssetFactory::TYPE, "Upstate/New Folder", $site_name );
            $page_af   = $cascade->getAsset( a\AssetFactory::TYPE, "Upstate/New Page", $site_name );

            // retrieve base assets
            $link_ba   = $cascade->getAsset( a\Symlink::TYPE, "a08891a58b7f08ee0990fe6e15f24797" );
            $folder_ba = $cascade->getAsset( a\Folder::TYPE, "5f4525f08b7f08ee76b12c41610193f7" );
            $page_ba   = $cascade->getAsset( a\Page::TYPE, "5f4526348b7f08ee76b12c418985009e" );
            
            // set base assets
            $link_af->setBaseAsset( $link_ba )->edit();
            $folder_af->setBaseAsset( $folder_ba )->edit();
            $page_af->setBaseAsset( $page_ba )->edit();
            
            break;

/*            
        case 6: // switch content type and fix the metadata of article pages
            $articles_folder = $cascade->getAsset( a\Folder::TYPE, "articles", $site_name );
            $articles_folder->getAssetTree()->
                traverse( array( a\Page::TYPE => array( "assetTreeSwitchContentTypeForArticle" ) ),
                          array( "ct" => $ct )
                );
            
            break;
*/            
    
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}

function assetTreeSwitchContentTypeForRWD( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    $type = $child->getType();
    
    if( $type != a\Page::TYPE )
        return;
        
    $page        = $child->getAsset( $service );
    $cur_ct_name = $page->getContentType()->getName();
    
    if( $cur_ct_name != "RWD" )
        return;

    if( !isset( $params[ "ct" ] ) )
        throw new \Exception( "The content type is not supplied" );
    else
        $ct = $params[ "ct" ];

    $page->setContentType( $ct, false ); // false because identical dd
}

function assetTreeSwitchContentTypeForArticle( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    $type = $child->getType();
    
    if( $type != a\Page::TYPE )
        return;
        
    $page        = $child->getAsset( $service );
    $cur_ct_name = $page->getContentType()->getName();
    
    if( $cur_ct_name != "Article" )
        return;

    if( !isset( $params[ "ct" ] ) )
        throw new \Exception( "The content type is not supplied" );
    else
        $ct = $params[ "ct" ];

    $m    = $page->getMetadata();
    $categories = implode( $m->getDynamicFieldValues( "categories" ), "," );
    $categories = str_replace( "In the News", "news", $categories );
    $categories = str_replace( "Q and A", "qa", $categories );
    $categories = str_replace( "Case Studies", "case", $categories );
    $categories = str_replace( "Bioethics and the Law", "law", $categories );
    $categories = str_replace( "In Public Policy", "policy", $categories );
    $categories = str_replace( "Principles of Bioethics", "principles", $categories );

    $page->setContentType( $ct, false ); // false because identical dd
    $m = $page->getMetadata();
    $m->setTeaser( $categories );
    $page->edit();
}

function assetTreeSwitchDataDefinitionForBlock( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
{
    global $common_assets_site_name;
    
    $type = $child->getType();
    
    if( $type != a\DataBlock::TYPE )
        return;
        
    if( !isset( $params[ "cascade" ] ) )
        throw new \Exception( "The Cascade object is not supplied" );
    else
        $cascade = $params[ "cascade" ];
        
    $block  = $child->getAsset( $service );
    $b_name = $block->getName();
    
    if( $b_name ==  "_footer-contact" )
        $dd_name = "Footer Contact";
    elseif( $b_name == "_left-column" )
        $dd_name = "Left Column";
    elseif( $b_name == "_right-column" )
        $dd_name = "Right Column";
    elseif( $b_name == "_site-info" )
        $dd_name = "Site Info";
    else
        return;
            
    $dd          = $cascade->getAsset( a\DataDefinition::TYPE, $dd_name, $common_assets_site_name );
    $st          = new p\StructuredData( $dd->getStructuredData(), $service, $dd->getId() );
    $identifiers = $block->getIdentifiers();
    
    foreach( $identifiers as $identifier )
    {
        // create the correct number of instances for multiple field
        if( u\StringUtility::endsWith( $identifier, ";0" ) && $st->hasIdentifier( $identifier ) )
        {
            $st->createNInstancesForMultipleField( $block->getNumberOfSiblings( $identifier ), $identifier );
        }
        
        // map the data
        if( $st->hasNode( $identifier) && $block->isTextNode( $identifier ) )
        {
            $st->setText( $identifier, $block->getText( $identifier ) );
        }
        elseif( $st->hasNode( $identifier) && $block->isAssetNode( $identifier ) )
        {
            $asset_node_type = $block->getAssetNodeType( $identifier );
            
            if( $asset_node_type == "page" && $block->getPageId( $identifier ) != null )
            {
                $st->setPage( $identifier, $cascade->getPage( $block->getPageId( $identifier ) ) );
            }
            elseif( $asset_node_type == "file" && $block->getFileId( $identifier ) != null )
            {
                $st->setFile( $identifier, $cascade->getFile( $block->getFileId( $identifier ) ) );
            }
            elseif( $asset_node_type == "block" && $block->getBlockId( $identifier ) != null )
            {
                $st->setBlock( $identifier, a\Block::getBlock( $service, $block->getBlockId( $identifier ) ) );
            }
            elseif( $asset_node_type == "page,file,symlink" && $block->getLinkableId( $identifier ) != null )
            {
                $st->setLinkable( $identifier, a\Linkable::getLinkable( $service, $block->getLinkableId( $identifier ) ) );
            }
        }
    }
    
    $block->setStructuredData( $st );
}
?>