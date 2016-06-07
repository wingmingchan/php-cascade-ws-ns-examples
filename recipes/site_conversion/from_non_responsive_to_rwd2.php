<?php
/*
This program is used to convert a site, from non-responsive to RWD2.
*/
$start_time = time();

require_once('cascade_ws_ns/auth_chanw.php');

// to prevent time-out
set_time_limit( 10000 );
// to prevent using up memory when traversing a large site
ini_set( 'memory_limit', '2048M' );

$mode = 'page';
//$mode = 'folder';

require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_AOHS      as aohs;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    
    // to prevent time-out
    set_time_limit ( 10000 );
    // to prevent using up memory when traversing a large site
    ini_set( 'memory_limit', '2048M' );

    // base page, index of _rwd_seed, used to get the blank structured data
    $base_page = $cascade->getAsset( 
        a\Page::TYPE, 'a0d103118b7f08ee0990fe6e01cf509f' );
    
    // new content type RWD
    $ct = $cascade->getAsset( 
        a\ContentType::TYPE, '1378b3e38b7f08ee1890c1e4df869132' );
    
    switch( $mode )
    {
        // use this to convert a page or a few pages at a time
        case 'page':
            $page_ids = array(
                'be4cb7a98b7f08ee7691912da1217d7a',
                '',
                '',
                '',
                '',
            );
    
            foreach( $page_ids as $page_id )
            {
                if( $page_id == "" )
                    break; // break at the first empty string
                
                $child = new p\Child( $service->createId( a\Page::TYPE, $page_id ) );
                assetTreeSwitchPageContentType( 
                    $service, $child, array( 
                        'ct' => $ct, 'bp' => $base_page ) );
            }
            break;
            
        // use this to convert pages in a folder
        case 'folder':
            // folder containing pages to modify
            $f  = $cascade->getAsset(
                a\Folder::TYPE, '8dfe13248b7f085600ebf23e015c562a' );
    
            // traverse the folder
            $f->getAssetTree()->traverse(
                array( a\Page::TYPE => array( 'assetTreeSwitchPageContentType' ) ),
                array( 'ct' => $ct, 'bp' => $base_page,
                    // pages to skip; use full path
                    'skip' => array( 
                        "_extra/news-feed" ) )
            );
            break;
    }
    $end_time = time();
    echo BR . "Total time taken: " . ( $end_time - $start_time ) . " seconds" . BR;

}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
    $end_time = time();
    echo BR . "Total time taken: " . ( $end_time - $start_time ) . " seconds" . BR;
}

function assetTreeSwitchPageContentType( 
    aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
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
    
    // pages to skip
    if( isset( $params[ 'skip' ] ) )
        $skip = $params[ 'skip' ];
        
    if( isset( $skip ) && is_array( $skip ) && in_array( $child->getPathPath(), $skip ) )
        return;
    
    $ct = $params[ 'ct' ];
    $bp = $params[ 'bp' ];
    
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
    if( u\StringUtility::endsWith( $child->getPathPath(), 'index' ) )
        $sd_new->setText( "right-column", "yes" );
    else
        $sd_new->setText( "right-column", "no" );
        
    $sd_new->setText( "left-column", "yes" );
    $sd_new->setText( "left-column-group;left-setup", "default" );
    // the H1
    $sd_new->setText( 
        "main-content-title", $sd_old->getText( "main-content-title" ) );
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
?>