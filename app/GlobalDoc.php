<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalDoc extends Model
{
    protected $fillable = [
        'document_name', 
    ];

    public $timestamp = true;
    protected  $table = 'global_documents';
}
