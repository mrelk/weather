<?php

  $users = DB::table('service')->get();
  echo $users[1]->serviceIdx;
  //echo $users->count;
  
  $results = DB::table('service')->count();
  echo $results;
//  $user = DB::table('service')->find(1);
  //dd($user);  // dd means: die(var_dump($user));
  //echo $user->username;


?>