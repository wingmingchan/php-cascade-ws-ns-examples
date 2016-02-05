<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page_id = "980d85f48b7f0856015997e492c9b83b";
    
    $audit_params = new \stdClass();
    $audit_params->identifier = $service->createId( a\Page::TYPE, $page_id );
    $audit_params->auditType  = c\T::EDIT;
    
    $service->readAudits( $audit_params );
    
    if( $service->isSuccessful() )
    {
        echo "Read audits successfully<br />";
        u\DebugUtility::dump( $service->getAudits() );
    }
    else
    {
        echo "Failed to read audits. " . $service->getMessage();
    }
}
catch( \Exception $e )
{
    echo $e;
}
?>