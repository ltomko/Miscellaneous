<?php

$file="file.txt";
$linecount = $errorcorunt = $successcount = 0;

$handle = fopen($file, "r");
while(!feof($handle)){

    $line = fgets($handle);
    
    //Check the line for a 4xx error or 5xx error and increment the error count if found
    $error = preg_match("/ 4[\d][\d] |  5[\d][\d] /", $line);
    if($error){ $errorcount++; }

    //Check the line for a 2xx response and increment the success count if found
    $success = preg_match("/ 2[\d][\d] /", $line);
    if($success){ $successcount++; }

    //Request
    preg_match("/(OPTIONS|GET|HEAD|POST|PUT|DELETE|TRACE|CONNECT|PATCH|PROPFIND) (.*) HTTP/", $line, $matches);

    //Add requests to an associative array (for fast lookup). Request => count
    if ($requests[$matches[2]]){ 
        $requests[$matches[2]] = $requests[$matches[2]] + 1;
    } else {
        $requests[$matches[2]] = 1;
    }

    //Referrer
    preg_match("/\"(http:|https:)(.*)\" /", $line, $matches);
    $matches = str_replace('"', "", $matches);

    //Add referrers to an associative array (for fast lookup). Referrer => count
    if ($ref[$matches[0]] && $matches[0] != NULL){ 
        $ref[$matches[0]] = $ref[$matches[0]] + 1;
    } else {
        $ref[$matches[0]] = 1;
    }

    //User Agent
    preg_match("/\"(Mozilla|Opera|Googlebot)(.*)\"/", $line, $matches);
    $matches = str_replace('"', "", $matches);

    //Add users to an associative array (for fast lookup). User => count
    if ($user[$matches[0]] && $matches[0] != NULL){ 
        $user[$matches[0]] = $user[$matches[0]] + 1;
    } else {
        $user[$matches[0]] = 1;
    }

    $linecount++;
  
}

fclose($handle);

// Sort arrays
arsort($requests);
arsort($ref);
arsort($user);

//Display Results
echo "Total entries: " . $linecount;
echo "<br><br>";
echo "Total errors: " . $errorcount;
echo "<br>";
echo "Total successful (2xx) requests: " . $successcount;
echo "<br><br>";

//Display top 25 Files
echo "Top 25 Files:<br>";
$count = 0;
foreach ($requests as $key => $value) {
    $request_percent = round($value / $linecount * 100);
    echo "(" . $request_percent . "%) ";
    echo $key;
    echo "<br>";
    if ($count >= 24){ break; }
    $count++;
}

echo "<br><br>";

//Display top 25 referrers
echo "Top 25 Referrers:<br>";
$count = 0;
foreach ($ref as $key => $value) {
    $ref_percent = round($value / $linecount * 100);
    echo "(" . $ref_percent . "%) ";
    echo $key;
    echo "<br>";
    if ($count >= 24){ break; }
    $count++;
}

echo "<br><br>";

//Display top 25 User Agents
echo "Top 25 User Agents:<br>";
$count = 0;
foreach ($user as $key => $value) {
    $user_percent = round($value / $linecount * 100);
    echo "(" . $user_percent . "%) ";
    echo $key;
    echo "<br>";
    if ($count >= 24){ break; }
    $count++;
}

?>
