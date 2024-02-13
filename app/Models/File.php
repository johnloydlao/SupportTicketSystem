<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['ticket_id', 'file_path', 'file_name', 'file_size', 'file_type'];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
