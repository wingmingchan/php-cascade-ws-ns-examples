<?php
/*
This program is used to test the edit operation on all asset types.
*/

require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$case = "wd";

try
{
    switch( $case )
    {
        // asset factory
        case "af":
            $type = a\AssetFactory::TYPE;
            $id   = "a14dd4e58b7ffe830539acf06baf07b3";
            break;
    
        // asset factory container
        case "afc":
            $type = a\AssetFactoryContainer::TYPE;
            $id   = "a14dd3958b7ffe830539acf004d370d7";
            break;
    
        // blocks
        case "ddb":
            $type = a\DataBlock::TYPE;
            $id   = "c12da9c78b7ffe83129ed6d8411290fe";
            break;
    
        case "fb":
            $type = a\FeedBlock::TYPE;
            $id   = "c12d93f48b7ffe83129ed6d8b74902e1";
            break;
    
        case "ib":
            $type = a\IndexBlock::TYPE;
            $id   = "987203c88b7ffe8353cc17e9ed0bab6c";
            break;
    
        case "tb":
            $type = a\TextBlock::TYPE;
            $id   = "089c28d98b7ffe83785cac8a79fe2145";
            break;

        case "xb":
            $type = a\XmlBlock::TYPE;
            $id   = "c12d969c8b7ffe83129ed6d8bf50e2db";
            break;
            
        case "xtmlb":
            $type = a\DataBlock::TYPE;
            $id   = "9d9336e18b7ffe8353cc17e99daf87e1";
            break;
        
        // connectors
        case "ga":
            $type = a\GoogleAnalyticsConnector::TYPE;
            $id   = "243d93498b7ffe8343b94c28de034795";
            break;

        case "tw":
            $type = a\TwitterConnector::TYPE;
            $id   = "244081a88b7ffe8343b94c28b1197a9d";
            break;
            
        case "wp":
            $type = a\WordPressConnector::TYPE;
            $id   = "243c73ba8b7ffe8343b94c28ebf34eb1";
            break;

        // connector container
        case "cc":
            $type = a\ConnectorContainer::TYPE;
            $id   = "2436012e8b7ffe8343b94c2803783fb1";
            break;
        
        // content type
        case "ct":
            $type = a\ContentType::TYPE;
            $id   = "e98e32fc8b7f08560139425c8b1403fd";
            break;
        
        // content type container
        case "ctc":
            $type = a\ContentTypeContainer::TYPE;
            $id   = "54b505c28b7f085600ae2282a4b7ed71";
            break;

        // data definition
        case "dd":
            $type = a\DataDefinition::TYPE;
            $id   = "fd27a12d8b7f08560159f3f087ef9165";
            break;
        
        // data definition container       
        case "ddc":
            $type = a\DataDefinitionContainer::TYPE;
            $id   = "5501cc048b7f085600ae2282a4d548b7";
            break;

        // destination       
        case "des":
            $type = a\Destination::TYPE;
            $id   = "c12dad828b7ffe83129ed6d81fc31265";
            break;

        // file
        case "fi":
            $type = a\File::TYPE;
            $id   = "0fbcfbcb8b7ffe8343b94c28fe1f07e7";
            break;

        // folder    
        case "f":
            $type = a\Folder::TYPE;
            $id   = "c12dce028b7ffe83129ed6d8fdc88b47";
            break;
            
        // formats
        case "sf":
            $type = a\ScriptFormat::TYPE;
            $id   = "c12ed4e58b7ffe83129ed6d8d7ef4a97";
            break;
            
        case "xf":
            $type = a\XsltFormat::TYPE;
            $id   = "fd27c1988b7f08560159f3f012c360e7";
            break;
        
        // role, group, user  
        case "r":
            $type = a\Role::TYPE;
            $id   = 10;
            break;
            
        case "g":
            $type = a\Group::TYPE;
            $id   = "22q";
            break;
            
        case "u":
            $type = a\User::TYPE;
            $id   = "wing";
            break;
                
        // metadata set
        case "ms":
            $type = a\MetadataSet::TYPE;
            $id   = "647e77e18b7f085600ae2282629d7ea0";
            break;
                
        // metadata set container
        case "msc":
            $type = a\MetadataSetContainer::TYPE;
            $id   = "647db3ab8b7f085600ae2282d55a5b6d";
            break;
            
        // page
        case "page":
            $type = a\Page::TYPE;
            $id   = "9e19b89f8b7ffe8353cc17e9c1ab52bb";
            break;

        // page configuraton set
        case "pcs":
            $type = a\PageConfigurationSet::TYPE;
            $id   = "6188631a8b7ffe8377b637e8d9af95ee";
            break;
        
        // page configuraton set container
        case "pcsc":
            $type = a\PageConfigurationSetContainer::TYPE;
            $id   = "648977a98b7f085600ae228293a97bf5";
            break;

        // publish set
        case "ps":
            $type = a\PublishSet::TYPE;
            $id   = "28a960258b7ffe8343b94c282741f634";
            break;
        
        // publish set container
        case "psc":
            $type = a\PublishSetContainer::TYPE;
            $id   = "0952d9758b7ffe8339ce5d13a1ad5e0a";
            break;

        // reference
        case "ref":
            $type = a\Reference::TYPE;
            $id   = "28c750538b7ffe8343b94c28494a5cf8";
            break;

        // site
        case "site":
            $type = a\Site::TYPE;
            $id   = "0fa6f6f18b7ffe8343b94c28251e132e";
            break;

        // site destination container
        case "sdc":
            $type = a\SiteDestinationContainer::TYPE;
            $id   = "0fbc5d5c8b7ffe8343b94c289aaf4adc";
            break;

          // symlink
        case "sym":
            $type = a\Symlink::TYPE;
            $id   = "5045ce7a8b7ffe8353cc17e9559b8b12";
            break;
          
          // template
        case "t":
            $type = a\Template::TYPE;
            $id   = "618863fc8b7ffe8377b637e865012e5d";
            break;
          
          // transports
        case "cloudt":
            $type = a\CloudTransport::TYPE;
            $id   = "2428dfa38b7ffe8343b94c28b5616ed8";
            break;
               
        case "dbt":
            $type = a\DatabaseTransport::TYPE;
            $id   = "24af01918b7ffe8343b94c28de598720";
            break;
               
        case "fst":
            $type = a\FileSystemTransport::TYPE;
            $id   = "24b50e0d8b7ffe8343b94c28957a79f8";
            break;
            
        case "ftpt":
            $type = a\FtpTransport::TYPE;
            $id   = "2844531b8b7ffe8343b94c28ccbfc7f7";
            break;
            
        // transport container
        case "tc":
            $type = a\TransportContainer::TYPE;
            $id   = "28496b318b7ffe8343b94c28cf0ffabb";
            break;
            
        // wf definition
        case "wd":
            $type = a\WorkflowDefinition::TYPE;
            $id   = "b408830e8b7ffe835446afac3b3923ba";
            break;
            
        // wf definition container
        case "wdc":
            $type = a\WorkflowDefinitionContainer::TYPE;
            $id   = "28f068db8b7ffe8343b94c28e4459d6a";
            break;
            
               
    }
    
    $asset = $cascade->getAsset( $type, $id );
    //$asset->dump();
    $asset->edit();
    u\DebugUtility::dumpRESTCommands( $service );
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