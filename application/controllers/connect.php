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
  
  function _createThumbnail($fileName) {
    $config['image_library'] = 'gd2';
    $config['source_image'] = 'uploads/' . $fileName;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = 75;
    $config['height'] = 75;

    $this->load->library('image_lib', $config);
    if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
  }
  
  public function auth()
  {
    $consumer = $this->config->item("twitter_consumer_token");
    $consumer_secret = $this->config->item("twitter_consumer_secret");
    $access_token = $this->config->item("twitter_access_token");
    $access_token_secret = $this->config->item("twitter_access_secret");
    $connection = $this->twitteroauth->create($consumer, $consumer_secret, $access_token, $access_token_secret);
    
    $regexp = "http:\/\/(\S*)";
    $namereg = "http:\/\/t.co\/(\S*)";
    $i = 0;
    $data = array(
        'count' => 200
    );
    
    foreach($content = $connection->get('statuses/mentions', $data) as $tweet){ 
    echo "<b>Tweet:</b> $tweet->text <br />";
     if(preg_match_all("/$regexp/i", $tweet->text, $match)){
      preg_match_all("/$namereg/i", $tweet->text, $img_name);
      $name = ($img_name[1][0]);
      echo $name;
      $uri = $match[0][0];
      echo "<b>URL: </b>$uri ";
      echo "<br/> <b>IMG?</b>";
      $gotten = file_get_contents($match[0][0]);
      $saved = file_put_contents("uploads/$name", $gotten);
      if(exif_imagetype("uploads/$name") == false ) {
        echo " no. <br />";
        unlink("uploads/$name");
        $i++;
      }
      else {
        echo " <b>YES!</b> <br/>";
        $this->_createThumbnail("$name");
        $pic = R::dispense('picture');        
        $pic->filename = "$name"."_thumb";
        $pic->url = "$uri";
        $pic->favorite = false;
        R::store($pic);
        unlink("uploads/$name");
        $this->image_lib->clear();
      }
     }
    }
  }

}