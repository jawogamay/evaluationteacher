<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'form_id', 'comment_statement', 'comment_by'
    ];
}
