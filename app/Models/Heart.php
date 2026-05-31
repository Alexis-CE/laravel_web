<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Heart extends Model
{
    protected $fillable = [
        'user_id',
        'heartable_id',
        'heartable_type',
    ];
}
