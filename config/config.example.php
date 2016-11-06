<?php
// Your database-settings:
define("DATABASE_HOST", "localhost"); 
define("DATABASE_USER", "username"); 
define("DATABASE_PASS", "password"); 
define("DATABASE_NAME", "my_database");
// Your mail-settings:
define("MAIL_HOST", "smtp.office365.com");
define("MAIL_USER", "domain.com\user@domain.com"); // In case of using Office365 it should look like: 
define("MAIL_PASS", "password");
define("MAIL_FROM", "register@domain.com");
define("MAIL_FROM_NAME", "Domain Name");
// Contact-Settings:
define("CONTACT_MAIL", "info@comain.com");
define("CONTACT_FROM", "no_reply@domain.com");
define("CONTACT_FROM_NAME", "Domain Name");
//PayPal
define("PAYPAL_CLIENT_ID", "YourPayPalClientID");
define("PAYPAL_CLIENT_SECRET", "YourPayPalClientSecret");
define("PAYPAL_RETURN_URL", "http://www.domain.de/RegisterSuccess.php");
define("PAYPAL_CANCEL_URL", "http://www.domain.de/RegisterCancel.php");
// Security
define("HASH_COST", 10);
define("OVERVIEW_HASH", '');  // Add here an Hash, that will be checked on the overview-page
define("KERIO_TOKEN", "");
// Dates for the event
define("EVENT_NAME", "Eventname");
define("EVENT_ID", "EvtId");
define("MAX_GUESTS", 100);
define("DATEFORMAT", "d.m.Y");
define("DATETIMEFORMAT", "d.m.Y - H:i");
define("REGISTER_STARTDATE", "2016-10-28 00:00:00");
define("REGISTER_ENDDATE", "2016-10-28 00:00:00");
define("EVENT_STARTDATE", "2016-10-28 00:00:00");
define("EVENT_ENDDATE", "2016-10-28 00:00:00");
