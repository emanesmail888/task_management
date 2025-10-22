<?php

namespace Modules\Tasks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Tasks\Database\Factories\TaskFactory;

use App\Models\User;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'due_date', 'priority', 'user_id'];

    protected static function newFactory()
    {
        return TaskFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
