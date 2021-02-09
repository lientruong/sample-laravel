<?php

namespace App\Models\Tenant;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = 'orders';

    protected $fillable = ['document_code'];

    public function getCreatedAtAttribute($val)  {
        return (new Carbon($val))->format("M d, Y h:i:s a");
    }
}