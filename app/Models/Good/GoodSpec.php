<?php

namespace App\Models\Good;

use App\Models\Good\GoodCate;
use Illuminate\Database\Eloquent\Model;

class GoodSpec extends Model
{
    // 商品规格表
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'good_spec';

    // 不可以批量赋值的字段，为空则表示都可以
    protected $guarded = [];

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $hidden = [];
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = true;

    // 二级分类
    public function getGoodcateTwoIdAttribute()
    {
        $two_id = GoodCate::where('id',$this->attributes['good_cate_id'])->value('parentid');
        return $two_id;
    }

    // 一级分类
    public function getGoodcateOneIdAttribute()
    {
        $one_id = GoodCate::where('id',$this->attributes['good_cate_id'])->value('arrparentid');
        $one_id = explode(',', $one_id)[1];
        return $one_id;
    }

    // 关联商品分类表
    public function goodcate()
    {
        return $this->belongsTo('\App\Models\Good\GoodCate','good_cate_id','id');
    }

    // 关联商品规格值表
    public function goodspecitem()
    {
        return $this->hasMany('\App\Models\Good\GoodSpecItem','good_spec_id','id');
    }
}
