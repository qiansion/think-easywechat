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

return [
    //通用错误码
    '100000' =>  '操作无权限',
    '100002' =>  '获取不存在',
    '100003' =>  '更新不存在',
    '100004' =>  '删除不存在',
    '300000' =>  '超过频率限制（绝大多数接口为800/30s，后续可能会变动，请留意该文档）',
    '-30000' =>  '能执行该操作，请检查审核状态后调用正确的接口',
    //商品错误码
    '9401001' =>  '商品已存在',
    '9401002' =>  '商品不存在',
    '9401005' =>  'SKU已存在',
    '9401006' =>  'SKU不存在',
    '9401007' =>  '属性已存在',
    '9401008' =>  '属性不存在',
    '9401020' =>  '参数非法',
    '9401021' =>  '无该商品权限',
    '9401022' =>  'SPU不允许变动',
    '9401023' =>  'SPU不允许编辑',
    '9401024' =>  'SKU不允许变动',
    '9401025' =>  'SKU不允许编辑',
    '100003' =>  '类目已存在',
    '100004' =>  '类目不存在',
    '100009' =>  '添加SPU后再添加SKU失败',
    '100010' =>  '类目和品牌不匹配',
    '108002' =>  '商品状态异常',
    '108003' =>  '锁定库存失败'
];