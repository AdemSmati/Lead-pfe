<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table="leads";
    public function user()
    {
        if (!$this->user->is_admin) {
            return $this->belongsTo(User::class);
        } else {
            return null;
        }
    }

}
