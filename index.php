<?php
if (!empty($_POST["URLs"])) {
        $array_urls = explode("\n", $_POST['URLs']);
        $array_ids = array();
        for ($i=0;$i<count($array_urls);$i++) {
                if (strpos($array_urls[$i], "app") == true) {
                        preg_match("/\bapp\/([^\/]+)/", $array_urls[$i], $matches);
                        $array_ids[] = $matches[1];
                } elseif (strpos($array_urls[$i], "sub") == true) {
                        preg_match("/\bsub\/([^\/]+)/", $array_urls[$i], $matches);
                        $array_ids[] = $matches[1];
                } else {
                        echo "error";
                }
        }
        function numeric_only($array) {
                foreach ($array as $value) {
                        if (!is_numeric($value)) {
                                return false;
                        }
                }
                return true;
        }
        if (numeric_only($array_ids) == true) {
                $arguments_list = implode(" ", $array_ids);
                $output = "output".time().".txt";
                exec("/usr/bin/python maketable.py $output ".$arguments_list);
                header("location:$output");
                exit;
        } else {
                echo "HA! Sure buddy";
                exit;
        }
}
?>
<!DOCTYPE html>
<html>
        <head>
                <link href="stylesheet.css" rel="stylesheet" type="text/css">
                <title>Itty bitty Steam Sales Table Generator</title>
        </head>
        <body>
                <form method="POST">
                <textarea name="URLs"></textarea></br>
                <input type=submit value="Get dem deals">
                </form>
        </body>
</html>
