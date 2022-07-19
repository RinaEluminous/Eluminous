<?php 
$sources,
  'quiet' => true,
  'encodeMethod' => '',
  'lastModifiedTime' => 0
));
if (! $output['success']) {
  send404();
}

// Clear old cached files
if ($handle = @opendir($cachedir)) {
  while (false !== ($file = @readdir($handle))) {
    if ($file != '.' && $file != '..' && stristr($file, $filename)) {
      @unlink($cachedir . '/' . $file);
    }
  }
  @closedir($handle);
}

// Cache the output
error_reporting(0);
if (false === file_put_contents($cache, $output['content']) ||
  false === file_put_contents($cache.'.gz', gzencode($output['content'],9))) {
  echo "/* File writing failed. Your cache directory, {$cachedir}, must be writable by PHP. */\n";
  exit();
}

// And return it to the client
unset($output['headers']['Last-Modified'], $output['headers']['ETag']);
foreach ($output['headers'] as $name => $value) {
  header("{$name}: {$value}");
}
echo $output['content'];
?>