<?php

namespace App\Models;

use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderScope('created_at', 'desc'));

    }
    public function managers()
    {
        return $this->hasMany('App\Models\CompanyManager','company_id','id');
    }
     public function programs()
    {
        return $this->hasMany('App\Models\Program','company_id','id');
    }

 
    protected $hidden = ['managers','programs', 'alpha_code','beta_code'];




   
}
