<?php

namespace ArkUrl\Api\Adapter;

use Omeka\Api\Adapter\ItemSetAdapter;

class ItemSetAdapterDelegator extends ItemSetAdapter
{
    public function getRepresentationClass()
    {
        return \ArkUrl\Api\Representation\ItemSetRepresentation::class;
    }
}
