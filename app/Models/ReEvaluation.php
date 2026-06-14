<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ReEvaluation extends Model {
    use HasFactory;
    protected $table    = 're_evaluations';
    protected $fillable = ['student','subject','exam','current_marks','revised_marks','status','applied_on'];
}
