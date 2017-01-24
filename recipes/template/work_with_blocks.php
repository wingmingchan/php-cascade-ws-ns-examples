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
        a\Template::TYPE, "1f240ae68b7ffe834c5fe91eea20ec68" );
        
    // test if a block is attached to a region
    $block = $template->getPageRegionBlock( "DEFAULT" );
    
    // if not, attach a block
    if( !$block )
    {
    	$block = $cascade->getAsset(
        	a\IndexBlock::TYPE, "fd2784aa8b7f08560159f3f03da5653d" );
    	$template->setPageRegionBlock( 'DEFAULT', $block )->edit();
    	
    	// detach the block
    	// $template->setPageRegionBlock( 'DEFAULT' )->edit();
    }
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