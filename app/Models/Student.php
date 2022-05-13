<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nim',
        'age',
        'major',
        'address',
        'photo'
    ];

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar != null) :
            return asset($this->avatar);
        else :
            return 'https://ui-avatars.com/api/?name=' . str_replace(' ', '+',
            $this->name) . '&background=4e73df&color=ffffff&size=100';
        endif;
    }
}
