<?php
  function linkToRedis(){
    $r = new Redis();
    $r->connect('127.0.0.1',6379);
    return $r;
  }
 ?>
