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
    $user_name_array = array();
    
    // maximally returns 250 users
    $search_for                            = a\AssetTemplate::getSearchInformation();
    $search_for->searchTerms               = "*";
    $search_for->searchTypes->searchType   = a\User::TYPE;
    $search_for->searchFields->searchField = "name";
    
    $service->search( $search_for );
    
    if ( $service->isSuccessful() )
    {
        if( !is_null( $service->getSearchMatches()->match ) )
        {
            $users = $service->getSearchMatches()->match;
    
            foreach( $users as $user )
            {
                $user_name_array[]  = $user->id;
            }
        }
    }
    u\DebugUtility::out( count( $user_name_array ) );
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