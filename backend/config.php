<?php
$site_config = array();

# TorrentTrader versio. Semantic Versioning. http://semver.org
$site_config['ttversion'] = '3.0.0 BETA';										# DONT CHANGE THIS!

// Main Site Settings
$site_config['SITENAME'] = 'TorrentTrader v3.0 Beta';							# Site Name
$site_config['SITEEMAIL'] = 'change@yoursite.com';								# Emails will be sent from this address
$site_config['SITEURL'] = 'http://ttv3.mavitrine.ovh/';											# Main Site URL
$site_config['CHARSET'] = "utf-8";												# Site Charset
$site_config['MEMBERSONLY'] = true;												# MAKE MEMBERS SIGNUP
$site_config['CONFIRMEMAIL'] = true;											# Enable / Disable Signup confirmation email
$site_config['FORUMS_GUESTREAD'] = false; 										# Allow / Disallow Guests To Read Forums
$site_config["OLD_CENSOR"] = false; 											# Use the old change to word censor set to true otherwise use the new one.

$site_config['staff_pin'] = "<3tt";												# Admincp pincode
$site_config['currency_symbol'] = '€'; 											# Currency symbol (HTML allowed)

// Image upload settings
$site_config['image_max_filesize'] = 524288; 	# Max uploaded image size in bytes (Default: 512 kB)
$site_config['allowed_image_types'] = array(
"image/gif" => ".gif",
"image/pjpeg" => ".jpg",
"image/jpeg" => ".jpg",
"image/jpg" => ".jpg",
"image/png" => ".png"
);

$site_config['SITE_ONLINE'] = true;		# Turn Site on/off
$site_config['OFFLINEMSG'] = 'Site is down for a little while';	

$site_config['WELCOMEPMON'] = true;	    	# Auto PM New members
$site_config['WELCOMEPMMSG'] = 'Thank you for registering at our tracker! Please remember to keep your ratio at 1.00 or greater :)';

$site_config['SITENOTICEON'] = true;
$site_config['SITENOTICE'] = '<b>Welcome to TTv3!</b><br />
		TTv3 | The most powerful CMS software. Fast. Secure. Social. Build your own website today.<br /><br />
		Please take a look around, and feel free to <a href="/account-signup.php"><b>sign up</b></a> and join our community.';

// Setup site blocks
$site_config['NEWSON'] = true; 			# Enable / Disable news block

// Mail settings
// php to use PHP's built-in mail function. or pear to use http://pear.php.net/Mail
// MUST use pear for SMTP
$site_config["mail_type"] = "php";
$site_config["mail_smtp_host"] = "localhost"; 			# SMTP server hostname
$site_config["mail_smtp_port"] = "25"; 				# SMTP server port
$site_config["mail_smtp_ssl"] = false; 				# true to use SSL
$site_config["mail_smtp_auth"] = false; 			# True to use auth for SMTP
$site_config["mail_smtp_user"] = ""; 				# SMTP username
$site_config["mail_smtp_pass"] = ""; 				# SMTP password

// Password hashing - Once set, cannot be changed without all users needing to reset their passwords
$site_config["passhash_method"] = "sha1"; 			# Hashing method (sha1, md5 or hmac). Must use what your previous version of TT did or all users will need to reset their passwords

// Only used for hmac.
$site_config["passhash_algorithm"] = "sha1"; 			# See http://php.net/hash_algos for a list of supported algorithms.
$site_config["passhash_salt"] = ""; 				# Shouldn't be blank. At least 20 characters of random text.
?>
