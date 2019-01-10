<?php
/*
This program reads the XHMTL markups of an XHTML page,
and process the contents.
*/

require_once( 'auth_soap_c8.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page = $admin->getAsset( a\Page::TYPE, "3835013fac1e001b4d6de175536bf52f" );
    $xhtml_string = $page->getXhtml();
    
    if( preg_match( '/\<h1\>(.*)\<\/h1\>/', $xhtml_string, $matches ) )
    {
        //u\DebugUtility::dump( $matches );
        // get the title with <h1>
        $title = $matches[ 1 ];
        // contents minus <h1>
        $rest  = str_replace( $matches[ 0 ], '', $xhtml_string );
    }
    else
    {
        $rest = $xhtml_string;
    }
    echo $rest;
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