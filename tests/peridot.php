<?php
use Evenement\EventEmitterInterface;
use Peridot\Plugin\Prophecy\ProphecyPlugin;
use Peridot\Leo\Interfaces\Assert;

return function(EventEmitterInterface $emitter) {
    $plugin = new ProphecyPlugin($emitter);
};