<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    /**
     *与模型关联的数据表
     * @var string
     */
    protected $table='goods';
    /**
     * 定义表的主键
     * @var string
     */
    protected $primaryKey='goods_id';
    /**
     *执行模型是否自动维护时间戳
     * @var bool
     **/
    public $timestamps=false;
}
