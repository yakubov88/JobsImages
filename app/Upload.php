<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Job;

class Upload extends Model
{
    protected $table = 'upload';

    public function job()
    {
        return $this->belongsTo('App\Job','job_id');
    }
}
