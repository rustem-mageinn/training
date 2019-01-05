<?php

namespace Training\Test\Block\Product\View;


class Description
{
    public function beforeToHtml(
        \Magento\Catalog\Block\Product\View\Description $subject
    ) {
        return $subject->getProduct()->setDescription('Test Description');
    }
}