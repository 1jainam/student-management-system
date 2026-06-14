<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Admission extends Model {
    use HasFactory;
    protected $fillable = ['name','email','course','batch','status','applied_on'];
}
