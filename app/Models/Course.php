<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Course extends Model {
    use HasFactory;
    protected $fillable = ['name','code','duration','seats','enrolled','faculty'];
    public function admissions() { return $this->hasMany(Admission::class,'course','name'); }
}
