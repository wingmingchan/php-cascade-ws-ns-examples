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
    $site_name         = 'web-service-tutorial';
    $ct_container_name = 'Test Content Type Container';
    $ct_container      = $cascade->getContentTypeContainer( $ct_container_name, $site_name );
    
    if( is_null( $ct_container ) )
    {
        // create content type container
            $ct_container = $cascade->createContentTypeContainer(
                $cascade->getAsset( 
                    a\ContentTypeContainer::TYPE, '/', $site_name ),
                $ct_container_name
            );
    }
    
    $ct_name = 'Normal XHTML';
    $ct      = $cascade->getContentType( $ct_container_name . '/' . $ct_name, $site_name );
    
    if( is_null( $ct ) )
    {
        // create content type without data definition
        $cascade->createContentType(
            $ct_container,
            $ct_name,
            $cascade->getAsset( 
                a\PageConfigurationSet::TYPE, 
                'Test Configuration Set Container/Three Columns', $site_name ),
            $cascade->getAsset(
                a\MetadataSet::TYPE,
                'Test Metadata Set Container/Page', $site_name )
        );
    }
    
    $ct_name = 'Three Columns';
    $ct      = $cascade->getContentType( $ct_container_name . '/' . $ct_name, $site_name );
    
    if( is_null( $ct ) )
    {
        // create content type with a data definition
        $cascade->createContentType(
            $ct_container,
            $ct_name,
            $cascade->getAsset( 
                a\PageConfigurationSet::TYPE, 
                'Test Configuration Set Container/Three Columns', $site_name ),
            $cascade->getAsset(
                a\MetadataSet::TYPE,
                'Test Metadata Set Container/Page', $site_name ),
            $cascade->getAsset(
                a\DataDefinition::TYPE,
                'Test Data Definition Container/Page', $site_name )
        );
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