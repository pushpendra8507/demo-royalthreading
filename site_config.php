<?php
ob_start();
/*database credentials*/

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','db_royal_threading_new');
define('SITEURL', 'http://localhost/royal_threading_new/');
define('SITELOGO', 'http://localhost/royal_threading_new//assets/img/logo.png');

// define('DB_HOST','localhost');
// define('DB_USER','royalthr_db');
// define('DB_PASSWORD','6VW$P!^tZGM?');
// define('DB_NAME','royalthr_db');
// define('SITEURL', 'https://www.royalthreadings.com/');
// define('SITELOGO', 'https://www.royalthreadings.com/assets/img/logo.png');






/*Manage Site Currency */
define('SITE_CURRENCY','$');
/*site title for admin pages*/
define('ADMIN_TITLE','Royal Threading Center');







/** email setting */
define('MAIL_TITLE',"Royal Threading Center");
// Client id
define('ADMIN_EMAIL','royalthreading@gmail.com');
// Developer Testing
// define('ADMIN_EMAIL','ravi02.agp@gmail.com');

define('FROM_EMAIL','no-reply@royalthreadings.com');
define('FROM_NAME','Royal Threading');
define('BCC_EMAIL','ravi@agpt.in,contact@wxperts.co');



/** security settings */
define('SECURITY_KEY','i~am~iron~man');
define('ADMIN_SESSION','mv_admin');
define('ADMIN_SESSION_EMAIL','mv_admin_email');







?>