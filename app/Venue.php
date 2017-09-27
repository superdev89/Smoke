<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [

    	'address',
    	'air_bnb',
    	'close_hours',
    	'description',
    	'id',
    	'isPrivate',
    	'isPublic',
    	'latitude',
    	'longitude',
    	'name',
    	'num_of_seats',
    	'open_hours',
    	'outdoor',
    	'phone',
    	'photos',
    	'registeredOnGoogle',
    	'type',
    	'weblink',
    	'wifi',
    ];
}
