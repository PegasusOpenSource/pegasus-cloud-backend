<?php
  $filename = $_GET['filename'];
  //header('Content-Type: text/css; charset=utf-8');
  function random_hash() {
    $length = 64;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
    }
    return hash('sha256', $randomString);
  }
  chdir('./lesscss');
  $file_temp_id = random_hash();
  shell_exec('lessc ' . $filename . '.less compiled/' . $file_temp_id . '.css');

  if (file_exists('./compiled/' . $file_temp_id . '.css')) {

    $compiled = file_get_contents('./compiled/' . $file_temp_id . '.css');
  } else {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    echo '/* The stylesheet you specified cannot be found*/';
    die();
  }
  
  
  echo $compiled;
  unlink('./compiled/' . $file_temp_id . '.css');

?>