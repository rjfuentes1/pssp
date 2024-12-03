<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Scholar extends Model
{
    use HasFactory;

    protected $fillable = ['lastname', 'firstname', 'middlename', 'suffix', 'sex', 'birthdate', 'province', 'muncity', 'address', 'email_address', 'contact_number'];

    public function education(): HasOne
    {
        return $this->hasOne(Education::class);
    }

    public function returnofservice(): HasOne
    {
        return $this->hasOne(ReturnOfService::class);
    }
    
    public function getFullNameAttribute()
    {
        $middlename = Str::substr($this->middlename, 0, 1);
        return "{$this->lastname}, {$this->firstname} {$middlename}. {$this->suffix}";
    }
}
