<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'login',
        'password',
        'role',
        'api_token',
        'employee_id',
    ];


    protected $primaryKey = 'users_id';


    public function findIdentity(int $id)
    {
        return self::where('users_id', $id)->first();
    }

    public function getId(): int
    {
        return $this->users_id;
    }


    public function attemptIdentity(array $credentials)
    {

        if (empty($credentials['login']) || empty($credentials['password'])) {
            return null;
        }

        return self::where([
            'login' => $credentials['login'],
            'password' => md5($credentials['password'])
        ])->first();
    }
}