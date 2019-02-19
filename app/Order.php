<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the post that owns the comment.
     */
    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }
    
    public function subcontractor()
    {
        return $this->belongsTo('App\Subcontractor', 'subcontractor_id');
    }
}
