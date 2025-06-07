<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectWishlists;

class Project extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project'; // Since your table name is 'announcement' (singular)

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
        'description'
    ];

    public function wishingStudents()
    {
        return $this->belongsToMany(Student::class, 'student_project_wishlist')
            ->using(ProjectWishlists::class);
    }
}
