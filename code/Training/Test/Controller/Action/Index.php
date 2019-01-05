<?php

namespace Training\Test\Controller\Action;

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
        $block = $layout->createBlock('Training\Test\Block\Test');
        $block->setTemplate('test.phtml');
        $resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents($block->toHtml());
    }
}