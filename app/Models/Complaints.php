<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    protected $fillable = ['goverment_id', 'complaint_type', 'description', 'status', 'attachment'];

    public function goverment()
    {
        return $this->belongsTo(Goverments::class);
    }
}
