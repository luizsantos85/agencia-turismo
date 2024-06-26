<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        // 'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function newUser($request)
    {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->password = bcrypt($request->password);
        $this->is_admin = $request->is_admin ? 1 : 0;

        return $this->save();
    }

    public function updateUser($request)
    {
        $this->name = $request->name;
        $this->email = $request->email;

        if($request->password && $request->password != ''){
            $this->password = bcrypt($request->password);
        }

        $this->is_admin = $request->is_admin ? 1 : 0;

        return $this->save();
    }

    public function search($data, $totalPage)
    {
        return $this->where('name', 'like', "%{$data}%")->paginate($totalPage);
    }

    public function reserves()
    {
        return $this->hasMany(Reserve::class, 'user_id');
    }

}
