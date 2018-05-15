<?php
header( 'Content-type: text/html; charset=utf-8' );
include( "config.php" );

mysqli_set_charset( $db,"utf8" );
//	ini_set('default_charset', 'UTF-8');
$uuid = $_POST['uuid'];

$error = "\n\nFailed to update Group Tag.\nContact SS Pathfinder IT with the provided Error Message\n";


$Tag = "SELECT IFNULL(a.`DisplayName`, a.`username`) AS `name`, a.`active`, r.`rname`, t.`tag_name`, d.`colorX`, d.`colorY`, d.`ColorZ`, r.`RankLogo` FROM `accounts` a INNER JOIN `divisions` d ON a.`DivID` = d.`did` INNER JOIN `Rank` r ON a.`RankID` = r.`RankID` INNER JOIN `Titles` t ON a.`TitleID` = t.`tid` WHERE `UUID` = '$uuid' LIMIT 1";


$query = mysqli_query( $db,$Tag );
$Rows = mysqli_num_rows( $query );
if ( $Rows == 0 ) // Is there a record already?
{
    //No record on file they must be a civilian\observer
    echo "<255,255,255>:═══════\nCivilian\nSS Pathfinder";//\nBUG ".$Rows. "\nuuid = ".$uuid;
    //echo "<255,255,255>:".$Tag;
}
elseif ( $Rows == 1 )
{
    $list = mysqli_fetch_array( $query );

    $name = $list['name'];
    $rank = $list['rname'];
    $tag = $list['tag_name'];
    $colorX = $list['colorX'];
    $colorY = $list['colorY'];
    $colorZ = $list['ColorZ'];
    $logo = $list['RankLogo'];

    if ( 0 == $list['active'] )
    {
        echo "<255,255,255>:".$logo."\nCivilian\nSS Pathfinder";
    }
    else
    {
        echo "<".$colorX.",".$colorY.",".$colorZ.">:".$logo."\n".$rank."\n".$name."\n".$tag."\nSS Pathfinder";
    }

}



?>
