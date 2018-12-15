<?php

namespace Training\Router\Controller\Index;

use \Magento\Framework\App\Action\Action;

class Index extends Action
{
    protected $test;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Training\TestOM\Model\Test $test
    ) {
        $this->test = $test;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->test->log();
    }
}
