<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name    = 'web-service-test';
    $base_folder  = 
        $cascade->getAsset( a\Site::TYPE, $site_name )->getBaseFolder();
    $block_folder =
        $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
    
    // create workflow definition container
    $parent = $cascade->createWorkflowDefinitionContainer(
        $cascade->getAsset( 
            a\WorkflowDefinitionContainer::TYPE, '/', $site_name ),
            'Test Workflow Definition Container'
        );
    
    $xml = "<system-workflow-definition name='Automatic File Publish' initial-step='initialize'>
  <triggers>
    <trigger name='AssignStepIfUser' class='com.cms.workflow.function.AssignStepIfUser'/>
    <trigger name='AssignToGroupOwningAsset' class='com.cms.workflow.function.AssignToGroupOwningAsset'/>
    <trigger name='AssignToSpecifiedGroup' class='com.cms.workflow.function.AssignToSpecifiedGroup'/>
    <trigger name='AssignToWorkflowOwner' class='com.cms.workflow.function.AssignToWorkflowOwner'/>
    <trigger name='CopyFolder' class='com.cms.workflow.function.CopyFolder'/>
    <trigger name='com.cms.workflow.function.CreateNewWorkflowTrigger' class='com.cms.workflow.function.CreateNewWorkflowTrigger'/>
    <trigger name='Delete' class='com.cms.workflow.function.Delete'/>
    <trigger name='UnpublishAndDelete' class='com.cms.workflow.function.DeleteAndUnpublish'/>
    <trigger name='DeleteParentFolder' class='com.cms.workflow.function.DeleteParentFolderTrigger'/>
    <trigger name='Email' class='com.cms.workflow.function.EmailProvider'/>
    <trigger name='Merge' class='com.cms.workflow.function.Merge'/>
    <trigger name='PreserveCurrentUser' class='com.cms.workflow.function.PreserveCurrentUser'/>
    <trigger name='PublishContainingPublishSet' class='com.cms.workflow.function.PublishContainingPublishSetTrigger'/>
    <trigger name='PublishParentFolder' class='com.cms.workflow.function.PublishParentFolderTrigger'/>
    <trigger name='PublishSet' class='com.cms.workflow.function.PublishSetTrigger'/>
    <trigger name='Publish' class='com.cms.workflow.function.Publisher'/>
    <trigger name='Version' class='com.cms.workflow.function.Version'/>
    <trigger name='CreateNewWorkflow' class='com.cms.workflow.function.CreateNewWorkflowsTrigger'/>
  </triggers>
  <steps>
    <step type='system' identifier='initialize' label='Initialization'>
      <actions>
        <action identifier='save-and-publish' label='Save and publish' move='forward'>
          <trigger name='Merge'/>
          <trigger name='PublishSet'>
            <parameter>
              <name>name</name>
              <value>Automatic File Publish</value>
            </parameter>
          </trigger>
        </action>
      </actions>
    </step>
    <step type='system' identifier='finished' label='Finished'/>
  </steps>
  <non-ordered-steps/>
</system-workflow-definition>";
    
    // create workflow definition
    $wd = 
        $cascade->createWorkflowDefinition(
            $parent,
            'Automatic File Publish',
            a\WorkflowDefinition::NAMING_BEHAVIOR_AUTO, // naming behavior
            $xml
        )->
        setCopy( true )->
        setCreate( false )->
        setDelete( false )->
        setEdit( true )->
        edit();
        
    // create a feed block
    $fb =
        $cascade->createFeedBlock(
            $block_folder,
            'upstate-news',
            'http://web.upstate.edu/feed/?title=news'
        );
        
    // create a publish set container
    $parent = $cascade->createPublishSetContainer(
        $cascade->getAsset( 
            a\PublishSetContainer::TYPE, '/', $site_name ),
            'Test Publish Set Container'
        );
        
    // create a publish set
    $ps = 
        $cascade->
            createPublishSet(
                $parent,
                   'Test Publish Set'
            )->
            addFolder( $base_folder )->
            edit();
            
    // create a database transport
    $db_transport =
        $cascade->createDatabaseTransport(
            $cascade->getAsset( 
                a\TransportContainer::TYPE, 'Test Transport Container', $site_name ),
            'DB Transport',
            'upstate',       // server
            '123',           // port
            'test',          // username
            'cascade',       // database name
            'unknown'        // transport site id
        );
        
    // create a file system transport
    $fs_transport =
        $cascade->createFileSystemTransport(
            $cascade->getAsset( 
                a\TransportContainer::TYPE, 'Test Transport Container', $site_name ),
            'FS Transport',
            'test'          // directory
        );
    
    // create a connector container
    $parent = $cascade->createConnectorContainer(
        $cascade->getAsset( 
            a\ConnectorContainer::TYPE, '/', $site_name ),
            'Test Connector Container'
        );
        
    // create a google analytics connector
    $g_connector = $cascade->createGoogleAnalyticsConnector(
        $parent,
        'analytics',
        '123456'
    );
    
    // create a twitter connector
    $t_connector = $cascade->createTwitterConnector(
        $parent,
        'twitter',
        $cascade->getAsset( 
            a\Destination::TYPE, 
            'Test Destination Container/Web-Service-Test-Web', $site_name ),
        'H',  // hash tag
        't',  // prefix
        $cascade->getAsset( 
            a\ContentType::TYPE, 
            'Test Content Type Container/Three Columns', $site_name ),
        'Desktop' // configuration
    );
   
    // create a wordpress connector
    $t_connector = $cascade->createWordPressConnector(
        $parent,
        'wordpress',
        'www.upstate.edu',
        $cascade->getAsset( 
            a\ContentType::TYPE, 
            'Test Content Type Container/Three Columns', $site_name ),
        'Desktop' // configuration
    );
    
    // create a symlink
    $cascade->createSymlink( 
        $cascade->getAsset( a\Folder::TYPE, '/', $site_name ), // parent folder
        "google",                                              // symlink name
        "http://www.google.com"                                // url
    )->dump( true );
    
    // create a reference
    $cascade->createReference( 
        $cascade->getAsset( a\Page::TYPE, 'test', $site_name ), // asset to be referenced
        $cascade->getAsset( a\Folder::TYPE, '/', $site_name ),  // parent folder
        "test-ref"                                              // reference name
    )->dump( true );
    
    // create an XML block
    $cascade->createXmlBlock( 
        $block_folder,  // parent folder
        'test-xml',     // block name
        "<test/>"       // xml content
    )->dump( true );
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