<?php

$page_security = 'SA_CUSTOMER'; // Page Security Key
$path_to_root = "..";

include_once($path_to_root . "/includes/db_pager.inc");
include_once($path_to_root . "/includes/session.inc");
include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/includes/ui/ui_input.inc");
include_once($path_to_root . "/includes/db/common_db_crud.inc");
include_once($path_to_root . "/crud/crud_js.php");

page(_($help_context = "Page Header"));


$Ajax->activate('_page_body');

$selected_id = (isset($_POST['emp_id'])) ? $_POST['emp_id'] : '';

if (isset($_POST['ADD_ITEM']) || isset($_POST['UPDATE_ITEM'])) {
    if ($selected_id == '') {
        $Mode = 'ADD_ITEM';
    } else if ($selected_id != '') {
        $Mode = 'UPDATE_ITEM';
    }
}

function check_gender($row) {
    if ($row['gender'] == 1) {
        return 'Male';
    } else {
        return 'Female';
    }
}

/* ------------New Employee Insert Code------------ */
//-----------------------------------------------------------------------------------------------
//display_error("---->>> ".$Mode);

if ((isset($Mode)) && ($Mode == 'ADD_ITEM' || $Mode == 'UPDATE_ITEM')) {


    if (isset($_GET['UPDATE_ITEM'])) {
        $selected_id = $_POST['emp_id'] = $br['emp_id'];
    }

    //initialise no input errors assumed initially before we test
    $input_error = 0;

    if (strlen($_POST['emp_name']) == '') {
        $input_error = 1;
        display_error(_("The field 'Employee Name' cannot be empty."));
        set_focus('emp_name');
    }
    if (strlen($_POST['emp_age']) == '') {
        $input_error = 1;
        display_error(_("The field 'Age' cannot be empty."));
        set_focus('emp_age');
    }
    if (!isset($_POST['gender'])) {
        $input_error = 1;
        display_error(_("The field 'Gender' has to be selected."));
        set_focus('gender');
    }
    if (strlen($_POST['basic_salary']) == '') {
        $input_error = 1;
        display_error(_("The field 'Basic Salary' cannot be empty."));
        set_focus('basic_salary');
    }
    if (strlen($_POST['h_rent']) == '') {
        $input_error = 1;
        display_error(_("The field 'House Rent' cannot be empty."));
        set_focus('h_rent');
    }
    if (strlen($_POST['medical']) == '') {
        $input_error = 1;
        display_error(_("The field 'Medical' cannot be empty."));
        set_focus('medical');
    }
    if (strlen($_POST['coveyance']) == '') {
        $input_error = 1;
        display_error(_("The field 'Coveyance' cannot be empty."));
        set_focus('coveyance');
    }
    if (strlen($_POST['food_allowance']) == '') {
        $input_error = 1;
        display_error(_("The field 'Food Allowance' cannot be empty."));
        set_focus('food_allowance');
    }
    if (strlen($_POST['gross_salary']) == '') {
        $input_error = 1;
        display_error(_("The field 'Gross Salary' cannot be empty."));
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


        if ($selected_id != '') {


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
} elseif ((isset($Mode)) && ($Mode == 'Delete')) {
    db_delete_row('crud_emp', array('emp_id =' => $_POST['emp_id']));
    display_notification(_('Selected employee has been deleted'));

    $Mode = 'RESET';
}

/* -------------Made has been RESET here------------- */
if ((isset($Mode)) && ($Mode == 'RESET' || get_post('_customer_id_update'))) {
    $selected_id = -1;
    $inact = get_post('show_inactive');
    unset($_POST);
    $_POST['show_inactive'] = $inact;
    $Ajax->activate('_page_body');
}

/* ---------------Employee Drop-Down--------------- */
start_form();

if (db_has_employees()) {
    start_table(TABLESTYLE_NOBORDER);
    start_row();
    employee_list_cells(_("Select an Employee: "), 'emp_id', null, _('Select Employee'), true, check_value('show_inactive'));
    end_row();
    end_table();

    if (get_post('_show_inactive_update')) {
        $Ajax->activate('emp_id');
        set_focus('emp_id');
    }
} else {
    hidden('emp_id');
}
end_form();
/* ------------------------------------------------ */

$tbl_fields = 'emp_id, emp_name, age, gender, basic_salary, h_rent, medical, coveyance, food_allowance, gross_salary';
$sql = db_tbl_fetch('crud_emp', $tbl_fields);

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
    _("Gross Salary")
);

if (!@$_REQUEST['popup']) {
    $cols[' '] = 'skip';
}

$table = & new_db_pager('employee_tbl', $sql, $cols);

//$table->set_inactive_ctrl('crud_emp', 'emp_id');

$table->width = "70%";
display_db_pager($table);


/* if (isset($_GET['SelectedBranch'])) {
  $br = get_branch($_GET['SelectedBranch']);
  $_POST['customer_id'] = $br['debtor_no'];
  $selected_id = $_POST['emp_id'] = $br['emp_id'];
  $Mode = 'Edit';
  } */


start_outer_table(TABLESTYLE2);

table_section(1);

$_POST['email'] = "";
if ($selected_id != -1) {

    if ((isset($Mode)) && ($Mode == 'Edit' || isset($_POST['emp_id']))) {

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
}

hidden('popup', @$_REQUEST['popup']);

start_form();

//-----------Left Part of the Form-----------
table_section_title(_("Name and Contact"));
// `Employee Name` text field
text_row(_("Employee Name:"), 'emp_name', null, 35, 40);
// `Age` text field
start_row();
label_cell(_(_("Age:")));
text_cell("", 'emp_age', NULL, 10, 2, 'Employee Age', "", "", "onkeypress=\"return isNumeric(event)\"");
end_row();
// `Gender` text field
start_row();
label_cell(_("Gender:"));
start_cell();
radio('Male', 'gender', 1);
space_single(5);
radio('Female', 'gender', 2);
end_cell();
end_row();



//------------Right Part of the Form------------
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

end_outer_table(1);

submit_add_or_update_center($selected_id == 0, '', 'both');

end_form();

end_page();
