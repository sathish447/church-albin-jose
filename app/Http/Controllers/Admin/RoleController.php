<?php

namespace App\Http\Controllers\Admin;

use DataTables;

use App\Http\Controllers\Controller;

use App\Data\Repositories\Role\RoleRepository;
use App\Data\Repositories\Permission\PermissionRepository;
use App\Http\Requests\Admin\RoleRequest;

class RoleController extends Controller
{
    private static $RoleRepository;
    private static $PermissionRepository;

    public function __construct(RoleRepository $RoleRepository, PermissionRepository $PermissionRepository)
    {
        self::$RoleRepository = $RoleRepository;
        self::$PermissionRepository = $PermissionRepository;
    }

    public function index()
    {
        $active = "role";
        $active_sub = "";

        return view('role.index')
            ->with("active", $active)
            ->with("active_sub", $active_sub);
    }

    public function result()
    {
        $results = self::$RoleRepository->dataTable([], []);

        return DataTables::of($results)
            ->addColumn('action', function ($result) {
                $buttons = [
                    "edit" => route('role.create.update', [$result->id]),
                    "status" => [
                        "id" => $result->id,
                        "status" => $result->is_active,
                        "datatable_id" => "datatable",
                    ],
                    // "delete" => [
                    //     "id" => $result->id,
                    //     "datatable_id" => "datatable",
                    // ],
                ];
                return actionButtons($buttons);
            })
            ->addIndexColumn()
            ->escapeColumns([])
            ->setRowId('id')
            ->make(true);
    }


    public function createUpdate($id = 0)
    {
        $active = "role";
        $active_sub = "";
        $permissions_selected = [];

        if ($id==0) {
            $obj = self::$RoleRepository->getDummy();
        } else {
            $obj = self::$RoleRepository->all([
                ["id",$id]
            ]);
            if (is_null($obj)) {
                return redirect()->route('role.index')->with('error', returnMsg('404'));
            }
            $permissions_selected = $obj->permissionList();
        }
        $permissions = self::$PermissionRepository->all([
            ["is_active", 1]
        ], false);

        return view('role.createUpdate')
            ->with("obj", $obj)
            ->with("permissions_selected", $permissions_selected)
            ->with("permissions", $permissions)
            ->with("active", $active)
            ->with("active_sub", $active_sub);
    }
    public function createUpdatePost(RoleRequest $request)
    {
        $data = $request->all();
        $obj = null;
        if ($data["id"] !=0) {
            $obj = self::$RoleRepository->all([
                ["id",$data["id"]]
            ]);
            if (is_null($obj)) {
                return redirect()->route('role.index')->with('error', returnMsg('404'));
            }
        }
        if (is_null($obj)) {
            $res = self::$RoleRepository->create($data);
            if (count($data['permissions']) !=0) {
                $res->permission()->sync($data['permissions']);
            }
            return redirect()->route('role.create.update', [$res->id])->with('success', returnMsg('201'));
        } else {
            $res = self::$RoleRepository->update($data, [["id", $obj->id]]);
            if (count($data['permissions']) !=0) {
                $res->permission()->sync($data['permissions']);
            }
            return redirect()->route('role.create.update', [$obj->id])->with('success', returnMsg());
        }
    }

    public function action($id, $status)
    {
        $id = clean($id);
        $status = clean($status);

        if (in_array($status, [0,1])) {
            self::$RoleRepository->enableDisable($id, $status);
        } elseif (in_array($status, [2])) {
            self::$RoleRepository->delete([["id", $id]]);
        }

        return json_encode(['response' => 'success', 'message' =>  returnMsg()]);
    }
}
