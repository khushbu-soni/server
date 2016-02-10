<?php
class transaction_model extends CI_Model{
    //__construct
    //Constructor for payment
    public function __construct() {
        //$this->load->database();
    }
    
    public function insert_transaction($order_id=null,$amount,$date=null,$type,$narration,$payment_against,$mode,$supplier_id=null,$staff_id=null){
            if($order_id==null)
                $order_id=0;
            if($date==null)
                $date=date('Y-m-d');
            if($supplier_id)
                    $payment_against='supplier';
            if($staff_id)
                    $payment_against='staff';
            $data = array(
                'order_id' =>$order_id,
                'amount' =>$amount,
                'transaction_date' =>date('Y-m-d H:i:s'),
                'transaction_type' =>$type,
                'staff_id' =>$staff_id,
                'supplier_id' =>$supplier_id,
                'narration' =>$narration,
                'payment_against' =>$payment_against,
                'mode' =>$mode
                
            );
            $this->db->insert('transaction',$data);
            return $this->db->insert_id();
    }

    public function get_all($type){
                    $query=$this->db->query("SELECT
                `transaction`.id,
                order_id,
                amount,
                transaction_date,
                transaction_type,
                narration,
            supplier_id,
            staff_id,
            suppliers.name as supp_name,
            staff.fname as staff_name
            FROM
                `transaction`
            left JOIN staff on staff.id=`transaction`.staff_id
            left JOIN suppliers on suppliers.id=`transaction`.supplier_id
            WHERE
                transaction_type ='".$type."'");
        return $query->result_array();
    }

    public function update_data($res){
      
        if(!$res['narration'])
            $narration=" ";
        if(!isset($res['supplier']))
            $supplier=0;
        if(!isset($res['staff']))
                $staff=0;
        $data = array('amount' =>$res['amount'],'narration'=>$res['narration'],'supplier_id'=>$res['supplier'],'staff_id'=>$res['staff'],'payment_against'=>$res['payment_against'],'mode'=>$res['mode']);
      
        $condition = array(
            'id' => $res['id'],
             );
        $this->db->where($condition);
        $this->db->update('transaction', $data); 

            return TRUE;
        // if ($this->db->affected_rows())
        // return FALSE;

    }

    public function get_by_id($id){
        $query=$this->db->query("SELECT staff_id,supplier_id,transaction_type,amount,narration,payment_against,mode FROM `transaction` where id='".$id."'");
        return $query->result_array();
    }
    
    public function delete_by_id($id){
        $query=$this->db->query("DELETE  FROM `transaction` where id='".$id."'");
        if ($this->db->affected_rows()>0)
            return true;
        else
            return false;
    }
    
    public function get_received_payment($start_date,$end_date){
        $query=$this->db->query("SELECT `transaction`.*, staff.fname,suppliers.`name`   
                                FROM
                                `transaction`
                                left JOIN staff on staff.id=`transaction`.staff_id
                                LEFT JOIN suppliers on suppliers.id=`transaction`.supplier_id
                                WHERE transaction_date between '".$start_date."' AND  '". $end_date."' ");
                                return $query->result_array();
    }
    public function get_paid_payment($start_date,$end_date){
        $query=$this->db->query("SELECT `transaction`.amount as paid_amount, `transaction`.narration as paid_narration, `transaction`.order_id, staff.fname, suppliers.`name`
                                 FROM
                                 `transaction`
                                 left JOIN staff on staff.id=`transaction`.staff_id
                                 LEFT JOIN suppliers on suppliers.id=`transaction`.supplier_id
                                WHERE transaction_date between '".$start_date."' AND '". $end_date."' AND "." transaction_type='Paid'");
        return $query->result_array();
    }

    public function get_paid_salary($start_date,$end_date){
        $query=$this->db->query("SELECT `transaction`.*, staff.fname,suppliers.`name`   
                                FROM
                                `transaction`
                                left JOIN staff on staff.id=`transaction`.staff_id
                                LEFT JOIN suppliers on suppliers.id=`transaction`.supplier_id
                                WHERE
                                transaction_date between '".$start_date."' AND '". $end_date."' AND "." transaction_type='Paid' AND staff_id != null or staff_id !=0");
        return $query->result_array();
    }

    public function get_payment_by_directors($start_date,$end_date){
            $query=$this->db->query("SELECT `transaction`.*, staff.fname,suppliers.`name`   
                                FROM
                                `transaction`
                                left JOIN staff on staff.id=`transaction`.staff_id
                                LEFT JOIN suppliers on suppliers.id=`transaction`.supplier_id
                                WHERE
                                transaction_date between '".$start_date."' AND '". $end_date."' AND "." payment_against='directors'");
        return $query->result_array();
    }

    public function get_supplier_payment($start_date,$end_date){
        $query=$this->db->query("SELECT `transaction`.*, staff.fname,suppliers.`name`   
                                FROM
                                `transaction`
                                left JOIN staff on staff.id=`transaction`.staff_id
                                LEFT JOIN suppliers on suppliers.id=`transaction`.supplier_id
                                WHERE transaction_date between '".$start_date."' AND '". $end_date."' AND "." transaction_type='Paid' AND supplier_id != null or supplier_id !=0");
        return $query->result_array();
    }

    public function get_paid_to_bank($start_date,$end_date){
        $query=$this->db->query("SELECT `transaction`.*, staff.fname,suppliers.`name`   
                                FROM
                                `transaction`
                                left JOIN staff on staff.id=`transaction`.staff_id
                                LEFT JOIN suppliers on suppliers.id=`transaction`.supplier_id
                                WHERE transaction_date between '".$start_date."' AND '". $end_date."' AND "." transaction_type='Paid' AND payment_against='bank'");
        return $query->result_array();
    }
    
    public function total_paid_salary($start_date,$end_date){

            $query=$this->db->query("SELECT SUM(amount) as amount from `transaction` 
                                    WHERE transaction_type='Paid' 
                                    and transaction_date BETWEEN '".$start_date."' AND '".$end_date."' AND staff_id!=null or staff_id!=0 ");
            // echo $this->db->last_query();
            return $query->result_array();
    }

    public function total_paid_to_bank($start_date,$end_date){

         $query=$this->db->query("SELECT SUM(amount) as amount from `transaction` 
                                    WHERE transaction_type='Paid' 
                                    and transaction_date BETWEEN '".$start_date."' AND '".$end_date."' AND payment_against='bank'");
            // echo $this->db->last_query();
            return $query->result_array();

    }

     public function total_received_from_bank($start_date,$end_date){

         $query=$this->db->query("SELECT SUM(amount) as amount from `transaction` 
                                    WHERE transaction_type='Received' 
                                    and transaction_date BETWEEN '".$start_date."' AND '".$end_date."' AND payment_against='bank' ");
            // echo $this->db->last_query();
            return $query->result_array();

    }

    public function total_paid_to_directors($start_date,$end_date){
        $query=$this->db->query("SELECT SUM(amount) as amount from `transaction` 
                                    WHERE transaction_type='Paid' AND payment_against='directors' 
                                    and transaction_date BETWEEN '".$start_date."' AND '".$end_date."'");
            // echo $this->db->last_query();
            return $query->result_array();
    }


    
     public function total_received_from_directors($start_date,$end_date){
        $query=$this->db->query("SELECT SUM(amount) as amount from `transaction` 
                                    WHERE transaction_type='Received' AND payment_against='directors' 
                                    and transaction_date BETWEEN '".$start_date."' AND '".$end_date."'");
            // echo $this->db->last_query();
            return $query->result_array();
    }

    public function total_paid_to_supplier($start_date,$end_date){

            $query=$this->db->query("SELECT SUM(amount) amount from `transaction` 
                                    WHERE transaction_type='Paid' 
                                    and transaction_date BETWEEN '".$start_date."' AND '".$end_date."'"."AND supplier_id!=null or supplier_id!=0 ");
            return $query->result_array();
    }

     public function total_paid($start_date,$end_date){

            $query=$this->db->query("SELECT SUM(amount) as amount from `transaction` 
                                    WHERE transaction_type='Paid' 
                                    and transaction_date BETWEEN '".$start_date."' AND '".$end_date."'  ");
         
            return $query->result_array();
    }

    public function total_received_payment($start_date,$end_date){

            $query=$this->db->query("SELECT SUM(amount) as amount from `transaction` 
                                    WHERE transaction_type='Received' 
                                    and transaction_date BETWEEN '".$start_date."' AND '".$end_date."' or order_id!=0 or order_id!=null");
            // echo $this->db->last_query();
            return $query->result_array();
    }

    public function get_item_info($start_date,$end_date,$restro='no'){
        $query_string="SELECT
                                    SUM(orderitem.quantity) as quantity,
                                   menuitem.price,
                                    menuitem.item_no,
                                    menuitem.`name`,
                                   menuitem.res_category,
                                    (quantity * menuitem.price) as amount
                                FROM
                                    `order`
                                JOIN orderitem ON orderitem.orderid = `order`.id
                                JOIN menuitem ON menuitem.id = orderitem.menuid";
         $query_string.=" WHERE `order`.date between '".$start_date."' and '".$end_date."'";
         if($restro!="no")
            $query_string.=" AND   menuitem.`res_category`='".$restro."'";
        $query_string.="GROUP BY menuitem.name";
                                

        $query=$this->db->query($query_string);
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function total_take_away($start_date,$end_date,$restro='no'){
        $query_string="SELECT
                            COUNT(*)AS total_take_away
                        FROM
                            `order`
                        JOIN 
                        orderitem
                        ON
                        `order`.id=orderitem.orderid
                        JOIN
                        menuitem
                        ON
                        menuitem.id=orderitem.menuid";
            $query_string.=" WHERE tablenumber=null or tablenumber=0 and `date` between '".$start_date."' and '".$end_date."'";
            if($restro!='no')
                $query_string.=" And menuitem.res_category='".$restro."'";
        $query=$this->db->query($query_string);
       
        return $query->row_array(); 
    }

    public function total_table_order($start_date,$end_date,$restro='no'){
         $query_string="SELECT COUNT(*) as table_order 
                          FROM
                            `order`
                        JOIN 
                        orderitem
                        ON
                        `order`.id=orderitem.orderid
                        JOIN
                        menuitem
                        ON
                        menuitem.id=orderitem.menuid";
                        $query_string.=" WHERE tablenumber!=null or tablenumber!=0 and `date` between '".$start_date."' and '".$end_date."'";
                    if($restro!='no')
                            $query_string.=" And menuitem.res_category='".$restro."'";    
        $query=$this->db->query($query_string);
        echo $this->db->last_query();
        return $query->row_array(); 
    }
}
?>
