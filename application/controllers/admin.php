<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function speak()
	{
	  $jake = R::dispense('person');
	  $jake->name = "Jake Sir";
	  $jake->hair_color = "Black";
	  $jake->is_male = true;
	  $jake->age = 27;
	  R::store($jake);
	  
	  print_r($jake);
	}
	
	public function say()
	{
	  $person = R::findOne('person', "name = 'Jake'");
	  $result = $person->export();
	  print_r($result);
	}
	
	public function update($name)
	{
	  $person = R::findOne('person', "name = '$name'");
	  $person->hair_color = "Blue";
	  R::store($person);
	  echo "Successfully updated";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */