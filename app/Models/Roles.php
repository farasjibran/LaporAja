<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the user role for the role.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userRole()
    {
        return $this->hasOne(UserRoles::class);
    }
}
