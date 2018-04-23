<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public function givePermission($permission_id)
    {
        $permission = Permission::find($permission_id);

        $this->permissions()->attach($permission);

        return $this;
    }

    public function withdrawPermission($permission_id)
    {
        $permission = Permission::find($permission_id);

        $this->permissions()->detach($permission);

        return $this;
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }
}
