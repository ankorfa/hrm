<?php

function db_insert($tbl = '', $arr = array()) {
    $db_fields = $db_field_value = array();

    if (!empty($arr)) {
        foreach ($arr AS $key => $value) {
            $db_fields[] = $key;
            $db_field_value[] = db_escape($value);
        }
    }

    $sql = "INSERT INTO " . TB_PREF . $tbl . " (" . (implode(', ', $db_fields)) . ") VALUES (" . (implode(', ', $db_field_value)) . ")";

    $ret = db_query($sql, "Cannot insert Employee record!");
    return db_insert_id();
}

function db_update($tbl = '', $update_array = array(), $where = array()) {
    $condition_arr = $update_arr = array();
    $condition = "";

    if (!empty($update_array)) {
        foreach ($update_array AS $key1 => $value1) {
            $update_arr[] = $key1 . '=' . db_escape($value1);
        }
    }

    if (!empty($where)) {
        foreach ($where AS $key => $value) {
            $condition_arr[] = $key . db_escape($value);
        }
        $condition = " WHERE " . implode(" AND ", $condition_arr);
    }

    $sql = "UPDATE " . TB_PREF . $tbl . " SET " . implode(', ', $update_arr) . $condition;

    $result = db_query($sql, "Row update failed!");
}

function db_delete_row($tbl = '', $where = array()) {
    $condition_arr = array();
    $condition = "";

    if (!empty($where)) {
        foreach ($where AS $key => $value) {
            $condition_arr[] = $key . db_escape($value);
        }
        $condition = " WHERE " . implode(" AND ", $condition_arr);
    }

    $sql = "DELETE FROM " . TB_PREF . $tbl . $condition;

    $result = db_query($sql, "could not delete branch");
}

function db_fetch_single_row($tbl = '', $select_fields = '*', $where = array()) {
    $condition_arr = array();
    $condition = "";

    if (!empty($where)) {
        foreach ($where AS $key => $value) {
            $condition_arr[] = $key . db_escape($value);
        }
        $condition = " WHERE " . implode(" AND ", $condition_arr);
    }
    $sql = "SELECT " . $select_fields . " FROM " . TB_PREF . $tbl . $condition;

    $result = db_query($sql, "Row fetch failed!");
    return db_fetch($result);
}

function db_tbl_fetch($tbl = '', $select_fields = '*') {
    $sql = "SELECT " . $select_fields . " FROM " . TB_PREF . $tbl;
    return $sql;
}

function db_tbl_fetch_result($tbl = '', $select_fields = '*') {
    $sql = "SELECT " . $select_fields . " FROM " . TB_PREF . $tbl;

    $result = db_query($sql, "Table data fetch failed!");
    return db_fetch($result);
}

function db_fetch_single_cell($tbl = '', $field = '', $where = array()) {
    $condition_arr = array();
    $condition = "";

    if (!empty($where)) {
        foreach ($where AS $key => $value) {
            $condition_arr[] = $key . db_escape($value);
        }
        $condition = " WHERE " . implode(" AND ", $condition_arr);
    }
    $sql = "SELECT " . $field . " FROM " . TB_PREF . $tbl . $condition;


    $result = db_query($sql, "Cell fetch failed!");
    $res = db_fetch($result);
    //display_error($res[$field]);
    return $res[$field];
}
