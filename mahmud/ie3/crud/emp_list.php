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
$page_security = 'SA_SALESTYPES';
$path_to_root = "..";
include_once($path_to_root . "/includes/session.inc");

page(_($help_context = "Simple CRUD"));

include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/crud/includes/ui/ui_functions.inc");
include_once($path_to_root . "/crud/includes/db/employee_db.inc");

simple_page_mode(true);

//----------------------------------------------------------------------------------------------------

function can_process() {
    if (strlen($_POST['emp_name']) == 0) {
        display_error(_("The field 'Employee Name' cannot be empty."));
        set_focus('emp_name');
        return false;
    }

    if (($_POST['dsgn_id'] == 0) || ($_POST['dsgn_id'] == '')) {
        display_error(_("The field 'Designation' must has to be selected."));
        set_focus('dsgn_id');
        return false;
    }

    if (($_POST['dept_id'] == 0) || ($_POST['dept_id'] == '')) {
        display_error(_("The field 'Department' must has to be selected."));
        set_focus('dept_id');
        return false;
    }

    return true;
}

//----------------------------------------------------------------------------------------------------

if ($Mode == 'ADD_ITEM' && can_process()) {
    $table_name = 'crud_emp';
    $data_array = array(
        'emp_name' => $_POST['emp_name'],
        'emp_dsgn' => $_POST['dsgn_id'],
        'emp_dept' => $_POST['dept_id'],
    );

    insert_into_db($table_name, $data_array);
    display_notification(_('New sales type has been added'));
    $Mode = 'RESET';
}

//----------------------------------------------------------------------------------------------------
if ($Mode == 'UPDATE_ITEM' && can_process()) {
    $table_name = 'crud_emp';
    $update_array = array(
        'emp_name' => $_POST['emp_name'],
        'emp_dsgn' => $_POST['dsgn_id'],
        'emp_dept' => $_POST['dept_id'],
    );

    update_db_row($table_name, $update_array, 'emp_id', $selected_id);
    display_notification(_('Selected sales type has been updated'));
    $Mode = 'RESET';
}
//----------------------------------------------------------------------------------------------------
if ($Mode == 'Delete') {

    delete_from_db('crud_emp', 'emp_id', $selected_id);
    display_notification(_('Employee deleted successfully'));

    $Mode = 'RESET';
}
if ($Mode == 'RESET') {
    $selected_id = -1;
    $sav = get_post('show_inactive');
    unset($_POST);
    $_POST['show_inactive'] = $sav;
}
//----------------------------------------------------------------------------------------------------

$result = get_all_employees();

start_form();
start_table(TABLESTYLE, "width='40%'");

$th = array(_('Employee Name'), _('Designation'), _('Department'), '', '');
inactive_control_column($th);
table_header($th);
$k = 0;
$base_sales = get_base_sales_type();

while ($myrow = db_fetch($result)) {
//    if ($myrow["id"] == $base_sales)
//        start_row("class='overduebg'");
//    else
//        alt_table_row_color($k);

    label_cell($myrow["emp_name"]);
    label_cell($myrow["dsgn_name"]);
    label_cell($myrow["dept_name"]);

    //inactive_control_cell($myrow["id"], $myrow["inactive"], 'sales_types', 'id');

    edit_button_cell("Edit" . $myrow['emp_id'], _("Edit"));
    delete_button_cell("Delete" . $myrow['emp_id'], _("Delete"));

    end_row();
}
inactive_control_row($th);
end_table();

display_note(_("Employee List is shown above. Below is the insert panel."), 0, 0, "class='overduefg'");

//----------------------------------------------------------------------------------------------------
//if (!isset($_POST['tax_included']))
//    $_POST['tax_included'] = 0;
//if (!isset($_POST['base']))
//    $_POST['base'] = 0;

start_table(TABLESTYLE2);

if ($selected_id != -1) {

    if ($Mode == 'Edit') {
        $myrow = get_employee_data($selected_id);

        $_POST['emp_name'] = $myrow["emp_name"];
        $_POST['dsgn_id'] = $myrow["emp_dsgn"];
        $_POST['dept_id'] = $myrow["emp_dept"];
    }
    hidden('selected_id', $selected_id);
} else {
    $_POST['factor'] = number_format2(1, 4);
}

text_row_ex(_("Employee Name") . ':', 'emp_name', 40);
dsgn_combo_list_row(_("Designation:"), 'dsgn_id', '', _("None"), true);
dept_combo_list_row(_("Department:"), 'dept_id', '', _("None"), true);

//amount_row(_("Calculation factor") . ':', 'factor', null, null, null, 4);
//check_row(_("Tax included") . ':', 'tax_included', $_POST['tax_included']);
//combo_input(_("Designation") . ':', '', 'SELECT * FROM ' . TB_PREF . 'crud_dsgn', 'dsgn_id', 'dsgn_name');

end_table(1);

submit_add_or_update_center($selected_id == -1, '', 'both');

end_form();

end_page();
?>
