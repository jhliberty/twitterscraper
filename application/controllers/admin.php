<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
  }

	public function index()
	{
	  $this->load->helper('html');
	  $this->load->helper('url');
	  $pics = R::find('picture');
	  $data['pics'] = $pics;
    $this->load->view('dashboard', $data);
	}
		
	public function favorite($filename)
	{
	  $pic = R::findOne('picture', "filename = '$filename'");
	  if($pic['favorite'] == true)
	  {
	    $pic->favorite = false;
	  }
	  else
	  {
	    $pic->favorite = true;
	  }
	  R::store($pic);
    redirect('admin', 'location'); 
	}
	
	public function mark_spam($filename)
	{
	  $pic = R::findOne('picture', "filename = '$filename'");
	  $pic->spamcount = $pic->spamcount+1;
	  R::store($pic);
	  redirect('admin', 'location');
	}
	
	public function delete($filename)
	{
	  $pic = R::findOne('picture', "filename = '$filename'");
	  R::trash($pic);
	  redirect('admin', 'location');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */