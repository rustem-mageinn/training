<?php

namespace Training\Render\ViewModel;

use Magento\Framework\UrlInterface;

class Form implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /** @var UrlInterface */
    private $urlBuilder;

    /**
     * Form constructor.
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return string
     */
    public function getSubmitUrl()
    {
        return $this->urlBuilder->getUrl('customer/account/login');
    }
}