<?php
/*
This program shows how to work with plugins.
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
    $af = $cascade->getAsset(
        a\AssetFactory::TYPE, "3789d97c8b7f08ee2347507a23b55569" ); //->dump();
    
    // change the parameter values of a plugin    
    if( $af->hasPlugin( a\AssetFactory::IMAGE_RESIZER_PLUGIN ) )
    {
        $resize_plugin = $af->getPlugin( a\AssetFactory::IMAGE_RESIZER_PLUGIN );
        
        if( $resize_plugin->hasParameter( a\AssetFactory::IMAGE_RESIZER_PARAM_HEIGHT ) )
        {
            $resize_plugin->setParameterValue(
                    a\AssetFactory::IMAGE_RESIZER_PARAM_HEIGHT, "120" )->
                setParameterValue( a\AssetFactory::IMAGE_RESIZER_PARAM_WIDTH, "90" );
            $af->edit();
        }
    }
    
    // remove a parameter
    if( $af->hasPlugin( a\AssetFactory::FILE_LIMIT_PLUGIN ) )
    {
        $file_limit_plugin = $af->getPlugin( a\AssetFactory::FILE_LIMIT_PLUGIN );
        
        if( $file_limit_plugin->hasParameter( a\AssetFactory::FILE_LIMIT_PARAM_SIZE ) )
        {
            $file_limit_plugin->removeParameter( a\AssetFactory::FILE_LIMIT_PARAM_SIZE );
            $af->edit();
        }
    }
    
    // add the parameter back, and assign it a new value
    if( $af->hasPlugin( a\AssetFactory::FILE_LIMIT_PLUGIN ) )
    {
        $file_limit_plugin = $af->getPlugin( a\AssetFactory::FILE_LIMIT_PLUGIN );
        
        if( !$file_limit_plugin->hasParameter( a\AssetFactory::FILE_LIMIT_PARAM_SIZE ) )
        {
            $file_limit_plugin->addParameter(
                a\AssetFactory::FILE_LIMIT_PARAM_SIZE, "15" );
            
            $af->edit()->dump();
        }
    }
    
    // add a plugin
    if( !$af->hasPlugin( a\AssetFactory::SET_START_DATE_PLUGIN ) )
    {
        $af->addPlugin( a\AssetFactory::SET_START_DATE_PLUGIN )->edit();
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