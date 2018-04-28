<?php

/* ---------------- Code for Designation ---------------- */

function dsgn_combo_list_row($label, $name, $selected_id = null, $all_option = false, $all = false) {
    echo "<tr><td class='label'>$label</td>";
    dsgn_combo_list_cells(null, $name, $selected_id, $all_option, $all);
    echo "</tr>\n";
}

function dsgn_combo_list_cells($label, $name, $selected_id = null, $all_option = false, $all = false) {
    if ($label != null)
        echo "<td>$label</td>\n";

    echo "<td>";
    echo dsgn_combo_list($name, $selected_id, $all_option, $all);
    echo "</td>\n";
}

function dsgn_combo_list($name, $selected_id = null, $all_option = false, $all = true) {
    global $all_items;

    $sql = "SELECT dsgn_id, dsgn_name FROM " . TB_PREF . "crud_dsgn";

    $ARR = array(
        'format' => '_format_account',
        'order' => array('dsgn_id'),
        'spec_option' => $all_option,
        'spec_id' => $all_items
    );

    return combo_input($name, $selected_id, $sql, 'dsgn_id', 'dsgn_name', $ARR);
}

/* ---------------- Code for Department ---------------- */

function dept_combo_list_row($label, $name, $selected_id = null, $all_option = false, $all = false) {
    echo "<tr><td class='label'>$label</td>";
    dept_combo_list_cells(null, $name, $selected_id, $all_option, $all);
    echo "</tr>\n";
}

function dept_combo_list_cells($label, $name, $selected_id = null, $all_option = false, $all = false) {
    if ($label != null)
        echo "<td>$label</td>\n";

    echo "<td>";
    echo dept_combo_list($name, $selected_id, $all_option, $all);
    echo "</td>\n";
}

function dept_combo_list($name, $selected_id = null, $all_option = false, $all = true) {
    global $all_items;

    $sql = "SELECT dept_id, dept_name FROM " . TB_PREF . "crud_dept";

    $ARR = array(
        'format' => '_format_account',
        'order' => array('dept_id'),
        'spec_option' => $all_option,
        'spec_id' => $all_items
    );

    return combo_input($name, $selected_id, $sql, 'dept_id', 'dept_name', $ARR);
}
//
////employee list for demo
//function employee_list_cells($label, $name, $selected_id = null, $all_option = false, $submit_on_change = false, $show_inactive = false, $editkey = false) {
//    if ($label != null)
//        echo "<td>$label</td>\n";
//    echo "<td nowrap>";
//    echo customer_list($name, $selected_id, $all_option, $submit_on_change, $show_inactive, $editkey);
//    echo "</td>\n";
//}
//
//function employee_list($name, $selected_id = null, $spec_option = false, $submit_on_change = false, $show_inactive = false, $editkey = false) {
//    global $all_items;
//
//    $sql = "SELECT empid, emp_name FROM " . TB_PREF . "employee ";
//
//    $mode = get_company_pref('no_customer_list');
//
//    if ($editkey)
//        set_editor('customer', $name, $editkey);
//
//    $ret = combo_input($name, $selected_id, $sql, 'empid', 'emp_name', array(
//        'format' => '_format_add_curr',
//        'order' => array('emp_name'),
//        'search_box' => $mode != 0,
//        'type' => 1,
//        'size' => 20,
//        'search' => array("debtor_ref", "name", "tax_id"),
//        'spec_option' => $spec_option === true ? _("All Customers") : $spec_option,
//        'spec_id' => $all_items,
//        'select_submit' => $submit_on_change,
//        'async' => false,
//        'sel_hint' => $mode ? _('Press Space tab to filter by name fragment; F2 - entry new customer') :
//        _('Select customer'),
//        'show_inactive' => $show_inactive
//    ));
//    if ($editkey)
//        $ret .= add_edit_combo('customer');
//
//    return $ret;
//}
