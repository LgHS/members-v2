<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badges extends Model
{
    use HasFactory;
    protected $table = 'badges';
    public $timestamps = false;
    protected $connection = 'sqlite';
    protected $primaryKey = 'id';
    public $incrementing = true;

}
