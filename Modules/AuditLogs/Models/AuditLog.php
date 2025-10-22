<?php

namespace Modules\AuditLogs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;


class AuditLog extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'action', 'entity', 'entity_id', 'changes'];

    protected $casts = [
        'changes' => 'array',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function newFactory()
    {
        return \Modules\AuditLogs\Database\factories\AuditLogFactory::new();
    }
}
