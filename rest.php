<?php

require_once 'curl.php';

/**
 * Class Rest.
 * @author https://github.com/c3037
 */
class Rest
{
    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var string
     */
    private $authToken;

    /**
     * Rest constructor.
     */
    public function __construct()
    {
        $this->curl = new Curl();
    }

    /**
     * @param string $authToken
     * @return $this
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * @param string $url
     * @return string
     */
    public function sendGet($url = "")
    {
        $headers = [];
        if ($this->authToken) {
            $headers[] = 'Authorization: Token ' . $this->authToken;
        }
        return $this->curl->sendOne([
            'url'     => $url,
            'method'  => 'get',
            'headers' => $headers,
        ]);
    }

    /**
     * @param string $url
     * @param array $body
     * @return string
     */
    public function sendPost($url = "", $body = [])
    {
        $headers = [];
        if ($this->authToken) {
            $headers[] = 'Authorization: Token ' . $this->authToken;
        }
        return $this->curl->sendOne([
            'url'     => $url,
            'method'  => 'post',
            'headers' => $headers,
            'body'    => $body,
        ]);
    }

    /**
     * @param string $url
     * @param array $body
     * @return string
     */
    public function sendPut($url = "", $body = [])
    {
        $headers = [];
        if ($this->authToken) {
            $headers[] = 'Authorization: Token ' . $this->authToken;
        }
        return $this->curl->sendOne([
            'url'     => $url,
            'method'  => 'put',
            'headers' => $headers,
            'body'    => $body,
        ]);
    }

    /**
     * @param string $url
     * @return string
     */
    public function sendDelete($url = "")
    {
        $headers = [];
        if ($this->authToken) {
            $headers[] = 'Authorization: Token ' . $this->authToken;
        }
        return $this->curl->sendOne([
            'url'     => $url,
            'method'  => 'delete',
            'headers' => $headers,
        ]);
    }

    /**
     * @param array $urls
     * @return array
     */
    public function sendMultiGet($urls = [])
    {
        $params = [];
        $headers = [];
        if ($this->authToken) {
            $headers[] = 'Authorization: Token ' . $this->authToken;
        }
        foreach ($urls as $url) {
            $params[] = [
                'url'     => $url,
                'method'  => 'get',
                'headers' => $headers,
            ];
        }
        return $this->curl->sendMany($params);
    }
}