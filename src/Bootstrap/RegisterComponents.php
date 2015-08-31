<?php
namespace WordPlate\Bootstrap;

use WordPlate\Application;

/**
 * This is the register components class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class RegisterComponents
{
    /**
     * The WordPress component classes for the application.
     *
     * @var array
     */
    protected $components = [
        'WordPlate\WordPress\Components\Dashboard',
        'WordPlate\WordPress\Components\Editor',
        'WordPlate\WordPress\Components\Footer',
        'WordPlate\WordPress\Components\Login',
        'WordPlate\WordPress\Components\Mail',
        'WordPlate\WordPress\Components\Menu',
        'WordPlate\WordPress\Components\Plugin',
        'WordPlate\WordPress\Components\Theme',
        'WordPlate\WordPress\Components\Widget',
    ];

    /**
     * Bootstrap the given application.
     *
     * @param \WordPlate\Application $app
     *
     * @return void
     */
    public function bootstrap(Application $app)
    {
        foreach ($this->components as $component) {
            $app->make($component)->bootstrap($this);
        }
    }
}
