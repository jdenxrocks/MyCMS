<?php
//require_once("engine.php");
class MyCMS {
    function __construct() {
        
    }
    function url_get_contents ($url) {//Find the most efficient possible way to grab data
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
    function newFile($path, $content) {
        $myfile = fopen($path, "w") or die("Unable to open file!");
        fwrite($myfile, $content);
        fclose($myfile);
        return true;
    }
    function postIds() {
        //Get post ID'S
        $dirs = glob(__DIR__ . "/data/posts" . '/*' , GLOB_ONLYDIR);
        $postids = array();
        foreach ($dirs as $a) {
            $a = explode("/", $a);
            $a = $a[count($a) - 1];
            $a = (int) $a;
            array_push($postids, $a);
        }
        return $postids;
    }
    function newPost($author, $date, $title, $content){
        //Get post ID'S
        $postids = $this->postIds();
        $newid = max($postids)+1;
        $path = __DIR__ . "/data/posts/" . $newid . "/";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $json = array(
            "author" => $author,
            "date" => $date,
            "title" => $title,
            "content" => $content
            );
        $json = json_encode($json, JSON_PRETTY_PRINT);
        $this->newFile($path . "/post.json", $json);
        if (file_exists($path . "/post.json")) {
            return true;
        } else {
            return false;
        }

    }
    function getPost($id) {
        //Get post ID'S
        $dirs = glob(__DIR__ . "/data/posts" . '/*' , GLOB_ONLYDIR);
        $postids = array();
        foreach ($dirs as $a) {
            $a = explode("/", $a);
            $a = $a[count($a) - 1];
            $a = (int) $a;
            array_push($postids, $a);
        }
        /*if (array_search($id, $postids)) {
            exit("Post not found");
        }*/
        $postlocation = __DIR__ . "/data/posts/" . (string) $id . "/post.json";
        $post = file_get_contents($postlocation);
        $post = json_decode($post, 1);
        return $post;
    }
}

/*$mycms = new MyCMS();
$string = <<<HTML
<img src="http://i.imgur.com/QDX7QH7.png" style="border:solid 1px black;">
<p>Support for an authentication framework is in the works. I have searched high and low for a framework that supports the needs for MyCMS and I haven't found anything. I've decided to rebuild the wheel and create a framework specifically for MyCMS. The framework will use PDO and the latest BCRYPT hashing/salting functions. </p>

HTML;
echo $mycms->newPost("Jayden", "2015-04-13", $string);

$post = $mycms->getPost(2);
echo $post['content'];
*/