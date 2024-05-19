<?php

namespace App\Models;

<<<<<<< HEAD
// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use Notifiable, HasRoles, HasPanelShield, SoftDeletes;
=======
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
>>>>>>> origin/main

    /**
     * The attributes that are mass assignable.
     *
<<<<<<< HEAD
     * @var array<int, string>
     */

    /*public function assignRole(...$roles): static
    {
        $roles = collect($roles)
            ->flatten()
            ->map(function ($role) {
                if (empty($role)) {
                    return false;
                }

                return $this->getStoredRole($role);
            })
            ->filter(function ($role) {
                return $role instanceof Role;
            })
            ->each(function ($role) {
                $this->ensureModelSharesGuard($role);
            })
            ->map->id
            ->all();

        $model = $this->getModel();
        $model->roles()->sync($roles, false);
        $this->forgetCachedPermissions();

        return $this;
    }*/
=======
     * @var string[]
     */
>>>>>>> origin/main
    protected $fillable = [
        'name',
        'email',
        'password',
<<<<<<< HEAD
        'role_id',
        'user_id',
        'model_type',

    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
=======
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
>>>>>>> origin/main
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

<<<<<<< HEAD

    /*protected static function booted(): void
    {
        static::created(function(User $user){
            $user->assignRole('user');
        });
    }*/

    public function slabs()
    {
        return $this->hasMany(Slab::class);
    }

    /**
     * This function establishes a many-to-many relationship between the User model and the Role model.
     *
     * @return BelongsToMany
     *
     * Role::class is the name of the Role model class,
     * 'model_has_roles' is the name of the intermediate table,
     * 'model_id' is the name of the column in the intermediate table that is related to the User model,
     * 'role_id' is the name of the column in the intermediate table that is related to the Role model.
     */
    public function roles_user(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole(['super_admin', 'admin', 'panel_user']);
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }


=======
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
>>>>>>> origin/main
}
