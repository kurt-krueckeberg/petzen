<?php

declare(strict_types=1);

use App\GenTools\tNail as thumbnail_maker;

include 'vendor/autoload.php';

// argv[1] == start direcory
if ($argc != 2) {
   echo "Image folder not passed.\n";
   return;
}

$start_dir = $argv[1];
$file_ext = 'jpg';

$jpg_iter = new \CallbackFilterIterator(
   new DirectoryIterator($start_dir),
   function (\SplFileInfo $info) use ($file_ext): bool {
      return $info->isfile() && $info->getExtension() === $file_ext;
   }
);

$t_maker =  new thumbnail_maker();

$functor = function (\SplFileInfo $info) use ($t_maker) {

   $fname = $info->getPathname();

   $output = $info->getPath() . 'thumbnails/t_' . $info->getBasename();

   $t_maker->generate($fname, 400, 400, $output);
};

foreach ($jpg_iter as $info)
   $functor($info);
