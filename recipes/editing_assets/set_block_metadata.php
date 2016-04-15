<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
    // create the text block
    $block = $cascade->createTextBlock( 
        $cascade->getFolder( '_cascade', 'cascade-admin' ),
        'my-text-block',
        'Some text'
    );
    
    // create the metadata set
    $ms = $cascade->createMetadataSet(
        $cascade->getAsset( 
            a\MetadataSetContainer::TYPE, '980a834e8b7f0856015997e4350146a8' ),
        'My Metadata Set'
    );
    
    // associate the block with the metadata set
    $block->setMetadataSet( $ms ); // no need to call edit
   
    // modify the metadata set
    $ms->setAuthorFieldRequired( false )->
        setAuthorFieldVisibility( c\T::INLINE )->
        // etc. altogether 20 calls
        edit(); // only once
        
    // add a new field; this can only be run once
    // else exception will be thrown
    // better to check it
    if( !$ms->hasDynamicMetadataFieldDefinition( 'languages' ) )
    {
    	echo "Not existing" . BR;
        $ms->addField( 
            'languages',                // field name
            c\T::MULTISELECT,           // type
            'Languages',                // label
            false,                      // required
            c\T::INLINE,                // visibility
            "English;Japanese;Spanish"  // possible value
        );
    }
    
    // modify metadata of the block
    $block->getMetadata()->
        setAuthor( 'Wing Ming Chan' )->
        setDynamicField( 'languages', array( 'English', 'Spanish' ) );
    $block->edit();
    $block->dump( true );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>