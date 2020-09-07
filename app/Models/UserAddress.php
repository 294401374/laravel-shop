<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'province',
        'city',
        'district',
        'address',
        'zip',
        'contact_name',
        'contact_phone',
        'last_used_at',
    ];
    
    protected $datas = ['last_used_at'];
    
    /**
     * 关联模型，属于一个用户
     * @return mixed
     */
    public function user()
    {
        $this->belongsTo(User::class);
    }
    
    /**
     * 获取完整地址的访问器
     * 通过$address->full_address获取完整的地址
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    }

}
