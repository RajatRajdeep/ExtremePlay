<?php

/*** For login connection ***/
//Localhost Machine

/*** For main website ***/

//define('siteaddress','http://tspeducation.com/');
define('siteaddress','http://localhost/qandap/');

define("servername","localhost");
define("username","root");
define("password","");
define("databasename","sport");

/*
define("servername","localhost");
define("username","tspedsqf_qa");
define("password","tsplearning123");
define("databasename","tspedsqf_qa");
*/

define("tablename","data");
define("ADMINDB_TABLE","adminusers");

/*** For login connection ***/


define("DB_HOST", servername);
define("DB_NAME", databasename);
define("DB_USER",username);
define("DB_PASS", password);


define("DB_TABLE","users");


define("COOKIE_RUNTIME", 1209600);
define("COOKIE_DOMAIN", ".127.0.0.1");
define("COOKIE_SECRET_KEY", "1gp@TMPS{+$78sfpMJFe-92r");


define("EMAIL_USE_SMTP", true);
define("EMAIL_SMTP_HOST", "ssl://smtp.gmail.com");
define("EMAIL_SMTP_AUTH", true);
define("EMAIL_SMTP_USERNAME", "");
define("EMAIL_SMTP_PASSWORD", "");
define("EMAIL_SMTP_PORT", 465);
define("EMAIL_SMTP_ENCRYPTION", "ssl");

/**
 * Configuration for: password reset email data
 * Set the absolute URL to password_reset.php, necessary for email password reset links
 */
define("EMAIL_PASSWORDRESET_URL", siteaddress."password_reset.php");
define("EMAIL_PASSWORDRESET_FROM", EMAIL_SMTP_USERNAME);
define("EMAIL_PASSWORDRESET_FROM_NAME", EMAIL_SMTP_USERNAME);
define("EMAIL_PASSWORDRESET_SUBJECT", "Password reset");
define("EMAIL_PASSWORDRESET_CONTENT", "Please click on this link to reset your password:");

/**
 * Configuration for: verification email data
 * Set the absolute URL to register.php, necessary for email verification links
 */
define("EMAIL_VERIFICATION_URL", siteaddress."register.php");
define("EMAIL_VERIFICATION_FROM", EMAIL_SMTP_USERNAME);
define("EMAIL_VERIFICATION_FROM_NAME", EMAIL_SMTP_USERNAME);
define("EMAIL_VERIFICATION_SUBJECT", "Account activation");
define("EMAIL_VERIFICATION_CONTENT", "Please click on this link to activate your account:");

define("HASH_COST_FACTOR", "10");
?>