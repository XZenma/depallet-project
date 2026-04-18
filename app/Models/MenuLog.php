<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuLog extends Model
{
    protected $table = 'menu_logs';
    protected $primaryKey = 'menu_log_id';
    const UPDATED_AT = NULL;

    protected $fillable = [
        'menu_id',
        'action',
        'old_data',
        'new_data',
    ];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];

    public function menu() {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }
}
