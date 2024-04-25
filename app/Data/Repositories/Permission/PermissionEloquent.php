<?php

namespace App\Data\Repositories\Permission;

use App\Data\Models\Permission;

class PermissionEloquent implements PermissionRepository
{
    public function all($where = [], $first = true, $select = ["*"], $order_by = [], $with = [])
    {
        if(empty($order_by)) {
            $order_by = ["id", "asc"];
        }

        $obj = Permission::select($select);
        if (count($with) > 0) {
            $obj->with($with);
        }

        foreach ($where as $value) {
            if (count($value) == 3) {
                $obj->where($value[0], $value[1], $value[2]);
            } else {
                $obj->where($value[0], $value[1]);
            }
        }

        if ($first == false) {
            return $obj->orderBy($order_by[0], $order_by[1])->get();
        }

        return $obj->first();
    }

    public function getDummy()
    {
        return new Permission;
    }

    public function create($data)
    {
        return Permission::create($data);
    }

    public function update($data, $where = [])
    {
        $obj = Permission::select("*");
        foreach ($where as $value) {
            if (count($value) == 3) {
                $obj->where($value[0], $value[1], $value[2]);
            } else {
                $obj->where($value[0], $value[1]);
            }
        }
        $obj = $obj->first();

        if (!is_null($obj)) {
            $obj->update($data);
        }

        return $obj;
    }

    public function delete($where)
    {
        $obj = Permission::select("*");
        foreach ($where as $value) {
            if (count($value) == 3) {
                $obj->where($value[0], $value[1], $value[2]);
            } else {
                $obj->where($value[0], $value[1]);
            }
        }
        $obj->delete();

        return $obj;
    }

    public function enableDisable($id, $status)
    {
        $obj = Permission::find($id);
        if (!is_null($obj) & in_array($status, [0, 1])) {
            $obj->is_active = $status;
            $obj->save();
        }

        return $obj;
    }

    public function dataTable($with = [], $where = [])
    {
        $obj = Permission::select("*");
        if (count($with) > 0) {
            $obj->with($with);
        }

        foreach ($where as $value) {
            if (count($value) == 3) {
                $obj->where($value[0], $value[1], $value[2]);
            } else {
                $obj->where($value[0], $value[1]);
            }
        }

        return $obj;
    }
}
