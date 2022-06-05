<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReaderRole extends Model
{
    use HasFactory;
    protected $table = 'reader_role';
    public $timestamps = false;
    protected $connection = 'sqlite';
}
