                                                                                                                                                                                                                        <?php

function get_sql_for_all_employees() {
    $selected_fields = '';
    $tbl_name = '';
    
    return 'SELECT '.$selected_fields.' FROM '.$tbl_name.' WHERE `is_active`=1';
}

function get_all_employees($all = false) {

    $emp = TB_PREF . "crud_emp";
    $dsgn = TB_PREF . "crud_dsgn";
    $dept = TB_PREF . "crud_dept";

    $sql = "SELECT * FROM " . $emp . " LEFT JOIN " . $dsgn . " ON " . $dsgn . ".dsgn_id = " . $emp . ".emp_dsgn LEFT JOIN " . $dept . " ON " . $dept . ".dept_id = " . $emp . ".emp_dept";

    return db_query($sql, "Could not get all employees");
}

function insert_into_db($table_name, $data_array = array()) {

    $db_fields = $db_val = array();
    if ($data_array) {
        foreach ($data_array as $key => $value) {
            $db_fields[] = $key;
            $db_val[] = db_escape($value);
        }
    }

    $sql = "INSERT INTO " . TB_PREF . $table_name . " (" . implode(', ', $db_fields) . ") VALUES (" . implode(', ', $db_val) . ")";

    db_query($sql, "could not add sales type");
}

function get_employee_data($id) {
    $sql = "SELECT * FROM " . TB_PREF . "crud_emp WHERE emp_id=" . db_escape($id);
    $result = db_query($sql, "Could not get Employee data");

    return db_fetch($result);
}

function update_db_row($table_name, $update_array = array(), $pKey, $pVal) {
    $conditions = array();
    if ($update_array) {
        foreach ($update_array as $key => $value) {
            $conditions[] = $key . ' = ' . db_escape($value);
        }
    }

    $sql = "UPDATE " . TB_PREF . $table_name . " SET " . implode(', ', $conditions) . " WHERE " . $pKey . " = " . $pVal;
    db_query($sql, "Could not update Employee data");
}

function delete_from_db($table_name, $field, $val) {
    $sql = "DELETE FROM " . TB_PREF . $table_name . " WHERE " . $field . " = " . db_escape($val);
    db_query($sql, "The Sales type record could not be deleted");
}
