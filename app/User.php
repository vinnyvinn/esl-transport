<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    // protected $dateFormat = 'Y-m-d H:i:s';
    use Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','fname','lname','department_id','role_id','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function remarks(){
        return $this->hasMany(Remarks::class,'user_id','id');
    }

    public function funds(){
        return $this->hasMany(Funds::class,'employee_id','id');
    }

    public function purchaseOrder(){
        return $this->hasMany(PurchaseOrder::class,'user_id','id');
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id','id');
    }
}
