<?php

namespace JiraApi\Clients;

use GuzzleHttp\Client as GuzzleClient;

abstract class AbstractClient
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @param string $domain
     * @param string $username
     * @param string $password
     */
    public function __construct($domain, $username, $password)
    {
        $this->client = new GuzzleClient([
            'base_uri' => filter_var($domain, FILTER_VALIDATE_URL)
                ? $domain
                : sprintf('https://%s.atlassian.net/rest/api/latest/', $domain),
            'auth' => [$username, $password]
        ]);
    }

    /**
     * @return GuzzleClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param  string $uri
     *
     * @return GuzzleHttp\Message\Response
     */
    public function getRequest($uri)
    {
        return $this->getClient()->get($uri);
    }

    /**
     * @param  string $uri
     * @param  string $data
     *
     * @return GuzzleHttp\Message\Response
     */
    public function postRequest($uri, array $data = null)
    {
        return $this->getClient()->post($uri, [
            'json' => $this->createBody($data)
        ]);
    }

    /**
     * @param  string $uri
     * @param  resource $file
     *
     * @return \GuzzleHttp\Message\Response
     */
    public function postFile($uri, $file = null)
    {
        return $this->getClient()->post($uri, [
            'headers'   => ['X-Atlassian-Token' => 'no-check'],
            'multipart' => [
                'name'     => 'file',
                'contents' => $file
            ]
        ]);
    }

    /**
     * @param  string $uri
     * @param array $data
     *
     * @return \GuzzleHttp\Message\Response
     */
    public function putRequest($uri, array $data = null)
    {
        return $this->getClient()->put($uri, [
            'json' => $this->createBody($data)
        ]);
    }

    /**
     * @param  string $uri
     *
     * @return GuzzleHttp\Message\Response
     */
    public function deleteRequest($uri)
    {
        return $this->getClient()->delete($uri);
    }

    /**
     * @param  array  $data
     *
     * @return array
     */
    protected function createBody(array $data = null)
    {
        return $data ?: [];
    }

    /**
     * @param  array  $data
     *
     * @return string
     */
    protected function createUriParameters(array $data = null)
    {
        return $data ? http_build_query($data) : '';
    }

}
