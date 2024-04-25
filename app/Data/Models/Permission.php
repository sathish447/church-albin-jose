<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    //use SoftDeletes;

    protected $table = 'permission';

    protected $fillable = [
        'name', 'slug', 'is_active'
    ];

    //protected $dates = [ 'deleted_at' ];

    protected $casts = [];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, "role_permission", "permission_id", "role_id");
    }
}
