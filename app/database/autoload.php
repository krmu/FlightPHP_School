<?php

$files = glob(__DIR__ . '/model_*.php');
if ($files === false) {
    throw new RuntimeException("Failed to glob for function files");
}else{
    foreach ($files as $file)  require_once $file;
}
 