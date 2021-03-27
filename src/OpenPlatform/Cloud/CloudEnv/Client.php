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

namespace uctoo\ThinkEasyWeChat\OpenPlatform\Cloud\CloudEnv;

use EasyWeChat\Kernel\BaseClient;
use EasyWeChat\Kernel\Exceptions\InvalidConfigException;
use EasyWeChat\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;
use think\facade\Log;

class Client extends BaseClient
{
    /**
     * 获取环境列表
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function describeenvs()
    {
        return $this->httpPostJson('componenttcb/describeenvs');
    }

    /**
     * Create a cloud environment
     *
     * @param string $alias  环境别名，要以a-z开头，不能包含 a-zA-z0-9- 以外的字符
     * @return array|Collection|object|ResponseInterface|string 
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createenv(string $alias)
    {
        return $this->httpPostJson('componenttcb/createenv', ['alias' => $alias]);
    }

    /**
     * 使用腾讯云环境  通过本接口可以将腾讯云控制台创建的环境变更为微信小程序的环境。
     *
     * @param string $env
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function modifyenv(string $env = null)
    {
        return $this->httpPostJson('tcb/modifyenv', ['env' => $env]);
    }

    /**
     * 批量绑定小程序和环境  通过本接口可以批量绑定小程序和环境，使用过程中如遇到问题
     *
     * @param string $env
     * @param array $appids
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function batchshareenv(array $data)
    {
        return $this->httpPostJson('componenttcb/batchshareenv', ['data' => $data]);
    }

    /**
     * 批量查询小程序绑定的环境id
     *
     * @param array $appids
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function batchgetenvid(array $appids)
    {
        return $this->httpPostJson('componenttcb/batchgetenvid', ['appids' => $appids]);
    }
}