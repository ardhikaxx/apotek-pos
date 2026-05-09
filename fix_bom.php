<?php
$file = 'database/seeders/CategorySeeder.php';
$content = file_get_contents($file);
$content = preg_replace('/^\xEF\xBB\xBF/', '', $content);
file_put_contents($file, $content);
echo "BOM removed from CategorySeeder.php\n";
