<?php

namespace Training\Test\Block\Product\View;


class Description
{
    public function beforeToHtml(
        \Magento\Catalog\Block\Product\View\Description $subject
    ) {
        $subject->setTemplate('Training_Test::description.phtml');
    }
}