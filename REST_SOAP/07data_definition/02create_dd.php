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
    $site_name = "about-test";
    $ddc_name  = "Test DD Container";
    $dd_name   = "Page";
    
    $dd = $cascade->getDataDefinition( "$ddc_name/$dd_name", $site_name );
    
    if( isset( $dd ) )
    {
        $cascade->deleteAsset( $dd );
    }
    
        $xml = '
<system-data-structure>
    <group identifier="main-group" label="Main Content">
        <asset identifier="mul-pre-h1-chooser" label="Above-the-H1 Blocks" multiple="true" render-content-depth="5" type="block"/>
        <text identifier="h1" label="H1 Page Title" required="true"/>
        <asset identifier="mul-post-h1-chooser" label="Pre-content Blocks" multiple="true" render-content-depth="5" type="block"/>
        <text identifier="float-pre-content-blocks-around-wysiwyg-content" label="Float Content around Pre-content Blocks?" type="checkbox">
            <checkbox-item value="yes"/>
        </text>
        <text identifier="wysiwyg" label="Content" wysiwyg="true"/>
        <asset identifier="mul-post-wysiwyg-chooser" label="Content Blocks" multiple="true" render-content-depth="5" type="block"/>
    </group>
</system-data-structure>';
    
    $dd = $cascade->createDataDefinition(
        $cascade->getAsset( a\DataDefinitionContainer::TYPE, $ddc_name, $site_name ),
        $dd_name,
        $xml
    )->dump();
    
    u\DebugUtility::dumpRESTCommands( $service );    
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