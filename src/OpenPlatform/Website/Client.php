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
namespace uctoo\ThinkEasyWeChat\OpenPlatform\Website;


use EasyWeChat\Kernel\BaseClient;
use EasyWeChat\Kernel\Exceptions\InvalidConfigException;
use EasyWeChat\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{

    /**
     * @param array $query , appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     */
    public function snsAccessToken($query)
    {
        return $this->httpGet('sns/oauth2/access_token', $query);

    }

    /**
     * 检验授权凭证（access_token）是否有效
     * @param string $access_token
     * @param string $openid
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     */
    public function auth($access_token,$openid)
    {
        $query['access_token'] = $access_token;
        $query['openid'] = $openid;
        return $this->httpGet('sns/auth', $query);
    }

    /**
     * 刷新或续期access_token使用
     * @param string $refresh_token
     * @param string $appid
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     */
    public function refresh_token($refresh_token,$appid)
    {
        $query['refresh_token'] = $refresh_token;
        $query['grant_type'] = "refresh_token";
        $query['appid'] = $appid;
        return $this->httpGet('sns/oauth2/refresh_token', $query);
    }

    /**
     * 获取用户个人信息（UnionID机制）
     * @param string $access_token
     * @param string $openid
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     */
    public function userinfo($access_token,$openid)
    {
        $query['access_token'] = $access_token;
        $query['openid'] = $openid;
        return $this->httpGet('sns/userinfo', $query);
    }

}