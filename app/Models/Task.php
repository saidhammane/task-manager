<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $table = 'tasks';
    protected $fillable = [
        'title',
        'description',
        'completed',
    ];

    /**
     * Get the user who owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mark the task as completed.
     */
    public function markAsCompleted()
    {
        $this->update(['completed' => true]);
    }

    /**
     * Scope a query to only include completed tasks.
     */
    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }
}
