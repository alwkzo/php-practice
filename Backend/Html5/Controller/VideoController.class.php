<?php
namespace Html5\Controller;

use Think\Controller;

class VideoController extends Controller
{
    public function VideoTest()
    {
        $this->display();
    }

    // 获取一个签名Token
    public function getSign()
    {
        echo '111111111';
        var_dump($_SERVER['REMOTE_ADDR']);
        $this->display();
    }

    // 获取一个签名Token
    public function Sign()
    {
        $openId = 'ojMruvwwF-GoBK3_Qr4WEbzM1SCw';
        $userId = 420;
        $key = 'ford4s.amailive.com'; // 公钥
        $sign = md5($openId.$userId.$key);
        var_dump($sign);
        $response = [
            'statusCode' => 200,
            'openId' => $openId,
            'userId' => $userId,
            'sign' => $sign
        ];
        $this->ajaxReturn($response, 'JSON');
    }

    /**
     * tokenSecret
     * 顺序:MD5(KEY+ streamId + txTime)
     * @param string $username
     * @param string $password
     * @return string
     */
    public function tokenUrl()
    {
        $deviceId = '100022';
        $userName = 'test1';
        $userId = '11';
        $currentTime = '2016-07-29 11:13:45';
        $expireTime = '300';
        $streamId = $deviceId.$userName.$userId;
        $tokenTime = $this->getTokenTime($currentTime,$expireTime);
        $tokenSecret = $this->getTokenSecret($tokenTime,$streamId,$currentTime,$expireTime);
        $originalUrl= 'rtmp://120.26.206.180/live';
        $tokenUrl = $deviceId.'_'.$userName.$userId."?tokenSecret=$tokenSecret&tokenTime=$tokenTime";
        $allUrl = $originalUrl.'/'.$tokenUrl;
        return $tokenUrl;
    }

    /**
     * tokenSecret
     * 顺序:MD5(KEY+ streamId + txTime)
     * @param int $streamId
     * @param string $currentTime
     * @param string $expireTime
     * @return string
     */
    public function getTokenSecret($tokenTime,$streamId,$currentTime,$expireTime)
    {
        $KEY = '8935737e61b6fdd586cdab3b1';
        $tokenSecret = md5($KEY . $streamId . $tokenTime);
        return $tokenSecret;
    }

    /**
     * tokenTime
     * $currentTime :开始时间
     */
    public function getTokenTime()
    {
//        $tokenTime = dechex(strtotime($currentTime)+$expireTime);
        $time = '57EDD67E';
        $new = hexdec($time);
        $current = time();
        if(time() > hexdec($time)){
            echo 'expires';
        }else{
            echo 'yes';
        }
        var_dump($new);
        var_dump($current);
        die;
        return strtoupper($tokenTime);
    }


}