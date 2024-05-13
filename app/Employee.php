<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    
    /**
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    


    /**
     * @return object
     */
    public function empDepartment(){

        return $this->belongsTo('App\Department','dept_id');
    }

    /**
     * @return object
     */
    public function empDivision(){
        return $this->belongsTo('App\Division','division_id');
    }

    /**
     * @return object
     */
    public function empCountry(){
        return $this->belongsTo('App\Country','country_id');
    }

    /**
     * @return object
     */
    public function empState(){
        return $this->belongsTo('App\State','state_id');
    }

    /**
     * @return object
     */
    public function empCity(){
        return $this->belongsTo('App\City','city_id');
    }

    /**
     * @return object
     */
    public function empSalary(){
        return $this->belongsTo('App\Salary','salary_id');
    }

    /**
     * @return object
     */
    public function empGender(){
        return $this->belongsTo('App\Gender','gender_id');
    }
}
