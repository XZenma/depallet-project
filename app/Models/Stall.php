<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StallAccount;
use App\Models\Menu;
use App\Models\StallLog;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stall extends Model
{
    use HasUuids, SoftDeletes, HasFactory;

    protected $table = 'stalls';
    protected $primaryKey = 'stall_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'owner_name',
        'is_open',
        'stall_account_id',
    ];

    public function stallAccount() {
        return $this->hasOne(StallAccount::class, 'stall_id', 'stall_id');
    }

    public function menus() {
        return $this->hasMany(Menu::class, 'stall_id', 'stall_id');
    }

    public function stallLogs() {
        return $this->hasMany(StallLog::class, 'stall_id', 'stall_id');
    }

    protected static function booted() {
        static::created(function ($stall) {
            StallLog::create([
                'stall_id' => $stall->stall_id,
                'action' => 'created',
                'new_data' => $stall->toJson(),
            ]);
        });

        static::updated(function ($stall) {
            StallLog::create([
                'stall_id' => $stall->stall_id,
                'action' => 'updated',
                'old_data' => json_encode($stall->getOriginal()),
                'new_data' => $stall->toJson(),
            ]);
        });

        static::deleted(function ($stall) {
            StallLog::create([
                'stall_id' => $stall->stall_id,
                'action' => 'deleted',
                'old_data' => $stall->toJson(),
            ]);

            $stall->menus()->delete();
            $stall->stall_account()->delete();
        });
    }
}
