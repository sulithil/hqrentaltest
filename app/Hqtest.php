<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hqtest extends Model
{
    protected $table = 'messages';

    protected $primaryKey = 'idmessage';

    public $timestamps=false;

    protected $fillable =[
    	'idmessage',
    	'subject',
    	'message'
    ];
}
