<?php

namespace Training\Router\Controller\Index;

use \Magento\Framework\App\Action\Action;

class Index16 extends Action
{
    protected $playWithTest;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Training\TestOM\Model\PlayWithTest $playWithTest
    ) {
        $this->playWithTest = $playWithTest;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->playWithTest->run();
    }
}
