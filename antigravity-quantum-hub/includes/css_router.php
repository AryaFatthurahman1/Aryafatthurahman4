<?php
// Serve CSS directly
header('Content-Type: text/css');
header('Cache-Control: public, max-age=86400');
echo file_get_contents(__DIR__ . '/../assets/app.css');
exit;
