<?php

function cell_wrap($content = '') {
    echo '<td>' . $content . '</td>';
}

function dsgn_combo_list($sql = '', $name, $selected_id = null, $all_option = false, $all = true) {
    global $all_items;

    $ARR = array(
        'format' => '_format_account',
        'order' => array('dsgn_id'),
        'spec_option' => $all_option,
        'spec_id' => $all_items
    );

    echo "<td>" . combo_input($name, $selected_id, $sql, 'dsgn_id', 'dsgn_name', $ARR) . "</td>";
}

function dept_combo_list($sql = '', $name, $selected_id = null, $all_option = false, $all = true) {
    global $all_items;

    $ARR = array(
        'format' => '_format_account',
        'order' => array('dept_id'),
        'spec_option' => $all_option,
        'spec_id' => $all_items
    );

    echo "<td>" . combo_input($name, $selected_id, $sql, 'dept_id', 'dept_name', $ARR) . "</td>";
}

function input_cell($label, $name, $type = "text", $value = null, $size = "", $max = "", $title = false, $labparams = "", $post_label = "", $inparams = "") {
    global $Ajax;

    default_focus($name);
    if ($label != null) {
        label_cell($label, $labparams);
    }
    echo "<td>";

    if ($value === null) {
        $value = get_post($name);
    }
    echo "<input $inparams type=\"$type\" name=\"$name\" size=\"$size\" maxlength=\"$max\" value=\"$value\"" . (($title != FALSE) ? " title='$title'" : '') . ">";

    if ($post_label != "") {
        echo " " . $post_label;
    }
    echo "</td>\n";

    $Ajax->addUpdate($name, $name, $value);
}

function radio_cell($label = NULL, $name, $ARR = array(), $labparams = "") {
    global $Ajax;

    default_focus($name);
    if ($label != null) {
        label_cell($label, $labparams);
    }

    echo '<td>';
    if (!empty($ARR)) {
        foreach ($ARR as $key => $value) {
            echo '<input type="radio" name="' . $name . '" value="' . $key . '"/> ' . $value . '<br/>';
        }
    }
    echo '</td>';
}

//function gender_combo(NULL, 'emp_gender', array(1 => 'Male', 2 => 'Female')){
function gender_combo($label = NULL, $name, $ARR = array(), $selected_id = '', $labparams = "") {
    global $Ajax;

    default_focus($name);
    if ($label != null) {
        label_cell($label, $labparams);
    }

    echo '<td>';
    if (!empty($ARR)) {
        echo '<select name="' . $name . '">';
        foreach ($ARR as $key => $value) {
            $slct = ($key == $selected_id) ? 'selected' : '';
            echo '<option value="' . $key . '" ' . $slct . '>' . $value . '</option>';
        }
        echo '</select>';
    }
    echo '</td>';
}

function display_employee_header() {
    global $Refs;

    start_outer_table(TABLESTYLE2, "width=70%"); // outer table
    /**/table_section(1);
    /**//**/text_cell("Branch Name: ", 'branch_name', NULL, 20, 100, 'Branch Name');
    /**/table_section(2, "30%");
    /**//**/date_row(_("Launching Date:"), 'launch_date', '', true);
    /**/table_section(3, "35%");
    /**//**/textarea_cells(_("Location"), "location", "", 20, 3, $title = null, $params = "");
    end_outer_table(1); // outer table
}

function clear_post_fields($ARR = array('emp_name', 'dsgn_list', 'dept_list', 'emp_age', 'emp_gender', 'basic_salary', 'h_rent', 'medical', 'coveyance', 'food_allowance', 'gross_salary'), $appended_array = array('branch_name', 'launch_date', 'location')) {
    global $Ajax;

    $ARR = array_merge($ARR, $appended_array);

    if (!empty($ARR)) {
        foreach ($ARR as $value) {
            unset($_POST[$value]);
        }
    }
}
