<?php

namespace Training\Feedback\ViewModel;

use Magento\Framework\UrlInterface;

class FeedbackForm implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /** @var UrlInterface */
    private $urlBuilder;

    public function __construct(
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    public function getActionUrl()
    {
        return $this->urlBuilder->getUrl('training_feedback/index/save');
    }
}