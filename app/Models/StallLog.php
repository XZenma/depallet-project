<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StallLog extends Model
{

    protected $table = 'stall_logs';
    protected $primaryKey = 'stall_log_id';
    const UPDATED_AT = NULL;

    protected $fillable = [
        'stall_id',
        'action',
        'old_data',
        'new_data',
    ];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];

    public function stall() {
        return $this->belongsTo(Stall::class, 'stall_id', 'stall_id');
    }

}
