<?php
/**
 * Translitedated plugin for Craft CMS 3.x
 *
 * Twig filter to output dates in any locale (language).
 *
 * @link      https://github.com/chattervast
 * @copyright Copyright (c) 2018 Chattervast
 */

namespace chattervast\translitedated;

use chattervast\translitedated\twigextensions\TranslitedatedTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Class Translitedated
 *
 * @author    Chattervast
 * @package   Translitedated
 * @since     1.0
 *
 */
class Translitedated extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Translitedated
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Craft::$app->view->registerTwigExtension(new TranslitedatedTwigExtension());

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'translitedated',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
