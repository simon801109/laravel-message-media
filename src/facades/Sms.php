<?php
/**
 * Created by PhpStorm.
 * User: wangyucheng
 * Date: 2017/4/28
 * Time: 下午2:29
 */

namespace Simon801109\MessageSms\Facades;

use Illuminate\Support\Facades\Facade;

class Sms extends Facade
{
    protected static function getFacadeAccessor() {
        return 'message-sms';
    }
}