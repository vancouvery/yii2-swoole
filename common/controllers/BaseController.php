<?php
/**
 * BaseController
 * Log request and response
 * Rewrite the response to special format
 * User: lusc
 * Date: 2016/5/17
 * Time: 14:59
 */

namespace common\controllers;

use swoole\SwooleServer;
use yii\web\Controller;

class BaseController extends Controller
{
    use BaseControllerTrait;
    /**
     * @var boolean whether to enable CSRF validation for the actions in this controller.
     * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
     */
    public $enableCsrfValidation = false;
    /**
     * @var string Content-Type return to client. support: JSON,JSONP,XML,RAW,HTML
     */
    public $outContentType = 'json';
    /**
     * @var float time the action execute begin
     */
    protected $requestBegin = null;
    public function init()
    {
        /**
         * allow cross domain for all api
         */
        if (defined('IN_SWOOLE') && IN_SWOOLE) {
            SwooleServer::$swooleApp->currentSwooleResponse->header('Access-Control-Allow-Origin', '*');
            SwooleServer::$swooleApp->currentSwooleResponse->header('Access-Control-Allow-Credentials', 'true');
        } else {
            header('Access-Control-Allow-Origin:*');
            header('Access-Control-Allow-Credentials:true');
        }
        parent::init(); // TODO: Change the autogenerated stub
    }
}
