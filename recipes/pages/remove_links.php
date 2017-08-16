<?php
/*
This program shows how to remove links from subscriber pages,
all pointing to a page to be deleted.
*/
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page = $cascade->getAsset( a\Page::TYPE, 
        "9a13bb338b7f08ee5d439b317e15c786" );
    $pattern = $page->getPath();
    
    if( substr( $pattern, 0, 1 ) != "/" )
    {
        $pattern = "/" . $pattern;
    }
    
    $pattern = str_replace( "/", "\/", $pattern );
    $pattern = "/<a href=['\"]" . $pattern . "['\"]>[^<]+<\/a>/";
    $subscribers = $page->getSubscribers();
    
    // remove the links
    foreach( $subscribers as $subscriber )
    {
        $subscriber_page = $subscriber->getAsset( $service );
        $subscriber_page->replaceByPattern( $pattern, "" )->edit();
    }
     
    // remove the page
    // $cascade->deletePage( $page );
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