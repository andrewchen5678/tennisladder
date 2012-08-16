<?php

//$tl_typeList = array("Men's single","Women's single","Men's double w/o partner","Women's double w/o partner","Men's double w/partner","Women's double w/partner","Mixed double w/partner");

//$tl_typeWithPartner = array(TYPE_SINGLE,TYPE_SINGLE,TYPE_DOUBLEWO,TYPE_DOUBLEWO,TYPE_DOUBLEWP,TYPE_DOUBLEWP,TYPE_DOUBLEWP);

//$tl_typeWithPartner = array(TYPE_SINGLE,TYPE_DOUBLEWO,TYPE_DOUBLEWP);


//$tl_hasError=false;
//$tl_errMsg='';
function requireLogin(){
	if(!isSet($_SESSION['user']) || $_SESSION['user']->member_ID<1) {
			header('Location: dologin.php');
			die();
	}
}

function createUserObject($row){
    switch ($row['usrStatus']) {
        case USR_ADMIN:
            $_SESSION['user'] = new Admin();
            break;
        case USR_MANAGER:
            $_SESSION['user'] = new Manager();
            break;
        case USR_USER:
            $_SESSION['user'] = new User();
            break;
        default:
            return false;
    }
    $_SESSION['user']->recordID = $row['recordID'];
    $_SESSION['user']->usrStatus = $row['usrStatus'];
    $_SESSION['user']->member_ID=$row['member_ID'];
    $_SESSION['user']->first_Name=$row["first_Name"];
    $_SESSION['user']->last_Name=$row["last_Name"];
    return true;
}


function requireAdmin(){
	if(!isAdmin()) {
			header('Location: dologin.php');
			die();
	}
}

function requireManager(){
	if(!isManager()) {
			header('Location: dologin.php');
			die();
	}
}

function isAdmin(){
    return isSet($_SESSION['user']) && ($_SESSION['user'] instanceof Admin);
}

function isManager(){
    return isSet($_SESSION['user']) && ($_SESSION['user'] instanceof Manager);
}

function inputError($which,$str){
	global $tl_errForm;
    $tl_errForm[$which]=$tl_errForm[$which]."<li>".$str."</li>";
}

function formatErrorMsg(){
    global $tl_errForm;
    foreach($tl_errForm as $msg){
        $errMsg=$errMsg.$msg;
    }
    return $errMsg;
}

function printRedStar(){
    echo '<font color="red">*</font>';
}

function formHasError(){
    global $tl_errForm;
    return isset($tl_errForm);
}

function fieldHasError($field){
    global $tl_errForm;
    return isset($tl_errForm[$field]);
}

function tl_ladderType($gender, $type){
    global $tl_gender;
    global $tl_singledouble;
    return $tl_gender[$gender].$tl_singledouble[$type];
}

// function tl_ladderTypeWPartner($type){
	// global $tl_typeWithPartner;
    // return $tl_typeWithPartner[$type];
// }

/*
function tl_ladderType($menwomen,$singledouble){
	global $tl_gender;
	global $tl_singledouble;
    return $tl_gender[$menwomen].$tl_singledouble[$singledouble];
}
*/
function tl_getDayOfWeek($num){
    $thenum=intval($num);
	global $tl_dayOfWeek;
    $oneAlready=false;
    $returnStr="";
    $byte=1;
    for($counter=0; $counter<7; $counter++){
        $index = $thenum & $byte;
        if($oneAlready && $index==$byte) {
            $returnStr = $returnStr." & ".$tl_dayOfWeek[$counter];
        }else if(!$oneAlready && $index==$byte){
            $returnStr = $tl_dayOfWeek[$counter];
            $oneAlready=true;
        }
        $byte*=2;
    }
    return $returnStr;
}

?>