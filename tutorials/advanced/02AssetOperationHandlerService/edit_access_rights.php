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
    $path = "_cascade/blocks/code/text-block";
    $service->readAccessRights( 
        $service->createId( a\TextBlock::TYPE, $path, "cascade-admin" ) );

    if($service->isSuccessful())
    {
        echo "Read successfully<br />";
        
        $accessRightInfo = $service->getReadAccessRightInformation();
        $aclEntries      = $accessRightInfo->aclEntries->aclEntry;
        
        var_dump( $accessRightInfo );
        
        if( !isset( $aclEntries ) ) // nothing
        {
            $aclEntries = array();
        }
        else if( !is_array( $aclEntries ) ) // just one object
        {
            $aclEntries = array( $aclEntries );
        }
        
        $access_type = c\T::USER;
        $name        = 'tuw';
        
        // remove the entry if it exists
        cleanUpNameFromACLEntries( $aclEntries, $name );
        
        $entry = new \stdClass();
        $entry->level = 'write';
        $entry->type  = $access_type;
        $entry->name  = $name;
        // add the entry
        $aclEntries[] = $entry;
            
        $accessRightInfo->aclEntries->aclEntry = $aclEntries;
        
        // false: do not apply to children
        $service->editAccessRights( $accessRightInfo, false ); 
        
        if($service->isSuccessful() )
        {
            echo "Edited access successfully.";
        }
        else
        {
            echo "Failed to edit access rights. " . 
                $service->getLastRequest();
        }
    }
    else
    {
        echo "Failed to read. " . $service->getMessage();
    }
}
catch( \Exception $e )
{
    echo S_PRE, $e, E_PRE;
}
catch( \Error $er )
{
    echo S_PRE, $er, E_PRE;
}

function cleanUpNameFromACLEntries( &$aclEntries, $name )
{
    $newAclEntries = array();
    
    // only keep other entries, excluding entries containing this $type AND $name
    foreach( $aclEntries as $aclEntry )
    {
        if( $aclEntry->name != $name )
        {
            $newAclEntries[] = $aclEntry ;
        }
    }
    
    $aclEntries = $newAclEntries;
}
?>