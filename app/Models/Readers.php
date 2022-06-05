<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Readers extends Model
{
    use HasFactory;

    protected $table = 'readers';
    public $timestamps = false;
    protected $connection = 'sqlite';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'reader_role');
    }
}
