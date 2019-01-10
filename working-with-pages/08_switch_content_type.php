<?php
/*
This program switches the content type associated with an XHTML page,
and turns the page to a page associated with a data definition.
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
    $page = $admin->getAsset( a\Page::TYPE, "2e1d4b828b7ffe837b9f2648062991c2" );
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
        $title = "A title is needed";
        $rest = $xhtml_string;
    }
    
    $ct = $admin->getAsset( a\ContentType::TYPE, "61885ed98b7ffe8377b637e8eabc34b0" );
    $page->setContentType( $ct );
    // "main-group;h1" and so on are FQIs referring to structured data nodes
    $page->setText( "main-group;h1", $title )->
           setText( "main-group;wysiwyg", $rest )->edit();
           
    // deal with page regions, when needed
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