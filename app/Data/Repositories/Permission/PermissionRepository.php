<?php

namespace App\Data\Repositories\Permission;

interface PermissionRepository
{
    public function all($where = [], $first = true, $select = ["*"], $order_by = [], $with = []);

    public function getDummy();

    public function create($data);

    public function update($data, $where = []);

    public function delete($where);

    public function enableDisable($id, $status);

    public function dataTable($with = [], $where = []);
}
