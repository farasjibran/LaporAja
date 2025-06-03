<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Complaints;

class Goverments extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'user_id'];

    /**
     * Get the user for the goverment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the complaints for the goverment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complaints()
    {
        return $this->hasMany(Complaints::class);
    }
}
