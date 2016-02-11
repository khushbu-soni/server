<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class menuitems extends CI_Controller {
	public $data;
    
    public $response=array();

	public function __construct()
	{
		parent::__construct();
		
	}

	

public	function index(){
			$query=$this->db->query("SELECT menutype.menutype_name,menuitem.`name` as menu_name,menutype.menutype_name,menuitem.`price` as price, menuitem.description, menuitem.keywords as ingredients, menuitem.picturepath as img_url from menutype JOIN menuitem on menuitem.type=menutype.id WHERE menuitem.available=1");
		  	$menuitem_info=$query->result_array();
		  	echo json_encode($menuitem_info);
	}


	
}