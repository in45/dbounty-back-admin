<?php

namespace App\Models;

use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use SoftDeletes;
    protected $appends = ['is_manager'];
    protected $hidden = ['managers'];

    public function getLogoAttribute($value)
    {
        if(strpos($value,"https")!== false) return $value;
        else return env("APP_URL_UPLOAD").$value;
    }

    public function getIsManagerAttribute()
    {
        //$user = Auth::user();
        $id = '1';
        $managers = $this->managers->pluck('manager_address')->toArray();
        return in_array($id, $managers);
    }
}
