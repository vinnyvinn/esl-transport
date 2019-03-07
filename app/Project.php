<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'Project';
    protected $connection = 'sqlsrv2';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $primaryKey = 'DCLink';
    public $timestamps = false;

    protected $fillable = ['ProjectName','ProjectCode','ActiveProject','MasterSubProject','Description','ProjectLevel','SubProjectOfLink','Project_iBranchId'];

    public function billOfLanding(){
        return $this->hasOne(BillOfLanding::class,'project_id','id');
    }
}
