<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectWishlists extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_project_wishlist';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true; // Since you're using an id column

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'project_id'
    ];

    /**
     * Get the student that owns the wishlist item.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the project that owns the wishlist item.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}