<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birth',
        'address',
        'cp',
        'city',
        'phone',
        'situation',
        'job',
        'has_children',
        'wants_info',
        'img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected function setPassword($user)
    {
        if (!empty($user['password'])) {
            $user['password'] = bcrypt($user['password']);
        }

        return $user;
    }

    /**
    * Get user roles lists.
    *
    * @param array $roles
    */
    public function getUserRolesLists()
    {
        return $this->roles()->pluck('roles.id')->all();
    }

    /**
     * The roles that belong to the user.
     *
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }


    public function schools()
    {
        return $this->belongsToMany('App\School')->withTimestamps();
    }
    public function promotions()
    {
        return $this->belongsToMany('App\Promotion')->withTimestamps();
    }
    public function pictures()
    {
        return $this->belongsToMany('App\Picture')->withTimestamps();
    }
    public function notifications()
    {
        return $this->belongsToMany('App\Notification')->withTimestamps()->withPivot('seen');
    }
        
    public function studies()
    {
        return $this->hasMany('App\Study');
    }






    /**
     * Returns the model singular table name.
     *
     * @return string
     */
    public function getSingularTableName()
    {
        return str_singular($this->getTableName());
    }

    /**
     * Returns model table name.
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->getTable();
    }

    /**
     * Returns the model name.
     *
     * @return string
     */
    public function getModelName()
    {
        $reflect = new ReflectionClass($this);
        return $reflect->getShortName();
    }

    /**
     * Returns the controller name.
     *
     * @return string
     */
    public function getControllerName()
    {
        return $this->getModelName() . "Controller";
    }

    public function medias()
    {
        return $this->morphToMany('App\MediaOriginal', 'mediable');
    }

    


   
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function hasRoleId($roleID)
    {
        if ($this->roles()->where('roles.id', $roleID)->first()) {
            return true;
        }
        return false;
    }





}
