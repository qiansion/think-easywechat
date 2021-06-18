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

namespace uctoo\ThinkEasyWeChat\MiniShop\Base;


use EasyWeChat\Kernel\BaseClient;
use EasyWeChat\Kernel\Exceptions\InvalidConfigException;
use EasyWeChat\Kernel\Support\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client. 标准版交易组件及开放接口
 *
 * @author UCToo <contact@uctoo.com>
 */
class Client extends BaseClient
{
    /**
     * product category  获取类目详情
     *
     * @param int $f_cat_id
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productCategoryGet(int $f_cat_id = 0)
    {
        return $this->httpPostJson('product/category/get', ['f_cat_id' => $f_cat_id]);
    }

    /**
     * product brand 获取品牌列表
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productBrandGet()
    {
        return $this->httpPostJson('product/brand/get');
    }

    /**
     * get_freight_template 获取运费模板
     *
     * @param int $job_id
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFreightTemplate(){
        return $this->httpPostJson('product/delivery/get_freight_template');
    }

    /**
     * get shopcat 获取店铺的商品分类
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getShopcat()
    {
        return $this->httpPostJson('product/store/get_shopcat');
    }

    /**
     * product spu add
     *
     * @param array $spu_data
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSpuAdd(array $spu_data)
    {
        return $this->httpPostJson('product/spu/add',$spu_data);
    }

    /**
     * product spu del
     *
     * @param int  $product_id
     * @param string $out_product_id
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSpuDel(int $product_id = 0, string $out_product_id = '')
    {
        $param = [];
        if( 0 != $product_id){
            $param['product_id'] = $product_id;
        }
        if( '' != $out_product_id){
            $param['out_product_id'] = $out_product_id;
        }

        return $this->httpPostJson('product/spu/del',$param);
    }

    /**
     * product spu get
     *
     * @param int  $product_id
     * @param string $out_product_id
     * @param int  $need_edit_spu
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSpuGet(array $body)
    {
        $param = [];
        if( isset($body['product_id'])){
            $param['product_id'] = $body['product_id'];
        }
        if( isset($body['out_product_id'])){
            $param['out_product_id'] = $body['out_product_id'];
        }
        if( isset($body['need_edit_spu'])){
            $param['need_edit_spu'] = $body['need_edit_spu'];
        }else{
            $param['need_edit_spu'] = 0;
        }

        return $this->httpPostJson('product/spu/get',$param);
    }

    /**
     * product spu get_list
     *
     * @param int $status
     * @param int $page
     * @param int $page_size
     * @param int $need_edit_spu
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSpuGetlist(array $body)
    {
        $param['status'] = 0;
        $param['page'] = 1;
        $param['page_size'] = 10;
        $param['need_edit_spu'] = 0;

        if( isset($body['status'])){
            $param['status'] = $body['status'];
        }
        if( isset($body['page'])){
            $param['page'] = $body['page'];
        }
        if( isset($body['page_size'])){
            $param['page_size'] = $body['page_size'];
        }
        if( isset($body['need_edit_spu'])){
            $param['need_edit_spu'] = $body['need_edit_spu'];
        }

        $res = $this->httpPostJson('product/spu/get_list',$param);
        return $res;
    }

    /**
     * product spu search
     *
     * @param string $keyword
     * @param int $page
     * @param int $page_size
     * @param int $source
     * @param int $status
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSpuSearch(array $body)
    {
        $param['status'] = 5;
        $param['page'] = 1;
        $param['page_size'] = 10;
        $param['source'] = 1;

        if( isset($body['keyword'])){
            $param['keyword'] = $body['keyword'];
        }
        if( isset($body['status'])){
            $param['status'] = $body['status'];
        }
        if( isset($body['page'])){
            $param['page'] = $body['page'];
        }
        if( isset($body['page_size'])){
            $param['page_size'] = $body['page_size'];
        }
        if( isset($body['source'])){
            $param['source'] = $body['source'];
        }
        $res = $this->httpPostJson('product/spu/search',$param);
        return $res;
    }

    /**
     * product spu update
     *
     * @param array $spu_data
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSpuUpdate(array $spu_data)
    {
        return $this->httpPostJson('product/spu/update',$spu_data);
    }

    /**
     * product spu listing
     *
     * @param int  $product_id
     * @param string $out_product_id
     * @param int  $need_edit_spu
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSpuListing(array $body)
    {
        $param = [];
        if( isset($body['product_id'])){
            $param['product_id'] = $body['product_id'];
        }
        if( isset($body['out_product_id'])){
            $param['out_product_id'] = $body['out_product_id'];
        }

        return $this->httpPostJson('product/spu/listing',$param);
    }

    /**
     * product spu delisting
     *
     * @param int  $product_id
     * @param string $out_product_id
     * @param int  $need_edit_spu
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSpuDelisting(array $body)
    {
        $param = [];
        if( isset($body['product_id'])){
            $param['product_id'] = $body['product_id'];
        }
        if( isset($body['out_product_id'])){
            $param['out_product_id'] = $body['out_product_id'];
        }

        return $this->httpPostJson('product/spu/delisting',$param);
    }

    /**
     * todo: product/limiteddiscount/add       product/limiteddiscount/get_list       product/limiteddiscount/update_status
     *
     */

    /**
     * product sku add
     *
     * @param array $sku_data
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSkuAdd(array $sku_data)
    {
        return $this->httpPostJson('product/sku/add',$sku_data);
    }

    /**
     * todo: product/sku/batch_add
     *
     */

    /**
     * product sku del
     *
     * @param int  $product_id
     * @param string $out_product_id
     * @param int  $sku_id
     * @param string $out_sku_id
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSkuDel(int $product_id = 0, string $out_product_id = '',int $sku_id = 0, string $out_sku_id = '')
    {
        $param = [];
        if( 0 != $product_id){
            $param['product_id'] = $product_id;
        }
        if( '' != $out_product_id){
            $param['out_product_id'] = $out_product_id;
        }
        if( 0 != $sku_id){
            $param['sku_id'] = $sku_id;
        }
        if( '' != $out_sku_id){
            $param['out_sku_id'] = $out_sku_id;
        }
        return $this->httpPostJson('product/sku/del',$param);
    }

    /**
     * product sku get
     *
     * @param int  $sku_id
     * @param string $out_sku_id
     * @param int  $need_real_stock
     * @param int  $need_edit_sku
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSkuGet(int $sku_id = 0, string $out_sku_id = '',int $need_real_stock = 0,int $need_edit_sku = 0)
    {
        $param = [];
        if( 0 != $sku_id){
            $param['sku_id'] = $sku_id;
        }
        if( '' != $out_sku_id){
            $param['out_sku_id'] = $out_sku_id;
        }
        $param['need_real_stock'] = $need_real_stock;
        $param['need_edit_sku'] = $need_edit_sku;

        return $this->httpPostJson('product/sku/get',$param);
    }

    /**
     * product sku get_list
     *
     * @param int $product_id  33541981
     * @param int $need_real_stock
     * @param int $need_edit_sku
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSkuGetlist(int $product_id = 0,int $need_real_stock = 0,int $need_edit_sku = 0)
    {
        $param['product_id'] = $product_id;
        $param['need_real_stock'] = $need_real_stock;
        $param['need_edit_sku'] = $need_edit_sku;

        return $this->httpPostJson('product/sku/get_list',$param);
    }

    /**
     * product sku update
     *
     * @param array $sku_data
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productSkuUpdate(array $sku_data)
    {
        return $this->httpPostJson('product/sku/update',$sku_data);
    }

    /**
 * product sku update_price
 *
 * @param array $sku_price
 * @return array|Collection|object|ResponseInterface|string
 * @throws InvalidConfigException
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
    public function productSkuUpdateprice(array $sku_price)
    {
        return $this->httpPostJson('product/sku/update_price',$sku_price);
    }

    /**
     * product stock update
     *
     * @param array $stock_data
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productStockUpdate(array $stock_data)
    {
        return $this->httpPostJson('product/stock/update',$stock_data);
    }

    /**
     * product stock get
     *
     * @param array $stock_data
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productStockGet(array $stock_data)
    {
        return $this->httpPostJson('product/stock/get',$stock_data);
    }

    /**
     * product order get_list
     *
     * @param array $order_data
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productOrderGetlist(array $order_data)
    {
        return $this->httpPostJson('product/order/get_list',$order_data);
    }

    /**
     * product order get
     *
     * @param array $order_id
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productOrderGet(int $order_id)
    {
        $param['order_id'] = $order_id;
        return $this->httpPostJson('product/order/get',$param);
    }

    /**
     * product order search
     *
     * @param array $order_data
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productOrderSearch(array $order_data)
    {
        return $this->httpPostJson('product/order/search',$order_data);
    }

    /**
     * product delivery get_company_list
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productDeliveryGetcompanylist()
    {
        return $this->httpPostJson('product/delivery/get_company_list');
    }

    /**
     * product delivery send
     *
     * @param array $order_data
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productDeliverySend(array $order_data)
    {
        return $this->httpPostJson('product/delivery/send',$order_data);
    }

    /**
     * 优惠券相关接口
     * todo: product/coupon/create  product/coupon/update   product/coupon/update_status   product/coupon/get   product/coupon/get_list   product/coupon/push
     *
     */


    /**
     * product store get_info
     *
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function productStoreGetinfo()
    {
        return $this->httpPostJson('product/store/get_info');
    }
}