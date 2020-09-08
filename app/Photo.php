<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    //
    protected $table = 'pictures';

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

}
