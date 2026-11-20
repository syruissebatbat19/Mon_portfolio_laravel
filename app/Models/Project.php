<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ["title", "slug", "summary", "description", "role", "technologies", "github_url", "demo_url", "position"];

    protected $casts = ["technologies" => "array"];
}
