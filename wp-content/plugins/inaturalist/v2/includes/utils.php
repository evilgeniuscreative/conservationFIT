<?php
/**
 * Created by:
 * Programmer: Ian Kleinfeld for http://www.jmp.com
 * Date: 3/20/17
 * Time: 5:19 PM
 */

function set_url_from_text($text)
{
    // The Regular Expression filter
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

// The Text you want to filter for urls
//    $text = "The text you want to filter goes here. http://google.com";

// Check if there is a url in the text
    if (preg_match($reg_exUrl, $text, $url)) {

        // make the urls hyper links
        $output = preg_replace($reg_exUrl, '<a href="'.$url[0].'">'.$url[0].'</a>', $text);

} else {
        // if no urls in the text just return the text
        $output = $text;
    }

    return $output;
}

 function strip_returns_newlines($input){
     $output = str_replace(array("\r", "\n"), '', $input);
     $output = str_replace("'","&lsquo;",$output);
     $output = str_replace("\"","\\\"",$output);
     return $output;
 }

 function convert_copyright($input){
     $output = str_replace("(c)",'&copy;<br/>',$input);
     return $output;
 }

function truncate_text($input,$chars,$link) {


    $parts = preg_split('/([\s\n\r]+)/', $input, null, PREG_SPLIT_DELIM_CAPTURE);
    $parts_count = count($parts);

    $length = 0;
    $last_part = 0;
    for (; $last_part < $parts_count; ++$last_part) {
        $length += strlen($parts[$last_part]);
        if ($length > $chars) { break; }
    }

    $output = implode(array_slice($parts, 0, $last_part));

    //$output = substr($input, 0, strrpos(substr($input, 0, $chars), ' '));
 if ($chars < strlen($input)){
     $output .= ' ...  <a href="'.$link.'">more</a>';
 }



    return $output; //.', '. $chars .', '. strlen($output);
}