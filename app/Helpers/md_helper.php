<?php
function check_access($role_id, $menu_id)
{
    $db = db_connect();
    $builder = $db->table('auth_groups_permissions');

    $result = $builder->getWhere(['group_id' => $role_id, 'permission_id' => $menu_id]);

    if ($result->getRowArray() > 0) {
        return "checked='checked'";
    }
}
