

<?php
 error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chrm extends CI_Controller {
    public $menu;

    function __construct() {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
        $this->load->library('auth');
        $this->load->library('session');
         $this->load->model('Web_settings');
        $this->load->model('Hrm_model');
        $this->auth->check_admin_auth();
    }
    public function new_employee(){
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $w = &get_instance();
        $w->load->model("Ppurchases");
        $CI->load->model("Web_settings");
        $CI->load->model('invoice_content');
        $company_content= $CI->invoice_content->retrieve_info_data();
        $company_info = $w->Ppurchases->retrieve_company();
        $setting = $CI->Web_settings->retrieve_setting_editdata();
        $data=array(
         "company_content" => $company_content,
         "logo" => !empty($setting[0]["invoice_logo"]) ? $setting[0]["invoice_logo"]: $company_info[0]["logo"],
        );
        $content = $this->parser->parse('hr/new_employee_form', $data, true);
        $this->template->full_admin_html_view($content);
    }
public function formnj927()
{
    $CI = &get_instance();
    $this->load->model("Hrm_model");
    $data = array(
        'title' => 'NJ927'
    );
    $content = $CI->parser->parse("hr/formnj927", $data, true);
    $this->template->full_admin_html_view($content);
}
 public function employee_delete($id) {
    $this->load->model('Hrm_model');
    $this->Hrm_model->delete_employee($id);
    $this->session->set_userdata(array('message' => display('successfully_delete')));
   redirect("Chrm/manage_employee");
    }







public function state_summary(){
    $CI = &get_instance();
    $CI->load->model('Web_settings');
    $this->load->model('Hrm_model');
    $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
    $data['setting_detail']            = $setting_detail;
    $tax_name = urldecode($this->input->post('url'));
    $emp_name = $this->input->post('employee_name');
     $taxType = $this->input->post('taxType');
    $date = $this->input->post('daterangepicker-field');
    $data['state_tax_list'] = $CI->Hrm_model->stateTaxlist();
    $data['state_summary_employee'] = $this->Hrm_model->state_summary_employee();
   
    $data['state_list'] = $this->db->select('*')->from('state_and_tax')->order_by('state', 'ASC')->where('created_by', $this->session->userdata('user_id'))->where('Status', 2)->group_by('id')->get()->result_array();
    $data['state_summary_employer'] = $this->Hrm_model->state_summary_employer();
    $data['emp_name']=$this->db->select('*')->from('employee_history')->where('create_by', $this->session->userdata('user_id'))->get()->result_array();
    // print_r($data['emp_name']);
    $employee_tax_data = [];
    foreach ($data['state_summary_employee'] as $employee_tax) {
        $employee_tax_data[$employee_tax['time_sheet_id']][$employee_tax['tax_type'] . '_employee'] = $employee_tax['amount'];
    }
    foreach ($data['state_summary_employer'] as $employer_tax) {
        $employee_tax_data[$employer_tax['time_sheet_id']][$employer_tax['tax_type'] . '_employer'] = $employer_tax['amount'];
    }
    $data['employee_tax_data']=$employee_tax_data;
  // print_r($data['employee_tax_data']);
    $content = $this->parser->parse('hr/reports/state_summary', $data, true);
    $this->template->full_admin_html_view($content);
}
public function state_tax_search_summary() {
    $CI = get_instance();
    $CI->load->model('Web_settings');
    $this->load->model('Hrm_model');
    
    $emp_name = $this->input->post('employee_name');
    $tax_choice = $this->input->post('tax_choice');
    $taxType = $this->input->post('taxType');
    $selectState = $this->input->post('selectState');
    $date = $this->input->post('daterangepicker-field');
    
    $state_summary_employer = $this->Hrm_model->state_summary_employer($emp_name, $tax_choice, $selectState, $date, $taxType);
  //  print_r($state_summary_employer);
    $state_summary_employee = $this->Hrm_model->state_summary_employee($emp_name, $tax_choice, $selectState, $date, $taxType);

    // Initialize arrays to store contributions
    $employer_contributions = [
        'state_tax' => [],
        'living_state_tax' => []
    ];
    $employee_contributions = [
        'state_tax' => [],
        'living_state_tax' => []
    ];

    // Organize employer contributions
    foreach ($state_summary_employer as $row) {
        $employee_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
        $tax_type = $row['tax_type'];
        $tax = $row['tax'];
        $code = $row['code'];
        $total_amount = $row['total_amount'];
     

        // Organize by tax type
        $employer_contributions[$tax_type][] = [
            'employee_name' => $employee_name,
            'tax' => $tax,
             'taxType' => $tax_type,
            'code'  => $code,
            'total_amount' => $total_amount
        ];
    }

    // Organize employee contributions
    foreach ($state_summary_employee as $row) {
        $employee_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
        $tax_type = $row['tax_type'];
        $tax = $row['tax'];
         $code = $row['code'];
        $total_amount = $row['total_amount'];

        // Organize by tax type
        $employee_contributions[$tax_type][] = [
            'employee_name' => $employee_name,
            'tax' => $tax,
             'code'  => $code,
               'taxType' => $tax_type,
            'total_amount' => $total_amount
        ];
        
    }

    // Sum similar taxes for each employee
foreach ($employer_contributions as $tax_type => &$contributions) {
    foreach ($contributions as &$contribution) {
        $employee_name = $contribution['employee_name'];
        $tax = $contribution['tax']; // Added tax type condition
        $sum = 0;
        foreach ($state_summary_employer as $row) {


          if ($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] === $employee_name && $row['tax_type'] === $tax_type && $row['tax'] === $tax) {
                            $final_amount = '';
                          
if (trim($row['tax'])=='Income tax'   &&  $row['weekly'] > 0) {
    $final_amount = $row['weekly'];
} elseif (trim($row['tax'])=='Income tax'   && $row['biweekly'] > 0) {
    $final_amount = $row['biweekly'];
} elseif (trim($row['tax'])=='Income tax'   && $row['monthly'] > 0) {
    $final_amount = $row['monthly'];
} else {
    $final_amount = $row['total_amount'];
}
            
            $sum +=   $final_amount;
            }
        }
        $contribution['total_amount'] = $sum;
    }
}

// Sum total amounts for employee contributions
foreach ($employee_contributions as $tax_type => &$contributions) {
    foreach ($contributions as &$contribution) {
        $employee_name = $contribution['employee_name'];
        $tax = $contribution['tax']; // Added tax type condition
        $sum = 0;

        foreach ($state_summary_employee as $row) {

            if ($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] === $employee_name && $row['tax_type'] === $tax_type && $row['tax'] === $tax) {
                                       $final_amount = '';
                          
if (trim($row['tax'])=='Income tax'   &&  $row['weekly'] > 0) {
    $final_amount = $row['weekly'];
} elseif (trim($row['tax'])=='Income tax'   && $row['biweekly'] > 0) {
    $final_amount = $row['biweekly'];
} elseif (trim($row['tax'])=='Income tax'   && $row['monthly'] > 0) {
    $final_amount = $row['monthly'];
} else {
    $final_amount = $row['total_amount'];
}
              
              $sum += $final_amount;
            }
        }
        $contribution['total_amount'] = $sum;
    }
}
//   print_r($employee_contributions);
//   echo "<br/>";
//   print_r($employer_contributions);
//   die();
    // Construct the response array
    $responseData = [
        'employer_contribution' => $employee_contributions,
        'employee_contribution' =>$employer_contributions 
    ];

    // Encode the response array to JSON
    $jsonData = json_encode($responseData, JSON_PRETTY_PRINT);

    // Output the JSON data
    echo $jsonData;
}


public function state_tax_search() {
    $CI = &get_instance();
    $CI->load->model('Web_settings');
    $this->load->model('Hrm_model');

  $tax_name = trim(urldecode($this->input->post('url')));
    $date = $this->input->post('daterangepicker-field');
$employee_name = $this->input->post('employee_name');
    // Fetch employee and employer contributions separately
    $employee_contributions = $this->fetch_contributions($employee_name,$tax_name, $date);
    $employer_contributions = $this->fetch_contributions($employee_name,$tax_name, $date);

    // Merge employee and employer contributions
    $merged_array = $this->merge_contributions($employee_contributions, $employer_contributions);
//print_r($merged_array);die();
    header('Content-Type: application/json');
    
    echo json_encode($merged_array);
}

private function fetch_contributions($employee_name,$tax_name, $date) {
    $state_tax_report = $is_employer ?
        $this->Hrm_model->employer_state_tax_report($employee_name,$tax_name, $date) :
        $this->Hrm_model->state_tax_report($employee_name,$tax_name, $date);

    $living_state_tax_report = $is_employer ?
        $this->Hrm_model->employer_living_state_tax_report($employee_name,$tax_name, $date) :
        $this->Hrm_model->living_state_tax_report($employee_name,$tax_name, $date);

    $merged_array = [];

    foreach ($state_tax_report as $state_tax) {
        $time_sheet_id = $state_tax['time_sheet_id'];
        $merged_array[$time_sheet_id]['state_tax'][] = $state_tax;
    }

    foreach ($living_state_tax_report as $living_state_tax) {
        $time_sheet_id = $living_state_tax['time_sheet_id'];
        $merged_array[$time_sheet_id]['living_state_tax'][] = $living_state_tax;
    }

    return $merged_array;
}

private function merge_contributions($employee_contributions, $employer_contributions) {
    $merged_array = [];

    foreach ($employee_contributions as $time_sheet_id => $employee_data) {
        $merged_array[$time_sheet_id] = ['employee' => $employee_data];

        // Merge corresponding employer contributions if available
        if (isset($employer_contributions[$time_sheet_id])) {
            $merged_array[$time_sheet_id]['employer'] = $employer_contributions[$time_sheet_id];
        }
    }

    return $merged_array;
}
  public function report($tax_name = '') {
     
      $CI = & get_instance();
      $CI->load->model('Web_settings');
      $this->load->model('Hrm_model');
      $tax_name = urldecode($tax_name);
    //   echo $tax_name;
          $data['employee_data'] =$this->Hrm_model->employee_data_get();
       $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
 $data['setting_detail']            = $setting_detail;
    $date = $this->input->post('daterangepicker-field');
$employee_name = $this->input->post('employee_name');
 $data['tax_n']=$tax_name;
      if (!empty($tax_name)) {
          $data['state_tax_report'] = $this->Hrm_model->state_tax_report($employee_name,$tax_name, $date);
          $data['living_state_tax_report'] = $this->Hrm_model->living_state_tax_report($employee_name,$tax_name, $date);
          $merged_array = [];
  
          foreach ($data['state_tax_report'] as $state_tax) {
              $time_sheet_id = $state_tax['time_sheet_id'];
              $merged_array[$time_sheet_id]['state_tax'][] = $state_tax;
          }
          
          foreach ($data['living_state_tax_report'] as $living_state_tax) {
              $time_sheet_id = $living_state_tax['time_sheet_id'];
              $merged_array[$time_sheet_id]['living_state_tax'][] = $living_state_tax;
          }
          
          $data['merged_reports'] = $merged_array;
      //  print_r($data['merged_reports']);die();
          
          
          
          // Employer
          
      $data['employer_state_tax_report'] = $this->Hrm_model->employer_state_tax_report($employee_name,$tax_name, $date);
$data['employer_living_state_tax_report'] = $this->Hrm_model->employer_living_state_tax_report($employee_name,$tax_name, $date);

$merged_array_employer = [];

foreach ($data['employer_state_tax_report'] as $state_tax) {
    $time_sheet_id = $state_tax['time_sheet_id'];
    $merged_array_employer[$time_sheet_id]['state_tax'][] = $state_tax;
}

foreach ($data['employer_living_state_tax_report'] as $living_state_tax) {
    $time_sheet_id = $living_state_tax['time_sheet_id'];
    $merged_array_employer[$time_sheet_id]['living_state_tax'][] = $living_state_tax;
}

$data['merged_reports_employer'] = $merged_array_employer;
//print_r($data['merged_reports_employer']);
          $content = $this->parser->parse('hr/reports/state_report', $data, true);
          $this->template->full_admin_html_view($content);
      } 
  }
    public function report_state_search($tax_name = '') {
      $CI = & get_instance();
      $CI->load->model('Web_settings');
      $this->load->model('Hrm_model');
   
      $tax_name = $_POST['url'];
 
          $data['employee_data'] =$this->Hrm_model->employee_data_get();
       $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
 $data['setting_detail']            = $setting_detail;
    $date = $_POST['daterangepicker-field'];
$employee_name =  $_POST['employee_name'];

 $data['tax_n']=$tax_name;
      if (!empty($tax_name)) {
          $data['state_tax_report'] = $this->Hrm_model->state_tax_report($employee_name,$tax_name, $date);
          $data['living_state_tax_report'] = $this->Hrm_model->living_state_tax_report($employee_name,$tax_name, $date);
          $merged_array = [];
  
          foreach ($data['state_tax_report'] as $state_tax) {
              $time_sheet_id = $state_tax['time_sheet_id'];
              $merged_array[$time_sheet_id]['state_tax'][] = $state_tax;
          }
          
          foreach ($data['living_state_tax_report'] as $living_state_tax) {
              $time_sheet_id = $living_state_tax['time_sheet_id'];
              $merged_array[$time_sheet_id]['living_state_tax'][] = $living_state_tax;
          }
          
          $data['merged_reports'] = $merged_array;
      //    print_r($data['merged_reports']);
          
          
          
          // Employer
          
      $data['employer_state_tax_report'] = $this->Hrm_model->employer_state_tax_report($employee_name,$tax_name, $date);
$data['employer_living_state_tax_report'] = $this->Hrm_model->employer_living_state_tax_report($employee_name,$tax_name, $date);

$merged_array_employer = [];

foreach ($data['employer_state_tax_report'] as $state_tax) {
    $time_sheet_id = $state_tax['time_sheet_id'];
    $merged_array_employer[$time_sheet_id]['state_tax'][] = $state_tax;
}

foreach ($data['employer_living_state_tax_report'] as $living_state_tax) {
    $time_sheet_id = $living_state_tax['time_sheet_id'];
    $merged_array_employer[$time_sheet_id]['living_state_tax'][] = $living_state_tax;
}

$data['merged_reports_employer'] = $merged_array_employer;
//print_r($data['merged_reports_employer']);
          $content = $this->parser->parse('hr/reports/state_report', $data, true);
          $this->template->full_admin_html_view($content);
      } 
  }
public function other_tax() {
    $CI = & get_instance();
    $CI->load->model('Web_settings');
    $this->load->model('Hrm_model');

    $data['employee_data'] = $this->Hrm_model->employee_data_get();
    $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
    $data['setting_detail'] = $setting_detail;
    
   
  $employee_other_tax = $this->Hrm_model->other_tax_report();
    $employer_other_tax = $this->Hrm_model->other_tax_employer_report();

    // Merge data based on timesheet IDs
    $merged_array = [];

    // Restructure employee_other_tax array
    foreach ($employee_other_tax as $employee_tax) {
        $time_sheet_id = $employee_tax['time_sheet_id'];
        $merged_array[$time_sheet_id]['employee_other_tax'][] = $employee_tax;
    }

    // Merge employer_other_tax
    foreach ($employer_other_tax as $employer_tax) {
        $time_sheet_id = $employer_tax['time_sheet_id'];
        $merged_array[$time_sheet_id]['employer_other_tax'][] = $employer_tax;
    }

    $data['merged_reports'] = $merged_array;

    $content = $this->parser->parse('hr/reports/other_tax', $data, true);
    $this->template->full_admin_html_view($content);
}
public function other_tax_search() {
    $CI = & get_instance();
    $CI->load->model('Web_settings');
    $this->load->model('Hrm_model');
  $emp_name=$this->input->post('employee_name');
    $date=$this->input->post('daterangepicker-field');
    $data['employee_data'] = $this->Hrm_model->employee_data_get();
    $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
    $data['setting_detail'] = $setting_detail;
    
   
  $employee_other_tax = $this->Hrm_model->other_tax_report_search($emp_name,$date);
    $employer_other_tax = $this->Hrm_model->other_tax_employer_report_search($emp_name,$date);

    // Merge data based on timesheet IDs
    $merged_array = [];

    // Restructure employee_other_tax array
    foreach ($employee_other_tax as $employee_tax) {
        $time_sheet_id = $employee_tax['time_sheet_id'];
        $merged_array[$time_sheet_id]['employee_other_tax'][] = $employee_tax;
    }

    // Merge employer_other_tax
    foreach ($employer_other_tax as $employer_tax) {
        $time_sheet_id = $employer_tax['time_sheet_id'];
        $merged_array[$time_sheet_id]['employer_other_tax'][] = $employer_tax;
    }

    $data['merged_reports'] = $merged_array;

echo json_encode($data['merged_reports']);
}
public function federal_tax_report(){
   $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
$setting_detail = $CI->Web_settings->retrieve_setting_editdata();
 $emp_name=$this->input->post('employee_name');
        $data['setting_detail']            = $setting_detail;
    $date=$this->input->post('daterangepicker-field');
$split = explode(" - ", $date);

$data['start'] = isset($split[0]) ? $split[0] : null;
$data['end'] = isset($split[1]) ? $split[1] : null;
      $data['fed_tax'] = $this->Hrm_model->employe($emp_name,$date);
     $data['fed_tax_emplr'] = $this->Hrm_model->employr($emp_name,$date);
     // print_r( $data['fed_tax']);
    //  echo "<br/>";;echo "<br/>";
    // print_r($data['fed_tax_emplr']);//die();
     $data['employee_data'] =$this->Hrm_model->employee_data_get();
  $content                  = $this->parser->parse('hr/reports/fed_income_tax_report', $data, true);
         $this->template->full_admin_html_view($content);
}
public function federal_tax_report_search(){
 $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
      $emp_name=$this->input->post('employee_name');
    $date=$this->input->post('daterangepicker-field');
      $status=$this->input->post('status');
  $data['tax']=$this->Hrm_model->federal_tax_report($emp_name,$date,$status);
echo json_encode($data['tax']);
}
public function social_tax_report(){
   $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
 $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
 $emp_name=$this->input->post('employee_name');
        $data['setting_detail']            = $setting_detail;
    $date=$this->input->post('daterangepicker-field');
$split = explode(" - ", $date);

$data['start'] = isset($split[0]) ? $split[0] : null;
$data['end'] = isset($split[1]) ? $split[1] : null;
      $data['fed_tax'] = $this->Hrm_model->employe($emp_name,$date);
     $data['fed_tax_emplr'] = $this->Hrm_model->employr($emp_name,$date);
    //  print_r( $data['fed_tax']);
    //  echo "<br/>";;echo "<br/>";
    // print_r($data['fed_tax_emplr']);//die();
     $data['employee_data'] =$this->Hrm_model->employee_data_get();
  $content                  = $this->parser->parse('hr/reports/social_security_tax', $data, true);
         $this->template->full_admin_html_view($content);
}
public function social_tax_report_search(){
 $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
      $emp_name=$this->input->post('employee_name');
         $tax_choice=$this->input->post('tax_choice');
          $selectState=$this->input->post('selectState');
          $taxType=$this->input->post('taxType');
    $date=$this->input->post('daterangepicker-field');
     // $status=$this->input->post('status');
  $data['emplr_tax']=$this->Hrm_model->social_tax_report($emp_name,$tax_choice,$selectState,$taxType,$date);
   $data['emple_tax']=$this->Hrm_model->social_tax_employee_report($emp_name,$tax_choice,$selectState,$taxType,$date);
  $mergedArray = array_merge($data['emplr_tax'], $data['emple_tax']);
  print_r($mergedArray);
echo json_encode($mergedArray);
}
public function social_taxsearch(){
 $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
      $emp_name=trim($this->input->post('employee_name'));
    $date=$this->input->post('daterangepicker-field');
     $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
$data['setting_detail']            = $setting_detail;
     $data['employe'] = $this->Hrm_model->so_tax_report_employee($emp_name,$date,$status);
      $data['employer'] = $this->Hrm_model->so_tax_report_employer($emp_name,$date,$status);
    // print_r($data['fed_tax']);
     $data['employee_data'] =$this->Hrm_model->employee_data_get();
//   print_r($data['employe']);
//   echo "<br/>";
//   print_r($data['employer']);die();
echo json_encode($data);
}
public function medicare_tax_report(){
   $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
$setting_detail = $CI->Web_settings->retrieve_setting_editdata();
 $emp_name=$this->input->post('employee_name');
        $data['setting_detail']            = $setting_detail;
    $date=$this->input->post('daterangepicker-field');
$split = explode(" - ", $date);

$data['start'] = isset($split[0]) ? $split[0] : null;
$data['end'] = isset($split[1]) ? $split[1] : null;
      $data['fed_tax'] = $this->Hrm_model->employe($emp_name,$date);
     $data['fed_tax_emplr'] = $this->Hrm_model->employr($emp_name,$date);
    //  print_r( $data['fed_tax']);
    //  echo "<br/>";;echo "<br/>";
    // print_r($data['fed_tax_emplr']);//die();
     $data['employee_data'] =$this->Hrm_model->employee_data_get();
  $content                  = $this->parser->parse('hr/reports/medicare_tax', $data, true);
         $this->template->full_admin_html_view($content);
}
public function medicare_tax_report_search(){
 $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
      $emp_name=$this->input->post('employee_name');
    $date=$this->input->post('daterangepicker-field');
      $status=$this->input->post('status');
  $data['tax']=$this->Hrm_model->social_tax_report($emp_name,$date,$status);
echo json_encode($data['tax']);
}
public function unemployment_tax_report(){
   $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
$setting_detail = $CI->Web_settings->retrieve_setting_editdata();
 $emp_name=$this->input->post('employee_name');
        $data['setting_detail']            = $setting_detail;
    $date=$this->input->post('daterangepicker-field');
$split = explode(" - ", $date);

$data['start'] = isset($split[0]) ? $split[0] : null;
$data['end'] = isset($split[1]) ? $split[1] : null;
      $data['fed_tax'] = $this->Hrm_model->employe($emp_name,$date);
     $data['fed_tax_emplr'] = $this->Hrm_model->employr($emp_name,$date);
    //  print_r( $data['fed_tax']);
    //  echo "<br/>";;echo "<br/>";
    // print_r($data['fed_tax_emplr']);//die();
     $data['employee_data'] =$this->Hrm_model->employee_data_get();

  $content= $this->parser->parse('hr/reports/unemployment_tax', $data, true);
         $this->template->full_admin_html_view($content);
}
public function unemployment_tax_report_search(){
 $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
      $emp_name=$this->input->post('employee_name');
    $date=$this->input->post('daterangepicker-field');
      $status=$this->input->post('status');
  $data['tax']=$this->Hrm_model->social_tax_report($emp_name,$date,$status);
echo json_encode($data['tax']);
}














public function federal_summary(){
   $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
 $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
 $data['setting_detail']            = $setting_detail;
     $data['fed_tax'] = $this->Hrm_model->social_tax_sumary();
     $data['fed_tax_emplr'] = $this->Hrm_model->social_tax_employer();
        $data['state_tax_list'] = $CI->Hrm_model->stateTaxlist();
    $data['state_summary_employee'] = $this->Hrm_model->state_summary_employee();
    $data['state_list'] = $this->db->select('*')->from('state_and_tax')->order_by('state', 'ASC')->where('created_by', $this->session->userdata('user_id'))->where('Status', 2)->group_by('id')->get()->result_array();
      // print_r($data['fed_tax']); echo "<br/>";
      // print_r($data['fed_tax_emplr']);

$mergedArray = array();

foreach ($data['fed_tax'] as $item1) {
    $mergedItem = $item1;

    foreach ($data['fed_tax_emplr'] as $item2) {
        if ($item1['templ_name'] == $item2['employee_id']) {
            // Merge the arrays
            foreach ($item2 as $key => $value) {
                // Check if the key already exists
                if (!isset($mergedItem[$key])) {
                    $mergedItem[$key] = $value;
                }
            }

            // Add the merged item to the result array
            $mergedArray[] = $mergedItem;
            break;
        }
    }
}

// Print the merged array
//print_r($mergedArray);

    $data['mergedArray']=$mergedArray;
// Print the merged array

     $data['employee_data'] =$this->Hrm_model->employee_data_get();
  $content                  = $this->parser->parse('hr/reports/federal_summary', $data, true);
         $this->template->full_admin_html_view($content);
}

















public function federal_summary_search(){
 $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
      $emp_name=$this->input->post('employee_name');
    $date=$this->input->post('daterangepicker-field');
      $status=$this->input->post('status');
  $data['tax']=$this->Hrm_model->social_tax_report($emp_name,$date,$status);
echo json_encode($data['tax']);
}

public function city_tax_report(){

   $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
 $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
 $data['setting_detail']= $setting_detail;
     $data['getEmployeeContributions'] = $this->Hrm_model->getEmployeeContributions();
       $data['employee_data'] =$this->Hrm_model->employee_data_get();

  $content= $this->parser->parse('hr/reports/city_tax', $data, true);
         $this->template->full_admin_html_view($content);

}

public function city_tax_search(){

   $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
 $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
   $date=$this->input->post('daterangepicker-field');
 $data['setting_detail']= $setting_detail;
  $emp_name=$this->input->post('employee_name');
     $data['getEmployeeContributions'] = $this->Hrm_model->getEmployeeContributions($emp_name,$date);
       $data['employee_data'] =$this->Hrm_model->employee_data_get();
echo json_encode( $data['getEmployeeContributions']);

}

public function city_local_tax(){

   $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
 $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
 $data['setting_detail']= $setting_detail;
     $data['getEmployeeContributions'] = $this->Hrm_model->getEmployeeContributions_local();
       $data['employee_data'] =$this->Hrm_model->employee_data_get();

  $content= $this->parser->parse('hr/reports/city_local_tax', $data, true);
         $this->template->full_admin_html_view($content);

}
public function city_local_tax_search(){

   $CI = & get_instance();
        $CI->load->model('Web_settings');
 $this->load->model('Hrm_model');
 $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
 $data['setting_detail']= $setting_detail;
   $date=$this->input->post('daterangepicker-field');
  $emp_name=$this->input->post('employee_name');
     $data['getEmployeeContributions'] = $this->Hrm_model->getEmployeeContributions_local($emp_name,$date);
       $data['employee_data'] =$this->Hrm_model->employee_data_get();
echo json_encode( $data['getEmployeeContributions']);

}


public function hr_tools(){
   $this->load->model('Hrm_model');
     $data['administrator'] = $this->Hrm_model->administrator_data();
     
      //  print_r($data);
         $content                  = $this->parser->parse('hr/toolkit_index', $data, true);
         $this->template->full_admin_html_view($content);
}



public function hand_book(){
   $this->load->model('Hrm_model');
    $data['title'] = "HandBook";
    $content  = $this->parser->parse('hr/handbook', $data, true);
         $this->template->full_admin_html_view($content);
}


public function generateAgentcheck()
    {
        $CI = & get_instance();
        $generateCheck = $CI->Web_settings->retrieve_agentcheck();
        // print_r($generateCheck);
        $data = array(
          'title' => 'Agent Cheque Generation',
          'agent' => $generateCheck
        );
        $content = $this->parser->parse('hr/generateagentcheck', $data, true);
        $this->template->full_admin_html_view($content);
    }
    
    
    public function agent_check(){
        
         $CI = & get_instance();
        $agent_list = $CI->Hrm_model->agent_list();
        // print_r($generateCheck);
        $data = array(
          'title' => 'Agent Cheque Generation',
          'agent_list' => $agent_list
        );
        $content = $this->parser->parse('hr/agent_list', $data, true);
        $this->template->full_admin_html_view($content);
        
    }
    
    
    public function viewAgentcheck($id=null)
    {
       $CI = & get_instance();
       $currency_details = $CI->Web_settings->retrieve_setting_editdata();
       $viewCheck = $CI->Web_settings->retrieve_agentviewcheck($id);
       $data = array(
        'check' => $viewCheck,
        'total_amount' => $viewCheck[0]['total_amount'],
        'commission' => $viewCheck[0]['agent_commission'],
        'date' => $viewCheck[0]['date'],
        'currency'  =>$currency_details[0]['currency']
       );
       $content = $this->parser->parse('hr/agentviewcheck', $data, true);
       $this->template->full_admin_html_view($content);
    }









public function second_pay_slip() {
          $CI = & get_instance();
          $CI->load->model('invoice_content');
          $w = & get_instance();
          $w->load->model('Ppurchases');
          $company_info = $w->Ppurchases->retrieve_company();
          $datacontent = $CI->invoice_content->retrieve_data();
          $this->load->model('Hrm_model');
          $data['title'] = display('pay_slip');
          $data['business_name']=(!empty($datacontent[0]['company_name'])?$datacontent[0]['company_name']:$company_info[0]['company_name']);
          $data['phone']=(!empty($datacontent[0]['mobile'])?$datacontent[0]['mobile']:$company_info[0]['mobile']);
          $data['email']=(!empty($datacontent[0]['email'])?$datacontent[0]['email']:$company_info[0]['email']);
          $data['address']=(!empty($datacontent[0]['address'])?$datacontent[0]['address']:$company_info[0]['address']);
          $data_timesheet['total_hours'] = $this->input->post('total_net');
          $data_timesheet['templ_name'] = $this->input->post('templ_name');
          $data_timesheet['duration'] = $this->input->post('duration');
          $data_timesheet['job_title'] = $this->input->post('job_title');
          $data_timesheet['payroll_type'] = $this->input->post('payroll_type');
          $data_timesheet['payment_term'] = $this->input->post('payment_term');
          $data_timesheet['extra_hour'] = $this->input->post('extra_hour');
          $data_timesheet['extra_rate'] = $this->input->post('extra_rate');
          $data_timesheet['extra_thisrate'] = $this->input->post('extra_thisrate');
          $data_timesheet['extra_this_hour'] = $this->input->post('extra_this_hour');
          $data_timesheet['extra_ytd'] = $this->input->post('extra_ytd');
          $data_timesheet['above_extra_beforehours'] = $this->input->post('above_extra_beforehours');
          $data_timesheet['above_extra_rate'] = $this->input->post('above_extra_rate');
          $data_timesheet['above_extra_sum'] = $this->input->post('above_extra_sum');
          $data_timesheet['above_this_hours'] = $this->input->post('above_this_hours');
          $data_timesheet['above_extra_ytd'] = $this->input->post('above_extra_ytd');
          $data_timesheet['month'] = $this->input->post('date_range');
          $date_split=explode(' - ',$this->input->post('date_range'));
          $data_timesheet['start'] =  $date_split[0];
          $data_timesheet['end'] =  $date_split[1];
    
 // Assuming $data_timesheet['start'] is set and contains a date in the format of 'd/m/Y'
 $start_date = $data_timesheet['start'];
$month = intval(substr($start_date, 0, 2));

// Determine the quarter based on the month
if ($month >= 1 && $month <= 3) {
    $quarter = 'Q1';
} elseif ($month >= 4 && $month <= 6) {
    $quarter = 'Q2';
} elseif ($month >= 7 && $month <= 9) {
    $quarter = 'Q3';
} elseif ($month >= 10 && $month <= 12) {
    $quarter = 'Q4';
} else {
    // Handle unexpected case
    $quarter = 'Unknown';
}

// Assign the quarter to the appropriate field in your data array
$data_timesheet['quarter'] = $quarter;

 // Now $data_timesheet includes the quarter based on the start date

       $data_timesheet['timesheet_id'] =  $this->input->post('tsheet_id');
       $data_timesheet['create_by'] =$this->session->userdata('user_id');
       $data_timesheet['admin_name'] = (!empty($this->input->post('administrator_person',TRUE))?$this->input->post('administrator_person',TRUE):'');
       $data_timesheet['payment_method'] =(!empty($this->input->post('payment_method',TRUE))?$this->input->post('payment_method',TRUE):'');
       $data_timesheet['cheque_no'] =(!empty($this->input->post('cheque_no',TRUE))?$this->input->post('cheque_no',TRUE):'');
       $data_timesheet['cheque_date'] =(!empty($this->input->post('cheque_date',TRUE))?$this->input->post('cheque_date',TRUE):'');
         $data_timesheet['bank_name'] =(!empty($this->input->post('bank_name',TRUE))?$this->input->post('bank_name',TRUE):'');
           $data_timesheet['payment_ref_no'] =(!empty($this->input->post('payment_refno',TRUE))?$this->input->post('payment_refno',TRUE):'');
     $timesheet_id  = $this->input->post('tsheet_id');
     $total_hours   = $this->input->post('total_net', TRUE);
      // Validate input data
     if (empty($timesheet_id) || $total_hours === FALSE) {
         // Handle invalid input. This might include logging the error, returning an error response, etc.
         log_message('error', 'Missing or invalid input for timesheet_id or total_hours.');
         echo 'Error: Missing or invalid input.'; // Or use another method to communicate the error
         return; // Stop further execution
     }
     $data2 = array(
         'timesheet_id' => $timesheet_id,
         'total_hours'  => $total_hours
     );
     $this->db->where('timesheet_id', $timesheet_id);
     $this->db->where('create_by', $this->session->userdata('user_id'));
     $success = $this->db->update('info_payslip', $data2);
    //  echo $this->db->last_query(); die();

     $data['employee_data'] = $this->Hrm_model->employee_info($this->input->post('templ_name'));
       $data['timesheet_data'] = $this->Hrm_model-> timesheet_info_data($data_timesheet['timesheet_id']);
       $timesheetdata =$data['timesheet_data'];
       $employeedata  =$data['employee_data'];
       $hrate= $data['employee_data'][0]['hrate'];
         $data_timesheet['h_rate']=$data['employee_data'][0]['hrate'];
       $total_hours=  $data['timesheet_data'][0]['total_hours'];
                   $payperiod =$data['timesheet_data'][0]['month'];
                    $get_date = explode('-', $payperiod);
         $d1 = $get_date[1];
      $data['sc']=$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
     $scValue =  $data['sc']['sc'][0]['sc']; // Accessing 'sc=12'
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount   
$sc_count = $data['sc']['count'];
$scValue = $scValue / 100;
// $scValueAmount1 = $scValue * $sc_totalAmount1;


   if (isset($data['employee_data']) && !empty($data['employee_data'])) {
            if (isset($data['employee_data'][0]['choice'])) {
              if ($data['employee_data'][0]['choice'] == 'No') {
                $scValueAmount1 = 0;
            } else {
              $scValueAmount1 = $scValue * $sc_totalAmount1;
            }
            }
          }

 if ($data['timesheet_data'][0]['payroll_type']=='Sales Partner'){
  //  $final = $scValueAmount1;
  $data['sc'] =$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
   $scValue =  $data['sc']['sc'][0]['sc'];
   $total_gtotal_value = $data['sc']['total_gtotal'];
   $scValue1 = $scValue / 100;
   $result = $scValue1 * $total_gtotal_value;
   $final = $result;
 }
  if ($data['timesheet_data'][0]['payroll_type'] !=='Sales Partner' ||  $data['employee_data'][0]['choice'] == 'Yes'){



           if(!empty($this->input->post('administrator_person',TRUE))){
            $data_timesheet['uneditable']=1;
       }else{
             $data_timesheet['uneditable']=0;
       }
       $u_id=$this->input->post('unique_id');
     //  if(empty($u_id)){
        $data_timesheet['unique_id']=$u_id;
     //  }
  $employee_detail = $this->db->where('id', $this->input->post('templ_name'));
  $q=$this->db->get('employee_history');
      //echo $this->db->last_query();
       $row = $q->row_array();
   if(!empty($row['id'])){
$data['selected_living_state_tax']=$row['living_state_tax'];
$data['selected_local_tax']=$row['local_tax'];


$data['selected_state_tax']=$row['state_tx'];


$data['templ_name']=$row['first_name']." ".$row['last_name'];
$data['job_title']=$row['designation'];
   }
        $date1 = $this->input->post('date');
       $day1 = $this->input->post('day');
       $time_start1 = $this->input->post('start');
       $time_end1 = $this->input->post('end');
       $hours_per_day1 = $this->input->post('sum');
        $daily_bk1=$this->input->post('dailybreak');
              $purchase_id_1 = $this->db->where('templ_name', $this->input->post('templ_name'))->where('timesheet_id', $data_timesheet['timesheet_id']);
       $q=$this->db->get('timesheet_info');
    //   echo $this->db->last_query();
       $row = $q->row_array();
 //    echo $row['timesheet_id'];
       $old_id=trim($row['timesheet_id']);
   if(!empty($old_id)){
       $this->session->set_userdata("timesheet_id_old",$row['timesheet_id']);
  $this->db->where('timesheet_id', $this->session->userdata("timesheet_id_old"));
 $this->db->delete('timesheet_info');
  $this->db->where('timesheet_id', $this->session->userdata("timesheet_id_old"));
       $this->db->delete('timesheet_info_details');
 $this->db->insert('timesheet_info', $data_timesheet);
//  echo $this->db->last_query(); die();
}
   else{
   $this->db->insert('timesheet_info', $data_timesheet);
    // echo $this->db->last_query(); die();
  }
//  $final_h_rate=$this->db->select('h_rate')->from('timesheet_info')->where('templ_name',$this->input->post('templ_name'))->where('month', $this->input->post('date_range'))->get()->row()->h_rate;
//  $final=($final_h_rate *$total_hours)+$scValueAmount1;

$data['timesheet_data'] = $this->Hrm_model-> timesheet_info_data($data_timesheet['timesheet_id']);
//print_r($data['timesheet_data']);die();
if($data['timesheet_data'][0]['payroll_type']=='Hourly'){

if ($total_hours <= 40) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
} else {
  $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
  //////  echo "Else : ".$final;
}
}else if ($data['timesheet_data'][0]['payroll_type']=='Salaried-BiWeekly'){
if ($total_hours <= 14) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
} else {
  $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
  //////  echo "Else : ".$final;
}
}else if ($data['timesheet_data'][0]['payroll_type']=='Salaried-weekly'){
// if ($total_hours <= 7) {
  $final = ($hrate * $total_hours) + $scValueAmount1;

// echo "IF : ".$final;

// } else {
//   $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
  

//   print_r($data['timesheet_data'][0]['extra_thisrate']);
//   print_r($data['timesheet_data'][0]['above_extra_sum']); 
//   echo "Else : ".$final;


// }
}else if ($data['timesheet_data'][0]['payroll_type']=='Salaried-Monthly'){
if ($total_hours <= 30) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
} else {
  $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
  //////  echo "Else : ".$final;
}
}else if ($data['timesheet_data'][0]['payroll_type']=='Salaried-BiMonthly'){
if ($total_hours <= 60) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
}

else {
  $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
  //////  echo "Else : ".$final;
}

}else if ($data['timesheet_data'][0]['payroll_type']=='SalesCommission'){
 $final = ($hrate * $total_hours) + $scValueAmount1;

}

// echo "</br>";
// print_r('last --'.$final); die();

   $purchase_id_2 = $this->db->select('timesheet_id')->from('timesheet_info')->where('templ_name',$this->input->post('templ_name'))->where('month', $this->input->post('date_range'))->get()->row()->timesheet_id;
 //  echo $this->db->last_query();
   $this->session->set_userdata("timesheet_id_new",$purchase_id_2);
   
    // echo $this->db->last_query();
    if($date1){
        for ($i = 0, $n = count($date1); $i < $n; $i++) {
           $date = $date1[$i];
           $day = $day1[$i];
            $daily_bk = $daily_bk1[$i];
           $time_start = $time_start1[$i];
           $time_end = $time_end1[$i];
           $hours_per_day = $hours_per_day1[$i];
           $data1 = array(
             'timesheet_id' =>$this->session->userdata("timesheet_id_new"),
               'Date'    => $date,
               'Day'      => $day,
                'daily_break'  =>$daily_bk,
               'time_start'  => $time_start,
               'time_end'   =>  $time_end,
               'hours_per_day' => $hours_per_day,
               'created_by' => $this->session->userdata('user_id')
       );
          $this->db->insert('timesheet_info_details', $data1);
          // echo $this->db->last_query(); die();
        }
    }else{
         $data1 = array(
             'timesheet_id' =>$this->session->userdata("timesheet_id_new"),
              
              
               'created_by' => $this->session->userdata('user_id')
       );
          $this->db->insert('timesheet_info_details', $data1);
          // echo $this->db->last_query(); die();
        }
        // .;
       // Federal Income Tax
          $s='';$u='';$m='';$f='';
       $federal_tax = $this->db->select('*')->from('federal_tax')->where('tax','Federal Income tax')->get()->result_array();
       $federal_range='';
       $f_tax='';
       foreach($federal_tax as $amt){
          $split=explode('-',$amt[$data['employee_data'][0]['employee_tax']]);
           if($final > $split[0] && $final < $split[1]){
             $federal_range=$split[0]."-".$split[1];
           }
           }
           
           
       $data['federal'] = $this->Hrm_model->federal_tax_info($data['employee_data'][0]['employee_tax'],$final,$federal_range);
       
   //    print_r($data['federal'] );
       
       if(!empty($data['federal'])){
    
          $Federal_employee= $data['federal'][0]['employee'];
          
          $f=($Federal_employee/100)*$final;
         $f= round($f, 3);
          $Federal_employer= $data['federal'][0]['employer'];
         $ff=($Federal_employer/100)*$final;
         $ff= round($ff, 3);
        

           $ar = $this->db->select('f_tax')->from('tax_history')->where('employee_id',$this->input->post('templ_name'))->get()->row()->f_tax;

       $f_tax=$ar+$f;
        // $f_tax= round($f_tax1, 2);
    //     echo "f_tax :". $f_tax;echo "<br/>";
       
       }
       //Social Security
       $social_tax = $this->db->select('*')->from('federal_tax')->where('tax','Social Security')->get()->result_array();
       $social_range='';
       $s_tax='';
          $split=explode('-',$social_tax[0][$data['employee_data'][0]['employee_tax']]);
           if($final > $split[0] && $final < $split[1]){
          $social_range=$split[0]."-".$split[1];
           }
       $data['social'] = $this->Hrm_model->social_tax_info($data['employee_data'][0]['employee_tax'],$final,$social_range);
       if(!empty($data['social'][0]['employee'])){
       $social_employee= $data['social'][0]['employee'];
         $s=($social_employee/100)*$final;
          $s= round($s, 3);
         $social_employer= $data['social'][0]['employer'];
     
         $ss=($social_employer/100)*$final;
         $ss= round($ss,3);
          $ar = $this->db->select('s_tax')->from('tax_history')->where('employee_id',$this->input->post('templ_name'))->get()->row()->s_tax;
        
       
          $s_tax=$ar+$s;
          // $s_tax= round($s_tax1, 2);
          //Medicare2747
       $Medicare = $this->db->select('*')->from('federal_tax')->where('tax','Medicare')->get()->result_array();
       $Medicare_range='';
       $m_tax='';
       foreach($Medicare as $social_amt){
          $split=explode('-',$social_amt[$data['employee_data'][0]['employee_tax']]);
           if($final > $split[0] && $final < $split[1]){
          $Medicare_range=$split[0]."-".$split[1];
           }
           }
       $data['Medicare'] = $this->Hrm_model->Medicare_tax_info($data['employee_data'][0]['employee_tax'],$final,$Medicare_range);
       if(!empty($data['Medicare'])){
       $Medicare_employee= $data['Medicare'][0]['employee'];
       $m=($Medicare_employee/100)*$final;
        $m= round($m, 3);
   $Medicare_employer= $data['Medicare'][0]['employer'];
         $mm=($Medicare_employer/100)*$final;
         $mm= round($mm, 3);
           $ar = $this->db->select('m_tax')->from('tax_history')->where('employee_id',$this->input->post('templ_name'))->get()->row()->m_tax;
        
       
           $m_tax=$ar+$m;
      
       }
       //Federal unemployment
       $unemployment = $this->db->select('*')->from('federal_tax')->where('tax','Federal unemployment')->get()->result_array();
       $unemployment_range='';
       $u_tax='';
       foreach($unemployment as $social_amt){
          $split=explode('-',$social_amt[$data['employee_data'][0]['employee_tax']]);
           if($final > $split[0] && $final < $split[1]){
          $unemployment_range=$split[0]."-".$split[1];
           }
           }
       $data['unemployment'] = $this->Hrm_model->unemployment_tax_info($data['employee_data'][0]['employee_tax'],$final,$unemployment_range);
       if(!empty($data['unemployment'])){
       $unemployment_employee= $data['unemployment'][0]['employee'];
         $unemployment_employer= $data['unemployment'][0]['employer'];
          $u=($unemployment_employee/100)*$final;
           $u= round($u, 3);
   $uu=($unemployment_employer/100)*$final;
         $uu= round($uu, 3);
          $ar = $this->db->select('u_tax')->from('tax_history')->where('employee_id',$this->input->post('templ_name'))->get()->row()->u_tax;
          
        
          $u_tax=$ar+$u;
      //   $u_tax= round($u_tax1, 2);
          
       }
 
       $state='';
       $living_state_tax_range='';
       $living_state_tax='';
       $living_state_tax_employer=array();
       $living_state_tax=array();

    //  print_r($data['employee_data'][0]['payroll_type']);   
    //  echo "------: <br/>";



if($data['employee_data'][0]['living_state_tax'] !='' && ($data['employee_data'][0]['living_state_tax'] !=='Not Applicable')){
           
// echo "Living State Tax : <br/>";
  
$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['employee_data'][0]['living_state_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
 
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();

$tax_split=explode(',',$state[0]['tax']);

 

foreach($tax_split as $tax){
  
  $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();

// echo "<br/>"; echo "<br/>"; echo "<br/>";
foreach($tax as $tx){
           $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
           if($split[0]!='' && $split[1]!=''){         
          
            if($final >= $split[0] && $final <= $split[1]){
              
      $local_tax_range=$split[0]."-".$split[1];


     
      $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
 
    
     if(!empty( $data['localtax'])){
           $i=0;
            foreach( $data['localtax'] as $lt){
    $local_tax_employee=$lt['employee'];
    $local_tax_employer=$lt['employer'];
    // echo  $local_tax_employer;\

    //  print_r($final); die();

        $local_tax_ee=($local_tax_employee/100)*$final;
          $local_tax_er=($local_tax_employer/100)*$final;
  // echo "<br/>"; echo       $local_tax_er."=(".$local_tax_employer."/100)*".$final;
           $row_employer = $this->db->select('*')->from('state_localtax')->where('employer',$local_tax_employer)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
  

           $data_employer="'employer_".$tx['tax']."'";
          //  print_r($data_employer);  die();


if($row_employer==1){
$t_tx1=$local_tax_er;
 $living_state_tax_employer[$data_employer]=$t_tx1;
 
}

          // echo "Employer_tax :".$local_tax_employer."/".$final."=".$local_tax_er;
   $row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
 
    $data_employee="'employee_".$tx['tax']."'";

         $search_tax=explode('-',$tx['tax']);
     
         if($row==1){
  
          $t_tx=$local_tax_ee;

          // print_r($t_tx);  die();


 $living_state_tax[$data_employee]=$t_tx;
//  print_r($living_state_tax);  die();
 
        }
           $i++;
       }
   }
            }
   }
}
}


         $test2= $this->db->select('*')->from('info_payslip')->where('timesheet_id',$timesheetdata[0]['timesheet_id'])
          ->get()->row();

          // echo $this->db->last_query();
  if(!empty($test2->timesheet_id)) {
       $this->db->where('timesheet_id',$test2->timesheet_id);
       $this->db->delete('info_payslip');
       }
      
 $test= $this->db->select('time_sheet_id')->from('tax_history')->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])
        ->get()->row();
   if(!empty($test->time_sheet_id)) {
   $this->db->where('time_sheet_id',$test->time_sheet_id);
   $this->db->delete('tax_history');
    }
  $payperiod =$data['timesheet_data'][0]['month'];
      $data['sc']=$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
     // print_r($data['sc']);
      if(isset($data['sc']['sc'][0]['sc'])) {
    $scValue = $data['sc']['sc'][0]['sc'];
    // Use $scValue here
}else{
   $scValue=0;
}
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
$sc_count = $data['sc']['count'];

if ($sc_totalAmount1 != 0) {
    $scValuePercentage = ($scValue / $sc_totalAmount1) * 100;
    $scValueAmount = ($scValuePercentage / 100) * $sc_totalAmount1;
} else {
   $scValueAmount = 0;
}
$scValue = $scValue / 100;
// Calculate the percentage of $sc_totalAmount1 based on $scValue
$scValueAmount = $scValue * $sc_totalAmount1;
}



//if($data['selected_living_state_tax'] =='' || !empty($data['selected_living_state_tax'])){
       $local_tax_range='';
       $local_tax='';
       $local_tax=array();
       $local_tax_employerr=array();

if(!empty($data['selected_local_tax']) && ($data['selected_local_tax'] !=='Not Applicable')){ 

//start local tax
echo "LOCAL TAX";
echo "<br/>";
$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['employee_data'][0]['local_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();

$tax_split=explode(',',$state[0]['tax']);

foreach($tax_split as $tax){
   $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
  echo $this->db->last_query();
foreach($tax as $tx){
          $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
          // echo "<br/>";
          //  echo "--------". $final."/".$split[0]."/".$split[1];
          //    echo "<br/>";
       if($split[0]!='' && $split[1]!=''){
           
           if($final > $split[0] && $final < $split[1]){
              
      $local_tax_range=$split[0]."-".$split[1];
     $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
       if(!empty( $data['localtax'])){
           $i=0;
            foreach( $data['localtax'] as $lt){
    $local_tax_employee=$lt['employee'];
    $local_tax_employer=$lt['employer'];
   
        $local_tax_ee=($local_tax_employee/100)*$final;
          $local_tax_er=($local_tax_employer/100)*$final;
           echo  "$$$".$local_tax_er;
                     $row_employer = $this->db->select('*')->from('state_localtax')->where('employer',$local_tax_employer)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
 $data_employer="'employer_".$tx['tax']."'";
if($row_employer==1){
$t_tx1=$local_tax_er;
 $local_tax_employerr[$data_employer]=$t_tx1;
}


   $row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
 $data_employee="'employee_".$tx['tax']."'";
         $search_tax=explode('-',$tx['tax']);
      if($row==1){
   $t_tx=$local_tax_ee;
 $local_tax[$data_employee]=$t_tx;
        }
           $i++;
       }
   }
            }
   }
}
}

}

         $state_tax_range='';
         $st_tax='';
         $st_tax=array();
         $st_tax_employer=array();
     
if(!empty($data['employee_data'][0]['state_tx'])  && ($data['employee_data'][0]['state_tx'] !=='Not Applicable') ) {
//end local tax

// //start state tax
// echo "<br/>";
// echo "STATE TAX ss";
// echo "<br/>";
$state_tax1 = $this->db->select('*')->from('state_and_tax')
->where('state',$data['employee_data'][0]['state_tx'])
 
->where('created_by',$this->session->userdata('user_id'))->get()->result_array();

// echo $this->db->last_query(); .;
 
$state1= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax1[0]['state'])->get()->result_array();

$tax_split1=explode(',',$state1[0]['tax']);

foreach($tax_split1 as $tax){

   $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax1[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
 
 
   
   // echo $this->db->last_query();


foreach($tax as $tx){
          $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
 
           if($split[0]!='' && $split[1]!=''){     
           if($final > $split[0] && $final < $split[1]){     
    $state_tax_range=$split[0]."-".$split[1];
     $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$state_tax_range);
       if(!empty( $data['localtax'])){
           $i=0;
            foreach( $data['localtax'] as $lt){
    $local_tax_employee=$lt['employee'];
    $local_tax_employer=$lt['employer'];
     if ( (strpos($tx['tax'], 'Disability') == true ) || (strpos($tx['tax'], 'FLI') == true )){
       $local_tax_ee=($local_tax_employee)*$final;
       $local_tax_er=($local_tax_employer)*$final;
      
}else{
        $local_tax_ee=($local_tax_employee/100)*$final;
       $local_tax_er=($local_tax_employer/100)*$final;
   
}
  //  echo "STATE    Employer_tax :".$local_tax_employer."/".$final."=".$local_tax_er;
  //  echo "<br/>";
   $row_employer = $this->db->select('*')->from('state_localtax')->where('employer',$local_tax_employer)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$state_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
   
   
  //  echo $this->db->last_query(); .;


   $data_employer="'employer_".$tx['tax']."'";

if($row_employer==1){
$t_tx1=$local_tax_er;
 $st_tax_employer[$data_employer]=$t_tx1;
}

//seeeeee

   $row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where('create_by',$this->session->userdata('user_id'))->where($data['employee_data'][0]['employee_tax'],$state_tax_range)->count_all_results();
 $data_employee="'employee_".$tx['tax']."'";
         $search_tax=explode('-',$tx['tax']);
 
         if($row==1){
 
  $t_tx=$local_tax_ee;

 $st_tax[$data_employee]=$t_tx;



        }
           $i++;
       }
   }
            }
   }
}
}
}







echo "<br/>";echo "st_tax_employer";
print_r($st_tax_employer);
echo "<br/>";

       $living_local_tax_range='';
       $living_local_tax='';
       $living_local_tax=array();
       $living_local_tax_employer=array();
if(!empty($data['employee_data'][0]['living_local_tax']) && ($data['employee_data'][0]['living_local_tax'] !=='Not Applicable') ) {
//end local tax

//start state tax
echo "<br/>";
echo "Living Local Tax";
echo "<br/>";
$state_tax1 = $this->db->select('*')->from('state_and_tax')->where('state',$data['employee_data'][0]['living_local_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
//echo $this->db->last_query();
$state1= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax1[0]['state'])->get()->result_array();

$tax_split1=explode(',',$state1[0]['tax']);

foreach($tax_split1 as $tax){
   $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax1[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
 // echo $this->db->last_query();
foreach($tax as $tx){
           $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
 
           if($split[0]!='' && $split[1]!=''){
           
           if($final > $split[0] && $final < $split[1]){
              
           $state_tax_range=$split[0]."-".$split[1];
 
          $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$state_tax_range);
     
     
     if(!empty( $data['localtax'])){
           $i=0;
            foreach( $data['localtax'] as $lt){
    $local_tax_employee=$lt['employee'];
    $local_tax_employer=$lt['employer'];
        $local_tax_ee=($local_tax_employee/100)*$final;
        
          $local_tax_er=($local_tax_employer/100)*$final;

 $row_employer = $this->db->select('*')->from('state_localtax')->where('employer',$local_tax_employer)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$state_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
 echo $this->db->last_query();
  $data_employer="'employer_".$tx['tax']."'";

if($row_employer==1){
$t_tx1=$local_tax_er;
 $living_local_tax_employer[$data_employer]=$t_tx1;
}


   $row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where('create_by',$this->session->userdata('user_id'))->where($data['employee_data'][0]['employee_tax'],$state_tax_range)->count_all_results();
 $data_employee="'employee_".$tx['tax']."'";
         $search_tax=explode('-',$tx['tax']);

         if($row==1){

  $t_tx=$local_tax_ee;
$living_local_tax[$data_employee]=$t_tx;
        }
           $i++;
       }
   }
            }
   }
}
}
}

$living_county_tax_range='';
       $living_county_tax='';
    $living_county_tax=array();
      $living_county_tax_employer=array();
if((!empty($data['employee_data'][0]['living_county_tax'])) && ($data['employee_data'][0]['living_county_tax'] !=='Not Applicable') ) {
//end local tax

//start state tax
// echo "<br/>";
// echo "Living County Tax";
// echo "<br/>";
$state_tax1 = $this->db->select('*')->from('state_and_tax')->where('state',$data['employee_data'][0]['living_county_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state1= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax1[0]['state'])->get()->result_array();

$tax_split1=explode(',',$state1[0]['tax']);

foreach($tax_split1 as $tax){
   $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax1[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
foreach($tax as $tx){
          $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
       if($split[0]!='' && $split[1]!=''){
           
           if($final > $split[0] && $final < $split[1]){
              
      $state_tax_range=$split[0]."-".$split[1];
     $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$state_tax_range);
       if(!empty( $data['localtax'])){
           $i=0;
            foreach( $data['localtax'] as $lt){
    $local_tax_employee=$lt['employee'];
    $local_tax_employer=$lt['employer'];
        $local_tax_ee=($local_tax_employee/100)*$final;
        
          $local_tax_er=($local_tax_employer/100)*$final;
           $row_employer = $this->db->select('*')->from('state_localtax')->where('employer',$local_tax_employer)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$state_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
//  echo $this->db->last_query();
                             $data_employer="'employer_".$tx['tax']."'";
if($row_employer==1){
$t_tx1=$local_tax_er;
 $living_county_tax_employer[$data_employer]=$t_tx1;
}
   $row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where('create_by',$this->session->userdata('user_id'))->where($data['employee_data'][0]['employee_tax'],$state_tax_range)->count_all_results();
 $data_employee="'employee_".$tx['tax']."'";
         $search_tax=explode('-',$tx['tax']); 
         if($row==1){
  $t_tx=$local_tax_ee;
$living_county_tax[$data_employee]=$t_tx;
        }
           $i++;
       }
   }
            }
   }
}
}
}

$working_county_tax_range='';
       $working_county_tax='';
    $working_county_tax=array();
        $working_county_tax_employer=array();
if((!empty($data['employee_data'][0]['cty_tax'])) && ($data['employee_data'][0]['cty_tax'] !=='Not Applicable') ) {
//end local tax

// //start state tax
// echo "<br/>";
// echo "Working County Tax";
// echo "<br/>";
$state_tax1 = $this->db->select('*')->from('state_and_tax')->where('state',$data['employee_data'][0]['cty_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state1= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax1[0]['state'])->get()->result_array();

$tax_split1=explode(',',$state1[0]['tax']);

foreach($tax_split1 as $tax){
   $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax1[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
foreach($tax as $tx){
          $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
       if($split[0]!='' && $split[1]!=''){
           
           if($final > $split[0] && $final < $split[1]){
              
      $state_tax_range=$split[0]."-".$split[1];
     $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$state_tax_range);
       if(!empty( $data['localtax'])){
           $i=0;
            foreach( $data['localtax'] as $lt){
    $local_tax_employee=$lt['employee'];
    $local_tax_employer=$lt['employer'];
        $local_tax_ee=($local_tax_employee/100)*$final;
        
          $local_tax_er=($local_tax_employer/100)*$final;

           $row_employer = $this->db->select('*')->from('state_localtax')->where('employer',$local_tax_employer)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$state_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
//  echo $this->db->last_query();
                             $data_employer="'employer_".$tx['tax']."'";
if($row_employer==1){
$t_tx1=$local_tax_er;
 $working_county_tax_employer[$data_employer]=$t_tx1;
}


   $row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where('create_by',$this->session->userdata('user_id'))->where($data['employee_data'][0]['employee_tax'],$state_tax_range)->count_all_results();
 $data_employee="'employee_".$tx['tax']."'";
         $search_tax=explode('-',$tx['tax']); 
         if($row==1){
  $t_tx=$local_tax_ee;
$working_county_tax[$data_employee]=$t_tx;
        }
           $i++;
       }
   }
            }
   }
}
}
}

$other_tax_range='';
       $other_tax='';
    $other_tax=array();
       $other_tax_employer=array();
if((!empty($data['employee_data'][0]['state_tax_2'])) && ($data['employee_data'][0]['state_tax_2'] !=='Not Applicable')){ 

//start local tax
// echo "LOCAL TAX";
// echo "<br/>";
$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['employee_data'][0]['state_tax_2'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();

$tax_split=explode(',',$state[0]['tax']);

foreach($tax_split as $tax){
   $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
 // echo $this->db->last_query();
foreach($tax as $tx){
          $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
         
       if($split[0]!='' && $split[1]!=''){
           
           if($final > $split[0] && $final < $split[1]){
              
      $local_tax_range=$split[0]."-".$split[1];
     $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
       if(!empty( $data['localtax'])){
           $i=0;
            foreach( $data['localtax'] as $lt){
    $local_tax_employee=$lt['employee'];
    $local_tax_employer=$lt['employer'];
        $local_tax_ee=($local_tax_employee/100)*$final;
          $local_tax_er=($local_tax_employer/100)*$final;

          $row_employer = $this->db->select('*')->from('state_localtax')->where('employer',$local_tax_employer)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
//  echo $this->db->last_query();
                             $data_employer="'employer_".$tx['tax']."'";
if($row_employer==1){
$t_tx1=$local_tax_er;
 $other_tax_employer[$data_employer]=$t_tx1;
}


   $row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
 $data_employee="'employee_".$tx['tax']."'";
         $search_tax=explode('-',$tx['tax']);
      if($row==1){
 
  $t_tx=$local_tax_ee;
 $other_tax[$data_employee]=$t_tx;
        }
           $i++;
       }
   }
            }
   }
}
}

}

$other_tax_state_range='';
       $other_working_tax='';
    $other_working_tax=array();
     $other_working_tax_employer=array();
if((!empty($data['employee_data'][0]['state_tax_1'])) && ($data['employee_data'][0]['state_tax_1'] !=='Not Applicable')){ 

//start local tax
// echo "LOCAL TAX";
// echo "<br/>";
$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['employee_data'][0]['state_tax_1'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();

$tax_split=explode(',',$state[0]['tax']);

foreach($tax_split as $tax){
   $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
 // echo $this->db->last_query();
foreach($tax as $tx){
          $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
          // echo "<br/>";
          //  echo "--------". $final."/".$split[0]."/".$split[1];
          //    echo "<br/>";
       if($split[0]!='' && $split[1]!=''){
           
           if($final > $split[0] && $final < $split[1]){
              
      $local_tax_range=$split[0]."-".$split[1];
     $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
       
      
     
     if(!empty( $data['localtax'])){
           $i=0;
            foreach( $data['localtax'] as $lt){
    $local_tax_employee=$lt['employee'];
    $local_tax_employer=$lt['employer'];
        $local_tax_ee=($local_tax_employee/100)*$final;
          $local_tax_er=($local_tax_employer/100)*$final;
                    $row_employer = $this->db->select('*')->from('state_localtax')->where('employer',$local_tax_employer)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
//  echo $this->db->last_query();
                             $data_employer="'employer_".$tx['tax']."'";
if($row_employer==1){
$t_tx1=$local_tax_er;
 $other_working_tax_employer[$data_employer]=$t_tx1;
}


   $row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
 $data_employee="'employee_".$tx['tax']."'";
         $search_tax=explode('-',$tx['tax']);
      if($row==1){
  //$ar = $this->db->select('amount')->from('tax_history')->where('tax_type','local_tax')->where('tax',$search_tax[1])->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])->get()->row()->amount;
  // echo "<br/>";  echo "<br/>";  echo "<br/>";  echo "<br/>"; 
  // echo $this->db->last_query();
  // echo "<br/>";  
  $t_tx=$local_tax_ee;
 $other_working_tax[$data_employee]=$t_tx;
        }
           $i++;
       }
   }
            }
   }
}
}

}
 
 $test2= $this->db->select('*')->from('info_payslip')->where('timesheet_id',$timesheetdata[0]['timesheet_id'])
          ->get()->row();
      if(!empty($test2->timesheet_id)) {
       $this->db->where('timesheet_id',$test2->timesheet_id);
       $this->db->delete('info_payslip');
       }

 $test= $this->db->select('time_sheet_id')->from('tax_history')->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])
        ->get()->row();
   if(!empty($test->time_sheet_id)) {
   $this->db->where('time_sheet_id',$test->time_sheet_id);
   $this->db->delete('tax_history');
    }





  $payperiod =$data['timesheet_data'][0]['month'];
       $data['sc']=$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
     if(isset($data['sc']['sc'][0]['sc'])) {
    $scValue = $data['sc']['sc'][0]['sc'];
    // Use $scValue here
} else {
    $scValue =0;
}
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
$sc_count = $data['sc']['count'];
if ($sc_totalAmount1 != 0) {
    $scValuePercentage = ($scValue / $sc_totalAmount1) * 100;
    $scValueAmount = ($scValuePercentage / 100) * $sc_totalAmount1;
} else {
   $scValueAmount = 0;
}

 
$scValue = $scValue / 100;

 $scValueAmount = $scValue * $sc_totalAmount1;

if($st_tax){
foreach ($st_tax as $k => $v) {
    if(trim( round($v,6)) >0){
 
    $existingRecord = $this->db->select('*')
        ->from('tax_history')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();

   $split=explode('-',$k);
 
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
  $data1 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
           'code'  => $code,
            'tax_type'=>'state_tax',
              'sales_c_amount' => $scValueAmount,
           'sc' => $scValue ,
           'no_of_inv' => $sc_count,
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
      );
    $this->db->insert('tax_history',$data1);
    // echo "<br/>";
    // print_r($data1);echo "<br/>";
   
   }
  }
  $sql = "DELETE t1
        FROM tax_history t1
        INNER JOIN tax_history t2 ON t1.id > t2.id
        AND t1.tax = t2.tax
        AND t1.code = t2.code
        AND t1.amount = t2.amount
        AND t1.created_by = t2.created_by
        AND t1.time_sheet_id = t2.time_sheet_id
        WHERE t1.weekly IS NULL
    AND t1.monthly IS NULL
    AND t1.biweekly IS NULL;
        
        
        
        ";

// Execute the SQL query
$this->db->query($sql);
 }









 if($data['employee_data'][0]['payroll_type'] == 'Hourly'){

  $minValue = $final; // Example minimum value of your range
  $maxValue = $final; // Example maximum value of your range


  // $data['tax_name'] = $this->Hrm_model->get_taxname_hourly();
  // print_r($data['tax_name']); die();

  $emp_tax = $data['employee_data'][0]['employee_tax'];
  $query = "SELECT `$emp_tax`
  FROM `state_localtax`
  WHERE `tax` = 'Pennsylvania-Income tax - PS'
  -- WHERE `tax` = '" . $data['tax_name'][0]['tax'] . "'
 
  AND CAST(SUBSTRING_INDEX(`$emp_tax`, '-', 1) AS UNSIGNED) <= ?
  AND CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`$emp_tax`, '-', -1), '-', 1) AS UNSIGNED) >= ?";
  $result = $this->db->query($query, array($maxValue, $minValue));
  if ($result) {
  $hourly_tax = $result->result_array();
 if (!empty($hourly_tax)) {
$hourly_range = $hourly_tax[0][$emp_tax];
$split_values = explode('-', $hourly_range);
$firstValue = $split_values[0];    
$secondValue = $split_values[1];  
$getvalue = $minValue - $firstValue;
$h_tax='';
$data['hourly'] = $this->Hrm_model->hourly_tax_info($data['employee_data'][0]['employee_tax'],$final,$hourly_range);
if(!empty($data['hourly'][0]['employee'])){    
  $hourly_employee_details= $data['hourly'][0]['details'];          
  $addamt = explode('$', $hourly_employee_details);            
  $houly_employee= $data['hourly'][0]['employee'];
  $holy=($houly_employee/100)*$final;
  $holy= round($holy, 3);
  $hourly=  $holy;
}

$data1 = array(
  's_tax'=>$s,
  'm_tax'=>$m,
  'u_tax'=>$u,
  'f_tax'=>$f,
  'code'  => $code,
  'tax_type'=>'state_tax',
  'sales_c_amount' => $scValueAmount,
  'sc' => $scValue ,
  'no_of_inv' => $sc_count,
  'tax'  => $tx_n,
 'amount' => round($v,3),
 'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
 'employee_id'     => $timesheetdata[0]['templ_name'],
 'created_by'     => $this->session->userdata('user_id'),
);
$data2 = array(
          
         'hourly'            => $hourly,
);
$this->db->where('time_sheet_id', $timesheetdata[0]['timesheet_id']);
$this->db->where('hourly IS NOT NULL');
$query = $this->db->get('tax_history');

// If no rows with monthly data exist for the timesheet ID, update the first row
if ($query->num_rows() == 0) {
$this->db->where('time_sheet_id', $timesheetdata[0]['timesheet_id']);
$this->db->order_by('id', 'ASC'); // Assuming id is the primary key
$this->db->limit(1);
$this->db->update('tax_history', $data2);
}

$this->db->insert('tax_history',$data1);
$sql = "DELETE t1
FROM tax_history t1
INNER JOIN tax_history t2 ON t1.id > t2.id
AND t1.tax = t2.tax
AND t1.code = t2.code
AND t1.amount = t2.amount
AND t1.created_by = t2.created_by
AND t1.time_sheet_id = t2.time_sheet_id
WHERE t1.hourly IS NULL
AND t1.monthly IS NULL
AND t1.biweekly IS NULL;  ";
// Execute the SQL query
$this->db->query($sql);



}

}

}
 

else if($data['employee_data'][0]['payroll_type'] == 'Salaried-weekly') {

    $minValue = $final; // Example minimum value of your range
    $maxValue = $final; // Example maximum value of your range


   $data['tax_name'] = $this->Hrm_model->get_taxname_weekly();
    
  // print_r($tax_name[0]['tax']);
  // die();
    // $query = "SELECT `single`
    // FROM `weekly_tax_info`
    // WHERE `tax` = '$tax_name[0]['tax']'
    // AND CAST(SUBSTRING_INDEX(`single`, '-', 1) AS UNSIGNED) <= $maxValue
    // AND CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`single`, '-', -1), '-', 1) AS UNSIGNED) >= $minValue";
    // $weekly_tax = $this->db->query($query)->result_array();
 
    $query = "SELECT `single`
    FROM `weekly_tax_info`
    WHERE `tax` = '" . $data['tax_name'][0]['tax'] . "'
    AND CAST(SUBSTRING_INDEX(`single`, '-', 1) AS UNSIGNED) <= $maxValue
    AND CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`single`, '-', -1), '-', 1) AS UNSIGNED) >= $minValue";

$weekly_tax = $this->db->query($query)->result_array();
// echo $this->db->last_query();
 
   $weekly_range  = $weekly_tax[0]['single'];
   $split_values = explode('-', $weekly_range);
   $firstValue = $split_values[0];  
   $secondValue = $split_values[1];  
   $getvalue = $minValue - $firstValue;
   $w_tax='';
   $data['weekly'] = $this->Hrm_model->weekly_tax_info($data['employee_data'][0]['employee_tax'],$final,$weekly_range);
   
   if(!empty($data['weekly'][0]['employee'])){
    $weekly_employee_details= $data['weekly'][0]['details'];
    $addamt = explode('$', $weekly_employee_details);
    // print_r($addamt);  
    $weekly_employee= $data['weekly'][0]['employee'];
    $wkly=($weekly_employee/100)*$getvalue;
    $wkly= round($wkly, 2);
    $weekly_tax= $addamt[1] + $wkly; 

  }

  $data1 = array(
    's_tax'=>$s,
    'm_tax'=>$m,
    'u_tax'=>$u,
    'f_tax'=>$f,
    'code'  => $code,
    'tax_type'=>'state_tax',
    'sales_c_amount' => $scValueAmount,
    'sc' => $scValue ,
    'no_of_inv' => $sc_count,
    'tax'  => $tx_n,
   'amount' => round($v,3),
   'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
   'employee_id'     => $timesheetdata[0]['templ_name'],
   'created_by'     => $this->session->userdata('user_id'),
);
$data2 = array(
            
           'weekly'            => $weekly_tax,
 );
$this->db->where('time_sheet_id', $timesheetdata[0]['timesheet_id']);
$this->db->where('weekly IS NOT NULL');
$query = $this->db->get('tax_history');

// If no rows with monthly data exist for the timesheet ID, update the first row
if ($query->num_rows() == 0) {
    $this->db->where('time_sheet_id', $timesheetdata[0]['timesheet_id']);
    $this->db->order_by('id', 'ASC'); // Assuming id is the primary key
    $this->db->limit(1);
    $this->db->update('tax_history', $data2);
}

$this->db->insert('tax_history',$data1);
$sql = "DELETE t1
        FROM tax_history t1
        INNER JOIN tax_history t2 ON t1.id > t2.id
        AND t1.tax = t2.tax
        AND t1.code = t2.code
        AND t1.amount = t2.amount
        AND t1.created_by = t2.created_by
        AND t1.time_sheet_id = t2.time_sheet_id
        WHERE t1.weekly IS NULL
    AND t1.monthly IS NULL
    AND t1.biweekly IS NULL;
        
        
        
        ";

// Execute the SQL query
$this->db->query($sql);
 
  
 } else if ($data['employee_data'][0]['payroll_type'] == 'Salaried-BiWeekly') {

  $minValue = $final; // Example minimum value of your range
  $maxValue = $final; // Example maximum value of your range

  
  $data['tax_name'] = $this->Hrm_model->get_taxname_biweekly();

  $query = "SELECT `single`
  FROM `biweekly_tax_info`
  -- WHERE `tax` = 'BIWeekly New Jersey-Income tax - NJ'
  WHERE `tax` = '" . $data['tax_name'][0]['tax'] . "'
  AND CAST(SUBSTRING_INDEX(`single`, '-', 1) AS UNSIGNED) <= $maxValue
  AND CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`single`, '-', -1), '-', 1) AS UNSIGNED) >= $minValue";

$biweekly_tax = $this->db->query($query)->result_array();
$biweekly_range  = $biweekly_tax[0]['single'];

 
 $split_values = explode('-', $biweekly_range);
 $firstValue = $split_values[0];  
 $secondValue = $split_values[1];  
 $getvalue = $minValue - $firstValue;

 $w_tax='';
 $data['biweekly'] = $this->Hrm_model->biweekly_tax_info($data['employee_data'][0]['employee_tax'],$final,$biweekly_range);

 if(!empty($data['biweekly'][0]['employee'])){
  $biweekly_employee_details= $data['biweekly'][0]['details'];
  $addamt1 = explode('$', $biweekly_employee_details);
   $biweekly_employee= $data['biweekly'][0]['employee'];
  $biwkly=($biweekly_employee/100)*$getvalue;
  $biwkly= round($biwkly, 2);
  $biweekly_tax= $addamt1[1] + $biwkly;
 }

$data1 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
           'code'  => $code,
           'tax_type'=>'state_tax',
           'sales_c_amount' => $scValueAmount,
           'sc' => $scValue ,
           'no_of_inv' => $sc_count,
           'tax'  => $tx_n,
          'amount' => round($v,3),
          'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
          'employee_id'     => $timesheetdata[0]['templ_name'],
         
          
          'created_by'     => $this->session->userdata('user_id'),
      );

    $this->db->insert('tax_history',$data1);

$data2 = array(
            
         'biweekly'          => $biweekly_tax,
 );
$this->db->where('time_sheet_id', $timesheetdata[0]['timesheet_id']);
$this->db->where('biweekly IS NOT NULL');
$query = $this->db->get('tax_history');

// If no rows with monthly data exist for the timesheet ID, update the first row
if ($query->num_rows() == 0) {
    $this->db->where('time_sheet_id', $timesheetdata[0]['timesheet_id']);
    $this->db->order_by('id', 'ASC'); // Assuming id is the primary key
    $this->db->limit(1);
    $this->db->update('tax_history', $data2);
}

 $sql = "DELETE t1
        FROM tax_history t1
        INNER JOIN tax_history t2 ON t1.id > t2.id
        AND t1.tax = t2.tax
        AND t1.code = t2.code
        AND t1.amount = t2.amount
        AND t1.created_by = t2.created_by
        AND t1.time_sheet_id = t2.time_sheet_id
        WHERE t1.weekly IS NULL
    AND t1.monthly IS NULL
    AND t1.biweekly IS NULL;";
      
// Execute the SQL query
$this->db->query($sql);

  } else if ($data['employee_data'][0]['payroll_type'] == 'Salaried-Monthly') {

    $minValue = $final; // Example minimum value of your range
    $maxValue = $final; // Example maximum value of your range
    $data['tax_name'] = $this->Hrm_model->get_taxname_monthly();
    $query = "SELECT `single`
    FROM `monthly_tax_info`
    -- WHERE `tax` = 'Monthly New Jersey-Income tax - NJ'
    WHERE `tax` = '" . $data['tax_name'][0]['tax'] . "'
    AND CAST(SUBSTRING_INDEX(`single`, '-', 1) AS UNSIGNED) <= $maxValue
    AND CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`single`, '-', -1), '-', 1) AS UNSIGNED) >= $minValue";
  

  $monthly_tax = $this->db->query($query)->result_array();
  $monthly_range  = $monthly_tax[0]['single'];
  
   $split_values = explode('-', $monthly_range);
   $firstValue = $split_values[0];  
   $secondValue = $split_values[1];  
   $getvalue = $minValue - $firstValue;
  
   $w_tax='';
   $data['monthly'] = $this->Hrm_model->monthly_tax_info($data['employee_data'][0]['employee_tax'],$final,$monthly_range);
  
   if(!empty($data['monthly'][0]['employee'])){
    $monthy_employee_details= $data['monthly'][0]['details'];
    $addamt1 = explode('$', $monthy_employee_details);
     $monthly_employee= $data['monthly'][0]['employee'];
    $month=($monthly_employee/100)*$getvalue;
    $month= round($month, 2);
    $monthly_tax= $addamt1[1] + $month;
   }
   

  $data1 = array(
             's_tax'=>$s,
             'm_tax'=>$m,
             'u_tax'=>$u,
             'f_tax'=>$f,
             'code'  => $code,
             'tax_type'=>'state_tax',
             'sales_c_amount' => $scValueAmount,
             'sc' => $scValue ,
             'no_of_inv' => $sc_count,
             'tax'  => $tx_n,
            'amount' => round($v,3),
            'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
            'employee_id'     => $timesheetdata[0]['templ_name'],
           // 'monthly'          => $monthly_tax,
            'created_by'     => $this->session->userdata('user_id'),
        );
  
      $this->db->insert('tax_history',$data1);
      $data2 = array(
                  
                  'monthly'          => $monthly_tax,
      );
$this->db->where('time_sheet_id', $timesheetdata[0]['timesheet_id']);
$this->db->where('monthly IS NOT NULL');
$query = $this->db->get('tax_history');

// If no rows with monthly data exist for the timesheet ID, update the first row
if ($query->num_rows() == 0) {
    $this->db->where('time_sheet_id', $timesheetdata[0]['timesheet_id']);
    $this->db->order_by('id', 'ASC'); // Assuming id is the primary key
    $this->db->limit(1);
    $this->db->update('tax_history', $data2);
}
// SQL query to delete duplicate rows except the one with the minimum ID within each group
$sql = "DELETE t1
        FROM tax_history t1
        INNER JOIN tax_history t2 ON t1.id > t2.id
        AND t1.tax = t2.tax
        AND t1.code = t2.code
        AND t1.amount = t2.amount
        AND t1.created_by = t2.created_by
        AND t1.time_sheet_id = t2.time_sheet_id
        WHERE t1.weekly IS NULL
    AND t1.monthly IS NULL
    AND t1.biweekly IS NULL;";
       
// Execute the SQL query
$this->db->query($sql);


  } else {
 
    $data1 = array(
      's_tax'=>$s,
      'm_tax'=>$m,
      'u_tax'=>$u,
      'f_tax'=>$f,
      'code'  => $code,
      'tax_type'=>'state_tax',
      'sales_c_amount' => $scValueAmount,
      'sc' => $scValue ,
      'no_of_inv' => $sc_count,
      'tax'  => $tx_n,
     'amount' => round($v,3),
     'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
     'employee_id'     => $timesheetdata[0]['templ_name'],
     'created_by'     => $this->session->userdata('user_id'),
  );
  
  $this->db->insert('tax_history',$data1);
$sql = "DELETE t1
        FROM tax_history t1
        INNER JOIN tax_history t2 ON t1.id > t2.id
        AND t1.tax = t2.tax
        AND t1.code = t2.code
        AND t1.amount = t2.amount
        AND t1.created_by = t2.created_by
        AND t1.time_sheet_id = t2.time_sheet_id
        WHERE t1.weekly IS NULL
    AND t1.monthly IS NULL
    AND t1.biweekly IS NULL;
        ";
// Execute the SQL query
$this->db->query($sql);
}


 if($st_tax_employer){
foreach ($st_tax_employer as $k => $v) {
   // if(trim( round($v,3)) >0){
    $existingRecord = $this->db->select('*')
        ->from('tax_history_employer')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
$tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);

        $data1 = array(
                  's_tax'=>$ss,
                  'm_tax'=>$mm,
                  'u_tax'=>$uu,
                  'f_tax'=>$ff,
                  'code'  => $code,
                  'tax_type'=>'state_tax',
                  'tax'  => $tx_n,
                  'amount' => round($v,3),
                  'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
                  'employee_id'     => $timesheetdata[0]['templ_name'],
                  'weekly'          => $weekly_tax,
                  'biweekly'          => $biweekly_tax,
                  'created_by'     => $this->session->userdata('user_id'),
              );
            $this->db->insert('tax_history_employer',$data1);
          //  echo $this->db->last_query();  .;ajithkumar
           // }
          }
            $sql = "DELETE t1
                FROM tax_history t1
                INNER JOIN tax_history t2 ON t1.id > t2.id
                AND t1.tax = t2.tax
                AND t1.code = t2.code
                AND t1.amount = t2.amount
                AND t1.created_by = t2.created_by
                AND t1.time_sheet_id = t2.time_sheet_id
                WHERE t1.weekly IS NULL
            AND t1.monthly IS NULL
            AND t1.biweekly IS NULL;";
        // Execute the SQL query
        $this->db->query($sql);
        }


          if($living_state_tax){
            $payperiod =$data['timesheet_data'][0]['month'];
                $data['sc']=$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
              if(isset($data['sc']['sc'][0]['sc'])) {
              $scValue = $data['sc']['sc'][0]['sc'];
              // Use $scValue here
          } else {
          $scValue=0;
          }
              $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
        $sc_count = $data['sc']['count'];
        if ($sc_totalAmount1 != 0) {
            $scValuePercentage = ($scValue / $sc_totalAmount1) * 100;
            $scValueAmount = ($scValuePercentage / 100) * $sc_totalAmount1;
        } else {
          $scValueAmount = 0;
        }
        $scValue = $scValue / 100;
        // Calculate the percentage of $sc_totalAmount1 based on $scValue
        $scValueAmount = $scValue * $sc_totalAmount1;
     
 

        foreach($living_state_tax as $k=>$v){
          if(trim( round($v,6)) >0){
          //echo "KKK : ".$k."-".$v;
          $split=explode('-',$k);


        //  print_r($split); die();

        $tx_n=str_replace("'","",$split[1]);
        $code = '';
        if(isset($split[2])) {
            $code = $split[2];
        } else {
            $code = '';
        }
          $code=str_replace("'","",$code);
          // print_r($code); die();


 
///////////////////////////////////////////// Start Code Here /////////////////////////////////////////
if($data['employee_data'][0]['payroll_type'] == 'Hourly'){
  $minValue = $final; // Example minimum value of your range
  $maxValue = $final; // Example maximum value of your range
  $lst_name = $data['employee_data'][0]['living_state_tax'];
  $data['tax_name'] = $this->Hrm_model->get_taxname_living_hourly($lst_name);
  $emp_tax = $data['employee_data'][0]['employee_tax'];
  $query = "SELECT `$emp_tax`
  FROM `state_localtax`
  WHERE `tax` = '" . $data['tax_name'][0]['tax'] . "'
  AND CAST(SUBSTRING_INDEX(`$emp_tax`, '-', 1) AS UNSIGNED) <= ?
  AND CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`$emp_tax`, '-', -1), '-', 1) AS UNSIGNED) >= ?";
  $result = $this->db->query($query, array($maxValue, $minValue));
  if ($result) {
  $hourly_tax = $result->result_array();
  if (!empty($hourly_tax)) {
  $hourly_range = $hourly_tax[0][$emp_tax];
  $split_values = explode('-', $hourly_range);
  $firstValue = $split_values[0];
  $secondValue = $split_values[1];  
  $getvalue = $minValue - $firstValue;
  $h_tax='';
  $data['hourly'] = $this->Hrm_model->hourly_tax_info($data['employee_data'][0]['employee_tax'],$final,$hourly_range);
  if(!empty($data['hourly'][0]['employee'])){   
  $hourly_employee_details= $data['hourly'][0]['details'];
  $addamt1 = explode('$', $hourly_employee_details);
  $houly_employee= $data['hourly'][0]['employee'];
  $holy=($houly_employee/100)*$getvalue;
  $holy= round($holy, 2);
  $hourly= $addamt1[0] + $holy;
}
}
}
} else if($data['employee_data'][0]['payroll_type'] == 'Salaried-weekly') {
  $minValue = $final; // Example minimum value of your range
  $maxValue = $final; // Example maximum value of your range
  $lst_name = $data['employee_data'][0]['living_state_tax'];
  $data['tax_name'] = $this->Hrm_model->get_taxname_living_weekly($lst_name);
  $emp_tax = $data['employee_data'][0]['employee_tax'];
  $query = "SELECT `$emp_tax`
  FROM `weekly_tax_info`
  WHERE `tax` = '" . $data['tax_name'][0]['tax'] . "'
  AND CAST(SUBSTRING_INDEX(`$emp_tax`, '-', 1) AS UNSIGNED) <= ?
  AND CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`$emp_tax`, '-', -1), '-', 1) AS UNSIGNED) >= ?";
  $result = $this->db->query($query, array($maxValue, $minValue));
  
  // print_r($result ); die();

  if ($result) {
   $weekly_tax = $result->result_array();
   if (!empty($weekly_tax)) {
   $weekly_range = $weekly_tax[0][$emp_tax];
   $split_values = explode('-', $weekly_range);
   $firstValue = $split_values[0];  
   $secondValue = $split_values[1];  
   $getvalue = $minValue - $firstValue;
   $w_tax='';
   $data['weekly'] = $this->Hrm_model->weekly_tax_info($data['employee_data'][0]['employee_tax'],$final,$weekly_range);
   if(!empty($data['weekly'][0]['employee'])){
   $weekly_employee_details= $data['weekly'][0]['details'];
   $addamt = explode('$', $weekly_employee_details);
   $weekly_employee= $data['weekly'][0]['employee'];
   $wkly=($weekly_employee/100)*$getvalue;
   $wkly= round($wkly, 2);
   $weekly_tax= $addamt[0] + $wkly; 
  //  print_r('weekly -'.$weekly_tax); die();
}
}
}
} else if($data['employee_data'][0]['payroll_type'] == 'Salaried-BiWeekly') {
  $minValue = $final; // Example minimum value of your range
  $maxValue = $final; // Example maximum value of your range
  $lst_name = $data['employee_data'][0]['living_state_tax'];
  $data['tax_name'] = $this->Hrm_model->get_taxname_living_biweekly($lst_name);
  $emp_tax = $data['employee_data'][0]['employee_tax'];
  $query = "SELECT `$emp_tax`  
  FROM `biweekly_tax_info`
  WHERE `tax` = '" . $data['tax_name'][0]['tax'] . "'
  AND CAST(SUBSTRING_INDEX(`$emp_tax`, '-', 1) AS UNSIGNED) <= $maxValue
  AND CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`$emp_tax`, '-', -1), '-', 1) AS UNSIGNED) >= $minValue";
  $result = $this->db->query($query, array($maxValue, $minValue));
  if ($result) {
  $biweekly_tax = $result->result_array();
  if (!empty($biweekly_tax)) {
  $biweekly_range = $biweekly_tax[0][$emp_tax];
  $split_values = explode('-', $biweekly_range);
  $firstValue = $split_values[0];  
  $secondValue = $split_values[1];  
  $getvalue = $minValue - $firstValue;
  $w_tax='';
  $data['biweekly'] = $this->Hrm_model->biweekly_tax_info($data['employee_data'][0]['employee_tax'],$final,$biweekly_range);
  if(!empty($data['biweekly'][0]['employee'])){
  $biweekly_employee_details= $data['biweekly'][0]['details'];
  $addamt1 = explode('$', $biweekly_employee_details);
  $biweekly_employee= $data['biweekly'][0]['employee'];
  $biwkly=($biweekly_employee/100)*$getvalue;
  $biwkly= round($biwkly, 2);
  $biweekly_tax= $addamt1[0] + $biwkly;
  } 
}
}
}
else   {
  $minValue = $final; // Example minimum value of your range
  $maxValue = $final; // Example maximum value of your range
  $lst_name = $data['employee_data'][0]['living_state_tax'];
  $data['tax_name'] = $this->Hrm_model->get_taxname_living_monthly($lst_name);
  $emp_tax = $data['employee_data'][0]['employee_tax'];
  $query = "SELECT `$emp_tax`  
  FROM `monthly_tax_info`
  WHERE `tax` = '" . $data['tax_name'][0]['tax'] . "'
  AND CAST(SUBSTRING_INDEX(`$emp_tax`, '-', 1) AS UNSIGNED) <= $maxValue
  AND CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`$emp_tax`, '-', -1), '-', 1) AS UNSIGNED) >= $minValue";
  $result = $this->db->query($query, array($maxValue, $minValue));
  if ($result) {
  $monthly_tax = $result->result_array();
  if (!empty($monthly_tax)) {
  $monthly_range = $monthly_tax[0][$emp_tax];
  $split_values = explode('-', $monthly_range);
  $firstValue = $split_values[0];  
  $secondValue = $split_values[1];  
  $getvalue = $minValue - $firstValue;
   $w_tax='';
  $data['monthly'] = $this->Hrm_model->monthly_tax_info($data['employee_data'][0]['employee_tax'],$final,$monthly_range);
  if(!empty($data['monthly'][0]['employee'])){
    $monthy_employee_details= $data['monthly'][0]['details'];
    $addamt1 = explode('$', $monthy_employee_details);
    $monthly_employee= $data['monthly'][0]['employee'];
    $month=($monthly_employee/100)*$getvalue;
    $month= round($month, 2);
    $monthly_tax= $addamt1[0] + $month;
   }
   } 
  }
}
if($data['employee_data'][0]['payroll_type'] == 'Hourly'){
   $amt = $hourly;
}else if($data['employee_data'][0]['payroll_type'] == 'Salaried-weekly'){
  $amt = $weekly_tax;
}else if($data['employee_data'][0]['payroll_type'] == 'Salaried-BiWeekly'){
  $amt = $biweekly_tax;
}else{
  $amt = $monthly_tax;
}
///////////////////////////////////////////// End Code Here /////////////////////////////////////////
$data8= array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
           'code' => $code,
           'sales_c_amount' => $scValueAmount,
           'sc' => $scValue ,
           'tax_type'=>'living_state_tax',
           'no_of_inv' => $sc_count,
           'tax'  => $tx_n,
           'amount' => $amt,
           'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
           'employee_id'     => $timesheetdata[0]['templ_name'],
           'created_by'     => $this->session->userdata('user_id'),
      );
    $this->db->insert('tax_history',$data8);
    error_log("data in model AFTER INSERT: ");
   }
  }
   $sql = "DELETE t1
        FROM tax_history t1
        INNER JOIN tax_history t2 ON t1.id > t2.id
        AND t1.tax = t2.tax
        AND t1.code = t2.code
        AND t1.amount = t2.amount
        AND t1.created_by = t2.created_by
        AND t1.time_sheet_id = t2.time_sheet_id
        WHERE t1.weekly IS NULL
    AND t1.monthly IS NULL
    AND t1.biweekly IS NULL;
        
        
        
        ";

// Execute the SQL query
$this->db->query($sql);
  }
 // print_r($living_state_tax_employer);.;
   if($living_state_tax_employer){
  $payperiod =$data['timesheet_data'][0]['month'];
       $data['sc']=$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
     if(isset($data['sc']['sc'][0]['sc'])) {
    $scValue = $data['sc']['sc'][0]['sc'];
    // Use $scValue here
} else {
 $scValue=0;
}
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
$sc_count = $data['sc']['count'];
if ($sc_totalAmount1 != 0) {
    $scValuePercentage = ($scValue / $sc_totalAmount1) * 100;
    $scValueAmount = ($scValuePercentage / 100) * $sc_totalAmount1;
} else {
   $scValueAmount = 0;
}

//end
//}
$scValue = $scValue / 100;

// Calculate the percentage of $sc_totalAmount1 based on $scValue
$scValueAmount = $scValue * $sc_totalAmount1;
foreach($living_state_tax_employer as $k=>$v){
  if(trim( round($v,3)) >0){
   //echo "KKK : ".$k."-".$v;
   $split=explode('-',$k);
//  print_r($split);
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
$data8= array(
           's_tax'=>$ss,
           'm_tax'=>$mm,
           'u_tax'=>$uu,
           'f_tax'=>$ff,
           'code' => $code,
         
           'tax_type'=>'living_state_tax',
          
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),

        'weekly'          => $weekly_tax,
        'biweekly'          => $biweekly_tax,

  

      );
    $this->db->insert('tax_history_employer',$data8);
      echo "<br/>";echo "<br/>";echo "<br/>";
    // print_r($living_state_tax);
   
       echo $this->db->last_query();
     //  echo $this->db->_error_message();
error_log("data in model AFTER INSERT: ");
    //   echo "<br/>";echo "<br/>";echo "<br/>";
  
   }
  }
   
  }

 if($local_tax){
    $payperiod =$data['timesheet_data'][0]['month'];
       $data['sc']=$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
     if(isset($data['sc']['sc'][0]['sc'])) {
    $scValue = $data['sc']['sc'][0]['sc'];
    // Use $scValue here
} else {
 $scValue=0;
}
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
$sc_count = $data['sc']['count'];
if ($sc_totalAmount1 != 0) {
    $scValuePercentage = ($scValue / $sc_totalAmount1) * 100;
    $scValueAmount = ($scValuePercentage / 100) * $sc_totalAmount1;
} else {
   $scValueAmount = 0;
}

//end
//}
$scValue = $scValue / 100;

// Calculate the percentage of $sc_totalAmount1 based on $scValue
$scValueAmount = $scValue * $sc_totalAmount1;
foreach ($local_tax as $k => $v) {
   if(trim( round($v,3)) >0){
  //echo "KKK : ".$k; echo "<br/>";
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
         ->where('tax_type', 'local_tax')
        ->get()->row();
         echo $this->db->last_query();
         echo "<br/>";
   $split=explode('-',$k); echo "<br/>";echo "<br/>";echo "SPLIT :";
 //  print_r($split);echo "<br/>";echo "<br/>";
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
    if (!$existingRecord) {

$data1 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
           'code'  => $code,
            'tax_type'=>'local_tax',
              'sales_c_amount' => $scValueAmount,
           'sc' => $scValue ,
           'no_of_inv' => $sc_count,
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
      );
   //echo "<br/>";   print_r($data1);echo "<br/>";
    $this->db->insert('tax_history',$data1);
   echo $this->db->last_query(); 
   }
  }
  }
 }
  if($local_tax_employerr){
    $payperiod =$data['timesheet_data'][0]['month'];
       $data['sc']=$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
     if(isset($data['sc']['sc'][0]['sc'])) {
    $scValue = $data['sc']['sc'][0]['sc'];
    // Use $scValue here
} else {
 $scValue=0;
}
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
$sc_count = $data['sc']['count'];
if ($sc_totalAmount1 != 0) {
    $scValuePercentage = ($scValue / $sc_totalAmount1) * 100;
    $scValueAmount = ($scValuePercentage / 100) * $sc_totalAmount1;
} else {
   $scValueAmount = 0;
}

//end
//}
$scValue = $scValue / 100;

// Calculate the percentage of $sc_totalAmount1 based on $scValue
$scValueAmount = $scValue * $sc_totalAmount1;
foreach ($local_tax_employerr as $k => $v) {
   if(trim( round($v,6)) >0){
  //echo "KKK : ".$k; echo "<br/>";
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history_employer')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
         ->where('tax_type', 'local_tax')
        ->get()->row();
         echo $this->db->last_query();
         echo "<br/>";
   $split=explode('-',$k); echo "<br/>";echo "<br/>";echo "SPLIT :";
 //  print_r($split);echo "<br/>";echo "<br/>";
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
    if (!$existingRecord) {

$data1 = array(
            's_tax'=>$ss,
           'm_tax'=>$mm,
           'u_tax'=>$uu,
           'f_tax'=>$ff,
           'code'  => $code,
            'tax_type'=>'local_tax',
           
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
        'weekly'          => $weekly_tax,
        'biweekly'          => $biweekly_tax,

      );
   //echo "<br/>";   print_r($data1);echo "<br/>";
    $this->db->insert('tax_history_employer',$data1);
   echo $this->db->last_query();
   }
  }
  }
 }


 if($living_local_tax){
foreach ($living_local_tax as $k => $v) {
 if(trim( round($v,3)) >0){
    //echo "KKK : ".$k; echo "<br/>"; echo "<br/>";
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
  //  echo "<br/>";
  //  print_r($split);
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
   // if (!$existingRecord) {

$data1 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
           'code'  => $code,
            'tax_type'=>'living_local_tax',
              'sales_c_amount' => $scValueAmount,
           'sc' => $scValue ,
           'no_of_inv' => $sc_count,
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
      );
    $this->db->insert('tax_history',$data1);
    // echo "<br/>";
    // print_r($data1);echo "<br/>";
  //  echo $this->db->last_query();
  
   }
  }
 }
  if($living_local_tax_employer){
foreach ($living_local_tax_employer as $k => $v) {
 if(trim( round($v,3)) >0){
    //echo "KKK : ".$k; echo "<br/>"; echo "<br/>";
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history_employer')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
  //  echo "<br/>";
  //  print_r($split);
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
   // if (!$existingRecord) {

$data1 = array(
            's_tax'=>$ss,
           'm_tax'=>$mm,
           'u_tax'=>$uu,
           'f_tax'=>$ff,
           'code'  => $code,
            'tax_type'=>'living_local_tax',
           'tax'  => $tx_n,
           'amount' => $v,
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
        'weekly'          => $weekly_tax,
        'biweekly'          => $biweekly_tax,
      );
    $this->db->insert('tax_history_employer',$data1);
    // echo "<br/>";
    // print_r($data1);echo "<br/>";
  //  echo $this->db->last_query();
  
   }
  }
 }
 if($working_county_tax){
foreach ($working_county_tax as $k => $v) {
 if(trim( round($v,3)) >0){
    //echo "KKK : ".$k; echo "<br/>"; echo "<br/>";
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
  //  echo "<br/>";
  //  print_r($split);
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
   // if (!$existingRecord) {

$data1 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
           'code'  => $code,
            'tax_type'=>'working_county_tax',
              'sales_c_amount' => $scValueAmount,
           'sc' => $scValue ,
           'no_of_inv' => $sc_count,
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
      );
    $this->db->insert('tax_history',$data1);
    // echo "<br/>";
    // print_r($data1);echo "<br/>";
  //  echo $this->db->last_query();
  
   }
  }
 }

if($working_county_tax_employer){
foreach ($working_county_tax_employer as $k => $v) {
 if(trim( round($v,3)) >0){
    //echo "KKK : ".$k; echo "<br/>"; echo "<br/>";
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history_employer')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
  //  echo "<br/>";
  //  print_r($split);
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
   // if (!$existingRecord) {

$data1 = array(
           's_tax'=>$ss,
           'm_tax'=>$mm,
           'u_tax'=>$uu,
           'f_tax'=>$ff,
           'code'  => $code,
            'tax_type'=>'working_county_tax',
           
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),

        'weekly'          => $weekly_tax,
        'biweekly'          => $biweekly_tax,
      );
    $this->db->insert('tax_history_employer',$data1);
echo $this->db->last_query();
  
   }
  }
 }

 if($living_county_tax){
foreach ($living_county_tax as $k => $v) {
 if(trim( round($v,3)) >0){
    //echo "KKK : ".$k; echo "<br/>"; echo "<br/>";
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
  //  echo "<br/>";
  //  print_r($split);
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
   // if (!$existingRecord) {

$data1 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
           'code'  => $code,
            'tax_type'=>'living_county_tax',
              'sales_c_amount' => $scValueAmount,
           'sc' => $scValue ,
           'no_of_inv' => $sc_count,
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
      );
    $this->db->insert('tax_history',$data1);
    // echo "<br/>";
    // print_r($data1);echo "<br/>";
  //  echo $this->db->last_query();
  
   }
  }
 }
 if($living_county_tax_employer){
foreach ($living_county_tax_employer as $k => $v) {
 if(trim( round($v,3)) >0){
    //echo "KKK : ".$k; echo "<br/>"; echo "<br/>";
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history_employer')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
  //  echo "<br/>";
  //  print_r($split);
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
   // if (!$existingRecord) {

$data1 = array(
           's_tax'=>$ss,
           'm_tax'=>$mm,
           'u_tax'=>$uu,
           'f_tax'=>$ff,
           'code'  => $code,
            'tax_type'=>'living_county_tax',
           
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
        'weekly'          => $weekly_tax,
        'biweekly'          => $biweekly_tax,

      );
    $this->db->insert('tax_history_employer',$data1);
    // echo "<br/>";
    // print_r($data1);echo "<br/>";
  //  echo $this->db->last_query();
  
   }
  }
 }

 if($other_tax){
foreach ($other_tax as $k => $v) {
 if(trim( round($v,3)) >0){
    //echo "KKK : ".$k; echo "<br/>"; echo "<br/>";
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
  //  echo "<br/>";
  //  print_r($split);
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
   // if (!$existingRecord) {

$data1 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
           'code'  => $code,
            'tax_type'=>'other_tax',
              'sales_c_amount' => $scValueAmount,
           'sc' => $scValue ,
           'no_of_inv' => $sc_count,
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
      );
    $this->db->insert('tax_history',$data1);
    // echo "<br/>";
    // print_r($data1);echo "<br/>";
  //  echo $this->db->last_query();
  
   }
  }
 }
 if($other_tax_employer){
foreach ($other_tax_employer as $k => $v) {
 if(trim( round($v,3)) >0){
    //echo "KKK : ".$k; echo "<br/>"; echo "<br/>";
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history_employer')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
  //  echo "<br/>";
  //  print_r($split);
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
   // if (!$existingRecord) {

$data1 = array(
            's_tax'=>$ss,
           'm_tax'=>$mm,
           'u_tax'=>$uu,
           'f_tax'=>$ff,
           'code'  => $code,
            'tax_type'=>'other_tax',
         
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
        'weekly'          => $weekly_tax,
        'biweekly'          => $biweekly_tax,
      );
    $this->db->insert('tax_history_employer',$data1);
   }
  }
 }
 if($other_working_tax){
foreach ($other_working_tax as $k => $v) {
 if(trim( round($v,3)) >0){
    //echo "KKK : ".$k; echo "<br/>"; echo "<br/>";
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
  //  echo "<br/>";
  //  print_r($split);
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
   // if (!$existingRecord) {

$data1 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
           'code'  => $code,
            'tax_type'=>'other_working_tax',
              'sales_c_amount' => $scValueAmount,
           'sc' => $scValue ,
           'no_of_inv' => $sc_count,
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
      );
    $this->db->insert('tax_history',$data1);
    // echo "<br/>";
    // print_r($data1);echo "<br/>";
  //  echo $this->db->last_query();
  
   }
  }
 }
  if($other_working_tax_employer){
foreach ($other_working_tax_employer as $k => $v) {
 if(trim( round($v,3)) >0){
    //echo "KKK : ".$k; echo "<br/>"; echo "<br/>";
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history_employer')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
  //  echo "<br/>";
  //  print_r($split);
 $tx_n=str_replace("'","",$split[1]);
$code = '';
if(isset($split[2])) {
    $code = $split[2];
} else {
    $code = '';
}
  $code=str_replace("'","",$code);
   // if (!$existingRecord) {

$data1 = array(
            's_tax'=>$ss,
           'm_tax'=>$mm,
           'u_tax'=>$uu,
           'f_tax'=>$ff,
           'code'  => $code,
            'tax_type'=>'other_working_tax',
            
           'tax'  => $tx_n,
           'amount' => round($v,3),
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
        'weekly'          => $weekly_tax,
        'biweekly'          => $biweekly_tax,
      );
    $this->db->insert('tax_history_employer',$data1);
    // echo "<br/>";
    // print_r($data1);echo "<br/>";
  //  echo $this->db->last_query();
  
   }
  }
 }
   echo "<br/>";
  echo "Working STATE";  echo "<br/>";
 print_r($st_tax);
    echo "<br/>";

  echo "<br/>";

  echo "Working LOCAL";  echo "<br/>";
  print_r($local_tax);
    echo "<br/>";
  echo "<br/>";

  echo "Working County ";  echo "<br/>";
  print_r($working_county_tax);
    echo "<br/>";
      echo "<br/>";

  echo "Other Working Tax";  echo "<br/>";
  print_r($other_working_tax);
    echo "<br/>";
    //working_county_tax     living_county_tax
 echo "LIVING STATE TAX";  echo "<br/>";
  print_r($living_state_tax);
    echo "<br/>";
    
echo "LIVING LOCAL TAX";  echo "<br/>";
 print_r($living_local_tax);
    echo "<br/>";
echo "LIVING County TAX";  echo "<br/>";
 print_r($living_county_tax);
    echo "<br/>";
  echo "<br/>";
  echo "OTHER";  echo "<br/>";
 print_r($other_tax);
    echo "<br/>";
  echo "<br/>"; //.;
  //die();
  $payperiod =$data['timesheet_data'][0]['month'];
       $data['sc']=$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
        $scValue =  $data['sc']['sc'][0]['sc']; // Accessing 'sc=12'
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
$sc_count = $data['sc']['count'];
$scValuePercentage = ($scValue / $sc_totalAmount1) * 100;
$sc_totalAmount = ($scValuePercentage / 100) * $sc_totalAmount1;
if (is_nan($scValuePercentage)) {
    $scValuePercentage = 0; // Set $scValuePercentage to 0 if it's NaN
}
$scValue = $scValue / 100;

// Calculate the percentage of $sc_totalAmount1 based on $scValue
$scValueAmount = $scValue * $sc_totalAmount1;
$data2 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
             'sc' => $scValueAmount ,
           'no_of_inv' => $countValue,
            'tax'  => $tx_n,
          'sales_c_amount' => $scValueAmount,
                                     
        'total_amount'          =>$final,
       'timesheet_id'   => $timesheetdata[0]['timesheet_id'],
       'total_hours'    => $timesheetdata[0]['total_hours'],
       'templ_name'     => $timesheetdata[0]['templ_name'],
       'employee_tax'   => $employeedata[0]['employee_tax'],
       'hrate'          => $employeedata[0]['hrate'],
       'id'             => $employeedata[0]['id'],
       // 'month'          => $timesheetdata[0]['month'],
        'create_by'     => $this->session->userdata('user_id'),
      );
    echo "<br/>";  print_r($data2);echo "<br/>";
    $this->db->insert('info_payslip',$data2);
   // echo "IF";die();
       }
	   }else{
	                          $payperiod =$data['timesheet_data'][0]['month'];
                    $get_date = explode('-', $payperiod);
         $d1 = $get_date[1];
      $data['sc']=$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
     $scValue =  $data['sc']['sc'][0]['sc']; // Accessing 'sc=12'
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount   
$sc_count = $data['sc']['count'];
$scValue = $scValue / 100;
   $scValueAmount1 = $scValue * $sc_totalAmount1;
      //  $data_timesheet['extra_thisrate'] =$scValueAmount1 ;
         $u_id=$this->input->post('unique_id');
     //  if(empty($u_id)){
        $data_timesheet['unique_id']=$u_id;
        $data_timesheet['payroll_type'] = "Sales Partner";
       $data_timesheet['uneditable'] =1;
          $data_timesheet['extra_thisrate'] = $scValueAmount1;
     //  }
  $employee_detail = $this->db->where('id', $this->input->post('templ_name'));
  $q=$this->db->get('employee_history');
      //echo $this->db->last_query();
       $row = $q->row_array();
   if(!empty($row['id'])){
$data['selected_living_state_tax']=$row['living_state_tax'];
$data['selected_local_tax']=$row['local_tax'];


$data['selected_state_tax']=$row['state_tx'];

 $data_timesheet['templ_name']=$row['id'];
$data['templ_name']=$row['first_name']." ".$row['last_name'];
$data['job_title']='Sales Partner';
   }
      
              $purchase_id_1 = $this->db->where('templ_name', $this->input->post('templ_name'))->where('timesheet_id', $data_timesheet['timesheet_id']);
       $q=$this->db->get('timesheet_info');
    //   echo $this->db->last_query();
       $row = $q->row_array();
 //    echo $row['timesheet_id'];
       $old_id=trim($row['timesheet_id']);
   if(!empty($old_id)){
       $this->session->set_userdata("timesheet_id_old",$row['timesheet_id']);
  $this->db->where('timesheet_id', $this->session->userdata("timesheet_id_old"));
 $this->db->delete('timesheet_info');
  $this->db->where('timesheet_id', $this->session->userdata("timesheet_id_old"));
       $this->db->delete('timesheet_info_details');
 $this->db->insert('timesheet_info', $data_timesheet);  //echo $this->db->last_query(); die();
}
   else{
   $this->db->insert('timesheet_info', $data_timesheet);
   //  echo $this->db->last_query(); die();
  }
//  $final_h_rate=$this->db->select('h_rate')->from('timesheet_info')->where('templ_name',$this->input->post('templ_name'))->where('month', $this->input->post('date_range'))->get()->row()->h_rate;
//  $final=($final_h_rate *$total_hours)+$scValueAmount1;
   $purchase_id_2 = $this->db->select('timesheet_id')->from('timesheet_info')->where('templ_name',$this->input->post('templ_name'))->where('month', $this->input->post('date_range'))->get()->row()->timesheet_id;
 //  echo $this->db->last_query();
   $this->session->set_userdata("timesheet_id_new",$purchase_id_2);
   
    // echo $this->db->last_query();
    if($date1){
        for ($i = 0, $n = count($date1); $i < $n; $i++) {
           $date = $date1[$i];
           $day = $day1[$i];
            $daily_bk = $daily_bk1[$i];
           $time_start = $time_start1[$i];
           $time_end = $time_end1[$i];
           $hours_per_day = $hours_per_day1[$i];
           $data1 = array(
             'timesheet_id' =>$this->session->userdata("timesheet_id_new"),
               'Date'    => $date,
               'Day'      => $day,
                'daily_break'  =>$daily_bk,
               'time_start'  => $time_start,
               'time_end'   =>  $time_end,
               'hours_per_day' => $hours_per_day,
               'created_by' => $this->session->userdata('user_id')
       );
          $this->db->insert('timesheet_info_details', $data1);
          // echo $this->db->last_query(); die();
        }
    }else{
         $data1 = array(
             'timesheet_id' =>$this->session->userdata("timesheet_id_new"),
               'created_by' => $this->session->userdata('user_id')
       );
          $this->db->insert('timesheet_info_details', $data1);
          // echo $this->db->last_query(); die();
        }
       }
 //echo $this->db->last_query();die();
       $this->session->set_flashdata('message', display('save_successfully'));
    
 
 redirect("Chrm/manage_timesheet");

}








 
public function checkTimesheet() {
        // Get the selected date and employee ID from the AJAX request
        $selectedDate = $this->input->post('selectedDate');
        $employeeId = $this->input->post('employeeId');

        // Use a model to query the timesheet_info table
        $this->load->model('Hrm_model');

        // Check if the month field for the selected employee contains the selected date
        $timesheetExists = $this->Hrm_model->checkTimesheetInfo($employeeId, $selectedDate);

        // Return response to AJAX request
        if ($timesheetExists) {
            echo 'Timesheet exists for this date and employee';
        } else {
            echo 'No timesheet found for this date and employee';
        }
    }



 

 





 public function edit_timesheet($id) {
     
      $CI = & get_instance();

      $CI->load->model('Web_settings');
      $this->load->model('Hrm_model');

      $setting_detail = $CI->Web_settings->retrieve_setting_editdata();

      $data['title']            = display('Payment_Administration');
      $data['time_sheet_data'] = $this->Hrm_model->time_sheet_data($id);
// print_r($data['time_sheet_data']);

      $data['setting_detail'] = $setting_detail;


         $data['employee_name'] = $this->Hrm_model->employee_name($data['time_sheet_data'][0]['templ_name']);
       $data['payment_terms'] = $this->Hrm_model->get_payment_terms();
      $data['dailybreak'] = $this->Hrm_model->get_dailybreak();
      $data['duration'] = $this->Hrm_model->get_duration_data();
      $data['administrator'] = $this->Hrm_model->administrator_data();
     
          $content                  = $this->parser->parse('hr/edit_timesheet', $data, true);
         $this->template->full_admin_html_view($content);
        }














public function time_list($timesheet_id = null,$templ_name)
        {
           $CI = & get_instance();
           $CC = & get_instance();
            $CII = & get_instance();
           $CI->load->model('invoice_content');
              $CII->load->model('invoice_design');
           $this->load->model('Hrm_model');
           $w = & get_instance();
           $w->load->model('Ppurchases');
           $company_info = $w->Ppurchases->retrieve_company();
           $datacontent = $CC->invoice_content->retrieve_data();
           $data['employee_data'] = $this->Hrm_model->employee_info($templ_name);
           $data['timesheet_data'] = $this->Hrm_model-> timesheet_info_data($timesheet_id);
            $timesheetdata =$data['timesheet_data'];
            $employeedata  =$data['employee_data'];
            $data['selected_living_state_tax']= $data['employee_data'][0]['living_state_tax'];
            $data['selected_local_tax']= $data['employee_data'][0]['local_tax'];
            $data['selected_state_tax']= $data['employee_data'][0]['state_tx'];
            $data['other_tax']= $data['employee_data'][0]['state_tax_2'];
 
           $hrate= $data['timesheet_data'][0]['h_rate'];
           $total_hours=  $data['timesheet_data'][0]['total_hours'];
              $dataw = $CII->invoice_design->retrieve_data($this->session->userdata('user_id'));
               $payperiod =$data['timesheet_data'][0]['month'];
                    $get_date = explode('-', $payperiod);
         $d1 = $get_date[1];
      $data['sc']=$this->Hrm_model->sc_info_count($templ_name,$payperiod);
    // print_r($data['sc']);
       $scValue =  $data['sc']['sc'][0]['sc']; // Accessing 'sc=12'
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
       
$sc_count = $data['sc']['count'];
$scValue = $scValue / 100;

// Calculate the percentage of $sc_totalAmount1 based on $scValue
// $scValueAmount1 = $scValue * $sc_totalAmount1;


if (isset($data['employee_data']) && !empty($data['employee_data'])) {
  if (isset($data['employee_data'][0]['choice'])) {
    if ($data['employee_data'][0]['choice'] == 'No') {
      $scValueAmount1 = 0;
  } else {
    $scValueAmount1 = $scValue * $sc_totalAmount1;
  }
  }
}











if($data['timesheet_data'][0]['payroll_type']=='Hourly'){

if ($total_hours <= 40) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
} else {
  $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
  //////  echo "Else : ".$final;
}
}else if ($data['timesheet_data'][0]['payroll_type']=='Salaried-BiWeekly'){
// if ($total_hours <= 14) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
// } else {
//   $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
//   //////  echo "Else : ".$final;
// }
}else if ($data['timesheet_data'][0]['payroll_type']=='Salaried-weekly'){
// if ($total_hours <= 7) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
// } else {
//   $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
//   echo "Else : ".$final;
// }
}else if ($data['timesheet_data'][0]['payroll_type']=='Salaried-Monthly'){
// if ($total_hours <= 30) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
// } else {
//   $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
//   //////  echo "Else : ".$final;
// }
}else if ($data['timesheet_data'][0]['payroll_type']=='Salaried-BiMonthly'){
// if ($total_hours <= 60) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
// } else {
//   $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
//   //////  echo "Else : ".$final;
// }

}else if ($data['timesheet_data'][0]['payroll_type']=='SalesCommission'){
 $final = ($hrate * $total_hours) + $scValueAmount1;

}
else if ($data['timesheet_data'][0]['payroll_type']=='Sales Partner'){
 $final = $scValueAmount1;

}
 
 $fin=$final;    
          $s='';$u='';$m='';$f='';
           // Federal Income Tax
           $federal_tax = $this->db->select('*')->from('federal_tax')->where('tax','Federal Income tax')->get()->result_array();
           $federal_range='';
           $f_tax='';
           foreach($federal_tax as $amt){
              $split=explode('-',$amt[$data['employee_data'][0]['employee_tax']]);
               if($final > $split[0] && $final < $split[1]){
                 $federal_range=$split[0]."-".$split[1];
               }
               }
             $query_row_count =       $this->db->select('timesheet_info.*, info_payslip.*, SUM(info_payslip.s_tax) as t_s_tax, SUM(info_payslip.m_tax) as t_m_tax, SUM(info_payslip.f_tax) as t_f_tax, SUM(info_payslip.u_tax) as t_u_tax, SUM(info_payslip.total_amount) as t_amount, SUM(timesheet_info.total_hours) as t_hours');
$this->db->from('timesheet_info');
$this->db->join('info_payslip', 'timesheet_info.timesheet_id = info_payslip.timesheet_id');
$this->db->where('info_payslip.templ_name',$data['employee_data'][0]['id']);
$this->db->where('info_payslip.create_by', $this->session->userdata('user_id'));
// $this->db->where('timesheet_info.month <=', $d1);
$this->db->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE(' $d1', '%m/%d/%Y')", NULL, FALSE);
$query_row_count = $this->db->get();
// echo $this->db->last_query(); die();

                 //$query_row_count = $this->db->select('*')->from('info_payslip') ->where("templ_name",$data['employee_data'][0]['id'])->get();
           $data['federal'] = $this->Hrm_model->federal_tax_info($data['employee_data'][0]['employee_tax'],$final,$federal_range);
           if(!empty($data['federal'])){
           $Federal_employee= $data['federal'][0]['employee'];
            $f=($Federal_employee/100)*$final;
        //   echo $f;echo "<br/>";
              $f= round($f, 3);
             if($query_row_count->num_rows() > 1){
                 $ar = $this->db->select('f_tax')->from('info_payslip') ->where("templ_name",$data['employee_data'][0]['id'])->get()->row()->f_tax;
         //  echo $ar;echo "<br/>";
                $f_tax=round(($ar+$f),3);
             //   echo $f_tax;echo "<br/>";
              }else{
               $f_tax=round($f,3);
              }
           }
           //Social Security
           $social_tax = $this->db->select('*')->from('federal_tax')->where('tax','Social Security')->get()->result_array();
           $social_range='';
           $s_tax='';
              $split=explode('-',$social_tax[0][$data['employee_data'][0]['employee_tax']]);
               if($final > $split[0] && $final < $split[1]){
              $social_range=$split[0]."-".$split[1];
               }
           $data['social'] = $this->Hrm_model->social_tax_info($data['employee_data'][0]['employee_tax'],$final,$social_range);
      //     print_r($data['social']);
           if(!empty($data['social'][0]['employee'])){
           $social_employee= $data['social'][0]['employee'];
             $s=($social_employee/100)*$final;
            //  echo "FFF :".$final;
            //  echo "<br/>";
               $s= round($s, 3);
            //  $s= round($s, 2);
          //    echo "<br/>".$s.'/'.$social_employee.'/'.$final."<br/>";
              //62.496
           if($query_row_count->num_rows() > 1){
                 $ar = $this->db->select('s_tax')->from('info_payslip') ->where("templ_name",$data['employee_data'][0]['id'])->get()->row()->s_tax;
                  // echo $this->db->last_query();.;
                //  echo "AR : "+$ar."<br/>";
                //  echo "S : ".$s."<br/>";
            $s_tax=round(($ar+$s),3);
             //  echo "s_tax : ".$s_tax."<br/>";
             }else{
               
               $s_tax=round($s,3);
                 //  echo "S TESTING : ".$s_tax."<br/>";
             }
     }
              //Medicare
           $Medicare = $this->db->select('*')->from('federal_tax')->where('tax','Medicare')->get()->result_array();
           $Medicare_range='';
           $m_tax='';
           foreach($Medicare as $social_amt){
              $split=explode('-',$social_amt[$data['employee_data'][0]['employee_tax']]);
               if($final > $split[0] && $final < $split[1]){
              $Medicare_range=$split[0]."-".$split[1];
               }
               }
           $data['Medicare'] = $this->Hrm_model->Medicare_tax_info($data['employee_data'][0]['employee_tax'],$final,$Medicare_range);
           if(!empty($data['Medicare'])){
           $Medicare_employee= $data['Medicare'][0]['employee'];
           $m=($Medicare_employee/100)*$final;
           
             $m= round($m, 3);
             if($query_row_count->num_rows() > 1){
                 $ar = $this->db->select('m_tax')->from('info_payslip') ->where("templ_name",$data['employee_data'][0]['id'])->get()->row()->m_tax;
            $m_tax=round(($ar+$m),3);
            
              }else{
               $m_tax=round($m,3);
              }
           }
   
           //Federal unemployment
           $unemployment = $this->db->select('*')->from('federal_tax')->where('tax','Federal unemployment')->get()->result_array();
           $unemployment_range='';
           $u_tax='';
           foreach($unemployment as $social_amt){
              $split=explode('-',$social_amt[$data['employee_data'][0]['employee_tax']]);
               if($final > $split[0] && $final < $split[1]){
              $unemployment_range=$split[0]."-".$split[1];
               }
               }
        
               $data['unemployment'] = $this->Hrm_model->unemployment_tax_info($data['employee_data'][0]['employee_tax'],$final,$unemployment_range);
         //  print_r($data['unemployment']);
           if(!empty($data['unemployment'])){
           $unemployment_employee= $data['unemployment'][0]['employee'];
              $u=($unemployment_employee/100)*$final;
               $u= round($u, 3);
              if($query_row_count->num_rows() > 1){
                 $ar = $this->db->select('u_tax')->from('info_payslip') ->where("templ_name",$data['employee_data'][0]['id'])->get()->row()->u_tax;
          $u_tax=round(($ar+$u),3);
              }else{
               $u_tax=round($u,3);
              }
           }



      $state='';
      $local_sum=array();
      $local_tax='';     
      $local_tax=array();
      $selected_local_sum=array();
      $selected_local_tax='';
      $selected_local_tax=array();
    
      $selected_state_sum=array();
    
    
    
      $selected_state_tax='';    $selected_state_tax=array();
      $other_tax=''; $other_tax=array();
      $other_tax_sum=array();
     $get_date = explode('-', $payperiod);
$d1 = $get_date[1];
if(($data['selected_living_state_tax'] !='')  && ($data['selected_living_state_tax'] !=='Not Applicable')){
$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['selected_living_state_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
  $tax_split=explode(',',$state[0]['tax']);
    $local_tax_range='';
         
    
    
   foreach($tax_split as $tax){

 

       $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
   
      // print_r($tax); die();

      //  $tax=$this->db->select('*')->from('state_localtax')
      // //  ->where('tax','Maryland-Income tax - ML')
      //  $this->db->like('tax'  ,"%$state_tax[0]['state']%");
      //  ->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
      //  $state_tax = $this->db->select('*')->from('state_localtax')
      //  ->like('tax', '%' . $state_tax[0]['state'] . '%')
      //  ->where('create_by', $this->session->userdata('user_id'))
      //  ->get()
      //  ->result_array();

 
       foreach($tax as $tx){
    
      $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);


           if($split[0]!='' && $split[1]!=''){
          if($final >= $split[0] && $final <= $split[1]){
          $local_tax_range=$split[0]."-".$split[1];
          $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
          if(!empty( $data['localtax'])){
               $i=0;
                foreach( $data['localtax'] as $lt){
        $local_tax_employee=$lt['employee'];
        $local_tax_employer=$lt['employer'];

 
            $local_tax_ee=($local_tax_employee/100)*$final;
            $local_tax_er=($local_tax_employer/100)*$final;

             
$row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
         
$data_employee="'employee_".$tx['tax']."'";
             $search_tax=explode('-',$tx['tax']);
 

          if($row==1){
            $ar = $this->db->select('amount')->from('tax_history')->where('tax_type','living_state_tax')->where('tax',$search_tax[1])->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])->get()->row()->amount;
// echo $this->db->last_query();echo "<br/>"; die();
            if($ar){
       $t_tx=$ar;
   }else{
           $t_tx=0;
        }

        // print_r($t_tx);  die();


    $query = $this->db->select("*")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                    
                       ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get();
                  //   echo $this->db->last_query();
   if($query->num_rows() >= 1){
  $query = $this->db->select_sum("amount")
                     ->from("tax_history")
                      ->where("tax_type","living_state_tax")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                          ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get()->row()->amount;
                    // echo $this->db->last_query(); die();

                     $amt = $query;
     $local_sum[$search_tax[1]]=$amt;
   //  echo "<br/>";
       //echo $local_sum[$search_tax[1]]; echo "<br/>";
   }else{
         $local_sum[$search_tax[1]]=$local_tax_ee;
     //  echo "<br/>";   echo $local_sum[$search_tax[1]]; echo "<br/>";
   }
               $local_tax[$data_employee]=$t_tx;

              //  print_r($local_tax); die();
////lllllllll
            }
               $i++;
           }  
       }
                }
       }
   }
   }
  }

if(!empty($data['selected_local_tax']) && ($data['selected_local_tax'] !=='Not Applicable')){ 
$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['selected_local_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();
  $tax_split=explode(',',$state[0]['tax']);
   // print_r($state);
    $local_tax_range='';
          
         
   foreach($tax_split as $tax){
       $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
    foreach($tax as $tx){

    //   echo "<br/>";
    //   echo "local"   .$tx['tax'];
    //   echo "<br/>";


              $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
      if($split[0]!='' && $split[1]!=''){
               if($final > $split[0] && $final < $split[1]){
          $local_tax_range=$split[0]."-".$split[1];
         $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
           if(!empty( $data['localtax'])){
               $i=0;
                foreach( $data['localtax'] as $lt){
        $local_tax_employee=$lt['employee'];
        $local_tax_employer=$lt['employer'];
            $local_tax_ee=($local_tax_employee/100)*$final;
        
              $local_tax_er=($local_tax_employer/100)*$final;
$row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
             $data_employee="'employee_".$tx['tax']."'";
             $search_tax=explode('-',$tx['tax']);
          if($row==1){
            $ar = $this->db->select('amount')->from('tax_history')->where('tax_type','local_tax')->where('tax',$search_tax[1])->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])->get()->row()->amount;
//  echo $this->db->last_query();echo "<br/>";
  $t_tx='';
            if($ar){
       $t_tx=$ar;
   }else{
           $t_tx=0;
        }
      }
   $query = $this->db->select("*")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                       ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get();
                    // echo "<br/>";
                   //  echo $this->db->last_query();  echo "<br/>";
   if($query->num_rows() >= 1){
     $query = $this->db->select_sum("amount")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                      ->where("tax_type","local_tax")
                          ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get()->row()->amount;
                      // echo "<br/>";//echo $this->db->last_query();
                      
                      // echo "<br/>";
                      // echo " Local Tax EEE:".$local_tax_ee;
                      
                     // .;
                     $amt = $query;
     $selected_local_sum[$search_tax[1]]=$amt;
//   echo "<br/>";
//       print_r($selected_local_sum); echo "<br/>";.;
   }else{
         $selected_local_sum[$search_tax[1]]=$local_tax_ee;
  //  echo "<br/>";
  //                     echo " Local Tax EEE:".$local_tax_ee;
    //   echo print_r($selected_local_sum); echo "<br/>";.;
     // echo "<br/>";   echo $local_sum[$search_tax[1]]; echo "<br/>";
   }
               $selected_local_tax[$data_employee]=$t_tx;
          //  }
               $i++;
           }  
       }
                }
       }
   }
   }



}




if(!empty($data['selected_state_tax']) && ($data['selected_state_tax'] !=='Not Applicable') ) {

  $state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['selected_state_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
// Fetch all records 
 

  // echo $this->db->last_query(); 

  echo '<br>' ;
  
  $state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();
  
  // echo $this->db->last_query(); .;
  //  $tax_split=explode(',',$state[0]['tax']);



// Assuming $tax_split contains the initial array of taxes
$tax_split = explode(',', $state[0]['tax']);

// Filter out "Income tax - NJ"
$filtered_tax_split = array_filter($tax_split, function($tax) {
    return trim($tax) !== 'Income tax - NJ';
});

 
    
   $local_tax_range='';
           
   foreach($filtered_tax_split as $tax){

       $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
      //  echo $this->db->last_query(); .;
    
       foreach($tax as $tx){

              $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
               if($split[0]!='' && $split[1]!=''){
               if($final > $split[0] && $final < $split[1]){
               $local_tax_range=$split[0]."-".$split[1];

                $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
         
         if(!empty( $data['localtax'])){
               $i=0;
                foreach( $data['localtax'] as $lt){
                $local_tax_employee=$lt['employee'];
                $local_tax_employer=$lt['employer'];
                $local_tax_ee=($local_tax_employee/100)*$final;
                $local_tax_er=($local_tax_employer/100)*$final;


$row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
$data_employee="'employee_".$tx['tax']."'";

             $search_tax=explode('-',$tx['tax']);
        
        
             if($row==1){

            $ar = $this->db->select('amount')->from('tax_history')->where('tax_type','state_tax')->where('tax',$search_tax[1])->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])->get()->row()->amount;

            // echo  $this->db->last_query();echo "<br/>";  
            //  echo  $this->db->last_query();echo "<br/>"; .;
        if($ar){
        $t_tx=$ar;
        }else{
           $t_tx=0;
        }
 
   $query = $this->db->select("*")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                     ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                     ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)
                     ->get();
                    // echo $this->db->last_query();
   

  if($query->num_rows() >= 1){
 
     $query = $this->db->select_sum("amount")
                       ->from("tax_history")
                       ->where("employee_id",$data['employee_data'][0]['id'])
                       ->where("tax",$search_tax[1])
                       ->where("tax_type","state_tax")
                       ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                       ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)
                       ->get()->row()->amount;
                       //  echo $this->db->last_query(); .;
                        $amt = $query;
                     
     $selected_state_sum[$search_tax[1]]=$amt;
  
     }else{
         $selected_state_sum[$search_tax[1]]=$local_tax_ee;
     }
         $selected_state_tax[$data_employee]=$t_tx  ;

 
            }
               $i++;
           }  
       }
                }
       }
   }
   }


}
 
//Starts Other Tax
  if(!empty($data['other_tax']) && ($data['other_tax'] !=='Not Applicable') ) {
$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['other_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();

                    //  echo $this->db->last_query(); .;
// 

  $tax_split=explode(',',$state[0]['tax']);
  //  print_r($tax_split); .;
    $local_tax_range='';
          
      
   foreach($tax_split as $tax){
       $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
    foreach($tax as $tx){

    //   echo "<br/>";
    //   echo "state"   .$tx['tax'];
    //   echo "<br/>";   
              $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
      if($split[0]!='' && $split[1]!=''){
               if($final > $split[0] && $final < $split[1]){
          $local_tax_range=$split[0]."-".$split[1];
         $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
           if(!empty( $data['localtax'])){
               $i=0;
                foreach( $data['localtax'] as $lt){
        $local_tax_employee=$lt['employee'];
        $local_tax_employer=$lt['employer'];
            $local_tax_ee=($local_tax_employee/100)*$final;
        
              $local_tax_er=($local_tax_employer/100)*$final;
$row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
           
$data_employee="'employee_".$tx['tax']."'";
             $search_tax=explode('-',$tx['tax']);
          
             $t_tx='';
          if($row==1){
            $ar = $this->db->select('amount')->from('tax_history')->where('tax_type','other_tax')->where('tax',$search_tax[1])->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])->get()->row()->amount;

            if($ar){
       $t_tx=$ar;
      
   }else{
           $t_tx=0;
            
        }


   $query = $this->db->select("*")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                   ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get();
                    // echo $this->db->last_query();
   if($query->num_rows() >= 1){
     $query = $this->db->select_sum("amount")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                      ->where("tax_type","other_tax")
                       ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get()->row()->amount;
                     // echo $this->db->last_query();
                     $amt = $query;
     $other_tax_sum[$search_tax[1]]=$amt;
   
   }else{
         $other_tax_sum[$search_tax[1]]=$local_tax_ee;
     
   }
               $other_tax[$data_employee]=$t_tx;
            }
               $i++;
           }  
       }
                }
       }
   }
   }


}

//Start Other Working Tax
$other_working_tax=array();
$other_working_sum=array();
  if(!empty($data['employee_data'][0]['state_tax_1']) && ($data['employee_data'][0]['state_tax_1'] !=='Not Applicable') ) {
$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['employee_data'][0]['state_tax_1'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();
  $tax_split=explode(',',$state[0]['tax']);
   // print_r($state);
    $local_tax_range='';
          
      
   foreach($tax_split as $tax){
       $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
    foreach($tax as $tx){

    //   echo "<br/>";
    //   echo "state"   .$tx['tax'];
    //   echo "<br/>";   
              $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
      if($split[0]!='' && $split[1]!=''){
               if($final > $split[0] && $final < $split[1]){
          $local_tax_range=$split[0]."-".$split[1];
         $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
           if(!empty( $data['localtax'])){
               $i=0;
                foreach( $data['localtax'] as $lt){
        $local_tax_employee=$lt['employee'];
        $local_tax_employer=$lt['employer'];
            $local_tax_ee=($local_tax_employee/100)*$final;
        
              $local_tax_er=($local_tax_employer/100)*$final;
$row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
           
$data_employee="'employee_".$tx['tax']."'";
             $search_tax=explode('-',$tx['tax']);
              $t_tx='';
          if($row==1){
            $ar = $this->db->select('amount')->from('tax_history')->where('tax_type','other_working_tax')->where('tax',$search_tax[1])->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])->get()->row()->amount;

            if($ar){
       $t_tx=$ar;
      
   }else{
           $t_tx=0;
            
        }
   $query = $this->db->select("*")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                   ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get();
                    // echo $this->db->last_query();
   if($query->num_rows() >= 1){
     $query = $this->db->select_sum("amount")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                      ->where("tax_type","other_working_tax")
                       ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get()->row()->amount;
                     // echo $this->db->last_query();
                     $amt = $query;
     $other_working_sum[$search_tax[1]]=$amt;
   
   }else{
         $other_working_sum[$search_tax[1]]=$local_tax_ee;
     
   }
               $other_working_tax[$data_employee]=$t_tx;
            }
               $i++;
           }  
       }
                }
       }
   }
   }


}
//Living county starts
$living_county_tax_range='';
       $living_county_tax='';
    $living_county_tax=array();
    $living_county_sum=array();
  if(!empty($data['employee_data'][0]['living_county_tax']) && ($data['employee_data'][0]['living_county_tax'] !=='Not Applicable') ) {
$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['employee_data'][0]['living_county_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();
  $tax_split=explode(',',$state[0]['tax']);
   // print_r($state);
    $local_tax_range='';
          
      
   foreach($tax_split as $tax){
       $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
    foreach($tax as $tx){

    //   echo "<br/>";
    //   echo "state"   .$tx['tax'];
    //   echo "<br/>";   
              $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
      if($split[0]!='' && $split[1]!=''){
               if($final > $split[0] && $final < $split[1]){
          $local_tax_range=$split[0]."-".$split[1];
         $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
           if(!empty( $data['localtax'])){
               $i=0;
                foreach( $data['localtax'] as $lt){
        $local_tax_employee=$lt['employee'];
        $local_tax_employer=$lt['employer'];
            $local_tax_ee=($local_tax_employee/100)*$final;
        
              $local_tax_er=($local_tax_employer/100)*$final;
$row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
           
$data_employee="'employee_".$tx['tax']."'";
             $search_tax=explode('-',$tx['tax']);
              $t_tx='';
          if($row==1){
            $ar = $this->db->select('amount')->from('tax_history')->where('tax_type','living_county_tax')->where('tax',$search_tax[1])->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])->get()->row()->amount;

            if($ar){
       $t_tx=$ar;
      
   }else{
           $t_tx=0;
            
        }
   $query = $this->db->select("*")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                   ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get();
                    // echo $this->db->last_query();
   if($query->num_rows() >= 1){
     $query = $this->db->select_sum("amount")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                      ->where("tax_type","living_county_tax")
                       ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get()->row()->amount;
                     // echo $this->db->last_query();
                     $amt = $query;
     $living_county_sum[$search_tax[1]]=$amt;
   
   }else{
         $living_county_sum[$search_tax[1]]=$local_tax_ee;
     
   }
               $living_county_tax[$data_employee]=$t_tx;
            }
               $i++;
           }  
       }
                }
       }
   }
   }


}
//Working county starts
$working_county_tax_range='';
       $working_county_tax='';
    $working_county_tax=array();
    $working_county_sum=array();
  if(!empty($data['employee_data'][0]['cty_tax']) && ($data['employee_data'][0]['cty_tax'] !=='Not Applicable') ) {
$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['employee_data'][0]['cty_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();
  $tax_split=explode(',',$state[0]['tax']);
   // print_r($state);
    $local_tax_range='';
          
      
   foreach($tax_split as $tax){
       $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
    foreach($tax as $tx){

      // echo "<br/>";
      // echo "state"   .$tx['tax'];
      // echo "<br/>";   
              $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
      if($split[0]!='' && $split[1]!=''){
               if($final > $split[0] && $final < $split[1]){
          $local_tax_range=$split[0]."-".$split[1];
         $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
           if(!empty( $data['localtax'])){
               $i=0;
                foreach( $data['localtax'] as $lt){
        $local_tax_employee=$lt['employee'];
        $local_tax_employer=$lt['employer'];
            $local_tax_ee=($local_tax_employee/100)*$final;
        // echo "LOCAL_TAX_EMPLOYEE :".$local_tax_employee;
        // echo "<br/>";
              $local_tax_er=($local_tax_employer/100)*$final;
$row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
           
$data_employee="'employee_".$tx['tax']."'";
             $search_tax=explode('-',$tx['tax']);
        //  print_r($search_tax);
              $t_tx='';
          if($row==1){
            $ar = $this->db->select('amount')->from('tax_history')->where('tax_type','working_county_tax')->where('tax',$search_tax[1])->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])->get()->row()->amount;
//echo $this->db->last_query();
            if($ar){
       $t_tx=$ar;
      
   }else{
           $t_tx=0;
            
        }
   $query = $this->db->select("*")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                   ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get();
                    // echo $this->db->last_query();
   if($query->num_rows() >= 1){
     $query = $this->db->select_sum("amount")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                      ->where("tax_type","working_county_tax")
                       ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get()->row()->amount;
                     // echo $this->db->last_query();
                     $amt = $query;
     $working_county_sum[$search_tax[1]]=$amt;
   
   }else{
         $working_county_sum[$search_tax[1]]=$local_tax_ee;
     
   }
               $working_county_tax[$data_employee]=$t_tx;
            }
               $i++;
           }  
       }
                }
       }
   }
   }


}

//Working county starts
$living_local_tax_range='';
       $living_local_tax='';
    $living_local_tax=array();
    $living_local_sum=array();
  if(!empty($data['employee_data'][0]['living_local_tax']) && ($data['employee_data'][0]['living_local_tax'] !=='Not Applicable') ) {
$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['employee_data'][0]['living_local_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();
  $tax_split=explode(',',$state[0]['tax']);
   // print_r($state);
    $local_tax_range='';
          
      
   foreach($tax_split as $tax){
       $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
    foreach($tax as $tx){

    //   echo "<br/>";
    //   echo "state"   .$tx['tax'];
    //   echo "<br/>";   
              $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
      if($split[0]!='' && $split[1]!=''){
               if($final > $split[0] && $final < $split[1]){
          $local_tax_range=$split[0]."-".$split[1];
         $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
           if(!empty( $data['localtax'])){
               $i=0;
                foreach( $data['localtax'] as $lt){
        $local_tax_employee=$lt['employee'];
        $local_tax_employer=$lt['employer'];
            $local_tax_ee=($local_tax_employee/100)*$final;
        
              $local_tax_er=($local_tax_employer/100)*$final;
$row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
           
$data_employee="'employee_".$tx['tax']."'";
             $search_tax=explode('-',$tx['tax']);
              $t_tx='';
          if($row==1){
            $ar = $this->db->select('amount')->from('tax_history')->where('tax_type','living_local_tax')->where('tax',$search_tax[1])->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])->get()->row()->amount;

            if($ar){
       $t_tx=$ar;
      
   }else{
           $t_tx=0;
            
        }
   $query = $this->db->select("*")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                   ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get();
                    // echo $this->db->last_query();
   if($query->num_rows() >= 1){
     $query = $this->db->select_sum("amount")
                     ->from("tax_history")
                     ->where("employee_id",$data['employee_data'][0]['id'])
                     ->where("tax",$search_tax[1])
                      ->where("tax_type","living_local_tax")
                       ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
                   ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)

                     ->get()->row()->amount;
                     // echo $this->db->last_query();
                     $amt = $query;
     $living_local_sum[$search_tax[1]]=$amt;
   
   }else{
         $living_local_sum[$search_tax[1]]=$local_tax_ee;
     
   }
               $living_local_tax[$data_employee]=$t_tx;
            }
               $i++;
           }  
       }
                }
       }
   }
   }


}


           $ads_id = $data['timesheet_data'][0]['admin_name'];
           $adminis_data = $this->Hrm_model->administrator_info($ads_id);
            $payslip_design=$this->db->select('*')->from('payslip_invoice_design')->where('user_id',$this->session->userdata('user_id'))->get()->result_array();
            $currency_details = $CI->Web_settings->retrieve_setting_editdata();
            $name =$data['employee_data'][0]['first_name'].' '.$data['employee_data'][0]['last_name'];
            $get_officeloan_data=$this->db->select('*')->from('person_ledger')->where('create_by',$this->session->userdata('user_id'))->where('person_id',$name)->where('status',0)->get()->result_array();
 

$payrolltaxinfo = $this->db->select('weekly')
    ->from('tax_history')
    ->where('created_by', $this->session->userdata('user_id'))
    ->where('time_sheet_id', $data['timesheet_data'][0]['timesheet_id'])
    ->where('weekly IS NOT NULL')
      ->get()
    ->result_array();
// echo $this->db->last_query(); 



$payrolltaxinfo1 = $this->db->select('biweekly')
    ->from('tax_history')
    ->where('created_by', $this->session->userdata('user_id'))
    ->where('time_sheet_id', $data['timesheet_data'][0]['timesheet_id'])
    ->where('biweekly IS NOT NULL')
     ->get()
    ->result_array();


$payrolltaxinfo2 = $this->db->select('monthly')
    ->from('tax_history')
    ->where('created_by', $this->session->userdata('user_id'))
    ->where('time_sheet_id', $data['timesheet_data'][0]['timesheet_id'])
     ->where('monthly IS NOT NULL')
     ->get()
    ->result_array();


 


        $ytdtotals = $this->db->select(['SUM(biweekly) AS OVbiweekly','SUM(weekly) AS OVweekly','SUM(monthly) AS OVmonthly' ,'SUM(amount) AS OVhourly' ])   
        ->from('tax_history')
        ->where('created_by', $this->session->userdata('user_id'))
        ->where("employee_id", $data['employee_data'][0]['id'])
          ->where('tax_type','state_tax')
           ->where('tax','Income tax')
        ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
        ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE)
        ->get()
        ->result_array();
  // echo $this->db->last_query();die();
$extrahours = $this->db->select('*')
            ->from('working_time')
            ->where('created_by', $this->session->userdata('user_id'))
             ->get()
            ->result_array();

            $incometax=$this->db->select('amount')
            ->from('tax_history')
            ->where('created_by',$this->session->userdata('user_id'))
            ->where('time_sheet_id',$data['timesheet_data'][0]['timesheet_id']) 
            ->where('tax_type','state_tax')
            ->where('tax', 'Income tax')
            ->get()
            ->result_array();
      

              // Over Time 

            $overtime_info = $this->db->select('*')
            ->from('timesheet_info')
            ->where('create_by', $this->session->userdata('user_id'))        
            ->where('timesheet_id',$data['timesheet_data'][0]['timesheet_id']) 
            ->get()
            ->result_array();


            
             $timesheet_id =$data['timesheet_data'][0]['timesheet_id'];
             $payperiod =$data['timesheet_data'][0]['month'];
             $data['sc']=$this->Hrm_model->sc_info_count($templ_name,$payperiod);
             $scValue =  $data['sc']['sc'][0]['sc']; // Accessing 'sc=12'
             $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
             $sc_count = $data['sc']['count'];
             $scValue = $scValue / 100;

// Calculate the percentage of $sc_totalAmount1 based on $scValue
$scValueAmount1 = $scValue * $sc_totalAmount1;
$merged_tax = array_merge($local_tax, $selected_local_tax, $selected_state_tax,$other_tax);
$merged_sum = array_merge($local_sum, $selected_local_sum, $selected_state_sum,$other_tax_sum);


$data=array(
    'sc'=> $scValueAmount1,
    'no_of_inv' =>$sc[0]['no_of_inv'],
     'sales_c_amount' =>$sc[0]['sales_c_amount'],
               'currency'  =>$currency_details[0]['currency'],
               'color'=> $dataw[0]['color'],         
               'selected_local_tax'=>$selected_local_tax,
               'selected_state_tax' => $selected_state_tax ,
               'working_county_tax'=>$working_county_tax,
                'other_working_tax' =>$other_working_tax,
                'living_local_tax'=>$living_local_tax,
                'living_county_tax'=>$living_county_tax,
               'selected_living_state_tax' =>$local_tax,
               'other_tax' => $other_tax,
                'selected_living_state_sum'=>$local_sum,
                'other_working_sum' => $other_working_sum,
               'selected_local_sum'=>$selected_local_sum,
               'selected_state_sum'=>$selected_state_sum,
                'working_county_sum'=>$working_county_sum,
                'living_local_sum'=>$living_local_sum,
                'living_county_sum'=>$living_county_sum,
                'other_tax_sum' =>$other_tax_sum,  
             //  's_tax'=>($data['timesheet_data'][0]['payroll_type'] !== 'Sales Partner') ? $s_tax : 0,
              //  'm_tax'=>($data['timesheet_data'][0]['payroll_type'] !== 'Sales Partner') ? $m_tax : 0,
              //  'u_tax'=>($data['timesheet_data'][0]['payroll_type'] !== 'Sales Partner') ? $u_tax : 0,
              //  'f_tax'=>($data['timesheet_data'][0]['payroll_type'] !== 'Sales Partner') ? $f_tax : 0,
              //  's'=>($data['timesheet_data'][0]['payroll_type'] !== 'Sales Partner') ? $s : 0,
              //  'f'=>($data['timesheet_data'][0]['payroll_type'] !== 'Sales Partner') ? $f : 0,
              //  'u'=>($data['timesheet_data'][0]['payroll_type'] !== 'Sales Partner') ? $u : 0,
              //  'm'=>($data['timesheet_data'][0]['payroll_type'] !== 'Sales Partner') ? $m : 0,
              's_tax'=>  $s_tax  ,
              'm_tax'=> $m_tax ,
              'u_tax'=> $u_tax ,
              'f_tax'=> $f_tax ,
              's'=>  $s,
              'f'=>  $f,
              'u'=> $u,
              'm'=>  $m,
                'sum'=>$merged_sum,
           'designation' =>$timesheetdata[0]['job_title'],
           'company'=> $datacontent,
           'template' =>$payslip_design[0]['template'],
               'business_name'=>(!empty($datacontent[0]['company_name'])?$datacontent[0]['company_name']:$company_info[0]['company_name']),  
               'phone'=>(!empty($datacontent[0]['mobile'])?$datacontent[0]['mobile']:$company_info[0]['mobile']),  
               'email'=>(!empty($datacontent[0]['email'])?$datacontent[0]['email']:$company_info[0]['email']),  
               'address'=>(!empty($datacontent[0]['address'])?$datacontent[0]['address']:$company_info[0]['address']),
           'logo'=>base_url().$company_info[0]['logo'],  
           'infotime' =>  $timesheetdata,
           'infoemployee' =>  $employeedata,
           'total' => $final,
           'adm_name'  => $adminis_data,
           'adminis_data'=> $adminis_data,
           'totalpayments'=>      $get_officeloan_data[0]['noofpayterms'],
           'count_paid'  =>       $get_officeloan_data[0]['payterms'],
           't_amount'  =>       $get_officeloan_data[0]['debit'],
           'o_s_a'  =>       $get_officeloan_data[0]['out_standing'],
           'o_s_l'  =>       $get_officeloan_data[0]['o_s_l'],
          
           'hourly'    =>       $incometax[0]['amount'],    
        
        
            'weekly'     =>       $payrolltaxinfo[0]['weekly']     ,
            'biweekly'   =>       $payrolltaxinfo1[0]['biweekly'], 
            'monthly'    =>       $payrolltaxinfo2[0]['monthly'], 
             //ajith
           
            'OVhourly'    =>         $ytdtotals[0]['OVhourly'], 
            'OVweekly'    =>         $ytdtotals[0]['OVweekly'], 
            'OVbiweekly'  =>         $ytdtotals[0]['OVbiweekly'], 
            'OVmonthly'   =>         $ytdtotals[0]['OVmonthly'], 

            'data_work_hour'   =>         $extrahours[0]['work_hour'],
            'extra_workamount'   =>  $extrahours[0]['extra_workamount'], 
              'hrate' =>$hrate,
            
            'extra_hour'   =>  $overtime_info[0]['extra_hour'], 
            'extra_rate'   =>  $overtime_info[0]['extra_rate'], 
            'extra_thisrate'   =>  $overtime_info[0]['extra_thisrate'], 
            'extra_this_hour'   =>  $overtime_info[0]['extra_this_hour'], 
            'extra_ytd'   =>  $overtime_info[0]['extra_ytd'], 


            'above_extra_beforehours'   =>  $overtime_info[0]['above_extra_beforehours'], 
            'above_extra_rate'   =>  $overtime_info[0]['above_extra_rate'], 
            'above_extra_sum'   =>  $overtime_info[0]['above_extra_sum'], 
            'above_this_hours'   =>  $overtime_info[0]['above_this_hours'], 
            'above_extra_ytd'   =>  $overtime_info[0]['above_extra_ytd'], 


                            

       );
//  print_r($selected_living_state_tax);  
 
                $empid = $employeedata[0]['id'];
$user_id = $this->session->userdata('user_id'); // Assuming session value is available

$this->db->select('*');
$this->db->from('timesheet_info');
$this->db->join('info_payslip', 'timesheet_info.timesheet_id = info_payslip.timesheet_id');
$this->db->where('info_payslip.templ_name', $empid);
$this->db->where('info_payslip.create_by', $user_id);

$this->db->where('timesheet_info.month <=', date('Y-m-d'));

$this->db->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE);



$query = $this->db->get();

$info_datapay = $this->Hrm_model->get_data_pay($d1,$empid,$timesheetdata[0]['timesheet_id']);
$sc_info_datapay = $this->Hrm_model->sc_get_data_pay($d1,$empid,$timesheetdata[0]['timesheet_id']);
           if ($query->num_rows() >1) {
          //  echo "IF ";
           $info_datapay = $this->Hrm_model->get_data_pay($d1,$empid,$timesheetdata[0]['timesheet_id']);
          // print_r( $info_datapay[0]['t_hours']); die();
        //  print_r($info_datapay);

      $data['overalltotalhours']=$info_datapay[0]['t_hours'];


      $data['extra_eth']=$info_datapay[0]['eth'];
      $data['extra_ytdeth']=$info_datapay[0]['ytdeth'];

      $data['above_eth']=$info_datapay[0]['above_eth'];
     
      $data['ytdeth']=$info_datapay[0]['ytdeth'];

    //   $data['above_ytdeth']=$info_datapay[0]['above_ytdeth'];

   
     $data['above_ytdeth']=$info_datapay[0]['above_ytdeth'] + $info_datapay[0]['sc'];

      $data['sum_above']=$info_datapay[0]['ytdeth']+$info_datapay[0]['above_ytdeth'];
      


      // above_ytdeth
      // above_eth
      $data['aboveytd'] = $info_datapay[0]['extra_thisrate']+  $info_datapay[0]['above_extra_sum'];
           $data['overalltotalamount']=$info_datapay[0]['t_amount']+$info_datapay[0]['sc'];
           $data['t_s_tax']=$info_datapay[0]['t_s_tax'];
             $data['t_m_tax']=$info_datapay[0]['t_m_tax'];
               $data['t_f_tax']=$info_datapay[0]['t_f_tax'];
                 $data['t_u_tax']=$info_datapay[0]['t_u_tax'];
                                // echo "1 : s_tax :".$info_datapay[0]['t_s_tax']."<br/>"."m_tax :".$info_datapay[0]['t_m_tax']."<br/>"."f_tax :".$info_datapay[0]['t_f_tax']."<br/>"."u_tax :".$info_datapay[0]['t_u_tax']."<br/>";
              }else{
                // echo "ELSE ";
                // print_r($info_datapay);
                  $data['overalltotalhours']=$timesheetdata[0]['total_hours'];

                  $data['extra_eth']=$info_datapay[0]['eth'];
                  $data['extra_ytdeth']=$info_datapay[0]['ytdeth'];
                  $data['above_eth']=$info_datapay[0]['above_eth'];
                 $data['above_ytdeth']=$info_datapay[0]['above_ytdeth'] + $info_datapay[0]['sc'];
                  $data['aboveytd'] = $info_datapay[0]['extra_thisrate'];
            
         
         if($info_datapay[0]['payroll_type'] == 'Sales Partner'){
                   $data['overalltotalamount']= $sc_info_datapay[0]['S_sales_c_amount'];
                   $data['t_s_tax']=     $sc_info_datapay[0]['s_s_tax'];
                   $data['t_m_tax']=     $sc_info_datapay[0]['s_m_tax'];
                   $data['t_f_tax']=     $sc_info_datapay[0]['s_f_tax'];
                   $data['t_u_tax']=     $sc_info_datapay[0]['s_u_tax'];
                   } else{
                    $data['overalltotalamount']=$final;
                    $data['t_s_tax']=$s_tax;
                    $data['t_m_tax']=$m_tax;
                    $data['t_f_tax']=$f_tax;
                    $data['t_u_tax']=$u_tax;
                   }
         
         
         
         
         
         
         
         
         
         
              }

$t_data = $this->Hrm_model-> timesheet_info_data($timesheet_id);
// print_r($t_data);
 //echo  $t_data[0]['payroll_type'];
            if ($t_data[0]['payroll_type'] =='Sales Partner'){
$data['partner_total'] = $t_data[0]['extra_thisrate'];
$this->db->select('*');
$this->db->from('timesheet_info');
$this->db->where('timesheet_info.month <=', date('Y-m-d'));
$this->db->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE);
$this->db->where('payroll_type','Sales Partner');
$this->db->where('templ_name',$templ_name);

$query = $this->db->get();
//echo $this->db->last_query();
   if ($query->num_rows() >=1) {
$partner = $this->Hrm_model->get_data_pay_partner($d1,$empid,$timesheetdata[0]['timesheet_id']);
  $data['partner']=$partner[0]['amount'];
 $data['jt']=$partner[0]['job_title'];
// echo $data['partner'];
   }
 //print_r($data);echo $infotime[0]['job_title'];
         }
 if ($t_data[0]['payroll_type'] =='SalesCommission'){
$data['partner_total'] = $t_data[0]['extra_thisrate'];
$this->db->select('*');
$this->db->from('timesheet_info');
$this->db->where('timesheet_info.month <=', date('Y-m-d'));
$this->db->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE);
$this->db->where('payroll_type','SalesCommission');
$this->db->where('templ_name',$templ_name);

$query = $this->db->get();
//echo $this->db->last_query();
   if ($query->num_rows() >=1) {
        $payperiod =$data['timesheet_data'][0]['month'];
                    $get_date = explode('-', $payperiod);
         $d1 = $get_date[1];
         
$partner = $this->Hrm_model->get_data_pay_SalesCommission($d1,$empid,$timesheetdata[0]['timesheet_id']);
  $data['comm']=$partner[0]['amount'];
 $data['jt_comm']=$partner[0]['job_title'];
// echo $data['comm'];
   }
 //print_r($data);echo $infotime[0]['job_title'];
         }
if($payslip_design[0]['template']==3){
       $content = $this->parser->parse('hr/pay_slip2', $data, true);
 
      $this->template->full_admin_html_view($content);
 }else{

       $content = $this->parser->parse('hr/pay_slip', $data, true);
 
      $this->template->full_admin_html_view($content);

 }
        }
     

 
     
     






        public function check_employee_pay_type(){
          $CI = &get_instance();
           $CI->load->model('Hrm_model');
               $employeeId = $this->input->post('employeeId');
         $pay_type = $CI->db->select('payroll_type')->from('employee_history')->where('id', $employeeId)->get()->row()->payroll_type;
        if(empty($pay_type)){
          $pay_type='Sales Partner';
        }else{
         echo $pay_type;
        }
       }

     
     
public function updatepayslipinvoicedesign($id)
   {
     $query='update payslip_invoice_design set template='.$id;
     $this->db->query($query);
     redirect('Chrm/payslip_setting');
}

public function add_taxname_data(){
        $this->load->model('Hrm_model');
        $postData = $this->input->post('value');
        $data = $this->Hrm_model->insert_taxesname($postData);
       // echo json_encode($data);
    }

public function payslip_setting() {
        $data['title'] = display('payslip');
        $CI = & get_instance();
        $CD = & get_instance();
        $CI->load->model('invoice_design');
        $CD->load->model('Companies');
        $CI->load->model('Web_settings');
        $CI->load->model('invoice_content');
       $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
       $dataw = $CI->invoice_design->get_data_payslip();
       $datac = $CD->Companies->company_details();
           $datacontent = $CI->invoice_content->retrieve_data();
       $data= array(
            'header'=> (!empty($dataw[0]['header']) ? $dataw[0]['header'] : '') ,
        'logo'=> (!empty($dataw[0]['logo']) ? $dataw[0]['logo'] : '') ,
        'color'=> (!empty($dataw[0]['color']) ? $dataw[0]['color'] : '') ,
        'invoice_logo' =>(!empty($setting_detail[0]['invoice_logo']) ? $setting_detail[0]['invoice_logo'] : '') ,
        'address'=>(!empty($datacontent[0]['address']) ? $datacontent[0]['address'] : '') ,
        'cname'=>(!empty($datacontent[0]['business_name']) ? $datacontent[0]['business_name'] : '') ,
        'mobile'=>(!empty($datacontent[0]['phone']) ? $datacontent[0]['phone'] : '') ,
        'email'=>(!empty($datacontent[0]['email']) ? $datacontent[0]['email'] : '') ,
        // 'reg_number'=>(!empty($datacontent[0]['reg_number']) ? $datacontent[0]['reg_number'] : '') ,
        // 'website'=>(!empty($datacontent[0]['website']) ? $datacontent[0]['website'] : '') ,
        // 'address'=>(!empty($datacontent[0]['address']) ? $datacontent[0]['address'] : '') ,
        'template'=> (!empty($dataw[0]['template']) ? $dataw[0]['template'] : '')
   );
    // print_r($data);
        $content = $this->parser->parse('hr/payslip_view', $data, true);
        $this->template->full_admin_html_view($content);
        }














    public function employee_payslip_permission($id) {
        $this->load->model('Hrm_model');
         $CI = & get_instance();
         $CI->load->model('Web_settings');
       $data['title']            = display('Payment_Administration');
       $data['time_sheet_data'] = $this->Hrm_model->time_sheet_data($id);
       $data['employee_name'] = $this->Hrm_model->employee_name($data['time_sheet_data'][0]['templ_name']);

       $data['designation'] = $this->db->select('designation')->from('employee_history')->where('id',$data['employee_name'][0]['id'])->get()->row()->designation;
        //if(empty($data['employee_name'])){
 $data['employee'] = $this->Hrm_model->employee_partner($data['time_sheet_data'][0]['templ_name']);

    //  }
       $data['payment_terms'] = $this->Hrm_model->get_payment_terms();
       $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
       $data['dailybreak'] = $this->Hrm_model->get_dailybreak();  
       $data['duration'] = $this->Hrm_model->get_duration_data();
       $data['setting_detail'] =$setting_detail;
       $data['administrator'] = $this->Hrm_model->administrator_data();
       
       $data['extratime_info'] = $this->Hrm_model->get_overtime_data();

       

      // print_r($data['employee']); die();
   
         $content                  = $this->parser->parse('hr/emp_payslip_permission', $data, true);
         $this->template->full_admin_html_view($content);
        }
    




public function officeloan_edit($transaction_id) {
            $this->load->model('Hrm_model');
            $CI = & get_instance();
            $CI->load->model('Web_settings');
            $CI->load->model('Invoices');
           $CI->load->model('Settings');

           $office_loan_datas = $this->Hrm_model->office_loan_datas($transaction_id);
           $setting_detail = $CI->Web_settings->retrieve_setting_editdata();

         

           $bank_name = $CI->db->select('bank_id,bank_name')
           ->from('bank_add')
           ->get()
           ->result_array();
           $data['bank_list']   =  $CI->Web_settings->bank_list();
            
           
           $paytype=$CI->Invoices->payment_type();
           $CI = & get_instance();
           $CI->load->model('Web_settings');
 $selected_bank_name = $this->db->select('bank_name')->from('bank_add')->where('bank_id',$office_loan_datas[0]['bank_name'])->get()->row()->bank_name;

        
           $data['payment_typ']  =$paytype;
           $data['bank_name']  =$bank_name;
          
        //    print_r( $data['bank_name']);
        $person_listdaa =  $CI->Settings->office_loan_person();

           $data=array(
            'id' =>$office_loan_datas[0]['id'],
            'person_id' =>$office_loan_datas[0]['person_id'],
            'date'  =>$office_loan_datas[0]['date'],
            'debit' => $office_loan_datas[0]['debit'],
            'details' => $office_loan_datas[0]['details'],
            'phone' => $office_loan_datas[0]['phone'],
           'paytype' => $office_loan_datas[0]['paytype'],
           'bank_name1' => $office_loan_datas[0]['bank_name'],
             'selected_bank_name' =>$selected_bank_name,
           'transaction_id' => $office_loan_datas[0]['transaction_id'],
           'person_list' =>$person_listdaa ,
           'status'  =>$office_loan_datas[0]['status'],
           'description'  =>$office_loan_datas[0]['description'],
           'bank_name' =>$bank_name,
           'payment_typ' =>$paytype,

           'tran_id' =>$transaction_id,

           'setting_detail' =>$setting_detail,

           

           );

 
             $content                  = $this->parser->parse('hr/edit_officeloan', $data, true);
             $this->template->full_admin_html_view($content);
            }



// Delete Expense
    public function delete_expense($id = null)
    {
        // echo $id; .;
        $this->db->where('id', $id);
        $this->db->delete('expense');
        redirect('Chrm/expense_list');
        $this->template->full_admin_html_view($content);
    }
    // Edit Expense Data
    public function edit_expense($id)
    {
       $this->load->library('lsettings');
       $content = $this->lsettings->expense_show_by_id($id);
       $this->template->full_admin_html_view($content);
    }











    // Pdf Download Expenses
    public function expense_download($id)
    {
        $CI = & get_instance();
        $CC = & get_instance();
        $CA = & get_instance();
        $CI->load->model('Web_settings');
        $CI->load->model('Hrm_model');
        $CA->load->model('invoice_design');
        $CC->load->model('invoice_content');
        $CI->load->model('invoice_content');
        $w = & get_instance();
        $w->load->model('Ppurchases');
        $company_info = $w->Ppurchases->retrieve_company();
        $expense_pdf = $CI->Hrm_model->pdf_expense($id);
          //print_r($expense_pdf);.;
        $setting=  $CI->Web_settings->retrieve_setting_editdata();
        $dataw = $CA->invoice_design->retrieve_data();
        // print_r($dataw); .;
        // $datacontent = $CC->invoice_content->retrieve_data();
        $datacontent = $CI->invoice_content->retrieve_info_data();

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $curn_info_default = $CI->db->select('*')->from('currency_tbl')->where('icon',$currency_details[0]['currency'])->get()->result_array();
        $data=array(
            'curn_info_default' =>$curn_info_default[0]['currency_name'],
            'currency'  =>$currency_details[0]['currency'],
            'header'=> $dataw[0]['header'],
            'logo'=>(!empty($setting[0]['invoice_logo'])?$setting[0]['invoice_logo']:$company_info[0]['logo']),  
            'color'=> $dataw[0]['color'],
            'template'=> $dataw[0]['template'],
            'company'=> $datacontent,
            'expense_pdf' => $expense_pdf,

            
          'company'=>(!empty($datacontent[0]['company_name'])?$datacontent[0]['company_name']:$company_info[0]['company_name']),   
          'phone'=>(!empty($datacontent[0]['mobile'])?$datacontent[0]['mobile']:$company_info[0]['mobile']),   
          'email'=>(!empty($datacontent[0]['email'])?$datacontent[0]['email']:$company_info[0]['email']),   
          // 'reg_number'=>(!empty($datacontent[0]['reg_number'])?$datacontent[0]['reg_number']:$company_info[0]['reg_number']),  
          'website'=>(!empty($datacontent[0]['website'])?$datacontent[0]['website']:$company_info[0]['website']),   
          'address'=>(!empty($datacontent[0]['address'])?$datacontent[0]['address']:$company_info[0]['address'])
        );
        print_r($dataw[0]['color']);

        $content = $this->load->view('hr/expense_html_pdf', $data, true);
        $this->template->full_admin_html_view($content);
    }













    public function update_expense($id)
    {
       $this->load->library('lsettings');
       $content = $this->lsettings->update_expense_id($id);
       $this->template->full_admin_html_view($content);
        redirect('Chrm/expense_list');
    }
   // Expense Insert data
    public function create_expense()
    {
        $this->form_validation->set_rules('expense_name',display('expense_name'),'required|max_length[100]');
        $this->form_validation->set_rules('expense_date',display('expense_date'),'required|max_length[100]');
        $this->form_validation->set_rules('expense_payment_date',display('expense_payment_date'),'required|max_length[100]');
         $postData = [
             'emp_name'  =>  $this->input->post('person_id',true),
            'expense_name'    => $this->input->post('expense_name',true),
            'expense_date'     => $this->input->post('expense_date',true),
            'expense_amount'   => $this->input->post('expense_amount',true),
            'total_amount'         => $this->input->post('total_amount',true),
            'expense_payment_date'     => $this->input->post('expense_payment_date',true),
            'description'         => $this->input->post('description',true),
           'unique_id'  =>$this->session->userdata('unique_id'),
            'create_by' => $this->session->userdata('user_id')

            
        ];
        $this->db->insert('expense',$postData);
     //   echo $this->db->last_query(); .;
        redirect(base_url('Chrm/expense_list'));
    }




            public function office_loan_inserthtml($transaction_id) {
                $CC = & get_instance();
                $CA = & get_instance();
                $CI = & get_instance();
                $CI->auth->check_admin_auth();
      
                $CI->load->model('invoice_content');
                $w = & get_instance();
                $w->load->model('Ppurchases');
                $CI->load->model('Invoices');
                $CI->load->model('Web_settings');
                $CA->load->model('invoice_design');
                $CC->load->model('invoice_content');
                $this->load->model('Hrm_model');


                $company_info = $w->Ppurchases->retrieve_company();



                 $office_loan_datas = $this->Hrm_model->office_loan_datas($transaction_id);
                 $datacontent = $CC->invoice_content->retrieve_data();
                 $dataw = $CA->invoice_design->retrieve_data();
                 $setting=  $CI->Web_settings->retrieve_setting_editdata();

                 $data=array(
                //     'curn_info_default' =>$curn_info_default[0]['currency_name'],
                //     'currency'  =>$currency_details[0]['currency'],
                    'header'=> $dataw[0]['header'],
                    'logo'=>(!empty($setting[0]['invoice_logo'])?$setting[0]['invoice_logo']:$company_info[0]['logo']),  
                    'color'=> $dataw[0]['color'],
                    'template'=> $dataw[0]['template'],

                   'person_id'      => $office_loan_datas[0]['person_id'],
                    'date'     => $office_loan_datas[0]['date'],
                    'debit'   => $office_loan_datas[0]['debit'],
                    'details'   => $office_loan_datas[0]['details'],
                    'phone'   => $office_loan_datas[0]['phone'],
                    'paytype'   => $office_loan_datas[0]['paytype'],
                    'paytype'   => $office_loan_datas[0]['paytype'],
                    'paytype'   => $office_loan_datas[0]['paytype'],

                    'company'=> $datacontent,


                    'company'=>(!empty($datacontent[0]['company_name'])?$datacontent[0]['company_name']:$company_info[0]['company_name']),   
                    'phone'=>(!empty($datacontent[0]['mobile'])?$datacontent[0]['mobile']:$company_info[0]['mobile']),   
                    'email'=>(!empty($datacontent[0]['email'])?$datacontent[0]['email']:$company_info[0]['email']),   
                    // 'reg_number'=>(!empty($datacontent[0]['reg_number'])?$datacontent[0]['reg_number']:$company_info[0]['reg_number']),  
                    'website'=>(!empty($datacontent[0]['website'])?$datacontent[0]['website']:$company_info[0]['website']),   
                    'address'=>(!empty($datacontent[0]['address'])?$datacontent[0]['address']:$company_info[0]['address']),


                    'office_loan_datas' => $office_loan_datas
                );

            //    print_r($office_loan_datas); .;

                print_r($dataw[0]['color']);

                $content = $this->load->view('hr/office_loan_html', $data, true);
                $this->template->full_admin_html_view($content);
                }







                public function time_sheet_pdf($id) {
                  $CI = & get_instance();
                      $CC = & get_instance();
                      $CA = & get_instance();
           
                      $w = & get_instance();
                      $w->load->model('Ppurchases');
                    //  $CI->load->model('Invoices');
                      $CI->load->model('Web_settings');
                      $CA->load->model('invoice_design');
                      $CC->load->model('invoice_content');
                      $CI = & get_instance();
                      $this->auth->check_admin_auth();
                      $CI->load->model('Hrm_model');
                         $pdf = $CI->Hrm_model->time_sheet_data($id);
                         $company_info = $w->Ppurchases->retrieve_company();

                          $employee_data = $this->db->select('first_name,last_name,designation,id')->from('employee_history')->where('id',$pdf[0]['templ_name'])->get()->row();
                        //  print_r($employee_data);.;
                         $setting=  $CI->Web_settings->retrieve_setting_editdata();
                         $dataw = $CA->invoice_design->retrieve_data();
                         $datacontent = $CC->invoice_content->retrieve_data();
                         $data=array(
                       
                        
                          'header'=> $dataw[0]['header'],
                          'logo'=>(!empty($setting[0]['invoice_logo'])?$setting[0]['invoice_logo']:$company_info[0]['logo']),  
                          'color'=> $dataw[0]['color'],
                          'template'=> $dataw[0]['template'],
                           'company'=> $datacontent,
                          'employee_name' => $employee_data->first_name." ".$employee_data->last_name,
                          'destination'  => $employee_data->designation,
                           'id'  => $employee_data->id,
                          'company'=>(!empty($datacontent[0]['company_name'])?$datacontent[0]['company_name']:$company_info[0]['company_name']),   
                          'phone'=>(!empty($datacontent[0]['mobile'])?$datacontent[0]['mobile']:$company_info[0]['mobile']),   
                          'email'=>(!empty($datacontent[0]['email'])?$datacontent[0]['email']:$company_info[0]['email']),   
                          // 'reg_number'=>(!empty($datacontent[0]['reg_number'])?$datacontent[0]['reg_number']:$company_info[0]['reg_number']),  
                          'website'=>(!empty($datacontent[0]['website'])?$datacontent[0]['website']:$company_info[0]['website']),   
                          'address'=>(!empty($datacontent[0]['address'])?$datacontent[0]['address']:$company_info[0]['address']),
      
      
                          'time_sheet' =>$pdf
           
                           );
                           // print_r($data);
                           print_r($dataw[0]['color']);
           
                         $content = $this->load->view('hr/timesheet_pdf', $data, true);
                  $this->template->full_admin_html_view($content);   
           
           }






           public function timesheed_inserted_data($id) {
            //    echo $id; .;
               $CI = & get_instance();
               $CC = & get_instance();
               $CA = & get_instance();
    
               $w = & get_instance();
               $w->load->model('Ppurchases');
               $CI->load->model('Invoices');
               $CI->load->model('Web_settings');
               $CA->load->model('invoice_design');
               $CC->load->model('invoice_content');
               $CI = & get_instance();
               $this->auth->check_admin_auth();
               $CI->load->model('Hrm_model');
                  $timesheet_data = $CI->Hrm_model->timesheet_data($id);
                //   print_r($timesheet_data); .;
                  $setting=  $CI->Web_settings->retrieve_setting_editdata();
                  $dataw = $CA->invoice_design->retrieve_data();
                  $datacontent = $CC->invoice_content->retrieve_data();
                  $company_info = $w->Ppurchases->retrieve_company();

                  // $invoice_data_info = $CC->invoice_content->invoice_data_info();
    
                  
                  // print_r()
    
                   $data=array(
                   'curn_info_default' =>$curn_info_default[0]['currency_name'],
                   'currency'  =>$currency_details[0]['currency'],
                   'header'=> $dataw[0]['header'],
                   'logo'=>(!empty($setting[0]['invoice_logo'])?$setting[0]['invoice_logo']:$company_info[0]['logo']),  
                   'color'=> $dataw[0]['color'],
                   'template'=> $dataw[0]['template'],
                  'first_name'      => $timesheet_data[0]['first_name'],
                   'id'      => $timesheet_data[0]['id'],
                   'last_name'     => $timesheet_data[0]['last_name'],
                   'designation'   => $timesheet_data[0]['designation'],
                   'phone'            => $timesheet_data[0]['phone'],
                   'photo'   => $timesheet_data[0]['image'],
                   'rate_type' => $timesheet_data[0]['rate_type'],
                   'hrate' => $timesheet_data[0]['hrate'],
                   'email'=> $timesheet_data[0]['email'],
                   'blood_group'=> $timesheet_data[0]['blood_group'],
                   'social_security_number'=> $timesheet_data[0]['social_security_number'],
                   'routing_number'=> $timesheet_data[0]['routing_number'],
                   'address_line_1'=> $timesheet_data[0]['address_line_1'],
                   'address_line_2'=> $timesheet_data[0]['address_line_2'],
                   'country'=> $timesheet_data[0]['country'],
                   'city'=> $timesheet_data[0]['city'],
                   'zip'=> $timesheet_data[0]['zip'],
                   'files'=> $timesheet_data[0]['files'],
                   'company'=> $datacontent,
                   'invoice_data_info'=> $invoice_data_info,
    
                   'company'=>(!empty($datacontent[0]['company_name'])?$datacontent[0]['company_name']:$company_info[0]['company_name']),   
                   'com_phone'=>(!empty($datacontent[0]['mobile'])?$datacontent[0]['mobile']:$company_info[0]['mobile']),   
                   'com_email'=>(!empty($datacontent[0]['email'])?$datacontent[0]['email']:$company_info[0]['email']),   
                   // 'reg_number'=>(!empty($datacontent[0]['reg_number'])?$datacontent[0]['reg_number']:$company_info[0]['reg_number']),  
                   'website'=>(!empty($datacontent[0]['website'])?$datacontent[0]['website']:$company_info[0]['website']),   
                   'address'=>(!empty($datacontent[0]['address'])?$datacontent[0]['address']:$company_info[0]['address']),

    
               );
                // print_r($data);
                print_r($dataw[0]['color']);
                // $timesheet_data[0]['first_name']
           $content = $this->load->view('invoice/employe_timesheet_html', $data, true);
           $this->template->full_admin_html_view($content);
           }
    


                public function office_loan_delete($transaction_id){

                    $this->load->model('Hrm_model');
                    $this->Hrm_model->delete_off_loan($transaction_id);
                    $this->session->set_userdata(array('message' => display('successfully_delete')));
                   redirect("Chrm/manage_officeloan");
            
                }
            

                


  public function manage_timesheet() {

            $CI = & get_instance();

            $CI->load->model('Web_settings');
            $this->load->model('Hrm_model');

            $setting_detail = $CI->Web_settings->retrieve_setting_editdata();

            $data['setting_detail']            = $setting_detail;

             $data['title']            = display('manage_employee');
             $data['timesheet_list']    = $this->Hrm_model->timesheet_list();
             $data['timesheet_data_get']    = $this->Hrm_model->timesheet_data_get();


           
             $content                  = $this->parser->parse('hr/timesheet_list', $data, true);
            $this->template->full_admin_html_view($content);
            }








 
            public function manage_officeloan() {
                $this->load->model('Hrm_model');
                $CI = & get_instance();

                $CI->load->model('Web_settings');
     
                $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
     


                $data['title']            = display('manage_employee');

                 $data['office_loan_list']    = $this->Hrm_model->office_loan_list();
                 
                 $data['officeloan_data_get']    = $this->Hrm_model->officeloan_data_get();

 
                 $data['setting_detail']    = $setting_detail;


                 $content                  = $this->parser->parse('hr/officeloan_list', $data, true);
                $this->template->full_admin_html_view($content);
                }
        



    public function add_dailybreak_info(){
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Hrm_model');
        $postData = $this->input->post('dailybreak_name');
        // print_r($postData);
        $data = $this->Hrm_model->insert_dailybreak_data($postData);
        echo json_encode($data);
    }
    
    


public function timesheet_delete($id){
    $this->db->where('timesheet_id',$id);
     $this->db->delete('timesheet_info');
     $this->db->where('timesheet_id',$id);
     $this->db->delete('timesheet_info_details');
     $this->db->where('time_sheet_id',$id);
     $this->db->delete('tax_history');
     $this->db->where('timesheet_id',$id);
     $this->db->delete('info_payslip');
     $this->db->where('time_sheet_id',$id);
     $this->db->delete('tax_history_employer');
    $this->session->set_flashdata('message', "Deleted Successfully");
       redirect("Chrm/manage_timesheet");
}
















public function pay_slip() {
 //print_r($_POST);die();
       $CI = & get_instance();
       $CI->load->model('invoice_content');
       $w = & get_instance();
       $w->load->model('Ppurchases');
       $company_info = $w->Ppurchases->retrieve_company();
       $datacontent = $CI->invoice_content->retrieve_data();
       $this->load->model('Hrm_model');
       $data['title'] = display('pay_slip');
       $data['business_name']=(!empty($datacontent[0]['company_name'])?$datacontent[0]['company_name']:$company_info[0]['company_name']);
           $data['phone']=(!empty($datacontent[0]['mobile'])?$datacontent[0]['mobile']:$company_info[0]['mobile']);
           $data['email']=(!empty($datacontent[0]['email'])?$datacontent[0]['email']:$company_info[0]['email']);
           $data['address']=(!empty($datacontent[0]['address'])?$datacontent[0]['address']:$company_info[0]['address']);
        $data_timesheet['total_hours'] = $this->input->post('total_net');
        $data_timesheet['templ_name'] = $this->input->post('templ_name');
        $data_timesheet['payroll_type'] = $this->input->post('payroll_type');
        $data_timesheet['duration'] = $this->input->post('duration');
        $data_timesheet['job_title'] = $this->input->post('job_title');
        $data_timesheet['payment_term'] = $this->input->post('payment_term');
        $data_timesheet['month'] = $this->input->post('date_range');
        $date_split=explode(' - ',$this->input->post('date_range'));
        $data_timesheet['start'] =  $date_split[0];
        $data_timesheet['end'] =  $date_split[1];
        
 // Assuming $data_timesheet['start'] is set and contains a date in the format of 'd/m/Y'
$start_date = $data_timesheet['start'];
// Extract the month from the start date
$month = date('m', strtotime(str_replace('/', '-', $start_date)));
// Determine the quarter based on the month
if ($month >= 1 && $month <= 3) {
    $quarter = 'Q1';
} elseif ($month >= 4 && $month <= 6) {
    $quarter = 'Q2';
} elseif ($month >= 7 && $month <= 9) {
    $quarter = 'Q3';
} elseif ($month >= 10 && $month <= 12) {
    $quarter = 'Q4';
} else {
    // Handle unexpected case
    $quarter = 'Unknown';
}
// Assign the quarter to the appropriate field in your data array
$data_timesheet['quarter'] = $quarter;
// Now $data_timesheet includes the quarter based on the start date
         
       $data_timesheet['timesheet_id'] =  $this->input->post('tsheet_id');
       $data_timesheet['create_by'] =$this->session->userdata('user_id');
       $data_timesheet['admin_name'] = (!empty($this->input->post('administrator_person',TRUE))?$this->input->post('administrator_person',TRUE):'');
       $data_timesheet['payment_method'] =(!empty($this->input->post('payment_method',TRUE))?$this->input->post('payment_method',TRUE):'');
       $data_timesheet['cheque_no'] =(!empty($this->input->post('cheque_no',TRUE))?$this->input->post('cheque_no',TRUE):'');
       $data_timesheet['cheque_date'] =(!empty($this->input->post('cheque_date',TRUE))?$this->input->post('cheque_date',TRUE):'');
           $data_timesheet['bank_name'] =(!empty($this->input->post('bank_name',TRUE))?$this->input->post('bank_name',TRUE):'');
           $data_timesheet['payment_ref_no'] =(!empty($this->input->post('payment_refno',TRUE))?$this->input->post('payment_refno',TRUE):'');
       if(!empty($this->input->post('administrator_person',TRUE))){
            $data_timesheet['uneditable']=1;
       }else{
             $data_timesheet['uneditable']=0;
       }
       $u_id=$this->input->post('unique_id');
     //  if(empty($u_id)){
        $data_timesheet['unique_id']=$u_id;
     //  }
  $employee_detail = $this->db->where('id', $this->input->post('templ_name'));
  $q=$this->db->get('employee_history');
      //echo $this->db->last_query();
       $row = $q->row_array();
   if(!empty($row['id'])){
$data['selected_state_local_tax']=$row['state_local_tax'];
$data['selected_local_tax']=$row['local_tax'];
$data['selected_state_tax']=$row['state_tx'];
$data['templ_name']=$row['first_name']." ".$row['last_name'];
$data['job_title']=$row['designation'];
   }


          $present1 = $this->input->post('block');
        $date1 = $this->input->post('date');
       $day1 = $this->input->post('day');
       $time_start1 = $this->input->post('start');
       $time_end1 = $this->input->post('end');
       $hours_per_day1 = $this->input->post('sum');
        $daily_bk1=$this->input->post('dailybreak');
              $purchase_id_1 = $this->db->where('templ_name', $this->input->post('templ_name'))->where('timesheet_id',$data_timesheet['timesheet_id']);
       $q=$this->db->get('timesheet_info');
      //  echo $this->db->last_query();
       $row = $q->row_array();
 //    echo $row['timesheet_id'];
       $old_id=trim($row['timesheet_id']);
   if(!empty($old_id)){
       $this->session->set_userdata("timesheet_id_old",$row['timesheet_id']);
  $this->db->where('timesheet_id', $this->session->userdata("timesheet_id_old"));
 $this->db->delete('timesheet_info');

 //  echo $this->db->last_query();
       $this->db->where('timesheet_id', $this->session->userdata("timesheet_id_old"));
       $this->db->delete('timesheet_info_details');
//  echo $this->db->last_query();
      $this->db->insert('timesheet_info', $data_timesheet);

    // echo $this->db->last_query(); .;

  }
   else{
   $this->db->insert('timesheet_info', $data_timesheet);

//  echo $this->db->last_query();    .;

   }
   $purchase_id_2 = $this->db->select('timesheet_id')->from('timesheet_info')->where('templ_name',$this->input->post('templ_name'))->where('month', $this->input->post('date_range'))->get()->row()->timesheet_id;
 //  echo $this->db->last_query();
   $this->session->set_userdata("timesheet_id_new",$purchase_id_2);
   
    // echo $this->db->last_query();
    if(empty($date1)){
         $data1 = array(
             'timesheet_id' =>$this->session->userdata("timesheet_id_new")
    );
        $this->db->insert('timesheet_info_details', $data1); 
        // echo $this->db->last_query();  .;
    }else{
        for ($i = 0, $n = count($date1); $i < $n; $i++) {
        
        
          $present =  $present1[$i];

        
          $date = $date1[$i];
           $day = $day1[$i];
           $time_start = $time_start1[$i];
            $daily_bk = $daily_bk1[$i];
           $time_end = $time_end1[$i];
           $hours_per_day = $hours_per_day1[$i];
           $data1 = array(
             'timesheet_id' =>$this->session->userdata("timesheet_id_new"),
               
               'present'    => $present,

               'Date'    => $date,
               'Day'      => $day,
               'time_start'  => $time_start,
                'daily_break'  =>$daily_bk,
               'time_end'   =>  $time_end,
               'hours_per_day' => $hours_per_day,
               'created_by' => $this->session->userdata('user_id')
       );
          $this->db->insert('timesheet_info_details', $data1);
        //  echo $this->db->last_query();  .;




 //echo $this->db->last_query();
   // $content = $this->parser->parse('hr/pay_slip', $data, true);
   // $this->template->full_admin_html_view($content);
   }//.;
//   die();
    }//.;
       $data['employee_data'] = $this->Hrm_model->employee_info($this->input->post('templ_name'));
       $data['timesheet_data'] = $this->Hrm_model-> timesheet_info_data($this->session->userdata("timesheet_id_new"));
   
   
    
       $timesheetdata =$data['timesheet_data'];
       $employeedata  =$data['employee_data'];
       $hrate= $data['employee_data'][0]['hrate'];
       $total_hours=  $data['timesheet_data'][0]['total_hours'];
                     $payperiod =$data['timesheet_data'][0]['month'];
                    $get_date = explode('-', $payperiod);
         $d1 = $get_date[1];
      $data['sc']=$this->Hrm_model->sc_info_count($data['employee_data'][0]['id'],$payperiod);

      $scValue =  $data['sc']['sc'][0]['sc']; // Accessing 'sc=12'
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
       
$sc_count = $data['sc']['count'];
$scValue = $scValue / 100;
//echo "SC :". $scValueAmount1;
// Calculate the percentage of $sc_totalAmount1 based on $scValue
$scValueAmount1 = $scValue * $sc_totalAmount1;


if($data['timesheet_data'][0]['payroll_type']=='Hourly'){

if ($total_hours <= 40) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
} else {
  $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
  //////  echo "Else : ".$final;
}
}else if ($data['timesheet_data'][0]['payroll_type']=='Salaried-BiWeekly'){
if ($total_hours <= 14) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
} else {
  $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
  //////  echo "Else : ".$final;
}
}else if ($data['timesheet_data'][0]['payroll_type']=='Salaried-weekly'){
if ($total_hours <= 7) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
} else {
  $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
  //////  echo "Else : ".$final;
}
}else if ($data['timesheet_data'][0]['payroll_type']=='Salaried-Monthly'){
if ($total_hours <= 30) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
} else {
  $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
  //////  echo "Else : ".$final;
}
}else if ($data['timesheet_data'][0]['payroll_type']=='Salaried-BiMonthly'){
if ($total_hours <= 60) {
  $final = ($hrate * $total_hours) + $scValueAmount1;
  //echo "IF : ".$final;
} else {
  $final = $data['timesheet_data'][0]['extra_thisrate'] + $data['timesheet_data'][0]['above_extra_sum'];
  //////  echo "Else : ".$final;
}

}

//  $final=($hrate *$total_hours)+$scValueAmount1;
       // Federal Income Tax
          $s='';$u='';$m='';$f='';
    
    
          $federal_tax = $this->db->select('*')->from('federal_tax')->where('tax','Federal Income tax')->get()->result_array();
    
    
          // print_r($federal_tax); die();

          $federal_range='';
       $f_tax='';
       foreach($federal_tax as $amt){
          $split=explode('-',$amt[$data['employee_data'][0]['employee_tax']]);
           if($final > $split[0] && $final < $split[1]){
             $federal_range=$split[0]."-".$split[1];
           }
           }
       $data['federal'] = $this->Hrm_model->federal_tax_info($data['employee_data'][0]['employee_tax'],$final,$federal_range);
       if(!empty($data['federal'])){
       $Federal_employee= $data['federal'][0]['employee'];
        $f=($Federal_employee/100)*$final;
         $f= round($f, 2);
 
           $ar = $this->db->select('f_tax')->from('tax_history')->where('employee_id',$this->input->post('templ_name'))->get()->row()->f_tax;
            
           $f_tax=$ar+$f;

        
       }




       //Social Security
       $social_tax = $this->db->select('*')->from('federal_tax')->where('tax','Social Security')->get()->result_array();
  
      //  print_r($federal_tax); die();

       $social_range='';
       $s_tax='';
           $split=explode('-',$social_tax[0][$data['employee_data'][0]['employee_tax']]);
           if($final > $split[0] && $final < $split[1]){
           $social_range=$split[0]."-".$split[1];
           }
            // print_r($social_tax[0][$data['employee_data'][0]['employee_tax']]);  


       $data['social'] = $this->Hrm_model->social_tax_info($data['employee_data'][0]['employee_tax'],$final,$social_range);
       if(!empty($data['social'][0]['employee'])){
             $social_employee= $data['social'][0]['employee'];
             $s=($social_employee/100)*$final;
             $s= round($s, 2);
             $ar = $this->db->select('s_tax')->from('tax_history')->where('employee_id',$this->input->post('templ_name'))->get()->row()->s_tax;
             $s_tax=$ar+$s;     
           }


 

          //Medicare
       $Medicare = $this->db->select('*')->from('federal_tax')->where('tax','Medicare')->get()->result_array();
 
       $Medicare_range='';
       $m_tax='';
       foreach($Medicare as $social_amt){
          $split=explode('-',$social_amt[$data['employee_data'][0]['employee_tax']]);
           if($final > $split[0] && $final < $split[1]){
          $Medicare_range=$split[0]."-".$split[1];
           }
           }
       $data['Medicare'] = $this->Hrm_model->Medicare_tax_info($data['employee_data'][0]['employee_tax'],$final,$Medicare_range);
       if(!empty($data['Medicare'])){
       $Medicare_employee= $data['Medicare'][0]['employee'];
       $m=($Medicare_employee/100)*$final;
        $m= round($m, 2);
    $ar = $this->db->select('m_tax')->from('tax_history')->where('employee_id',$this->input->post('templ_name'))->get()->row()->m_tax;     
           $m_tax=$ar+$m;    
      }

       //  Workeddddddd
        $minValue = $final; // Example minimum value of your range
        $maxValue = $final; // Example maximum value of your range
$query = "SELECT `single`
        FROM `weekly_tax_info`
        WHERE `tax` = 'Weekly New Jersey-Income tax - NJ'
        AND CAST(SUBSTRING_INDEX(`single`, '-', 1) AS UNSIGNED) <= $maxValue
        AND CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(`single`, '-', -1), '-', 1) AS UNSIGNED) >= $minValue";

$result = $this->db->query($query);

if (!$result) {
    // Handle query execution error
    $error = $this->db->error();
    echo "Query execution error: " . $error['message'];
} else {
    $weekly_tax = $result->result_array();
    echo $this->db->last_query();
}
       


        // print_r($weekly_tax);  
      

        $weekly_range  = $weekly_tax[0]['single'];

        $split_values = explode('-', $weekly_range);
        $firstValue = $split_values[0];  
        $secondValue = $split_values[1];  
        $getvalue = $minValue - $firstValue;
      
        // print_r($getvalue);  

       $w_tax='';
       $data['weekly'] = $this->Hrm_model->weekly_tax_info($data['employee_data'][0]['employee_tax'],$final,$weekly_range);
      
       if(!empty($data['weekly'][0]['employee'])){
        $weekly_employee_details= $data['weekly'][0]['details'];
        $addamt = explode('$', $weekly_employee_details);
        $weekly_employee= $data['weekly'][0]['employee'];

        $wkly=($weekly_employee/100)*$getvalue;


        $wkly= round($wkly, 2);
        $weekly_tax= $addamt[1] + $wkly; 
      }

//echo $this->db->last_query();
      // print_r($getvalue);   die();

 
       //Federal unemployment
       $unemployment = $this->db->select('*')->from('federal_tax')->where('tax','Federal unemployment')->get()->result_array();
       $unemployment_range='';
       $u_tax='';
       foreach($unemployment as $social_amt){
          $split=explode('-',$social_amt[$data['employee_data'][0]['employee_tax']]);
           if($final > $split[0] && $final < $split[1]){
          $unemployment_range=$split[0]."-".$split[1];
           }
           }

       $data['unemployment'] = $this->Hrm_model->unemployment_tax_info($data['employee_data'][0]['employee_tax'],$final,$unemployment_range);
       if(!empty($data['unemployment'])){
       $unemployment_employee= $data['Medicare'][0]['employee'];
          $u=($unemployment_employee/100)*$final;
           $u= round($u, 2);
           $ar = $this->db->select('u_tax')->from('tax_history')->where('employee_id',$this->input->post('templ_name'))->get()->row()->u_tax;
           $u_tax=$ar+$u;
  
       }


 $state='';
if($data['selected_state_local_tax'] !=''){


$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['selected_state_local_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
print_r($state_tax);
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();
// print_r($state);  die();



       $tax_split=explode(',',$state[0]['tax']);
       $local_tax_range='';
       $local_tax='';
       $local_tax=array();


foreach($tax_split as $tax){
   $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
 
  //  echo $this->db->last_query();

foreach($tax as $tx){
          $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
        //   echo "<br/>";
        //   echo "--------". $final."/".$split[0]."/".$split[1];
        //      echo "<br/>";
       if($split[0]!='' && $split[1]!=''){
           
           if($final > $split[0] && $final < $split[1]){
              
      $local_tax_range=$split[0]."-".$split[1];
     $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
     
    //  print_r($data['localtax']);

     if(!empty( $data['localtax'])){
           $i=0;
            foreach( $data['localtax'] as $lt){
    $local_tax_employee=$lt['employee'];
    $local_tax_employer=$lt['employer'];
        $local_tax_ee=($local_tax_employee/100)*$final;
          $local_tax_er=($local_tax_employer/100)*$final;
   $row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
 
 
   

         $data_employee="'employee_".$tx['tax']."'";
         $search_tax=explode('-',$tx['tax']);
         if($row==1){
         $ar = $this->db->select('amount')->from('tax_history')->where('tax',$search_tax[1])->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])->get()->row()->amount;
   
         

  $t_tx=$local_tax_ee;
 $local_tax[$data_employee]=$t_tx;
        }
           $i++;
       }
   }



            }
   }
}
}


 
 

         $test2= $this->db->select('*')->from('info_payslip')->where('timesheet_id',$timesheetdata[0]['timesheet_id'])
          ->get()->row();
  if(!empty($test2->timesheet_id)) {
       $this->db->where('timesheet_id',$test2->timesheet_id);
       $this->db->delete('info_payslip');
       }

 $test= $this->db->select('time_sheet_id')->from('tax_history')->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])
        ->get()->row();
   if(!empty($test->time_sheet_id)) {
   $this->db->where('time_sheet_id',$test->time_sheet_id);
   $this->db->delete('tax_history');
    }
  $payperiod =$data['timesheet_data'][0]['month'];
      $data['sc']=$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
     
       $scValue =  $data['sc']['sc'][0]['sc']; // Accessing 'sc=12'
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
$sc_count = $data['sc']['count'];

if ($sc_totalAmount1 != 0) {
    $scValuePercentage = ($scValue / $sc_totalAmount1) * 100;
    $scValueAmount = ($scValuePercentage / 100) * $sc_totalAmount1;
} else {
   $scValueAmount = 0;
}
$scValue = $scValue / 100;
// Calculate the percentage of $sc_totalAmount1 based on $scValue
$scValueAmount = $scValue * $sc_totalAmount;



if($local_tax){
foreach($local_tax as $k=>$v){
   $split=explode('-',$k);
 $tx_n=str_replace("'","",$split[1]);
$data1 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
              'sales_c_amount' => $scValueAmount,
           'sc' => $scValue ,
           'tax_type'=>'state_local_tax',
           'no_of_inv' => $sc_count,
           'tax'  => $tx_n,
           'amount' => $v,
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],


        'weekly'          => $weekly_tax,


        'created_by'     => $this->session->userdata('user_id'),
      );
    $this->db->insert('tax_history',$data1);
  //  echo $this->db->last_query(); die();
   }
 }else{ 
$data1 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>(!empty($data['unemployment'])?$u:0)  ,
           'f_tax'=>$f,
           'tax_type'=>'state_local_tax',
           'sales_c_amount' => $sc_totalAmount,
           'sc' => $scValue ,
           'no_of_inv' => $sc_count,
           'tax'  =>'',
           'amount' => '',
           'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
           'employee_id'     => $timesheetdata[0]['templ_name'],
           'weekly'          => $weekly_tax,
           'created_by'     => $this->session->userdata('user_id'),
      );
    $this->db->insert('tax_history',$data1);
//  echo $this->db->last_query();  die();
 }


} 
 

// print_r($data['selected_state_local_tax']); .;

if($data['selected_state_local_tax'] ==''){
if(!empty($data['selected_local_tax'])){ 
//start local tax
echo "LOCAL TAX";
echo "<br/>";
$state_tax = $this->db->select('*')->from('state_and_tax')->where('state',$data['selected_local_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
$state= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax[0]['state'])->get()->result_array();



$tax_split=explode(',',$state[0]['tax']);
$local_tax_range='';
    $local_tax='';
    $local_tax=array();
foreach($tax_split as $tax){
   $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
 // echo $this->db->last_query();
foreach($tax as $tx){
          $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
             echo "<br/>";
             echo "--------". $final."/".$split[0]."/".$split[1];
             echo "<br/>";
       if($split[0]!='' && $split[1]!=''){
           if($final > $split[0] && $final < $split[1]){
      $local_tax_range=$split[0]."-".$split[1];
      $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$local_tax_range);
       if(!empty( $data['localtax'])){
           $i=0;
          foreach( $data['localtax'] as $lt){
          $local_tax_employee=$lt['employee'];
          $local_tax_employer=$lt['employer'];
          $local_tax_ee=($local_tax_employee/100)*$final;
          $local_tax_er=($local_tax_employer/100)*$final;
          $row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where('create_by',$this->session->userdata('user_id'))->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->count_all_results();
          $data_employee="'employee_".$tx['tax']."'";
          $search_tax=explode('-',$tx['tax']);
          if($row==1){
          $ar = $this->db->select('amount')->from('tax_history')->where('tax',$search_tax[1])->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])->get()->row()->amount;
          $t_tx=$local_tax_ee;
         $local_tax[$data_employee]=$t_tx;
        }
           $i++;
       }
   }
            }
   }
}
}

}



if(!empty($data['selected_state_tax'])) {
//end local tax

//start state tax
echo "<br/>";
echo "STATE TAX";
echo "<br/>";  


$state_tax1 = $this->db->select('*')->from('state_and_tax')->where('state',$data['selected_state_tax'])->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
echo $this->db->last_query();

// echo '<br>'; .;

$state1= $this->db->select('*')->from('state_and_tax')->where('state',$state_tax1[0]['state'])->get()->result_array();
  
$tax_split1=explode(',',$state1[0]['tax']);

// print_r($tax_split1);

       $state_tax_range='';
       $st_tax='';
       $st_tax=array();


foreach($tax_split1 as $tax){


   $tax=$this->db->select('*')->from('state_localtax')->where('tax',$state_tax1[0]['state']."-".$tax)->where('create_by',$this->session->userdata('user_id'))->get()->result_array();
   echo $this->db->last_query();




foreach($tax as $tx){
          $split=explode('-',$tx[$data['employee_data'][0]['employee_tax']]);
          echo "<br/>";
           echo "--------". $final."/".$split[0]."/".$split[1];
             echo "<br/>";
       if($split[0]!='' && $split[1]!=''){
           
           if($final > $split[0] && $final < $split[1]){
              
      $state_tax_range=$split[0]."-".$split[1];
     $data['localtax'] = $this->Hrm_model->local_state_tax($data['employee_data'][0]['employee_tax'],$final,$state_tax_range);
     
    //  print_r($data['localtax']); 

     if(!empty( $data['localtax'])){
           $i=0;
            foreach( $data['localtax'] as $lt){
    $local_tax_employee=$lt['employee'];
    $local_tax_employer=$lt['employer'];
        $local_tax_ee=($local_tax_employee/100)*$final;
          $local_tax_er=($local_tax_employer/100)*$final;
   $row = $this->db->select('*')->from('state_localtax')->where('employee',$local_tax_employee)->where('tax',$tx['tax'])->where($data['employee_data'][0]['employee_tax'],$local_tax_range)->where('create_by',$this->session->userdata('user_id'))->count_all_results();
 $data_employee="'employee_".$tx['tax']."'";
         $search_tax=explode('-',$tx['tax']);
      if($row==1){
  $ar = $this->db->select('amount')->from('tax_history')->where('tax',$search_tax[1])->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])->get()->row()->amount;
    $t_tx=$local_tax_ee;
 $st_tax[$data_employee]=$t_tx;
        }
           $i++;
       }
   }
            }
   }
}
}
}









//end state tax
 $test2= $this->db->select('*')->from('info_payslip')->where('timesheet_id',$timesheetdata[0]['timesheet_id'])
          ->get()->row();




      if(!empty($test2->timesheet_id)) {
       $this->db->where('timesheet_id',$test2->timesheet_id);
       $this->db->delete('info_payslip');
       }

 $test= $this->db->select('time_sheet_id')->from('tax_history')->where('time_sheet_id',$timesheetdata[0]['timesheet_id'])
        ->get()->row();
   if(!empty($test->time_sheet_id)) {
   $this->db->where('time_sheet_id',$test->time_sheet_id);
   $this->db->delete('tax_history');
    }
       $payperiod =$data['timesheet_data'][0]['month'];
       $data['sc']=$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
       $scValue =  $data['sc']['sc'][0]['sc']; // Accessing 'sc=12'
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
       $sc_count = $data['sc']['count'];
if ($sc_totalAmount1 != 0) {
    $scValuePercentage = ($scValue / $sc_totalAmount1) * 100;
    $scValueAmount = ($scValuePercentage / 100) * $sc_totalAmount1;
} else {
   $scValueAmount = 0;
}
$scValue = $scValue / 100;

// Calculate the percentage of $sc_totalAmount1 based on $scValue
$scValueAmount = $scValue * $sc_totalAmount;
 
}


if($st_tax){
foreach ($st_tax as $k => $v) {
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
 $tx_n=str_replace("'","",$split[1]);
    if (!$existingRecord) {

$data1 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
            'tax_type'=>'state_tax',
              'sales_c_amount' => $scValueAmount,
           'sc' => $scValue ,
           'no_of_inv' => $sc_count,
           'tax'  => $tx_n,
           'amount' => $v,
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
      );
    $this->db->insert('tax_history',$data1);
    // echo $this->db->last_query();  .;
   }
  }
  $sql = "DELETE t1
        FROM tax_history t1
        INNER JOIN tax_history t2 ON t1.id > t2.id
        AND t1.tax = t2.tax
        AND t1.code = t2.code
        AND t1.amount = t2.amount
        AND t1.created_by = t2.created_by
        AND t1.time_sheet_id = t2.time_sheet_id
        WHERE t1.weekly IS NULL
    AND t1.monthly IS NULL
    AND t1.biweekly IS NULL;
        
        
        
        ";

// Execute the SQL query
$this->db->query($sql);
 }
 if($local_tax){
foreach ($local_tax as $k => $v) {
    // Check if this tax for the employee and timesheet already exists in tax_history
    $existingRecord = $this->db->select('*')
        ->from('tax_history')
        ->where('time_sheet_id', $timesheetdata[0]['timesheet_id'])
        ->where('employee_id', $timesheetdata[0]['templ_name'])
        ->where('tax', str_replace("'", "", explode('-', $k)[1]))
        ->get()->row();
   $split=explode('-',$k);
 $tx_n=str_replace("'","",$split[1]);
    if (!$existingRecord) {

$data1 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
            'tax_type'=>'local_tax',
              'sales_c_amount' => $sc_totalAmount,
           'sc' => $scValue ,
           'no_of_inv' => $sc_count,
           'tax'  => $tx_n,
           'amount' => $v,
       'time_sheet_id'   => $timesheetdata[0]['timesheet_id'],
       'employee_id'     => $timesheetdata[0]['templ_name'],
       // 'month'          => $timesheetdata[0]['month'],
        'created_by'     => $this->session->userdata('user_id'),
      );
    $this->db->insert('tax_history',$data1);
    // echo $this->db->last_query();
   }
  }
 }

  $payperiod =$data['timesheet_data'][0]['month'];
       $data['sc']=$this->Hrm_model->sc_info_count($this->input->post('templ_name'),$payperiod);
        $scValue =  $data['sc']['sc'][0]['sc']; // Accessing 'sc=12'
       $sc_totalAmount1 = $data['sc']['total_gtotal']; // Accessing total amount
$sc_count = $data['sc']['count'];
$scValuePercentage = ($scValue / $sc_totalAmount1) * 100;
//  print_r($data['sc']);
$sc_totalAmount = ($scValuePercentage / 100) * $sc_totalAmount1;
 

if (is_nan($scValuePercentage)) {
    $scValuePercentage = 0; // Set $scValuePercentage to 0 if it's NaN
}

$data2 = array(
           's_tax'=>$s,
           'm_tax'=>$m,
           'u_tax'=>$u,
           'f_tax'=>$f,
           'sc' => $scValue ,
           'no_of_inv' => $countValue,
           'tax'  => $tx_n,
           'sales_c_amount' => $sales_amount,
       'total_amount'          => $final,
       'timesheet_id'   => $timesheetdata[0]['timesheet_id'],
       'total_hours'    => $timesheetdata[0]['total_hours'],
       'templ_name'     => $timesheetdata[0]['templ_name'],
       'employee_tax'   => $employeedata[0]['employee_tax'],
       'hrate'          => $employeedata[0]['hrate'],
       'id'             => $employeedata[0]['id'],
       'create_by'     => $this->session->userdata('user_id'),
      );
    $this->db->insert('info_payslip',$data2);
     
  //echo $this->db->last_query();.;
       $this->session->set_flashdata('message', display('save_successfully'));
     redirect("Chrm/manage_timesheet");
 }

        





        
        















    public function expense_list()
    { 
      
      $this->load->model('Hrm_model');
      $CI = & get_instance();

      $CI->load->model('Web_settings');

      $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
       $data['expen_list'] =$this->Hrm_model->expense_list();

       

       $data['expenses_data_get'] =$this->Hrm_model->expenses_data_get();

       $data['setting_detail'] =$setting_detail;

       $content = $this->parser->parse('hr/expense_list', $data, true);
       $this->template->full_admin_html_view($content);
    }






    public function pay_slip_list() {
    $data['title'] = display('pay_slip_list');

    $this->load->model('Hrm_model');
    $CI = & get_instance();

    $CI->load->model('Web_settings');

    $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
    $datainfo = $this->Hrm_model->get_data_payslip();

    $data=array(
        'dataforpayslip' => $datainfo,
        'setting_detail' => $setting_detail,

   );

    $content = $this->parser->parse('hr/pay_slip_list', $data, true);

      
    $this->template->full_admin_html_view($content);
    }







   public function  payroll_reports() {
      $this->load->model('Hrm_model');
      $CI = & get_instance();

      $CI->load->model('Web_settings');

      $setting_detail = $CI->Web_settings->retrieve_setting_editdata();


      $data['title']            = display('payroll_manage');

      $datainfo = $this->Hrm_model->get_data_payslip();
      $emplinfo = $this->Hrm_model->empl_data_info();
   //  print_r($emplinfo);
      $data=array(
          'dataforpayslip' => $datainfo,
          'employee_info' => $emplinfo,
          'setting_detail' => $setting_detail

     );
  // print_r($emplinfo); 
  // .;
      $content                  = $this->parser->parse('hr/payroll_manage_list', $data, true);
      $this->template->full_admin_html_view($content);
      }





public function add_state(){
  $CI = & get_instance();
$state_name = $this->input->post('state_name');
        $data=array(
             'state' => $state_name,
             'Type' =>'State',
             'created_by' => $this->session->userdata('user_id')
        );
      $this->db->insert('state_and_tax', $data);
      $this->session->set_userdata(array('message' => 'New State Added Successfully'));
     redirect("Chrm/payroll_setting");
}
public function add_state_tax(){
    $CI = & get_instance();
    $tx = $this->input->post('state_tax_name');
    $st_code = explode("-", $tx);
    $state_code = trim($st_code[1]);
    $selected_state = $this->input->post('selected_state');
    $user_id = $this->session->userdata('user_id');
    $this->db->where('state', $selected_state);
    $this->db->set('tax', "CONCAT(tax,',','".$tx."')", FALSE);
    $this->db->update('state_and_tax');
    $sql1 = "UPDATE state_and_tax SET state_code = '$state_code', tax = TRIM(BOTH ',' FROM tax) WHERE state = '$selected_state' AND created_by = '$user_id'";
    $this->db->query($sql1);
    $this->session->set_userdata(array('message' =>'New Tax Has been assigned Successfully'));
    redirect("Chrm/payroll_setting");
}

public function add_designation_data(){
        $this->load->model('Hrm_model');
        $postData = $this->input->post('designation');
        $data = $this->Hrm_model->designation_info($postData);
        echo json_encode($data);
    }




 public function add_office_loan() {
      $CI = & get_instance();
  $CI->load->model('Web_settings');
  $CI->load->model('Invoices');
 $CI->load->model('Settings');

 $data['person_list'] =  $CI->Settings->office_loan_person();
           $setting_detail = $CI->Web_settings->retrieve_setting_editdata();

 $bank_name = $CI->db->select('bank_id,bank_name')
->from('bank_add')
->get()
->result_array();
 $data['bank_list']   =  $CI->Web_settings->bank_list();
 $CI = & get_instance();

$paytype=$CI->Invoices->payment_type();

$noofpayment_type=$CI->Invoices->noofpayment_type();




 $CI->load->model('Web_settings');
 $data['payment_typ']  =$paytype;
 $data['bank_name']  =$bank_name;

 $data['noofpayment_type']  =$noofpayment_type;
 $data['setting_detail']  =$setting_detail;


 
 
      $currency_details    = $CI->Web_settings->retrieve_setting_editdata();
     $data['title'] = display('add_office_loan');
     $data['currency']=  $currency_details[0]['currency'];
$content = $this->parser->parse('hr/add_office_loan', $data, true);
$this->template->full_admin_html_view($content);

}













       public function add_expense_item()
    {
        $CI = & get_instance();
        $CI->load->model('Web_settings');
           $CI->load->model('Hrm_model');
        $currency_details    = $CI->Web_settings->retrieve_setting_editdata();
        $setting_detail = $CI->Web_settings->retrieve_setting_editdata();

        $data['setting_detail'] = $setting_detail;


        $data['person_list'] = $CI->Hrm_model->employee_list();
        $data['title'] = display('expense_item_form');
        $data['currency']=  $currency_details[0]['currency'];
    $content = $this->parser->parse('hr/expense_item_form', $data, true);
    $this->template->full_admin_html_view($content);
    }



    public function tax_list() {
    $data['title'] = display('tax_list');
    $content = $this->parser->parse('hr/payroll_setting', $data, true);
    $this->template->full_admin_html_view($content);
    }


    public function payroll_setting() {
      $CI = & get_instance();
      $CI->load->model('Web_settings');
      $setting_detail = $CI->Web_settings->retrieve_setting_editdata();

    $data['timesheet_data_emp'] =  $CI->Hrm_model->timesheet_data_emp();
    $data['setting_detail'] = $setting_detail;
    $data['states_list'] = $this->db->select("state, tax")
    ->from('state_and_tax')
    ->where('created_by', $this->session->userdata('user_id'))
    ->where('Type', 'State')
    ->get()
    ->result_array();
     $data['city_list'] = $this->db->select("state, tax")
     ->from('state_and_tax')
     ->where('created_by', $this->session->userdata('user_id'))
     ->where('Type', 'City')
     ->get()
     ->result_array();
     $data['county_list'] = $this->db->select("state, tax")
     ->from('state_and_tax')
     ->where('created_by', $this->session->userdata('user_id'))
     ->where('Type', 'County')
     ->get()
     ->result_array();
     $data['title'] = display('federal_taxes');
 
  $data['get_data_salespartner'] = $CI->Hrm_model->get_data_salespartner();
 
 
  $data['get_data_salespartner_another'] = $CI->Hrm_model->get_data_salespartner_another();
  

  $data['merged_data_salespartner'] = array_merge($data['get_data_salespartner'], $data['get_data_salespartner_another']);

  
  $data['state_selected'] = $this->db->select("state,tax")->from('state_and_tax')->where('Status',1)->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
   
  $content = $this->parser->parse('hr/federal_taxes', $data, true);
  
  $this->template->full_admin_html_view($content);
 
  }
 
    
    
    
    public function formfl099nec($selectedValue = null)
{
     $CI = & get_instance();
     $this->load->model('Hrm_model');
     $data['get_cominfo'] = $this->Hrm_model->get_company_info();
     $data['get_f1099nec_info'] = $this->Hrm_model->get_f1099nec_info($selectedValue);
     $data['choice']  =  $data['get_f1099nec_info'][0]['choice'];
     $data['no_salecommission'] = $this->Hrm_model->no_salecommission($selectedValue);
     $data['sss']  = $data['no_salecommission'][0]['sc_nocomission'];
     $currency_details = $CI->Web_settings->retrieve_setting_editdata();
     $data['currency'] = $currency_details[0]['currency'];
    $content = $CI->parser->parse('hr/fl099nec', $data, true);
    $this->template->full_admin_html_view($content);
}
    
public function delete_tax() {
$tax= $this->input->post('tax');
$state= $this->input->post('state');
    $this->load->model('Hrm_model');
    $this->Hrm_model->delete_tax($tax,$state);
    $this->session->set_flashdata('show', display('successfully_delete'));
    // alert('Successfully Delete');
    // redirect('Cinvoice/manage_invoice');
    //  $this->session->set_userdata(array('message' => display('successfully_delete')));
     redirect("Chrm/payroll_setting");
}


public function citydelete_tax() {
  $citytax = $this->input->post('citytax');
  $city = $this->input->post('city');
  $this->load->model('Hrm_model');
  $this->Hrm_model->citydelete_tax($citytax,$city);
  // $this->db->where('city', $city . '-' . $citytax);
  $this->session->set_flashdata('show', display('successfully_delete'));
  // redirect("Chrm/payroll_setting");
}
public function countydelete_tax() {
  $countytax = $this->input->post('countytax');
  $county = $this->input->post('county');
  $this->load->model('Hrm_model');
  $this->Hrm_model->countydelete_tax($countytax, $county);
  $this->session->set_flashdata('show', display('successfully_delete'));
  redirect("Chrm/payroll_setting");
}


public function getemployee_data(){
    $CI = & get_instance();
    $this->auth->check_admin_auth();
    $CI->load->model('Hrm_model');
    $value = $this->input->post('value',TRUE);
    $customer_info = $CI->Hrm_model->getemp_data($value);
 
    echo json_encode($customer_info);
    
}



 




public function add_state_taxes_detail($tax=null) {
  $CI = & get_instance();
    $CI->load->model('Web_settings');
    $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
$data['setting_detail'] = $setting_detail;
    $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $parts = parse_url($url);
     parse_str($parts['query'], $query);
    
     $data['taxinfo'] = $this->db->select("*")
     ->from('state_localtax')
     ->where('tax',$query['tax'])
     ->where('create_by',$this->session->userdata('user_id') )
     ->get()->result_array();
    
  // print_r($data['taxinfo'][0]['tax']);
     
      $get_tax_name = $this->db->select("tax")
        ->from('weekly_tax_info')
        ->where('create_by',$this->session->userdata('user_id') )
        ->get()
        ->result_array();

 
     $weekly_tax = 'Weekly';
     $data['trimmed_tax']    = str_replace($weekly_tax, '', $get_tax_name[0]['tax']);
 
    $data['weekly_taxinfo'] = $this->db->select("*")
    ->from('weekly_tax_info')
    ->where('tax', $get_tax_name[0]['tax'] )
    ->where('create_by',$this->session->userdata('user_id') )
    ->get()
    ->result_array();
 

    $get_tax_name_biweekly = $this->db->select("tax")
    ->from('biweekly_tax_info')
    ->where('create_by',$this->session->userdata('user_id') )
    ->get()
    ->result_array();

    $biweekly_tax = 'BIWeekly';
    $data['trimmed_tax_bi']    = str_replace($biweekly_tax, '', $get_tax_name_biweekly[0]['tax']);


    $data['biweekly_taxinfo'] = $this->db->select("*")
    ->from('biweekly_tax_info')
    ->where('tax', $get_tax_name_biweekly[0]['tax'] )
    ->where('create_by',$this->session->userdata('user_id') )
    ->get()
    ->result_array();
      

    $get_tax_name_monthly = $this->db->select("tax")
    ->from('monthly_tax_info')
    ->where('create_by',$this->session->userdata('user_id') )
    ->get()
    ->result_array();

    $monthly_tax = 'Monthly';
    $data['trimmed_tax_monly']    = str_replace($monthly_tax, '', $get_tax_name_monthly[0]['tax']);
 
    $data['monthly_taxinfo'] = $this->db->select("*")
    ->from('monthly_tax_info')
    ->where('tax', $get_tax_name_monthly[0]['tax'] )
    ->where('create_by',$this->session->userdata('user_id') )
    ->get()
    ->result_array();

 
    $data['title'] = display('add_taxes_detail');
    
    $content = $this->parser->parse('hr/add_state_tax_detail', $data, true);
    $this->template->full_admin_html_view($content);
    // echo json_encode($data);
    }







   public function add_taxes_detail() {
       $CI = & get_instance();
    $CI->load->model('Web_settings');
    $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
$data['setting_detail'] = $setting_detail;
     $tax = $this->input->post('tax');
    $data['taxinfo'] = $this->db->select("*")->from('federal_tax')->where('tax','Federal Income tax')->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
    // $data['taxinfo'] = $this->db->select("*")->from('federal_tax')->where('tax',$tax)->get()->result_array();
    // print_r($data['taxinfo']); .;
    // echo $this->db->last_query(); .;
    $data['title'] = display('add_taxes_detail');
    $content = $this->parser->parse('hr/add_taxes_detail', $data, true);
    $this->template->full_admin_html_view($content);
    // echo json_encode($data);
    }
    public function socialsecurity_detail() {
    $CI = & get_instance();
      $CI->load->model('Web_settings');
      $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
      $data['setting_detail'] = $setting_detail;
    $data['taxinfo'] = $this->db->select("*")->from('federal_tax')->where('tax','Social Security')->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
 //   echo $this->db->last_query();
    $data['title'] = display('add_taxes_detail');
    $content = $this->parser->parse('hr/social_security_list', $data, true);
    $this->template->full_admin_html_view($content);
    }
    public function medicare_detail() {
         $CI = & get_instance();
      $CI->load->model('Web_settings');
      $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
      $data['setting_detail'] = $setting_detail;
    $data['taxinfo'] = $this->db->select("*")->from('federal_tax')->where('tax','Medicare')->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
    $data['title'] = display('add_taxes_detail');
    $content = $this->parser->parse('hr/medicare_list', $data, true);
    $this->template->full_admin_html_view($content);
    }
    
    
    
    
    
    
    public function federalunemployment_detail() {


      $CI = & get_instance();

      $CI->load->model('Web_settings');

      $setting_detail = $CI->Web_settings->retrieve_setting_editdata();




    $data['taxinfo'] = $this->db->select("*")->from('federal_tax')->where('tax','Federal unemployment')->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
    $data['title'] = display('add_taxes_detail');

    $data['setting_detail'] = $setting_detail;


    $content = $this->parser->parse('hr/federalunemployment_list', $data, true);
    $this->template->full_admin_html_view($content);
    }
















 public function add_timesheet() {
    $data['title'] = display('add_timesheet');
    
        $CI = & get_instance();
        $this->load->model('Hrm_model');

        $CI->load->model('Web_settings');

        $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
        $data['employee_name'] = $this->Hrm_model->employee_name1();

         $data['payment_terms'] = $this->Hrm_model->get_payment_terms();
    
         $data['setting_detail'] = $setting_detail;

        $data['dailybreak'] = $this->Hrm_model->get_dailybreak();
        
        $data['duration'] = $this->Hrm_model->get_duration_data();
    
        $content = $this->parser->parse('hr/add_timesheet', $data, true);
        $this->template->full_admin_html_view($content);
        }
    
    
    
    
    
    
    
    

        public function add_durat_info(){
            $CI = & get_instance();
            $CI->auth->check_admin_auth();
            $CI->load->model('Hrm_model');
            $postData = $this->input->post('duration_name');
            $data = $this->Hrm_model->insert_duration_data($postData);
            echo json_encode($data);
        }
    // $content = $this->parser->parse('hr/add_timesheet', $data, true);
    // $this->template->full_admin_html_view($content);
    // }

    public function add_adm_data(){
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Hrm_model');
        $postData = $this->input->post('data_name');
        $postData = $this->input->post('data_adres');

        //  print_r($postData); .;

        $data = $this->Hrm_model->insert_adsrs_data($postData);
        echo json_encode($data);
    }



    public function insert_data_adsr(){
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Hrm_model');
    $data = array(
        'adm_name'   => $this->input->post('adms_name',TRUE),
        'adm_address'=> $this->input->post('address',TRUE),
        'create_by'       => $this->session->userdata('user_id'),
  );
  // print_r($data); .;
    // $result = $this->Customers->customer_entry($data);
    $data = $this->Hrm_model->insert_adsrs_data($data);
    echo json_encode($data);
    }


public function add_city(){
  $CI = & get_instance();
$city_name = $this->input->post('city_name');
        $data=array(
             'state' => $city_name,
             'Type' =>'City',
             'created_by' => $this->session->userdata('user_id')
        );
      $this->db->insert('state_and_tax', $data);
      $this->session->set_userdata(array('message' => 'New City Added Successfully'));
     redirect("Chrm/payroll_setting");
}
  public function add_city_state_tax(){
  $CI = & get_instance();
  $selected_city = $this->input->post('selected_city');
  $citytax = $this->input->post('city_tax_name');
 $this->db->where('state', $selected_city);
 $this->db->set('tax', "CONCAT(tax,',','".$citytax."')", FALSE);
 $this->db->update('state_and_tax');
 $query = $this->db->get();
//  $query = $this->db->last_query();
 $sql1="UPDATE state_and_tax
 SET tax = TRIM(BOTH ',' FROM tax)";
 $query1=$this->db->query($sql1);
//  echo $query1;
//  .;
 $this->session->set_userdata(array('message' =>'New Tax Has been assigned Successfully'));
 redirect("Chrm/payroll_setting");
}
public function add_county_tax(){
  $CI = & get_instance();
  $selected_county = $this->input->post('selected_county');
  $ctax = $this->input->post('county_tax_name');
 $this->db->where('state', $selected_county);
 $this->db->set('tax', "CONCAT(tax,',','".$ctax."')", FALSE);
 $this->db->update('state_and_tax');
 $query = $this->db->get();
 

 
$sql1="UPDATE state_and_tax
SET tax = TRIM(BOTH ',' FROM tax)";
$query1=$this->db->query($sql1);
        // echo $this->db->last_query(); die();

 $this->session->set_userdata(array('message' =>'New Tax Has been assigned Successfully'));
 redirect("Chrm/payroll_setting");
}
public function add_county(){
  $CI = & get_instance();
$county = $this->input->post('county');
        $data=array(
             'state' => $county,
             'created_by' => $this->session->userdata('user_id'),
             'Type' =>'County',
        );
      $this->db->insert('state_and_tax', $data);
      // echo $this->db->last_query(); .;
      $this->session->set_userdata(array('message' => 'New County Added Successfully'));
     redirect("Chrm/payroll_setting");
}




    //Designation form
    public function add_designation() {
    $data['title'] = display('add_designation');
    $content = $this->parser->parse('hr/employee_type', $data, true);
    $this->template->full_admin_html_view($content);
    }
    // create designation
    public function create_designation(){
    $this->form_validation->set_rules('designation',display('designation'),'required|max_length[100]');
    $this->form_validation->set_rules('details',display('details'),'max_length[250]');
        #-------------------------------#
        if ($this->form_validation->run()) {
            $postData = [
                'id'            => $this->input->post('id',true),
                'designation'   => $this->input->post('designation',true),
                'details'       => $this->input->post('details',true),
            ];   
           if(empty($this->input->post('id',true))){
            if ($this->Hrm_model->create_designation($postData)) { 
                $this->session->set_flashdata('message', display('save_successfully'));
            } else {
                $this->session->set_flashdata('error_message',  display('please_try_again'));
            }
        }else{
             if ($this->Hrm_model->update_designation($postData)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('error_message',  display('please_try_again'));
            }
           
        }
  redirect("Chrm/manage_designation");
        }
         redirect("Chrm/add_designation");
    }


    //Manage designation
    public function manage_designation() {
        $this->load->model('Hrm_model');
     $data['title']            = display('manage_designation');
     $data['designation_list'] = $this->Hrm_model->designation_list();
     $content                  = $this->parser->parse('hr/designation_list', $data, true);
    $this->template->full_admin_html_view($content);
    }

    //designation Update Form
    public function designation_update_form($id) {
    $this->load->model('Hrm_model');
     $data['title']            = display('designation_update_form');
     $data['designation_data'] = $this->Hrm_model->designation_editdata($id);
     $content                  = $this->parser->parse('hr/employee_type', $data, true);
     $this->template->full_admin_html_view($content);
    }

    // designation delete
    public function designation_delete($id) {
    $this->load->model('Hrm_model');
    $this->Hrm_model->delete_designation($id);
    $this->session->set_userdata(array('message' => display('successfully_delete')));
     redirect("Chrm/manage_designation");
    }
    // ================== Employee part ============================= 
public function add_employee() {
    $this->auth->check_admin_auth();
    $CI = & get_instance();
    $CI->load->model('Web_settings');
    $this->load->model('Hrm_model');
    $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
    $currency_details = $CI->Web_settings->retrieve_setting_editdata();
    $curn_info_default = $CI->db->select('*')->from('currency_tbl')->where('icon',$currency_details[0]['currency'])->get()->result_array();
    $data['title'] = display('add_employee');
    $data['desig'] = $this->Hrm_model->designation_dropdown();
    $data['paytype'] = $this->Hrm_model->paytype_dropdown();
    $data['citytx'] = $this->Hrm_model->city_tax_dropdown();
    $data['cty_tax'] = $this->Hrm_model->city_tax();
    $data['desig'] = $this->Hrm_model->designation_dropdown();
    $data['get_info_city_tax'] = $this->Hrm_model->get_info_city_tax();
     $data['get_info_county_tax'] = $this->Hrm_model->get_info_county_tax();
$data['state_tx'] = $this->Hrm_model->state_tax();
// $data['city_tx'] = $this->Hrm_model->state_tax();
    $data['setting_detail'] = $setting_detail;
    $data['curn_info_default'] =$curn_info_default[0]['currency_name'];
       //  'curn_info_customer'=>$curn_info_customer[0]['currency_name'],
       $data['currency']  =$currency_details[0]['currency'];
    $data['payroll_data'] = $this->db->select('*')->from('payroll_type')->where('created_by', $this->session->userdata('user_id'))->get()->result_array();
    $data['bank_data'] = $this->db->select('*')->from('bank_add')->where('created_by', $this->session->userdata('user_id'))->get()->result_array();
    $data['emp_data'] = $this->db->select('*')->from('employee_type')->where('created_by', $this->session->userdata('user_id'))->get()->result_array();
    // print_r( $data['desig'] ); .;
    $content = $this->parser->parse('hr/employee_form', $data, true);
    $this->template->full_admin_html_view($content);
    }


// Sales Partner
    public function salespartner_create()
    {
    
        if (isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
        $no_files = count($_FILES["files"]['name']);
        for ($i = 0; $i < $no_files; $i++) {
            if ($_FILES["files"]["error"][$i] > 0) {
                echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
            } else {
              move_uploaded_file(
                        $_FILES["files"]["tmp_name"][$i],
                        "uploads/salespartner/" . $_FILES["files"]["name"][$i]
                    );
                $images[] = $_FILES["files"]["name"][$i];
                $insertImages = implode(', ', $images);
            }
        }
        if ($_FILES['profile_image']['name']) {
        $config['upload_path']    = 'uploads/profile/salespartner/';
        $config['allowed_types']  = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
        $config['encrypt_name']   = TRUE;
        $this->load->library('upload', $config);
            if (!$this->upload->do_upload('profile_image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cweb_setting'));
            } else {
            $data = $this->upload->data();
            $profile_image = $data['file_name'];
            $config['image_library']  = 'gd2';
            $config['source_image']   = $profile_image;
            $config['create_thumb']   = false;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 200;
            $config['height']         = 200;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $profile_image =  $profile_image;
            }
        }
        $data_empolyee['last_name'] = $this->input->post('last_name');
        $data_empolyee['designation'] = $this->input->post('designation');
        $data_empolyee['first_name'] = $this->input->post('first_name');
        $data_empolyee["middle_name"] = $this->input->post("middle_name");
        $data_empolyee['phone'] = $this->input->post('phone');
        $data_empolyee['files'] = $insertImages;
        $data_empolyee['employee_tax'] = $this->input->post('emp_tax_detail');
        $data_empolyee['employee_type'] = $this->input->post('employee_type');
        $data_empolyee['salesbusiness_name'] = $this->input->post('salesbusiness_name');
        $data_empolyee['federalidentificationnumber'] = $this->input->post('federalidentificationnumber');
        $data_empolyee['federaltaxclassification'] = $this->input->post('federaltaxclassification');
        $data_empolyee['cty_tax'] = $this->input->post('citytx');
        $data_empolyee['email'] = $this->input->post('email');
        $data_empolyee['sc'] = $this->input->post('sc');
        $data_empolyee['address_line_1'] = $this->input->post('address_line_1');
        $data_empolyee['address_line_2'] = $this->input->post('address_line_2');
        $data_empolyee['social_security_number'] = $this->input->post('ssn');
        $data_empolyee['routing_number'] = $this->input->post('routing_number');
       $data_empolyee['sales_partner'] = 'Sales_Partner';
        $data_empolyee['choice'] = $this->input->post('choice');
       
        $data_empolyee['account_number'] = $this->input->post('account_number');
        $data_empolyee['bank_name'] = $this->input->post('bank_name');
        $data_empolyee['country'] = $this->input->post('country');
        $data_empolyee['city'] = $this->input->post('city');
        $data_empolyee['zip'] = $this->input->post('zip');
        $data_empolyee['state'] = $this->input->post('state');
        $data_empolyee['emergencycontact'] = $this->input->post('emergencycontact');
        $data_empolyee['emergencycontactnum'] = $this->input->post('emergencycontactnum');
        $data_empolyee['withholding_tax'] = $this->input->post('withholding_tax');
        $data_empolyee['last_name'] = $this->input->post('last_name');
        $data_empolyee['profile_image'] = $profile_image;
        $data_empolyee['create_by'] =$this->session->userdata('user_id');
        $data_empolyee['e_type'] = 2;
         $data_empolyee['sp_withholding'] =$this->input->post('choice');
        
        
        
        
         // State Tax Information
$state_tax = $this->input->post('state_tax');
$living_state_tax = $this->input->post('living_state_tax');  
if ($state_tax == $living_state_tax) {
     $data_empolyee['state_tx'] = $state_tax;
} else {
     $data_empolyee['state_tx'] = $state_tax;
     $data_empolyee['living_state_tax'] = $living_state_tax;
}

// Local (City) Tax Information
$city_tax = $this->input->post('city_tax');
$living_city_tax = $this->input->post('living_city_tax');   
if ($city_tax == $living_city_tax) {
     $data_empolyee['local_tax'] = $city_tax;
} else {
     $data_empolyee['local_tax'] = $city_tax;
     $data_empolyee['living_local_tax'] = $living_city_tax;
}



//  City Tax Information
$county_tax = $this->input->post('county_tax');
$living_county_tax = $this->input->post('living_county_tax');   
if ($county_tax == $living_county_tax) {
     $data_empolyee['cty_tax'] = $county_tax;
} else {
     $data_empolyee['cty_tax'] = $county_tax;
    $data_empolyee['living_county_tax'] = $living_county_tax;
}


// Other Tax Info
$other_working_tax = $this->input->post('other_working_tax');
$other_living_tax = $this->input->post('other_living_tax');   

if ($county_tax == $county_tax) {
     $data_empolyee['state_tax_1'] = $other_working_tax;
} else {
     $data_empolyee['state_tax_1'] = $other_working_tax;
    $data_empolyee['state_tax_2'] = $other_living_tax;
}

        

             $living_state_tax = $this->input->post('living_state_tax'); 
             $data_empolyee['edit_working_state'] = $state_tax;
             $data_empolyee['edit_living_state'] = $living_state_tax;
        
        
        // Local (City) Tax Information
        $city_tax = $this->input->post('city_tax');
        $living_city_tax = $this->input->post('living_city_tax');   
    
             $data_empolyee['edit_working_city'] = $city_tax;
             $data_empolyee['edit_living_city'] = $living_city_tax;
        
        
        //  City Tax Information
        $county_tax = $this->input->post('county_tax');
        $living_county_tax = $this->input->post('living_county_tax');   
    
             $data_empolyee['edit_working_county'] = $county_tax;
            $data_empolyee['edit_living_county'] = $living_county_tax;
        
        
        // Other Tax Info
        $other_working_tax = $this->input->post('other_working_tax');
        $other_living_tax = $this->input->post('other_living_tax');   
        
       
             $data_empolyee['edit_working_other'] = $other_working_tax;
            $data_empolyee['edit_living_other'] = $other_living_tax;  
        
        
        
        
    }else{
        if ($_FILES['profile_image']['name']) {
        $config['upload_path']    = 'uploads/profile';
        $config['allowed_types']  = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
        $config['encrypt_name']   = TRUE;
        $this->load->library('upload', $config);
            if (!$this->upload->do_upload('profile_image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cweb_setting'));
            } else {
            $data = $this->upload->data();
            $profile_image = $data['file_name'];
            $config['image_library']  = 'gd2';
            $config['source_image']   = $profile_image;
            $config['create_thumb']   = false;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 200;
            $config['height']         = 200;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $profile_image =  $profile_image;
            }
        }
        $data_empolyee['last_name'] = $this->input->post('last_name');
        $data_empolyee['designation'] = $this->input->post('designation');
        $data_empolyee['first_name'] = $this->input->post('first_name');
        $data_empolyee["middle_name"] = $this->input->post("middle_name");
        $data_empolyee['phone'] = $this->input->post('phone');
        $data_empolyee['employee_tax'] = $this->input->post('emp_tax_detail');
        $data_empolyee['employee_type'] = $this->input->post('employee_type');
        $data_empolyee['salesbusiness_name'] = $this->input->post('salesbusiness_name');
        $data_empolyee['federalidentificationnumber'] = $this->input->post('federalidentificationnumber');
        $data_empolyee['federaltaxclassification'] = $this->input->post('federaltaxclassification');
        $data_empolyee['cty_tax'] = $this->input->post('citytx');
        $data_empolyee['email'] = $this->input->post('email');
        $data_empolyee['sc'] = $this->input->post('sc');
        $data_empolyee['address_line_1'] = $this->input->post('address_line_1');
        $data_empolyee['address_line_2'] = $this->input->post('address_line_2');
        $data_empolyee['social_security_number'] = $this->input->post('ssn');
        $data_empolyee['routing_number'] = $this->input->post('routing_number');
        
      $data_empolyee['sales_partner'] = 'Sales_Partner';
        $data_empolyee['choice'] = $this->input->post('choice');
        $data_empolyee['account_number'] = $this->input->post('account_number');
        $data_empolyee['bank_name'] = $this->input->post('bank_name');
        $data_empolyee['country'] = $this->input->post('country');
        $data_empolyee['city'] = $this->input->post('city');
        $data_empolyee['zip'] = $this->input->post('zip');
        $data_empolyee['state'] = $this->input->post('state');
        $data_empolyee['emergencycontact'] = $this->input->post('emergencycontact');
        $data_empolyee['emergencycontactnum'] = $this->input->post('emergencycontactnum');
        $data_empolyee['withholding_tax'] = $this->input->post('withholding_tax');
        $data_empolyee['last_name'] = $this->input->post('last_name');
        $data_empolyee['profile_image'] = $profile_image;
        $data_empolyee['create_by'] =$this->session->userdata('user_id');
        $data_empolyee['e_type'] = 2;
         $data_empolyee['sp_withholding'] = $this->input->post('choice');
        
        
         // State Tax Information
        $state_tax = $this->input->post('state_tax');
        $living_state_tax = $this->input->post('living_state_tax');  
        if ($state_tax == $living_state_tax) {
             $data_empolyee['state_tx'] = $state_tax;
        } else {
             $data_empolyee['state_tx'] = $state_tax;
             $data_empolyee['living_state_tax'] = $living_state_tax;
        }
        
        // Local (City) Tax Information
        $city_tax = $this->input->post('city_tax');
        $living_city_tax = $this->input->post('living_city_tax');   
        if ($city_tax == $living_city_tax) {
             $data_empolyee['local_tax'] = $city_tax;
        } else {
             $data_empolyee['local_tax'] = $city_tax;
             $data_empolyee['living_local_tax'] = $living_city_tax;
        }
        
        //  City Tax Information
        $county_tax = $this->input->post('county_tax');
        $living_county_tax = $this->input->post('living_county_tax');   
        if ($county_tax == $living_county_tax) {
             $data_empolyee['cty_tax'] = $county_tax;
        } else {
             $data_empolyee['cty_tax'] = $county_tax;
            $data_empolyee['living_county_tax'] = $living_county_tax;
        }
        
        // Other Tax Info
        $other_working_tax = $this->input->post('other_working_tax');
        $other_living_tax = $this->input->post('other_living_tax');   
        
        if ($county_tax == $county_tax) {
             $data_empolyee['state_tax_1'] = $other_working_tax;
        } else {
             $data_empolyee['state_tax_1'] = $other_working_tax;
            $data_empolyee['state_tax_2'] = $other_living_tax;
        }
      $living_state_tax = $this->input->post('living_state_tax'); 
             $data_empolyee['edit_working_state'] = $state_tax;
             $data_empolyee['edit_living_state'] = $living_state_tax;
        
        
        // Local (City) Tax Information
        $city_tax = $this->input->post('city_tax');
        $living_city_tax = $this->input->post('living_city_tax');   
    
             $data_empolyee['edit_working_city'] = $city_tax;
             $data_empolyee['edit_living_city'] = $living_city_tax;
        
        
        //  City Tax Information
        $county_tax = $this->input->post('county_tax');
        $living_county_tax = $this->input->post('living_county_tax');   
    
             $data_empolyee['edit_working_county'] = $county_tax;
            $data_empolyee['edit_living_county'] = $living_county_tax;
        
        
        // Other Tax Info
        $other_working_tax = $this->input->post('other_working_tax');
        $other_living_tax = $this->input->post('other_living_tax');   
        
       
             $data_empolyee['edit_working_other'] = $other_working_tax;
            $data_empolyee['edit_living_other'] = $other_living_tax;
        
         
         
         
    }
       $this->db->insert('employee_history', $data_empolyee);
 
    // echo $this->db->last_query();die();
 
       $this->session->set_flashdata('message', display('save_successfully'));
       redirect(base_url('Chrm/manage_employee'));
}

public function employee_create()
    {
        if (isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
        $no_files = count($_FILES["files"]['name']);
        for ($i = 0; $i < $no_files; $i++) {
            if ($_FILES["files"]["error"][$i] > 0) {
                echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
            } else {
              move_uploaded_file(
                        $_FILES["files"]["tmp_name"][$i],
                        "uploads/employeedetails/" . $_FILES["files"]["name"][$i]
                    );
                $images[] = $_FILES["files"]["name"][$i];
                $insertImages = implode(', ', $images);
            }
        }
        if ($_FILES['profile_image']['name']) {
        $config['upload_path']    = 'uploads/profile';
        $config['allowed_types']  = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
        $config['encrypt_name']   = TRUE;
        $this->load->library('upload', $config);
            if (!$this->upload->do_upload('profile_image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cweb_setting'));
            } else {
            $data = $this->upload->data();
            $profile_image = $data['file_name'];
            $config['image_library']  = 'gd2';
            $config['source_image']   = $profile_image;
            $config['create_thumb']   = false;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 200;
            $config['height']         = 200;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $profile_image =  $profile_image;
            }
        }
        $data_empolyee['last_name'] = $this->input->post('last_name');
        $data_empolyee['designation'] = $this->input->post('designation');
        $data_empolyee['first_name'] = $this->input->post('first_name');
        $data_empolyee["middle_name"] = $this->input->post("middle_name");
        $data_empolyee['phone'] = $this->input->post('phone');
        $data_empolyee['files'] = $insertImages;
        $data_empolyee['employee_tax'] = $this->input->post('emp_tax_detail');
        $data_empolyee['employee_type'] = $this->input->post('employee_type');
        $data_empolyee['rate_type'] = $this->input->post('paytype');
        $data_empolyee['payroll_type'] = $this->input->post('payroll_type');
          $data_empolyee['choice'] = $this->input->post('choice');
        $data_empolyee['cty_tax'] = $this->input->post('citytx');
        $data_empolyee['email'] = $this->input->post('email');
        $data_empolyee['hrate'] = $this->input->post('hrate');
        $data_empolyee['sc'] = $this->input->post('sc');
        $data_empolyee['address_line_1'] = $this->input->post('address_line_1');
        $data_empolyee['address_line_2'] = $this->input->post('address_line_2');
        $data_empolyee['social_security_number'] = $this->input->post('ssn');
        $data_empolyee['routing_number'] = $this->input->post('routing_number');
       
       
        
       
       
        $data_empolyee['account_number'] = $this->input->post('account_number');
        $data_empolyee['bank_name'] = $this->input->post('bank_name');
        $data_empolyee['country'] = $this->input->post('country');
        $data_empolyee['city'] = $this->input->post('city');
        $data_empolyee['zip'] = $this->input->post('zip');
        $data_empolyee['state'] = $this->input->post('state');
        $data_empolyee['emergencycontact'] = $this->input->post('emergencycontact');
        $data_empolyee['emergencycontactnum'] = $this->input->post('emergencycontactnum');
        $data_empolyee['withholding_tax'] = $this->input->post('withholding_tax');
        $data_empolyee['last_name'] = $this->input->post('last_name');
        $data_empolyee['profile_image'] = $profile_image;
        $data_empolyee['create_by'] =$this->session->userdata('user_id');
        $data_empolyee['e_type'] = 1;
        
        
        
        
        
         // State Tax Information
$state_tax = $this->input->post('state_tax');
$living_state_tax = $this->input->post('living_state_tax');  
if ($state_tax == $living_state_tax) {
     $data_empolyee['state_tx'] = $state_tax;
} else {
     $data_empolyee['state_tx'] = $state_tax;
     $data_empolyee['living_state_tax'] = $living_state_tax;
}

// Local (City) Tax Information
$city_tax = $this->input->post('city_tax');
$living_city_tax = $this->input->post('living_city_tax');   
if ($city_tax == $living_city_tax) {
     $data_empolyee['local_tax'] = $city_tax;
} else {
     $data_empolyee['local_tax'] = $city_tax;
     $data_empolyee['living_local_tax'] = $living_city_tax;
}



//  City Tax Information
$county_tax = $this->input->post('county_tax');
$living_county_tax = $this->input->post('living_county_tax');   
if ($county_tax == $living_county_tax) {
     $data_empolyee['cty_tax'] = $county_tax;
} else {
     $data_empolyee['cty_tax'] = $county_tax;
    $data_empolyee['living_county_tax'] = $living_county_tax;
}


// Other Tax Info
$other_working_tax = $this->input->post('other_working_tax');
$other_living_tax = $this->input->post('other_living_tax');   

if ($county_tax == $county_tax) {
     $data_empolyee['state_tax_1'] = $other_working_tax;
} else {
     $data_empolyee['state_tax_1'] = $other_working_tax;
    $data_empolyee['state_tax_2'] = $other_living_tax;
}

        

             $living_state_tax = $this->input->post('living_state_tax'); 
             $data_empolyee['edit_working_state'] = $state_tax;
             $data_empolyee['edit_living_state'] = $living_state_tax;
        
        
        // Local (City) Tax Information
        $city_tax = $this->input->post('city_tax');
        $living_city_tax = $this->input->post('living_city_tax');   
    
             $data_empolyee['edit_working_city'] = $city_tax;
             $data_empolyee['edit_living_city'] = $living_city_tax;
        
        
        //  City Tax Information
        $county_tax = $this->input->post('county_tax');
        $living_county_tax = $this->input->post('living_county_tax');   
    
             $data_empolyee['edit_working_county'] = $county_tax;
            $data_empolyee['edit_living_county'] = $living_county_tax;
        
        
        // Other Tax Info
        $other_working_tax = $this->input->post('other_working_tax');
        $other_living_tax = $this->input->post('other_living_tax');   
        
       
             $data_empolyee['edit_working_other'] = $other_working_tax;
            $data_empolyee['edit_living_other'] = $other_living_tax;  
        
        
        
        
    }else{
        if ($_FILES['profile_image']['name']) {
        $config['upload_path']    = 'uploads/profile';
        $config['allowed_types']  = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
        $config['encrypt_name']   = TRUE;
        $this->load->library('upload', $config);
            if (!$this->upload->do_upload('profile_image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cweb_setting'));
            } else {
            $data = $this->upload->data();
            $profile_image = $data['file_name'];
            $config['image_library']  = 'gd2';
            $config['source_image']   = $profile_image;
            $config['create_thumb']   = false;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 200;
            $config['height']         = 200;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $profile_image =  $profile_image;
            }
        }
        $data_empolyee['last_name'] = $this->input->post('last_name');
        $data_empolyee['designation'] = $this->input->post('designation');
        $data_empolyee['first_name'] = $this->input->post('first_name');
        $data_empolyee["middle_name"] = $this->input->post("middle_name");
        $data_empolyee['phone'] = $this->input->post('phone');
        $data_empolyee['employee_tax'] = $this->input->post('emp_tax_detail');
        $data_empolyee['employee_type'] = $this->input->post('employee_type');
        $data_empolyee['payroll_type'] = $this->input->post('payroll_type');
          $data_empolyee['choice'] = $this->input->post('choice');
        $data_empolyee['rate_type'] = $this->input->post('paytype');
        $data_empolyee['cty_tax'] = $this->input->post('citytx');
        $data_empolyee['email'] = $this->input->post('email');
        $data_empolyee['sc'] = $this->input->post('sc');
        $data_empolyee['hrate'] = $this->input->post('hrate');
        $data_empolyee['address_line_1'] = $this->input->post('address_line_1');
        $data_empolyee['address_line_2'] = $this->input->post('address_line_2');
        $data_empolyee['social_security_number'] = $this->input->post('ssn');
        $data_empolyee['routing_number'] = $this->input->post('routing_number');
      
        $data_empolyee['account_number'] = $this->input->post('account_number');
        $data_empolyee['bank_name'] = $this->input->post('bank_name');
        $data_empolyee['country'] = $this->input->post('country');
        $data_empolyee['city'] = $this->input->post('city');
        $data_empolyee['zip'] = $this->input->post('zip');
        $data_empolyee['state'] = $this->input->post('state');
        $data_empolyee['emergencycontact'] = $this->input->post('emergencycontact');
        $data_empolyee['emergencycontactnum'] = $this->input->post('emergencycontactnum');
        $data_empolyee['withholding_tax'] = $this->input->post('withholding_tax');
        $data_empolyee['last_name'] = $this->input->post('last_name');
        $data_empolyee['profile_image'] = $profile_image;
        $data_empolyee['create_by'] =$this->session->userdata('user_id');
        $data_empolyee['e_type'] = 1;
        
        
         // State Tax Information
        $state_tax = $this->input->post('state_tax');
        $living_state_tax = $this->input->post('living_state_tax');  
        if ($state_tax == $living_state_tax) {
             $data_empolyee['state_tx'] = $state_tax;
        } else {
             $data_empolyee['state_tx'] = $state_tax;
             $data_empolyee['living_state_tax'] = $living_state_tax;
        }
        
        // Local (City) Tax Information
        $city_tax = $this->input->post('city_tax');
        $living_city_tax = $this->input->post('living_city_tax');   
        if ($city_tax == $living_city_tax) {
             $data_empolyee['local_tax'] = $city_tax;
        } else {
             $data_empolyee['local_tax'] = $city_tax;
             $data_empolyee['living_local_tax'] = $living_city_tax;
        }
        
        //  City Tax Information
        $county_tax = $this->input->post('county_tax');
        $living_county_tax = $this->input->post('living_county_tax');   
        if ($county_tax == $living_county_tax) {
             $data_empolyee['cty_tax'] = $county_tax;
        } else {
             $data_empolyee['cty_tax'] = $county_tax;
            $data_empolyee['living_county_tax'] = $living_county_tax;
        }
        
        // Other Tax Info
        $other_working_tax = $this->input->post('other_working_tax');
        $other_living_tax = $this->input->post('other_living_tax');   
        
        if ($county_tax == $county_tax) {
             $data_empolyee['state_tax_1'] = $other_working_tax;
        } else {
             $data_empolyee['state_tax_1'] = $other_working_tax;
            $data_empolyee['state_tax_2'] = $other_living_tax;
        }
      $living_state_tax = $this->input->post('living_state_tax'); 
             $data_empolyee['edit_working_state'] = $state_tax;
             $data_empolyee['edit_living_state'] = $living_state_tax;
        
        
        // Local (City) Tax Information
        $city_tax = $this->input->post('city_tax');
        $living_city_tax = $this->input->post('living_city_tax');   
    
             $data_empolyee['edit_working_city'] = $city_tax;
             $data_empolyee['edit_living_city'] = $living_city_tax;
        
        
        //  City Tax Information
        $county_tax = $this->input->post('county_tax');
        $living_county_tax = $this->input->post('living_county_tax');   
    
             $data_empolyee['edit_working_county'] = $county_tax;
            $data_empolyee['edit_living_county'] = $living_county_tax;
        
        
        // Other Tax Info
        $other_working_tax = $this->input->post('other_working_tax');
        $other_living_tax = $this->input->post('other_living_tax');   
        
       
             $data_empolyee['edit_working_other'] = $other_working_tax;
            $data_empolyee['edit_living_other'] = $other_living_tax;
        
         
         
         
    }
       $this->db->insert('employee_history', $data_empolyee);
 
   //  echo $this->db->last_query();die();
 
       $this->session->set_flashdata('message', display('save_successfully'));
       redirect(base_url('Chrm/manage_employee'));
}







//     // Manage employee
   public function manage_employee() {


    $CI = & get_instance();

    $CI->load->model('Web_settings');
    $this->load->model('Hrm_model');

    $setting_detail = $CI->Web_settings->retrieve_setting_editdata();


     $data['title']            = display('manage_employee');
     $data['employee_list']    = $this->Hrm_model->employee_list();

     $data['employee_data_get']    = $this->Hrm_model->employee_data_get();
    
     $data['setting_detail']    = $setting_detail;


 
      $content                  = $this->parser->parse('hr/employee_list', $data, true);
    $this->template->full_admin_html_view($content);
    }


 public function employee_update_form($id)
    {
        $CI = &get_instance();
        $CI->load->model("Web_settings");
        $this->load->model("Hrm_model");
        $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $curn_info_default = $CI->db
            ->select("*")
            ->from("currency_tbl")
            ->where("icon", $currency_details[0]["currency"])
            ->get()
            ->result_array();
        $data["setting_detail"] = $setting_detail;
        $data["curn_info_default"] = $curn_info_default[0]["currency_name"];
        //  'curn_info_customer'=>$curn_info_customer[0]['currency_name'],
        $data["currency"] = $currency_details[0]["currency"];
        $data["get_info_city_tax"] = $this->Hrm_model->get_info_city_tax();
        $data["get_info_county_tax"] = $this->Hrm_model->get_info_county_tax();
        $data["title"] = display("employee_update");
        $data["employee_data"] = $this->Hrm_model->employee_editdata($id);
        //  print_r($data['employee_data']);.;
        $data["state_tx"] = $this->Hrm_model->state_tax();
        $data["cty_tax"] = $this->Hrm_model->state_tax();
        $data["designation"] = $this->db
            ->select("designation")
            ->from("designation")
            ->where("id", $data["employee_data"][0]["designation"])
            ->get()
            ->row()->designation;
        //  print_r($data['designation']);
        $data["payroll_data"] = $this->Hrm_model->payroll_editdata($id);
        $data["employeetype_data"] = $this->Hrm_model->employeestype_editdata(
            $id
        );
        $data["bank_data"] = $this->db
            ->select("*")
            ->from("bank_add")
            ->where("created_by", $this->session->userdata("user_id"))
            ->get()
            ->result_array();
        $data["desig"] = $this->Hrm_model->designation_dropdown();
        $content = $this->parser->parse("hr/employee_updateform", $data, true);
        $this->template->full_admin_html_view($content);
    }

    public function update_employee()
    {
        $this->load->model("Hrm_model");
        // print_r($_FILES); die();

        if (isset($_FILES["files"]) && is_array($_FILES["files"]["name"])) {
            $no_files = count($_FILES["files"]["name"]);
            for ($i = 0; $i < $no_files; $i++) {
                if ($_FILES["files"]["error"][$i] > 0) {
                    echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
                } else {
                    move_uploaded_file(
                        $_FILES["files"]["tmp_name"][$i],
                        "uploads/employeedetails/" . $_FILES["files"]["name"][$i]
                    );
                    $images[] = $_FILES["files"]["name"][$i];
                    $insertImages = implode(", ", $images);
                }
            }
        } else {
            echo "No files uploaded or invalid file structure.";
        }
        if ($_FILES["profile_image"]["name"]) {
            $config["upload_path"] = "uploads/profile";
            $config["allowed_types"] = "gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG";
            $config["encrypt_name"] = true;
            $config["max_size"] = 2048;
            $this->load->library("upload", $config);
            if (!$this->upload->do_upload("profile_image")) {
                $error = ["error" => $this->upload->display_errors()];
                $this->session->set_userdata([
                    "error_message" => $this->upload->display_errors(),
                ]);
                redirect(base_url("Chrm"));
            } else {
                $data = $this->upload->data();
                $profile_image = $data["file_name"];
                $config["image_library"] = "gd2";
                $config["source_image"] = $profile_image;
                $config["create_thumb"] = false;
                $config["maintain_ratio"] = true;
                $config["width"] = 200;
                $config["height"] = 200;
                $this->load->library("image_lib", $config);
                $this->image_lib->resize();
                $profile_image = $profile_image;
            }
        }
        $headname =
            $this->input->post("id", true) .
            "-" .
            $this->input->post("old_first_name", true) .
            "" .
            $this->input->post("old_middle_name", true) .
            "" .
            $this->input->post("old_last_name", true);
        $emp_data = [
            "id" => $this->input->post("id", true),
            "employee_type" => $this->input->post("employee_type", true),
        ];
        $pay_data = [
            "id" => $this->input->post("id", true),
            "payroll_type" => $this->input->post("payroll_type", true),
        ];

        // State Tax Information
        $state_tax = $this->input->post("state_tax");
        $living_state_tax = $this->input->post("living_state_tax");
        $data_employee["state_tx"] = $state_tax;
        if ($state_tax != $living_state_tax) {
            $data_employee["living_state_tax"] = $living_state_tax;
        }

        // Local (City) Tax Information
        $city_tax = $this->input->post("city_tax");
        $living_city_tax = $this->input->post("living_city_tax");
        $data_employee["local_tax"] = $city_tax;
        if ($city_tax != $living_city_tax) {
            $data_employee["living_local_tax"] = $living_city_tax;
        }

        // County Tax Information
        $county_tax = $this->input->post("county_tax");
        $living_county_tax = $this->input->post("living_county_tax");
        $data_employee["cty_tax"] = $county_tax;
        if ($county_tax != $living_county_tax) {
            $data_employee["living_county_tax"] = $living_county_tax;
        }

        // Other Tax Info
        $other_working_tax = $this->input->post("other_working_tax");
        $other_living_tax = $this->input->post("other_living_tax");
        $data_employee["state_tax_1"] = $other_working_tax;
        if ($other_working_tax != $other_living_tax) {
            // This condition seems to be intended here
            $data_employee["state_tax_2"] = $other_living_tax;
        }

        $data_employee["edit_working_state"] = $state_tax;
        $data_employee["edit_living_state"] = $living_state_tax;

        // Local (City) Tax Information
        $city_tax = $this->input->post("city_tax");
        $living_city_tax = $this->input->post("living_city_tax");

        $data_employee["edit_working_city"] = $city_tax;
        $data_employee["edit_living_city"] = $living_city_tax;

        //  City Tax Information
        $county_tax = $this->input->post("county_tax");
        $living_county_tax = $this->input->post("living_county_tax");

        $data_employee["edit_working_county"] = $county_tax;
        $data_employee["edit_living_county"] = $living_county_tax;

        // Other Tax Info
        $other_working_tax = $this->input->post("other_working_tax");
        $other_living_tax = $this->input->post("other_living_tax");

        $data_employee["edit_working_other"] = $other_working_tax;
        $data_employee["edit_living_other"] = $other_living_tax;

        // Assuming the rest of the $postData array is being filled correctly
        $postData = [
            "id" => $this->input->post("id", true),
            "first_name" => $this->input->post("first_name", true),
            "middle_name" => $this->input->post("middle_name", true),
            "last_name" => $this->input->post("last_name", true),
            "designation" => $this->input->post("designation", true),
            "phone" => $this->input->post("phone", true),
            "files" => !empty($insertImages)
                ? $insertImages
                : $this->input->post("old_image", true),
            "rate_type" => $this->input->post("paytype", true),
            "sc" => $this->input->post("sc", true),
            "email" => $this->input->post("email", true),
            "employee_tax" => $this->input->post("emp_tax_detail", true),
            "social_security_number" => $this->input->post("ssn", true),
            "routing_number" => $this->input->post("routing_number", true),
            "hrate" => $this->input->post("hrate", true),
            "address_line_1" => $this->input->post("address_line_1", true),
            "address_line_2" => $this->input->post("address_line_2", true),
            "country" => $this->input->post("country", true),
            "city" => $this->input->post("city", true),
            "zip" => $this->input->post("zip", true),
            "state" => $this->input->post("state", true),
            "emergencycontact" => $this->input->post("emergencycontact", true),
            "emergencycontactnum" => $this->input->post(
                "emergencycontactnum",
                true
            ),
            "profile_image" => !empty($profile_image)
                ? $profile_image
                : $this->input->post("old_profileimage", true),
            "payroll_type" => $this->input->post("payroll_type"),
        ];

        // Merge tax data into postData
        $postData = array_merge($postData, $data_employee);

        //  print_r($postData);.;
        if (
            $this->Hrm_model->update_employee(
                $postData,
                $headname,
                $emp_data,
                $pay_data
            )
        ) {
            $this->session->set_flashdata(
                "message",
                display("successfully_updated")
            );
        } else {
            $this->session->set_flashdata(
                "error_message",
                display("please_try_again")
            );
        }
        redirect("Chrm/manage_employee");
    }
public function form1099nec()
    {
        $CI = &get_instance();
        $this->load->model("Hrm_model");
        $data = array(
          'title' => '1099 NECForm'
        );
        $content = $CI->parser->parse("hr/1099necform", $data, true);
        $this->template->full_admin_html_view($content);
    }

  public function w4form()
    {
        $CI = &get_instance();
        $this->load->model("Hrm_model");
        $company_name = $this->db->select('*')->from('company_information')->where("create_by",$this->session->userdata('user_id'))->get()->result_array();
        // print_r($company_name);
        $data = array(
          'title' => 'w4form',
          'c_name' => $company_name
        );
        $content = $CI->parser->parse("hr/w4_form", $data, true);
        $this->template->full_admin_html_view($content);
    }
// w9 Form
    public function w9form()
    {
        $CI = &get_instance();
        $this->load->model("Hrm_model");
        $data = array(
          'title' => 'w9form',
        );
        $content = $CI->parser->parse("hr/w9_form", $data, true);
        $this->template->full_admin_html_view($content);
    }




    public function employee_details($id) {
    $CI = & get_instance();

    $CI->load->model('Web_settings');
    $this->load->model('Hrm_model');

    $setting_detail = $CI->Web_settings->retrieve_setting_editdata();

    $data['setting_detail']            = $setting_detail;

     $data['title']            = display('employee_update');
     $data['row']              = $this->Hrm_model->employee_detl($id);
      $content                  = $this->parser->parse('hr/resumepdf', $data, true);
     $this->template->full_admin_html_view($content);
    }

  // create employee
  public function create_employee(){
    $this->load->model('Hrm_model');
  $this->form_validation->set_rules('first_name',display('first_name'),'required|max_length[100]');
  $this->form_validation->set_rules('last_name',display('last_name'),'required|max_length[100]');
  $this->form_validation->set_rules('designation',display('designation'),'required|max_length[100]');
  $this->form_validation->set_rules('phone',display('phone'),'max_length[20]');
  // $this->form_validation->set_rules('hrate',display('salary1'),'max_length[20]');
  $this->form_validation->set_rules('employee_type', 'Employee Type', 'required');
$this->form_validation->set_rules('emp_tax_detail', 'Employee Tax Detail', 'required');
$this->form_validation->set_rules('in_department', 'In Department', 'required');
    #-------------------------------#
    if ($this->form_validation->run()) {
     if ($_FILES['image']['name']) {
        $config['upload_path'] = 'assets/images/employee/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = "*";
        $config['max_width'] = "*";
        $config['max_height'] = "*";
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
            // redirect(base_url('Chrm/add_employee'));
        } else {
            $image = $this->upload->data();
            $image_url = base_url() . "assets/images/employee/" . $image['file_name'];
        }
    }
     $postData = [
            'first_name'    => $this->input->post('first_name',true),
            'last_name'     => $this->input->post('last_name',true),
            'designation'   => $this->input->post('designation',true),
            'phone'         => $this->input->post('phone',true),
            'files'         => $image_url,
            'rate_type'     => $this->input->post('rate_type',true),
            'payroll_type'     => $this->input->post('payroll_type',true),
            'cty_tax'     => $this->input->post('citytx',true),
            'email'         => $this->input->post('email',true),
            'hrate'         => $this->input->post('hrate',true),
            'address_line_1'=> $this->input->post('address_line_1',true),
            'address_line_2'=> $this->input->post('address_line_2',true),
            'state_local_tax'=> $this->input->post('state_local_tax',true),
            'local_tax'=> $this->input->post('local_tax',true),
            'state_tx'=> $this->input->post('state_tx',true),
            // 'blood_group'   => $this->input->post('blood_group',true),
            'social_security_number'   => $this->input->post('social_security_number',true),
            'routing_number'   => $this->input->post('routing_number',true),
            'country'       => $this->input->post('country',true),
            'city'          => $this->input->post('city',true),
            'zip'           => $this->input->post('zip',true),
        ];
        // pritn
         if ($this->Hrm_model->create_employee($postData)) {
            $this->session->set_flashdata('message', display('save_successfully'));
             redirect("Chrm/manage_employee");
        } else {
            $this->session->set_flashdata('error_message',  display('please_try_again'));
             redirect("Chrm/manage_employee");
        }
          } else {
               echo validation_errors();
          //  $this->session->set_flashdata('error_message',  display('please_try_again'));
            // redirect("Chrm/add_employee");
        }
    }


    
    public function w2Form($id = null)
{
    if ($id) {
    }
    $employee_ids = $this->input->post('employee_ids');
 
    $CI = & get_instance();
    $this->load->model('Hrm_model');
    $this->load->model('Web_settings');
    $currency_details = $CI->Web_settings->retrieve_setting_editdata();
    $curn_info_default = $CI->db->select('*')->from('currency_tbl')->where('icon',$currency_details[0]['currency'])->get()->result_array();
    $employee_details = $this->Hrm_model->employeeDetailsdata($id);
    $data['get_cdata'] = $this->Hrm_model->get_employer_federaltax();
    $get_cominfo = $this->Hrm_model->get_company_info();
    $fed_tax = $this->Hrm_model->getoveralltaxdata($id);
    $get_payslip_info = $this->Hrm_model->w2get_payslip_info($id);

     $state_taxtype = $this->Hrm_model->tax_statecode_info($id);

     $other_tx1=$this->Hrm_model->getother_tax($id);   
  
     $get_payslipalldata = $this->Hrm_model->w2get_payslip_alldata($id);


     $state_tax = $this->Hrm_model->w2total_state_tax($id);
     $state_taxworking = $this->Hrm_model->w2totalstatetaxworking($id);

     $county_tax = $this->Hrm_model->getcounty_tax($id);
      
       
     $local_tax = $this->Hrm_model->w2total_local_tax($id);
     $livinglocaldata = $this->Hrm_model->w2total_livinglocaldata($id);
 
     $gettaxother_info = $this->Hrm_model->gettaxother_info($id);
     
     $company_details = $CI->db->select('*')->from('company_information')->where('company_id',$this->session->userdata('user_id'))->get()->result_array();
    //  print_r($company_details); .;
      
    $data = array(
      'title' => 'W2 Form',
      'getlocation' => $get_cominfo,
      'gettaxdata' => $fed_tax,
      'curn_info_default' =>$curn_info_default[0]['currency_name'],
      'currency'  =>$currency_details[0]['currency'],
      'other_tx'  => $other_tx1,
      'countyTax' => $county_tax,
      'stateTax' => $state_tax,
      'e_details' => $employee_details,
      'stateworkingtax' => $state_taxworking,
      'localTax' => $local_tax,
      'StatetaxType' => $state_taxtype,
      'c_details' => $company_details,

      'get_payslip_info' => $get_payslip_info,

      'livinglocaldata' => $livinglocaldata,

    'gettaxother_info' => $gettaxother_info,

    );
   
      // print_r($data);  

    $content = $CI->parser->parse('hr/w2_taxform', $data, true);
    $this->template->full_admin_html_view($content);
}



 









public function formw3Form()
{
    $CI = & get_instance();
    $this->load->model('Hrm_model');
    $get_cominfo = $this->Hrm_model->get_company_info();
    $get_payslip_info = $this->Hrm_model->get_payslip_info();
    $total_state_tax = $this->Hrm_model->total_state_tax();
    $get_sc_info = $this->Hrm_model->get_sc_info();
    $sum_of_weekly_array = $this->Hrm_model->sum_of_weekly();
    $sum_of_hourly_array = $this->Hrm_model->sum_of_hourly();
    $sum_of_biweekly_array = $this->Hrm_model->sum_of_biweekly();
    $sum_of_monthly_array = $this->Hrm_model->sum_of_monthly();
    
    
    $sum_of_working_array = $this->Hrm_model->sum_of_workingstatetax();
    $sum_of_living_array = $this->Hrm_model->sum_of_livingstatetax();
    
    $sum_of_weekly = !empty($sum_of_weekly_array) ? $sum_of_weekly_array[0]['weekly'] : 0;
    $sum_of_hourly = !empty($sum_of_hourly_array) ? $sum_of_hourly_array[0]['amount'] : 0;
    $sum_of_biweekly = !empty($sum_of_biweekly_array) ? $sum_of_biweekly_array[0]['biweekly'] : 0;
    $sum_of_monthly = !empty($sum_of_monthly_array) ? $sum_of_monthly_array[0]['monthly'] : 0;
    
    $living_st = !empty($sum_of_living_array) ? $sum_of_living_array[0]['totalamount'] : 0;
    $working_st = !empty($sum_of_working_array) ? $sum_of_working_array[0]['totalamount'] : 0;
    
    // $total_sum = $sum_of_weekly + $sum_of_hourly + $sum_of_biweekly + $sum_of_monthly;
    
    $total_sum = $working_st + $living_st ;

    $total_local_tax = $this->Hrm_model->total_local_tax();
    $employeer_details = $this->Hrm_model->employeerDetailsdata();
    $get_employer_federaltax = $this->Hrm_model->get_employer_federaltax();
    $get_total_customersData = $this->Hrm_model->get_total_customersData();
    //print_r($get_total_customersData);die();
    $data = array(
            'title' => 'W3 Form',
            'get_cominfo' => $get_cominfo,
            'get_payslip_info' => $get_payslip_info,
            'employeer' => $employeer_details,
            'total_state_tax' => $total_sum,
            'total_local_tax' => $total_local_tax,
            'get_employer_federaltax' => $get_employer_federaltax,
            'get_total_customersData' => $get_total_customersData,
            'get_sc_info' => $get_sc_info,
    );
     $content = $CI->parser->parse('hr/w3_taxform', $data, true);
    $this->template->full_admin_html_view($content);
}

 
public function sc_cnt()
{
    $CI = & get_instance();
    $this->load->model('Hrm_model');
    $employeeId = $this->input->post('employeeId',TRUE);
        $reportrange = $this->input->post('reportrange',TRUE);
     $data['sc']=$this->Hrm_model->sc_info_count($employeeId,$reportrange);
 echo json_encode($data['sc']);
   
} 







public function form940Form()
{
    $CI = & get_instance();
    $this->load->model('Hrm_model');
    $data['get_cominfo'] = $this->Hrm_model->get_company_info();
    
 
    $data['get_cdata'] = $this->Hrm_model->get_employer_federaltax();
    $data['get_sc_info']  = $this->Hrm_model->get_sc_info();
    $data['get_paytotal'] = $this->Hrm_model->get_paytotal();
    $data['get_userlist'] = $CI->db->select('*')->from('users')->where('user_id',$this->session->userdata('user_id'))->get()->result_array();
    $data['amountGreaterThan'] = $CI->db
    ->select('SUM(total_amount) AS totalAmount')
    ->from('info_payslip')
    ->where('total_amount >', 7000)
    ->where('create_by', $CI->session->userdata('user_id'))
    ->get()
    ->row_array(); // Using row_array() if expecting a single result or result_array() for multiple results.
    if (!empty($data['amountGreaterThan']['totalAmount'])) {
      // If there's a sum, it will be stored in 'totalAmount'.
      $totalAmount = $data['amountGreaterThan']['totalAmount'];
  } else {
      // Handle the case where there's no sum calculated (e.g., no matching records).
      $totalAmount = 0;
  }
    $data = array(
      'title' => '940 Form',
      'get_cominfo' => $data['get_cominfo'],
      'get_cdata' => $data['get_cdata'], 
      'get_paytotal' => $data['get_paytotal'], 
      'get_userlist' => $data['get_userlist'], 
      'amountGreaterThan' => $data['amountGreaterThan'], 
      'get_sc_info' => $data['get_sc_info'],
    );
 
    $content = $CI->parser->parse('hr/f940', $data, true);
    $this->template->full_admin_html_view($content);
}
 



















 
public function form941Form($selectedValue = null)
{
    
  
  
    $CI = &get_instance();
    $this->load->model('Hrm_model');
    // Load data from the model
    $data['get_cdata'] = $this->Hrm_model->get_employer_federaltax();
    $data['get_cominfo'] = $this->Hrm_model->get_company_info();
    $data['fed_tax'] = $this->Hrm_model->social_tax();
$data['tat'] = $this->Hrm_model->so_total_amount($selectedValue);

$total = 0;

foreach ($data['tat'] as $item) {
    $total += $item['tamount'];
}
//echo $total;
$data['tamount']=$total;
    $data['get_userlist'] = $CI->db->select('*')->from('users')->where('user_id',$this->session->userdata('user_id'))->get()->result_array();

    $data['tif'] = $this->Hrm_model->get_taxinfomation($selectedValue);
    $data['get_941_sc_info'] = $this->Hrm_model->get_941_sc_info($selectedValue);

   $data['gt'] = $CI->db->select('COUNT(DISTINCT templ_name) AS count_rows')
    ->from('timesheet_info')
    ->where('quarter', $selectedValue)
     ->where('create_by', $this->session->userdata('user_id'))
     ->where('payroll_type !=', 'Sales Partner') 
    ->get()
    ->row()->count_rows;
 // echo $this->db->last_query();
    $view_data = array(
        'title' => '941 Form',
        'tamount' => $data['tamount'],
        'get_cdata' => $data['get_cdata'], 
        'get_cominfo' => $data['get_cominfo'],
        'tif' => $data['tif'],
        'get_userlist' => $data['get_userlist'], 
        'gt' => $data['gt'], 
        'get_941_sc_info' => $data['get_941_sc_info'],
        'selectedValue' => $selectedValue ,

    );
 //print_r($data['gt']['count_rows']);
    $content = $CI->parser->parse('hr/f941', $view_data, true);
    $this->template->full_admin_html_view($content);
}






// Federal Tax Form 
public function form942Form()
{
    $CI = & get_instance();
    $this->load->model('Hrm_model');
    $data['get_cdata'] = $this->Hrm_model->get_employer_federaltax();
    $data['get_cominfo'] = $this->Hrm_model->get_company_info();
    $data['tif'] = $this->Hrm_model->get_taxinfomation_old();
    $data['get_userlist'] = $CI->db->select('*')->from('users')->where('user_id',$this->session->userdata('user_id'))->get()->result_array();
    $data['fed_tax'] = $this->Hrm_model->social_tax();
    $data['get_payslip_info'] = $this->Hrm_model->get_payslip_info();
    $currency_details = $CI->Web_settings->retrieve_setting_editdata();
    $curn_info_default = $CI->db->select('*')->from('currency_tbl')->where('icon',$currency_details[0]['currency'])->get()->result_array();
    $data['currency'] = $currency_details[0]['currency'];
    $content = $CI->parser->parse('hr/f942', $data, true);
    $this->template->full_admin_html_view($content);
} 



public function manage_workinghours()
    {
        $CI = &get_instance();
        $CI->load->model("Web_settings");
        $this->load->model("Hrm_model");
        $w_hourdata = $this->db->select('*')->from('working_time')->where('created_by', $this->session->userdata('user_id'))->get()->result_array();
        $data = array(
          'title'=> 'Manage Working Hours',
          'w_data' => $w_hourdata
        );
        $content = $this->parser->parse("hr/workinghour_list", $data, true);
        $this->template->full_admin_html_view($content);
    }



    public function working_hours()
    {
        $CI = &get_instance();
        $this->load->model("Hrm_model");
        $data = array(
          'title' => 'Working Hours'
        );
        $content = $CI->parser->parse("hr/setworking_hours", $data, true);
        $this->template->full_admin_html_view($content);
    }


    public function insertworking_hours()
    {
        $hour_rate = $this->input->post('work_hour');
        $exhour_rate = $this->input->post('extra_workamount');
        $data = array(
          'work_hour' => $hour_rate,
          'extra_workamount' => $exhour_rate,
          'created_by' => $this->session->userdata('user_id')
        );
        $this->db->insert("working_time", $data);
        $this->session->set_flashdata("message", display("save_successfully"));
        redirect(base_url("Chrm/working_hours"));
    }

  
    public function UC_2a_form($quarter = null)
    {
        $CI = &get_instance();
        $this->load->model("Hrm_model");
        $data['get_cominfo'] = $this->Hrm_model->get_company_info();
        $data['info_for_nj'] = $this->Hrm_model->info_for_nj($quarter);
        $data['overall_amount'] = $this->Hrm_model->total_amountofthis_qt($quarter);
        $content = $CI->parser->parse("hr/uc_2aform.php", $data, true);
        $this->template->full_admin_html_view($content);
    }

 
}
