<?php

ini_set('display_errors', 1);

session_start();

require("config.php");
require("vhs/conn.php");
require("vhs/funky.php");

if(isset($_POST["refuse_cookies"])) {
    setcookie($config["title"]."_cookie-consent", "2", time()+31556926, "/");
    header("Refresh: 0");
}

if(isset($_POST["accept_cookies"])) {
    setcookie($config["title"]."_cookie-consent", true, time()+31556926, "/");
    header("Refresh: 0");
}

if(isset($_COOKIE[$config["title"]."_cookie-consent"]) && $_COOKIE[$config["title"]."_cookie-consent"]==1) {
    if(!isset($_COOKIE[$config["title"]."_lang"])) {
        setcookie($config["title"]."_lang", $config["lang"], time()+31556926, "/");
        header("Refresh: 0");
    }
    $lang = mysqli_real_escape_string($conn, $_COOKIE[$config["title"]."_lang"]);
} else {
    if(!isset($_SESSION[$config["title"]."_lang"])) {
        $_SESSION[$config["title"]."_lang"] = $config["lang"];
        header("Refresh: 0");
    }
    $lang = mysqli_real_escape_string($conn, $_SESSION[$config["title"]."_lang"]);
}

require("lang/".$lang.".lang.php");

?>
