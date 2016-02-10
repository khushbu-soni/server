<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Set_table extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('set_table_model', 'tables');
		$this->load->model('table_model', 'tables_m');
		$this->load->model('abstract_userlogin_model', 'users');
		$this->load->model('configruation_model');
		
	}

	public function index()
	{
		$this->data['tablenumbers'] = $this->configruation_model->only_tables();
// 		$table = $this->db->query("SELECT
// 	*
// FROM
// 	`table`
// WHERE
// 	`table`.inuse = '0' AND `table`.tablenumber in 
// (
// 		SELECT
// 			`table`.`tablenumber` AS table_tb
// 		FROM
// 			(`table`)
// 		JOIN `order` ON `order`.`tablenumber` != `table`.`tablenumber`
		
// 		GROUP BY
// 			table_tb 
// 	)ORDER BY `table`.tablenumber");


// 		$this->data['tablenumbers'] = $table->result();

		$query = $this->db->query("SELECT
	*
FROM
	`table`
WHERE
	`table`.inuse = '0' 

ORDER BY `table`.tablenumber");
		$this->data['use_table']=$query->result();

		$this->load->view('set_table',$this->data);
	}

	public function waiter_by_table()
	{
		$t_id = $this->input->post('tableId');
		
		$query=$this->db->query("select waiter_id from `table` where tablenumber=".$t_id);
		$res = $query->row();
		if(isset($res) && !empty($res)){
			echo $res->waiter_id;
		}else{
			echo '';
		}
		return $query->row();
		
		
	}

	public function setidentity()
	{

		if ($this->tables->set_identity()){

			$this->tables_m->insert_notification_table();
			redirect('customer', 'refresh');
		} else {
			$this->session->set_flashdata('errormsg', " Table in Used.");
			redirect('set_table', 'refresh');
		}

	}
}