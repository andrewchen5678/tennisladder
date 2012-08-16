<?php
class User
{
    public $recordID=0;
    public $member_ID=0;
    public $usrStatus=0;
    public $first_Name="";
    public $last_Name="";
}
class Manager extends user
{

}

class Admin extends Manager
{

}
?>