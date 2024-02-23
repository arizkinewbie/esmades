<?php

function getListModule($where = []) {
    $db = db_connect();
    if($where) {
        return $db->table('m_modul')->where($where)->orderBy('urut', 'asc')->get()->getResultArray();
    } else {
        return $db->table('m_modul')->orderBy('urut', 'asc')->get()->getResultArray();
    }
}

function countSubMenu($id) {
    $db = db_connect();
    return $db->query('select * from m_modul where sub_modul_id = "'.$id.'"')->getNumRows();
}