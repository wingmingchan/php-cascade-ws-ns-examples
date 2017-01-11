<?php
/*
This program is used to set up three workflow definitions with
three folders in an RWD site for automatic publishing.
*/
$start_time = time();

require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    u\DebugUtility::setTimeSpaceLimits();

    // retrieve all responsive sites
    // there is only one content type associated with RWD
    $ct    = $cascade->getAsset(
        a\ContentType::TYPE, "1378b3e38b7f08ee1890c1e4df869132" );
    $pages = $ct->getSubscribers();
    $rwd_sites = array();
    
    foreach( $pages as $page )
    {
        $site_name = $page->getPathSiteName();
        
        if( !in_array( $site_name, $rwd_sites ) )
            $rwd_sites[] = $site_name;
    }
    
    //u\DebugUtility::dump( $rwd_sites );
    //$rwd_sites = array( "cascade-admin" );
    
    $files  = "files";
    $images = "images";
    $pdf    = "pdf";
    
    // the three workflow definition in _common_assets
    $file_wfd_id  = "a0d9a8f18b7f08ee0990fe6e6359ba4b";
    $image_wfd_id = "8df491bd8b7f08ee03f6d9bbf01d5937";
    $pdf_wfd_id   = "8e0495b78b7f08ee03f6d9bbf84c9846";
    
    $file_wfd  = $cascade->getAsset( a\WorkflowDefinition::TYPE, $file_wfd_id );
    $image_wfd = $cascade->getAsset( a\WorkflowDefinition::TYPE, $image_wfd_id );
    $pdf_wfd   = $cascade->getAsset( a\WorkflowDefinition::TYPE, $pdf_wfd_id );
    
    foreach( $rwd_sites as $rwd_site )
    {
    	// retrieve the three folders in a site
        $files_folder  = $cascade->getFolder( $files, $rwd_site );
        $images_folder = $cascade->getFolder( $images, $rwd_site );
        $pdf_folder    = $cascade->getFolder( $pdf, $rwd_site );
        
        // check if a site has these folders
        $has_files  = ( $files_folder  != NULL );
        $has_images = ( $images_folder != NULL );
        $has_pdf    = ( $pdf_folder    != NULL );
    
        // if so, hook up the folders and workflow definitions
        if( $has_files )
        {
            setupWorkfow( $rwd_site, "Automatic File Publish",
                $files_folder, $file_wfd, $service, $cascade );
        }
        
        if( $has_images )
        {
            setupWorkfow( $rwd_site, "Automatic Image Publish",
                $images_folder, $image_wfd, $service, $cascade );
        }
        
        if( $has_pdf )
        {
            setupWorkfow( $rwd_site, "Automatic PDF Publish",
                $pdf_folder, $pdf_wfd, $service, $cascade );
        }
    }
    
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}

function setupWorkfow(
    string $site_name,
    string $ps_name,
    a\Folder $folder,
    a\WorkflowDefinition $wf_definition,
    aohs\AssetOperationHandlerService $service,
    a\Cascade $cascade
)
{
    $site_ps = $cascade->getPublishSet( $ps_name );
    
    // if no publish set, create it
    if( is_null( $site_ps ) )
    {
        $site_ps = $cascade->createPublishSet(
            $cascade->getSite( $site_name )->getRootPublishSetContainer(),
            $ps_name );
        $site_ps->addFolder( $folder )->edit();
    }

    $wfs = $folder->getWorkflowSettings();
    $wfs->setRequireWorkflow( true );
    
    $wfds = $wfs->getWorkflowDefinitions();
    
    // remove all other workflow definitions
    foreach( $wfds as $wfd )
    {
        if( $wfd->getId() != $wf_definition->getId() )
        {
            $wfs->removeWorkflowDefinition(
                $wfd->getAsset( $service )
            );
        }
    }
    
    // hook up the right workflow definition
    if( !$wfs->hasWorkflowDefinition( $wf_definition->getId() ) )
    {
        $wfs->addWorkflowDefinition( $wf_definition );
        $folder->editWorkflowSettings( false, true );
    }
}

/*
"_rwd_seed"
"about-rwd-dev"
"accelerator"
"advocates"
"autismstudy"
"bariatric"
"bioinbrief"
"cancer"
"cascade-admin"
"cascade-admin-old"
"cascade-database"
"cascade-training"
"cghats"
"dummy1"
"dummy2"
"engage"
"foil"
"gch-dev"
"healthcare"
"homepage"
"hospital-dev"
"hr-dev"
"hrintra-dev"
"library-dev"
"media"
"news-dev"
"nursing"
"parkinsonstudy"
"roomcal"
"strategicplan"
"stroke"
"students-dev"
"teamupstate"
"thomas-test"
"training-rwd"
}
*/
?>