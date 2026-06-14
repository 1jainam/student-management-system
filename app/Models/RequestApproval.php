<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class RequestApproval extends Model {
    use HasFactory;
    protected $table    = 'request_approvals';
    protected $fillable = ['type','requester','department','details','status','date'];
}
