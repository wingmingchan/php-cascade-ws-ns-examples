<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset         as a;
use cascade_ws_property    as p;
use cascade_ws_utility     as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'set';
//$mode = 'raw';
//$mode = 'search';

try
{
    $id = '1f21fb798b7ffe834c5fe91e7f6d784f'; // all fields
    //$id = '7c3e95948b7ffe3b01bcfced5623d747'; // audio in sandbox
    
    $dd_block = $cascade->getAsset( a\DataDefinitionBlock::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $dd_block->displayDataDefinition()->display();
             
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $dd_block->dump();
            
            if( $mode != 'all' )
                break;

        case 'get':
            //u\DebugUtility::dump( $dd_block->getStructuredData()->toStdClass() );
            u\DebugUtility::dump( $dd_block->getStructuredData()->getIdentifiers() );
            
            $node_name = 'test-symlink';
            
            if( $dd_block->hasNode( $node_name ) )
            {
                    echo $dd_block->getNodeType( $node_name );
            }
            
            if( $mode != 'all' )
                break;
            
        case 'set':
            $test_field = 'all-fields';
            $test_field = 'text';
            $test_field = 'datetime';
            $test_field = 'wysiwyg';
            $test_field = 'single-checkbox';
            $test_field = 'dropdown';
            $test_field = 'multiple-checkbox';
            $test_field = 'radio';
            $test_field = 'calendar';
            $test_field = 'multi-select';
            $test_field = 'file';
            $test_field = 'block';
            $test_field = 'page';
            $test_field = 'symlink';
            //$test_field = 'linkable';

            switch( $test_field )
            {
                case 'all-fields':
                case 'text':
                    $field_name = 'test-text1';
            
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        $dd_block->setText( $field_name, 
                            'New text for test-text1' )->
                            edit();
                        $text_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                        echo $text_node->getText() . BR;
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }

                    if( $test_field != 'all-fields' )
                        break;

                case 'datetime':
                    $field_name = 'test-date-time';
            
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        // exception
                        //$dd_block->setText( $field_name, 'datetime' )->edit();
                        $dd_block->setText( $field_name, '3' )->edit();
                        $text_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                        echo $text_node->getText() . BR;
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }

                    if( $test_field != 'all-fields' )
                        break;

                case 'wysiwyg':
                    $field_name = 'test-wysiwyg';
            
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        // exception
                        //$dd_block->setText( $field_name, 'datetime' )->edit();
                        $dd_block->setText( 
                            $field_name, "<p>New paragraph.</p>" )->
                            edit();
                        $text_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                        echo $text_node->getText() . BR;
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }
                    
                    if( $test_field != 'all-fields' )
                        break;
                        
                case 'single-checkbox':
                    $field_name = 'test-group1;test-checkbox-yes';
            
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        // exception
                        //$dd_block->setText( $field_name, 'datetime' )->edit();
                        // Cascade allows illegal value
                        echo "Unsetting text for checkbox" . BR;
                        $dd_block->setText( $field_name, '::CONTENT-XML-CHECKBOX::' )->
                            edit();
                        // OK
                        $dd_block->setText( $field_name, '' )->edit();
                        $text_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                        echo $text_node->getText() . BR;
                        
                        echo "Setting text for checkbox" . BR;
                        // exception
                        //$dd_block->setText( $field_name, 'No' )->edit();
                        $dd_block->setText( $field_name, 'Yes' )->edit();
                        $text_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                        echo $text_node->getText() . BR;
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }
                        
                    if( $test_field != 'all-fields' )
                        break;
                        
                case 'dropdown':
                    $field_name = 'test-group1;test-dropdown';
                
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        // exception
                        //$dd_block->setText( $field_name, 'datetime' )->edit();
                        // Cascade allows illegal value
                        $dd_block->setText( $field_name, "Item 2" )->edit();
                        $text_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                        echo $text_node->getText() . BR;
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }
                        
                    if( $test_field != 'all-fields' )
                        break;
                        
                case 'multiple-checkbox':
                        
                    $field_name = 'test-group1;test-checkbox';
            
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        // exception
                        //$dd_block->setText( $field_name, 'Item 3' )->edit();
                        $dd_block->setText( $field_name, "Item 2;Item 1" )->edit();
                        $text_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                        echo $text_node->getText() . BR;
                        // empty string OK
                        $dd_block->setText( $field_name, "" )->edit();
                        $text_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                        echo $text_node->getText() . BR;
                        // prefix OK
                        $dd_block->setText( $field_name, '::CONTENT-XML-CHECKBOX::' )->
                            edit();
                        $text_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                        echo $text_node->getText() . BR;
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }
            
                    if( $test_field != 'all-fields' )
                        break;
            
                case 'radio':
                
                    $field_name = "test-group1;test-group1-group;test-radio";
                    
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        // exception
                        //$dd_block->setText( $field_name, 'Maybe' )->edit();
                        $dd_block->setText( $field_name, "No" )->edit();
                        $text_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                        echo $text_node->getText() . BR;
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }
            
                    if( $test_field != 'all-fields' )
                        break;
                        
                case 'calendar':
                
                    $field_name = "test-group1;test-calendar";
                    
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        // exception, wrong date
                        //$dd_block->setText( $field_name, 'Maybe' )->edit();
                        // exception: too old
                        //$dd_block->setText( $field_name, '12-3-1950' )->edit();
                        // exception: month and day in wrong order
                        //$dd_block->setText( $field_name, '28-2-2005' )->edit();
                        // OK
                        $dd_block->setText( $field_name, '4-01-2005' )->edit();
                        // OK
                        $dd_block->setText( $field_name, '5-1-2005' )->edit();
                        // OK
                        $dd_block->setText( $field_name, '06-01-2005' )->edit();
                        
                        $text_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                        echo $text_node->getText() . BR;
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }
            
                    if( $test_field != 'all-fields' )
                        break;
            
                case 'multi-select':
                
                    $field_name = "test-group1;test-select";
                    
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        // exception: value not exist
                        //$dd_block->setText( $field_name, 'This' )->edit();
                        // empty string OK
                        $dd_block->setText( $field_name, '' )->edit();
                        // OK
                        $dd_block->setText( $field_name, 'Item 1' )->edit();
                        // OK
                        $dd_block->setText( $field_name, 'Item 1;Item 2' )->edit();
                        // OK
                        $dd_block->setText( $field_name, 
                            '::CONTENT-XML-SELECTOR::Item 1' .
                            '::CONTENT-XML-SELECTOR::Item 3' )->
                            edit();
                        
                        $text_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                        echo $text_node->getText() . BR;

                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }
            
                    if( $test_field != 'all-fields' )
                        break;
                        
                case 'file':
                
                    $field_name = "test-file";
                    
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        $file_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                            
                        if( $file_node->getAssetType() == File::TYPE )
                        {
                            echo "File ID: " . $file_node->getFileId() . BR .
                                     "File path: " . $file_node->getFilePath() . BR;
                        
                            $f_id = '0e190a5b8b7f0856002a5e1150a1adf4';
                            $file = new File( $service, $service->
                                createId( FILE::TYPE, $f_id ) );
                            $dd_block->setFile( $field_name, $file )->edit();

                            $file_node = $dd_block->getStructuredData()->
                                getStructuredDataNode( $field_name );
                            echo "File ID: " . $file_node->getFileId() . BR .
                                 "File path: " . $file_node->getFilePath() . BR;
                        }
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }

                    if( $test_field != 'all-fields' )
                        break;
                    
                case 'block':
                
                    $field_name = "test-block";
                    
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        $block_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                            
                        if( $block_node->getAssetType() == Block::TYPE )
                        {
                            echo "Block ID: " . $block_node->getBlockId() . BR .
                                     "Block path: " . $block_node->getBlockPath() . BR;
                     
                            //$b_id = 'a18396378b7f08560139425cbea9e950';
                            //$block = new IndexBlock( $service, $service->
                                //createId( IndexBlock::TYPE, $b_id ) );
                                
                            //$b_id = 'a174ab188b7f08560139425ceeed850b';
                            //$block = new FeedBlock( $service, $service->
                                //createId( FeedBlock::TYPE, $b_id ) );
                                
                            //$b_id = 'c67456288b7f0856002a5e111a7221b1';
                            //$block = new TextBlock( $service, $service->
                                //createId( TextBlock::TYPE, $b_id ) );
                                
                            //$b_id = '96ba02688b7f08560081f143ce2ceeae';
                                //$block = new DataDefinitionBlock( $service, $service->
                                //createId( DataDefinitionBlock::TYPE, $b_id ) );
                                
                            //$b_id = 'a14d54158b7f08560139425cd29a9958';
                            //$block = new XmlBlock( $service, $service->
                                //createId( XmlBlock::TYPE, $b_id ) );
                             
                            //$dd_block->setBlock( $field_name, $block )->edit();
                            $dd_block->setBlock( $field_name, NULL )->edit();

                            $block_node = $dd_block->getStructuredData()->
                                getStructuredDataNode( $field_name );
                                
                            echo "Block ID: " . $block_node->getBlockId() . BR .
                                     "Block path: " . $block_node->getBlockPath() . BR;
                        }
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }
                    
                    if( $test_field != 'all-fields' )
                        break;

                case 'page':
                
                    $field_name = "test-page";
                    
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        $page_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                            
                        if( $page_node->getAssetType() == Page::TYPE )
                        {
                            echo "Page ID: " . $page_node->getPageId() . BR .
                                     "Page path: " . $page_node->getPagePath() . BR;
                     
                            $p_id = '96f6e5138b7f0856002a5e11fa547b61';
                            $page = new Page( $service, $service->
                                createId( Page::TYPE, $p_id ) );
                            //$dd_block->setPage( $field_name, $page )->edit();
                            $dd_block->setPage( $field_name, NULL )->edit();

                            $page_node = $dd_block->getStructuredData()->
                                getStructuredDataNode( $field_name );
                            echo "Page ID: " . $page_node->getPageId() . BR .
                                 "Page path: " . $page_node->getPagePath() . BR;
                        }
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }
                    
                    if( $test_field != 'all-fields' )
                        break;

                case 'symlink':
                
                    $field_name = "test-symlink";
                    
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        $symlink_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                            
                        if( $symlink_node->getAssetType() == a\Symlink::TYPE )
                        {
                            echo "Symlink ID: " . $symlink_node->getSymlinkId() . BR .
                                     "Symlink path: " . $symlink_node->getSymlinkPath() . BR;
                     
                            $s_id = 'fd648d068b7f085601e990b432458160';
                            $symlink = $cascade->getAsset( a\Symlink::TYPE, $s_id );                                
                                
                            $dd_block->setSymlink( $field_name, $symlink )->edit();
                            //$dd_block->setSymlink( $field_name, NULL )->edit();

                            $symlink_node = $dd_block->getStructuredData()->
                                getStructuredDataNode( $field_name );
                            echo "Symlink ID: " . $symlink_node->getSymlinkId() . BR .
                                "Symlink path: " . $symlink_node->getSymlinkPath() . BR;
                        }
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }
            
                    if( $test_field != 'all-fields' )
                        break;

                case 'linkable':
                
                    $field_name = "test-linkable";
                    
                    if( $dd_block->hasNode( $field_name ) )
                    {
                        $linkable_node = $dd_block->getStructuredData()->
                            getStructuredDataNode( $field_name );
                            
                        if( $linkable_node->getAssetType() == a\Linkable::TYPE )
                        {
                            // file

                            echo "File ID: " . $linkable_node->getLinkableId() . BR .
                                     "File path: " . $linkable_node->getLinkablePath() . BR;
                        
                            $f_id = '0e190a5b8b7f0856002a5e1150a1adf4';
                            $linkable = new File( $service, $service->
                                createId( FILE::TYPE, $f_id ) );
                            $dd_block->setLinkable( $field_name, $linkable )->edit();
                            //$dd_block->setLinkable( $field_name, NULL )->edit();

                            $linkable_node = $dd_block->getStructuredData()->
                                getStructuredDataNode( $field_name );
                            echo "File ID: " . $linkable_node->getLinkableId() . BR .
                                 "File path: " . $linkable_node->getLinkablePath() . BR;
/*
                            // page
                            echo "Page ID: " . $linkable_node->getLinkableId() . BR .
                                     "Page path: " . $linkable_node->getLinkablePath() . BR;
                     
                            $p_id = '96f6e5138b7f0856002a5e11fa547b61';
                            $linkable = new Page( $service, $service->
                                createId( Page::TYPE, $p_id ) );
                            $dd_block->setLinkable( $field_name, $linkable )->edit();
                            //$dd_block->setLinkable( $field_name, NULL )->edit();

                            $linkable_node = $dd_block->getStructuredData()->
                                getStructuredDataNode( $field_name );
                            echo "Page ID: " . $linkable_node->getLinkableId() . BR .
                                 "Page path: " . $linkable_node->getLinkablePath() . BR;
*/
                        
                            // symlink
                            echo "Symlink ID: " . $linkable_node->getLinkableId() . BR .
                                     "Symlink path: " . $linkable_node->getLinkablePath() . BR;
                     
                            $s_id = '9819f4028b7f0856015997e4473de0d6';
                            $linkable = new Symlink( $service, $service->
                                createId( Symlink::TYPE, $s_id ) );
                            $dd_block->setLinkable( $field_name, $linkable )->edit();
                            //$dd_block->setLinkable( $field_name, NULL )->edit();

                            $linkable_node = $dd_block->getStructuredData()->
                                getStructuredDataNode( $field_name );
                            echo "Symlink ID: " . $linkable_node->getLinkableId() . BR .
                                 "Symlink path: " . $linkable_node->getLinkablePath() . BR;

                        }
                    }
                    else
                    {
                        echo "Node not found" . BR;
                    }
            
                    if( $test_field != 'all-fields' )
                        break;
            }
            
            if( $mode != 'all' )
                break;
                
        case 'search':
            echo S_PRE;
            var_dump( $dd_block->searchText( 'Text' ) );
            echo E_PRE;
            
            $include = array( "test-text2" );
            $dd_block->replaceText( 'Text', 'text' )->edit();
            
            $pattern = '/(\w+) (\d+), (\d+)/i';
            $replace = '${1} 1, $3';
            $dd_block->replaceByPattern( $pattern, $replace )->edit();
            
            if( $mode != 'all' )
                break;
                
        case 'raw':
            $dd_block = $service->retrieve( 
                $service->createId( c\T::DATABLOCK, $id), c\P::DATABLOCK );

            echo S_PRE;
            var_dump( $dd_block );
            echo E_PRE;

            if( $mode != 'all' )
                break;
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