<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesses extends Model
{
    use HasFactory;
    protected $table = 'access';
    public $timestamps = false;
    protected $connection = 'sqlite';
    protected $primaryKey = 'api_token';
    public $incrementing = false;
}
