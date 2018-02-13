<?php
/**
 * Created by IntelliJ IDEA.
 * User: iaaron
 * Date: 3/20/17
 * Time: 5:19 PM
 */

function consoleLog($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    //echo "<script>console.log( 'LOG: " . $output . "' );</script>";
    return null;
}