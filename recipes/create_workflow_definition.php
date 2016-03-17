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
    $site_name     = 'web-service-tutorial';
    $wfd_name      = "Automatic Publish";
    $wfd           = $cascade->getWorkflowDefinition( $wfd_name, $site_name );
    $wfd_container = $cascade->getAsset( 
        a\WorkflowDefinitionContainer::TYPE, "/", $site_name );
    
    if( is_null( $wfd ) )
    {
        $wfd = $cascade->createWorkflowDefinition(
            $wfd_container, $wfd_name,
            a\WorkflowDefinition::NAMING_BEHAVIOR_AUTO,
            "<system-workflow-definition/>"
        )->
        setCopy( true )->
        setCreate( true )->
        setDelete( false )->
        setEdit( true )->
        edit();
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>