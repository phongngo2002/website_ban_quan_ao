<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'id',
        'address',
        'avatar',
        'role_id'
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

    public function loadListWithPagers($prams = [])
    {
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->orderBy('id','desc')
            ->where('status','=',0)
            ->paginate(10);

        return $query;
    }

    public function saveCreate($prams, $img_name)
    {
        $data = array_merge($prams['cols'], [
            'avatar' => $img_name,
            'password' => Hash::make($prams['cols']['password']),
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);

        $res = DB::table($this->table)->insertGetId($data);

        return $res;
    }

    public function getUser($id){
        $res = DB::table($this->table)->where('id','=',$id)->first();

        return $res;
    }
    public function saveUpdate($params){
        if(empty($params['cols']['id'])){
            Session::flash('error','Không xác định bản ghi cần cập nhật');

            return null;
        }
        $dataUpdate = [];

        foreach ($params['cols'] as $colName => $val){
            if ($colName == 'id'){
                continue;
            }
            if (in_array($colName,$this->fillable)){
                $dataUpdate[$colName] = (strlen($val) == 0) ? null : $val;
            }
        };
        $res = DB::table($this->table)
            ->where('id',$params['cols']['id'])
            ->update($dataUpdate);

        return $res;
    }

    public function remove($id){
        $res = DB::table($this->table)->where('id',$id)->update(['status' => 1]);

        return $res;
    }
}
