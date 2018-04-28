<?php

/* * **********************************************************************
  Copyright (C) FrontAccounting, LLC.
  Released under the terms of the GNU General Public License, GPL,
  as published by the Free Software Foundation, either version 3
  of the License, or (at your option) any later version.
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
  See the License here <http://www.gnu.org/licenses/gpl-3.0.html>.
 * ********************************************************************* */

$page_security = 'SA_INVENTORYADJUSTMENT';

$path_to_root = "..";
include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/includes/session.inc");
include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/ui/items_cart.inc");
include_once($path_to_root . "/includes/ui/ui_view.inc");
include_once($path_to_root . "/includes/db/common_db_crud.inc");

include_once($path_to_root . "/crud/crud_js.php");
include_once($path_to_root . "/crud/cart_crud.php");
include_once($path_to_root . "/crud/includes/ui/cart_page_ui.php");

$js = "";
if ($use_popup_windows) {
    $js .= get_js_open_window(800, 500);
}
if ($use_date_picker) {
    $js .= get_js_date_picker();
}

page(_($help_context = "Simple Cart Page"), false, false, "", $js);


//*************************** Inserting Into Database **************************
if (isset($_POST['Process'])) {
    $isValid = check_post_data_validity(array('branch_name' => 'Branch Name', 'launch_date' => 'Launching Date', 'location' => 'Location'));
    //$isValid = check_cart_validity();

    if ($isValid) {
        insert_cart_into_db();
        clear_post_fields();
        $Ajax->activate('emp_table');
        $Ajax->activate('branch_box');
        display_notification_centered(_("Employees has been processed Successfully!"));
    }
}

/* -------When New Cart requested, below function clear`s the Session-------- */
if (isset($_GET['NewEmployee']) && ($_GET['NewEmployee'] == 1)) {
    if (isset($_SESSION['employee_list'])) {
        unset($_SESSION['employee_list']);
    }

    $_SESSION['employee_list'] = array();
}

/* ----------------------------CRUD Operations------------------------------- */
if (isset($_POST['add_new_emp'])) { // Add New element to CART
    $isValid = check_cart_validity();

    if ($isValid) {
        save_into_cart($_POST);
        clear_post_fields();
        $Ajax->activate('emp_table');
    }
} else if (isset($_POST['update_emp'])) { // Update element into CART
    $isValid = check_cart_validity();

    if ($isValid) {
        save_into_cart($_POST, $_POST['cart_key']);
        clear_post_fields();
        $Ajax->activate('emp_table');
    }
}
/* ---------------------------------------------------------------------------- */
if (isset($_POST['cancel_update'])) {
    clear_post_fields();
}

$submit_id = find_submit('Edit'); // Grab the Cart ID for `Edit`
$submit_delete_id = find_submit('Delete'); // Grab the Cart ID for `Edit`
if ($submit_id != -1) {
    $cart_emp = $_SESSION['employee_list'];
} else if ($submit_delete_id != -1) {
    unset($_SESSION['employee_list'][$submit_delete_id]);
}
$Ajax->activate('emp_table');
/* -------------------------------------------------------------------------- */

start_form();

start_outer_table(TABLESTYLE, "width=80%", 10);

display_heading('Employee List');


div_start('branch_box');
display_employee_header();
div_end();

div_start('emp_table');
start_table(TABLESTYLE, "width=100%");

$th = array(_("SL."), _("Name"), _("Designation"), _("Dept."), _("Age"), _("Gender"), _("Basic"), _('H.Rent'), _('Medical'), _('Coveyance'), _('Food A.'), _('Gross'), "", "");
table_header($th);

$i = 1;

if (isset($_SESSION['employee_list']) && (count($_SESSION['employee_list']) > 0)) {
    foreach ($_SESSION['employee_list'] as $key => $row) {
        echo '<tr>';
        if ($submit_id == $key) {
            cell_wrap(($i++) . hidden('cart_key', $key, FALSE));
            input_cell(NULL, 'emp_name', 'text', $cart_emp[$submit_id]['emp_name'], 10);
            dsgn_combo_list(db_tbl_fetch('crud_dsgn'), 'dsgn_list', $cart_emp[$submit_id]['emp_dsgn']);
            dept_combo_list(db_tbl_fetch('crud_dept'), 'dept_list', $cart_emp[$submit_id]['emp_dept']);
            text_cell("", 'emp_age', $cart_emp[$submit_id]['age'], 3, 3, 'Employee basic', "", "", " onkeypress=\"return isNumeric(event)\"");
            gender_combo(NULL, 'emp_gender', array(1 => 'Male', 2 => 'Female'), $cart_emp[$submit_id]['gender']);
            text_cell("", 'basic_salary', $cart_emp[$submit_id]['basic_salary'], 7, 10, 'Employee basic', "", "", "class='basic_salary salary_part' onkeypress=\"return isNumeric(event)\"");
            text_cell("", 'h_rent', $cart_emp[$submit_id]['h_rent'], 7, 10, 'House Rent', "", "", "class='h_rent salary_part' onkeypress=\"return isNumeric(event)\"");
            text_cell("", 'medical', $cart_emp[$submit_id]['medical'], 7, 10, 'Medical', "", "", "class='medical salary_part' onkeypress=\"return isNumeric(event)\"");
            text_cell("", 'coveyance', $cart_emp[$submit_id]['coveyance'], 7, 10, 'Coveyance', "", "", "class='coveyance salary_part' onkeypress=\"return isNumeric(event)\"");
            text_cell("", 'food_allowance', $cart_emp[$submit_id]['food_allowance'], 7, 10, 'Food Allowance', "", "", "class='food_allowance salary_part' onkeypress=\"return isNumeric(event)\"");
            text_cell("", 'gross_salary', $cart_emp[$submit_id]['gross_salary'], 7, 10, 'Gross Salary', "", "", "class='gross_salary' onkeypress=\"return isNumeric(event)\"");
            /* submit_cells('update_emp', _("Update"), "colspan=2", _('Add new employee'), true); */
            button_cell('update_emp', _("Update"), _('Confirm changes'), ICON_UPDATE);
            button_cell('cancel_update', _("Cancel"), _('Cancel changes'), ICON_CANCEL);
        } else {
            cell_wrap($i++);
            cell_wrap($row['emp_name']);
            cell_wrap(_(db_fetch_single_cell('crud_dsgn', 'dsgn_name', array('dsgn_id =' => $row['emp_dsgn']))));
            cell_wrap(_(db_fetch_single_cell('crud_dept', 'dept_name', array('dept_id =' => $row['emp_dept']))));
            cell_wrap($row['age']);
            cell_wrap(($row['gender'] == 1) ? 'Male' : 'Female');
            cell_wrap($row['basic_salary']);
            cell_wrap($row['h_rent']);
            cell_wrap($row['medical']);
            cell_wrap($row['coveyance']);
            cell_wrap($row['food_allowance']);
            cell_wrap($row['gross_salary']);
            edit_button_cell("Edit{$key}", _("Edit"), _('Edit employee'));
            delete_button_cell("Delete{$key}", _("Delete"), _('Remove employee'));
        }
        echo '</tr>';
    }
}

if ($submit_id == -1) {
    echo '<tr>';
    cell_wrap($i);
    input_cell(NULL, 'emp_name', 'text', NULL, 10);
    dsgn_combo_list(db_tbl_fetch('crud_dsgn'), 'dsgn_list');
    dept_combo_list(db_tbl_fetch('crud_dept'), 'dept_list');
    text_cell("", 'emp_age', NULL, 3, 3, 'Employee basic', "", "", " onkeypress=\"return isNumeric(event)\"");
    gender_combo(NULL, 'emp_gender', array(1 => 'Male', 2 => 'Female'));
    text_cell("", 'basic_salary', NULL, 7, 10, 'Employee basic', "", "", "class='basic_salary salary_part' onkeypress=\"return isNumeric(event)\"");
    text_cell("", 'h_rent', NULL, 7, 10, 'House Rent', "", "", "class='h_rent salary_part' onkeypress=\"return isNumeric(event)\"");
    text_cell("", 'medical', NULL, 7, 10, 'Medical', "", "", "class='medical salary_part' onkeypress=\"return isNumeric(event)\"");
    text_cell("", 'coveyance', NULL, 7, 10, 'Coveyance', "", "", "class='coveyance salary_part' onkeypress=\"return isNumeric(event)\"");
    text_cell("", 'food_allowance', NULL, 7, 10, 'Food Allowance', "", "", "class='food_allowance salary_part' onkeypress=\"return isNumeric(event)\"");
    text_cell("", 'gross_salary', NULL, 7, 10, 'Gross Salary', "", "", "class='gross_salary' onkeypress=\"return isNumeric(event)\"");
    submit_cells('add_new_emp', _("Add Employee"), "colspan=2", _('Add new employee'), true);
    echo '</tr>';
}

end_table();
div_end();

end_outer_table(1, false);

$Ajax->activate('emp_table');

submit_center_first('Update', _("Update"), '', null);
submit_center_last('Process', _("Process Employee"), '', 'default');

end_form();


/* -------------Just For Debuging-------------- */
//pr($_POST);
//pr($_SESSION['employee_list']);
//display_error("--------------->>>> " . $submit_id);
/* -------------------------------------------- */

end_page();
