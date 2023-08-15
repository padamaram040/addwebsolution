<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Support extends Model
{
    use HasFactory;
    protected $table = 'support';
    protected $primaryKey = 'id';
    protected $fillable = ['created_by', 'assigned_to', 'status', 'title', 'description', 'parent_id', 'created_at', 'updated_at'];

    public function createdBy(){
        return $this->belongsTo('App\Models\User','created_by');
    }

    public function assignedTo(){
        return $this->belongsTo('App\Models\User','assigned_to');
    }

    public function createdAt(){
        $date = $this->created_at;
        return $date->format('d-m-Y h:i:s A');
    }

    public function reply(){
        return $this->hasMany('App\Models\Support','parent_id','id');
    }
}
