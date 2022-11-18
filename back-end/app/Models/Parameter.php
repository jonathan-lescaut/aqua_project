<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parameter extends Model
{
    use HasFactory;
    protected $fillable = ['c°', 'ph', 'kh', 'gh', 'no2', 'no3', 'project_id'];

    public function projects()
    {
        return $this->belongsTo(Project::class);
    }
}
