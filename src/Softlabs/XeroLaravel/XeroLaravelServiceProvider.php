<?php namespace Softlabs\XeroLaravel;

use Illuminate\Support\ServiceProvider;

class XeroLaravelServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['xero'] = $this->app->share(function($app)
        {
            \ClassLoader::addDirectories(array(__DIR__ . '/PHP-Xero'));
            $config = $this->app['config']['xero'];
            return new \xero($config['key'], $config['secret'], $config['publicPath'], $config['privatePath'], isset($config['format']) ? $config['format'] : 'json');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('xero');
    }

}
