# Stolz/Assets Collector for Debugbar

## Result
![Assets collector for Debugbar](https://i.snag.gy/IyQnKo.jpg "Assets collector for Debugbar")

## Installation
Install it via composer:

`composer require filisko/debugbar-assets`

## How to use

```php
// Your assets manager
$assetsManager = new \Stolz\Assets\Manager($config);

// Your debugbar
$debugbar = new \DebugBar\StandardDebugBar();

// Adding the assets collector to your debugbar passing the assets manager instance
$debugbar->addCollector(new \Filisko\DebugBar\DataCollector\AssetsCollector($assetsManager));
```
