<?php
require_once( 'auth_soap_c8.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page = $admin->getAsset( a\Page::TYPE, "6c824e167f00000161e16fb034ee5a96" );
    u\DebugUtility::dump( $page->getIdentifiers() );
    
    // "post-wysiwyg-group;post-wysiwyg-group-chooser;0" is the FQI of the first instance
    // of a multiple field.
    // every time when this program is run, another node will be added.
    $page->appendSibling( "post-wysiwyg-group;post-wysiwyg-group-chooser;0" );
    u\DebugUtility::dump( $page->getIdentifiers() );
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