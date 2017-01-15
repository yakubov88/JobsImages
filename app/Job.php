<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Upload;

class Job extends Model
{
    protected $table = 'jobs';

    public function image()
    {

        return $this->hasMany('App\Upload','job_id');

    }

}
