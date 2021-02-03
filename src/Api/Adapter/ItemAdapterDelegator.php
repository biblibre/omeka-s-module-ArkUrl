<?php

namespace ArkUrl\Api\Adapter;

use Omeka\Api\Adapter\ItemAdapter;

class ItemAdapterDelegator extends ItemAdapter
{
    public function getRepresentationClass()
    {
        return \ArkUrl\Api\Representation\ItemRepresentation::class;
    }
}
