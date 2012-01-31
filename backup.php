<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Connect extends CI_Controller {
  
  public function __construct()
   {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('twitteroauth');
    		$this->config->load('twitter');              
   }

  public function index() {
    
echo 'Yesterday: '. date('Y-m-d', strtotime('-1 day')) ."\n";
  }
  
  public function auth()
  {
    $consumer = $this->config->item("twitter_consumer_token");
    $consumer_secret = $this->config->item("twitter_consumer_secret");
    $access_token = $this->config->item("twitter_access_token");
    $access_token_secret = $this->config->item("twitter_access_secret");
    $connection = $this->twitteroauth->create($consumer, $consumer_secret, $access_token, $access_token_secret);
    
    $regexp = "http:\/\/(\S*\w*\s)";
    $i = 0;
    $data = array(
        'count' => 200
    );
    
    foreach($content = $connection->get('statuses/home_timeline', $data) as $tweet){ 
     if(preg_match_all("/$regexp/i", $tweet->text, $match)){
      $gotten = file_get_contents($match[0][0]);
      echo "Tweet: $tweet->text <br />URL: ";
      print_r($match[0][0]);
      echo "<br /> Image: ";
      $saved = file_put_contents("uploads/$i", $gotten);
      if(exif_imagetype("uploads/$i") == false ) {
        echo " no. <br />";
        $i++;
      }
      else {
        echo "YES";
      }
     }
    }
  }

}