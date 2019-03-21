<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     *与模型关联的数据表
     * @var string
     */
    protected $table='category';
    /**
     * 定义表的主键
     * @var string
     */
    protected $primaryKey='cate_id';
    /**
     *执行模型是否自动维护时间戳
     * @var bool
     **/
    public $timestamps=false;
}
