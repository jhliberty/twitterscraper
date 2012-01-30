<?php

  // App is loaded here and saved on post_system.php (shutdown). it's variables are stored in the session
  function pre_controller()
  {
      // for internet explorer cookies
      header('P3P: CP="CAO PSA OUR"');

      // use sessions baby
      @session_start();

      // redbean
      include(APPPATH.'/config/database.php');
      include(APPPATH.'/third_party/rb/rb.php');
  
      // Database data
      $host = $db[$active_group]['hostname'];
      $user = $db[$active_group]['username'];
      $pass = $db[$active_group]['password'];
      $db = $db[$active_group]['database'];

      // Setup DB connection
      R::setup("mysql:host=$host;dbname=$db", $user, $pass);
  }

?>