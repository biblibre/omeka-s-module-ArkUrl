<?php
namespace ArkUrl\Service\Delegator;

use ArkUrl\Api\Adapter\ItemAdapterDelegator;
use ArkUrl\Api\Adapter\ItemSetAdapterDelegator;
use ArkUrl\Api\Adapter\MediaAdapterDelegator;
use Interop\Container\ContainerInterface;
use Omeka\Api\Adapter\ItemAdapter;
use Omeka\Api\Adapter\ItemSetAdapter;
use Omeka\Api\Adapter\MediaAdapter;
use Omeka\Module\Manager as OmekaModuleManager;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;

class ApiAdapterDelegatorFactory implements DelegatorFactoryInterface
{
    protected $delegators = [
        ItemAdapter::class => ItemAdapterDelegator::class,
        ItemSetAdapter::class => ItemSetAdapterDelegator::class,
        MediaAdapter::class => MediaAdapterDelegator::class,
    ];

    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null) {
        $moduleManager = $container->get('Omeka\ModuleManager');
        $arkModuleIsActive = $moduleManager->isRegistered('Ark') && $moduleManager->getModule('Ark')->getState() === OmekaModuleManager::STATE_ACTIVE;

        if ($arkModuleIsActive && isset($this->delegators[$name])) {
            $delegatorClass = $this->delegators[$name];
            return new $delegatorClass;
        }

        return call_user_func($callback);
    }
}
