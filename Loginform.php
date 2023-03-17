<?php  require_once 'php_action/db_connect.php'; 

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
  $_SESSION['login_id']= $_POST['uname'];
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['uname'])) {
  $loginUsername=$_POST['uname'];
  $password=$_POST['psw'];
  $MM_fldUserAuthorization = "access";
  $MM_redirectLoginSuccess = "client.php";
  $MM_redirectLoginFailed = "suggestion.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_powergrid_db, $powergrid_db);
  	
  $LoginRS__query=sprintf("SELECT login_id, password, access FROM login WHERE login_id=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $powergrid_db) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'access');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}


if (!isset($_SESSION)) {
  session_start();
  
  
date_default_timezone_set('Africa/Harare');
}
// Then call the date functions
$date = date('Y-m-d H:i:s');
$action = "LOGIN PROCEDURAL";

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "login")) {
  $insertSQL = sprintf("INSERT INTO system_log (username, date ,action) VALUES (%s, %s,%s)",
                       GetSQLValueString($_POST['uname'], "text"),
                       GetSQLValueString($date, "date"),
					   GetSQLValueString($action, "text"));
					   

  mysql_select_db($database_powergrid_db, $powergrid_db);
  $Result1 = mysql_query($insertSQL, $powergrid_db) or die(mysql_error());

  $insertGoTo = "client.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['uname'])) {
  $loginUsername=$_POST['uname'];
  $password=$_POST['psw'];
  $MM_fldUserAuthorization = "access";
  $MM_redirectLoginSuccess = "client.php";
  $MM_redirectLoginFailed = "suggestion.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_powergrid_db, $powergrid_db);
  	
  $LoginRS__query=sprintf("SELECT login_id, password, access FROM login WHERE login_id=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $powergrid_db) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'access');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZETDC LOGIN PAGE</title>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {
	border: 3px solid #FFFF66;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
	padding: 12px;
	margin: 12px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
<script type="text/javascript">
<!--
function validate() {
   if( document.login.psw.value == "" )
         {
            alert( "Please provide your name!" );
            document.login.psw.focus() ;
            return false;
         }
}
//-->
</script>

</head>

<body bgcolor="#FFFF66">
<table width="800" border="0" align="center">
  <tr>
    <td>

<h2 align="center">WELCOME TO ZETDC DIGITAL POWER GRID SYSTEMLOGIN PLATFORM</h2>

<form ACTION="<?php echo $loginFormAction; ?><?php echo $editFormAction; ?>" METHOD="POSTPOST" name="login">
  <div class="imgcontainer">
   <img src="img/images (2).jfif"   alt="Avatar" class="avatar" width="600"> <img src="img/images (1).jfif"   alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname" class="text-center"><font color="red"><b>USERNAME</b></font></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><font color="red"><b>PASSWORD</b></font></label>
    <input type="password" placeholder="Enter Password" name="psw" required="required">
        
    <button type="submit" name="btnsubmit">LOGIN</button>
    

  </div>

  
     <p ><a href="register.php" class="btn btn-success" role="button">REGISTER</a><span class="psw">Forgot <a href="#">password?</a></span>
</p>
     <input type="hidden" name="MM_insert" value="login" />
</form>

</td>
  </tr>
</table>
</body>
</html>