<?php

namespace ArkUrl\Api\Adapter;

use Omeka\Api\Adapter\MediaAdapter;

class MediaAdapterDelegator extends MediaAdapter
{
    public function getRepresentationClass()
    {
        return \ArkUrl\Api\Representation\MediaRepresentation::class;
    }
}
