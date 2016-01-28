<?php
/* This program is used to create a new site and set access rights. */

require_once( 'cascade_ws_ns/auth_chanw.php' );
require_once( 'admin_functions_rwd.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

// new site info
$new_site_name          = "access-test";
$new_site_title         = "Access Test";
$new_site_contact_name  = "John Doe";
$new_site_contact_email = "doej";

// new group
// by default, the site and group have the same name
$new_group_name         = $new_site_name;
//$new_group_name = ""; 

// the site template, out of which a site is created
$seed_site_id           = "a0d0fb818b7f08ee0990fe6e89648961";
$seed_site_name         = "_rwd_seed";

// role already defined
$role_name              = "Default";

try
{
	try // if the site already exists
	{
		$new_site = $cascade->getSite( $new_site_name );
		setSitePermissions( $cascade, $new_site_name );
		echo "The site $new_site_name already exists!" . BR;
	}
	catch( e\NoSuchSiteException $e )
	{
		// create new site
		$service->siteCopy( $seed_site_id, $seed_site_name, $new_site_name );
	
		// wait until the site is ready
		sleep( 10 );

		if( $service->isSuccessful() )
		{
			echo "Site $new_site_name copied successfully." . BR;

			// check if the group already exists
			$group = $cascade->getGroup( $new_group_name );

			if( isset( $group ) )
			{
				echo "Group $new_group_name already exists." . BR;
			}
			else
			{
				// create new group
				if( $cascade->hasRoleName( $role_name ) )
				{
					$group = $cascade->createGroup( $new_group_name, $role_name );
					echo "Group created." . BR;
				}
			}
		
			echo "Setting permissions" . BR;
			setSitePermissions( $cascade, $new_site_name );
		
			// let it finish
			sleep( 10 );
		
			createDestinationForSites( $cascade, $new_site_name );
		
			$site = $cascade->getAsset( a\Site::TYPE, $new_site_name );
			
			// the site name is also the folder name
			$site->setUrl( 'http://www.upstate.edu/' . $new_site_name )->
				setRecycleBinExpiration( a\Site::FIFTEEN )->
				setLinkCheckerEnabled( true )->edit();
			
			sleep( 5 );
			
			// the config blocks
			$site_info_block = $cascade->getAsset( a\DataBlock::TYPE, '_site-info', $new_site_name );
			$site_info_block->setText( 'title', $new_site_title )->edit();
		
			$footer_contact_block = $cascade->getAsset( a\DataBlock::TYPE, '_footer-contact', $new_site_name );
			$footer_contact_block->
				setText( 'name', $new_site_contact_name )->
				setText( 'email', $new_site_contact_email )->
				edit();			
	
			echo BR . "Successfully set up access rights for the new site.";
		}
		else
		{
			echo "Failed to create the site. " . $service->getMessage();
		}
	}
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>