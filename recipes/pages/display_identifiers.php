<?php 
/*
This program shows how to display all fully qualified identifiers
in the structured data of a page. These identifiers are used
to access individual nodes. We can also use a foreach loop to
loop through them.
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
    $page_name = "test/new-page";
    $page      = $cascade->getAsset( a\Page::TYPE, $page_name, $site_name );
    
    // show all fully qualified identifiers
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
/*
What is diplayed:

array(25) {
  [0]=>
  string(11) "left-column"
  [1]=>
  string(17) "left-column-group"
  [2]=>
  string(28) "left-column-group;left-setup"
  [3]=>
  string(41) "left-column-group;customized-left-group;0"
  [4]=>
  string(71) "left-column-group;customized-left-group;0;customized-left-block-chooser"
  [5]=>
  string(12) "right-column"
  [6]=>
  string(13) "center-banner"
  [7]=>
  string(18) "main-content-title"
  [8]=>
  string(18) "post-title-chooser"
  [9]=>
  string(4) "size"
  [10]=>
  string(20) "main-content-content"
  [11]=>
  string(15) "content-group;0"
  [12]=>
  string(37) "content-group;0;content-group-chooser"
  [13]=>
  string(34) "content-group;0;content-group-size"
  [14]=>
  string(44) "content-group;0;content-group-block-floating"
  [15]=>
  string(37) "content-group;0;content-group-content"
  [16]=>
  string(4) "rows"
  [17]=>
  string(12) "rows-group;0"
  [18]=>
  string(28) "rows-group;0;columns-group;0"
  [19]=>
  string(42) "rows-group;0;columns-group;0;column-header"
  [20]=>
  string(41) "rows-group;0;columns-group;0;column-block"
  [21]=>
  string(18) "right-column-group"
  [22]=>
  string(30) "right-column-group;right-setup"
  [23]=>
  string(43) "right-column-group;customized-right-group;0"
  [24]=>
  string(74) "right-column-group;customized-right-group;0;customized-right-block-chooser"
}
*/
?>