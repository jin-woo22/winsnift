<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable , InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'sex',
        'birth_date',
        'address',
        'contact',
        'email',
        'password',
        'verification_token',
        'is_activated',
        'email_verified_at',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // ==============================Relationship==================================================

    public function avatar()
    {
        return $this->hasOne(Media::class, 'model_id', 'id');
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }


    // ============================== Accessor & Mutator ==========================================

    public function getAvatarProfileAttribute()
    {
        return optional($this->getFirstMedia('avatar_image'))->getUrl('avatar');
    }
    
    public function getAvatarThumbnailAttribute()
    {
        return optional($this->getFirstMedia('avatar_image'))->getUrl('thumbnail');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    // ========================== Custom Methods ======================================================

    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('avatar')
        ->width(300)
        ->nonQueued();

        $this->addMediaConversion('thumbnail')
        ->width(120)
        ->nonQueued();
    }

    public function hasRole($role) {
        return $this->role()->where('name', $role)->first() ? true : false;
    }


    // ========================== Scope ======================================================

    public function scopeByRole($query, $role)
    {
        return $query->whereRelation('role', 'name', $role);
    }

    public function scopeActive($query)
    {
        return $query->where('is_activated', true);
    }
    
    public function scopeInactive($query)
    {
        return $query->where('is_activated', false);
    }

    public function scopeNotAdmin($query)
    {
        return $query->where('role_id', '!=', Role::ADMIN);
    }

}