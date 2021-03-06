<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = 'web-service-test';
        
    // create content type container
    $parent = $cascade->createContentTypeContainer(
        $cascade->getAsset( 
            a\ContentTypeContainer::TYPE, '/', $site_name ),
        'Test Content Type Container'
    );
    
    // create content type without data definition
    $ct1 = $cascade->createContentType(
        $parent,
        'Normal XHTML',
        $cascade->getAsset( 
            a\PageConfigurationSet::TYPE, 
            'Test Configuration Set Container/Three Columns', $site_name ),
        $cascade->getAsset(
            a\MetadataSet::TYPE,
            'Test Metadata Set Container/Page', $site_name )
    );
    
    // create content type with data definition
    $ct2 = $cascade->createContentType(
        $parent,
        'Three Columns',
        $cascade->getAsset( 
            a\PageConfigurationSet::TYPE,
            'Test Configuration Set Container/Three Columns', $site_name ),
        $cascade->getAsset(
            a\MetadataSet::TYPE,
            'Test Metadata Set Container/Page', $site_name ),
        $cascade->getAsset(
            a\DataDefinition::TYPE,
            'Test Data Definition Container/WYSIWYG', $site_name )
    );
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