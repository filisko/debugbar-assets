<?php
namespace Filisko\DebugBar\DataCollector;

class AssetsCollector extends \DebugBar\DataCollector\DataCollector implements \DebugBar\DataCollector\Renderable, \DebugBar\DataCollector\AssetProvider
{
    /**
     * Instance of the Asset Manager.
     * @var \Stolz\Assets\Manager
     */
    protected $manager;

    /**
     * Set the Assets Manager.
     * @param \Stolz\Assets\Manager $manager
     */
    public function __construct(\Stolz\Assets\Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Collect the assets.
     */
    public function collect()
    {
        $loaded = array_merge($this->manager->getCss(), $this->manager->getJs());
        $num = count($loaded);

        array_walk_recursive($loaded, function(&$value) {
            preg_match('/\.[^\.]+$/i', $value, $ext);
            $extension = substr($ext[0], 1);
            if ($extension == 'css') {
                $color = '#A13434';
            } elseif ($extension == 'js') {
                $color = '#3448A1';
            } else {
                $color = '#333';
            }

            $value = '<span style="color:'.$color.'">'.substr($value, 1).'</span>';
        });

        return array(
            'loaded' => $loaded,
            'num' => $num
            //'accumulated_duration_str' => 1,
        );
    }

    public function getName()
    {
        return 'assets';
    }

    public function getWidgets()
    {
        return array(
            "Assets" => array(
                "icon" => "inbox",
                "widget" => "PhpDebugBar.Widgets.ListWidget",
                "map" => "assets.loaded",
                "default" => "[]",
            ),
            "Assets:badge" => array(
                "map" => "assets.num",
                "default" => 0
            )
        );
    }

    public function getAssets()
    {
        return null;
    }
}
