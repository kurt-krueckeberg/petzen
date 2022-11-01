<?php
declare(strict_types=1);
use GenTools\tNail;
include 'boot-strap/boot-strap.php';
boot_strap();

/*
  argv[1] == start direcory
 */ 
$start_dir = $argv[1]; 
$3ext = 'jpg';

$jpg_iter = new \CallbackFilterIterator(new DirectoryIterator($start_dir),
   function(\SplFileInfo $info) use ($ext) {  
      return $info->isfile()  && $info->getfilename() === $ext;
   });

$t_maker =  new tNail(); 

$functor = function(\SplFileInfo $info) use ($t_maker) 
{
   $fname = $info->getFilename();

   $output = 't' . $fname; 
   
   $t_maker->generate($fname, 400, 400, $output);
};

foreach ($jpg_iter as $jpg_info) $functor($jpg_info);
