<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Yourbill extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
			
		
	$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->checkTableIdentity();
		$this->data['menuheader'] = $this->load->view('customer/menuheader', '', TRUE);
		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['paymentheader'] = $this->load->view('customer/paymentheader', '', TRUE);
		$this->data['callwaiter'] = $this->load->view('customer/callwaiter', '', TRUE);
		$this->data['cashpayment'] = $this->load->view('customer/cashpayment', '', TRUE);
		$this->data['game'] = $this->load->view('customer/game', '', TRUE);
		$this->data['profile'] = $this->load->view('customer/profile', '', TRUE);


		$this->load->model('orderitem_model', 'orderitems');
		$this->load->model('calculations');
		$this->load->model('coupon_model', 'coupons');
		$this->load->model('payment_model', 'payments');
		$this->load->model('coupon_model', 'coupons');

	
	}

	public function index()
	{
		$this->data['unpaid_items'] = $this->orderitems->get_unpaid_items();


		$unpaid_ids = "";
		foreach ($this->data['unpaid_items'] as $unpaid_item){
			if ($unpaid_ids == ""){
				$unpaid_ids = $unpaid_ids . $unpaid_item->id;
			} else {
				$unpaid_ids = $unpaid_ids . ',' . $unpaid_item->id;
			}
		}
		$this->data['unpaid_ids'] = $unpaid_ids;
		$this->data['values'] = $this->calculations->get_values();

		$this->load->view('customer/yourbill', $this->data);
	}

	public function comment_insert($menuid,$orderid)
	{


		//echo $this->input->post('comment');
		$data= array(	
			
			'comment'=> $this->input->post('comment'),	
			'comment_status' => 1,
			'comment_date' => date('Y-m-d H:i:s')	
			);


		$condition= array(
			'menuid'=> $menuid,
			'orderid'=> $orderid
			
			

			);

		$this->db->update('orderitem',$data,$condition);
		
	return redirect('customer/yourbill','refresh');
	}


	public function getrate()
	{
		
	


		$condition= array(
			'menuid'=> $this->input->post('menuid'),
			'orderid'=> $this->input->post('orderid')
			
			

			);

		


		$query= $this->db->where($condition)->get('orderitem');
		$results = $query->result();
		//print_r($results);+
		
			
			foreach ($results as $result) {
				
			$current_rating = $result->total_votes;

			$new_back = array();
			
			for($i=0;$i<5;$i++)
			{
				$j=$i+1;
				if($i<@number_format($current_rating)) $class="ratings_stars ratings_vote";
				else $class="ratings_stars";
				               
            
			$new_back[] .= '<div class="star_'.$j.' '.$class.'"></div>';
			 
			 
			 }
			
			

			$allnewback = join("\n", $new_back);

			// ========================


			$output = $allnewback;
			}
			echo $output;
			

		
	//	$this->load->view('customer/yourbill', $this->data);
	}


	public function rate()
	{
		
	$data= array(	
			
			'total_votes'=> $this->input->post('rate'),	
			'total_valuve' => $this->input->post('rate'),
			'comment_date' => date('Y-m-d H:i:s')	
			);


		$condition= array(
			'menuid'=> $this->input->post('menuid'),
			'orderid'=> $this->input->post('orderid')
			
			

			);

		$this->db->update('orderitem',$data,$condition);
		//echo 'sucess';

		$menurate=$this->db->query("SELECT sum(total_votes) AS rate from orderitem where menuid= ".$this->input->post('menuid'));

		$data = $menurate->row();
		//exit();

		$avg = ($data->rate*100)/5;

		$data= array(	
			
			'rating'=> $avg	
			
			);

		$condition2= array(
			'id'=> $this->input->post('menuid')
			
			
			

			);
		$this->db->update('menuitem',$data,$condition2);


		$query= $this->db->where($condition)->get('orderitem');
		$results = $query->result();

foreach ($results as $result) {

$current_rating = $result->total_votes;







$new_back = array();
for($i=0;$i<5;$i++){
	$j=$i+1;
	if($i<@number_format($current_rating)) $class="ratings_stars ratings_vote";
	else $class="ratings_stars";
$new_back[] .= '<div class="star_'.$j.' '.$class.'"></div>';
                      }


$allnewback = join("\n", $new_back);

// ========================


$output = $allnewback;
}
echo $output;

		
	//	$this->load->view('customer/yourbill', $this->data);
	}



	function get_smiley_array()
{
$smileys = array(

//	smiley			image name						width	height	alt
	':)'			=>	array('grin.gif',			'19',	'19',	'grin'),
	':-)'			=>	array('grin.gif',			'19',	'19',	'laugh'),
	':lol:'			=>	array('lol.gif',			'19',	'19',	'LOL'),
	':cheese:'		=>	array('cheese.gif',			'19',	'19',	'cheese'),
	':)'			=>	array('smile.gif',			'19',	'19',	'smile'),
	';-)'			=>	array('wink.gif',			'19',	'19',	'wink'),
	';)'			=>	array('wink.gif',			'19',	'19',	'wink'),
	':smirk:'		=>	array('smirk.gif',			'19',	'19',	'smirk'),
	':roll:'		=>	array('rolleyes.gif',		'19',	'19',	'rolleyes'),
	':-S'			=>	array('confused.gif',		'19',	'19',	'confused'),
	':wow:'			=>	array('surprise.gif',		'19',	'19',	'surprised'),
	':bug:'			=>	array('bigsurprise.gif',	'19',	'19',	'big surprise'),
	':-P'			=>	array('tongue_laugh.gif',	'19',	'19',	'tongue laugh'),
	'%-P'			=>	array('tongue_rolleye.gif',	'19',	'19',	'tongue rolleye'),
	';-P'			=>	array('tongue_wink.gif',	'19',	'19',	'tongue wink'),
	':P'			=>	array('rasberry.gif',		'19',	'19',	'rasberry'),
	':blank:'		=>	array('blank.gif',			'19',	'19',	'blank stare'),
	':long:'		=>	array('longface.gif',		'19',	'19',	'long face'),
	':ohh:'			=>	array('ohh.gif',			'19',	'19',	'ohh'),
	':grrr:'		=>	array('grrr.gif',			'19',	'19',	'grrr'),
	':gulp:'		=>	array('gulp.gif',			'19',	'19',	'gulp'),
	'8-/'			=>	array('ohoh.gif',			'19',	'19',	'oh oh'),
	':down:'		=>	array('downer.gif',			'19',	'19',	'downer'),
	':red:'			=>	array('embarrassed.gif',	'19',	'19',	'red face'),
	':sick:'		=>	array('sick.gif',			'19',	'19',	'sick'),
	':shut:'		=>	array('shuteye.gif',		'19',	'19',	'shut eye'),
	':-/'			=>	array('hmm.gif',			'19',	'19',	'hmmm'),
	'>:('			=>	array('mad.gif',			'19',	'19',	'mad'),
	':mad:'			=>	array('mad.gif',			'19',	'19',	'mad'),
	'>:-('			=>	array('angry.gif',			'19',	'19',	'angry'),
	':angry:'		=>	array('angry.gif',			'19',	'19',	'angry'),
	':zip:'			=>	array('zip.gif',			'19',	'19',	'zipper'),
	':kiss:'		=>	array('kiss.gif',			'19',	'19',	'kiss'),
	':ahhh:'		=>	array('shock.gif',			'19',	'19',	'shock'),
	':coolsmile:'	=>	array('shade_smile.gif',	'19',	'19',	'cool smile'),
	':coolsmirk:'	=>	array('shade_smirk.gif',	'19',	'19',	'cool smirk'),
	':coolgrin:'	=>	array('shade_grin.gif',		'19',	'19',	'cool grin'),
	':coolhmm:'		=>	array('shade_hmm.gif',		'19',	'19',	'cool hmm'),
	':coolmad:'		=>	array('shade_mad.gif',		'19',	'19',	'cool mad'),
	':coolcheese:'	=>	array('shade_cheese.gif',	'19',	'19',	'cool cheese'),
	':vampire:'		=>	array('vampire.gif',		'19',	'19',	'vampire'),
	':snake:'		=>	array('snake.gif',			'19',	'19',	'snake'),
	':exclaim:'		=>	array('exclaim.gif',		'19',	'19',	'excaim'),
	':question:'	=>	array('question.gif',		'19',	'19',	'question') // no comma after last item

		);
	return $smileys;
}
	function parse_smileys($str = '', $image_url = '', $smileys = NULL)
	{
		if ($image_url == '')
		{
			return $str;
		}

		if ( ! is_array($smileys))
		{
			if (FALSE === ($smileys = get_smiley_array()))
			{
				return $str;
			}
		}

		// Add a trailing slash to the file path if needed
		$image_url = preg_replace("/(.+?)\/*$/", "\\1/",  $image_url);

		foreach ($smileys as $key => $val)
		{
			$str = str_replace($key, '<img style="border: 0;" alt="\&quot;&quot;.$smileys[$key][3].&quot;\&quot;" src="\&quot;&quot;.$image_url.$smileys[$key][0].&quot;\&quot;" width="\&quot;&quot;.$smileys[$key][1].&quot;\&quot;" height="\&quot;&quot;.$smileys[$key][2].&quot;\&quot;" />', $str);
		}

		return $str;
}
//usage
function parse_smileys_call()
{
echo parse_smileys($message, $smiley_folder);
}



}