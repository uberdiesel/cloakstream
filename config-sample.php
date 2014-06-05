<?
/* GENERAL SITE SETTINGS */

	$config['site_title'] = "CLOAKSTREAM";
	$config['contact'] = "example@example.com";
	//default thumbnail image for videos
	$config['default_thumb'] = "http://placehold.it/720x406/00000/ffffff&text=".urlencode($config['site_title']);
	
/* MOD_AUTH_TOKEN SETTINGS 
 * settings here corrospond to your apache settings for mod_auth_token exactly
 */
	$config['AuthTokenSecret'] = "secret string";
	$config['AuthTokenPrefix'] = "/serve/"; //WITH BEGINING AND ENDING SLASHES
	
/*	DEPLOYMENT ENVIRONMENT
 *	accepted values:
 *
 *	development 
 *	production
 */
	$config['env'] = "production";


/* SICKBEARD PATHs 
 * full path required WITH TRAILING SLASH
 */
 	$config['sickbeard_dir'] = "/full/path/to/Sick-Beard/";
	$config['db_path'] = $config['sickbeard_dir']."sickbeard.db";