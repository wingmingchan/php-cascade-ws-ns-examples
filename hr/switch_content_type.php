<?php
/*
This program is used to switch content type so that a non-responsive page is associated
with the new RWD One Region content type in _common_assets.
*/

$start_time = time();

require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'folder';

try
{
    u\DebugUtility::setTimeSpaceLimits();

    // base page, index of _rwd_seed, used to get the blank structured data
    $base_page = $cascade->getAsset( 
        a\Page::TYPE, 'a0d103118b7f08ee0990fe6e01cf509f' );
    
    // new content type RWD One Region
    $ct = $cascade->getAsset( 
        a\ContentType::TYPE, '1378b3e38b7f08ee1890c1e4df869132' );
        
    // the five site global blocks to be attached to each page
    $google_tag = $cascade->getAsset(
        a\TextBlock::TYPE,
        $base_page->getBlockId( "site-config-group;google-tag-manager" )
    );
    
    $site_storage = $cascade->getAsset(
        a\DataBlock::TYPE, 
        $base_page->getBlockId( "site-config-group;site-storage" )
    );
    
    $link_script = $cascade->getAsset(
        a\TextBlock::TYPE, 
        $base_page->getBlockId( "site-config-group;global-link-script" )
    );
    
    $page_title = $cascade->getAsset(
        a\TextBlock::TYPE, 
        $base_page->getBlockId( "site-config-group;page-title" )
    );
    
    $search_form = $cascade->getAsset(
        a\TextBlock::TYPE, 
        $base_page->getBlockId( "site-config-group;search-form" )
    );
        
    // two modes, convert one or more pages at a time,
    // or convert a folder at a time
    switch( $mode )
    {
        // use this to convert a page or a few pages at a time
        case 'page':
            $page_ids = array(
                '157ddb6d8b7f08ee3d99a2110e727e33',
                '',
            );

            foreach( $page_ids as $page_id )
            {
                if( $page_id == "" )
                    break; // break at the first empty string
                
                $child = new p\Child( $service->createId( a\Page::TYPE, $page_id ) );
                
                // call the global function directly
                assetTreeSwitchPageContentType( 
                    $service, $child, array( 
                        'ct'           => $ct, 
                        'bp'           => $base_page, 
                        'google-tag'   => $google_tag,
                        'site-storage' => $site_storage,
                        'link-script'  => $link_script,
                        'page-title'   => $page_title,
                        'search-form'  => $search_form,
                    ) );
            }
            break;
            
        // use this to convert pages in a folder
        case 'folder':
            // folder containing pages to convert
            $f  = $cascade->getAsset(
                a\Folder::TYPE, '157dd5ae8b7f08ee3d99a2114d277bef' );
    
            // traverse the folder
            $f->getAssetTree()->traverse(
                array( a\Page::TYPE => array( 'assetTreeSwitchPageContentType' ) ),
                array(
                    'ct' => $ct, 
                    'bp' => $base_page,
                    'google-tag'   => $google_tag,
                    'site-storage' => $site_storage,
                    'link-script'  => $link_script,
                    'page-title'   => $page_title,
                    'search-form'  => $search_form,
                    // pages to skip; use full path
                    'skip' => array( 
                        "_extra/news-feed" ) )
            );
            break;
    }
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
    u\DebugUtility::outputDuration( $start_time );
}

function assetTreeSwitchPageContentType( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, array $params=NULL, array &$results=NULL )
{
    if( $child->getType() != a\Page::TYPE )
        return;

    // make sure that there is a content type passed in
    if( !isset( $params[ 'ct' ] ) )
    {
        throw new \Exception( "No content type is supplied" );
    }
    
    // make sure that there is a base page passed in
    if( !isset( $params[ 'bp' ] ) )
    {
        throw new \Exception( "No base page is supplied" );
    }
    
    // make sure that there are global blocks passed in
    if( !isset( $params[ 'google-tag' ] ) ||
        !isset( $params[ 'site-storage' ] ) ||
        !isset( $params[ 'link-script' ] ) ||
        !isset( $params[ 'page-title' ] ) ||
        !isset( $params[ 'search-form' ] )
    )
    {
        throw new \Exception( "No global blocks are supplied" );
    }
    
    // pages to skip
    if( isset( $params[ 'skip' ] ) )
        $skip = $params[ 'skip' ];
        
    // skip whatever that is supposed to be skipped
    if( isset( $skip ) && is_array( $skip ) && in_array( $child->getPathPath(), $skip ) )
        return;
    
    // retrieve all required assets
    $ct    = $params[ 'ct' ];
    $bp    = $params[ 'bp' ];
    $google_tag   = $params[ 'google-tag' ];
    $site_storage = $params[ 'site-storage' ];
    $link_script  = $params[ 'link-script' ];
    $page_title   = $params[ 'page-title' ];
    $search_form  = $params[ 'search-form' ];
    
    // can run into phantom nodes
    try
    {
        // retrieve page to be processed
        $p = $child->getAsset( $service );

        // get number of content-group
        $identifier    = "content-group;0";
        $num_of_groups = 1;
    
        // get the number of instances of the multiple node
        if( $p->hasIdentifier( $identifier ) )
            $num_of_groups = $p->getNumberOfSiblings( $identifier );
    
        // get the current structured data with data
        $sd_old = $p->getStructuredData();
    
        if( !isset( $sd_old ) )
            return;
        
        // create enough instances of the multiple field
        if( $num_of_groups > 1 )
            $bp->createNInstancesForMultipleField( $num_of_groups, $identifier );

        // get the blank structured data with needed nodes
        $sd_new = clone $bp->getStructuredData();
    
        // roll back the base page
        if( $num_of_groups > 1 )
            $bp->createNInstancesForMultipleField( 1, $identifier );
    
        // switch the content type
        $p->setContentType( $ct, false );
    
        // fix the data
        if( u\StringUtility::endsWith( $p->getPath(), 'index' ) )
            $sd_new->setText( "right-column", "yes" );
        else
            $sd_new->setText( "right-column", "no" );
        
        $sd_new->setText( "left-column", "yes" );
        $sd_new->setText( "left-column-group;left-setup", "default" );
        
        // the H1
        echo "Title: ", $p->getMetadata()->getTitle(), BR;
    
        $title = ( $p->getMetadata()->getTitle() != "" ?
                       $p->getMetadata()->getTitle() : "Title to be set" );
    
        $sd_new->setText( 
            "main-content-title", $p->getMetadata()->getTitle() );
            
        // main WYSIWYG
        $sd_new->setText( 
            "main-content-content", $sd_old->getText( "main-content-content" ) );
    
        // multiple groups with choosers
        for( $i = 0; $i < $num_of_groups; $i++ )
        {
            $identifier = "content-group;" . $i . ";content-group-chooser";
        
            // null the id for the upcoming round
            $block_id = NULL;
        
            // read the block
            if( $sd_old->hasIdentifier( $identifier ) )
                $block_id = $sd_old->getBlockId( $identifier );
        
            // if there is a block attached
            if( isset( $block_id ) && $block_id != "" )
            {
                $b = a\Block::getBlock( $service, $block_id );
                $sd_new->setBlock( $identifier, $b );
            
                $identifier = "content-group;" . $i . ";content-group-size";
                $size_str   = strtolower( $sd_old->getText( $identifier ) );
                // fix the possible value for the new data definition
                if( $size_str != 'full' )
                    $size_str = 'half';
                $sd_new->setText( $identifier, $size_str );
        
                $identifier = "content-group;" . $i . 
                    ";content-group-block-floating";
                $sd_new->setText( 
                    $identifier, strtolower( $sd_old->getText( $identifier ) ) );
            }
        
            // WYSIWYGs in group
            $identifier = "content-group;" . $i . ";content-group-content";
            $sd_new->setText( $identifier, $sd_old->getText( $identifier ) );
        }
    
        // set the data
        $p->setStructuredData( $sd_new );
    }
    // fix phantom nodes
    catch( e\NoSuchFieldException $e )
    {
        $page_id      = $child->getId();
        $phantom_page = new a\PagePhantom( 
            $service, $service->createId( a\PagePhantom::TYPE, $page_id ) );
        $dd           = $phantom_page->getDataDefinition();
        $healthy_sd   = new p\StructuredData(
            $dd->getStructuredData(), $service, $dd->getId() );
        $phantom_sd   = $phantom_page->getStructuredDataPhantom();
        $healthy_sd   = $healthy_sd->removePhantomNodes( $phantom_sd );

        $phantom_page->setStructuredData( $healthy_sd );
    }
    
    // attach the five global blocks
    $p->setBlock(
            "site-config-group;google-tag-manager",
            $google_tag )->
        setBlock(
            "site-config-group;site-storage",
            $site_storage )->
        setBlock(
            "site-config-group;global-link-script",
            $link_script )->
        setBlock(
            "site-config-group;page-title",
            $page_title )->
        setBlock(
            "site-config-group;search-form",
            $search_form )->
        setBlock( // no block for this one
            "site-config-group;global-script" )->
        edit();
}
?>