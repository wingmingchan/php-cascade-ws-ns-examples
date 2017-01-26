<?php 
/*
This program shows how to attach blocks to a block choosers.
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page = $cascade->getAsset( a\Page::TYPE, '2a47653d8b7f08ee3c48c4e996f9054a' );

    // the four site-config blocks
    $site_storage = $cascade->getAsset( 
        a\DataBlock::TYPE, 'ea51caec8b7f08ee1c99f4958efb7698' );
    $link_script  = $cascade->getAsset( 
        a\TextBlock::TYPE, '13618dd38b7f08ee1890c1e411561de0' );
    $page_title   = $cascade->getAsset( 
        a\TextBlock::TYPE, '1368bba28b7f08ee1890c1e497d5ae69' );
    $search_form  = $cascade->getAsset( 
        a\TextBlock::TYPE, '136974b98b7f08ee1890c1e42b059915' );
    
    // set the blocks
    $page->setBlock( "site-config-group;site-storage",       $site_storage )->
           setBlock( "site-config-group;global-link-script", $link_script )->
           setBlock( "site-config-group;page-title",         $page_title )->
           setBlock( "site-config-group;search-form",        $search_form )->
        edit();
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