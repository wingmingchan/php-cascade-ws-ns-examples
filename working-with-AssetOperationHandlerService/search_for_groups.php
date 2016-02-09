<?php
/*
At Upstate, we use site names for group names.
*/
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_names = array( "cru", "com", "medicine" );
    
    foreach( $site_names as $site )
    {
        $search_for               = new \stdClass();
        $search_for->matchType    = c\T::MATCH_ANY;
        $search_for->searchGroups = true;
        $search_for->assetName    = $site; // $site as group name
        
        $service->search( $search_for );

        // if succeeded
        if ( $service->isSuccessful() )
        {
            echo "<h2>Search Result for $site</h2>";

            if( is_null( $service->getSearchMatches()->match ) )
            {
                echo "No results<br />";
            }
            else
            {
                u\DebugUtility::dump( $service->getSearchMatches()->match );
            }
        }
        else
        {
            echo "Search failed.<br />";
            echo $service->getMessage();
        }
    }
    
    // search all groups
    $search_for               = new \stdClass();
    $search_for->matchType    = c\T::MATCH_ANY;
    $search_for->searchGroups = true;
    $search_for->assetName    = "*"; // the wild card
        
    $service->search( $search_for );
    
    // if succeeded
	if ( $service->isSuccessful() )
	{
		echo "<h2>Listing All Groups</h2>";

		if( is_null( $service->getSearchMatches()->match ) )
		{
			echo "No results<br />";
		}
		else
		{
			$groups = $service->getSearchMatches()->match;
			
			foreach( $groups as $group )
				echo $group->id, BR;
		}
	}
	else
	{
		echo "Search failed.<br />";
		echo $service->getMessage();
	}
}
catch( \Exception $e )
{
    echo $e;
}
?>