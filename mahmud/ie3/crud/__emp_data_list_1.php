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
$path_to_root = "..";

include($path_to_root . "/includes/db_pager.inc");
include($path_to_root . "/includes/db/common_db_crud.inc");
include($path_to_root . "/includes/session.inc");

page(_($help_context = "Employee List"), @$_REQUEST['popup']);

include($path_to_root . "/includes/ui.inc");
include($path_to_root . "/includes/ui/contacts_view.inc");

include($path_to_root . "/crud/crud_js.php");


//-----------------------------------------------------------------------------------------------

check_db_has_customers(_("There are no customers defined in the system. Please define a customer to add customer branches."));

check_db_has_sales_people(_("There are no sales people defined in the system. At least one sales person is required before proceeding."));

check_db_has_sales_areas(_("There are no sales areas defined in the system. At least one sales area is required before proceeding."));

check_db_has_shippers(_("There are no shipping companies defined in the system. At least one shipping company is required before proceeding."));

check_db_has_tax_groups(_("There are no tax groups defined in the system. At least one tax group is required before proceeding."));

simple_page_mode(true);

//-----------------------------------------------------------------------------------------------

if (isset($_GET['debtor_no'])) {
    $_POST['customer_id'] = strtoupper($_GET['debtor_no']);
}



$_POST['emp_id'] = $selected_id;

if (isset($_GET['SelectedBranch'])) {
    $br = get_branch($_GET['SelectedBranch']);
    $_POST['customer_id'] = $br['debtor_no'];
    $selected_id = $_POST['emp_id'] = $br['emp_id'];
    $Mode = 'Edit';
}
//-----------------------------------------------------------------------------------------------

if ($Mode == 'ADD_ITEM' || $Mode == 'UPDATE_ITEM') {

    if (isset($_GET['UPDATE_ITEM'])) {
        $selected_id = $_POST['emp_id'] = $br['emp_id'];
    }

    //initialise no input errors assumed initially before we test
    $input_error = 0;

    if (strlen($_POST['emp_name']) == '') {
        $input_error = 1;
        display_error(_("The field `'Employee Name' cannot be empty."));
        set_focus('emp_name');
    }
    if (strlen($_POST['emp_age']) == '') {
        $input_error = 1;
        display_error(_("The field `'Age' cannot be empty."));
        set_focus('emp_age');
    }
    if (!isset($_POST['gender'])) {
        $input_error = 1;
        display_error(_("The field `'Gender' has to be selected."));
        set_focus('gender');
    }
    if (strlen($_POST['basic_salary']) == '') {
        $input_error = 1;
        display_error(_("The field `'Basic Salary' cannot be empty."));
        set_focus('basic_salary');
    }
    if (strlen($_POST['h_rent']) == '') {
        $input_error = 1;
        display_error(_("The field `'House Rent' cannot be empty."));
        set_focus('h_rent');
    }
    if (strlen($_POST['medical']) == '') {
        $input_error = 1;
        display_error(_("The field `'Medical' cannot be empty."));
        set_focus('medical');
    }
    if (strlen($_POST['coveyance']) == '') {
        $input_error = 1;
        display_error(_("The field `'Coveyance' cannot be empty."));
        set_focus('coveyance');
    }
    if (strlen($_POST['food_allowance']) == '') {
        $input_error = 1;
        display_error(_("The field `'Food Allowance' cannot be empty."));
        set_focus('food_allowance');
    }
    if (strlen($_POST['gross_salary']) == '') {
        $input_error = 1;
        display_error(_("The field `'Gross Salary' cannot be empty."));
        set_focus('gross_salary');
    }

    if ($input_error != 1) {

        $insert_data = array(
            'emp_name' => $_POST['emp_name'],
            'age' => $_POST['emp_age'],
            'gender' => $_POST['gender'],
            'basic_salary' => $_POST['basic_salary'],
            'h_rent' => $_POST['h_rent'],
            'medical' => $_POST['medical'],
            'coveyance' => $_POST['coveyance'],
            'food_allowance' => $_POST['food_allowance'],
            'gross_salary' => $_POST['gross_salary'],
        );

        begin_transaction();

        if ($selected_id != -1) {
            db_update('crud_emp', $insert_data, array('emp_id =' => $selected_id));
            $note = _('Selected employee has been updated Successfully!');
        } else {
            db_insert('crud_emp', $insert_data);
            $note = _('New employee has been added Successfully!');
        }

        commit_transaction();

        $Mode = 'RESET';
        display_notification($note);
    }
} elseif ($Mode == 'Delete') {

    db_delete_row('crud_emp', array('emp_id =' => $_POST['emp_id']));
    display_notification(_('Selected employee has been deleted'));

    $Mode = 'RESET';
}

if ($Mode == 'RESET' || get_post('_customer_id_update')) {
    $selected_id = -1;
    $cust_id = $_POST['customer_id'];
    $inact = get_post('show_inactive');
    unset($_POST);
    $_POST['show_inactive'] = $inact;
    $_POST['customer_id'] = $cust_id;
    $Ajax->activate('_page_body');
}

//$gender=array(1=>'Male',2=>'Female');

function check_gender($row) {
//    global $gender;
//    return $gender[$row['gender']];
    //pr($row);

    if ($row['gender'] == 1) {
        return 'Male';
    } else {
        return 'Female';
    }
}

function branch_email($row) {
    return '<a href = "mailto:' . $row["email"] . '">' . $row["email"] . '</a>';
}

function edit_link($row) {
    return button("Edit" . $row["emp_id"], _("Edit"), '', ICON_EDIT);
}

function del_link($row) {
    return button("Delete" . $row["emp_id"], _("Delete"), '', ICON_DELETE);
}

function select_link($row) {
    return button("Select" . $row["emp_id"], $row["emp_id"], '', ICON_ADD, 'selector');
}

function branch_settings($selected_id) {
    global $Mode, $num_branches;


    display_error($selected_id);
    start_outer_table(TABLESTYLE2);

    table_section(1);

    $_POST['email'] = "";
    if ($selected_id != -1) {
        if ($Mode == 'Edit' || !isset($_POST['emp_id'])) {
            //editing an existing branch      
            display_error($selected_id);
            $myrow = db_fetch_single_row('crud_emp', '*', array('emp_id =' => $_POST["emp_id"]));

            set_focus('emp_id');
            $_POST['emp_id'] = $myrow["emp_id"];
            $_POST['emp_name'] = $myrow["emp_name"];
            $_POST['emp_age'] = $myrow["age"];
            $_POST['gender'] = $myrow["gender"];
            $_POST['basic_salary'] = $myrow["basic_salary"];
            $_POST['h_rent'] = $myrow["h_rent"];
            $_POST['medical'] = $myrow["medical"];
            $_POST['coveyance'] = $myrow["coveyance"];
            $_POST['food_allowance'] = $myrow["food_allowance"];
            $_POST['gross_salary'] = $myrow["gross_salary"];
        }
    } elseif ($Mode != 'ADD_ITEM') { //end of if $SelectedBranch only do the else when a new record is being entered
        $myrow = get_default_info_for_branch($_POST['customer_id']);
//		$_POST['rep_lang'] = $myrow['rep_lang'];
        if (!$num_branches) {
            $_POST['br_name'] = $myrow["name"];
            $_POST['br_ref'] = $myrow["debtor_ref"];
            $_POST['contact_name'] = _('Main Branch');
            $_POST['br_address'] = $_POST['br_post_address'] = $myrow["address"];
        }
        $_POST['emp_id'] = "";
        if (!isset($_POST['sales_account']) || !isset($_POST['sales_discount_account'])) {
            $company_record = get_company_prefs();

            // We use the Item Sales Account as default!
            // $_POST['sales_account'] = $company_record["default_sales_act"];
            $_POST['sales_account'] = $_POST['notes'] = '';
            $_POST['sales_discount_account'] = $company_record['default_sales_discount_act'];
            $_POST['receivables_account'] = $company_record['debtors_act'];
            $_POST['payment_discount_account'] = $company_record['default_prompt_payment_act'];
        }
    }
    hidden('popup', @$_REQUEST['popup']);

    table_section_title(_("Name and Contact"));
    text_row(_("Employee Name:"), 'emp_name', null, 35, 40);
    
    start_row();
    label_cell(_(_("Age:")));
    text_cell("", 'emp_age', NULL, 10, 2, 'Employee Age', "", "", "onkeypress=\"return isNumeric(event)\"");
    end_row();
    
    start_row();
    label_cell(_("Gender:"));
    start_cell();
    radio('Male', 'gender', 1);
    space_single(5);
    radio('Female', 'gender', 2);
    end_cell();
    end_row();


    table_section(2);

    table_section_title(_("Salary Information"));
    start_row();
    label_cell(_(_("Basic Salary:")));
    text_cell("", 'basic_salary', NULL, 15, 40, 'Employee basic', "", "", "class='basic_salary salary_part' onkeypress=\"return isNumeric(event)\"");
    end_row();

    start_row();
    label_cell(_(_("House Rent:")));
    text_cell("", 'h_rent', NULL, 15, 40, 'House Rent', "", "", "class='h_rent salary_part' onkeypress=\"return isNumeric(event)\"");
    end_row();

    start_row();
    label_cell(_(_("Medical:")));
    text_cell("", 'medical', NULL, 15, 40, 'Medical', "", "", "class='medical salary_part' onkeypress=\"return isNumeric(event)\"");
    end_row();

    start_row();
    label_cell(_(_("Coveyance:")));
    text_cell("", 'coveyance', NULL, 15, 40, 'Coveyance', "", "", "class='coveyance salary_part' onkeypress=\"return isNumeric(event)\"");
    end_row();

    start_row();
    label_cell(_(_("Food Allowance:")));
    text_cell("", 'food_allowance', NULL, 15, 40, 'Food Allowance', "", "", "class='food_allowance salary_part' onkeypress=\"return isNumeric(event)\"");
    end_row();

    start_row();
    label_cell(_(_("Gross Salary:")));
    text_cell("", 'gross_salary', NULL, 15, 40, 'Gross Salary', "", "", "class='gross_salary' onkeypress=\"return isNumeric(event)\"");
    end_row();

//    if ($selected_id != -1)
//        yesno_list_row(_("Disable this Branch:"), 'disable_trans', null);

    end_outer_table(1);
    submit_add_or_update_center($selected_id == -1, '', 'both');
}

start_form();
start_table(TABLESTYLE_NOBORDER);
start_row();
employee_list_cells(_("Select an Employee: "), 'emp_id', null, _('Select Employee'), true, check_value('show_inactive'));
check_cells(_("Show inactive:"), 'show_inactive', null, true);
end_row();
end_table();

//start_table();
//    start_row();
//        customer_list_cells('Select a customer: ', 'customer_id', $_POST['customer_id'], 'Select', TRUE);
//    end_row();
//end_table();
//$num_branches = db_customer_has_branches($_POST['customer_id']);

$tbl_fields = 'emp_id, emp_name, age, gender, basic_salary, h_rent, medical, coveyance, food_allowance, gross_salary';
$sql = db_tbl_fetch('crud_emp', $tbl_fields); //get_sql_for_customer_branches();
//------------------------------------------------------------------------------------------------
//if (1) {
$cols = array(
    'emp_id' => 'skip',
    _("Employee Name"),
    _("Age"),
    _("Gender") => array('fun' => 'check_gender'),
    _("Basic Salary"),
    _("House Rent"),
    _("Medical"),
    _("Conveyance"),
    _("Food Allowance"),
    // _("Food Allowance") => 'email',
    _("Gross Salary"),
    _("Inactive") => 'inactive',
    // array('fun'=>'inactive'),
    '' => array('insert' => true, 'fun' => 'select_link'),
    array('insert' => true, 'fun' => 'edit_link'),
    array('insert' => true, 'fun' => 'del_link')
);

if (!@$_REQUEST['popup']) {
    $cols[' '] = 'skip';
}
$table = & new_db_pager('branch_tbl', $sql, $cols, 'crud_emp');
$table->set_inactive_ctrl('cust_branch', 'emp_id');

//$table->width = "85%";
display_db_pager($table);
//} else
//    display_note(_("The selected customer does not have any branches. Please create at least one branch."));

tabbed_content_start('tabs', array(
    'settings' => array(_('&Employee Info'), $selected_id != -1),
//    'contacts' => array(_('&Contacts'), $selected_id != -1),
//    'orders' => array('S&ales orders', $selected_id != -1) // not implemented
));

switch (get_post('_tabs_sel')) {
    default:
    case 'settings':
        branch_settings($selected_id);

        break;
    case 'contacts':
        $contacts = new contacts('contacts', $selected_id, 'cust_branch');
        $contacts->show();
        break;
    case 'orders':
}

hidden('emp_id');
hidden('selected_id', $selected_id);
br();
tabbed_content_end();


end_form();

end_page(@$_REQUEST['popup']);

