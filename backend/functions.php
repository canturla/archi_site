<?php
error_reporting(E_ALL ^ E_NOTICE);

// Prefer unescaped. Data will be escaped as needed.
if (ini_get("magic_quotes_gpc")) {
    $_POST = array_map_recursive("unesc", $_POST);
    $_GET = array_map_recursive("unesc", $_GET);
    $_REQUEST = array_map_recursive("unesc", $_REQUEST);
    $_COOKIE = array_map_recursive("unesc", $_COOKIE);
}

if (function_exists("date_default_timezone_set"))
    date_default_timezone_set("Europe/Paris"); // Do NOT change this. All times are converted to user's chosen timezone.

define("BASEPATH", str_replace("backend", "", dirname(__FILE__)));
$BASEPATH = BASEPATH;
define("BACKEND", dirname(__FILE__));
$BACKEND = BACKEND;

require_once(BACKEND."/mysql.php"); //Get MYSQL Connection Info
require_once(BACKEND."/config.php");  //Get Site Settings and Vars ($site_config)
require_once(BACKEND."/mail.php"); // Mail functions
require_once(BACKEND."/mysql.class.php");

$GLOBALS['tstart'] = array_sum(explode(" ", microtime()));

/**
 * Connect to the database and load user details
 *
 * @param $autoclean
 *   (optional) boolean - Check whether or not to run cleanup (default: false)
 */
function dbconn() {
    global $mysql_host, $mysql_user, $mysql_pass, $mysql_db, $site_config;

    if (!ob_get_level()) {
        if (extension_loaded('zlib') && !ini_get('zlib.output_compression'))
            ob_start('ob_gzhandler');
        else
            ob_start();
    }

    //header("Content-Type: text/html;charset=$site_config[CHARSET]");

    function_exists("mysqli_connect") or die("MySQL support not available.");

    @($GLOBALS["___mysqli_ston"] = mysqli_connect($mysql_host,  $mysql_user,  $mysql_pass)) or die('DATABASE: mysql_connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
    @((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $mysql_db)) or die('DATABASE: mysql_select_db: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));

    unset($mysql_pass); //security

}

function stdhead($title = "") {
    global $site_config;  //Define globals

    //site online check
    if (!$site_config["SITE_ONLINE"]){
        echo '<br /><br /><br /><center>'. stripslashes($site_config["OFFLINEMSG"]) .'</center><br /><br />';
        die;
    }
    //end check

    //if (!$CURUSER)
        guestadd();

    if ($title == ""){
        $title = $site_config['SITENAME'];
    }else{
        $title = $site_config['SITENAME']. " : ". htmlspecialchars($title);
    }
    require_once("template/header.php");
    require_once("template/menu.php");
}

function stdfoot() {
    global $site_config;
    require_once("template/footer.php");
    ((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
}

//BEGIN FRAME
function begin_frame($caption = "-", $align = "justify"){
    global $site_config;
    print("<div class='widget'>
	<h4>
		$caption
	</h4>
	<div id='$togglediv' class=''>");

}

//END FRAME
function end_frame() {
    global $site_config;
    print("<div class='clear'></div>
	</div>
</div>");
}

function show_error_msg($title, $message, $wrapper = "1") {
    if ($wrapper) {
        //ob_start();
        ob_clean();
    }

    echo '<p class="error">'.$message.'</p>';

    if ($wrapper){
        die();
    }
}

// MySQL escaping
function sqlesc($x) {
   if (!is_numeric($x)) {
       $x = "'".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $x) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."'";
   }
   return $x;
}


function unesc($x) {
    if (get_magic_quotes_gpc())
        return stripslashes($x);
    return $x;
}

function escape_url($url) {
    $ret = '';
    for($i = 0; $i < strlen($url); $i+=2)
    $ret .= '%'.$url[$i].$url[$i + 1];
    return $ret;
}

function gmtime() {
    return sql_timestamp_to_unix_timestamp(get_date_time());
}

function loggedinonly() {
    global $CURUSER;
    if (!$CURUSER) {
        header("Refresh: 0; url=account-login.php?returnto=" . urlencode($_SERVER["REQUEST_URI"]));
        exit();
    }
}

function validfilename($name) {
    return preg_match('/^[^\0-\x1f:\\\\\/?*\xff#<>|]+$/si', $name);
}

function validemail($email) {
    if (function_exists("filter_var"))
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    return preg_match('/^([a-z0-9._-](\+[a-z0-9])*)+@[a-z0-9.-]+\.[a-z]{2,6}$/i', $email);
}

function mksecret($len = 20) {
    $chars = array_merge(range(0, 9), range("A", "Z"), range("a", "z"));
    shuffle($chars);
    $x = count($chars) - 1;
    for ($i = 1; $i <= $len; $i++)
        $str .= $chars[mt_rand(0, $x)];
    return $str;
}

function is_valid_id($id){
    return is_numeric($id) && ($id > 0) && (floor($id) == $id);
}

function is_valid_int($id){
    return is_numeric($id) && (floor($id) == $id);
}

function sql_timestamp_to_unix_timestamp($s){
    return mktime(substr($s, 11, 2), substr($s, 14, 2), substr($s, 17, 2), substr($s, 5, 2), substr($s, 8, 2), substr($s, 0, 4));
}

function write_log($text){
    $text = sqlesc($text);
    $added = sqlesc(get_date_time());
    SQL_Query_exec("INSERT INTO log (added, txt) VALUES($added, $text)");
}

function get_elapsed_time($ts){
  $mins = floor((gmtime() - $ts) / 60);
  $hours = floor($mins / 60);
  $mins -= $hours * 60;
  $days = floor($hours / 24);
  $hours -= $days * 24;
  $weeks = floor($days / 7);
  $days -= $weeks * 7;
  $t = "";
  if ($weeks > 0)
    return "$weeks wk" . ($weeks > 1 ? "s" : "");
  if ($days > 0)
    return "$days day" . ($days > 1 ? "s" : "");
  if ($hours > 0)
    return "$hours hr" . ($hours > 1 ? "s" : "");
  if ($mins > 0)
    return "$mins min" . ($mins > 1 ? "s" : "");
  return "< 1 min";
}

function guestadd() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $time = gmtime();
    //SQL_Query_exec("INSERT INTO `visiteurs` (`ip`, `time`) VALUES ('$ip', '$time') ON DUPLICATE KEY UPDATE `time` = '$time'");
}

function getguests() {
    $past = (gmtime() - 2400);
    SQL_Query_exec("DELETE FROM `visiteurs` WHERE `time` < $past");
    return get_row_count("visiteurs");
}

function time_ago($addtime) {
   $addtime = get_elapsed_time(sql_timestamp_to_unix_timestamp($addtime));
   return $addtime;
}

function CutName ($vTxt, $Car) {
    if (strlen($vTxt) > $Car) {
        return substr($vTxt, 0, $Car) . "...";
    }
    return $vTxt;
}

function searchfield($s) {
    return preg_replace(array('/[^a-z0-9]/si', '/^\s*/s', '/\s*$/s', '/\s+/s'), array(" ", "", "", " "), $s);
}

function get_row_count($table, $suffix = "") {
    $res = SQL_Query_exec("SELECT COUNT(*) FROM $table $suffix");
    $row = mysqli_fetch_row($res);
    return $row[0];
}

function get_date_time($timestamp = 0){
    if ($timestamp)
        return date("Y-m-d H:i:s", $timestamp);
    else
        return gmdate("Y-m-d H:i:s");
}

// Convert UTC to user's timezone
function utc_to_tz ($timestamp=0) {
    GLOBAL $CURUSER, $tzs;

    if (method_exists("DateTime", "setTimezone")) {
        if (!$timestamp)
            $timestamp = get_date_time();
        $date = new DateTime($timestamp, new DateTimeZone("UTC"));

        $date->setTimezone(new DateTimeZone($CURUSER ? $tzs[$CURUSER["tzoffset"]][1] : "Europe/London"));
        return $date->format('Y-m-d H:i:s');
    }
    if (!is_numeric($timestamp))
        $timestamp = sql_timestamp_to_unix_timestamp($timestamp);
    if ($timestamp == 0)
        $timestamp = gmtime();

    $timestamp = $timestamp + ($CURUSER['tzoffset']*60);
    if (date("I")) $timestamp += 3600; // DST Fix
    return date("Y-m-d H:i:s", $timestamp);
}

function utc_to_tz_time ($timestamp=0) {
    GLOBAL $CURUSER, $tzs;

    if (method_exists("DateTime", "setTimezone")) {
        if (!$timestamp)
            $timestamp = get_date_time();
        $date = new DateTime($timestamp, new DateTimeZone("UTC"));
        $date->setTimezone(new DateTimeZone($CURUSER ? $tzs[$CURUSER["tzoffset"]][1] : "Europe/London"));
        return sql_timestamp_to_unix_timestamp($date->format('Y-m-d H:i:s'));
    }

    if (!is_numeric($timestamp))
        $timestamp = sql_timestamp_to_unix_timestamp($timestamp);
    if ($timestamp == 0)
        $timestamp = gmtime();

    $timestamp = $timestamp + ($CURUSER['tzoffset']*60);
    if (date("I")) $timestamp += 3600; // DST Fix

    return $timestamp;
}

function encodehtml($s, $linebreaks = true) {
      $s = str_replace("<", "&lt;", str_replace("&", "&amp;", $s));
      if ($linebreaks)
        $s = nl2br($s);
      return $s;
}


function format_urls($s){
    return preg_replace(
    "/(\A|[^=\]'\"a-zA-Z0-9])((http|ftp|https|ftps|irc):\/\/[^<>\s]+)/i",
    "\\1<a href='http://kpaste.net/redir/\\2' target='_blank'>\\2</a>", $s);
}

function format_comment($text) {
    global $site_config, $smilies;

    $s = $text;

    $s = htmlspecialchars($s);
    $s = format_urls($s);

    // [*]
    $s = preg_replace("/\[\*\]/", "<li>", $s);

    // [b]Bold[/b]
    $s = preg_replace("/\[b\]((\s|.)+?)\[\/b\]/", "<b>\\1</b>", $s);

    // [i]Italic[/i]
    $s = preg_replace("/\[i\]((\s|.)+?)\[\/i\]/", "<i>\\1</i>", $s);

    // [u]Underline[/u]
    $s = preg_replace("/\[u\]((\s|.)+?)\[\/u\]/", "<u>\\1</u>", $s);

    // [u]Underline[/u]
    $s = preg_replace("/\[u\]((\s|.)+?)\[\/u\]/i", "<u>\\1</u>", $s);

    // [img]http://www/image.gif[/img]
    $s = preg_replace("/\[img\]((http|https):\/\/[^\s'\"<>]+(\.gif|\.jpg|\.png|\.bmp|\.jpeg))\[\/img\]/i", "<img border='0' src=\"\\1\" alt='' />", $s);

    // [img=http://www/image.gif]
    $s = preg_replace("/\[img=((http|https):\/\/[^\s'\"<>]+(\.gif|\.jpg|\.png|\.bmp|\.jpeg))\]/i", "<img border='0' src=\"\\1\" alt='' />", $s);

    // [color=blue]Text[/color]
    $s = preg_replace(
        "/\[color=([a-zA-Z]+)\]((\s|.)+?)\[\/color\]/i",
        "<font color='\\1'>\\2</font>", $s);

    // [color=#ffcc99]Text[/color]
    $s = preg_replace(
        "/\[color=(#[a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9])\]((\s|.)+?)\[\/color\]/i",
        "<font color='\\1'>\\2</font>", $s);

    // [url=http://www.example.com]Text[/url]
    $s = preg_replace(
        "/\[url=((http|ftp|https|ftps|irc):\/\/[^<>\s]+?)\]((\s|.)+?)\[\/url\]/i",
        "<a href='http://kpaste.net/redir/\\1' target='_blank'>\\3</a>", $s);

    // [url]http://www.example.com[/url]
    $s = preg_replace(
        "/\[url\]((http|ftp|https|ftps|irc):\/\/[^<>\s]+?)\[\/url\]/i",
        "<a href='http://kpaste.net/redir/\\1' target='_blank'>\\1</a>", $s);

    // [size=4]Text[/size]
    $s = preg_replace(
        "/\[size=([1-7])\]((\s|.)+?)\[\/size\]/i",
        "<font size='\\1'>\\2</font>", $s);

    // [font=Arial]Text[/font]
    $s = preg_replace(
        "/\[font=([a-zA-Z ,]+)\]((\s|.)+?)\[\/font\]/i",
        "<font face=\"\\1\">\\2</font>", $s);

    //[quote]Text[/quote]
    while (preg_match("/\[quote\]\s*((\s|.)+?)\s*\[\/quote\]\s*/i", $s))
    $s = preg_replace(
        "/\[quote\]\s*((\s|.)+?)\s*\[\/quote\]\s*/i",
        "<p class='sub'><b>Quote:</b></p><table class='main' border='1' cellspacing='0' cellpadding='10'><tr><td style='border: 1px black dotted'>\\1</td></tr></table><br />", $s);

    //[quote=Author]Text[/quote]
    while (preg_match("/\[quote=(.+?)\]\s*((\s|.)+?)\s*\[\/quote\]\s*/i", $s))
    $s = preg_replace(
        "/\[quote=(.+?)\]\s*((\s|.)+?)\s*\[\/quote\]\s*/i",
        "<p class='sub'><b>\\1 wrote:</b></p><table class='main' border='1' cellspacing='0' cellpadding='10'><tr><td style='border: 1px black dotted'>\\2</td></tr></table><br />", $s);

    // [spoiler]Text[/spoiler]
    $r = substr(md5($text), 0, 4);
    $i = 0;
    while (preg_match("/\[spoiler\]\s*((\s|.)+?)\s*\[\/spoiler\]\s*/i", $s)) {
        $s = preg_replace("/\[spoiler\]\s*((\s|.)+?)\s*\[\/spoiler\]\s*/i",
        "<br /><img src='images/plus.gif' id='pic$r$i' title='Spoiler' onclick='klappe_torrent(\"$r$i\")' alt='' /><div id='k$r$i' style='display: none;'>\\1<br /></div>", $s);
        $i++;
    }

    // [spoiler=Heading]Text[/spoiler]
    while (preg_match("/\[spoiler=(.+?)\]\s*((\s|.)+?)\s*\[\/spoiler\]\s*/i", $s)) {
        $s = preg_replace("/\[spoiler=(.+?)\]\s*((\s|.)+?)\s*\[\/spoiler\]\s*/i",
        "<br /><img src='images/plus.gif' id='pic$r$i' title='Spoiler' onclick='klappe_torrent(\"$r$i\")' alt='' /><b>\\1</b><div id='k$r$i' style='display: none;'>\\2<br /></div>", $s);
        $i++;
    }

     //[hr]
        $s = preg_replace("/\[hr\]/i", "<hr />", $s);

     //[hr=#ffffff] [hr=red]
        $s = preg_replace("/\[hr=((#[a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9][a-f0-9])|([a-zA-z]+))\]/i", "<hr color=\"\\1\"/>", $s);

        //[swf]http://somesite.com/test.swf[/swf]
        $s = preg_replace("/\[swf\]((www.|http:\/\/|https:\/\/)[^\s]+(\.swf))\[\/swf\]/i",
        "<param name='movie' value='\\1'/><embed width='470' height='310' src='\\1'></embed>", $s);

        //[swf=http://somesite.com/test.swf]
        $s = preg_replace("/\[swf=((www.|http:\/\/|https:\/\/)[^\s]+(\.swf))\]/i",
        "<param name='movie' value='\\1'/><embed width='470' height='310' src='\\1'></embed>", $s);

    // Linebreaks
    $s = nl2br($s);

    // Maintain spacing
    $s = str_replace("  ", " &nbsp;", $s);

    // Smilies
    require_once("smilies.php");
    reset($smilies);
    while (list($code, $url) = each($smilies))
        $s = str_replace($code, '<img border="0" src="'.$site_config["SITEURL"].'/images/smilies/'.$url.'" alt="'.$code.'" title="'.$code.'" />', $s);

    if($site_config["OLD_CENSOR"])
    {
    $r = SQL_Query_exec("SELECT * FROM censor");
    while($rr=mysqli_fetch_row($r))
    $s = preg_replace("/".preg_quote($rr[0])."/i", $rr[1], $s);
    }
    else
    {

    $f = @fopen("censor.txt","r");

    if ($f && filesize("censor.txt") != 0) {

       $bw = fread($f, filesize("censor.txt"));
       $badwords = explode("\n",$bw);

       for ($i=0; $i<count($badwords); ++$i)
           $badwords[$i] = trim($badwords[$i]);
       $s = str_replace($badwords, "<img src='images/censored.png' border='0' alt='Censored' title='Censored' />", $s);
    }
    @fclose($f);
    }

    return $s;
}

function pager($rpp, $count, $href, $opts = array()) {
    $pages = ceil($count / $rpp);

    if (!$opts["lastpagedefault"])
        $pagedefault = 0;
    else {
        $pagedefault = floor(($count - 1) / $rpp);
        if ($pagedefault < 0)
            $pagedefault = 0;
    }

    if (isset($_GET["page"])) {
        $page = (int) $_GET["page"];
        if ($page < 0)
            $page = $pagedefault;
    }
    else
        $page = $pagedefault;

    $pager = "";

    $mp = $pages - 1;
    $as = "<b>&lt;&lt;&nbsp;".T_("PREVIOUS")."</b>";
    if ($page >= 1) {
        $pager .= "<a href=\"{$href}page=" . ($page - 1) . "\">";
        $pager .= $as;
        $pager .= "</a>";
    }
    else
        $pager .= $as;
    $pager .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    $as = "<b>".T_("NEXT")."&nbsp;&gt;&gt;</b>";
    if ($page < $mp && $mp >= 0) {
        $pager .= "<a href=\"{$href}page=" . ($page + 1) . "\">";
        $pager .= $as;
        $pager .= "</a>";
    }
    else
        $pager .= $as;

    if ($count) {
        $pagerarr = array();
        $dotted = 0;
        $dotspace = 3;
        $dotend = $pages - $dotspace;
        $curdotend = $page - $dotspace;
        $curdotstart = $page + $dotspace;
        for ($i = 0; $i < $pages; $i++) {
            if (($i >= $dotspace && $i <= $curdotend) || ($i >= $curdotstart && $i < $dotend)) {
                if (!$dotted)
                    $pagerarr[] = "...";
                $dotted = 1;
                continue;
            }
            $dotted = 0;
            $start = $i * $rpp + 1;
            $end = $start + $rpp - 1;
            if ($end > $count)
                $end = $count;
            $text = "$start&nbsp;-&nbsp;$end";
            if ($i != $page)
                $pagerarr[] = "<a href=\"{$href}page=$i\"><b>$text</b></a>";
            else
                $pagerarr[] = "<b>$text</b>";
        }
        $pagerstr = join(" | ", $pagerarr);
        $pagertop = "<p align=\"center\">$pager<br />$pagerstr</p>\n";
        $pagerbottom = "<p align=\"center\">$pagerstr<br />$pager</p>\n";
    }
    else {
        $pagertop = "<p align=\"center\">$pager</p>\n";
        $pagerbottom = $pagertop;
    }

    $start = $page * $rpp;

    return array($pagertop, $pagerbottom, "LIMIT $start,$rpp");
}

// http://stackoverflow.com/questions/2089590/mysqli-equivalent-of-mysql-result
// MySQLi RESULT
function mysqli_result($result,$row,$field=0) {
    if ($result===false) return false;
    if ($row>=mysqli_num_rows($result)) return false;
    if (is_string($field) && !(strpos($field,".")===false)) {
        $t_field=explode(".",$field);
        $field=-1;
        $t_fields=mysqli_fetch_fields($result);
        for ($id=0;$id<mysqli_num_fields($result);$id++) {
            if ($t_fields[$id]->table==$t_field[0] && $t_fields[$id]->name==$t_field[1]) {
                $field=$id;
                break;
            }
        }
        if ($field==-1) return false;
    }
    mysqli_data_seek($result,$row);
    $line=mysqli_fetch_array($result);
    return isset($line[$field])?$line[$field]:false;
}
?>
