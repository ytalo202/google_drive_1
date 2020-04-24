<?php

namespace App\Providers;

use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class GoogleDriverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend("google", function ($app, $config) {
            $file_id = Session('file_id');
            $refresh_token = Auth::user()->refresh_token;
            $client = new \Google_Client;
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($refresh_token);
//            dd($client);
            $service = new \Google_Service_Drive($client);
            $adapter = new GoogleDriveAdapter($service, $file_id);
//            dd($adapter);
            return new Filesystem($adapter);
        });
    }
}
