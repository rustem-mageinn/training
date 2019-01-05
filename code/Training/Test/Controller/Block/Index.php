<?php

namespace Training\Test\Controller\Block;

use \Magento\Framework\App\Action\Action;

class Index extends Action
{
    private $layoutFactory;

    private $resultRawFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    ) {
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $resultRaw = $this->resultRawFactory->create();
        $block = $layout->createBlock('Training\Test\Block\Test');
        return $resultRaw->setContents($block->toHtml());
    }
}