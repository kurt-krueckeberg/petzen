<?php
declare(strict_types=1);
/*
  argv[1] == start direcory
 */ 
$start_dir = $argv[1]; 

$jpg_iter = new \CallbackFilterIterator(new DirectoryIterator($start_dir),
   function(\SplFileInfo $info) use ($ext) {  
      return $info->isfile()  && $info->getfilename() === $ext;
   });

$t_maker =  new thumbGenerator(); 

$functor = function(\SplFileInfo $info) use ($t_maker) 
{
   $base_name = $info->getBasename('.md');

   $output = $base_name . '.html'; 
   
   $t_maker->generate();
   
   fix_td_tags($base_name);
};

foreach ($jpg_iter as $jpg_info) $functor($jpg_info);