<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $dd = $admin->getAsset( a\DataDefinition::TYPE, "19bd88fa8b7f08ee0729650f1be71e04" );
    $blockIds = $dd->getSubscribers();
    //$tag = "myTag";
    $tag = "myAnotherTag";
    
    foreach( $blockIds as $id )
    {
        $block = $id->getAsset( $service );
        $block->addTag( $tag )->edit();
        u\DebugUtility::dump( $block->getTags() );
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