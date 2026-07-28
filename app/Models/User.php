<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Database\Factories\UserFactory;
use App\Models\Connection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image_url',
        'company',
        'headline',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
public function posts(){
    return $this->hasMany(post::class);
}
public function likes(){
    return $this->hasMany(like::class);
}
public function connections(){
    return $this->hasMany(Connection::class);
}


 public function comments(){
        return $this->hasMany(comment::class);
    }
 public function saves(){
        return $this->hasMany(save::class);
    }

 public function republiers(){
        return $this->hasMany(Republier::class);
    }

protected function avatarUrl(): Attribute{
    return Attribute::make(
        get: function(){
            if($this->image_url){
                return $this->image_url;
            }
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random&color=fff';
        }
    );
}

  public function connectionStatus($otherUserId)
    {
        $connection = Connection::where(function($query) use ($otherUserId) {
            $query->where('user_id', $this->id)
                  ->where('connected_user_id', $otherUserId);
        })->orWhere(function($query) use ($otherUserId) {
            $query->where('user_id', $otherUserId)
                  ->where('connected_user_id', $this->id);
        })->first();

        if (!$connection) {
            return null;
        }

        return [
            'id' => $connection->id,
            'status' => $connection->status,
            'sender_id' => $connection->user_id,
        ];
    }

    public function getConnectionsCountAttribute()
    {
        return Connection::where('status', 'accepted')
            ->where(function($q) {
                $q->where('user_id', $this->id)
                  ->orWhere('connected_user_id', $this->id);
            })->count();
    }
public function getSavesCountAttribute()
{
  return    DB::table('republiers')
            ->where('reposted_by', $this->id)
            ->count();
}

}
