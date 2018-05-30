<?php
if (file_exists('config.ini.php')) {
  include_once('config.ini.php');
}
if (file_exists('replace.rules.txt')) {
  $rules = file('replace.rules.txt');
}
$content = file_get_contents($s['mainsite'] . $_GET['url']);
$search = '';
$place = '';

foreach ($rules as $line) {
  $line = trim($line, "\n");
  if (substr($line,0,1) != '#') {
    if ($search == '') {
      $search = trim($line);
    } else if ($place == '') {
      $place = $line;
      $content = preg_replace($search, $place, $content);
      $search = '';
      $place = '';
    }
  }
}
echo $content;
?>