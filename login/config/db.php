<?php
/**
 * DB_HOST: database host
 * DB_NAME: name of the database
 * DB_USER: user for your database
 * DB_PASS: the password of the above user
 */
define("DB_HOST", "itsql.fvtc.edu");
define("DB_PDOHOST", "mysql:host=itsql.fvtc.edu;dbname=31845_500138367")
define("DB_NAME", "whatsgoingon");
define("DB_USER", "WhatsGoingOn");
define("DB_PASS", "WhatsGoingOn");
define("DB_OPTIONS", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//define("CRYPT_BLOWFISH", 1);