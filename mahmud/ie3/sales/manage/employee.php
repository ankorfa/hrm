<?php

/* * ********************************************************************
  Copyright (C) FrontAccounting, LLC.
  Released under the terms of the GNU General Public License, GPL,
  as published by the Free Software Foundation, either version 3
  of the License, or (at your option) any later version.
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
  See the License here <http://www.gnu.org/licenses/gpl-3.0.html>.
 * ********************************************************************* */
$page_security = 'SA_CUSTOMER';
$path_to_root = "../..";

include($path_to_root . "/includes/db_pager.inc");
include_once($path_to_root . "/includes/session.inc");
include_once($path_to_root . "/includes/ui/education_view.inc");
$js = "";
if ($use_popup_windows)
    $js .= get_js_open_window(900, 500);
if ($use_date_picker)
    $js .= get_js_date_picker();

page(_($help_context = "Employee Tab Page"), @$_REQUEST['popup'], false, "", $js);

include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/banking.inc");
include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/includes/ui/contacts_view.inc");

//if (isset($_GET['debtor_no'])) 
//{
//	$_POST['customer_id'] = $_GET['debtor_no'];
//}
//
$selected_id = get_post('employee_id');

//display_error($selected_id);
//--------------------------------------------------------------------------------------------

function can_process() {
    if (strlen($_POST['empName']) == 0) {
        display_error(_("The employee name cannot be empty."));
        set_focus('empName');
        return false;
    }


    $sql = db_query("SELECT emp_name FROM " . TB_PREF . "employee WHERE emp_name=" . db_escape($_POST['empName']));
    $ss = db_num_rows($sql);

//display_error($ss);

    if ($ss) {
        display_error(_("The" . db_escape($_POST['empName']) . " already exits."));
        set_focus('empName');
        return false;
    }



    if (strlen($_POST['empfName']) == 0) {
        display_error(_("The employee fname name cannot be empty."));
        set_focus('empfName');
        return false;
    }

    if (strlen($_POST['address']) == 0) {
        display_error(_("The address empty ."));
        set_focus('address');
        return false;
    }

    if (strlen($_POST['phone_no']) == 0) {
        display_error(_("Phone no is empty."));
        set_focus('phone_no');
        return false;
    }

    if (strlen($_POST['phone_no']) == 0) {
        display_error(_("nationality is empty"));
        set_focus('nationality');
        return false;
    }

    return true;
}

//--------------------------------------------------------------------------------------------

function handle_submit(&$selected_id) {
    global $path_to_root, $Ajax, $auto_create_branch;

    if (!can_process())
        return;

    if ($selected_id) {

        update_employee($_POST['employee_id'], $_POST['empName'], $_POST['empfName'], $_POST['address'], $_POST['phone_no'], $_POST['date'], $_POST['nationality'], $_POST['email'], $_POST['marry']);
//display_error(55555);
//		update_record_status($_POST['customer_id'], $_POST['inactive'],
//			'debtors_master', 'debtor_no');

        $Ajax->activate('employee_id'); // in case of status change
        display_notification(_("Customer has been updated."));
    } else {  //it is a new customer
        begin_transaction();
        add_employee($_POST['empName'], $_POST['empfName'], $_POST['address'], $_POST['phone_no'], $_POST['date'], $_POST['nationality'], $_POST['email'], $_POST['marry']);


//$selected_id = $_POST['customer_id'] = db_insert_id();
//		if (isset($auto_create_branch) && $auto_create_branch == 1)
//		{
//        	add_branch($selected_id, $_POST['CustName'], $_POST['cust_ref'],
//                $_POST['address'], $_POST['salesman'], $_POST['area'], $_POST['tax_group_id'], '',
//                get_company_pref('default_sales_discount_act'), get_company_pref('debtors_act'), get_company_pref('default_prompt_payment_act'),
//                $_POST['location'], $_POST['address'], 0, 0, $_POST['ship_via'], $_POST['notes']);
//                
//        	$selected_branch = db_insert_id();
//        
//			add_crm_person($_POST['cust_ref'], $_POST['CustName'], '', $_POST['address'], 
//				$_POST['phone'], $_POST['phone2'], $_POST['fax'], $_POST['email'], '', '');
//
//			$pers_id = db_insert_id();
//			add_crm_contact('cust_branch', 'general', $selected_branch, $pers_id);
//
//			add_crm_contact('customer', 'general', $selected_id, $pers_id);
//		}
        commit_transaction();

        display_notification(_("A new customer has been added."));
        unset($_POST['empName'], $_POST['empfName'], $_POST['address'], $_POST['phone_no'], $_POST['nationality'], $_POST['email'], $_POST['marry']);
        if (isset($auto_create_branch) && $auto_create_branch == 1)
            display_notification(_("A default Branch has been automatically created, please check default Branch values by using link below."));

        $Ajax->activate('_page_body');
    }
}

//--------------------------------------------------------------------------------------------

if (isset($_POST['submit'])) {
    handle_submit($selected_id);
}
//-------------------------------------------------------------------------------------------- 

if (isset($_POST['delete'])) {

    $cancel_delete = 0;

// PREVENT DELETES IF DEPENDENT RECORDS IN 'debtor_trans'
//	if (key_in_foreign_table($selected_id, 'debtor_trans', 'debtor_no'))
//	{
//		$cancel_delete = 1;
//		display_error(_("This customer cannot be deleted because there are transactions that refer to it."));
//	} 
//	else 
//	{
//		if (key_in_foreign_table($selected_id, 'sales_orders', 'debtor_no'))
//		{
//			$cancel_delete = 1;
//			display_error(_("Cannot delete the customer record because orders have been created against it."));
//		} 
//		else 
//		{
//			if (key_in_foreign_table($selected_id, 'cust_branch', 'debtor_no'))
//			{
//				$cancel_delete = 1;
//				display_error(_("Cannot delete this customer because there are branch records set up against it."));
//				//echo "<br> There are " . $myrow[0] . " branch records relating to this customer";
//			}
//		}
//	}

    if ($cancel_delete == 0) {  //ie not cancelled the delete as a result of above tests
        display_error(5555);
        delete_employee($selected_id);

        display_notification(_("Selected customer has been deleted."));
        unset($_POST['employee_id'], $_POST['empName'], $_POST['empfName'], $_POST['address'], $_POST['phone_no'], $_POST['nationality'], $_POST['email'], $_POST['marry']);
        $selected_id = '';
        $Ajax->activate('_page_body');
    } //end if Delete Customer
}

function customer_settings($selected_id) {
    global $SysPrefs, $path_to_root, $auto_create_branch;
//	   display_error($selected_id);
    if (!$selected_id) {
        if (list_updated('employee_id') || !isset($_POST['empName'])) {
            $_POST['empName'] = $_POST['empfName'] = $_POST['address'] = $_POST['phone_no'] = '';

            $_POST['nationality'] = $_POST['email'] = '';
//$_POST['curr_code']  = get_company_currency();
//$_POST['credit_status']  = -1;
//$_POST['payment_terms']  = $_POST['notes']  = '';
//$_POST['discount']  = $_POST['pymt_discount'] = percent_format(0);
//$_POST['credit_limit']	= price_format($SysPrefs->default_credit_limit());
        }
    } else {


        $myrow = get_employee($selected_id);
//print_r($myrow);
        $_POST['empName'] = $myrow["emp_name"];
        $_POST['empfName'] = $myrow["emp_fname"];
        $_POST['address'] = $myrow["address"];
        $_POST['phone_no'] = $myrow["phone_no"];
        $_POST['date'] = sql2date($myrow["dateof_birth"]);
        $_POST['nationality'] = $myrow["nationality"];
        $_POST['email'] = $myrow["email"];
        $_POST['marry'] = $myrow["marital_status"];
    }

    start_outer_table(TABLESTYLE2);
    table_section(1);
    table_section_title(_("Personal Information of Employee"));

    text_row(_("Employee Name:"), 'empName', $_POST['empName'], 40, 80);
    text_row(_("Employee Father's Name:"), 'empfName', $_POST['empfName'], 30, 30);
    textarea_row(_("Address:"), 'address', $_POST['address'], 35, 5);

    text_row(_("Phone No:"), 'phone_no', $_POST['phone_no'], 40, 40);
    date_row("Date of Birth: ", 'date', 'calender');
    text_row(_("Nationality:"), 'nationality', $_POST['nationality'], 40, 40);
    text_row(_("Email:"), 'email', $_POST['email'], 40, 40);




    echo "<tr>";
    echo "<td>Marital Status</td>";
    echo "<td>";
    echo "<select name='marry'>";
    echo "<option>Single</option>";
    echo "<option>Married</option>";
    echo "<option>Others</option>";
    echo "</select>";
    echo "</td>";
    echo "</tr>";
//	if($selected_id)
//		record_status_list_row(_("Customer status:"), 'inactive');
//	elseif (isset($auto_create_branch) && $auto_create_branch == 1)
//	{
////		table_section_title(_("Branch"));
////		text_row(_("Phone:"), 'phone', null, 32, 30);
////		text_row(_("Secondary Phone Number:"), 'phone2', null, 32, 30);
////		text_row(_("Fax Number:"), 'fax', null, 32, 30);
////		email_row(_("E-mail:"), 'email', null, 35, 55);
////		sales_persons_list_row( _("Sales Person:"), 'salesman', null);
//	}
//	table_section(2);
//
//	table_section_title(_("Sales"));
//
//	percent_row(_("Discount Percent:"), 'discount', $_POST['discount']);
//	percent_row(_("Prompt Payment Discount Percent:"), 'pymt_discount', $_POST['pymt_discount']);
//	amount_row(_("Credit Limit:"), 'credit_limit', $_POST['credit_limit']);
//
//	payment_terms_list_row(_("Payment Terms:"), 'payment_terms', $_POST['payment_terms']);
//	credit_status_list_row(_("Credit Status:"), 'credit_status', $_POST['credit_status']); 
//	$dim = get_company_pref('use_dimension');
//	if ($dim >= 1)
//		dimensions_list_row(_("Dimension")." 1:", 'dimension_id', $_POST['dimension_id'], true, " ", false, 1);
//	if ($dim > 1)
//		dimensions_list_row(_("Dimension")." 2:", 'dimension2_id', $_POST['dimension2_id'], true, " ", false, 2);
//	if ($dim < 1)
//		hidden('dimension_id', 0);
//	if ($dim < 2)
//		hidden('dimension2_id', 0);
//
//	if ($selected_id)  {
//		start_row();
//		echo '<td class="label">'._('Customer branches').':</td>';
//	  	hyperlink_params_td($path_to_root . "/sales/manage/customer_branches.php",
//			'<b>'. (@$_REQUEST['popup'] ?  _("Select or &Add") : _("&Add or Edit ")).'</b>', 
//			"debtor_no=".$selected_id.(@$_REQUEST['popup'] ? '&popup=1':''));
//		end_row();
//	}
//	textarea_row(_("General Notes:"), 'notes', null, 35, 5);
//	if (!$selected_id && isset($auto_create_branch) && $auto_create_branch == 1)
//	{
//		table_section_title(_("Branch"));
//		locations_list_row(_("Default Inventory Location:"), 'location');
//		shippers_list_row(_("Default Shipping Company:"), 'ship_via');
//		sales_areas_list_row( _("Sales Area:"), 'area', null);
//		tax_groups_list_row(_("Tax Group:"), 'tax_group_id', null);
//	}
    end_outer_table(1);

    div_start('controls');
    if (!$selected_id) {
        submit_center('submit', _("Add New Customer"), true, '', 'default');
    } else {
        submit_center_first('submit', _("Update Customer"), _('Update customer data'), @$_REQUEST['popup'] ? true : 'default');
        submit_return('select', $selected_id, _("Select this customer and return to document entry."));
        submit_center_last('delete', _("Delete Customer"), _('Delete customer data if have been never used'), true);
    }
    div_end();
}

//--------------------------------------------------------------------------------------------

check_db_has_sales_types(_("There are no sales types defined. Please define at least one sales type before adding a customer."));

start_form();

if (db_has_employer()) {
    start_table(TABLESTYLE_NOBORDER);
    start_row();
    employee_list_cells(_("Select a Employee: "), 'employee_id', null, _('New employee'), true, check_value('show_inactive'));
//check_cells(_("Show inactive:"), 'show_inactive', null, true);

    end_row();
    end_table();

//    if (get_post('_show_inactive_update')) {
//        $Ajax->activate('employee_id');
//        set_focus('employee_id');
//    }
} else {
    hidden('employee_id');
}

if (!$selected_id || list_updated('employee_id'))
    unset($_POST['_tabs_sel']); // force settings tab for new customer

tabbed_content_start('tabs', array(
    'settings' => array(_('&General settings'), $selected_id),
    'secondTabvalue' => array(_('&SecondTab'), $selected_id),
    'demotabs' => array(_('&DemoTabs'), $selected_id),
   'education' => array(_('&Education'), $selected_id),
    'secondtab' =>  array(_('&DepartmentTab'),$selected_id)
));

switch (get_post('_tabs_sel')) {
    default:
    case 'settings':
        customer_settings($selected_id);
        break;
    
     case 'secondTabvalue':
        $_GET['employee_id'] = $selected_id;
        $_GET['popup'] = 1;
        include_once($path_to_root . "/sales/inquiry/second_inquiry.php");
        break;
   
    case 'education':
        $education = new education('education', $selected_id, 'customer');
        $education->show();
        break;
    case 'demotabs':
        $_GET['employee_id'] = $selected_id;
        $_GET['popup'] = 1;
        include_once($path_to_root . "/sales/inquiry/Demo_tabs_contact.php");
        break;
    case 'secondtab':
        $_GET['employee_id']=$selected_id;
        $_GET['popup']=1;
        include_once ($path_to_root . "/sales/inquiry/second_demo.php");
        break;
   
};
br();
tabbed_content_end();

hidden('popup', @$_REQUEST['popup']);
end_form();
end_page(@$_REQUEST['popup']);
?>
