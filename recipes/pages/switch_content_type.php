<?php 
/*
This program shows how to change the associated content type.
Note that this program does not deal with data mapping, and
current data may disappear due to this fact.
See https://github.com/wingmingchan/php-cascade-ws-ns-examples/tree/master/recipes/data_mapping and https://github.com/wingmingchan/php-cascade-ws-ns-examples/blob/master/hr/switch_content_type.php for more details.
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
    
    // the targeted content type
    $ct = $cascade->getAsset( a\ContentType::TYPE, '1378b3e38b7f08ee1890c1e4df869132' );
    
    $page->setContentType( $ct );
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