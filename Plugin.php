<?php

namespace RLuders\Cors;

use Config;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use RLuders\Cors\Models\Settings as PluginSettings;

/**
 * CORS Plugin Information File.
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'rluders.cors::lang.plugin.name',
            'description' => 'rluders.cors::lang.plugin.description',
            'author'      => 'Ricardo Lüders',
            'icon'        => 'icon-user-secret',
        ];
    }

    /**
     * Register the plugin settings
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'rluders.cors::lang.settings.menu_label',
                'description' => 'rluders.cors::lang.settings.menu_description',
                'category'    => SettingsManager::CATEGORY_MISC,
                'icon'        => 'icon-user-secret',
                'class'       => 'RLuders\Cors\Models\Settings',
                'order'       => 600,
                'permissions' => ['rluders.cors.access_settings'],
            ]
        ];
    }

    /**
     * Register the plugin permissions
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'rluders.cors.access_settings' => [
                'tab' => 'rluders.cors::lang.plugin.name',
                'label' => 'rluders.cors::lang.permissions.settings'
            ]
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\RLuders\Cors\Providers\ServiceProvider::class);
        $this->app['router']->middleware('cors', \Barryvdh\Cors\HandleCors::class);
    }
}
