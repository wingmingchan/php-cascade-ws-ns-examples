<?php
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page     = $cascade->getAsset( a\Page::TYPE, '1f22b0c88b7ffe834c5fe91e752964c7' );
    $metadata = $page->getMetadata();
    
    /* wired fields */
    $metadata->setDisplayName( "New Display Name" )->
        setStartDate( "2017-01-20T00:00:00" );
    
    $page->edit();
    
    /* dynamic fields */
    $field_name = "include-in-menubar";
    $yes_value  = "Yes";
    
    // if value exist, set the value
    if( $metadata->hasDynamicField( $field_name ) )
    {
        // retrieve possible values of a field definition
        $possible_values = $metadata->getDynamicFieldPossibleValues( $field_name );
        
        if( in_array( $yes_value, $possible_values ) )
        {
            $metadata->setDynamicField( $field_name, $yes_value );
        }
    }
    
    // too lazy to do any tests; exception can be thrown
    $field_name = "exclude-from-left";
    $metadata->
        // uncheck the checkbox
        setDynamicField( $field_name, "" )->getHostAsset()->edit();
    
    // dump the array
    // array( NULL )
    u\DebugUtility::dump( $metadata->getDynamicFieldValues( $field_name ) );
    
    $page->dump();
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