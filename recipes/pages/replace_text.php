<?php
/*
This program shows how to replace a string with another string.
Note that this assumes a case-sensitive string match.
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
    $site_name = "cascade-admin-old";
    $page_name = "test/velocity/dummy-page";
    $page      = $cascade->getAsset( a\Page::TYPE, $page_name, $site_name );
    $node_ids  = $page->getIdentifiers(); // the fully qualified identifiers
    
    foreach( $node_ids as $id )
    {
        if( $page->isWYSIWYG( $id ) ) // only modify text in WYSIWYG's
        {
        	echo $id, BR;
            $page->replaceText( 
                "http://web.upstate.edu", // search
                "http://www.upstate.edu", // replacement
                array( $id )              // apply to this id only
            );
        }
    }
    $page->edit();
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