<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     *与模型关联的数据表
     * @var string
     */
    protected $table='address';
    /**
     * 定义表的主键
     * @var string
     */
    protected $primaryKey='address_id';
    /**
     *执行模型是否自动维护时间戳
     * @var bool
     **/
    public $timestamps=true;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    /**
     * 模型中日期字段的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';
}
