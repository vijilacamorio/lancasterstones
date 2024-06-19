<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customers extends CI_Model {

    public function __construct() {
        parent::__construct();
    }





    public function company_info_get_data($id) {
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('customer_id' , $id);
        $this->db->where('create_by' ,$this->session->userdata('user_id'));
        $query = $this->db->get();  
        return $query->result_array();
        }
   

        public function company_invoice_data($id) {
                   $this->db->select('*');
                   $this->db->from('invoice');
                   $this->db->where('customer_id' , $id);
                   $this->db->where('sales_by' ,$this->session->userdata('user_id'));
                   
                   
                   $this->db->order_by('payment_due_date', 'desc');

                   
                   $query = $this->db->get();  
                  return $query->result_array();
                }




 public function customer_overall_amt_bal($id) {
        $this->db->select(
            "SUM(a.paid_amount) as total_paid_amount, SUM(a.due_amount) as total_due_amount,SUM(a.amount_pay_usd) as total_amount_pay_usd, SUM(a.due_amount_usd) as total_due_amount_usd"
        );
        $this->db->from('invoice a');
        $this->db->where('a.sales_by', $this->session->userdata('user_id'));
        $this->db->where('a.customer_id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Assuming you expect only one row of sums
    }
    


    public function get_all_customers() {
         $this->db->select('*');
         $this->db->from('customer_information');
         $this->db->where('create_by' ,$this->session->userdata('user_id'));
         $query = $this->db->get();  
         return $query->result_array();
         }
    


    public function get_customers_credit(){
         $this->db->select("a.*,c.*");
        $this->db->from('customer_information a');
        $this->db->join('invoice c','a.customer_id = c.customer_id');
        $this->db->where('a.create_by',$this->session->userdata('user_id'));
         $query = $this->db->get();
         return $query->result_array();
    }





    public function get_customers_paid(){
        $this->db->select("a.*,c.*");
        $this->db->from('customer_information a');
        $this->db->join('invoice c','a.customer_id = c.customer_id');
        $this->db->where('a.create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result_array();
   }

 



































    //Count customer
    public function count_customer() {
      $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->order_by('create_date', 'desc');
        $query = $this->db->get();
         return $query->num_rows();
      
        //return $this->db->count("customer_information")->where('create_by',$this->session->userdata('user_id'));
    }
         public function customers_credit(){
    $this->db->select("a.*,SUM(c.due_amount) as due,b.HeadCode,((select ifnull(sum(Debit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)-(select ifnull(sum(Credit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)) as balance");
    $this->db->from('customer_information a');
    $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
    $this->db->join('invoice c','a.customer_id = c.customer_id');
    $this->db->where('a.create_by',$this->session->userdata('user_id'));
    $this->db->group_by('a.customer_id');
    $query = $this->db->get();
   // echo $this->db->last_query();
    return $query->result_array();
}
public function customers_paid(){
    $this->db->select("a.*,SUM(c.paid_amount) as paid_amount,b.HeadCode,((select ifnull(sum(Debit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)-(select ifnull(sum(Credit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)) as balance");
    $this->db->from('customer_information a');
    $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
    $this->db->join('invoice c','a.customer_id = c.customer_id');
    $this->db->where('a.create_by',$this->session->userdata('user_id'));
    $this->db->group_by('a.customer_id');
    $query = $this->db->get();
//    echo $this->db->last_query();
    return $query->result_array();
}
public function get_customer_type() {
        $this->db->select('*');
          $this->db->from('customer_type');
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    //customer List
    public function customer_list_count() {
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->order_by('create_date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
 public function get_payment_terms() {
        $this->db->select('*');
          $this->db->from('payment_terms');
       
          $query = $this->db->get();
        
          if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
     public function add_customertype_new($postData){
        $data=array(
            'c_type' => $postData,
            'create_by' => $this->session->userdata('user_id')
        );
        $this->db->insert('customer_type', $data);
        // echo $this->db->last_query();
        $this->db->select('*');
        $this->db->from('customer_type');
        $this->db->where('create_by' ,$this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result_array();
    }
     public function customers_list($date=null) {
         $date_now = date("Y-m-d");
        if($date) {
$split = array_map(
 function($value) {
     return implode(' ', $value);
 },
 array_chunk(explode('-', $date), 3)
);


     $start = str_replace(' ', '-', $split[0]);
     $end = str_replace(' ', '-', $split[1]);
     $start = rtrim($start, "-");
     $end= preg_replace('/' . '-' . '/', '', $end, 1);
}
$query = '';
     $data = array();

     $records_per_page = 10;
     $start_from = 0;
     $current_page_number = 0;
     if(isset($_POST["rowCount"]))
     {
      $records_per_page = $_POST["rowCount"];
     }
     else
     {
      $records_per_page = 10;
     }
     if(isset($_POST["current"]))
     {
      $current_page_number = $_POST["current"];
     }
     else
     {
      $current_page_number = 1;
     }
     $start_from = ($current_page_number - 1) * $records_per_page;
     $usertype = $this->session->userdata('user_type');
$this->db->select(
    
    
    
    
    "(select (sum(due_amount_usd)) from invoice where customer_id= `b`.`customer_id`) as dues_amount_usd,(select (sum(due_amount)) from invoice where customer_id= `b`.`customer_id`) as inv_dues_amount_usd,     SUM(CASE WHEN c.payment_due_date < CURDATE() THEN c.due_amount ELSE 0 END) as inv_due_amount, " .
    "SUM(CASE WHEN c.payment_due_date < CURDATE() THEN c.due_amount_usd ELSE 0 END) as inv_due_amount_usd, " .
    "c.due_amount_usd, c.due_amount, a.*, b.HeadCode, " .
    "((SELECT IFNULL(SUM(Debit), 0) FROM acc_transaction WHERE COAID = b.HeadCode AND IsAppove = 1) - " .
    "(SELECT IFNULL(SUM(Credit), 0) FROM acc_transaction WHERE COAID = b.HeadCode AND IsAppove = 1)) as balance", false




);

$this->db->from('customer_information a');
$this->db->join('acc_coa b', 'a.customer_id = b.customer_id', 'LEFT');
$this->db->join('invoice c', 'a.customer_id = c.customer_id', 'LEFT');

$this->db->where('a.create_by', $this->session->userdata('user_id'));


$this->db->group_by('a.customer_id');

 
     
     if($date) {
      if(!empty($start) && !empty($end)){
         $this->db->where('a.date >=',$start);
     $this->db->where('a.date <=',$end);
      }
 
     }
    
     if(!empty($_POST["searchPhrase"]))
     {
      $query .= 'WHERE (a.customer_name LIKE "%'.$_POST["searchPhrase"].'%" ';
      $query .= 'OR a.customer_address LIKE "%'.$_POST["searchPhrase"].'%" ';
      $query .= 'OR a.address2 LIKE "%'.$_POST["searchPhrase"].'%" ';
      $query .= 'OR a.customer_mobile LIKE "%'.$_POST["searchPhrase"].'%" ) ';
      $query .= 'OR a.customer_email LIKE "%'.$_POST["searchPhrase"].'%" ) ';
        $query .= 'OR a.phone LIKE "%'.$_POST["searchPhrase"].'%" ) ';
      $query .= 'OR b.balance LIKE "%'.$_POST["searchPhrase"].'%" ) ';
     }
     
     $order_by = '';
     if(isset($_POST["sort"]) && is_array($_POST["sort"]))
     {
      foreach($_POST["sort"] as $key => $value)
      {
       $order_by .= " $key $value, ";
      }
     }
     else
     {
     $query .= 'ORDER BY a.id DESC ';
     }
    // if($order_by != '')
   //  {
   //   $query .= ' ORDER BY ' . substr($order_by, 0, -2);
  //   }
     
     if($records_per_page != -1)
     {
      $query .= " LIMIT " . $start_from . ", " . $records_per_page;
     }
    
        $query = $this->db->get();
      // echo $this->db->last_query();
    // $result = $this->db->query($query); 
    $result = $query->result_array();
    foreach($result as $row)
 {
     $data[] = $row;
 }
      $date_now = date("Y-m-d");
$this->db->select(
    "SUM(CASE WHEN c.payment_due_date < CURDATE() THEN c.due_amount ELSE 0 END) as inv_due_amount, " .
    "SUM(CASE WHEN c.payment_due_date < CURDATE() THEN c.due_amount_usd ELSE 0 END) as inv_due_amount_usd, " .
    "c.due_amount_usd, c.due_amount, a.*, b.HeadCode, " .
    "((SELECT IFNULL(SUM(Debit), 0) FROM acc_transaction WHERE COAID = b.HeadCode AND IsAppove = 1) - " .
    "(SELECT IFNULL(SUM(Credit), 0) FROM acc_transaction WHERE COAID = b.HeadCode AND IsAppove = 1)) as balance", false
);

$this->db->from('customer_information a');
$this->db->join('acc_coa b', 'a.customer_id = b.customer_id', 'LEFT');
$this->db->join('invoice c', 'a.customer_id = c.customer_id', 'LEFT');
$this->db->where('a.create_by', '116');
$this->db->group_by('a.customer_id');

 $this->db->get();

     $result1 = $query->result_array();
   
     $total_records = $query->num_rows();
  // echo $this->db->last_query();//die();
     $output = array(
  
      'rows'   => $data
     );
   return $output;
 // echo json_encode($output);

 }
 /*
    public function customer_list($per_page = null, $page = null) {
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->order_by('create_date', 'desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function getCustomerList($postData=null){

         $response = array();

         ## Read value
         $draw = $postData['draw'];
         $start = $postData['start'];
         $rowperpage = $postData['length']; // Rows display per page
         $columnIndex = $postData['order'][0]['column']; // Column index
         $columnName = $postData['columns'][$columnIndex]['data']; // Column name
         $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
         $searchValue = $postData['search']['value']; // Search value

         ## Search 
         $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (a.customer_name like '%".$searchValue."%' or a.customer_mobile like '%".$searchValue."%' or a.customer_email like '%".$searchValue."%'or a.phone like '%".$searchValue."%' or a.customer_address like '%".$searchValue."%' or a.country like '%".$searchValue."%' or a.state like '%".$searchValue."%' or a.zip like '%".$searchValue."%' or a.city like '%".$searchValue."%')";
         }

         ## Total number of records without filtering
         $this->db->select('count(*) as allcount');
         $this->db->from('customer_information a');
         $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
         $this->db->where('a.create_by',$this->session->userdata('user_id'));
         $this->db->group_by('a.customer_id');
          if($searchValue != '')
         $this->db->where($searchQuery);
         $records = $this->db->get()->num_rows();
         $totalRecords = $records;

         ## Total number of record with filtering
         $this->db->select('count(*) as allcount');
         $this->db->from('customer_information a');
         $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
         $this->db->where('a.create_by',$this->session->userdata('user_id'));
         $this->db->group_by('a.customer_id');
         if($searchValue != '')
            $this->db->where($searchQuery);
         $records = $this->db->get()->num_rows();
         $totalRecordwithFilter = $records;

         ## Fetch records
        $this->db->select("a.*,b.HeadCode,((select ifnull(sum(Debit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)-(select ifnull(sum(Credit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)) as balance");
         $this->db->from('customer_information a');
         $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
         $this->db->where('a.create_by',$this->session->userdata('user_id'));
         $this->db->group_by('a.customer_id');
         if($searchValue != '')
         $this->db->where($searchQuery);
         $this->db->order_by($columnName, $columnSortOrder);
         $this->db->limit($rowperpage, $start);
         $records = $this->db->get()->result();
         $data = array();
         $sl =1;
  
         foreach($records as $record ){
          $button = '';
          $base_url = base_url();
          $jsaction = "return confirm('Are You Sure ?')";


       
   if($this->permission1->method('manage_customer','update')->access()){
    $button .='<a href="'.$base_url.'Ccustomer/customer_update_form/'.$record->customer_id.'" class="btn btn-info btn-xs"  data-placement="left" title="'. display('update').'"><i class="fa fa-edit"></i></a> ';
}
   if($this->permission1->method('manage_customer','delete')->access()){
     $button .='<a href="'.$base_url.'Ccustomer/customer_delete/'.$record->customer_id.'" class="btn btn-danger btn-xs " onclick="'.$jsaction.'"><i class="fa fa-trash"></i></a>';
 }


        
               
            $data[] = array( 
                'sl'               =>$sl,
                'customer_name'    =>html_escape($record->customer_name),
                'address2'         =>html_escape($record->address2),
                'mobile'           =>html_escape($record->customer_mobile),
                'address'          =>html_escape($record->customer_address),
                'phone'            =>html_escape($record->phone),
                'email'            =>html_escape($record->customer_email),
                'email_address'    =>html_escape($record->email_address),
                'contact'          =>html_escape($record->contact),
                'fax'              =>html_escape($record->fax),
                'city'             =>html_escape($record->city),
                'state'            =>html_escape($record->state),
                'zip'              =>html_escape($record->zip),
                'country'          =>html_escape($record->country),
                'balance'          =>(!empty($record->balance)?$record->balance:0),
                'button'           =>$button,
                
            ); 
            $sl++;
         }

         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
         );

         return $response; 
    }

  */
    
        public function customer_product_buy($per_page, $page) {
        $this->db->select('a.*,b.HeadName');
        $this->db->from('acc_transaction a');
        $this->db->join('acc_coa b','a.COAID=b.HeadCode');
        $this->db->where('b.PHeadName','Customer Receivable');
        $this->db->where('a.IsAppove',1);
        $this->db->where('a.CreateBy',$this->session->userdata('user_id'));
        $this->db->order_by('a.VDate','desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

        
        public function count_customer_ledger() {
        $this->db->select('a.*,b.HeadName');
        $this->db->from('acc_transaction a');
        $this->db->join('acc_coa b','a.COAID=b.HeadCode');
        $this->db->where('b.PHeadName','Customer Receivable');
        $this->db->where('a.IsAppove',1);
        $this->db->where('a.CreateBy',$this->session->userdata('user_id'));
        $this->db->order_by('a.VDate','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
    
          public function transaction_customer($supplier=null,$date=null){
        if($date) {
$split=explode(' to ',$date);
$start =  $split[0];
$end = $split[1];
}

 $this->db->select('s.*,s.customer_name as c_name,p.*,py.*');
        $this->db->from('customer_information s');
        $this->db->join('invoice p','s.customer_id=p.customer_id');
        if($supplier){
            $this->db->where('s.customer_id', $supplier_id);

        }
  
                 
     if($date) {
   
         $this->db->where('py.payment_date >=',$start);
     $this->db->where('py.payment_date <=',$end);
      }
      
          $this->db->join('payment py','p.payment_id=py.payment_id');
        $this->db->where('s.create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
      //  echo $this->db->last_query(); //die();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;


    }
     

        //customer list
    public function customer_list_ledger() {
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->order_by('customer_name', 'asc');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
public function customerledger_searchdata($customer_id, $start, $end) {
        $this->db->select('a.*, b.*');
        $this->db->from('customer_information a');
        $this->db->join('invoice b', 'a.customer_id = b.customer_id');
        $this->db->where('a.create_by', $this->session->userdata('user_id'));
        $this->db->where('b.date >=', $start);
        $this->db->where('b.date <=', $end);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


 


     public function getCreditCustomerList($postData=null){

         $response = array();

         ## Read value
         $draw = $postData['draw'];
         $start = $postData['start'];
         $rowperpage = $postData['length']; // Rows display per page
         $columnIndex = $postData['order'][0]['column']; // Column index
         $columnName = $postData['columns'][$columnIndex]['data']; // Column name
         $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
         $searchValue = $postData['search']['value']; // Search value

         ## Search 
         $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (a.customer_name like '%".$searchValue."%' or a.customer_mobile like '%".$searchValue."%' or a.customer_email like '%".$searchValue."%'or a.phone like '%".$searchValue."%' or a.customer_address like '%".$searchValue."%' or a.country like '%".$searchValue."%' or a.state like '%".$searchValue."%' or a.zip like '%".$searchValue."%' or a.city like '%".$searchValue."%')";
         }

         ## Total number of records without filtering
          $this->db->select("a.*,b.HeadCode,((select ifnull(sum(Debit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)-(select ifnull(sum(Credit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)) as balance");
         $this->db->from('customer_information a');
         $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
         $this->db->where('a.create_by',$this->session->userdata('user_id'));
          if($searchValue != ''){
         $this->db->where($searchQuery);}
         $this->db->having('balance > 0'); 
         $this->db->group_by('a.customer_id');
         $totalRecords = $this->db->get()->num_rows();

         ## Total number of record with filtering
         $this->db->select("a.*,b.HeadCode,((select ifnull(sum(Debit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)-(select ifnull(sum(Credit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)) as balance");
         $this->db->from('customer_information a');
         $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
         $this->db->where('a.create_by',$this->session->userdata('user_id'));
         if($searchValue != ''){
            $this->db->where($searchQuery);
        }
        $this->db->having('balance > 0');
        $this->db->group_by('a.customer_id');
         $totalRecordwithFilter = $this->db->get()->num_rows();

         ## Fetch records
         $this->db->select("a.*,b.HeadCode,((select ifnull(sum(Debit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)-(select ifnull(sum(Credit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)) as balance");
         $this->db->from('customer_information a');
         $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
         $this->db->where('create_by',$this->session->userdata('user_id'));
         if($searchValue != ''){
         $this->db->where($searchQuery);}
         $this->db->having('balance > 0');
         $this->db->group_by('a.customer_id');
         $this->db->order_by($columnName, $columnSortOrder);
         $this->db->limit($rowperpage, $start);
         $records = $this->db->get()->result();
         $data = array();
         $sl =1;
  
         foreach($records as $record ){
          $button = '';
          $base_url = base_url();
          $jsaction = "return confirm('Are You Sure ?')";

        $balance = $record->balance;

        
   if($this->permission1->method('manage_customer','update')->access()){
    $button .='<a href="'.$base_url.'Ccustomer/customer_update_form/'.$record->customer_id.'" class="btn btn-info btn-xs"  data-placement="left" title="'. display('update').'"><i class="fa fa-edit"></i></a> ';
}
   if($this->permission1->method('manage_customer','delete')->access()){
     $button .=' <a href="'.$base_url.'Ccustomer/customer_delete/'.$record->customer_id.'" class="btn btn-danger  btn-xs" onclick="'.$jsaction.'"><i class="fa fa-trash"></i></a>';
 }


            $data[] = array( 
               'sl'                =>$sl,
                'customer_name'    =>html_escape($record->customer_name),
                'address2'         =>html_escape($record->address2),
                'mobile'           =>html_escape($record->customer_mobile),
                'address'          =>html_escape($record->customer_address),
                'phone'            =>html_escape($record->phone),
                'email'            =>html_escape($record->customer_email),
                'email_address'    =>html_escape($record->email_address),
                'contact'          =>html_escape($record->contact),
                'fax'              =>html_escape($record->fax),
                'city'             =>html_escape($record->city),
                'state'            =>html_escape($record->state),
                'zip'              =>html_escape($record->zip),
                'country'          =>html_escape($record->country),
                'balance'          =>(!empty($balance)?html_escape($balance):0),
                'button'           =>$button,
                
            ); 
            $sl++;
         }

         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
         );

         return $response; 
    }



         public function getPaidCustomerList($postData=null){

         $response = array();

         ## Read value
         $draw = $postData['draw'];
         $start = $postData['start'];
         $rowperpage = $postData['length']; // Rows display per page
         $columnIndex = $postData['order'][0]['column']; // Column index
         $columnName = $postData['columns'][$columnIndex]['data']; // Column name
         $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
         $searchValue = $postData['search']['value']; // Search value

         ## Search 
         $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (a.customer_name like '%".$searchValue."%' or a.customer_mobile like '%".$searchValue."%' or a.customer_email like '%".$searchValue."%') ";
         }

         ## Total number of records without filtering
         $this->db->select("a.*,b.HeadCode,((select ifnull(sum(Debit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)-(select ifnull(sum(Credit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)) as balance");
         $this->db->from('customer_information a');
         $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
         $this->db->where('a.create_by',$this->session->userdata('user_id'));
          if($searchValue != ''){
         $this->db->where($searchQuery);
     }
        $this->db->having('balance <= 0'); 
        $this->db->group_by('a.customer_id');
        
         $totalRecords = $this->db->get()->num_rows();

         ## Total number of record with filtering
         $this->db->select("a.*,b.HeadCode,((select ifnull(sum(Debit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)-(select ifnull(sum(Credit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)) as balance");
         $this->db->from('customer_information a');
         $this->db->where('a.create_by',$this->session->userdata('user_id'));
         $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
         if($searchValue != ''){
            $this->db->where($searchQuery);
        }
         $this->db->having('balance <= 0');
         $this->db->group_by('a.customer_id');
         $totalRecordwithFilter = $this->db->get()->num_rows();

         ## Fetch records
         $this->db->select("a.*,b.HeadCode,((select ifnull(sum(Debit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)-(select ifnull(sum(Credit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)) as balance");
         $this->db->from('customer_information a');
         $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
         if($searchValue != ''){
         $this->db->where($searchQuery);}
          $this->db->where('a.create_by',$this->session->userdata('user_id'));
         $this->db->having('balance <= 0');
         $this->db->group_by('a.customer_id');
         $this->db->order_by($columnName, $columnSortOrder);
         $this->db->limit($rowperpage, $start);
         $records = $this->db->get()->result();
         $data = array();
         $sl =1;
  
         foreach($records as $record ){
          $button = '';
          $base_url = base_url();
          $jsaction = "return confirm('Are You Sure ?')";

        $balance = $record->balance;

        
   if($this->permission1->method('manage_customer','update')->access()){
    $button .='<a href="'.$base_url.'Ccustomer/customer_update_form/'.$record->customer_id.'" class="btn btn-info btn-xs"  data-placement="left" title="'. display('update').'"><i class="fa fa-edit"></i></a> ';
}
   if($this->permission1->method('manage_customer','delete')->access()){
     $button .='<a href="'.$base_url.'Ccustomer/customer_delete/'.$record->customer_id.'" class="btn btn-danger btn-xs " onclick="'.$jsaction.'"><i class="fa fa-trash"></i></a>';
 }

               
            $data[] = array( 
                 'sl'              =>$sl,
                'customer_name'    =>html_escape($record->customer_name),
                'address2'         =>html_escape($record->address2),
                'mobile'           =>html_escape($record->customer_mobile),
                'address'          =>html_escape($record->customer_address),
                'phone'            =>html_escape($record->phone),
                'email'            =>html_escape($record->customer_email),
                'email_address'    =>html_escape($record->email_address),
                'contact'          =>html_escape($record->contact),
                'fax'              =>html_escape($record->fax),
                'city'             =>html_escape($record->city),
                'state'            =>html_escape($record->state),
                'zip'              =>html_escape($record->zip),
                'country'          =>html_escape($record->country),
                'balance'          =>(!empty($balance)?html_escape($balance):0),
                'button'           =>$button,
                
            ); 
            $sl++;
         }

         ## Response
         $response = array(
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
         );

         return $response; 
    }

    public function count_credit_customer() {
     ## Fetch records
         $this->db->select("a.*,b.HeadCode,((select ifnull(sum(Debit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)-(select ifnull(sum(Credit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)) as balance");
         $this->db->from('customer_information a');
         $this->db->where('a.create_by',$this->session->userdata('user_id'));
         $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
         $this->db->group_by('a.customer_id');
        $this->db->having('balance > 0'); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

        public function count_paid_customer() {
     $this->db->select("a.*,b.HeadCode,((select ifnull(sum(Debit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)-(select ifnull(sum(Credit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)) as balance");
         $this->db->from('customer_information a');
         $this->db->where('a.create_by',$this->session->userdata('user_id'));
         $this->db->join('acc_coa b','a.customer_id = b.customer_id','left');
         $this->db->group_by('a.customer_id');
        $this->db->having('balance <= 0'); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
   

  
    //Count customer
    public function customer_entry($data) {
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('customer_name', $data['customer_name']);
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
        $this->db->insert('customer_information', $data);
       //echo $this->db->last_query();
    }
    public function all_customer() {
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('create_by',$this->session->userdata('user_id'));
// $this->db->order_by("customer_name", "asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    } 
    //Customer Previous balance adjustment
   public function previous_balance_add($balance, $customer_id) {
        $this->load->library('auth');
      
    $cusifo = $this->db->select('*')->from('customer_information')->where('customer_id',$customer_id)->get()->result_array();

    $headn = $cusifo[0]['customer_id'].'-'.$cusifo[0]['customer_name'];

    $coainfo = $this->db->select('*')->from('acc_coa')->where('HeadName',$headn)->get()->row();
    $customer_headcode = $coainfo->HeadCode;
        $transaction_id = $this->auth->generator(10);


// Customer debit for previous balance
      $cosdr = array(
      'VNo'            =>  $transaction_id,
      'Vtype'          =>  'PR Balance',
      'VDate'          =>  date("Y-m-d"),
      'COAID'          =>  $customer_headcode,
      'Narration'      =>  'Customer debit For '.$cusifo[0]['customer_name'],
      'Debit'          =>  $balance,
      'Credit'         =>  0,
      'IsPosted'       => 1,
      'CreateBy'       => $this->session->userdata('user_id'),
      'CreateDate'     => date('Y-m-d H:i:s'),
      'IsAppove'       => 1
    );
       $inventory = array(
      'VNo'            =>  $transaction_id,
      'Vtype'          =>  'PR Balance',
      'VDate'          =>  date("Y-m-d"),
      'COAID'          =>  $customer_headcode,
      'Narration'      =>  'Inventory credit For Old sale For'.$cusifo[0]['customer_name'],
      'Debit'          =>  0,
      'Credit'         =>  $balance,//purchase price asbe
      'IsPosted'       => 1,
      'CreateBy'       => $this->session->userdata('user_id'),
      'CreateDate'     => date('Y-m-d H:i:s'),
      'IsAppove'       => 1
    ); 

        
        if(!empty($balance)){
           $this->db->insert('acc_transaction', $cosdr); 
           echo $this->db->last_query();
           $this->db->insert('acc_transaction', $inventory); 
             echo $this->db->last_query();
        }
    }


    //Retrieve company Edit Data
    public function retrieve_company() {
        $this->db->select('*');
        $this->db->from('company_information');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->limit('1');
        $query = $this->db->get();  
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve customer Edit Data
    public function retrieve_customer_editdata($customer_id) {
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('customer_id', $customer_id);
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve customer Personal Data 
    public function customer_personal_data($id) {
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('customer_id', $id);
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve customer Invoice Data 
    public function customer_invoice_data($customer_id) {
        $this->db->select('*');
        $this->db->from('customer_ledger');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->where(array('customer_id' => $customer_id, 'receipt_no' => NULL, 'status' => 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve customer Receipt Data 
    public function customer_receipt_data($customer_id) {
        $this->db->select('*');
        $this->db->from('customer_ledger');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->where(array('customer_id' => $customer_id, 'invoice_no' => NULL, 'status' => 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }



    //Update Categories
    public function update_customer($data, $customer_id) {
        $this->db->where('customer_id', $customer_id);
        $this->db->update('customer_information', $data);
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
      if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }



    // custromer invoicedetails delete
    public function delete_invoicedetails($customer_id) {
        $this->db->where('customer_id', $customer_id);
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->delete('invoice_details');
    }

    // custromer invoice delete
    public function delete_invoic($customer_id) {
        $this->db->where('customer_id', $customer_id);
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->delete('invoice');
    }


    // Delete customer Item
    public function delete_customer($customer_id,$customer_head) {
        $this->db->where('HeadName', $customer_head);
        $this->db->delete('acc_coa');
        $this->db->where('customer_id', $customer_id);
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->delete('customer_information');

        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $json_customer[] = array('label' => $row->customer_name, 'value' => $row->customer_id);
        }
        $cache_file = './my-assets/js/admin_js/json/customer.json';
        $customerList = json_encode($json_customer);
        file_put_contents($cache_file, $customerList);
        return true;
    }

  
    public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '1020300%'");
        return $query->row();

    }


    

    // Customer list
    public function customer_list_advance(){
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function advance_details($transaction_id,$customer_id){
        $headcode = $this->db->select('HeadCode')->from('acc_coa')->where('customer_id',$customer_id)->get()->row();
        return $this->db->select('*')
                        ->from('acc_transaction')
                        ->where('VNo',$transaction_id)
                        ->where('COAID',$headcode->HeadCode)
                        ->get()
                        ->result_array();

    }



    //Credit Customer Search List
    public function credit_customer_search_item($customer_id) {
        $this->db->distinct('customer_id');
        $this->db->select('*');
        $this->db->from('customer_information');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

     //autocomplete part
    public function customer_search($customer_id){
 $query = $this->db->select('*')->from('customer_information')
        ->group_start()
                ->like('customer_name', $customer_id)
                ->or_like('customer_mobile', $customer_id)
        ->group_end()
        ->limit(30)
        ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
}
