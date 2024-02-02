<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'files', 'priority', 'status'];

    public function scopeFilter($query, array $filters)
    {



        $query->when($filters['status'] ?? false, fn ($query, $status) => $query
            ->where('status', 'like', '%' . $status . '%'));

        $query->when($filters['priority'] ?? false, fn ($query, $priority) => $query
            ->where('priority', 'like', '%' . $priority . '%'));

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas('categories', fn ($subquery) => $subquery->where('name', $category))
        );

        $query->when($filters['search'] ?? false, fn ($query, $search) => $query
            ->where('title', 'like', '%' . $search . '%'));
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }
}
