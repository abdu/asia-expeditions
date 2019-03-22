<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentEmail extends Model
{
    //
    protected $table = 'tbl_sent_email';

    public function user()
    {
        return $this->belongsTo(Admin::class);
    }
}
