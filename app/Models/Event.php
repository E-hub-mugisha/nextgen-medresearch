<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title','description','category_id','trainer','start_date','end_date',
        'location','capacity','banner','registration_link','status','publish_at'
    ];

    protected $dates = ['start_date','end_date','publish_at'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
