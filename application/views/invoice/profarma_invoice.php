<!-- Product Purchase js -->
<?php    ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="<?php echo base_url() ?>my-assets/js/countrypicker.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>my-assets/js/admin_js/product_country.js" type="text/javascript"></script>
<style>
   .ui-selectmenu-text{
   display:none;
   }
   /*   Bootstrap Country Select CSS  */
   button[data-toggle="dropdown"].btn-default,
   button[data-toggle="dropdown"]:hover {
   background-color: white !important;
   color: #2c3e50 !important;
   border: 2px solid #dce4ec;
   }
   .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
   width: 420px;
   }
   tfoot tr{
   height: 45px;
   }
   .btnclr{
   background-color:<?php echo $setting_detail[0]['button_color']; ?>;
   color: white;
   }
   .logo-9 i{
   font-size:80px;
   position:absolute;
   z-index:0;
   text-align:center;
   width:100%;
   left:0;
   top:-10px;
   color:#34495e;
   -webkit-animation:ring 2s ease infinite;
   animation:ring 2s ease infinite;
   }
   .logo-9 h1{
   font-family: 'Lora', serif;
   font-weight:600;
   text-transform:uppercase;
   font-size:40px;
   position:relative;
   z-index:1;
   color:#e74c3c;
   text-shadow: 3px 3px 0 #fff, -3px -3px 0 #fff, 3px -3px 0 #fff, -3px 3px 0 #fff;
   }
   .logo-9{
   position:relative;
   } 
   /*//side*/
   .bar {
   float: left;
   width: 25px;
   height: 3px;
   border-radius: 4px;
   background-color: #4b9cdb;
   }
   .load-10 .bar {
   animation: loadingJ 2s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
   }
   @keyframes loadingJ {
   0%,
   100% {
   transform: translate(0, 0);
   }
   50% {
   transform: translate(80px, 0);
   background-color: #f5634a;
   width: 120px;
   }
   }
   #details {
   width: 1457px;
   height: 106px;
   }
   #remarks{
   width: 1457px;
   height: 106px;
   }
   
   @media (min-width: 768px){
       .mobile_icon{
           position: relative;
           right: 24px;
       }
   }
   
   
    .ads{
   max-width: 0px !important;
   white-space: nowrap;
   overflow: hidden;
   text-overflow: ellipsis;
   }

   
   
</style>
<!-- Add New Purchase Start -->
<div class="content-wrapper">
<section class="content-header">
   <div class="header-icon">
      <figure class="one">
      <img src="<?php echo base_url()  ?>asset/images/quota.png"  class="headshotphoto" style="height:50px;" />
   </div>
   <div class="header-title">
      <div class="logo-holder logo-9">
         <h1>Create Estimate</h1>
      </div>
      <small></small>
      <ol class="breadcrumb" style="border: 3px solid #d7d4d6;">
         <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
         <li><a href="#"><?php echo display('Sale') ?></a></li>
         <li class="active" style="color:orange;"><?php echo 'Create Estimate' ?></li>
         <div class="load-wrapp">
            <div class="load-10">
               <div class="bar"></div>
            </div>
         </div>
      </ol>
   </div>
</section>
<section class="content">
   <!-- Alert Message -->
   <?php
      $message = $this->session->userdata('message');
      if (isset($message)) {
      ?>
   <div class="alert alert-info alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
      <?php echo $message ?>                    
   </div>
   <?php 
      $this->session->unset_userdata('message');
      }
      $error_message = $this->session->userdata('error_message');
      if (isset($error_message)) {
      ?>
   <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $error_message ?>                    
   </div>
   <?php 
      $this->session->unset_userdata('error_message');
      }
      ?>
   <style>
      /*     .removebundle, .addbundle{*/
      /*    padding:5px;*/
      /*    border-radius:5px;*/
      /*}*/
      .removebundle, .addbundle{
      padding: 10px 12px 10px 12px;
      border-radius:5px;
      }
      .ui-front{
      display:none;
      } 
      input {
      border: none;
      }
      textarea:focus, input:focus{
      outline: none;
      }
      .text-right {
      text-align: left; 
      }
      #block_container
      {height:40px;
      text-align:center;
      }
      th{
      font-size:12px;
      }
      #bloc1, #bloc2
      {text-align:center;
      font-weight:bold;
      display:inline;
      }
      .input-symbol-euro {
      position: absolute;
      font-size: 14px;
      }
      .input-symbol-euro input {
      padding-left: 18px;
      }
      .input-symbol-euro:after {
      position: absolute;
      top: 7px;
      content: '<?php echo $currency; ?>';
      left: 5px;
      }
   </style>
   <?php    $payment_id=rand(); ?>
   <form id="histroy" style="display:none;" method="post" >
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
      <input type="hidden"  value="<?php echo $payment_id; ?>" name="payment_id" class="payment_id" id="payment_id"/>
      <input type="submit" id="payment_history" name="payment_history" class="btn" style="float:right;" value="Payment History" style="float:right;margin-bottom:30px;"/>
   </form>
   <!-- Purchase report -->
   <div class="row">
   <div class="col-sm-12">
   <div class="panel panel-bd lobidrag"    style="border: 3px solid #d7d4d6;"        >
   <div class="panel-heading">
      <div class="panel-title">
         <div id="block_container">
            <div id="bloc1" style="float:left;">
               <h4><?php //echo "Create Quote" ?></h4>
            </div>
            <div id="bloc2" style="float:right;">
               <?php //if($this->permission1->method('manage_invoice','read')->access()){ ?>
               <a  href="<?php echo base_url('Cinvoice/manage_profarma_invoice') ?>" class="btnclr btn  m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo 'Manage Estimate' ?> </a>
               <?php// }?>
            </div>
         </div>
      </div>
   </div>
   <div class="panel-body">
   <form id="insert_trucking"  method="post">
      <div class="row">





      <div class="col-sm-6">
            <div class="form-group row">
               <label for="adress" class="col-sm-4 col-form-label"><?php echo display('customer_name') ?>
               </label>
               <div class="col-sm-8">


               <input type="text" tabindex="3" class="form-control" name="customer_id"  style="border: 2px solid #d7d4d6;" id="customer_id"     />

                  <!-- <select name="customer_id" id="customer_id" style="border: 2px solid #d7d4d6;"  class="form-control">
                     <option value="Select the Customer" selected disabled><?php echo display('Select the Customer') ?></option>
                     <?php foreach($customer as $customer){ ?>
                     <option value="<?=$customer['customer_id']; ?>"><?=$customer['customer_name']; ?></option>
                     <?php } ?>
                  </select> -->


               </div>
        
            </div>
         </div>


         <div class="col-sm-6">
            <div class="form-group row">
               <label for="date" class="col-sm-4 col-form-label"><?php echo display('date') ?>
               <i class="text-danger">  </i>
               </label>
               <div class="col-sm-8">
                  <?php $date = date('Y-m-d'); ?>
                  <input type="date" required tabindex="2" class="form-control datepicker"  name="purchase_date" value="<?php echo $date; ?>" id="date" style="border: 2px solid #d7d4d6;width:100%" > 
               </div>
            </div>
         </div>

 


      </div>






      <div class="row">

      <div class="col-sm-6">
            <div class="form-group row">
               <label for="eta" class="col-sm-4 col-form-label"><?php echo display('Billing Address') ?>
               </label>
               <div class="col-sm-8">
                  <textarea class="form-control" tabindex="4" id="eta" name="receipt"   rows="1"    style="border: 2px solid #d7d4d6;width:100%"  ></textarea>
               </div>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group row">
               <label for="invoice_no" class="col-sm-4 col-form-label"><?php echo display('invoice_no')?>
               <i class="text-danger"></i>
               </label>
               <div class="col-sm-8">
                  <input type="text" tabindex="3" style="border: 2px solid #d7d4d6;"    class="form-control" id="chalan_no" readonly name="chalan_no" value="<?php 
                  if (!empty($voucher_no[0]["voucher"])) {
                     $curYear = date("y");
                     $month = date("m");
                     $date = date("d");
                     if($getEstimateCount > 0){
                     $vn = substr($voucher_no[0]["voucher"], 9) + 1;
                     echo $voucher_n = "LS" . $curYear . $month . $date . "-" . $vn;
                    }else{
                    $curYear = date("y");
                    $month = date("m");
                    $date = date("d");
                    echo $voucher_n = "LS" . $curYear . $month . $date . "-" . "5";
                    }
                  } else {
                     $curYear = date("y");
                     $month = date("m");
                     $date = date("d");
                     echo $voucher_n = "LS" . $month . $date . $curYear . "-" . "5";
                  } ?>"  />
               </div>
            </div>
         </div>
      
      </div>





      <input type="hidden"  value="<?php echo $payment_id; ?>"  name="payment_id"/>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
      <input type="hidden" id="invoice_hdn"/> <input type="hidden" id="invoice_hdn1"/>
      <div class="row">
         <div class="col-sm-6">
            <div class="form-group row">
               <label for="etd" class="col-sm-4 col-form-label"><?php echo  ('Phone No') ?>
               <i class="text-danger"></i>
               </label>
               <div class="col-sm-8">
                  <input type="number" tabindex="3" class="form-control" name="pre_carriage"  style="border: 2px solid #d7d4d6;" id="pre_carriage"  />
               </div>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group row">
               <label for="bl_number" class="col-sm-4 col-form-label"><?php echo ('Payment Type') ?>
               <i class="text-danger"></i>
               </label>
               <div class="col-sm-8">
                  <input type="text"  name="description_goods" class="form-control" style="border: 2px solid #d7d4d6;"    id="goods"> 
               </div>
            </div>
         </div>
      </div>

 
      <br>
      <div class="table-responsive">
         <div id="content">
            <table class="cscheTable  table normalinvoice table-bordered table-hover" id="normalinvoice_1" style="border: 2px solid #d7d4d6;" >
               <thead>
                  <tr>
                     <th rowspan="2" class="text-center"   ><?php echo display('product_name')?><i class="text-danger"></i>  &nbsp;&nbsp; </th>
                     <!-- <th rowspan="2" class="text-center" style="width:60px;"><?php echo display('Bundle No')?><i class="text-danger">*</i></th> -->
                     <th rowspan="2"  class="text-center"><?php echo display('Description')?></th>
                     <th rowspan="2" class="text-center"  ><?php echo ('Quantity')?><i class="text-danger"></i></th>
                     <th rowspan="2" class="text-center"><?php echo ('Rate')?><i class="text-danger"></i></th>
                     <!-- <th rowspan="2" class="text-center" ><?php echo display('Supplier Slab No')?><i class="text-danger">*</i> </th>
                     <th colspan="2"   style="width:150px;" class="text-center"><?php echo display('Gross Measurement')?><i class="text-danger">*</i> </th>
                     <th rowspan="2" class="text-center"><?php echo display('Gross Sq.Ft')?></th>
                     <th rowspan="2" style="width:40px;" class="text-center"><?php echo display('Slab No')?><i class="text-danger">*</i></th>
                     <th colspan="2"  style="width:150px;" class="text-center"><?php echo display('Net Measure')?><i class="text-danger">*</i></th>
                     <th rowspan="2" class="text-center"><?php echo display('Net Sq. Ft')?></th>
                     <th rowspan="2"  style="width:90px;" class="text-center"><?php echo display('Cost per Sq.Ft')?></th>
                     <th rowspan="2"  style="width:90px;" class="text-center"><?php echo display('Cost per Slab')?></th>
                     <th rowspan="2"  style="width:90px;" class="text-center"><?php echo display('Sales Price per Sq.Ft')?></th>
                     <th rowspan="2"  style="width:90px;" class="text-center"><?php echo display('Sales Slab Price')?></th>
                     <th rowspan="2" class="text-center"><?php echo display('Weight')?></th> -->
                     <th rowspan="2"  style="width:218px;" class="text-center"><?php echo display('Total')?></th>
                     <th rowspan="2" class="text-center"><?php echo display('Action')?></th>
                  </tr>
                  
               </thead>
   
               <tbody id="addPurchaseItem_1">
                  <tr>
                     <td>
                        <input type="hidden" class='tableid' name="tableid[]"  id="tableid_1" value='1'/>
                        <input list="magicHouses" name="prodt[]" id="prodt_1"  class="form-control product_name"  onchange="this.blur();"  placeholder="Search Product" />
            
                         <input type='hidden' class='common_product autocomplete_hidden_value  product_id_1' name='product_id[]' id='SchoolHiddenId_1' />
                     </td>
                     
                     <td>
                        <input type="text" id="description_1" name="description[]" class="form-control" />
                     </td>
                     <td >
                        <input type="text" name="thickness[]" id="thickness_1"   class="thickness form-control"/>
                     </td>
                     <td>
                        <input type="text" id="supplier_b_no_1" name="supplier_block_no[]"   class="supplier_slab_no form-control" />
                     </td>
                   
 
                     <td >
                        <span class="input-symbol-euro"><input  type="text" class="total_price form-control"  placeholder="0.00"  readonly   id="total_amt_1"     name="total_amt[]"/></span>
                     </td>


                     <td style="text-align:center;">
                        <!-- <button  class='delete btn btn-danger' id="delete_1" type='button' value='Delete'><i class="fa fa-trash"></i></button> -->
                    
                        <button class='btn-cSche add addRowButton btn btnclr' type='button' value='Add Row'><i class="fa fa-plus"></i></button>
                &nbsp;<button class='delete btn btn-danger' type='button' value='Delete'><i class="fa fa-trash"></i></button>

                    
                     </td>
                  </tr>
               </tbody>
               <tfoot>
                  <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>

         
                     <td >
                        <span class="input-symbol-euro">    <input type="text" id="Total_1" name="total"   class="b_total form-control"    value="0.00"  readonly="readonly"  /> </span>
                     </td>
                  </tr>
               </tfoot>
            </table>
            <!--<i id="buddle_1" class="addbundle fa fa-plus" style="float:right;color:white;background-color: #38469f; font-size:24px; " aria-hidden="true" onclick="addbundle(); "></i>  -->
            <!--<i id="buddle_1" class="btnclr addbundle fa fa-plus" style=" padding: 10px 12px 10px 12px;margin-right: 18px;float:right; "   onclick="addbundle(); "aria-hidden="true"></i>-->
         </div>
         <table class="taxtab table table-bordered table-hover"    style="border: 2px solid #d7d4d6;"     >
            <tr>
              
               <td style="width: 76%;border:none;text-align:right;font-weight:bold;"><?php echo display('Tax') ?> : 
               </td>
               <td style="width:12%">
                  <input list="magic_tax" name="tx"  id="product_tax" class="form-control"   onchange="this.blur();" />
                  <datalist id="magic_tax">
                     <?php                                
                        foreach($profarma_data as $tx){?>
                     <option value="<?php echo $tx['tax_id'].'-'.$tx['tax'].'%';?>">  <?php echo $tx['tax_id'].'-'.$tx['tax'].'%';  ?></option>
                     <?php } ?>
                  </datalist>
               </td>
               <td ><a href="#" class="client-add-btn btn btnclr" aria-hidden="true"   data-toggle="modal" data-target="#proforma_taxinfo" ><i class="fa fa-plus"></i></a></td>
            </tr>
         </table>
         <table border="0"   class="overall table table-bordered table-hover" style="border: 2px solid #d7d4d6;table-layout: auto;" >
            <tr>
               <td   style="vertical-align:top;text-align:right;border:none;"></td>
               <td  style="text-align:right;border:none;"></td>
               <td  style="text-align:right;border:none;"></td>
               <td  style="text-align:right;border:none;"> </td>
            </tr>
            <tr>
               <td  colspan="2" style="vertical-align:top;text-align:right;border:none;"> </td>
               <td colspan="1" style="border:none;padding-bottom: 40px;"> </td>
               <td colspan="4" style="width:250px;text-align:right;border:none;width:400px;"><b><?php echo display('TAX DETAILS')?> :</b></td>
               <td colspan="1" style="border:none; width: 420px;">  <span class="input-symbol-euro">     <input type="text" class="form-control" style="width:200px;"  id="tax_details" value="0.00" name="tax_details"  readonly="readonly" /></span></td>
            </tr>
            <tr>
               <td  colspan="2" style="vertical-align:top;text-align:right;border:none;"> </td>
               <td colspan="1" style="border:none;"> </td>
               <td colspan="4" style="text-align:right;border:none;"><b><?php echo display('GRAND TOTAL') ?> :</b></td>
               <td colspan="1" style="border:none;">  <span class="input-symbol-euro">    <span class="input-symbol-euro">   <input type="text" id="gtotal"   class="form-control" style="width:200px;" name="customer_gtotal" value="0.00"  readonly="readonly" /></td>
            </tr>
            <tr>
               <td  colspan="2" style="vertical-align:top;text-align:right;border:none;"></td>
               <td colspan="1" style="border:none;">  </td>
               <td colspan="4" style="text-align:right;border:none;"></td>
               <td colspan="1" style="border:none;">
                  <table>
                     <tr>
                        <td class="cus" name="cus" ></td>
                         <td> </td>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr>
               <td colspan="2"  style="vertical-align:top;text-align:right;border:none;"> </td>
               <td colspan="1" style="border:none;"> </td>
               <td colspan="4" class="amt" style="text-align:right;border:none;"><b><?php echo display('Amount Paid') ?> :</b></td>
               <td style="border:none;height:50px;">
                  <table border="0">
                     <tr class="amt">
                        <td class="cus" name="cus"  ></td>
                         <td>  <span class="input-symbol-euro"> <input  type="text"  readonly id="amount_paid" style="width:200px" class="form-control"   name="amount_paid"  required   /></td>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr>
               <td colspan="2"  style="vertical-align:top;text-align:right;border:none;"></td>
               <td colspan="1" style="border:none;"></td>
               <td class="amt" colspan="4"  style="vertical-align:top;text-align:right;border:none;"><b><?php echo display('Balance Amount') ?> :</b></td>
               <td class="amt" style="border:none;" colspan="1">
                  <table border="0">
                     <tr class="amt">
                        <td class="cus" name="cus" style="border:none;"></td>
                         <td style="border:none;">
                           <span class="input-symbol-euro">  <input  type="text"   readonly id="balance"  style="width:200px"  name="balance"  class="form-control"  required   />                     
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr>
               <td style="border:none;">
               </td>
            </tr>
            <input type="hidden" id="final_gtotal"  name="final_gtotal" />
            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/></td>
            <!-- -->
            <tr style="border-right:none;border-left:none;border-bottom:none;border-top:none">
               <td colspan="21" style="text-align: end;">
                  <input type="submit" value="<?php echo  ('Receive Payment') ?>"   class="btnclr btn btn-large" id="paypls"/>
               </td>
            </tr>
            </tfoot>
         </table>
      </div>
      <div class="form-group row">
         <label for="billing_address" class="col-sm-2 col-form-label"><?php echo display('Account Details/Additional Information')?></label>
         <div class="col-sm-8">
            <textarea rows="4" cols="50" id="details" style="border: 2px solid #d7d4d6;height:87px;width:757px;"  name="ac_details" class=" form-control" placeholder='Account Details/Additional Information' ><?php   if(!empty($update_invoice_set[0]->account)){echo $update_invoice_set[0]->account;} ?></textarea>
         </div>
      </div>
      <div class="form-group row">
         <label for="remark" class="col-sm-2 col-form-label"><?php echo display('Remarks/Conditions')?></label>
         <div class="col-sm-8">
            <textarea rows="4" cols="50" id="remarks" style="border: 2px solid #d7d4d6;height:87px;width:757px;"  name="remark" class=" form-control" placeholder='Remarks/Conditions' ><?php   if(!empty($update_invoice_set[0]->remarks)){ echo $update_invoice_set[0]->remarks;} ?></textarea>
         </div>
      </div>
      <div class="form-group row">
         <div class="col-sm-12 ">
            <table>
               <tr>
                  <td>
                     <input type="hidden" name="uid" value="<?php echo $_SESSION['user_id']; ?>">
                     <input type="submit" id="add_trucking" class="btnclr btn btn-large"   name="add-trucking" value=<?php echo display('Save') ?> />
                  </td>
                  <td>&nbsp;</td>
                  <td class="amt">    <a    id="final_submit" class='final_submit btn btnclr'><?php echo display('Submit') ?></a></td>
                  <td class="amt">&nbsp;</td>
                  <td class="amt"><a id="download"   class='btn btnclr'><?php echo display('Download')?></a>
                  </td>
                  <td  class="amt" style="width: 20px;">&nbsp;</td>
                  <td class="amt"><a id="print"   class='btn btnclr'><?php echo display('Print')?></a>
                  </td>
                  <td class="amt">&nbsp;</td>
                  <td class="amt" id="btn1_download">
                     <div class="col-sm-6">
                  </td>
                  <td>&nbsp;</td>
               </tr>
            </table>
            </div>
         </div>
         <div class="table-responsive" >
            <table class='table' style="display:none;">
               <tr>
                  <th colspan='7'>
                  </th>
               </tr>
            </table>
         </div>
         <input type="hidden" id="currency"/>
   </form>
   </div>
</section>
<input type="hidden" id="hdn"/>
<input type="hidden" id="gtotal_dup"/>
<div class="modal fade" id="myModal1" role="dialog" >
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="margin-top: 190px; text-align:center;">
                     <div class="modal-header btnclr">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <?php echo display ('Sales - Profarma Invoice') ?></h4>
         </div>
         <div class="modal-body" id="bodyModal1" style="text-align:center;font-weight:bold;">
         </div>
         <div class="modal-footer">
         </div>
      </div>
   </div>
</div>
<!------ add new customer -->
<div class="modal fade" id="cust_info">
   <div class="modal-dialog modal-lg">
      <div class="modal-content" style="text-align:center;" >
         <div class="modal-header btnclr" >
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"><?php echo display('ADD NEW CUSTOMER') ?></h4>
         </div>
         <div class="container"></div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <form id="instant_customer"  method="post">
               <div id="customeMessage" class="alert hide"></div>
               <div class="panel-body">
                  <div class="col-sm-6">
                     <div class="form-group row">
                        <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('Company Name') ?> <i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                           <input class="form-control" name ="customer_name" id="customer_name" type="text" placeholder=" Company Name"   required="" tabindex="1" >
                        </div>
                     </div>
                     <input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">
                     <div class="form-group row">
                        <label for="customer_type" class="col-sm-4 col-form-label"><?php echo display('Customer Type') ?></label>
                        <div class="col-sm-8">
                           <select   name="customer_type" id="customer_type" class=" form-control" placeholder="Customer Type" >
                              <option value=""><?php echo display('Select Customer Type') ?></option>
                              <option value="Distributor"><?php echo display('Distributor') ?></option>
                              <option value="Fabricator"><?php echo display('Fabricator') ?></option>
                              <option value="Kitchen"><?php echo display('Kitchen') ?></option>
                              <option value="Dealer"><?php echo display('Dealer') ?></option>
                              <option value="Contractor"><?php echo display('Contractor') ?></option>
                              <option value="Builder"><?php echo display('Builder') ?></option>
                              <option value="Others"><?php echo display('Others') ?></option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label"><?php echo display('Primary Email') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                           <input class="form-control" name ="email" id="email" type="email" required="" placeholder="Primary Email" > 
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="emailaddress" class="col-sm-4 col-form-label"><?php echo display('Secondary Email') ?> </label>
                        <div class="col-sm-8">
                           <input class="form-control" name="emailaddress" id="emailaddress" type="email" placeholder="Secondary Email"  >
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="mobile" class="col-sm-4 col-form-label"><?php echo display('Business Phone') ?> <i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                           <input class="form-control" name ="phone" id="mobile" type="number" placeholder="Business Phone" min="0" tabindex="3" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="mobile" class="col-sm-4 col-form-label"> <?php echo display('Mobile') ?></label>
                        <div class="col-sm-8">
                           <input class="form-control" name="mobile" id="mobile" type="number" placeholder="Mobile"  min="0" tabindex="2" >
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="contact" class="col-sm-4 col-form-label"><?php echo display('Contact Person') ?> <i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                           <input class="form-control" name="contact" id="contact" type="text" placeholder="Contact Person" required="" >
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="ETA" class="col-sm-4 col-form-label"><?php echo display('Attachments') ?></label>
                        <div class="col-sm-8">
                           <input type="file" name="file" class="form-control">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="Preferred currency" class="col-sm-4 col-form-label"><?php echo display('Preferred currency') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                           <!-- <select id="currency" name="currency1" style="width: 100%;"     > -->
                           <select  class="form-control" id="currency" name="currency1"  style="width: 100%;" required=""  style="max-width: -webkit-fill-available;">
                              <option value="USD">USD - US Dollar - $</option>
                              <option value="AFN">AFN - Afghan Afghani - ؋</option>
                              <option value="ALL">ALL - Albanian Lek - Lek</option>
                              <option value="DZD">DZD - Algerian Dinar - دج</option>
                              <option value="AOA">AOA - Angolan Kwanza - Kz</option>
                              <option value="ARS">ARS - Argentine Peso - $</option>
                              <option value="AMD">AMD - Armenian Dram - ֏</option>
                              <option value="AWG">AWG - Aruban Florin - ƒ</option>
                              <option value="AUD">AUD - Australian Dollar - $</option>
                              <option value="AZN">AZN - Azerbaijani Manat - m</option>
                              <option value="BSD">BSD - Bahamian Dollar - B$</option>
                              <option value="BHD">BHD - Bahraini Dinar - .د.ب</option>
                              <option value="BDT">BDT - Bangladeshi Taka - ৳</option>
                              <option value="BBD">BBD - Barbadian Dollar - Bds$</option>
                              <option value="BYR">BYR - Belarusian Ruble - Br</option>
                              <option value="BEF">BEF - Belgian Franc - fr</option>
                              <option value="BZD">BZD - Belize Dollar - $</option>
                              <option value="BMD">BMD - Bermudan Dollar - $</option>
                              <option value="BTN">BTN - Bhutanese Ngultrum - Nu.</option>
                              <option value="BTC">BTC - Bitcoin - ฿</option>
                              <option value="BOB">BOB - Bolivian Boliviano - Bs.</option>
                              <option value="BAM">BAM - Bosnia-Herzegovina Convertible Mark - KM</option>
                              <option value="BWP">BWP - Botswanan Pula - P</option>
                              <option value="BRL">BRL - Brazilian Real - R$</option>
                              <option value="GBP">GBP - British Pound Sterling - £</option>
                              <option value="BND">BND - Brunei Dollar - B$</option>
                              <option value="BGN">BGN - Bulgarian Lev - Лв.</option>
                              <option value="BIF">BIF - Burundian Franc - FBu</option>
                              <option value="KHR">KHR - Cambodian Riel - KHR</option>
                              <option value="CAD">CAD - Canadian Dollar - $</option>
                              <option value="CVE">CVE - Cape Verdean Escudo - $</option>
                              <option value="KYD">KYD - Cayman Islands Dollar - $</option>
                              <option value="XOF">XOF - CFA Franc BCEAO - CFA</option>
                              <option value="XAF">XAF - CFA Franc BEAC - FCFA</option>
                              <option value="XPF">XPF - CFP Franc - ₣</option>
                              <option value="CLP">CLP - Chilean Peso - $</option>
                              <option value="CNY">CNY - Chinese Yuan - ¥</option>
                              <option value="COP">COP - Colombian Peso - $</option>
                              <option value="KMF">KMF - Comorian Franc - CF</option>
                              <option value="CDF">CDF - Congolese Franc - FC</option>
                              <option value="CRC">CRC - Costa Rican ColÃ³n - ₡</option>
                              <option value="HRK">HRK - Croatian Kuna - kn</option>
                              <option value="CUC">CUC - Cuban Convertible Peso - $, CUC</option>
                              <option value="CZK">CZK - Czech Republic Koruna - Kč</option>
                              <option value="DKK">DKK - Danish Krone - Kr.</option>
                              <option value="DJF">DJF - Djiboutian Franc - Fdj</option>
                              <option value="DOP">DOP - Dominican Peso - $</option>
                              <option value="XCD">XCD - East Caribbean Dollar - $</option>
                              <option value="EGP">EGP - Egyptian Pound - ج.م</option>
                              <option value="ERN">ERN - Eritrean Nakfa - Nfk</option>
                              <option value="EEK">EEK - Estonian Kroon - kr</option>
                              <option value="ETB">ETB - Ethiopian Birr - Nkf</option>
                              <option value="EUR">EUR - Euro - €</option>
                              <option value="FKP">FKP - Falkland Islands Pound - £</option>
                              <option value="FJD">FJD - Fijian Dollar - FJ$</option>
                              <option value="GMD">GMD - Gambian Dalasi - D</option>
                              <option value="GEL">GEL - Georgian Lari - ლ</option>
                              <option value="DEM">DEM - German Mark - DM</option>
                              <option value="GHS">GHS - Ghanaian Cedi - GH₵</option>
                              <option value="GIP">GIP - Gibraltar Pound - £</option>
                              <option value="GRD">GRD - Greek Drachma - ₯, Δρχ, Δρ</option>
                              <option value="GTQ">GTQ - Guatemalan Quetzal - Q</option>
                              <option value="GNF">GNF - Guinean Franc - FG</option>
                              <option value="GYD">GYD - Guyanaese Dollar - $</option>
                              <option value="HTG">HTG - Haitian Gourde - G</option>
                              <option value="HNL">HNL - Honduran Lempira - L</option>
                              <option value="HKD">HKD - Hong Kong Dollar - $</option>
                              <option value="HUF">HUF - Hungarian Forint - Ft</option>
                              <option value="ISK">ISK - Icelandic KrÃ³na - kr</option>
                              <option value="INR">INR - Indian Rupee - ₹</option>
                              <option value="IDR">IDR - Indonesian Rupiah - Rp</option>
                              <option value="IRR">IRR - Iranian Rial - ﷼</option>
                              <option value="IQD">IQD - Iraqi Dinar - د.ع</option>
                              <option value="ILS">ILS - Israeli New Sheqel - ₪</option>
                              <option value="ITL">ITL - Italian Lira - L,£</option>
                              <option value="JMD">JMD - Jamaican Dollar - J$</option>
                              <option value="JPY">JPY - Japanese Yen - ¥</option>
                              <option value="JOD">JOD - Jordanian Dinar - ا.د</option>
                              <option value="KZT">KZT - Kazakhstani Tenge - лв</option>
                              <option value="KES">KES - Kenyan Shilling - KSh</option>
                              <option value="KWD">KWD - Kuwaiti Dinar - ك.د</option>
                              <option value="KGS">KGS - Kyrgystani Som - лв</option>
                              <option value="LAK">LAK - Laotian Kip - ₭</option>
                              <option value="LVL">LVL - Latvian Lats - Ls</option>
                              <option value="LBP">LBP - Lebanese Pound - £</option>
                              <option value="LSL">LSL - Lesotho Loti - L</option>
                              <option value="LRD">LRD - Liberian Dollar - $</option>
                              <option value="LYD">LYD - Libyan Dinar - د.ل</option>
                              <option value="LTL">LTL - Lithuanian Litas - Lt</option>
                              <option value="MOP">MOP - Macanese Pataca - $</option>
                              <option value="MKD">MKD - Macedonian Denar - ден</option>
                              <option value="MGA">MGA - Malagasy Ariary - Ar</option>
                              <option value="MWK">MWK - Malawian Kwacha - MK</option>
                              <option value="MYR">MYR - Malaysian Ringgit - RM</option>
                              <option value="MVR">MVR - Maldivian Rufiyaa - Rf</option>
                              <option value="MRO">MRO - Mauritanian Ouguiya - MRU</option>
                              <option value="MUR">MUR - Mauritian Rupee - ₨</option>
                              <option value="MXN">MXN - Mexican Peso - $</option>
                              <option value="MDL">MDL - Moldovan Leu - L</option>
                              <option value="MNT">MNT - Mongolian Tugrik - ₮</option>
                              <option value="MAD">MAD - Moroccan Dirham - MAD</option>
                              <option value="MZM">MZM - Mozambican Metical - MT</option>
                              <option value="MMK">MMK - Myanmar Kyat - K</option>
                              <option value="NAD">NAD - Namibian Dollar - $</option>
                              <option value="NPR">NPR - Nepalese Rupee - ₨</option>
                              <option value="ANG">ANG - Netherlands Antillean Guilder - ƒ</option>
                              <option value="TWD">TWD - New Taiwan Dollar - $</option>
                              <option value="NZD">NZD - New Zealand Dollar - $</option>
                              <option value="NIO">NIO - Nicaraguan CÃ³rdoba - C$</option>
                              <option value="NGN">NGN - Nigerian Naira - ₦</option>
                              <option value="KPW">KPW - North Korean Won - ₩</option>
                              <option value="NOK">NOK - Norwegian Krone - kr</option>
                              <option value="OMR">OMR - Omani Rial - .ع.ر</option>
                              <option value="PKR">PKR - Pakistani Rupee - ₨</option>
                              <option value="PAB">PAB - Panamanian Balboa - B/.</option>
                              <option value="PGK">PGK - Papua New Guinean Kina - K</option>
                              <option value="PYG">PYG - Paraguayan Guarani - ₲</option>
                              <option value="PEN">PEN - Peruvian Nuevo Sol - S/.</option>
                              <option value="PHP">PHP - Philippine Peso - ₱</option>
                              <option value="PLN">PLN - Polish Zloty - zł</option>
                              <option value="QAR">QAR - Qatari Rial - ق.ر</option>
                              <option value="RON">RON - Romanian Leu - lei</option>
                              <option value="RUB">RUB - Russian Ruble - ₽</option>
                              <option value="RWF">RWF - Rwandan Franc - FRw</option>
                              <option value="SVC">SVC - Salvadoran ColÃ³n - ₡</option>
                              <option value="WST">WST - Samoan Tala - SAT</option>
                              <option value="SAR">SAR - Saudi Riyal - ﷼</option>
                              <option value="RSD">RSD - Serbian Dinar - din</option>
                              <option value="SCR">SCR - Seychellois Rupee - SRe</option>
                              <option value="SLL">SLL - Sierra Leonean Leone - Le</option>
                              <option value="SGD">SGD - Singapore Dollar - $</option>
                              <option value="SKK">SKK - Slovak Koruna - Sk</option>
                              <option value="SBD">SBD - Solomon Islands Dollar - Si$</option>
                              <option value="SOS">SOS - Somali Shilling - Sh.so.</option>
                              <option value="ZAR">ZAR - South African Rand - R</option>
                              <option value="KRW">KRW - South Korean Won - ₩</option>
                              <option value="XDR">XDR - Special Drawing Rights - SDR</option>
                              <option value="LKR">LKR - Sri Lankan Rupee - Rs</option>
                              <option value="SHP">SHP - St. Helena Pound - £</option>
                              <option value="SDG">SDG - Sudanese Pound - .س.ج</option>
                              <option value="SRD">SRD - Surinamese Dollar - $</option>
                              <option value="SZL">SZL - Swazi Lilangeni - E</option>
                              <option value="SEK">SEK - Swedish Krona - kr</option>
                              <option value="CHF">CHF - Swiss Franc - CHf</option>
                              <option value="SYP">SYP - Syrian Pound - LS</option>
                              <option value="STD">STD - São Tomé and Príncipe Dobra - Db</option>
                              <option value="TJS">TJS - Tajikistani Somoni - SM</option>
                              <option value="TZS">TZS - Tanzanian Shilling - TSh</option>
                              <option value="THB">THB - Thai Baht - ฿</option>
                              <option value="TOP">TOP - Tongan pa'anga - $</option>
                              <option value="TTD">TTD - Trinidad & Tobago Dollar - $</option>
                              <option value="TND">TND - Tunisian Dinar - ت.د</option>
                              <option value="TRY">TRY - Turkish Lira - ₺</option>
                              <option value="TMT">TMT - Turkmenistani Manat - T</option>
                              <option value="UGX">UGX - Ugandan Shilling - USh</option>
                              <option value="UAH">UAH - Ukrainian Hryvnia - ₴</option>
                              <option value="AED">AED - United Arab Emirates Dirham - إ.د</option>
                              <option value="UYU">UYU - Uruguayan Peso - $</option>
                              <option value="UZS">UZS - Uzbekistan Som - лв</option>
                              <option value="VUV">VUV - Vanuatu Vatu - VT</option>
                              <option value="VEF">VEF - Venezuelan BolÃvar - Bs</option>
                              <option value="VND">VND - Vietnamese Dong - ₫</option>
                              <option value="YER">YER - Yemeni Rial - ﷼</option>
                              <option value="ZMK">ZMK - Zambian Kwacha - ZK</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group row">
                        <label for="fax" class="col-sm-4 col-form-label"><?php echo display('fax'); ?> <i class="text-danger"></i></label>
                        <div class="col-sm-8">
                           <input class="form-control" name="fax" id="fax" type="text" placeholder="Fax" >
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="address2 " class="col-sm-4 col-form-label"><?php echo display('Billing Address') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                           <textarea class="form-control" required="" name="address2" id="address2" rows="2"   placeholder="Billing Address" ></textarea>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="address " class="col-sm-4 col-form-label"><?php echo display('Shipping Address') ?></label>
                        <div class="col-sm-8">
                           <textarea class="form-control" name="address" id="address "    rows="2" placeholder="Shipping Address"></textarea>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="city" class="col-sm-4 col-form-label"><?php echo display('City') ?> <i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                           <input class="form-control" name="city" id="city" type="text" placeholder="City" required="" >
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="state" class="col-sm-4 col-form-label"><?php echo display('State ') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                           <input class="form-control" name="state" id="state" type="text" placeholder="State" required="" >
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="zip" class="col-sm-4 col-form-label"><?php echo display('Zip') ?> <i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                           <input class="form-control" name="zip" id="zip" type="text" placeholder="Zip"  required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="country" class="col-sm-4 col-form-label"><?php echo display('Country') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                           <select class="selectpicker countrypicker form-control"  data-live-search="true" data-default="United States"  name="country" id="country" ></select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="billing_address" class="col-sm-4 col-form-label"><?php echo display('Payment Terms') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                           <select   name="payment" id="payment_terms" class=" form-control" placeholder='Payment Terms'  required="" >
                              <option value=""><?php echo display('Select Payment Terms ') ?></option>
                              <option value="COD">COD</option>
                              <option value="30 Days">30 Days</option>
                              <option value="45 Days">45 Days</option>
                              <option value="60 Days">60 Days</option>
                              <option value="90 Days">90 Days</option>
                              <?php foreach($payment_terms as $inv){ ?>
                              <option value="<?php echo $inv['payment_terms'] ; ?>"><?php echo $inv['payment_terms'] ; ?></option>
                              <?php    }?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="previous_balance" class="col-sm-4 col-form-label"><?php echo display('Credit Limit') ?> <i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                           <input class="form-control" name="previous_balance" id="previous_balance" type="text" min="0" placeholder="Credit Limit" tabindex="5" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="invoice_no" class="col-sm-4 col-form-label"><?php echo display('Sales Tax') ?>
                        <i class="text-danger">*</i>
                        </label>
                        <div class="col-sm-8">
                           <select name="sales_taxes" class="form-control" required id="tax_dropdown" tabindex="3">
                              <option value="" selected><?php echo display('Select Sales Tax') ?></option>
                              <option value="1"><?php echo display('NO') ?></option>
                              <option value="2"><?php echo display('YES') ?></option>
                           </select>
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group row" id="tax">
                           <div class="row">
                              <div class="col-sm-12">
                                 <label for="sales" class="col-sm-4 col-form-label"><?php echo display('Sales Tax') ?></label>
                                 <div class="col-sm-8">
                                    <select  class="form-control" name="tax" value="" tabindex="3" style="width:95%"  >
                                       <!-- <select name="tax" value="" tabindex="5" style="width:100%"> -->
                                       <option value="">Select the State</option>
                                       <option value="Alabama">Alabama</option>
                                       <option value="Alaska">Alaska</option>
                                       <option value="Arizona">Arizona</option>
                                       <option value="Arkansas">Arkansas</option>
                                       <option value="California">California</option>
                                       <option value="Colorado">Colorado</option>
                                       <option value="Connecticut">Connecticut</option>
                                       <option value="Delaware">Delaware</option>
                                       <option value="District Of Columbia">District Of Columbia</option>
                                       <option value="Florida">Florida</option>
                                       <option value="Georgia">Georgia</option>
                                       <option value="Hawaii">Hawaii</option>
                                       <option value="Idaho">Idaho</option>
                                       <option value="Illinois">Illinois</option>
                                       <option value="Indiana">Indiana</option>
                                       <option value="Iowa">Iowa</option>
                                       <option value="Kansas">Kansas</option>
                                       <option value="Kentucky">Kentucky</option>
                                       <option value="Louisiana">Louisiana</option>
                                       <option value="Maine">Maine</option>
                                       <option value="Maryland">Maryland</option>
                                       <option value="Massachusetts">Massachusetts</option>
                                       <option value="Michigan">Michigan</option>
                                       <option value="Minnesota">Minnesota</option>
                                       <option value="Mississippi">Mississippi</option>
                                       <option value="Missouri">Missouri</option>
                                       <option value="Montana">Montana</option>
                                       <option value="Nebraska">Nebraska</option>
                                       <option value="Nevada">Nevada</option>
                                       <option value="New Hampshire">New Hampshire</option>
                                       <option value="New Jersey">New Jersey</option>
                                       <option value="New Mexico">New Mexico</option>
                                       <option value="New York">New York</option>
                                       <option value="North Carolina">North Carolina</option>
                                       <option value="North Dakota">North Dakota</option>
                                       <option value="Ohio">Ohio</option>
                                       <option value="Oklahoma">Oklahoma</option>
                                       <option value="Oregon">Oregon</option>
                                       <option value="Pennsylvania">Pennsylvania</option>
                                       <option value="Rhode Island">Rhode Island</option>
                                       <option value="South Carolina">South Carolina</option>
                                       <option value="South Dakota">South Dakota</option>
                                       <option value="Tennessee">Tennessee</option>
                                       <option value="Texas">Texas</option>
                                       <option value="Utah">Utah</option>
                                       <option value="Vermont">Vermont</option>
                                       <option value="Virginia">Virginia</option>
                                       <option value="Washington">Washington</option>
                                       <option value="West Virginia">West Virginia</option>
                                       <option value="Wisconsin">Wisconsin</option>
                                       <option value="Wyoming">Wyoming</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           &nbsp;&nbsp;
                           <div class="form-group row" id="tax">
                              <div class="col-sm-12">
                                 <label for="sales" class="col-sm-4 col-form-label"><?php echo display('Tax Rates ') ?></label>
                                 <div class="col-sm-8">
                                    <input name="taxes"  class="form-control taxes" value="" placeholder="%"   style="width:95%" tabindex="4">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <a href="#" class="btn btnclr"   data-dismiss="modal"><?php echo display('Close') ?></a>
         <input type="submit" class="btn btnclr"    value=<?php echo display('Submit') ?>>
         </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="payment_modal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="text-align:center;margin-top: 190px;" >
         <div class="modal-header btnclr" >
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo display('ADD PAYMENT') ?></h4>
         </div>
         <div class="modal-body">
            <form id="add_payment_info"  method="post" >
               <div class="row">
                  <div class="form-group row">
                     <label for="date" style="text-align: start;width: 30%;margin-left: 85px;" class="col-sm-3 col-form-label">  <?php echo display('Payment Date') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-5">
                         <?php $date = date('Y-m-d'); ?>
                        <input class=" form-control" type="date"  name="payment_date" id="payment_date" required value="<?php echo html_escape($date); ?>" tabindex="4" />
                     </div>
                  </div>
                  <input type="hidden" id="cutomer_name" name="cutomer_name"/>
                  <input type="hidden"  value="<?php echo $payment_id; ?>"  name="payment_id" id="payment_id"/>
                  <div class="form-group row">
                     <label  style="text-align: start;width: 30%;margin-left: 85px;" class="col-sm-3 col-form-label"><?php echo 'Method of Payment' ?></label>
                     <div class="col-sm-5">
                        <input class=" form-control" type="text" name="m_payment" id="m_payment" />
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="billing_address" style="text-align: start;width: 30%;margin-left: 85px;" class="col-sm-3 col-form-label"><?php echo display('Reference No') ?></label>
                     <div class="col-sm-5">
                        <input class=" form-control" type="text"  name="ref_no" id="ref_no"   />
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="bank" style="text-align: start;width: 30%;margin-left: 85px;" class="col-sm-3 col-form-label"><?php echo display('Select Bank') ?><i class="text-danger">*</i></label>
                     <a data-toggle="modal" href="#add_bank_info" style="margin-right:35px;"  class="btn btnclr"><i class="fa fa-university"></i></a>
                     <div class="col-sm-5">
                        <select name="bank" id="bank"  class="form-control bankpayment" >
                           <option value="JPMorgan Chase">JPMorgan Chase</option>
                           <option value="New York City">New York City</option>
                           <option value="Bank of America">Bank of America</option>
                           <option value="Citigroup">Citigroup</option>
                           <option value="Wells Fargo">Wells Fargo</option>
                           <option value="Goldman Sachs">Goldman Sachs</option>
                           <option value="Morgan Stanley">Morgan Stanley</option>
                           <option value="U.S. Bancorp">U.S. Bancorp</option>
                           <option value="PNC Financial Services">PNC Financial Services</option>
                           <option value="Truist Financial">Truist Financial</option>
                           <option value="Charles Schwab Corporation">Charles Schwab Corporation</option>
                           <option value="TD Bank, N.A.">TD Bank, N.A.</option>
                           <option value="Capital One">Capital One</option>
                           <option value="The Bank of New York Mellon">The Bank of New York Mellon</option>
                           <option value="State Street Corporation">State Street Corporation</option>
                           <option value="American Express">American Express</option>
                           <option value="Citizens Financial Group">Citizens Financial Group</option>
                           <option value="HSBC Bank USA">HSBC Bank USA</option>
                           <option value="SVB Financial Group">SVB Financial Group</option>
                           <option value="First Republic Bank">First Republic Bank</option>
                           <option value="Fifth Third Bank">Fifth Third Bank</option>
                           <option value="BMO USA">BMO USA</option>
                           <option value="USAA">USAA</option>
                           <option value="UBS">UBS</option>
                           <option value="M&T Bank">M&T Bank</option>
                           <option value="Ally Financial">Ally Financial</option>
                           <option value="KeyCorp">KeyCorp</option>
                           <option value="Huntington Bancshares">Huntington Bancshares</option>
                           <option value="Barclays">Barclays</option>
                           <option value="Santander Bank">Santander Bank</option>
                           <option value="RBC Bank">RBC Bank</option>
                           <option value="Ameriprise">Ameriprise</option>
                           <option value="Regions Financial Corporation">Regions Financial Corporation</option>
                           <option value="Northern Trust">Northern Trust</option>
                           <option value="BNP Paribas">BNP Paribas</option>
                           <option value="Discover Financial">Discover Financial</option>
                           <option value="First Citizens BancShares">First Citizens BancShares</option>
                           <option value="Synchrony Financial">Synchrony Financial</option>
                           <option value="Deutsche Bank">Deutsche Bank</option>
                           <option value="New York Community Bank">New York Community Bank</option>
                           <option value="Comerica">Comerica</option>
                           <option value="First Horizon National Corporation">First Horizon National Corporation</option>
                           <option value="Raymond James Financial">Raymond James Financial</option>
                           <option value="Webster Bank">Webster Bank</option>
                           <option value="Western Alliance Bank">Western Alliance Bank</option>
                           <option value="Popular, Inc.">Popular, Inc.</option>
                           <option value="CIBC Bank USA">CIBC Bank USA</option>
                           <option value="East West Bank">East West Bank</option>
                           <option value="Synovus">Synovus</option>
                           <option value="Valley National Bank">Valley National Bank</option>
                           <option value="Credit Suisse">Credit Suisse</option>
                           <option value="Mizuho Financial Group">Mizuho Financial Group</option>
                           <option value="Wintrust Financial">Wintrust Financial</option>
                           <option value="Cullen/Frost Bankers, Inc.">Cullen/Frost Bankers, Inc.</option>
                           <option value="John Deere Capital Corporation">John Deere Capital Corporation</option>
                           <option value="MUFG Union Bank">MUFG Union Bank</option>
                           <option value="BOK Financial Corporation">BOK Financial Corporation</option>
                           <option value="Old National Bank">Old National Bank</option>
                           <option value="South State Bank">South State Bank</option>
                           <option value="FNB Corporation">FNB Corporation</option>
                           <option value="Pinnacle Financial Partners">Pinnacle Financial Partners</option>
                           <option value="PacWest Bancorp">PacWest Bancorp</option>
                           <option value="TIAA">TIAA</option>
                           <option value="Associated Banc-Corp">Associated Banc-Corp</option>
                           <option value="UMB Financial Corporation">UMB Financial Corporation</option>
                           <option value="Prosperity Bancshares">Prosperity Bancshares</option>
                           <option value="Stifel">Stifel</option>
                           <option value="BankUnited">BankUnited</option>
                           <option value="Hancock Whitney">Hancock Whitney</option>
                           <option value="MidFirst Bank">MidFirst Bank</option>
                           <option value="Sumitomo Mitsui Banking Corporation">Sumitomo Mitsui Banking Corporation</option>
                           <option value="Beal Bank">Beal Bank</option>
                           <option value="First Interstate BancSystem">First Interstate BancSystem</option>
                           <option value="Commerce Bancshares">Commerce Bancshares</option>
                           <option value="Umpqua Holdings Corporation">Umpqua Holdings Corporation</option>
                           <option value="United Bank (West Virginia)">United Bank (West Virginia)</option>
                           <option value="Texas Capital Bank">Texas Capital Bank</option>
                           <option value="First National of Nebraska">First National of Nebraska</option>
                           <option value="FirstBank Holding Co">FirstBank Holding Co</option>
                           <option value="Simmons Bank">Simmons Bank</option>
                           <option value="Fulton Financial Corporation">Fulton Financial Corporation</option>
                           <option value="Glacier Bancorp">Glacier Bancorp</option>
                           <option value="Arvest Bank">Arvest Bank</option>
                           <option value="BCI Financial Group">BCI Financial Group</option>
                           <option value="Ameris Bancorp">Ameris Bancorp</option>
                           <option value="First Hawaiian Bank">First Hawaiian Bank</option>
                           <option value="United Community Bank">United Community Bank</option>
                           <option value="Bank of Hawaii">Bank of Hawaii</option>
                           <option value="Home BancShares">Home BancShares</option>
                           <option value="Eastern Bank">Eastern Bank</option>
                           <option value="Cathay Bank">Cathay Bank</option>
                           <option value="Pacific Premier Bancorp">Pacific Premier Bancorp</option>
                           <option value="Washington Federal">Washington Federal</option>
                           <option value="Customers Bancorp">Customers Bancorp</option>
                           <option value="Atlantic Union Bank">Atlantic Union Bank</option>
                           <option value="Columbia Bank">Columbia Bank</option>
                           <option value="Heartland Financial USA">Heartland Financial USA</option>
                           <option value="WSFS Bank">WSFS Bank</option>
                           <option value="Central Bancompany">Central Bancompany</option>
                           <option value="Independent Bank">Independent Bank</option>
                           <option value="Hope Bancorp">Hope Bancorp</option>
                           <option value="SoFi">SoFi</option>
                           <?php foreach($bank_name as $b){ ?>
                           <option value="<?=$b['bank_name']; ?>"><?=$b['bank_name']; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                  <input class=" form-control" type="hidden"  readonly name="customer_name_modal" id="customer_name_modal" required   />    
                  <div class="form-group row">
                     <label for="billing_address" style="text-align: start;width: 30%;margin-left: 85px;" class="col-sm-3 col-form-label"><?php echo display ('Amount to be paid') ?>  </label>
                     <div class="col-sm-5">
                        <table border="0">
                           <tr>
                              <td class="cus" name="cus"></td>
                              <td><span class="input-symbol-euro"><input  type="text"  readonly name="amount_to_pay" id="amount_to_pay"  style="width:230px;"   class="form-control" required   /></span></td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <div class="form-group row" style="display:none;">
                     <label for="billing_address" style="text-align: start;width: 30%;margin-left: 85px;" class="col-sm-3 col-form-label"><?php echo display ('Amount Received ') ?> </label>
                     <div class="col-sm-5">
                        <table border="0">
                           <tr>
                              <td class="cus" name="cus"></td>
                              <td><input  type="text"  readonly name="amount_received" value="0.00" style="width:230px;"  id="amount_received" class="form-control"required   /></td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="billing_address" style="text-align: start;width: 30%;margin-left: 85px;"   class="col-sm-3 col-form-label"><?php echo display ('Balance ') ?>  </label>
                     <div class="col-sm-5">
                        <table border="0">
                           <tr>
                              <td class="cus" name="cus"></td>
                              <td><span class="input-symbol-euro"><input  type="text"   readonly name="balance_modal"   style="width:230px;"  id="balance_modal" class="form-control" required  /></span></td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="billing_address" style="text-align: start;width: 30%;margin-left: 85px;" class="col-sm-3 col-form-label"><?php echo display ('Payment Amount') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-5">
                        <table border="0">
                           <tr>
                              <td class="cus" name="cus"></td>
                              <td><input  type="text"   name="payment" id="payment_from_modal"    style="width:230px;"  class="form-control"required   /></td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="billing_address" style="text-align: start;width: 30%;margin-left: 85px;" class="col-sm-3 col-form-label"><?php echo display ('Additional Information') ?>   </label>
                     <div class="col-sm-5">
                        <input class=" form-control" type="text"  name="details" id="detail"/>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="billing_address" style="text-align: start;width: 30%;margin-left: 85px;" class="col-sm-3 col-form-label"><?php echo display ('Attachments ') ?>  </label>
                     <div class="col-sm-5">
                        <input class=" form-control" type="file"  name="attachement" id="attachement" />
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <div class="col-sm-8"></div>
         <div class="col-sm-4">
         <a href="#" class="btn btnclr" data-dismiss="modal"   ><?php echo display('Close') ?></a>
         <input class="btn btnclr" type="submit"      name="submit_pay" id="submit_pay" value=<?php echo display('submit') ?>  required   />
         </div>
         </div>
      </div>
      </form>
   </div>
</div>
<div class="modal fade" id="product_model_info" role="dialog" style="margin-right: 900px;width:2000px;">
   <div class="modal-dialog" style="float:left;">
      <!-- Modal content-->
      <div class="modal-content" style="width: fit-content;margin-top: 100px;margin-left:300px;text-align:center;">
         <div class="modal-header btnclr" >
           
            <button type="button" class="close" data-dismiss="modal"  style="color: #6f2937; background: #cdc222;" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>

           
            <h4 class="modal-title"><?php echo display('Product') ?></h4>
         </div>
         <div class="modal-body1">
            <div id="salle_list5" style="padding:20px;"></div>
         </div>
         <div class="modal-footer">
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="add_bank_info">
   <div class="modal-dialog">
      <div class="modal-content" style="text-align:center;" >
         <div class="modal-header btnclr"  >
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"><?php echo display('ADD BANK') ?></h4>
         </div>
         <div class="container"></div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <form id="add_bank"  method="post">
               <div class="panel-body">
                  <input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">
                  <div class="form-group row">
                     <label for="bank_name" class="col-sm-4 col-form-label"><?php echo display('bank_name') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="bank_name" id="bank_name" required="" placeholder="<?php echo display('bank_name') ?>" tabindex="1"/>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="ac_name" class="col-sm-4 col-form-label"><?php echo display('ac_name') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="ac_name" id="ac_name" required="" placeholder="<?php echo display('ac_name') ?>" tabindex="2"/>
                     </div>
                  </div>
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                  <div class="form-group row">
                     <label for="ac_no" class="col-sm-4 col-form-label"><?php echo display('ac_no') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="ac_no" id="ac_no" required="" placeholder="<?php echo display('ac_no') ?>" tabindex="3"/>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="branch" class="col-sm-4 col-form-label"><?php echo display('branch') ?> <i class="text-danger">*</i></label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="branch" id="branch" required="" placeholder="<?php echo display('branch') ?>" tabindex="4"/>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="shipping_line" class="col-sm-4 col-form-label"><?php echo display('Country') ?>
                     <i class="text-danger"></i>
                     </label>
                     <div class="col-sm-6">
                        <select class="selectpicker countrypicker form-control"  data-live-search="true" data-default="United States"  name="country" id="country" style="width:100%"></select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="previous_balance" class="col-sm-4 col-form-label"><?php echo display('Currency') ?></label>
                     <div class="col-sm-6">
                        <select id="currency" name="currency1" class="form-control" style="max-width: -webkit-fill-available;">
                           <option>Select currency</option>
                           <option value="AFN">AFN - Afghan Afghani</option>
                           <option value="ALL">ALL - Albanian Lek</option>
                           <option value="DZD">DZD - Algerian Dinar</option>
                           <option value="AOA">AOA - Angolan Kwanza</option>
                           <option value="ARS">ARS - Argentine Peso</option>
                           <option value="AMD">AMD - Armenian Dram</option>
                           <option value="AWG">AWG - Aruban Florin</option>
                           <option value="AUD">AUD - Australian Dollar</option>
                           <option value="AZN">AZN - Azerbaijani Manat</option>
                           <option value="BSD">BSD - Bahamian Dollar</option>
                           <option value="BHD">BHD - Bahraini Dinar</option>
                           <option value="BDT">BDT - Bangladeshi Taka</option>
                           <option value="BBD">BBD - Barbadian Dollar</option>
                           <option value="BYR">BYR - Belarusian Ruble</option>
                           <option value="BEF">BEF - Belgian Franc</option>
                           <option value="BZD">BZD - Belize Dollar</option>
                           <option value="BMD">BMD - Bermudan Dollar</option>
                           <option value="BTN">BTN - Bhutanese Ngultrum</option>
                           <option value="BTC">BTC - Bitcoin</option>
                           <option value="BOB">BOB - Bolivian Boliviano</option>
                           <option value="BAM">BAM - Bosnia-Herzegovina Convertible Mark</option>
                           <option value="BWP">BWP - Botswanan Pula</option>
                           <option value="BRL">BRL - Brazilian Real</option>
                           <option value="GBP">GBP - British Pound Sterling</option>
                           <option value="BND">BND - Brunei Dollar</option>
                           <option value="BGN">BGN - Bulgarian Lev</option>
                           <option value="BIF">BIF - Burundian Franc</option>
                           <option value="KHR">KHR - Cambodian Riel</option>
                           <option value="CAD">CAD - Canadian Dollar</option>
                           <option value="CVE">CVE - Cape Verdean Escudo</option>
                           <option value="KYD">KYD - Cayman Islands Dollar</option>
                           <option value="XOF">XOF - CFA Franc BCEAO</option>
                           <option value="XAF">XAF - CFA Franc BEAC</option>
                           <option value="XPF">XPF - CFP Franc</option>
                           <option value="CLP">CLP - Chilean Peso</option>
                           <option value="CNY">CNY - Chinese Yuan</option>
                           <option value="COP">COP - Colombian Peso</option>
                           <option value="KMF">KMF - Comorian Franc</option>
                           <option value="CDF">CDF - Congolese Franc</option>
                           <option value="CRC">CRC - Costa Rican ColÃ³n</option>
                           <option value="HRK">HRK - Croatian Kuna</option>
                           <option value="CUC">CUC - Cuban Convertible Peso</option>
                           <option value="CZK">CZK - Czech Republic Koruna</option>
                           <option value="DKK">DKK - Danish Krone</option>
                           <option value="DJF">DJF - Djiboutian Franc</option>
                           <option value="DOP">DOP - Dominican Peso</option>
                           <option value="XCD">XCD - East Caribbean Dollar</option>
                           <option value="EGP">EGP - Egyptian Pound</option>
                           <option value="ERN">ERN - Eritrean Nakfa</option>
                           <option value="EEK">EEK - Estonian Kroon</option>
                           <option value="ETB">ETB - Ethiopian Birr</option>
                           <option value="EUR">EUR - Euro</option>
                           <option value="FKP">FKP - Falkland Islands Pound</option>
                           <option value="FJD">FJD - Fijian Dollar</option>
                           <option value="GMD">GMD - Gambian Dalasi</option>
                           <option value="GEL">GEL - Georgian Lari</option>
                           <option value="DEM">DEM - German Mark</option>
                           <option value="GHS">GHS - Ghanaian Cedi</option>
                           <option value="GIP">GIP - Gibraltar Pound</option>
                           <option value="GRD">GRD - Greek Drachma</option>
                           <option value="GTQ">GTQ - Guatemalan Quetzal</option>
                           <option value="GNF">GNF - Guinean Franc</option>
                           <option value="GYD">GYD - Guyanaese Dollar</option>
                           <option value="HTG">HTG - Haitian Gourde</option>
                           <option value="HNL">HNL - Honduran Lempira</option>
                           <option value="HKD">HKD - Hong Kong Dollar</option>
                           <option value="HUF">HUF - Hungarian Forint</option>
                           <option value="ISK">ISK - Icelandic KrÃ³na</option>
                           <option value="INR">INR - Indian Rupee</option>
                           <option value="IDR">IDR - Indonesian Rupiah</option>
                           <option value="IRR">IRR - Iranian Rial</option>
                           <option value="IQD">IQD - Iraqi Dinar</option>
                           <option value="ILS">ILS - Israeli New Sheqel</option>
                           <option value="ITL">ITL - Italian Lira</option>
                           <option value="JMD">JMD - Jamaican Dollar</option>
                           <option value="JPY">JPY - Japanese Yen</option>
                           <option value="JOD">JOD - Jordanian Dinar</option>
                           <option value="KZT">KZT - Kazakhstani Tenge</option>
                           <option value="KES">KES - Kenyan Shilling</option>
                           <option value="KWD">KWD - Kuwaiti Dinar</option>
                           <option value="KGS">KGS - Kyrgystani Som</option>
                           <option value="LAK">LAK - Laotian Kip</option>
                           <option value="LVL">LVL - Latvian Lats</option>
                           <option value="LBP">LBP - Lebanese Pound</option>
                           <option value="LSL">LSL - Lesotho Loti</option>
                           <option value="LRD">LRD - Liberian Dollar</option>
                           <option value="LYD">LYD - Libyan Dinar</option>
                           <option value="LTL">LTL - Lithuanian Litas</option>
                           <option value="MOP">MOP - Macanese Pataca</option>
                           <option value="MKD">MKD - Macedonian Denar</option>
                           <option value="MGA">MGA - Malagasy Ariary</option>
                           <option value="MWK">MWK - Malawian Kwacha</option>
                           <option value="MYR">MYR - Malaysian Ringgit</option>
                           <option value="MVR">MVR - Maldivian Rufiyaa</option>
                           <option value="MRO">MRO - Mauritanian Ouguiya</option>
                           <option value="MUR">MUR - Mauritian Rupee</option>
                           <option value="MXN">MXN - Mexican Peso</option>
                           <option value="MDL">MDL - Moldovan Leu</option>
                           <option value="MNT">MNT - Mongolian Tugrik</option>
                           <option value="MAD">MAD - Moroccan Dirham</option>
                           <option value="MZM">MZM - Mozambican Metical</option>
                           <option value="MMK">MMK - Myanmar Kyat</option>
                           <option value="NAD">NAD - Namibian Dollar</option>
                           <option value="NPR">NPR - Nepalese Rupee</option>
                           <option value="ANG">ANG - Netherlands Antillean Guilder</option>
                           <option value="TWD">TWD - New Taiwan Dollar</option>
                           <option value="NZD">NZD - New Zealand Dollar</option>
                           <option value="NIO">NIO - Nicaraguan CÃ³rdoba</option>
                           <option value="NGN">NGN - Nigerian Naira</option>
                           <option value="KPW">KPW - North Korean Won</option>
                           <option value="NOK">NOK - Norwegian Krone</option>
                           <option value="OMR">OMR - Omani Rial</option>
                           <option value="PKR">PKR - Pakistani Rupee</option>
                           <option value="PAB">PAB - Panamanian Balboa</option>
                           <option value="PGK">PGK - Papua New Guinean Kina</option>
                           <option value="PYG">PYG - Paraguayan Guarani</option>
                           <option value="PEN">PEN - Peruvian Nuevo Sol</option>
                           <option value="PHP">PHP - Philippine Peso</option>
                           <option value="PLN">PLN - Polish Zloty</option>
                           <option value="QAR">QAR - Qatari Rial</option>
                           <option value="RON">RON - Romanian Leu</option>
                           <option value="RUB">RUB - Russian Ruble</option>
                           <option value="RWF">RWF - Rwandan Franc</option>
                           <option value="SVC">SVC - Salvadoran ColÃ³n</option>
                           <option value="WST">WST - Samoan Tala</option>
                           <option value="SAR">SAR - Saudi Riyal</option>
                           <option value="RSD">RSD - Serbian Dinar</option>
                           <option value="SCR">SCR - Seychellois Rupee</option>
                           <option value="SLL">SLL - Sierra Leonean Leone</option>
                           <option value="SGD">SGD - Singapore Dollar</option>
                           <option value="SKK">SKK - Slovak Koruna</option>
                           <option value="SBD">SBD - Solomon Islands Dollar</option>
                           <option value="SOS">SOS - Somali Shilling</option>
                           <option value="ZAR">ZAR - South African Rand</option>
                           <option value="KRW">KRW - South Korean Won</option>
                           <option value="XDR">XDR - Special Drawing Rights</option>
                           <option value="LKR">LKR - Sri Lankan Rupee</option>
                           <option value="SHP">SHP - St. Helena Pound</option>
                           <option value="SDG">SDG - Sudanese Pound</option>
                           <option value="SRD">SRD - Surinamese Dollar</option>
                           <option value="SZL">SZL - Swazi Lilangeni</option>
                           <option value="SEK">SEK - Swedish Krona</option>
                           <option value="CHF">CHF - Swiss Franc</option>
                           <option value="SYP">SYP - Syrian Pound</option>
                           <option value="STD">STD - São Tomé and Príncipe Dobra</option>
                           <option value="TJS">TJS - Tajikistani Somoni</option>
                           <option value="TZS">TZS - Tanzanian Shilling</option>
                           <option value="THB">THB - Thai Baht</option>
                           <option value="TOP">TOP - Tongan pa'anga</option>
                           <option value="TTD">TTD - Trinidad & Tobago Dollar</option>
                           <option value="TND">TND - Tunisian Dinar</option>
                           <option value="TRY">TRY - Turkish Lira</option>
                           <option value="TMT">TMT - Turkmenistani Manat</option>
                           <option value="UGX">UGX - Ugandan Shilling</option>
                           <option value="UAH">UAH - Ukrainian Hryvnia</option>
                           <option value="AED">AED - United Arab Emirates Dirham</option>
                           <option value="UYU">UYU - Uruguayan Peso</option>
                           <option selected value="USD">USD - US Dollar</option>
                           <option value="UZS">UZS - Uzbekistan Som</option>
                           <option value="VUV">VUV - Vanuatu Vatu</option>
                           <option value="VEF">VEF - Venezuelan BolÃ­var</option>
                           <option value="VND">VND - Vietnamese Dong</option>
                           <option value="YER">YER - Yemeni Rial</option>
                           <option value="ZMK">ZMK - Zambian Kwacha</option>
                        </select>
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <div class="row">
         <div class="col-sm-8">
         </div>
         <div class="col-sm-4">
         <a href="#" class="btn btnclr" data-dismiss="modal"   ><?php echo display('Close') ?></a>
         <input type="submit" id="addBank"     class="btn btnclr" name="addBank" value="<?php echo display('save') ?>"/>
         </div>
         </div>  </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="proforma_taxinfo">
   <div class="modal-dialog">
      <div class="modal-content" style="text-align:center;" >
         <div class="modal-header btnclr" >
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add Tax Information </h4>
         </div>
         <div class="container"></div>
         <div class="modal-body">
            <div id="customeMessage" class="alert hide"></div>
            <form id="proforma_taxbtn"  method="post">
               <div id="customeMessage" class="alert hide"></div>
               <div class="panel-body">
                  <input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">
                  <input type ="hidden" name="status_type" value="sales">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Enter Tax percent % <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="tax" id="enter_tax" step="0.01" maxlength="3" required="" placeholder="%" />
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Description </label>
                           <input type="text" class="form-control" name ="description" id="description" type="text" placeholder="Description">
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>State <span class="text-danger">*</span></label>
                           <select name="state" class="form-control" required>
                              <option selected="true" disabled="disabled" value="">Please Select State</option>
                              <option value="Alabama">AL - State of Alabama</option>
                              <option value="Alaska">AK - State of Alaska</option>
                              <option value="Arizona">AZ - State of Arizona</option>
                              <option value="Arkansas">AR - State of Arkansas</option>
                              <option value="California">CA - State of California</option>
                              <option value="Colorado">CO - State of Colorado</option>
                              <option value="Connecticut">CT - State of Connecticut</option>
                              <option value="Delaware">DE - State of Delaware</option>
                              <option value="Florida">FL - State of Florida</option>
                              <option value="Georgia">GA - State of Georgia</option>
                              <option value="Hawaii">HI - State of Hawaii</option>
                              <option value="Idaho">ID - State of Idaho</option>
                              <option value="Illinois">IL - State of Illinois</option>
                              <option value="Indiana">IN - State of Indiana</option>
                              <option value="Iowa">IA - State of Iowa</option>
                              <option value="Kansas">KS - State of Kansas</option>
                              <option value="Kentucky">KY - State of Kentucky</option>
                              <option value="Louisiana">LA - State of Louisiana</option>
                              <option value="Maine">ME - State of Maine</option>
                              <option value="Maryland">MD - State of Maryland</option>
                              <option value="Massachusetts">MA - State of Massachusetts</option>
                              <option value="Michigan">MI - State of Michigan</option>
                              <option value="Minnesota">MN - State of Minnesota</option>
                              <option value="Mississippi">MS - State of Mississippi</option>
                              <option value="Missouri">MO - State of Missouri</option>
                              <option value="Montana">MT - State of Montana</option>
                              <option value="Nebraska">NE - State of Nebraska</option>
                              <option value="Nevada">NV - State of Nevada</option>
                              <option value="New Hampshire">NH - State of New Hampshire</option>
                              <option value="New Jersey">NJ - State of New Jersey</option>
                              <option value="New Mexico">NM - State of New Mexico</option>
                              <option value="New York">NY - State of New York</option>
                              <option value="North Carolina">NC - State of North Carolina</option>
                              <option value="North Dakota">ND - State of North Dakota</option>
                              <option value="Ohio">OH - State of Ohio</option>
                              <option value="Oklahoma">OK - State of Oklahoma</option>
                              <option value="Oregon">OR - State of Oregon</option>
                              <option value="Pennsylvania">PA - State of Pennsylvania</option>
                              <option value="Rhode Island">RI - State of Rhode Island</option>
                              <option value="South Carolina">SC - State of South Carolina</option>
                              <option value="South Dakota">SD - State of South Dakota</option>
                              <option value="Tennessee">TN - State of Tennessee</option>
                              <option value="Texas">TX - State of Texas</option>
                              <option value="Utah">UT - State of Utah</option>
                              <option value="Vermont">VT - State of Vermont</option>
                              <option value="Virginia">VA - State of Virginia</option>
                              <option value="Washington">WA - State of Washington</option>
                              <option value="West Virginia">WV - State of West Virginia</option>
                              <option value="Wisconsin">WI - State of Wisconsin</option>
                              <option value="Wyoming">WY - State of Wyoming</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Tax Agency <span class="text-danger">*</span></label>
                           <select name="tax_agency" class="form-control" required>
                              <option selected="true" disabled="disabled" value="">Please Select Taxes</option>
                              <option value="Federal Taxes">Federal Taxes</option>
                              <option value="State Taxes">State Taxes</option>
                              <option value="Municipal Taxes">Municipal Taxes</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Account <span class="text-danger">*</span></label>
                           <select name="account" class="form-control" required>
                              <option selected="true" disabled="disabled" value="">Please Select Accounts</option>
                              <option value="Accounts receivable">Accounts receivable</option>
                              <option value="Accounts payable">Accounts payable</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Show Tax On Return Line <span class="text-danger">*</span></label>
                           <select name="show_taxonreturn" class="form-control" required>
                              <option selected="true" disabled="disabled" value="">Please Select tax on return line</option>
                              <option>Tax collected on sales</option>
                              <option>Adjustments to tax on sales</option>
                              <option>Other adjustments</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">
         <a href="#" class="btn btnclr"  data-dismiss="modal"><?php echo display('Close') ?></a>
         <input type="submit" class="btn btnclr"   value=<?php echo display('Submit') ?>>
         </div>
         </form>
      </div>
   </div>
</div>
<!------ add new product-->
<form id="insert_product"  method="post">
   <div class="modal fade" id="product_info" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content" style="width: 150%; height: 140%;text-align:center;">
            <div class="modal-header btnclr" >
               <a href="#" class="close" data-dismiss="modal">&times;</a>
               <h3 class="modal-title"><?php echo display('Add New Product')?></h3>
            </div>
            <div class="modal-body">
               <div id="customeMessage" class="alert hide"></div>
<form action="ada">
<div class="panel-body">
<input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">
<div class="col-sm-6">
<div class="form-group row">
<label for="product_name" class="col-sm-4 col-form-label"><?php echo display('product_name') ?> <i class="text-danger">*</i></label>
<div class="col-sm-8">
<input class="form-control" name="product_name" type="text" id="product_name" placeholder="<?php echo display('product_name') ?>" required tabindex="1" >
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="barcode_or_qrcode" class="col-sm-4 col-form-label"><?php echo display('barcode_or_qrcode') ?> <i class="text-danger"></i></label>
<div class="col-sm-8">
<input type="text" tabindex="3" class="form-control"  style="width: 100%;" name="barcode" value=""  placeholder="Barcode/QR-code"   />
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="quantity" class="col-sm-4 col-form-label"><?php echo display('Quantity') ?> <i class="text-danger">*</i></label>
<div class="col-sm-8">
<input class="form-control" name="quantity" type="number" id="quantity" placeholder="Enter Product Quantity only" required tabindex="1" >
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="product_model" class="col-sm-4 col-form-label"><?php echo display('model') ?> <i class="text-danger">*</i></label>
<div class="col-sm-8">
<input type="text" tabindex="" class="form-control" id="product_model" name="model" required placeholder="<?php echo display('model') ?>" />
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="category_id" class="col-sm-4 col-form-label"><?php echo display('category') ?></label>
<div class="col-sm-7">
<select class="form-control" id="category_id" style="width: 250px;"  name="category_id" tabindex="3">
<option value="">Select the Category</option>
<?php if ($category_list) {
   foreach($category_list as $cn){
   ?>
<option value="<?php   echo $cn['category_name']; ?>"><?php   echo $cn['category_name']; ?></option>
<?php }} ?>
</select>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="sell_price" class="col-sm-4 col-form-label"><?php echo display('sell_price') ?> <i class="text-danger"></i> </label>
<div class="col-sm-8">
<input class="form-control" id="sell_price" name="price" type="text"  placeholder="0.00" tabindex="5" min="0">
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="" class="col-sm-4 col-form-label"><?php echo display('Supplier') ?> <i class="text-danger">*</i> </label>
<div class="col-sm-7">
<select name="supplier_id" id="supplier_id" required="" class="form-control " style="width:118%;"  tabindex="1">
<option value="">Select Supplier</option>
<?php  foreach ($all_supplier as $sup_data){  ?>
<option value="<?php echo $sup_data['supplier_id'];  ?>"><?php echo $sup_data['supplier_name'];  ?></option>
<?php }  ?>
</select>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="unit" class="col-sm-4 col-form-label"><?php echo display('unit') ?></label>
<div class="col-sm-7">
<select class="form-control" id="unit" name="unit"  style="width:250px;" tabindex="-1" aria-hidden="true">
<option value="">Select the Unit</option>
<?php if ($unit_list) {
   foreach($unit_list as $sup_data){
   ?>
<option value="<?php echo $sup_data['unit_name'];  ?>"><?php echo $sup_data['unit_name'];  ?></option>
<?php }} ?>
</select>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="col-sm-6">
<div class="form-group row">
<label for="account_category_name" class="col-sm-4 col-form-label"><?php echo display('Account Category Name')?></label>
<div class="col-sm-8">
<input class="form-control" name ="account_category_name" id="account_category_name" type="text" placeholder=" Account Category Name"   tabindex="1" >
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="account_sub_category"  class="col-sm-4 col-form-label"><?php echo display('Account Sub Category')?></label>
<div class="col-sm-8">
<input class="form-control" name ="account_sub_category" id="account_sub_category" type="text" placeholder=" Account Sub Category"  tabindex="1" >
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="col-sm-6">
<div class="form-group row">
<label for="account_category" class="col-sm-4 col-form-label"><?php echo display('Account Category')?></label>
<div class="col-sm-8">
<select id="ddl"  name="account_category" class="form-control" onchange="configureDropDownLists(this,document.getElementById('ddl2'))">
<option value=""><?php echo display('Select the Account Category')?></option>
<option value="1000 ASSETS">1000 ASSETS</option>
<option value="1200 RECEIVABLES">1200 RECEIVABLES</option>
<option value="1300 INVENTORIES">1300 INVENTORIES</option>
<option value="1400 PREPAID EXPENSES & OTHER CURRENT ASSETS">1400 PREPAID EXPENSES & OTHER CURRENT ASSETS</option>
<option value="1500 PROPERTY PLANT & EQUIPMENT">1500 PROPERTY PLANT & EQUIPMENT</option>
<option value="1600 ACCUMULATED DEPRECIATION & AMORTIZATION">1600 ACCUMULATED DEPRECIATION & AMORTIZATION</option>
<option value="1700 NON – CURRENT RECEIVABLES">1700 NON – CURRENT RECEIVABLES</option>
<option value="1800 INTERCOMPANY RECEIVABLES & 1900 OTHER NON-CURRENT ASSETS">1800 INTERCOMPANY RECEIVABLES & 1900 OTHER NON-CURRENT ASSETS</option>
<option value="2000 LIABILITIES & 2100 PAYABLES">2000 LIABILITIES & 2100 PAYABLES</option>
<option value="2200 ACCRUED COMPENSATION & RELATED ITEMS">2200 ACCRUED COMPENSATION & RELATED ITEMS</option>
<option value="2300 OTHER ACCRUED EXPENSES">2300 OTHER ACCRUED EXPENSES</option>
<option value="2500 ACCRUED TAXES">2500 ACCRUED TAXES</option>
<option value="2600 DEFERRED TAXES">2600 DEFERRED TAXES</option>
<option value="2700 LONG-TERM DEBT">2700 LONG-TERM DEBT</option>
<option value="2800 INTERCOMPANY PAYABLES & 2900 OTHER NON CURRENT LIABILITIES & 3000 OWNERS EQUITIES">2800 INTERCOMPANY PAYABLES & 2900 OTHER NON CURRENT LIABILITIES & 3000 OWNERS EQUITIES</option>
<option value="4000 REVENUE">4000 REVENUE</option>
<option value="5000 COST OF GOODS SOLD">5000 COST OF GOODS SOLD</option>
<option value="6000 – 7000 OPERATING EXPENSES">6000 – 7000 OPERATING EXPENSES</option>
</select>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="product_sub_category" class="col-sm-4 col-form-label"><?php echo display('Product Sub Category')?><i class="text-danger">*</i></label>
<div class="col-sm-8">
<select   name="product_sub_category" id="product_sub_category" class=" form-control"  required placeholder="product_sub_category" style="width:100%;">
<option value=""><?php echo display('Select the Product Sub Category') ?></option>
<option value="Granite"><?php echo display('Granite') ?></option>
<option value="Marble"><?php echo display('Marble')?></option>
<option value="Quartz"><?php echo display('Quartz') ?></option>
<option value="Quartzite"><?php echo display('Quartzite') ?></option>
<option value="Lime Stone"><?php echo display('Lime Stone') ?></option>
<option value="Dolomite"><?php echo display('Dolomite') ?></option>
<option value="Sand Stone"><?php echo display('Sand Stone') ?></option>
<option value="Soap Stone"><?php echo display('Soap Stone') ?></option>
</select>
</div>
</div>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="sub_category"  class="col-sm-4 col-form-label"><?php echo display('Account Sub Category') ?></label>
<div class="col-sm-8">
<select class="form-control" name="sub_category" id="ddl2">
<option value="Select Sub Category"><?php echo display('Select Sub Category') ?></option>
</select>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="image" class="col-sm-4 col-form-label"><?php echo display('Product Image ') ?></label>
<div class="col-sm-8">
<input type="file" name="product_image" class="form-control" id="product_image"  tabindex="4">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="col-sm-6">
<div class="form-group row">
<label for="cost_per_sqft" class="col-sm-4 col-form-label"><?php echo display('Cost perSqFt') ?> </label>
<div class="col-sm-8">
<input type="text" name="costpersqft" class="form-control" id="cost_per_sqft" tabindex="4" placeholder="cost persqft" />
</div>
</div>
<div class="form-group row">
<label for="cost_per_slab" class="col-sm-4 col-form-label"><?php echo display('Cost per Slab') ?> <i class="text-danger">*</i></label>
<div class="col-sm-8">
<input type="text" name="costperslab" class="form-control" id="cost_per_slab" tabindex="4"   required=""    placeholder="Cost per Slab" />
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="sales_price" class="col-sm-4 col-form-label"><?php echo display('Sales') ?>
Price per Sq.Ft </label>
<div class="col-sm-8">
<input type="text" name="salespricepersqft" class="form-control" id="sales_price_per_sqft" tabindex="4"  placeholder=" Sales Price perSq.Ft" />
</div>
</div>
<div class="form-group row">
<label for="sales_slab_price" class="col-sm-4 col-form-label"><?php echo display('Sales Slab Price') ?> </label>
<div class="col-sm-8">
<input type="text" name="salesslabprice" class="form-control" id="sales_slab_price" tabindex="4" placeholder=" Sales Slab Price"  />
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="col-sm-6">
<div class="form-group row">
<label for="tax_id" class="col-sm-4 col-form-label"><?php echo display('Tax')?> </label>
<div class="col-sm-8">
<input type="text" name="tax" class="form-control" id="tax_id" tabindex="4" placeholder=" Tax" />
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="country" class="col-sm-4 col-form-label"><?php echo display('Country') ?></label>
<div class="col-sm-8">
<select class="selectpicker countpicker form-control"  data-live-search="true" data-default="US-United States"
   name="country" id="country" ></select>  
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group row">
<label for="serial_no" class="col-sm-4 col-form-label"><?php echo display('Serial No') ?></label>
<div class="col-sm-8">
<input type="text" tabindex="" class="form-control " id="serial_no" name="serial_no" placeholder="111,abc,XYz"   />
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<center><label for="description" class="col-form-label"><?php echo display('product_details') ?></label></center>
<textarea class="form-control" name="description" id="description" rows="2" placeholder="<?php echo display('product_details') ?>" tabindex="2"></textarea>
</div>
</div><br>
<div class="form-group row">
<div class="col-sm-6"></div>
<div class="col-sm-6" style="text-align: -webkit-right;">
<a href="#" class="btn btnclr " style="color:white;" data-dismiss="modal"><?php echo display('Close') ?></a>
<input type="submit" id="add-product" style="color:white;" class="btn btnclr" name="insert_product" value="<?php echo display('save') ?>" tabindex="10"/>
</div>
</div>
</div>
</div>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>
<div id="myModal3" class="modal fade">
<div class="modal-dialog">
<div class="modal-content" style="text-align:center;" >
<div class="modal-header btnclr" >
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title"><?php echo  display(' Confirmation ') ?></h4>
</div>
<div class="modal-body">
<p> <?php echo  display('Your Invoice is not submitted. Would you like to submit or discard') ?>
</p>
<p class="text-warning">
<small> <?php echo  display('If you dont submit  your changes will not be saved' ) ?></small>
</p>
</div>
<div class="modal-footer">
<input type="submit" id="ok" class="btn btnclr"   onclick="submit_redirect()"  value="Submit"/>
<button id="btdelete" type="button" class="btn btnclr"  onclick="discard()"><?php echo  display('Discard') ?></button>
</div>
</div>
</div>
</div>        
<div class="modal fade" id="payment_history_modal" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content" style="width: 1000px;min-width: max-content;margin-top: 190px;text-align:center;">
<div class="modal-header btnclr"  >
<button type="button" id="history_close" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo display('PAYMENT HISTORY') ?></h4>
</div>
<div class="modal-body1">
<div id="salle_list"></div>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>
<script>
   $(document).ready(function(){
   $(".sidebar-mini").addClass('sidebar-collapse') ;
   
   
   });
   
   $(document).ready(function(){
   $('.amt').hide();
   $('.hiden').css("display","none");
      $('.removebundle').hide();
   $('.final_submit').hide();
    $('#download').hide();
     $('#print').hide();
      $('#amt').hide();
   $('#bal').hide();
   // addprod();
   
   //  currency();
   
   });
   
   
   $('#customer_id').on('change', function (e) {
   
   var data = {
       value: $('#customer_id').val()
    };
   data[csrfName] = csrfHash;
   $.ajax({
       type:'POST',
       data: data,
    
       //dataType tells jQuery to expect JSON response
       dataType:"json",
       url:'<?php echo base_url();?>Cinvoice/getcustomer_byID',
       success: function(result, statut) {
           if(result.csrfName){
              //assign the new csrfName/Hash
              csrfName = result.csrfName;
              csrfHash = result.csrfHash;
           }
          // var parsedData = JSON.parse(result);
         //  alert(result[0].p_quantity);
         console.log(result[0]['currency_type']);
          if(result[0]['tax_status']==1){
       $('#product_tax').val(result[0]['tax_percent']);
   }else{
      $('#product_tax').val(0);
   }
      $(".cus").html(result[0]['currency_type']);
       $("label[for='custocurrency']").html(result[0]['currency_type']);
      console.log('https://open.er-api.com/v6/latest/<?php echo $curn_info_default; ?>');
      $.getJSON('https://open.er-api.com/v6/latest/<?php echo $curn_info_default; ?>', 
   function(data) {
   var custo_currency=result[0]['currency_type'];
   var x=data['rates'][custo_currency];
   //  $('.cus').html(x);
   var Rate =parseFloat(x).toFixed(3);
   console.log(Rate);
   $('.hiden').show();
   Rate = isNaN(Rate) ? 0 : Rate;
   $(".custocurrency_rate").val(Rate);
   });
     
       }
   });
   <?php //defined('BASEPATH') OR exit('No direct script access allowed'); ?>
   
   });
   
   
   
   
</script>
</div>
<!-- Purchase Report End -->
<input type="text" id="hdn" name="hdn"/>
<div id="result" style="display:none;"></div>
<script>
   var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
   var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';
   
   function discard(){
      $.get(
       "<?php echo base_url(); ?>Cinvoice/deleteprofarma/", 
      { val: $("#invoice_hdn1").val(), csrfName:csrfHash,payment_id:$('#payment_id').val() }, // put your parameters here
      function(responseText){
       console.log(responseText);
       window.btn_clicked = true;      //set btn_clicked to true
       var input_hdn="Your Invoice No :"+$('#invoice_hdn').val()+" has been Discared";
     
       console.log(input_hdn);
       $('#myModal3').modal('hide');
       $("#bodyModal1").html(input_hdn);
           $('#myModal1').modal('show');
   
   
       window.setTimeout(function(){
          
   
           window.location = "<?php  echo base_url(); ?>Cinvoice/manage_profarma_invoice";
         }, 2000);
      }
   ); 
   }
   
   
   
   
   
   
   $('#insert_product').submit(function (event) {
        event.preventDefault();
   if($('#product_name').val()!='' && $('#product_model').val()!='' && $('#sell_price').val()!='' && $('#quantity').val()!='' && $('#supplier_id').val()!='' && $('#product_sub_category').val()!='')
   {
      
   
       var dataString = {
           dataString : $("#insert_product").serialize()
      };
      dataString[csrfName] = csrfHash;
       $.ajax({
           type:"POST",
           dataType:"json",
           url:"<?php echo base_url(); ?>Cproduct/insert_product",
           data:$("#insert_product").serialize(),
           success:function (data1) {
           console.log(data1);
   
           $("#magicHouses").empty();
           for (var i in data1) {
              $("<option/>").html(data1[i].product_name +'-'+ data1[i].product_model).appendTo("#magicHouses");
           }
         
          $("#magicHouses").focus();
   
         $("#bodyModal1").html("Product Added Successfully");
          
         $('#myModal1').modal('show');
   
          $('#insert_product')[0].reset();
   
   
         window.setTimeout(function(){
           $('#product_info').modal('hide');
           $('.modal-backdrop').remove();
          $('#myModal1').modal('hide');
       }, 2500);
   }
   });
   }
   });
   
   
   
   
   $(document).ready(function() {
    // Your existing script
    var sum = 0;

    // Use the 'input' event and correct the class selectors
    $(document).on('input', '.supplier_slab_no, .thickness', function() {
        sum = 0; // Reset sum on every input

        $(this).closest('table').find('tbody tr').each(function() {
            var quantity = parseFloat($(this).find('.thickness').val()) || 0;
            var rate = parseFloat($(this).find('.supplier_slab_no').val()) || 0;
            var amount = quantity * rate;
            
            // Update the amount in the specific input field with class 'sum_amount'
            $(this).find('.total_price').val(amount.toFixed(2));

            sum += amount;
        });

        var totalInput = $(this).closest('table').find('.b_total');
        totalInput.val(sum.toFixed(2));
        calculate();
    });
});














   
   
   
        function submit_redirect(){
           window.btn_clicked = true;      //set btn_clicked to true
       var input_hdn="Your Invoice No :"+$('#invoice_hdn').val()+" has been created Successfully";
     
       console.log(input_hdn);
       $('#myModal3').modal('hide');
       $("#bodyModal1").html(input_hdn);
       $('#myModal1').modal('show');
       window.setTimeout(function(){
          
   
           window.location = "<?php  echo base_url(); ?>Cinvoice/manage_profarma_invoice";
         }, 2000);
        }
   //      $('#email').on('click', function (e) {
   // // var link=localStorage.getItem("truck");
   // // console.log(link);
   //  var popout = window.open("<?php  echo base_url(); ?>Cinvoice/proforma_with_attachment_cus/"+$('#invoice_hdn1').val());
   //     // window.setTimeout(function(){
   //     //     popout.close();
   //     //  }, 1500);
   //       e.preventDefault();
   // });
   $('#insert_trucking').submit(function (event) {
      
          
       var dataString = {
           dataString : $("#insert_trucking").serialize()
       
      };
      dataString[csrfName] = csrfHash;
     
       $.ajax({
           type:"POST",
           dataType:"json",
           url:"<?php echo base_url(); ?>Cinvoice/performer_ins",
           data:$("#insert_trucking").serialize(),
   
           success:function (data) {
           console.log(data);
           var input_hdn="Estimate created Successfully";
           $("#bodyModal1").html(input_hdn);
           $('#myModal1').modal('show');
       $('.amt').show();
         $('.final_submit').show();
        $('#download').show();
         $('#print').show();
       window.setTimeout(function(){
           $('.modal').modal('hide');
          
   $('.modal-backdrop').remove();
    },2500);
   
               var split = data.split("/");
               $('#invoice_hdn1').val(split[0]);
            
        
            $('#invoice_hdn').val(split[1]);
          }
   
       });
       event.preventDefault();
   });
   $('#download').on('click', function (e) {
   // var link=localStorage.getItem("truck");
   // console.log(link);
    var popout = window.open("<?php  echo base_url(); ?>Cinvoice/performa_pdf/"+$('#invoice_hdn1').val());
    
     
   
   });  
   $('#print').on('click', function (e) {
   // var link=localStorage.getItem("truck");
   // console.log(link);
    var popout = window.open("<?php  echo base_url(); ?>Cinvoice/performa_print/"+$('#invoice_hdn1').val());
    
     
   
   }); 
   // $('#email').on('click', function (e) {
   // // var link=localStorage.getItem("truck");
   // // console.log(link);
   //  var popout = window.open("<?php  echo base_url(); ?>Cinvoice/proforma_with_attachment_cus/"+$('#invoice_hdn1').val());
    
   //     // window.setTimeout(function(){
   //     //     popout.close();
      
   //     //  }, 1500);
   //       e.preventDefault();
   
   // }); 
   $(document).ready(function () {
 

 $(".cscheTable tbody").sortable();
 $(".cscheTable tbody").disableSelection();

 $(".ui-sortable").hover(function () {
  });

 $(".addrow").on("click", function () {
     var newRow = $(this).closest("tbody");
     var counter = newRow.find('tr').length + 1;
     var cols = "<tr>";

     cols += '<td class="col-sm-1 class_so_tt">' +
        '<input type="hidden" name="tableid[]" id="tableid_' + dynamic_id + '" />' +
        '<input type="text" name="prodt[]" id="prodt_' + dynamic_id + '" class="form-control" />' +
    '</td>';

     cols += '<td class="col-sm-5"><input type="text" name="description[]"  id="description_'+ dynamic_id +'"  class="form-control" /></td>';
     cols += '<td class="col-sm-5"><div class="input-group"><input type="text" name="thickness[]"  id="thickness_'+ dynamic_id +'"  class="thickness form-control"/><button class="btn-cSche"><i class="fa fa-link" aria-hidden="true"></i></button></span></div></td>';
     cols += '<td class="col-sm-5"><div class="input-group"><input type="text" name="supplier_slab_no[]"   id="supplier_slab_no_'+ dynamic_id +'"           class="supplier_slab_no form-control"/> </span></div></td>';
     cols += '<td class="col-sm-5"><div class="input-group"><input class="sum_amount form-control mobile_price" type="text" style="width: 90px;" readonly name="total_price[]" id="total_price_'+ dynamic_id +'"        placeholder="0.00" /></span></div></td>';
     cols += '<td class="col-sm-1"><button class="delete btn btn-danger" type="button" value="Delete"><i class="fa fa-trash"></i></button></td>';
     cols += '<td class="col-sm-1"><button class="ibtnDel btn-cSche delete" id="deleterow"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>';
     cols += "</tr>";

     newRow.prepend(cols);
     //add_stt();
 });

 




 
 $(document).on("click", ".addRowButton", function () {
    debugger;
    var newRow = $(this).closest("tr").clone();

    // Get the current row count
    var rowCount = $('#normalinvoice_1 tbody tr').length;
   newRow.find('input').val('');
    // Set the value of the new row's .tableid input to the row count
    newRow.find('.tableid').val(rowCount+1);

    // Clear input values in the new row


    // Change the class and HTML of the delete button in the new row
    newRow.find('.delete').removeClass('delete').addClass('delete').html('<i class="fa fa-trash-o" aria-hidden="true"></i>');

    // Insert the new row after the current row
    $(this).closest("tr").after(newRow);
    // add_stt();
});


});


   
   $('.final_submit').on('click', function (e) {
    e.preventDefault();
       window.btn_clicked = true;      //set btn_clicked to true
       var input_hdn="Your Invoice No :"+$('#invoice_hdn').val()+" has been created Successfully";
     
       console.log(input_hdn);
       $("#bodyModal1").html(input_hdn);
           $('#myModal1').modal('show');
       window.setTimeout(function(){
          
   
           window.location = "<?php  echo base_url(); ?>Cinvoice/manage_profarma_invoice";
         }, 2000);
          
   });
   
   window.onbeforeunload = function(){
       if(!window.btn_clicked){
          // window.btn_clicked = true; 
           $('#myModal3').modal('show');
          return false;
       }
   };
    
   $(document).ready(function(){
      $('.removebundle').hide();
   $('#amt').hide();
   $('#bal').hide();
       });
      $("#reset").on("click", function () {
       $('#product_tax').val("Select the Tax");
   
   });
       $('#terms').change(function(){
          $('#payment_due_date').val('');
     var sd = $(this).val().replace(/[^0-9]/gi, ''); 
   var number = parseInt(sd, 10);
          var data = {
              sales_invoice_date : $('#date').val(),
              days :number,   
              pterms : $('#payment_terms').val()
          
          };
          data[csrfName] = csrfHash;
      
          $.ajax({
              type:'POST',
              data: data, 
             dataType:"json",
              url:'<?php echo base_url();?>Cinvoice/getdate',
              success: function(result, statut) {
               
                 $('#payment_due_date').val(result);
             }
          });
      });
   function calculate(){
   
     var total=$('.b_total').val();
    var tax= $('#product_tax').val();
     var percent='';
     var hypen='-';
   if(tax.indexOf(hypen) != -1){
    var field = tax.split('-');
   
    var percent = field[1];
   
   }else{
   percent=tax;
   }
    percent=percent.replace("%","");
     var answer = (percent / 100) * parseInt(total);
   
     
      var gtotal = parseInt(total + answer);
      console.log("gtotal :" +gtotal);
   
   
   
     var final_g= $('#final_gtotal').val();
   
   
     var amt=parseInt(answer)+parseInt(total);
     var num = isNaN(parseInt(amt)) ? 0 : parseInt(amt)
       $('#gtotal').val(num); 
     var custo_amt=$('.custocurrency_rate').val(); 
     console.log("numhere :"+num +"-"+custo_amt);
     var value=num*custo_amt;
     var custo_final = isNaN(parseInt(value)) ? 0 : parseInt(value)
    $('#customer_gtotal').val(custo_final); 
     $('#tax_details').val(answer.toFixed(3) +" ( "+tax+" )");
   var bal_amt=custo_final-$('#amount_paid').val();
   $('#balance').val(bal_amt);
   
   }
   
   
   
   
   
   
   $( document ).ready(function() {
   //$('.hidden_button').hide();
   
   
   $('#instant_customer').submit(function (event) {
       var dataString = {
           dataString : $("#instant_customer").serialize()
      };
      dataString[csrfName] = csrfHash;
       $.ajax({
           type:"POST",
           dataType:"json",
           url:"<?php echo base_url(); ?>Cinvoice/instant_customer",
           data:$("#instant_customer").serialize(),
           success:function (data1) {
    var $select = $('select#customer_id');
               $select.empty();
       
                 for(var i = 0; i < data1.length; i++) {
           var option = $('<option/>').attr('value', data1[i].customer_id).text(data1[i].customer_name);
           $select.append(option); // append new options
       }
         $("#instant_customer").find('input:text').val(''); 
          $("#bodyModal1").html("New Customer Added Successfully");
         $('#customer_id').show();
         $('#myModal1').modal('show');
         $('#cust_info').modal('hide');
        
           $('#instant_customer')[0].reset();  
   
       
         window.setTimeout(function(){
          $('#myModal1').modal('hide');
          $('.modal-backdrop').remove();
   
   },2500);
         //  console.log(data);
           }
       });
       event.preventDefault();
   });
   $('.hiden').css("display","none");
   
   });
   $(document).on('change input keyup','.sales_amt_sq_ft', function (e) {
   
      var netheight = $(this).attr('id');
   const indexLastDot = netheight.lastIndexOf('_');
   var id_num = netheight.slice(indexLastDot + 1);
      var sales_amt_sq_ft=$('#sales_amt_sq_ft_'+id_num).val();
      var net_sq_ft=$('#net_sq_ft_'+id_num).val();
    var netresult =sales_amt_sq_ft* net_sq_ft;
   netresult = isNaN(netresult) ? 0 : netresult;
   var nresult=netresult.toFixed(3);
   $('#'+'sales_slab_amt_'+id_num).val(netresult.toFixed(3));
   $(this).closest('tr').find('.total_price').val(netresult.toFixed(3));
   var overall_sum=0;
        $('.table').find('.total_price').each(function() {
   var v=$(this).val();
     overall_sum += parseFloat(v);
   });
    $('#Over_all_Total').val(overall_sum.toFixed(3)).trigger('change');
          var sum=0;
        $(this).closest('table').find('.total_price').each(function() {
   var v=$(this).val();
     sum += parseFloat(v);
   });
    $(this).closest('table').find('.b_total').val(sum.toFixed(3)).trigger('change');
      var sales_amt_sq_ft=0;
      $(this).closest('table').find('.sales_amt_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sales_amt_sq_ft += parseFloat(precio);
           }
         });
    $(this).closest('table').find('.salespricepersqft').val(sales_amt_sq_ft).trigger('change');
      var sales_slab_amt=0;
      $(this).closest('table').find('.sales_slab_amt').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sales_slab_amt += parseFloat(precio);
           }
         });
   $(this).closest('table').find('.salesslabprice').val(sales_slab_amt).trigger('change');
      
    calculate();
     });
         $(document).on('change input keyup','.sales_slab_amt', function (e) {
         
     var netheight = $(this).attr('id');
   const indexLastDot = netheight.lastIndexOf('_');
   var id_num = netheight.slice(indexLastDot + 1);
     
      var sales_slab_amt=$('#sales_slab_amt_'+id_num).val();
      var net_sq_ft=$('#net_sq_ft_'+id_num).val();
    var netresult =sales_slab_amt/net_sq_ft;
   netresult = isNaN(netresult) ? 0 : netresult;
   var nresult=netresult.toFixed(3);
   $('#'+'sales_amt_sq_ft_'+id_num).val(netresult.toFixed(3));
   $('#total_amt_'+id_num).val(sales_slab_amt);
   var overall_sum=0;
        $('.table').find('.total_price').each(function() {
   var v=$(this).val();
     overall_sum += parseFloat(v);
   });
    $('#Over_all_Total').val(overall_sum.toFixed(3)).trigger('change');
          var sum=0;
        $(this).closest('table').find('.total_price').each(function() {
   var v=$(this).val();
     sum += parseFloat(v);
   });
    $(this).closest('table').find('.b_total').val(sum.toFixed(3)).trigger('change');
     var sales_slab_amt=0;
      $(this).closest('table').find('.sales_slab_amt').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sales_slab_amt += parseFloat(precio);
           }
         });
   $(this).closest('table').find('.salesslabprice').val(sales_slab_amt).trigger('change');
       var sales_amt_sq_ft=0;
      $(this).closest('table').find('.sales_amt_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sales_amt_sq_ft += parseFloat(precio);
           }
         });
    $(this).closest('table').find('.salespricepersqft').val(sales_amt_sq_ft).trigger('change');
    
   calculate();
     });
   $(document).on('change', '.product_name', function(){
   
    var netheight = $(this).attr('id');
   const indexLastDot = netheight.lastIndexOf('_');
   var id = netheight.slice(indexLastDot + 1);
   $('#tableid_'+id).val(id);
   var net_width='net_width_'+id;
   var net_height = 'net_height_'+ id;
   var netwidth=$('#'+net_width).val();
   var netheight=$('#'+net_height).val();
   var netresult=parseInt(netwidth) * parseInt(netheight);
   netresult=netresult/144;
   netresult = isNaN(netresult) ? 0 : netresult;
   var nresult=netresult.toFixed(3);
   
   $('#'+'net_sq_ft_'+id).val(netresult.toFixed(3));
   var sales_slab_price=$('#sales_slab_amt_'+id).val();
   
   var sales_amt_sq_ft=sales_slab_price / nresult;
   
   sales_amt_sq_ft = isNaN(sales_amt_sq_ft) ? 0 : sales_amt_sq_ft;
   $('#'+'sales_amt_sq_ft_'+id).val(sales_amt_sq_ft.toFixed(3));
   $('#'+'total_amt_'+id).val(sales_slab_price.toFixed(3));
   calculate();
   });
   
   // Restricts input for each element in the set of matched elements to the given inputFilter.
   (function($) {
     $.fn.inputFilter = function(callback, errMsg) {
       return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
         if (callback(this.value)) {
           // Accepted value
           if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
             $(this).removeClass("input-error");
             this.setCustomValidity("");
           }
           this.oldValue = this.value;
           this.oldSelectionStart = this.selectionStart;
           this.oldSelectionEnd = this.selectionEnd;
         } else if (this.hasOwnProperty("oldValue")) {
           // Rejected value - restore the previous one
           $(this).addClass("input-error");
           this.setCustomValidity(errMsg);
           this.reportValidity();
           this.value = this.oldValue;
           this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
         } else {
           // Rejected value - nothing to restore
           this.value = "";
         }
       });
     };
   }(jQuery));
   
   $(".custocurrency_rate").inputFilter(function(value) {
     return /^-?\d*[.,]?\d*$/.test(value); }, "Must be a floating (real) Number");
   
   
   
   $('#product_tax').on('change', function (e) {
     
        var optionSelected = $("option:selected", this);
       var valueSelected = this.value;
       var total=$('#Over_all_Total').val();
   var tax= $('#product_tax').val();
     var percent='';
     var hypen='-';
   if(tax.indexOf(hypen) != -1){
    var field = tax.split('-');
   
    var percent = field[1];
   
   }else{
   percent=tax;
   }
    percent=percent.replace("%","");
    var answer = (percent / 100) * parseInt(total);
   
     
     var gtotal = parseInt(total + answer);
     console.log("gtotal :" +gtotal);
     $('#gtotal').val(gtotal); 
     var amt=parseInt(answer)+parseInt(total);
     var num = isNaN(parseInt(amt)) ? 0 : parseInt(amt)
   var custo_amt=$('.custocurrency_rate').val(); 
     console.log("numhere :"+num +"-"+custo_amt);
     var value=num*custo_amt;
     var custo_final = isNaN(parseInt(value)) ? 0 : parseInt(value)
    $('#customer_gtotal').val(custo_final);  
   $('#final_gtotal').val(answer);
      $('#hdn').val(valueSelected);
      console.log("taxi :"+valueSelected);
     $('#tax_details').val(answer.toFixed(3) +" ( "+tax+" )");
     calculate();
      payment_info();
   });
   $('#product_tax').on('change', function (e) {
   
   var total=$('#Over_all_Total').val();
    var tax= $('#product_tax').val();
   
     var percent='';
     var hypen='-';
   if(tax.indexOf(hypen) != -1){
    var field = tax.split('-');
   
    var percent = field[1];
   
   }else{
   percent=tax;
   }
    percent=percent.replace("%","");
     var answer = (percent / 100) * parseInt(total);
   
     
      var gtotal = parseInt(total + answer);
      console.log("gtotal :" +gtotal);
   
   
   
     var final_g= $('#final_gtotal').val();
   
   
     var amt=parseInt(answer)+parseInt(total);
     var num = isNaN(parseInt(amt)) ? 0 : parseInt(amt)
       $('#gtotal').val(num); 
     var custo_amt=$('.custocurrency_rate').val(); 
     console.log("numhere :"+num +"-"+custo_amt);
     var value=num*custo_amt;
     var custo_final = isNaN(parseInt(value)) ? 0 : parseInt(value)
    $('#customer_gtotal').val(custo_final);  
    calculate();
    });
   var arr=[];
   
   
   function gt(id){
   debugger;
   var final_g= $('#final_gtotal').val();
   
   var first=$("#Over_all_Total").val();
       var tax= $('#product_tax').val();
     var percent='';
     var hypen='-';
   if(tax.indexOf(hypen) != -1){
    var field = tax.split('-');
   
    var percent = field[1];
   
   }else{
   percent=tax;
   }
    percent=percent.replace("%","");
   // var field = tax.split('-');
   
   // var percent = field[1];
   var answer=0;
    
     var answer =(parseInt(percent) / 100) * parseInt(first);
      answer = isNaN(parseInt(answer)) ? 0 : parseInt(answer);
      console.log(answer);
      $('#tax_details').val(answer.toFixed(3) +" ( "+tax+" )");
   
     var gtotal = parseInt(first + answer);
     console.log(gtotal);
   var amt=parseInt(answer)+parseInt(first);
    var num = isNaN(parseInt(amt)) ? 0 : parseInt(amt);
    var custo_amt=$('.custocurrency_rate').val();
    $("#gtotal").val(num);  
    console.log(num +"-"+custo_amt);
    localStorage.setItem("customer_grand_amount_sale",num);
   
    var value=num*custo_amt;
    var custo_final = isNaN(parseInt(value)) ? 0 : parseInt(value)
   $('#customer_gtotal').val(custo_final);
   var bal_amt=custo_final-$('#amount_paid').val();
   $('#balance').val(bal_amt);
   
   
   
   }
   
   
   function payment_info(){
      
     var data = {
          gtotal:$('#gtotal').val(),
          customer_name:$('#customer_name').val()
     
       };
       data[csrfName] = csrfHash;
   
       $.ajax({
           type:'POST',
           data: data, 
        dataType:"json",
           url:'<?php echo base_url();?>Cinvoice/get_payment_info',
           success: function(result, statut) {
              
             $("#amount_paid").val(result[0]['amt_paid']);
             $("#balance").val(result[0]['balance']);
               console.log(result);
           }
       });
   }
     function configureDropDownLists(ddl1,ddl2) {
   var assets = ['1010 CASH Operating Account', '1020 CASH Debitors', '1030 CASH Petty Cash'];
   var receivables = ['1210 A/REC Trade', '1220 A/REC Trade Notes Receivable', '1230 A/REC Installment Receivables','1240 A/REC Retainage Withheld','1290 A/REC Allowance for Uncollectible Accounts'];
   var inventories = ['1310 INV – Reserved', '1320 INV – Work-in-Progress', '1330 INV – Finished Goods','1340 INV – Reserved','1350 INV – Unbilled Cost & Fees','1390 INV – Reserve for Obsolescence'];
   var prepaid_expense = ['1410 PREPAID – Insurance', '1420 PREPAID – Real Estate Taxes', '1430 PREPAID – Repairs & Maintenance','1440 PREPAID – Rent','1450 PREPAID – Deposits'];
   var property_plant = ['1510 PPE – Buildings', '1520 PPE – Machinery & Equipment', '1530 PPE – Vehicles','1540 PPE – Computer Equipment','1550 PPE – Furniture & Fixtures','1560 PPE – Leasehold Improvements'];
   var acc_dep = ['1610 ACCUM DEPR Buildings', '1620 ACCUM DEPR Machinery & Equipment', '1630 ACCUM DEPR Vehicles','1640 ACCUM DEPR Computer Equipment','1650 ACCUM DEPR Furniture & Fixtures','1660 ACCUM DEPR Leasehold Improvements'];
   var noncurrenctreceivables = ['1710 NCA – Notes Receivable', '1720 NCA – Installment Receivables', '1730 NCA – Retainage Withheld'];
   var intercompany_receivables = ['1910 Organization Costs', '1920 Patents & Licenses', '1930 Intangible Assets – Capitalized Software Costs'];
   var liabilities = ['2110 A/P Trade', '2120 A/P Accrued Accounts Payable', '2130 A/P Retainage Withheld','2150 Current Maturities of Long-Term Debt','2160 Bank Notes Payable','2170 Construction Loans Payable'];
   var accrued_compensation = ['2210 Accrued – Payroll', '2220 Accrued – Commissions', '2230 Accrued – FICA','2240 Accrued – Unemployment Taxes','2250 Accrued – Workmen’s Comp'];
   var other_accrued_expenses = ['2310 Accrued – Rent', '2320 Accrued – Interest', '2330 Accrued – Property Taxes', '2340 Accrued – Warranty Expense'];
   var accrued_taxes= ['2510 Accrued – Federal Income Taxes', '2520 Accrued – State Income Taxes', '2530 Accrued – Franchise Taxes','2540 Deferred – FIT Current','2550 Deferred – State Income Taxes'];
   var deferred_taxes= ['2610 D/T – FIT – NON CURRENT', '2620 D/T – SIT – NON CURRENT'];
   var long_term_debt=['2710 LTD – Notes Payable','2720 LTD – Mortgages Payable','2730 LTD – Installment Notes Payable'];
   var intercompany_payables=['3100 Common Stock','3200 Preferred Stock','3300 Paid in Capital','3400 Partners Capital','3500 Member Contributions','3900 Retained Earnings'];
   var revenue=['4010 REVENUE – PRODUCT 1','4020 REVENUE – PRODUCT 2','4030 REVENUE – PRODUCT 3','4040 REVENUE – PRODUCT 4','4600 Interest Income','4700 Other Income','4800 Finance Charge Income','4900 Sales Returns and Allowances','4950 Sales Discounts'];
   var cost_goods= ['5010 COGS – PRODUCT 1', '5020 COGS – PRODUCT 2','5030 COGS – PRODUCT 3','5040 COGS – PRODUCT 4','5700 Freight','5800 Inventory Adjustments','5900 Purchase Returns and Allowances','5950 Reserved'];
   var operating_expenses=['6010 Advertising Expense','6050 Amortization Expense','6100 Auto Expense','6150 Bad Debt Expense','6150 Bad Debt Expense','6200 Bank Charges','6250 Cash Over and Short','6300 Commission Expense','6350 Depreciation Expense','6400 Employee Benefit Program','6550 Freight Expense','6600 Gifts Expense','6650 Insurance – General','6700 Interest Expense','6750 Professional Fees','6800 License Expense','6850 Maintenance Expense','6900 Meals and Entertainment','6950 Office Expense','7000 Payroll Taxes','7050 Printing','7150 Postage','7200 Rent','7250 Repairs Expense','7300 Salaries Expense','7350 Supplies Expense','7400 Taxes – FIT Expense','7500 Utilities Expense','7900 Gain/Loss on Sale of Assets'];
   switch (ddl1.value) {
   case '1000 ASSETS':
   ddl2.options.length = 0;
   for (i = 0; i < assets.length; i++) {
   createOption(ddl2, assets[i], assets[i]);
   }
   break;
   case '1200 RECEIVABLES':
   ddl2.options.length = 0;
   for (i = 0; i < receivables.length; i++) {
   createOption(ddl2, receivables[i], receivables[i]);
   }
   break;
   case '1300 INVENTORIES':
   ddl2.options.length = 0;
   for (i = 0; i < inventories.length; i++) {
   createOption(ddl2, inventories[i], inventories[i]);
   }
   break;
   case '1400 PREPAID EXPENSES & OTHER CURRENT ASSETS':
   ddl2.options.length = 0;
   for (i = 0; i < prepaid_expense.length; i++) {
   createOption(ddl2, prepaid_expense[i], prepaid_expense[i]);
   }
   break;
   case '1500 PROPERTY PLANT & EQUIPMENT':
   ddl2.options.length = 0;
   for (i = 0; i < property_plant.length; i++) {
   createOption(ddl2, property_plant[i], property_plant[i]);
   }
   break;
   case '1600 ACCUMULATED DEPRECIATION & AMORTIZATION':
   ddl2.options.length = 0;
   for (i = 0; i < acc_dep.length; i++) {
   createOption(ddl2, acc_dep[i], acc_dep[i]);
   }
   break;
   case '1700 NON – CURRENT RECEIVABLES':
   ddl2.options.length = 0;
   for (i = 0; i < noncurrenctreceivables.length; i++) {
   createOption(ddl2, noncurrenctreceivables[i], noncurrenctreceivables[i]);
   }
   break;
   case '1800 INTERCOMPANY RECEIVABLES & 1900 OTHER NON-CURRENT ASSETS':
   ddl2.options.length = 0;
   for (i = 0; i < intercompany_receivables.length; i++) {
   createOption(ddl2, intercompany_receivables[i], intercompany_receivables[i]);
   }
   break;
   case '2000 LIABILITIES & 2100 PAYABLES':
   ddl2.options.length = 0;
   for (i = 0; i < liabilities.length; i++) {
   createOption(ddl2, liabilities[i], liabilities[i]);
   }
   break;
   case '2200 ACCRUED COMPENSATION & RELATED ITEMS':
   ddl2.options.length = 0;
   for (i = 0; i < accrued_compensation.length; i++) {
   createOption(ddl2, accrued_compensation[i], accrued_compensation[i]);
   }
   break;
   case '2300 OTHER ACCRUED EXPENSES':
   ddl2.options.length = 0;
   for (i = 0; i < other_accrued_expenses.length; i++) {
   createOption(ddl2, other_accrued_expenses[i], other_accrued_expenses[i]);
   }
   break;
   case '2500 ACCRUED TAXES':
   ddl2.options.length = 0;
   for (i = 0; i < accrued_taxes.length; i++) {
   createOption(ddl2, accrued_taxes[i], accrued_taxes[i]);
   }
   break;
   case '2600 DEFERRED TAXES':
   ddl2.options.length = 0;
   for (i = 0; i < deferred_taxes.length; i++) {
   createOption(ddl2, deferred_taxes[i], deferred_taxes[i]);
   }
   break;
   case '2700 LONG-TERM DEBT':
   ddl2.options.length = 0;
   for (i = 0; i < long_term_debt.length; i++) {
   createOption(ddl2, long_term_debt[i], long_term_debt[i]);
   }
   break;
   case '2800 INTERCOMPANY PAYABLES & 2900 OTHER NON CURRENT LIABILITIES & 3000 OWNERS EQUITIES':
   ddl2.options.length = 0;
   for (i = 0; i < intercompany_payables.length; i++) {
   createOption(ddl2, intercompany_payables[i], intercompany_payables[i]);
   }
   break;
   case '4000 REVENUE':
   ddl2.options.length = 0;
   for (i = 0; i < revenue.length; i++) {
   createOption(ddl2, revenue[i], revenue[i]);
   }
   break;
   case '5000 COST OF GOODS SOLD':
   ddl2.options.length = 0;
   for (i = 0; i < cost_goods.length; i++) {
   createOption(ddl2, cost_goods[i], cost_goods[i]);
   }
   break;
   case '6000 – 7000 OPERATING EXPENSES':
   ddl2.options.length = 0;
   for (i = 0; i < operating_expenses.length; i++) {
   createOption(ddl2, operating_expenses[i], operating_expenses[i]);
   }
   break;
   default:
   ddl2.options.length = 0;
   break;
   }
   }
   function createOption(ddl, text, value) {
   var opt = document.createElement('option');
   opt.value = value;
   opt.text = text;
   ddl.options.add(opt);
   }
      let dynamic_id=2;
       function addbundle(){
            $(this).closest('table').find('.addbundle').css("display","none");
         $(this).closest('table').find('.removebundle').css("display","block");
   
   var newdiv = document.createElement('div');
   var tabin="crate_wrap_"+dynamic_id;
   
   newdiv = document.createElement("div");
   
   newdiv.innerHTML ='<table class="table normalinvoice table-bordered table-hover"  style="border:2px solid #d7d4d6;table-layout: auto;"     id="normalinvoice_'+ dynamic_id +'"> <thead> <tr> <th rowspan="2" class="text-center" style="width: 170px;" ><?php echo display('product_name'); ?><i class="text-danger">*</i></th> <th rowspan="2"  class="text-center"><?php echo display('Bundle No');?><i class="text-danger">*</i></th> <th rowspan="2"  class="text-center"><?php echo  display('description'); ?></th> <th rowspan="2" style="width:60px;" class="text-center"><?php echo display('Thick ness');?><i class="text-danger">*</i></th> <th rowspan="2" class="text-center"><?php echo display('Supplier Block No');?><i class="text-danger">*</i></th>  <th rowspan="2" class="text-center" ><?php echo display('Supplier Slab No');?><i class="text-danger">*</i> </th> <th colspan="2" style="width:150px;" class="text-center"><?php echo display('Gross Measurement');?><i class="text-danger">*</i> </th> <th rowspan="2" class="text-center"><?php echo display('Gross Sq.Ft');?></th>  <th rowspan="2" style="width:40px;" class="text-center"><?php echo display('Slab No');?><i class="text-danger">*</i></th> <th colspan="2" style="width:150px;" class="text-center"><?php echo display('Net Measure');?><i class="text-danger">*</i></th> <th rowspan="2" class="text-center"><?php echo display('Net Sq.Ft');?></th> <th rowspan="2" class="text-center"><?php echo display('Cost per Sq.Ft');?></th> <th rowspan="2"  class="text-center"><?php echo display('Cost per Slab');?></th> <th rowspan="2"  class="text-center"><?php echo display('sales'); ?><br/><?php echo display('Price per Sq.Ft');?></th> <th rowspan="2"  class="text-center"><?php echo display('Sales Slab Price');?></th> <th rowspan="2" class="text-center"><?php echo display('Weight');?></th> <th rowspan="2" style="width: 100px" class="text-center"><?php  echo  display('total'); ?></th> <th rowspan="2" class="text-center"><?php  echo  display('action'); ?></th> </tr>  <tr> <th class="text-center"><?php echo display('Width');?></th> <th class="text-center"><?php echo display('Height');?></th> <th class="text-center"><?php echo display('Width');?></th> <th class="text-center"><?php echo display('Height');?></th> </tr>  </thead> <tbody id="addPurchaseItem_'+ dynamic_id +'"> <tr> <input type="hidden" name="tableid[]" id="tableid_'+ dynamic_id +'"/><td> <input   list="magicHouses"  style="width:160px;" name="prodt[]" id="prodt_'+ dynamic_id +'"   class="form-control product_name"  placeholder="Search Product" > <datalist id="magicHouses"> <option value="Select the Product" selected>Select the Product</option> <?php  foreach($product as $tx){?>  <option value="<?php echo $tx["product_name"]."-".$tx["product_model"];?>">  <?php echo $tx["product_name"]."-".$tx["product_model"];  ?></option> <?php } ?> </datalist> <input type="hidden" class="common_product autocomplete_hidden_value  product_id_'+ dynamic_id +'" name="product_id[]" id="SchoolHiddenId_'+ dynamic_id +'" /> </td> <td>  <input list="magic_bundle" name="bundle_no[]" id="bundle_no_'+ dynamic_id +'"   class="form-control bundle_no"'+
     'onchange="this.blur();" /><datalist id="magic_bundle"><?php foreach($bundle as $tx){?> <option value="<?php echo $tx['bundle_no'];?>">  <?php echo $tx['bundle_no'];  ?></option> <?php } ?>'+
   
   '</datalist></td> <td> <input type="text" id="description_'+ dynamic_id +'" name="description[]" class="form-control" /> </td>  <td > <input type="text" name="thickness[]" id="thickness_'+ dynamic_id +'" required="" class="form-control"/> </td>  <td><input list="magic_supplier_block" name="supplier_block_no[]"  id="supplier_b_no_'+ dynamic_id +'"   class="form-control supplier_block_no"  placeholder="Search Product"  onchange="this.blur();" /><datalist id="magic_supplier_block"><?php foreach($supplier_block_no as $tx){?><option value="<?php echo $tx['supplier_block_no'];?>">  <?php echo $tx['supplier_block_no'];  ?></option><?php } ?></datalist> </td>  <td > <input type="text"  id="supplier_s_no_'+ dynamic_id +'" name="supplier_slab_no[]" required="" class="form-control"/> </td> <td> <input type="text" id="gross_width_'+ dynamic_id +'" name="gross_width[]" required="" class="gross_width  form-control" /> </td> <td> <input type="text" id="gross_height_'+ dynamic_id +'" name="gross_height[]"  required="" class="gross_height form-control" /> </td>  <td > <input type="text"   style="width:60px;" readonly id="gross_sq_ft_'+ dynamic_id +'" name="gross_sq_ft[]" class="gross_sq_ft form-control"/> </td>   <td style="text-align:center;" >  <input type="text"   style="width:20px;" value="1" class="slab_no" id="slab_no_'+ dynamic_id +'" name="slab_no[]"   readonly  required=""/>  </td> <td> <input type="text" id="net_width_'+ dynamic_id +'" name="net_width[]" required="" class="net_width form-control" /> </td> <td> <input type="text" id="net_height_'+ dynamic_id +'" name="net_height[]"    required="" class="net_height form-control" /> </td> <td > <input type="text"   style="width:60px;" readonly id="net_sq_ft_'+ dynamic_id +'" name="net_sq_ft[]" class="net_sq_ft form-control"/> </td> <td>   <span class="input-symbol-euro"><input type="text" id="cost_sq_ft_'+ dynamic_id +'"  name="cost_sq_ft[]" readonly  style="width:70px;" value="0.00"  class="cost_sq_ft form-control" ></span>   <td >  <span class="input-symbol-euro"> <input type="text"  id="cost_sq_slab_'+ dynamic_id +'" name="cost_sq_slab[]" readonly   style="width:70px;" value="0.00"  class="cost_sq_slab form-control"/></span>     </td> <td>  <span class="input-symbol-euro">  <input type="text" id="sales_amt_sq_ft_'+ dynamic_id +'"  name="sales_amt_sq_ft[]"  style="width:70px;"  value="0.00" class="sales_amt_sq_ft form-control" /></span>     </td>  <td >  <span class="input-symbol-euro">   <input type="text"  id="sales_slab_amt_'+ dynamic_id +'" name="sales_slab_amt[]"  style="width:70px;" value="0.00"  class="sales_slab_amt form-control"/></td> </span>     </td> <td> <input type="text" id="weight_'+ dynamic_id +'" name="weight[]"  class="weight form-control" /> </td>    <td > <span class="input-symbol-euro"><input  type="text" class="total_price form-control" style="width:80px;" readonly placeholder="0.00"  id="total_'+ dynamic_id +'"     name="total_amt[]"/></span> </td>  <td style="text-align:center;"> <button  class="delete btn btn-danger" id="delete_'+ dynamic_id +'" type="button" value="Delete" ><i class="fa fa-trash"></i></button> </td>  </tr> </tbody> <tfoot> <tr> <td style="text-align:right;" colspan="8"><b>Gross Sq.Ft :</b></td> <td > <input type="text" id="overall_gross_'+ dynamic_id +'" name="overall_gross[]"   class="overall_gross form-control" style="width: 60px"  readonly="readonly"  /> </td> <td style="text-align:right;" colspan="3"><b>Net Sq.Ft :</b></td> <td > <input type="text" id="overall_net_'+ dynamic_id +'" name="overall_net[]"  class="overall_net form-control"  style="width: 60px"  readonly="readonly"  /> </td> <td ><input type="text" id="costpersqft'+ dynamic_id +'" name="costpersqft[]"  class="costpersqft form-control"  style="width: 60px"  readonly="readonly"  /></td><td > <input type="text" id="costperslab_'+ dynamic_id +'" name="costperslab[]"  class="costperslab form-control"  style="width: 60px"  readonly="readonly"  /> </td>  <td > <input type="text" id="salespricepersqft_'+ dynamic_id +'" name="salespricepersqft[]"  class="salespricepersqft form-control"  style="width: 60px"  readonly="readonly"  /> </td>  <td > <input type="text" id="salesslabprice_'+ dynamic_id +'" name="salesslabprice[]"  class="salesslabprice form-control"  style="width: 60px"  readonly="readonly"  /> </td> <td ><input type="text" id="overall_weight_'+ dynamic_id +'" name="overall_weight[]"  class="overall_weight form-control"  style="width: 70px"  readonly="readonly"  /></td><td ><span class="input-symbol-euro">    <input type="text" id="Total_'+ dynamic_id +'" name="total[]"   class="b_total form-control"  style="width: 80px" value="0.00"  readonly="readonly"  /></span></td>  <td  style="text-align:center;"><i id="buddle_'+ dynamic_id +'" onclick="removebundle(); " class="btn-danger removebundle fa fa-minus" aria-hidden="true"></i></td>   </tr> </foot></table> <i id="buddle_'+ dynamic_id +'"  style="margin-right:20px;float:right;"   onclick="addbundle(); " class="btnclr addbundle fa fa-plus" aria-hidden="true"></i>';  
   
   document.getElementById('content').appendChild(newdiv);
   
   dynamic_id++;
   
   }
   localStorage.setItem('currency', '<?php echo $currency;?>');  
           var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
   var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';
   //document.querySelector('input[class="product_name"]').addEventListener('change', onInput);
   $(document).on('change select input','.product_name', function (e) {
   //function onInput (e) {
      
       var id= $(this).attr('id');
     //  var id_num = id.match(/\d/g);
   var parts = id.split('_');
   var answer_id = parts[parts.length - 1];
   
       var pdt=$('#prodt_'+answer_id).val();
          //   var tid=$(this).closest('table').attr('id');
   
   
       localStorage.setItem('tab_id', '#prodt_'+answer_id);  
       console.log('#prodt_'+answer_id);
     //  var bun_num=$('#bundle_no_'+id_num).val();
       console.log(pdt);
       const myArray = pdt.split("-");
       var product_nam=myArray[0];
       var product_model=myArray[1];
      var data = {
       
           product_nam:product_nam,
           product_model:product_model,
         //  bun_num:bun_num
        };
        data[csrfName] = csrfHash;
   
        $.ajax({
            type:'POST',
            data: data, 
         dataType:"json",
            url:'<?php echo base_url();?>Cinvoice/product_info',
            success: function(result, statut) {
                console.log(' result length :'+result.length);
                            if(result.length >0){
                              var total="<table style='width:100%;table-layout: fixed' > <tr> <td style='width: 130px;'></td>  <td><input type='text' style='width: max-content;'  class='form-control' id='myInput1' onkeyup='search()' placeholder='Search for Supplier Block no..'></td> <td></td> <td> <input type='text' style='width: max-content;'  class='form-control' id='myInput2' onkeyup='search()' placeholder='Search for Supplier Slab no..'></td> <td></td> <td>  <input type='text' style='width: max-content;' class='form-control' id='myInput3' onkeyup='search()' placeholder='Search for Bundle no..'></td> <td></td> <td></td>  </tr></table><br/>";
           var table_header = "<table style='width:auto;table-layout: fixed;word-wrap:break-word;' class='table table-bordered table-hover'  id='product_table1'> <thead> <tr><th rowspan='2' class='text-center'>Select All</th> <th rowspan='2' style='width: max-content;' class='text-center'>Product Name</th>   <th rowspan='2' style='width: max-content;' class='text-center'>Bundle No</th> <th rowspan='2' style='width: max-content;' class='text-center'>Description</th> <th rowspan='2' class='text-center'>Thick ness<i class='text-danger'>*</i></th> <th rowspan='2' class='text-center'>Supplier Block No<i class='text-danger'>*</i></th>  <th rowspan='2' class='text-center' >Supplier Slab No<i class='text-danger'>*</i> </th> <th colspan='2' style='width: max-content;' class='text-center'>Gross Measurement<i class='text-danger'>*</i> </th> <th rowspan='2' class='text-center'>Gross Sq. Ft</th> <th rowspan='2' style='width: min-content;' class='text-center'>Bundle No<i class='text-danger'>*</i></th> <th rowspan='2' style='width: min-content;' class='text-center'>Slab No<i class='text-danger'>*</i></th> <th colspan='2' style='width: max-content;' class='text-center'>Net Measure<i class='text-danger'>*</i></th> <th rowspan='2' class='text-center'>Net Sq. Ft</th> <th rowspan='2' style='width: 80px;' class='text-center'>Cost per Sq. Ft</th> <th rowspan='2' style='width: 80px;' class='text-center'>Cost per Slab</th> <th rowspan='2' style='width: 80px;' class='text-center'>Sales<br/>Price per Sq. Ft</th> <th rowspan='2'  style='width: 80px;' class='text-center'>Sales Slab Price</th> <th rowspan='2' class='text-center'>Weight</th>   <th rowspan='2' style='width: 100px' class='text-center'>Total</th> </tr>  <tr> <th class='text-center'>Width</th> <th class='text-center'>Height</th> <th class='text-center'>Width</th> <th class='text-center'>Height</th> </tr>  </thead><tbody>";
                   var html ="";
   var count=1;
                  result.forEach(function(element) {
                      var sales_price = isNaN(element.price) ? 0 : element.price;
                 html += "<tr><td><input type='checkbox' name='case[]' class='checkbox'/></td><td>"+element.product_name+'-'+element.product_model+"</td><td>"+element.bundle_no+"</td><td class='ads'   >"+element.description_table +"</td><td>"+element.thickness+"</td><td>"+element.supplier_block_no+"</td><td>"+element.supplier_slab_no+"</td><td>"+element.g_width+"</td><td>"+element.g_height+"</td><td>"+element.gross_sqft+"</td><td>"+element.bundle_no+"</td><td>"+count+"</td><td>"+element.n_width+"</td><td>"+element.n_height+"</td><td>"+element.net_sqft+"</td><td>"+element.cost_sqft+"</td><td>"+element.cost_slab+"</td><td>"+element.sales_price_sqft+"</td><td>"+element.sales_slab_price+"</td><td>"+element.weight+"</td><td>"+element.total_amt+"</td><td style='display:none'>"+sales_price+"</td></tr>";
            count++;
               });
   
   
   
                 //  var all = total+table_header +html+ table_footer;
   
                  var all = total+table_header+html ;
   
                   $('#salle_list5').html(all);
                               $('#product_model_info').modal('show');
           
   
              }else{
                 $('#product_model_info').modal('hide');
              }
           //    $(".product_id_"+ id_num).val(result[0]['product_id']);
           //      console.log(result);
            }
        });
    });
    var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
   var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';
   
   
   
     $( "body" ).on( "click", ".checkbox", function() {
   
    $('#product_model_info').modal('hide');
        var values = new Array();
   
          $.each($("input[name='case[]']:checked").closest("td").siblings("td"),
                 function () {
                      values.push($(this).text());
                 });
             console.log(values);
             console.log(table_id_product);
             
      var table_id_product=localStorage.getItem("tab_id");
                        var netheight = $(table_id_product).attr('id');
                     const indexLastDot = netheight.lastIndexOf('_');
                     var id = netheight.slice(indexLastDot + 1);
                      $(table_id_product).closest("tr").find('#prodt_'+id).val(values[0]);
                          $(table_id_product).closest("tr").find('#bundle_no_'+id).val(values[1]);
                            $(table_id_product).closest("tr").find('#description_'+id).val(values[2]);
                              $(table_id_product).closest("tr").find('#thickness_'+id).val(values[3]);
                                $(table_id_product).closest("tr").find('#supplier_b_no_'+id).val(values[4]);
                                  $(table_id_product).closest("tr").find('#supplier_s_no_'+id).val(values[5]);
                                    $(table_id_product).closest("tr").find('#gross_width_'+id).val(values[6]);
                                      $(table_id_product).closest("tr").find('#gross_height_'+id).val(values[7]);
                                        $(table_id_product).closest("tr").find('#gross_sq_ft_'+id).val(values[8]);
                                          $(table_id_product).closest("tr").find('#net_width_'+id).val(values[11]);
                                            $(table_id_product).closest("tr").find('#net_height_'+id).val(values[12]);
                                              $(table_id_product).closest("tr").find('#net_sq_ft_'+id).val(values[13]);
                                                $(table_id_product).closest("tr").find('#cost_sq_ft_'+id).val(values[14]);
                                                 $(table_id_product).closest("tr").find('#cost_sq_slab_'+id).val(values[15]);
                                                    $(table_id_product).closest("tr").find('#sales_amt_sq_ft_'+id).val(values[16]);
                                                      $(table_id_product).closest("tr").find('#sales_slab_amt_'+id).val(values[20]);
                                                        $(table_id_product).closest("tr").find('#weight_'+id).val(values[18]);
                                                       //   $(table_id_product).closest("tr").find('#origin_'+id).val(values[19]);
                                                            $(table_id_product).closest("tr").find('#total_amt_'+id).val(values[20]);
                                               var tid=$(table_id_product).closest('table').attr('id');
   
                            
   const indexLast = tid.lastIndexOf('_');
   var idt = tid.slice(indexLast + 1);
     var sum_net_val=0;
      $(table_id_product).closest('table').find('.net_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sum_net_val += parseFloat(precio);
           }
         });
   $('#overall_net_'+idt).val(sum_net_val).trigger('change');
     var sum_w=0;
      $(table_id_product).closest('table').find('.weight').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sum_w += parseFloat(precio);
           }
         });
   $('#overall_weight_'+idt).val(sum_w).trigger('change');
     var sum_gross_val=0;
      $(table_id_product).closest('table').find('.gross_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sum_gross_val += parseFloat(precio);
           }
         });
   $('#overall_gross_'+idt).val(sum_gross_val).trigger('change');
     var sum_total_val=0;
      $(table_id_product).closest('table').find('.total_price').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sum_total_val += parseFloat(precio);
           }
         });
   $('#Total_'+idt).val(sum_total_val).trigger('change');
   
   var total_net=0;
    $('.table').each(function() {
       $(this).find('.net_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             total_net += parseFloat(precio);
           }
         });
   
     });
   $('#total_net').val(total_net.toFixed(3)).trigger('change');
   var total_w=0;
    $('.table').each(function() {
       $(this).find('.weight').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             total_w += parseFloat(precio);
           }
         });
   
     });
   $('#total_weight').val(total_w.toFixed(3)).trigger('change');
     var overall_gs=0;
    $('.table').each(function() {
       $(this).find('.gross_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             overall_gs += parseFloat(precio);
           }
         });
    });
   
   $('#total_gross').val(overall_gs).trigger('change');
   
   var overall_sum=0;
    $('.table').each(function() {
       $(this).find('.total_price').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             overall_sum += parseFloat(precio);
           }
         });
   
   
     });
   
   $('#Over_all_Total').val(overall_sum.toFixed(3)).trigger('change');
    
      calculate();
   });
      $(document).on('change input keyup','.cost_sq_slab', function (e) {
      var sales_slab_amt=0;
      $(this).closest('table').find('.cost_sq_slab').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sales_slab_amt += parseFloat(precio);
           }
         });
   $(this).closest('table').find('.costperslab').val(sales_slab_amt).trigger('change');
    
   
     });
    $(document).on('change input keyup','.cost_sq_ft', function (e) {
   
      var sales_amt_sq_ft=0;
      $(this).closest('table').find('.cost_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sales_amt_sq_ft += parseFloat(precio);
           }
         });
    $(this).closest('table').find('.costpersqft').val(sales_amt_sq_ft).trigger('change');
   
     });
   
      $(document).on('click', '.delete', function(){
   
   debugger;
 var rowCount = $(this).closest('tbody').find('tr').length;
   
   if(rowCount>1){
   $(this).closest('tr').remove();
   }
   
   var costpersqft=0;
   $('.table').find('.total_price').each(function() {
       var precio = $(this).val();
       if (!isNaN(precio) && precio.length !== 0) {
         costpersqft += parseFloat(precio);
       }
     });
   $('.b_total').val(costpersqft).trigger('change');
   calculate();
   
  });
    
    
    
   
   
                     
                     
            function search() {
                     // debugger;
                       var input_supplier_block_no,
                               input_supplier_slab_no,
                               input_bundle_no,
                               // input_origin,
                     
                     
                          
                     
                             filter_supplier_block_no,filter_supplier_slab_no,filter_bundle_no,
                             table,
                             tr,
                             td,
                             i,
                             name;
                             
                     
                     
                     
                            input_supplier_block_no = document.getElementById("myInput1");
                            input_supplier_slab_no = document.getElementById("myInput2");
                            input_bundle_no = document.getElementById("myInput3");
                           //  input_origin = document.getElementById("myInput4");
                             
                     
                           filter_supplier_block_no = input_supplier_block_no.value.toUpperCase();    
                           filter_supplier_slab_no = input_supplier_slab_no.value.toUpperCase();    
                           filter_bundle_no = input_bundle_no.value.toUpperCase();   
                           // filter_origin = input_origin.value.toUpperCase();
                     
                     
                           
                         table = document.getElementById("product_table1");
                         tr = table.getElementsByTagName("tr");
                     
                             for (i = 0; i < tr.length; i++) {
                                 td = tr[i].getElementsByTagName("td")[5];
                                 td1 = tr[i].getElementsByTagName("td")[6];
                                 td2 = tr[i].getElementsByTagName("td")[2];
                               //   td3 = tr[i].getElementsByTagName("td")[5];
                                
                           
                               if (td && td1 && td2  ) {
                     
                                 supplier_block_no = (td.textContent || td.innerText).toUpperCase();
                                 supplier_slab_no = (td1.textContent || td1.innerText).toUpperCase();
                                 bundle_no = (td2.textContent || td2.innerText).toUpperCase();
                               //   origin = (td3.textContent || td3.innerText).toUpperCase();
                                
                     
                     
                                 if (
                                   supplier_block_no.indexOf(filter_supplier_block_no) > -1 &&
                                   supplier_slab_no.indexOf(filter_supplier_slab_no) > -1 &&
                                   bundle_no.indexOf(filter_bundle_no) > -1 
                                   //   origin.indexOf(filter_origin) > -1  
                     
                                 ) {
                                     tr[i].style.display = "";
                                 } else {
                                     tr[i].style.display = "none";
                                 }
                             }
                         }
                     }
                     
                     
   
   
   
   
   
   
   
   
   
        $('#payment_from_modal').on('input',function(e){
   debugger;
    var payment=parseInt($('#payment_from_modal').val());
   var amount_to_pay=parseInt($('#amount_to_pay').val());
   console.log(payment+"/"+amount_to_pay);
   console.log(parseInt(amount_to_pay)-parseInt(payment));
   var value=parseInt(amount_to_pay)-parseInt(payment);
   $('#balance_modal').val(value);
   if (isNaN(value)) {
     $('#balance_modal').val("0");
      }
    });
         $('#bank_id').change(function(){
           localStorage.setItem("selected_bank_name",$('#bank_id').val());
   
         });
   
      $('#add_pay_type').submit(function(e){
       e.preventDefault();
         var data = {
           
           
           new_payment_type : $('#new_payment_type').val()
         
         };
         data[csrfName] = csrfHash;
     
         $.ajax({
             type:'POST',
             data: data, 
            dataType:"json",
             url:'<?php echo base_url();?>Cinvoice/add_payment_type',
             success: function(data1, statut) {
        
          var $select = $('select#paytype');
      
               $select.empty();
               console.log(data);
                 for(var i = 0; i < data1.length; i++) {
           var option = $('<option/>').attr('value', data1[i].payment_type).text(data1[i].payment_type);
           $select.append(option); // append new options
       }
         $('#new_payment_type').val('');
   
         $("#bodyModal1").html("Payment Added Successfully");
         $('#payment_type').modal('hide');
         
         $('#paytype').show();
          $('#myModal1').modal('show');
         window.setTimeout(function(){
           $('#payment_type').modal('hide');
        
          $('#myModal1').modal('hide');
      
       }, 2000);
       
        }
         });
     });
   $(document).on('click', '.addbundle', function(){
            $(this).css("display","none");
         $(this).closest('table').find('.removebundle').css("display","block");
    });
   
   //   $(document).ready(function(){
   
   
   
   // var tid=$('.table').closest('table').attr('id');
   // const indexLast = tid.lastIndexOf('_');
   // var id = tid.slice(indexLast + 1);
   
   
   // for (j = 0; j < 6; j++) {
   //        var $last = $('#addPurchaseItem_1 tr:last');
   
   //     var num = id+($last.index()+1);
       
       
   
   
   //      $('#addPurchaseItem_1 tr:last').clone().find('input,select,button').attr('id', function(i, current) {
   //         return current.replace(/\d+$/, num);
           
   //     }).end().appendTo('#addPurchaseItem_1');
   //      $.each($('#normalinvoice_1 > tbody > tr'), function (index, el) {
   //             $(this).find(".slab_no").val(index + 1); // Simply couse the first "prototype" is not counted in the list                
   //         })
         
   // }
   
   
   
   // });
   
   
   
   
   
   
   
   
   //   $(document).on('keyup','.normalinvoice tbody tr:last',function (e) {
      
   // var tid=$(this).closest('table').attr('id');
   // const indexLast = tid.lastIndexOf('_');
   // var id = tid.slice(indexLast + 1);
   
   
   
   //      var $last = $('#addPurchaseItem_'+id + ' tr:last');
   
   //     var num = id+($last.index()+1);
       
   //     $('#addPurchaseItem_'+id  + ' tr:last').clone().find('datalist,input,select').attr('id', function(i, current) {
   //         return current.replace(/\d+$/, num);
           
   //     }).end().appendTo('#addPurchaseItem_'+id );
     
   //  $.each($('#normalinvoice_'+id  +  '> tbody > tr'), function (index, el) {
   //             $(this).find(".slab_no").val(index + 1); // Simply couse the first "prototype" is not counted in the list                
   //         })
   
   //   var id1= $(this).closest('tr').find('.product_name').attr('id');
   //   var id_num = id1.substring(id1.indexOf('_') + 1);
   //   var pdt=$('#'+id1).val();
   //   console.log(pdt);
   //   const myArray = pdt.split("-");
   //   var product_nam=myArray[0];
   //   var product_model=myArray[1];
   //   var data = {
   //       product_nam:product_nam,
   //       product_model:product_model
   //     };
   //     data[csrfName] = csrfHash;
   //     $.ajax({
   //         type:'POST',
   //         data: data,
   //      dataType:"json",
   //         url:'<?php echo base_url();?>Cinvoice/availability',
   //         success: function(result, statut) {
   //             console.log(result);
   //             if(result.csrfName){
   //               csrfName = result.csrfName;
   //               csrfHash = result.csrfHash;
   //             }
   //         //     $("#total_amt_"+ id_num).val(result[0]['price']);
   //         //   $("#sales_slab_amt_"+ id_num).val(result[0]['price']);
              
   //               $("#cost_sq_ft_"+ id_num).val(result[0]['cost_persqft']);
   //           $("#cost_sq_slab_"+ id_num).val(result[0]['cost_perslab']);
   //           $("#sales_slab_amt_"+id_num).val(result[0]['price'])
              
              
              
   //           $("#SchoolHiddenId_"+ id_num).val(result[0]['product_id']);
   //             console.log(result);
   //         }
   //     });
   
   //         });
   
   
   
   
   
   
   
   
   
   
   
   // $(document).on('keyup','.normalinvoice tbody tr:last',function (e) {
   //       // debugger;
   //   var tid=$(this).closest('table').attr('id');
   //   const indexLast = tid.lastIndexOf('_');
   //   var id = tid.slice(indexLast + 1);
   //   var $last = $('#addPurchaseItem_'+id + ' tr:last');
   //   var num = id+($last.index()+1);
      
   //   $('#addPurchaseItem_'+id  + ' tr:last').clone().find('datalist,input,select').attr('id', function(i, current) {
   //       return current.replace(/\d+$/, num);   
   //   }).end().appendTo('#addPurchaseItem_'+id );
   //   $.each($('#normalinvoice_'+id  +  '> tbody > tr'), function (index, el) {
   //           $(this).find(".slab_no").val(index + 1); // Simply couse the first "prototype" is not counted in the list                
   //   })
      
   
   
   
   
   
   //   var id1= $(this).closest('tr').find('.product_name').attr('id');
   //   var id_num = id1.substring(id1.indexOf('_') + 1);
   //   var pdt=$('#'+id1).val();
   //   console.log(pdt);
   //   const myArray = pdt.split("-");
   //   var product_nam=myArray[0];
   //   var product_model=myArray[1];
   //   var product_model=myArray[1];
      
      
   //   var data = {
   //       product_nam:product_nam,
   //       product_model:product_model,
   
   
   //   };
   //   data[csrfName] = csrfHash;
   //   $.ajax({
   //       type:'POST',
   //       data: data,
   //     dataType:"json",
   //       url:'<?php echo base_url();?>Cinvoice/availability',
   //       success: function(result, statut) {
   //           console.log(result);
   //           if(result.csrfName){
   //               csrfName = result.csrfName;
   //               csrfHash = result.csrfHash;
   //           }
   //          //   $("#total_amt_"+ id_num).val(result[0]['price']);
   //          //  $("#sales_slab_amt_"+ id_num).val(result[0]['price']);
   //          // $("#SchoolHiddenId_"+ id_num).val(result[0]['product_id']);
   
   //          $("#cost_sq_ft_"+ id_num).val(result[0]['cost_persqft']);
   //          $("#cost_sq_slab_"+ id_num).val(result[0]['cost_perslab']);
   //          $("#sales_slab_amt_"+id_num).val(result[0]['price'])
   //           $("#SchoolHiddenId_"+ id_num).val(result[0]['product_id']);
   
   //           console.log(result);
   //       }
   //   });
   
   
   //   var sum=0;
   // //  debugger;
   //     $(this).closest('table').find('.total_price').each(function() {
   //   var v=$(this).val();
   //   sum += parseFloat(v);
   //   });
   //   $(this).closest('table').find('.b_total').val(sum).trigger('change');
   
   
   //   //id_gtotal_taaaaa
   //   //  $(this).closest('table').find('.gtotal').val(sum).trigger('change');
   
   //     var overall_sum=0;
   //   //  $('.table').each(function() {
   //     $('.table').find('.total_price').each(function() {
   //     var v=$(this).val();
   //     overall_sum += parseFloat(v);
   //   }); 
   //   $('#Over_all_Total').val(overall_sum.toFixed(2)).trigger('change');
      
      
      
   //   // $('.table').each(function() {
   //   // $(this).find('.net_sq_ft').each(function() {
   //   //     var precio = $(this).val();
   //   //     if (!isNaN(precio) && precio.length !== 0) {
   //   //       total_net += parseFloat(precio);
   //   //     }
   //   //   });
   //   // });
   //   // $('#total_net').val(total_net.toFixed(2)).trigger('change');
   //   var total_net=0;
   //   //  $('.table').each(function() {
   //     $('.table').find('.net_sq_ft').each(function() {
   //     var v=$(this).val();
   //     total_net += parseFloat(v);
   //   }); 
   //   $('#total_net').val(total_net.toFixed(2)).trigger('change');
      
   
   
   
     
   //   var costpersqft=0;
   //   $(this).find('.cost_sq_ft').each(function() {
   //       var precio = $(this).val();
   //       if (!isNaN(precio) && precio.length !== 0) {
   //          costpersqft += parseFloat(precio);
   //       }
   //      });
   //   // $('#costpersqft_'+idt).val(costpersqft).trigger('change');
   //   $('#costpersqft').val(costpersqft.toFixed(2)).trigger('change');
   
      
      
   //   var cost_sq_slab=0;
   //   $(this).find('.cost_sq_slab').each(function() {
   //       var precio = $(this).val();
   //       if (!isNaN(precio) && precio.length !== 0) {
   //          cost_sq_slab += parseFloat(precio);
   //       }
   //      });
   //   // $('#costperslab_'+idt).val(cost_sq_slab).trigger('change');
   //   $('#costperslab').val(cost_sq_slab.toFixed(2)).trigger('change');
   
   
   
   
   //   var sales_amt_sq_ft=0;
   //   $(this).find('.sales_amt_sq_ft').each(function() {
   //       var precio = $(this).val();
   //       if (!isNaN(precio) && precio.length !== 0) {
   //          sales_amt_sq_ft += parseFloat(precio);
   //       }
   //      });
   //   // $('#salespricepersqft_'+idt).val(sales_amt_sq_ft).trigger('change');
   //   $('#salespricepersqft').val(sales_amt_sq_ft.toFixed(2)).trigger('change');
   
   
   
   
   //   var sales_slab_amt=0;
   //   $(this).find('.sales_slab_amt').each(function() {
   //       var precio = $(this).val();
   //       if (!isNaN(precio) && precio.length !== 0) {
   //          sales_slab_amt += parseFloat(precio);
   //       }
   //      });
   //   // $('#salesslabprice_'+idt).val(sales_slab_amt).trigger('change');
   //   $('#salesslabprice_').val(sales_slab_amt.toFixed(2)).trigger('change');
   
     
   //   var overall_gs=0;
   //   $('.table').each(function() {
   //   $(this).find('.gross_sq_ft').each(function() {
   //       var precio = $(this).val();
   //       if (!isNaN(precio) && precio.length !== 0) {
   //          overall_gs += parseFloat(precio);
   //       }
   //      });
   //   });
   //   // $('#total_gross').val(overall_gs).trigger('change');
   //   $('#total_gross').val(overall_gs.toFixed(2)).trigger('change');
   
   
   //       calculate_ONROWADD();
   
   //       });
      
   
   //       function calculate_ONROWADD(){
   //       // ;
   //       // debugger;
   //                   var total=$('#Over_all_Total').val();
   //                   var tax= $('#product_tax').val();
   //                   var percent='';
   //                   var hypen='-';
   //                 if(tax.indexOf(hypen) != -1){
   //                  var field = tax.split('-');
   //                  var percent = field[1];
                 
   //               }else{
   //                 percent=tax;
   //                 }
   //                   percent=percent.replace("%","");
   //                   var answer = (percent / 100) * parseFloat(total);
   //                   var gtotal = parseFloat(total + answer);//fix
   //                   console.log("gtotal :" +gtotal);
   //                   var final_g= $('#final_gtotal').val();
   //                   var amt=parseFloat(answer)+parseFloat(total);
   //                   var num = isNaN(parseFloat(amt)) ? 0 : parseFloat(amt)
   //                   $('#gtotal').val(num.toFixed(2)); 
   //                   var custo_amt=$('.custocurrency_rate').val(); 
   //                   console.log("numhere :"+num +"-"+custo_amt);
   //                   var value=num*custo_amt;
   //                   var custo_final = isNaN(parseFloat(value)) ? 0 : parseFloat(value)
   //                   $('#customer_gtotal').val(custo_final.toFixed(2)); 
   //                   $('#tax_details').val(answer.toFixed(2) +" ( "+tax+" )");
   //                   var bal_amt=custo_final-$('#amount_paid').val();
   //                   $('#balance').val(bal_amt.toFixed(2));
                   
   //                 }
   
   
   // $(document).on('keyup',function (e) {

   // //   $(document).on('keyup',function (e) {
      
   // var tid=$(this).closest('table').attr('id');
   // const indexLast = tid.lastIndexOf('_');
   // var id = tid.slice(indexLast + 1);
   
   
   
   //      var $last = $('#addPurchaseItem_'+id + ' tr:last');
   
   //     var num = id+($last.index()+1);
       
   //     $('#addPurchaseItem_'+id  + ' tr:last').clone().find('datalist,input,select').attr('id', function(i, current) {
   //         return current.replace(/\d+$/, num);
           
   //     }).end().appendTo('#addPurchaseItem_'+id );
     
   //  $.each($('#normalinvoice_'+id  +  '> tbody > tr'), function (index, el) {
   //             $(this).find(".slab_no").val(index + 1); // Simply couse the first "prototype" is not counted in the list                
   //         })
   
   //    var id1= $(this).closest('tr').find('.product_name').attr('id');
   //   var id_num = id1.substring(id1.indexOf('_') + 1);
   //    var pdt=$('#'+id1).val();
   //    console.log(pdt);
   //    const myArray = pdt.split("-");
   //    var product_nam=myArray[0];
   //    var product_model=myArray[1];
   //   var data = {
   //        product_nam:product_nam,
   //        product_model:product_model
   //     };
   //     data[csrfName] = csrfHash;
   //     $.ajax({
   //         type:'POST',
   //         data: data,
   //      dataType:"json",
   //         url:'<?php echo base_url();?>Cinvoice/availability',
   //         success: function(result, statut) {
   //             console.log(result);
   //             if(result.csrfName){
   //                csrfName = result.csrfName;
   //                csrfHash = result.csrfHash;
   //             }
   //         //     $("#total_amt_"+ id_num).val(result[0]['price']);
   //         //   $("#sales_slab_amt_"+ id_num).val(result[0]['price']);
              
   //           $("#total_"+ id_num).val(result[0]['price']);
   //          //  $("#sales_slab_amt_"+ id_num).val(result[0]['price']);
   //           $("#SchoolHiddenId_"+ id_num).val(result[0]['product_id']);
   //        }
   //    });
   
   //       // debugger;
   
   //    var sum=0;
   //      $(this).closest('table').find('.total_price').each(function() {
   //    var v=$(this).val();
   //    sum += parseFloat(v);
      
   //    });
   //    $(this).closest('table').find('.b_total').val(sum).trigger('change');
   
   
   
   //    var sum=0;
   //      $(this).closest('table').find('.weight').each(function() {
   //    var v=$(this).val();
   //    sum += parseFloat(v);
      
   //    });
   //    $(this).closest('table').find('.overall_weight').val(sum).trigger('change');
   
   
   
   
   //    var sum=0;
   //      $(this).closest('table').find('.sales_slab_amt').each(function() {
   //    var v=$(this).val();
   //    sum += parseFloat(v);
      
   //    });
   //    $(this).closest('table').find('.salesslabprice').val(sum).trigger('change');
   
   
   //    var sum=0;
   //      $(this).closest('table').find('.sales_amt_sq_ft').each(function() {
   //    var v=$(this).val();
   //    sum += parseFloat(v);
      
   //    });
   //    $(this).closest('table').find('.salespricepersqft').val(sum).trigger('change');
   
   
   //    var sum=0;
   //      $(this).closest('table').find('.cost_sq_slab').each(function() {
   //    var v=$(this).val();
   //    sum += parseFloat(v);
      
   //    });
   //    $(this).closest('table').find('.costperslab').val(sum).trigger('change');
   
   
   //    var sum=0;
   //      $(this).closest('table').find('.cost_sq_ft').each(function() {
   //    var v=$(this).val();
   //    sum += parseFloat(v);
      
   //    });
   //    $(this).closest('table').find('.costpersqft').val(sum).trigger('change');
   
   
   
   //    var sum=0;
   //      $(this).closest('table').find('.gross_sq_ft ').each(function() {
   //    var v=$(this).val();
   //    sum += parseFloat(v);
      
   //    });
   //    $(this).closest('table').find('.overall_gross').val(sum).trigger('change');
   
   //    var sum=0;
   //      $(this).closest('table').find('.net_sq_ft').each(function() {
   //    var v=$(this).val();
   //    sum += parseFloat(v);
      
   //    });
   //    $(this).closest('table').find('.overall_net').val(sum).trigger('change');
   
     
    
   //   var overall_sum=0;
   //      $('.table').find('.total_price').each(function() {
   //     var v=$(this).val();
   //     overall_sum += parseFloat(v);
   //    }); 
   //    $('#Over_all_Total').val(overall_sum.toFixed(2)).trigger('change');
   //    $('#gtotal').val(overall_sum.toFixed(2)).trigger('change');
   //    $('#customer_gtotal').val(overall_sum.toFixed(2)).trigger('change');
      
   
   //    var overall_gs=0;
   //      $('.table').find('.gross_sq_ft').each(function() {
   //     var v=$(this).val();
   //     overall_gs += parseFloat(v);
   //    }); 
   //    $('#total_gross').val(overall_gs.toFixed(2)).trigger('change');
      
   
   //    var total_net=0;
   //      $('.table').find('.net_sq_ft').each(function() {
   //     var v=$(this).val();
   //     total_net += parseFloat(v);
   //    }); 
   //    $('#total_net').val(total_net.toFixed(2)).trigger('change');
      
   
   //    var overall_weight=0;
   //      $('.table').find('.weight').each(function() {
   //     var v=$(this).val();
   //     overall_weight += parseFloat(v);
   //    }); 
   //    $('#total_weight').val(overall_weight.toFixed(2)).trigger('change');
      
   
   //       calculate_ONROWADD();
   
   //        });
      
   
          function calculate_ONROWADD(){
      
                     var total=$('#Over_all_Total').val();
                     var tax= $('#product_tax').val();
                     var percent='';
                     var hypen='-';
                   if(tax.indexOf(hypen) != -1){
                    var field = tax.split('-');
                    var percent = field[1];
                 
                  }else{
                   percent=tax;
                   }
                     percent=percent.replace("%","");
                     var answer = (percent / 100) * parseFloat(total);
                     var gtotal = parseFloat(total + answer);//fix
                     console.log("gtotal :" +gtotal);
                     var final_g= $('#final_gtotal').val();
                     var amt=parseFloat(answer)+parseFloat(total);
                     var num = isNaN(parseFloat(amt)) ? 0 : parseFloat(amt)
                     $('#gtotal').val(num.toFixed(2)); 
                     var custo_amt=$('.custocurrency_rate').val(); 
                     console.log("numhere :"+num +"-"+custo_amt);
                     var value=num*custo_amt;
                     var custo_final = isNaN(parseFloat(value)) ? 0 : parseFloat(value)
                     $('#customer_gtotal').val(custo_final.toFixed(2)); 
                     $('#tax_details').val(answer.toFixed(2) +" ( "+tax+" )");
                     var bal_amt=custo_final-$('#amount_paid').val();
                     $('#balance').val(bal_amt.toFixed(2));
                   
                   }
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   function cal_all(){
      var netheight = $(this).closest('table').find('.net_height').attr('id');
   const indexLastDot = netheight.lastIndexOf('_');
   var id = netheight.slice(indexLastDot + 1);
   var net_width='net_width_'+id;
   var net_height = 'net_height_'+ id;
   var netwidth=$('#'+net_width).val();
   var netheight=$('#'+net_height).val();
   var netresult=parseInt(netwidth) * parseInt(netheight);
   netresult=netresult/144;
   netresult = isNaN(netresult) ? 0 : netresult;
   var nresult=netresult.toFixed(3);
   $('#'+'net_sq_ft_'+id).val(netresult.toFixed(3));
   var cost_sqft=$('#cost_sq_ft_'+id).val();
   var tid=$(this).closest('table').attr('id');
   const indexLast = tid.lastIndexOf('_');
   var idt = tid.slice(indexLast + 1);
   var sales_sqft=cost_sqft *nresult;
   var x = $('#slab_no_'+id).val();
   var sales_slab_price=cost_sqft *nresult*x;
   
   console.log(parseInt(cost_sqft) +"*"+parseInt(nresult)+"*"+idt);
   $('#'+'sales_slab_amt_'+id).val(sales_slab_price.toFixed(3));
   $(this).closest('tr').find('.total_price').val(sales_slab_price.toFixed(3));
   sales_sqft = isNaN(sales_sqft) ? 0 : sales_sqft;
   $('#'+'sales_amt_sq_ft_'+id).val(sales_sqft.toFixed(3));
    $('.table').each(function() {
       
         var sum=0;
   
        $(this).closest('table').find('.total_price').each(function() {
   var v=$(this).val();
     sum += parseFloat(v);
   
   });
   $('#Total_'+idt).val(sum).trigger('change');
   var total_net=0;
    $('.table').each(function() {
       $(this).find('.net_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             total_net += parseFloat(precio);
           }
         });
   
        
   
   
     });
   $('#total_net').val(total_net.toFixed(3)).trigger('change');
    var costpersqft=0;
      $(this).find('.cost_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             costpersqft += parseFloat(precio);
           }
         });
   $('#costpersqft_'+idt).val(costpersqft).trigger('change');
     var cost_sq_slab=0;
     $(this).find('.cost_sq_slab').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             cost_sq_slab += parseFloat(precio);
           }
         });
   $('#costperslab_'+idt).val(cost_sq_slab).trigger('change');
     var sales_amt_sq_ft=0;
      $(this).find('.sales_amt_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sales_amt_sq_ft += parseFloat(precio);
           }
         });
   $('#salespricepersqft_'+idt).val(sales_amt_sq_ft).trigger('change');
     var sales_slab_amt=0;
      $(this).find('.sales_slab_amt').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sales_slab_amt += parseFloat(precio);
           }
         });
   $('#salesslabprice_'+idt).val(sales_slab_amt).trigger('change');
     var overall_gs=0;
    $('.table').each(function() {
       $(this).find('.gross_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             overall_gs += parseFloat(precio);
           }
         });
    });
   
   $('#total_gross').val(overall_gs).trigger('change');
   
   var overall_sum=0;
        $('.table').find('.b_total').each(function() {
   var v=$(this).val();
     overall_sum += parseFloat(v);
   
   });
    $('#Over_all_Total').val(overall_sum.toFixed(3)).trigger('change');
   
   
   
   
    });
   
   
   
   gt(id);
   }
     $(document).on('click', '.removebundle', function(){
      
      
      var tid=$(this).closest('table').attr('id');
      localStorage.setItem("delete_table",tid);
      console.log(localStorage.getItem("delete_table"));
      var remove_id=$(this).closest('table').attr('id');
      $('#'+remove_id).remove();
        var sum=0;
         $('#'+localStorage.getItem("delete_table")).find('.total_price').each(function() {
      var v=$(this).val();
       sum += parseFloat(v);
      });
       $('#'+localStorage.getItem("delete_table")).find('.b_total').val(sum).trigger('change');
        var sumnet=0;
      
        $('#'+localStorage.getItem("delete_table")).find('.net_sq_ft').each(function() {
      var v=$(this).val();
      if (!isNaN(v) && v.length !== 0) {
               sumnet += parseFloat(v);
             }
      
      });
       $('#'+localStorage.getItem("delete_table")).find('.overall_net').val(sumnet.toFixed(3));
      
      
         var sumgross=0;
      
         $('#'+localStorage.getItem("delete_table")).find('.gross_sq_ft').each(function() {
      var v=$(this).val();
      if (!isNaN(v) && v.length !== 0) {
               sumgross += parseFloat(v);
             }
      
      });
       $('#'+localStorage.getItem("delete_table")).find('.overall_gross').val(sumgross.toFixed(3));
      var total_net=0;
      $('.table').each(function() {
         $(this).find('.net_sq_ft').each(function() {
             var precio = $(this).val();
             if (!isNaN(precio) && precio.length !== 0) {
               total_net += parseFloat(precio);
             }
           });
      
      
      
       });
      $('#total_net').val(total_net.toFixed(3)).trigger('change');
       var overall_gs=0;
      $('.table').each(function() {
         $(this).find('.gross_sq_ft').each(function() {
             var precio = $(this).val();
             if (!isNaN(precio) && precio.length !== 0) {
               overall_gs += parseFloat(precio);
             }
           });
      });
      
      $('#total_gross').val(overall_gs).trigger('change');
       var sum_w=0;
       $('#'+localStorage.getItem("delete_table")).find('.weight').each(function() {
             var precio = $(this).val();
             if (!isNaN(precio) && precio.length !== 0) {
               sum_w += parseFloat(precio);
             }
           });
       $('#'+localStorage.getItem("delete_table")).find('.overall_weight').val(sum_w).trigger('change');
      var total_w=0;
      $('.table').each(function() {
         $(this).find('.weight').each(function() {
             var precio = $(this).val();
             if (!isNaN(precio) && precio.length !== 0) {
               total_w += parseFloat(precio);
             }
           });
      
       });
      $('#total_weight').val(total_w.toFixed(3)).trigger('change');
      var overall_sum=0;
          $('.table').find('.total_price').each(function() {
      var v=$(this).val();
       overall_sum += parseFloat(v);
      
      });
      $('#Over_all_Total').val(overall_sum.toFixed(3)).trigger('change');
   
   
   
   gt(id);
   
   
   
   
   
    });
   $(document).ready(function(){
      $('.removebundle').hide();
   $('#amt').hide();
   $('#bal').hide();
       });
   $('#paypls').on('click', function (e) {
    //   alert($('#goods').val());
       
       $('#m_payment').val($('#goods').val());
      // debugger;
   $('#amount_to_pay').val($('#gtotal').val());
       $('#payment_modal').modal('show');
      
     e.preventDefault();
   
   });
   $('#insert_product').submit(function (event) {
        event.preventDefault();
   if($('#product_name').val()!='' && $('#product_model').val()!='' && $('#sell_price').val()!='' && $('#quantity').val()!='' && $('#supplier_id').val()!='' && $('#product_sub_category').val()!='')
   {
      
   
       var dataString = {
           dataString : $("#insert_product").serialize()
      };
      dataString[csrfName] = csrfHash;
       $.ajax({
           type:"POST",
           dataType:"json",
           url:"<?php echo base_url(); ?>Cproduct/insert_product",
           data:$("#insert_product").serialize(),
           success:function (data1) {
           console.log(data1);
   
           $("#magicHouses").empty();
           for (var i in data1) {
              $("<option/>").html(data1[i].product_name +'-'+ data1[i].product_model).appendTo("#magicHouses");
           }
         
          $("#magicHouses").focus();
   
         $("#bodyModal1").html("Product Added Successfully");
          
         $('#myModal1').modal('show');
   
         window.setTimeout(function(){
           $('#product_info').modal('hide');
           $('.modal-backdrop').remove();
          $('#myModal1').modal('hide');
       }, 2000);
   }
   });
   }
   });
   
   
   
   
   
   $('#add_payment_info').submit(function (event) {    
      var dataString = {
          dataString : $("#add_payment_info").serialize()
     };
     dataString[csrfName] = csrfHash;
    
      $.ajax({
          type:"POST",
          dataType:"json",
          url:"<?php echo base_url(); ?>Cinvoice/add_payment_info",
          data:$("#add_payment_info").serialize(),
   
          success:function (data) {
    $('.amt').show();
   
       $('#payment_modal').modal('hide');
       $("#bodyModal1").html("Payment Successfully Completed");
          $('#myModal1').modal('show');
       
       window.setTimeout(function(){
           $('#myModal1').modal('hide');
   },2500);
   
      var dataString = {
          dataString : $("#histroy").serialize()
      
     };
     dataString[csrfName] = csrfHash;
    
      $.ajax({
          type:"POST",
          dataType:"json",
          url:"<?php echo base_url(); ?>Cinvoice/payment_history",
          data:$("#histroy").serialize(),
   
          success:function (data) {
           console.log(data);
           var gt=$('#gtotal').val();
           var amtpd=data.amt_paid;
           console.log(data);
           var bal= $('#gtotal').val() - data.amt_paid;
    $('#balance').val(bal);
    
    if(amtpd){
   $('#amount_paid').val(amtpd);
   }else{
      $('#amount_paid').val("0.00"); 
   }
   
   
   
      var t_rate=$('.custocurrency_rate').val();
      document.getElementById("paid_convert").value=
    	(amtpd /t_rate ).toFixed(2);
       document.getElementById("bal_convert").value=
    	(bal /t_rate ).toFixed(2);
   
         }
       });
         $('#add_payment_info')[0].reset();
         }
   
      });
      event.preventDefault();
   });
   
   
       $('#add_bank').submit(function (event) {
      
          
      var dataString = {
          dataString : $("#add_bank").serialize()
      
     };
     dataString[csrfName] = csrfHash;
    
      $.ajax({
          type:"POST",
          dataType:"json",
          url:"<?php echo base_url(); ?>Csettings/add_new_bank",
          data:$("#add_bank").serialize(),
   
          success: function (data) {
           $.each(data, function (i, item) {
              
               result = '<option value=' + data[i].bank_name + '>' + data[i].bank_name + '</option>';
           });
         
           $('.bankpayment').selectmenu(); 
           $('.bankpayment').append(result).selectmenu('refresh',true);
          $("#bodyModal1").html("Bank Added Successfully");
          $('#myModal3').modal('hide');
          $('#add_bank_info').modal('hide');
          $('#bank').show();
           $('#myModal1').modal('show');
          window.setTimeout(function(){
         
           $('#myModal5').modal('hide');
           $('.modal-backdrop').remove();
           $('#myModal1').modal('hide');
       
        }, 2000);
        
         }
   
      });
      event.preventDefault();
   });
   
   
   
         $(document).ready(function () {
         $('#bank').selectize({
             sortField: 'text'
         });
     });
   
   var isChange;
   $("input[type='text'], textarea").keyup(function () {
     
       isChange = true;
   
   });
   
   
   $(document).ready(function () {
   
   $('#openBtn').click(function () {
       $('#payment_modal').modal({
           show: true
       })
   });
   
       $(document).on('show.bs.modal', '.modal', function (event) {
           var zIndex = 1040 + (10 * $('.modal:visible').length);
           $(this).css('z-index', zIndex);
           setTimeout(function() {
               $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
           }, 0);
       });
   
   
   });
   $('#tax_dropdown').on('change', function() {
     if ( this.value == '2')
       $("#tax").show();     
     else
       $("#tax").hide();
   }).trigger("change");
   $('#add_pay_terms').submit(function(e){
       e.preventDefault();
         var data = {
           new_payment_terms : $('#new_payment_terms').val()
         };
         data[csrfName] = csrfHash;
         $.ajax({
             type:'POST',
             data: data,
            dataType:"json",
             url:'<?php echo base_url();?>Cpurchase/add_payment_terms',
             success: function(data1, statut) {
       
          var $select = $('select#terms');
               $select.empty();
               console.log(data);
                 for(var i = 0; i < data1.length; i++) {
           var option = $('<option/>').attr('value', data1[i].payment_terms).text(data1[i].payment_terms);
           $select.append(option); // append new options
       }
       $('#new_payment_terms').val('');
         $("#bodyModal1").html("Payment Terms Added Successfully");
         $('#payment_type').modal('hide');
         $('#terms').show();
          $('#myModal1').modal('show');
         window.setTimeout(function(){
           $('#payment_type_new').modal('hide');
          $('#myModal1').modal('hide');
           $('.modal-backdrop').remove();
       }, 2500);
        }
         });
     });
   
   
   $(document).on('keyup', '.weight', function(){
   var weight=0;
        $(this).closest('table').find('.weight').each(function() {
   var v=$(this).val();
    if (!isNaN(v) && v.length !== 0) {
             weight += parseFloat(v);
           }
   });
    $(this).closest('table').find('.overall_weight').val(weight.toFixed(3));
   var total_weight=0;
    $('.table').each(function() {
       $(this).find('.weight').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             total_weight += parseFloat(precio);
           }
         });
   
        
   
   
     });
   $('#total_weight').val(total_weight.toFixed(3)).trigger('change');
   
   });
   $(document).on('keyup', '.net_height,.net_width', function(){
     
   var tid=$(this).closest('table').attr('id');
   const indexLast1 = tid.lastIndexOf('_');
   var idt = tid.slice(indexLast1 + 1);
    var netheight = $(this).attr('id');
   const indexLastDot = netheight.lastIndexOf('_');
   var id = netheight.slice(indexLastDot + 1);
   var net_width='net_width_'+id;
   var net_height = 'net_height_'+ id;
   var netwidth=$('#'+net_width).val();
   var netheight=$('#'+net_height).val();
   var netresult=parseInt(netwidth) * parseInt(netheight);
   netresult=netresult/144;
   netresult = isNaN(netresult) ? 0 : netresult;
   var nresult=netresult.toFixed(3);
   $('#'+'net_sq_ft_'+id).val(netresult.toFixed(3));
   var sales_slab_price=$('#sales_amt_sq_ft_'+id).val();
   var tid=$(this).closest('table').attr('id');
   const indexLast = tid.lastIndexOf('_');
   var idt = tid.slice(indexLast + 1);
   var sales_amt_sq_ft=sales_slab_price * nresult;
   
   sales_amt_sq_ft = isNaN(sales_amt_sq_ft) ? 0 : sales_amt_sq_ft;
   $('#'+'sales_slab_amt_'+id).val(sales_amt_sq_ft.toFixed(3));
   $('#'+'total_amt_'+id).val(sales_amt_sq_ft.toFixed(3));
    var sumnet=0;
    $(this).closest('table').find('.net_sq_ft').each(function() {
   var v=$(this).val();
    if (!isNaN(v) && v.length !== 0) {
             sumnet += parseFloat(v);
           }
   
   });
   $('#overall_net_'+idt).val(sumnet.toFixed(3));
    var sumnet1=0;
    $(this).closest('table').find('.sales_slab_amt').each(function() {
   var v=$(this).val();
    if (!isNaN(v) && v.length !== 0) {
             sumnet1 += parseFloat(v);
           }
   
   });
   $('#salesslabprice_'+idt).val(sumnet1.toFixed(3));
   var total_net=0;
    $('.table').each(function() {
       $(this).find('.net_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             total_net += parseFloat(precio);
           }
         });
   
        
   
   
     });
   $('#total_net').val(total_net.toFixed(3)).trigger('change');
   
   
     var sum=0;
   
        $(this).closest('table').find('.total_price').each(function() {
   var v=$(this).val();
     sum += parseFloat(v);
   
   });
   
   var overall_sum=0;
    $('.table').each(function() {
       $(this).find('.total_price').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             overall_sum += parseFloat(precio);
           }
         });
   
        
   
   
     });
   
   $('#Over_all_Total').val(overall_sum.toFixed(3)).trigger('change');
   $('#Total_'+idt).val(sum);
   var total_net=0;
    $('.table').each(function() {
       $(this).find('.sales_amt_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             total_net += parseFloat(precio);
           }
         });
   
        
   
   
     });
    
   $('#salespricepersqft_'+idt).val(total_net.toFixed(3)).trigger('change');
   calculate();
   });
   
   $(document).on('input', '.gross_height,.gross_width', function(){
   
    var netheight = $(this).attr('id');
   const indexLastDot = netheight.lastIndexOf('_');
   var id = netheight.slice(indexLastDot + 1);
   var net_width='gross_width_'+id;
   var net_height = 'gross_height_'+ id;
   var tid=$(this).closest('table').attr('id');
   const indexLast = tid.lastIndexOf('_');
   var idt = tid.slice(indexLast + 1);
   var netwidth=$('#'+net_width).val();
   var netheight=$('#'+net_height).val();
   var netresult=parseInt(netwidth) * parseInt(netheight);
   netresult=netresult/144;
   netresult = isNaN(netresult) ? 0 : netresult;
   var nresult=netresult.toFixed(3);
   
   $('#'+'gross_sq_ft_'+id).val(netresult.toFixed(3));
   
       var sumgross=0;
   
        $(this).closest('table').find('.gross_sq_ft').each(function() {
   var v=$(this).val();
    if (!isNaN(v) && v.length !== 0) {
             sumgross += parseFloat(v);
           }
   
   });
   $('#overall_gross_'+idt).val(sumgross.toFixed(3));
      
   
   var overall_gs=0;
    $('.table').each(function() {
       $(this).find('.gross_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             overall_gs += parseFloat(precio);
           }
         });
    });
   
   $('#total_gross').val(overall_gs).trigger('change');
   
   gt(id);
   
   });
   $(document).on("input change", ".total_price", function(e){
   
   var netheight = $(this).attr('id');
   const indexLastDot = netheight.lastIndexOf('_');
   var id = netheight.slice(indexLastDot + 1);
   var net_width='net_width_'+id;
   var net_height = 'net_height_'+ id;
   var netwidth=$('#'+net_width).val();
   var netheight=$('#'+net_height).val();
   var netresult=parseInt(netwidth) * parseInt(netheight);
   netresult=netresult/144;
   netresult = isNaN(netresult) ? 0 : netresult;
   var nresult=netresult.toFixed(3);
   $('#'+'net_sq_ft_'+id).val(netresult.toFixed(3));
   var cost_sqft=$('#cost_sq_ft_'+id).val();
   var tid=$(this).closest('table').attr('id');
   const indexLast = tid.lastIndexOf('_');
   var idt = tid.slice(indexLast + 1);
   var sales_sqft=cost_sqft *nresult;
   var x = $('#slab_no_'+id).val();
   var sales_slab_price=cost_sqft *nresult*x;
   
   console.log(parseInt(cost_sqft) +"*"+parseInt(nresult)+"*"+idt);
   $('#'+'sales_slab_amt_'+id).val(sales_slab_price.toFixed(3));
   $(this).closest('tr').find('.total_price').val(sales_slab_price.toFixed(3));
   sales_sqft = isNaN(sales_sqft) ? 0 : sales_sqft;
   $('#'+'sales_amt_sq_ft_'+id).val(sales_sqft.toFixed(3));
       var sum_net=0;
   
         $(this).closest('table').find('.net_sq_ft').each(function() {
           var v=$(this).val();
          
       sum_net += parseFloat(v);
       
       sum_net = isNaN(sum_net) ? 0 : sum_net;
      
   });
   $('#overall_net_'+idt).val(sum_net.toFixed(3));
       var sum_gross=0;
       
       $(this).closest('table').find('.gross_sq_ft').each(function() {
           var v=$(this).val();
          
       sum_gross += parseFloat(v);
        
         
       sum_gross = isNaN(sum_gross) ? 0 : sum_gross;
       
   });
   $('#overall_gross_'+idt).val(sum_gross.toFixed(3));
   var total_net=0;
    $('.table').each(function() {
       $(this).find('.net_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             total_net += parseFloat(precio);
           }
         });
   
        
   
   
     });
   $('#total_net').val(total_net.toFixed(3)).trigger('change');
     var overall_gs=0;
    $('.table').each(function() {
       $(this).find('.gross_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             overall_gs += parseFloat(precio);
           }
         });
    });
   
   $('#total_gross').val(overall_gs).trigger('change');
     var sum=0;
   
        $(this).closest('table').find('.total_price').each(function() {
   var v=$(this).val();
     sum += parseFloat(v);
   
   });
   
   var overall_sum=0;
    $('.table').each(function() {
       $(this).find('.total_price').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             overall_sum += parseFloat(precio);
           }
         });
   
   
   calculate();
     });
   
   
   $('#Over_all_Total').val(overall_sum.toFixed(3)).trigger('change');
   $('#Total_'+idt).val(sum);
   });
   
   $('#Total').on('change textInput input', function (e) {
       calculate();
   });
   
   $('.custocurrency_rate').on('change textInput input', function (e) {
       calculate();
   });
   
   $(document).on('change select input','.product_name', function (e) {
   var netheight = $(this).attr('id');
   const indexLastDot = netheight.lastIndexOf('_');
   var id = netheight.slice(indexLastDot + 1);
   var net_width='net_width_'+id;
   var net_height = 'net_height_'+ id;
   var netwidth=$('#'+net_width).val();
   var netheight=$('#'+net_height).val();
   var netresult=parseInt(netwidth) * parseInt(netheight);
   netresult=netresult/144;
   netresult = isNaN(netresult) ? 0 : netresult;
   var nresult=netresult.toFixed(3);
   $('#'+'net_sq_ft_'+id).val(netresult.toFixed(3));
   var cost_sqft=$('#cost_sq_ft_'+id).val();
   var tid=$(this).closest('table').attr('id');
   const indexLast = tid.lastIndexOf('_');
   var idt = tid.slice(indexLast + 1);
   var sales_slab_price=$('#sales_slab_amt_'+id).val();
   var tid=$(this).closest('table').attr('id');
   
   var sales_amt_sq_ft=sales_slab_price / nresult;
   
   sales_amt_sq_ft = isNaN(sales_amt_sq_ft) ? 0 : sales_amt_sq_ft;
   $('#'+'sales_amt_sq_ft_'+id).val(sales_amt_sq_ft.toFixed(3));
   $('#'+'total_amt_'+id).val(sales_amt_sq_ft.toFixed(3));
   var costpersqft=0;
       $(this).closest('table').find('.cost_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             costpersqft += parseFloat(precio);
           }
         });
   $('#costpersqft_'+idt).val(costpersqft).trigger('change');
     var cost_sq_slab=0;
     $(this).closest('table').find('.cost_sq_slab').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             cost_sq_slab += parseFloat(precio);
           }
         });
   $('#costperslab_'+idt).val(cost_sq_slab).trigger('change');
     var sales_amt_sq_ft=0;
        $(this).closest('table').find('.sales_amt_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sales_amt_sq_ft += parseFloat(precio);
           }
         });
   $('#salespricepersqft_'+idt).val(sales_amt_sq_ft).trigger('change');
     var sales_slab_amt=0;
      $(this).closest('table').find('.sales_slab_amt').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             sales_slab_amt += parseFloat(precio);
           }
         });
   $('#salesslabprice_'+idt).val(sales_slab_amt).trigger('change');
    var sumnet=0;
   
        $(this).closest('table').find('.net_sq_ft').each(function() {
   var v=$(this).val();
    if (!isNaN(v) && v.length !== 0) {
             sumnet += parseFloat(v);
           }
   
   });
   $('#overall_net_'+idt).val(sumnet.toFixed(3));
       var sumgross=0;
   
        $(this).closest('table').find('.gross_sq_ft').each(function() {
   var v=$(this).val();
    if (!isNaN(v) && v.length !== 0) {
             sumgross += parseFloat(v);
           }
   
   });
   $('#overall_gross_'+idt).val(sumgross.toFixed(3));
   var total_net=0;
    $('.table').each(function() {
       $(this).find('.net_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             total_net += parseFloat(precio);
           }
         });
   
   
     });
   $('#total_net').val(total_net.toFixed(3)).trigger('change');
     var overall_gs=0;
    $('.table').each(function() {
       $(this).find('.gross_sq_ft').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             overall_gs += parseFloat(precio);
           }
         });
    });
   
   $('#total_gross').val(overall_gs).trigger('change');
   
   
   var overall_sum=0;
    $('.table').each(function() {
       $(this).find('.total_price').each(function() {
           var precio = $(this).val();
           if (!isNaN(precio) && precio.length !== 0) {
             overall_sum += parseFloat(precio);
           }
         });
   
   
     });
   
   
   $('#Over_all_Total').val(overall_sum.toFixed(3)).trigger('change');
     var sum=0;
   
        $(this).closest('table').find('.total_price').each(function() {
   var v=$(this).val();
     sum += parseFloat(v);
   
   });
   $('#Total_'+idt).val(sum);
   
   
   gt(id);
      var id= $(this).attr('id');
     var id_num = id.substring(id.indexOf('_') + 1);
      var pdt=$('#'+id).val();
      console.log(pdt);
      const myArray = pdt.split("-");
      var product_nam=myArray[0];
      var product_model=myArray[1];
     var data = {
          product_nam:product_nam,
          product_model:product_model
       };
       data[csrfName] = csrfHash;
       $.ajax({
           type:'POST',
           data: data,
        dataType:"json",
           url:'<?php echo base_url();?>Cinvoice/availability',
           success: function(result, statut) {
               console.log(result);
               if(result.csrfName){
                  csrfName = result.csrfName;
                  csrfHash = result.csrfHash;
               }
           //     $("#cost_sq_ft_"+ id_num).val(result[0]['cost_persqft']);
           //   $("#cost_sq_slab_"+ id_num).val(result[0]['cost_perslab']);
           //   $("#sales_slab_amt_"+id_num).val(result[0]['price'])
   
             $("#SchoolHiddenId_"+ id_num).val(result[0]['product_id']);
               console.log(result);
           }
       });
   });
   
   
   
   $('#proforma_taxbtn').submit(function (event) {
          var dataString = {
              dataString : $("#proforma_taxbtn").serialize()
         };
         dataString[csrfName] = csrfHash;
          $.ajax({
              type:"POST",
              dataType:"json",
              url:"<?php echo base_url(); ?>Cinvoice/insert_proformataxinfo",
              data:$("#proforma_taxbtn").serialize(),
              success:function (data1) {
                     $("#magic_tax").empty();
                for (var i in data1) {
                  console.log(data1);
                   $("<option/>").html(data1[i].tax_id +'-'+ data1[i].tax).appendTo("#magic_tax");
                }
              $("#magic_tax").focus();
              $("#bodyModal1").html("Tax Added Successfully");
              $('#myModal1').modal('show');
              window.setTimeout(function(){
                $('#proforma_taxinfo').modal('hide');
                $('.modal-backdrop').remove();
               $('#myModal1').modal('hide');
            }, 2000);
              }
          });
          event.preventDefault();
      });
</script>
            <style>
                  /* input{
                  border:none;
                  }
                  textarea:focus, input:focus{
                  outline: none;
                  }
                  .text-right {
                  text-align: left; 
                  }
                  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                  padding:5px;
                  }
                  table {
                  width: 100px;
                  }
                  th,
                  td {
                  word-wrap: break-word
                  border: 1px solid black;
                  width: 80px;
                  } */
                  .select2 {
                  display:none;
                  }
                  #download_select:focus option:first-of-type , #print_select:focus option:first-of-type{
                  display: none;
                  }
               </style> 