<?php
require_once('cascade_ws_ns/auth_chanw.php');
    
use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$option = 5;

try
{
    switch( $option )
    {
        case 1:
            // search using all
            $results = $cascade->searchForAll(
                'index',
                'Cascade',
                'Cascade',
                c\S::SEARCHPAGES
            );
            echo S_PRE;
            foreach( $results as $result )
                u\DebugUtility::dump( $result->toStdClass() );
            echo E_PRE;            
            break;
            
        case 2:
            // search using any and name, at most 250 results
            $results = $cascade->searchForAssetName(
                'index',
                c\S::SEARCHPAGES
            );
            
            echo S_PRE;
            foreach( $results as $result )
                u\DebugUtility::dump( $result->toStdClass() );
            echo E_PRE;
            break;
            
        case 3:
            // search using any and content, at most 250 results
            $results = $cascade->searchForAssetContent(
                'Cascade',
                c\S::SEARCHPAGES
            );
            
            echo S_PRE;
            foreach( $results as $result )
                u\DebugUtility::dump( $result->toStdClass() );
            echo E_PRE;
            break;
            
        case 4:
            // search using any and metadata, at most 250 results
            $results = $cascade->searchForAssetMetadata(
                'Cascade',
                c\S::SEARCHPAGES
            );
            echo S_PRE;
            foreach( $results as $result )
                u\DebugUtility::dump( $result->toStdClass() );
            echo E_PRE;

            break;
            
        case 5:
            // search using any and name and wild-card, at most 250 results
            echo S_PRE;
            $results = $cascade->searchForAssetName(
                '*',
                c\S::SEARCHGROUPS
            );
            foreach( $results as $result )
                u\DebugUtility::dump( $result->toStdClass() );
            echo E_PRE;
            break;
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>