<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function proposal() 
    {
        return $this->hasMany('App\Proposal');
    }
}
