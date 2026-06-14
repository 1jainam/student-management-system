<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class RPLCase extends Model {
    use HasFactory;
    protected $table    = 'rpl_cases';
    protected $fillable = ['student','course','credits_applied','credits_approved','status','date'];
}
