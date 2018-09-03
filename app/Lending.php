<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    protected $table = 'lending';
    protected $guarded = [];

    public function movie() {
        return $this->belongsTo(Movie::class);
    }

    public function member() {
        return $this->belongsTo(Member::class);
    }
}
