<?php 

namespace Botble\Facebook\Supports;

use Illuminate\Contracts\Config\Repository as Config;
use Facebook\Facebook;

class FacebookSdk extends Facebook
{
    /**
     * @var Config
     */
    protected $configHandler;

    /**
     * @var \Illuminate\Contracts\Routing\UrlGenerator
     */
    protected $url;

    /**
     * @var array
     */
    protected $defaultConfig;

    /**
     * @param Config $configHandler
     * @param \Illuminate\Contracts\Routing\UrlGenerator $url
     * @param array $config
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function __construct(Config $configHandler, $url, array $config)
    {
        $this->configHandler = $configHandler;
        $this->url = $url;
        $this->defaultConfig = $config;

        parent::__construct($config);
    }

    /**
     * @param array $config
     *
     * @return FacebookSdk
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function newInstance(array $config)
    {
        $new_config = array_merge($this->defaultConfig, $config);

        return new static($this->configHandler, $this->url, $new_config);
    }

    /**
     * Generate an OAuth 2.0 authorization URL for authentication.
     *
     * @param array $scope
     * @param string $callback_url
     *
     * @return string
     */
    public function getLoginUrl(array $scope = [], $callback_url = '')
    {
        $scope = $this->getScope($scope);
        $callback_url = $this->getCallbackUrl($callback_url);

        return $this->getRedirectLoginHelper()->getLoginUrl($callback_url, $scope);
    }

    /**
     * Generate a re-request authorization URL.
     *
     * @param array $scope
     * @param string $callback_url
     *
     * @return string
     */
    public function getReRequestUrl(array $scope, $callback_url = '')
    {
        $scope = $this->getScope($scope);
        $callback_url = $this->getCallbackUrl($callback_url);

        return $this->getRedirectLoginHelper()->getReRequestUrl($callback_url, $scope);
    }

    /**
     * Generate a re-authentication authorization URL.
     *
     * @param array $scope
     * @param string $callback_url
     *
     * @return string
     */
    public function getReAuthenticationUrl(array $scope = [], $callback_url = '')
    {
        $scope = $this->getScope($scope);
        $callback_url = $this->getCallbackUrl($callback_url);

        return $this->getRedirectLoginHelper()->getReAuthenticationUrl($callback_url, $scope);
    }

    /**
     * Get an access token from a redirect.
     *
     * @param string $callback_url
     * @return \Facebook\Authentication\AccessToken|null
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getAccessTokenFromRedirect($callback_url = '')
    {
        $callback_url = $this->getCallbackUrl($callback_url);

        return $this->getRedirectLoginHelper()->getAccessToken($callback_url);
    }

    /**
     * Get the fallback scope if none provided.
     *
     * @param array $scope
     *
     * @return array
     */
    protected function getScope(array $scope)
    {
        return $scope ?: $this->configHandler->get('services.facebook.default_scope');
    }

    /**
     * Get the fallback callback redirect URL if none provided.
     *
     * @param string $callback_url
     *
     * @return string
     */
    protected function getCallbackUrl($callback_url)
    {
        $callback_url = $callback_url ?: $this->configHandler->get('services.facebook.default_redirect_uri');

        return $this->url->to($callback_url);
    }
}