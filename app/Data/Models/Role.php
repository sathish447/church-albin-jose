<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'roles';

    protected $fillable = [
        'name', 'is_active'
    ];

    protected $dates = [ 'deleted_at' ];

    protected $casts = [];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class, "role_permission", "role_id", "permission_id");
    }

    // Get Permission List as Array
    public function permissionList()
    {
        return $this->belongsToMany(Permission::class, "role_permission", "role_id", "permission_id")
            ->pluck("permission.id")
            ->toArray();
    }

    // Check individual permission
    public function hasPermission($permission)
    {

        // Show Only Enabled Modules (Its for Production)
        $modules = array_filter(explode(",", conf("enable_modules")));

        // Show All Modules (Its for Development)
//        $modules = array_filter(Permission::all()->pluck('slug')->toArray());

        if(count($modules) > 0) {
            $block = true;
            foreach($modules as $mod) {
                if ($mod == $permission) {
                    $block = false;
                }
            }
            if($block) {
                return false;
            }
        }

        if ($this->id == 12 || $this->id == 13) {
            return true;
        }

        if ($this->permission()->where("slug", $permission)->first()) {
            return true;
        }

        return false;
    }

    // Check any individual permission
    public function hasAnyPermission($permissions)
    {
        // Show Only Enabled Modules
        $modules = array_filter(explode(",", conf("enable_modules")));

        if(count($modules) > 0) {
            $block = true;
            foreach($modules as $mod) {
                if (in_array($mod, $permissions)) {
                    $block = false;
                }
            }
            if($block) {
                return false;
            }
        }

            if ($this->id == 12 || $this->id == 13) {
                return true;
            }

        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }
}
