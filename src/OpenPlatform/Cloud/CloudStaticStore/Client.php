<?php
/**
 * This file is part of think-easywechat.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    UCToo<contact@uctoo.com>
 * @copyright UCToo<contact@uctoo.com> UCToo [ Universal Convergence Technology ]
 * @link      http://www.uctoo.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace uctoo\ThinkEasyWeChat\OpenPlatform\Cloud\CloudStaticStore;


use EasyWeChat\Kernel\BaseClient;
use EasyWeChat\Kernel\Exceptions\InvalidConfigException;
use EasyWeChat\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;
use catcher\facade\Http;  //easywechat SDK中没有实现http client put方法，用个catchadmin的类代替

class Client extends BaseClient
{
    /**
     * create static store
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createstaticstore(string $env)
    {
        return $this->httpPostJson('componenttcb/createstaticstore',['env' => $env]);
    }

    /**
     * create static store
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function describestaticstore(string $env)
    {
        return $this->httpPostJson('componenttcb/describestaticstore',['env' => $env]);
    }

    /**
     * create static store
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function staticfilelist(string $env,string $prefix = null, string $delimiter = null,string $marker = null)
    {
        if(isset($env))
        {
            $data['env'] = $env;
        }
        if(isset($prefix))
        {
            $data['prefix'] = $prefix;
        }
        if(isset($delimiter))
        {
            $data['delimiter'] = $delimiter;
        }
        if(isset($marker))
        {
            $data['marker'] = $marker;
        }

        return $this->httpPostJson('componenttcb/staticfilelist',$data);
    }

    /**
     * create static store
     * @doc https://developers.weixin.qq.com/doc/oplatform/Third-party_Platforms/Mini_Programs/cloudbase/batch/staticUploadFile.html  官方文档语焉不详，且看起来是抄了staticfilelist文档内容
     *
     * @return array|Collection|object|ResponseInterface|string    {
    "errcode": 0,
    "errmsg": "ok",
    "signed_url": "https://4f0d-static-weiyohotest-0gfa1ckv386bfde1-1305269106.cos.ap-shanghai.myqcloud.com/zcy.py?sign=q-sign-algorithm%3Dsha1%26q-ak%3DAKIDnLolAQdKkoTypHHbPxiN5IBhVSDB6uGtnLUAbZaNwfwc2HCF6is77McVUs06psK0%26q-sign-time%3D1616814564%3B1616814624%26q-key-time%3D1616814564%3B1616814624%26q-header-list%3D%26q-url-param-list%3D%26q-signature%3Dcec51ad552418c57b8b331a995e92bbc6304297f",
    "token": "nuraf0niXOeUrGe6VrFtNt7ptApNV1Ya67349c8976cc623aca955f0d3f4475059goQ8efjGXgNAU9SC3g4GWs165NBy_hmshkXUmHvG46V4q3j0WQ5TiUxrTJDYDNyGLR30yrT3sxTekbvr6CXCN3AotLBemgWyaQVhNfsTODWb2s3IQar8etUmTG05KbTD2Tw-Jx0p8BGWm-y_ikTJp0Ih8q0Qsta4G2VgdGBgBeI1jMpmWBtovHlrKboR284mS2It0hJuF2Y3dVTgOiL7-gJOx5QvMxfRUg49iW7Tp_ZCjs49nl1nQrdNcvqXGGa6kEDS57UHo8AINDHA5x6dMPr1maYFYqawstkkXNDZLPV3Am40dOkw7kED6FD3NaSg5LVl_4oxUcFVXw-NkgbzzpOMHjWsoqjPuynBN62xXU"
    }
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function staticuploadfile(string $env,string $filename)
    {
        return $this->httpPostJson('componenttcb/staticuploadfile',['env' => $env,'filename'=>$filename]);
    }

    /**
     * @param string $env
     * @param string $filename
     * @param string $file_path
     * @return array
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * <?xml version='1.0' encoding='utf-8' ?>
    <Error>
    <Code>AccessDenied</Code>
    <Message>Request has expired</Message>
    <ServerTime>2021-03-27T03:41:56Z</ServerTime>
    <Resource>4f0d-static-weiyohotest-0gfa1ckv386bfde1-1305269106.cos.ap-shanghai.myqcloud.com/zcy.py</Resource>
    <RequestId>NjA1ZWE5ODRfNjcyZDIyMDlfNGE3NF81ZmU0MTlj</RequestId>
    <TraceId>OGVmYzZiMmQzYjA2OWNhODk0NTRkMTBiOWVmMDAxODc0OWRkZjk0ZDM1NmI1M2E2MTRlY2MzZDhmNmI5MWI1OTQyYWVlY2QwZTk2MDVmZDQ3MmI2Y2I4ZmI5ZmM4ODFjNGRiZmU1OTY0ZWM1NDRlMjRjMzdkMzlkZTJjMzY3ZWY=</TraceId>
    </Error>
     */
    public function uploadFile(string $env,string $filename,string $file_path){
        $res = $this->staticuploadfile($env,$filename);
        if(!$res['errcode']){
            $result = Http::headers(['x-cos-security-token'=>$res['token']])
                ->body(fopen($file_path, 'r'))
                ->put($res['signed_url']);
        }
        return $result;
    }

}