<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'set';
//$mode = 'inline';
//$mode = 'raw';

try
{
    $id = "9e1948fe8b7f08560053896c9a9a5071"; // article_old
    $ct  = $cascade->getAsset( a\ContentType::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $ct->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $ct->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "ID: " . $ct->getId() . BR;
            echo "Dumping names of contentTypePageConfigurations: " . BR;
            echo S_PRE;
            var_dump( $ct->getContentTypePageConfigurationNames() );
            echo E_PRE;
            
            $ct->getConfigurationSet()->dump( true );
            
            $ct->getDataDefinition()->dump( true );
            
            echo "Inline editable field names", BR;
            u\DebugUtility::dump( $ct->getInlineEditableFieldNames() );
            
            $ct->getMetadataSet()->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'set':
            $config_name = 'Printer';
            
            if( $ct->hasPageConfiguration( $config_name ) )
            {
                $ct->setPublishMode( 
                    $config_name, 
                    a\ContentType::PUBLISH_MODE_ALL_DESTINATIONS )->
                    edit();
            }

            if( $mode != 'all' )
                break;

        case 'inline':
            echo S_PRE;
            var_dump( $ct->getInlineEditableFieldNames() );
            echo E_PRE;
        
            $config_name = 'Desktop';
            $region_name = 'DEFAULT';
            $group_path  = 'NULL';
            $type        = c\T::WIRED_METADATA;
            $name        = a\ContentType::SUMMARY;
            
            if( $ct->hasRegion( $config_name, $region_name ) )
            {
                echo "The region $config_name, $region_name is found" . BR;
            }

            // wired field
            $field_name = $config_name . a\DataDefinition::DELIMITER .
                          $region_name . a\DataDefinition::DELIMITER .
                          $group_path . a\DataDefinition::DELIMITER .
                          $type . a\DataDefinition::DELIMITER . $name;
            
            if( $ct->hasInlineEditableField( $field_name ) )
            {
                echo "The field is found. Now removing it:" . BR;
                $ct->removeInlineEditableField( $field_name )->edit();
            }
            else
            {
                echo "The field does not exist. Now adding it:" . BR;
                $ct->addInlineEditableField( 
                    $config_name, $region_name, $group_path, 
                    $type, $name )->edit();
            }
         
            // dynamic field
            $config_name = 'Desktop';
            $region_name = 'DEFAULT';
            $group_path  = 'NULL';
            $type        = c\T::DYNAMIC_METADATA;
            $name        = "languages";
            
            if( $ct->hasRegion( $config_name, $region_name ) )
            {
                echo "The region $config_name, $region_name is found" . BR;
            }
            
            $field_name = $config_name . a\DataDefinition::DELIMITER .
                          $region_name . a\DataDefinition::DELIMITER .
                          $group_path . a\DataDefinition::DELIMITER .
                          $type . a\DataDefinition::DELIMITER . $name;
            
            if( $ct->hasInlineEditableField( $field_name ) )
            {
                echo "The field is found. Now removing it:" . BR;
                $ct->removeInlineEditableField( $field_name )->edit();
            }
            else
            {
                echo "The field does not exist. Now adding it:" . BR;
                $ct->addInlineEditableField( 
                    $config_name, $region_name, $group_path, 
                    $type, $name )->edit();
            }
            
/*            
            echo S_PRE;
            var_dump( $ct->getInlineEditableFieldNames() );
            echo E_PRE;
            
            //$ct->dump( true );
*/
            if( $mode != 'all' )
                break;

        case 'raw':
            $ct = $service->retrieve( $service->createId( 
                c\T::CONTENTTYPE, $id ), c\P::CONTENTTYPE );
            echo S_PRE;
            var_dump( $ct );
            echo E_PRE;
        
            if( $mode != 'all' )
                break;
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>
