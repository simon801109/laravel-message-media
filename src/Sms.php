<?php
/**
 * Created by PhpStorm.
 * User: wangyucheng
 * Date: 2017/4/28
 * Time: 下午2:26
 */

namespace Simon801109\MessageSms;


class Sms
{
    protected $user_name;
    protected $password;
    protected $encoding;

    const SMS_URL = "http://api.message.net.tw/send.php";

    public function __construct()
    {
        $config = config('sms');
        $this->user_name = $config['user_name'];
        $this->password = $config['password'];
        $this->encoding = $config['encoding'];
    }
    /**
     * 寄送簡訊
     *
     * @param Number|String $phone
     * @param String $content
     * @param Integer $type
     * @return String
     *
     */
    public function send($phone,$content,$type = 0)
    {
        $message = [
            'longsms'   => $type,
            'id'        => $this->user_name,
            'password'  => $this->password,
            'tel'       => $this->arrayToString($phone),
            'msg'       => $content,
            'mtype'     => 'G',
            'encoding'  => $this->encoding
        ];
        $result = $this->postForm($message);

        return $result;
    }
    /**
     * 判斷傳入電話號碼為字串或陣列，傳回字串
     *
     * @param Number|String $number
     * @return String
     *
     */
    public function arrayToString($number)
    {
        $number_str = '';
        if(is_array($number)){
            foreach ($number as $value){
                $number_str .= $value.";";
            }
        }else{
            $number_str = $number;
        }
        return $number_str;
    }
    /**
     * 將表單post出，回傳結果
     *
     * @param array $message
     * @return String
     *
     */
    public function postForm(array $message)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::SMS_URL);
        curl_setopt($ch, CURLOPT_POST, true); // 啟用POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $message ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}