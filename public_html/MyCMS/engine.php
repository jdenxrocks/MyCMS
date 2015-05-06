<?php
Class Template {
    var $getfile;
    var $content;

    function url_get_contents ($url) {
        if (function_exists('curl_exec')){ 
            $conn = curl_init($url);
            curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($conn, CURLOPT_FRESH_CONNECT,  true);
            curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
            $url_get_contents_data = (curl_exec($conn));
            curl_close($conn);
        }elseif(function_exists('file_get_contents')){
            $url_get_contents_data = file_get_contents($url);
        }elseif(function_exists('fopen') && function_exists('stream_get_contents')){
            $handle = fopen ($url, "r");
            $url_get_contents_data = stream_get_contents($handle);
        }else{
            $url_get_contents_data = false;
        }
            return $url_get_contents_data;
        } 
    function __construct($myfile) {
        $this->getfile = $myfile;
        $this->content = $this->url_get_contents($myfile);
        return 1;
    }   
    function set($tag, $value) {
        $string = "[@" . $tag . "]";
        $this->content = str_replace($string, $value, $this->content);
    }
    function output($echo) {
        if ($echo) {
            echo $this->content;
        }
        return $this->content;
    }
}