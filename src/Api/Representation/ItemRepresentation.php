<?php

namespace ArkUrl\Api\Representation;

class ItemRepresentation extends \Omeka\Api\Representation\ItemRepresentation
{
    public function siteUrl($siteSlug = null, $canonical = false)
    {
        $arkViewHelper = $this->getViewHelper('ark');
        $urlViewHelper = $this->getViewHelper('url');

        $ark = $arkViewHelper($this)->identifier();
        if ($ark) {
            if (!$siteSlug) {
                $siteSlug = $this->getServiceLocator()->get('Application')
                    ->getMvcEvent()->getRouteMatch()->getParam('site-slug');
            }

            return $urlViewHelper(
                'site/ark/default',
                [
                    'naan' => $ark->getNaan(),
                    'name' => $ark->getName(),
                    'qualifier' => $ark->getQualifier(),
                    'site-slug' => $siteSlug,
                ],
                ['force_canonical' => $canonical],
            );
        }

        return parent::siteUrl($siteSlug, $canonical);
    }
}
