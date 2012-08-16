<?php
define("IDLEN", 11);
define("FIRSTNAMELEN", 32);
define("LASTNAMELEN", 32);
define("PHONELEN", 10);
define("ADDRESSLEN", 50);
define("EMAILLEN", 32);
define("PWDLEN", 14);

define("TYPE_MEN", 0x0);
define("TYPE_WOMEN", 0x01);
define("TYPE_MIXED", 0x10);

define("TYPE_SINGLE", 0);
define("TYPE_DOUBLEWO", 1);
define("TYPE_DOUBLEWP", 2);

define("USR_ADMIN", 1);
define("USR_MANAGER", 2);
define("USR_USER", 3);

define("WK_MONDAY",0x1);
define("WK_TUESDAY",0x2);
define("WK_WEDNESDAY",0x4);
define("WK_THURSDAY",0x8);
define("WK_FRIDAY",0x10);
define("WK_SATURDAY",0x20);
define("WK_SUNDAY",0x40);

$tl_gender=array("Men's ","Women's ","Mixed ");

$tl_singledouble=array("single","double w/o partner","double w partner");

$tl_dayOfWeek = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
?>