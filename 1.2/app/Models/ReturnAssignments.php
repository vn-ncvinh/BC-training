<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnAssignments extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'username',
        'assignmentid',
        'filename',
        'submit_time'
    ];
}
