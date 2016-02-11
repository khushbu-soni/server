<?php
class stock_transaction_model extends CI_Model{
    //__construct
    //Constructor for payment
    public function __construct() {
        //$this->load->database();
    }
    
    //get_payments
    //Get all payments
   
    //insert_payment
    //add payment
    public function insert_stock_transaction(){
           
            
            $data = array(
                'paymenttype' =>0,
                'amount' =>$amount,
                'tipamount' =>$tipamount,
                'couponcode' =>$coupon,
                'tax' =>$taxamount,
                'customer_unique_id' =>$customer_unique_id
            );
            // print_r($data);
            // exit();
            $this->db->insert('stock_transaction',$data);
            return $this->db->insert_id();
        }

    public function get_all($type=null,$from_date=null,$to_date=null){
        if(!$from_date)
            $from_date=date('Y-m-d');
        if(!$to_date)
            $to_date=date('Y-m-d');
        $q="SELECT sum(stock_transaction.qty) as qty,stock_transaction.`date`, ingredients.`name`
                            FROM
                                stock_transaction
                            JOIN ingredients ON
                            stock_transaction.item_id = ingredients.id
                            where stock_transaction.`date` between '".$from_date."' and '".$to_date."'
                            ";
        if($type){
            $q=$q." and stock_transaction.type='".$type."'";
        }
        $q=$q." Group By ingredients.`name`";
        $query=$this->db->query($q);
        return $query->result();
        // echo $this->db->last_query();
    }




    //updates the status of the items paid for
    
}
?>
