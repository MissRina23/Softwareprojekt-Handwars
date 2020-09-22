<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property  name
 */
class users extends Model
{
    protected $table ='users';
    protected $fillable = array('username');
}
