<?php
session_start();
$vars=( isset( $HTTP_POST_VARS ) && array_count_values($HTTP_POST_VARS) ) ? $HTTP_POST_VARS : $HTTP_GET_VARS;
// foreach ( $GLOBALS as $key=>$value )
//    {
//    print "\$GLOBALS[\"$key\"] == $value<br>";
//    }
if (session_is_registered ("session_path"))
	{
	if($session_cnt + 1 < count($session_path))
	        {
	        $session_cnt ++;
	        $new_path = $session_path[$session_cnt % 15];
                header("Location:http://localhost$new_path");
	        }
	 }
?>
