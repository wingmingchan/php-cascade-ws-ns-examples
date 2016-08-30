<?php 
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page_id = "824b63c68b7ffe830539acf09bc3135b";
    $page    = $cascade->getAsset( a\Page::TYPE, $page_id );
    
    $audits = $page->getAudits();
    //u\DebugUtility::dump( $audits );
    
    $audit0 = $audits[ 0 ];
    $audit1 = $audits[ 1 ];
    
    $audit0->display();
    $audit1->display();
    
    echo "Action: ", $audit0->getAction(), BR;
    echo "Audit asset: ", BR;
    u\DebugUtility::dump( $audit0->getAuditedAsset() );
    echo "Date: ", date_format( $audit0->getDate(), 'Y-m-d H:i:s' ), BR;
    
    echo "Identifier: ", BR;
    u\DebugUtility::dump( $audit0->getIdentifier() );
    
    echo "User: ", $audit0->getUser(), BR;
    
    u\DebugUtility::dump( $audit0->toStdClass() );
    
    echo a\Audit::compare( $audit0, $audit1 ), BR;
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Audit" );
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