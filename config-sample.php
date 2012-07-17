<?
/* GENERAL SITE SETTINGS */

	$config['site_title'] = "CLOAKSTREAM";
	$config['contact'] = "example@example.com";
	
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
    
/* Movie PATH 
 * full path required WITH TRAILING SLASH
 */
    $config['movie_path'] = "/full/path/to/movies/";
