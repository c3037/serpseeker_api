<?php

/**
 * Class Curl.
 * @author https://github.com/c3037
 */
class Curl
{
    /**
     * Отправка одного запроса.
     * @param array $params
     * @param bool $returnResource
     * @return resource|string
     * @throws CurlException
     */
    public function sendOne($params = [], $returnResource = false)
    {
        $paramsDefault = [
            'url'     => '',
            'method'  => 'get',
            'headers' => [],
            'body'    => [],
        ];
        $params = array_merge($paramsDefault, $params);

        $chResource = curl_init();
        curl_setopt($chResource, CURLOPT_USERAGENT, 'CURL API');
        curl_setopt($chResource, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($chResource, CURLOPT_TIMEOUT, 15);
        curl_setopt($chResource, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chResource, CURLOPT_FOLLOWLOCATION, true);

        if (!empty($params['url'])) {
            curl_setopt($chResource, CURLOPT_URL, $params['url']);
        }
        else {
            throw new CurlException('Wrong request url.');
        }

        switch ($params['method']) {
            case 'head':
                curl_setopt($chResource, CURLOPT_NOBODY, true);
                break;
            case 'get':
                break;
            case 'post':
                curl_setopt($chResource, CURLOPT_POST, 1);
                break;
            case 'put':
                curl_setopt($chResource, CURLOPT_CUSTOMREQUEST, 'PUT');
                break;
            case 'delete':
                curl_setopt($chResource, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
            default:
                throw new CurlException('Wrong request method.');
                break;
        }

        if (!empty($params['headers'])) {
            curl_setopt($chResource, CURLOPT_HTTPHEADER, $params['headers']);
        }

        if (!empty($params['body'])) {
            $body = http_build_query($params['body'], '', '&');
            curl_setopt($chResource, CURLOPT_POSTFIELDS, $body);
        }

        if ($returnResource) {
            return $chResource;
        }
        else {
            $content = curl_exec($chResource);
            curl_close($chResource);
            return $content ?: '';
        }
    }

    /**
     * Отправка мультизапроса.
     * @param array $params
     * @return array
     * @throws CurlException
     */
    public function sendMany($params = [])
    {
        if (empty($params)) {
            throw new CurlException('Wrong request params in multi-request.');
        }

        $chResources = [];
        $mh = curl_multi_init();
        foreach ($params as $k => $param) {
            $resource = $this->sendOne($param, true);
            $chResources[$k] = $resource;
            curl_multi_add_handle($mh, $resource);
        }

        $running = 0;
        do {
            curl_multi_exec($mh, $running);
            curl_multi_select($mh);
        } while ($running > 0);

        $result = [];
        foreach ($params as $k => $param) {
            $result[$k] = false;
            if (isset($chResources[$k])) {
                $result[$k] = curl_multi_getcontent($chResources[$k]);
                curl_multi_remove_handle($mh, $chResources[$k]);
                unset($chResources[$k]);
            }
        }
        curl_multi_close($mh);

        return $result;
    }
}

/**
 * Class CurlException.
 */
class CurlException extends \Exception
{
}