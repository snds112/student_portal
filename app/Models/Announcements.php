<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'announcement'; // Since your table name is 'announcement' (singular)

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id'; // This is default, so optional to include

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'dept'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'dept' => 'string', // Optional, but can be useful
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // If you want to define the possible department values
    public const DEPARTMENTS = [
        'general' => 'General',
        'computer_science' => 'Computer Science',
        'maths' => 'Mathematics',
        'physics' => 'Physics',
        'chemistry' => 'Chemistry'
    ];

    /**
     * Get the human-readable department name
     *
     * @return string
     */
    public function getDepartmentNameAttribute()
    {
        return self::DEPARTMENTS[$this->dept] ?? $this->dept;
    }
}