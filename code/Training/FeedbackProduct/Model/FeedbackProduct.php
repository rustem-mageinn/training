<?php

namespace Training\FeedbackProduct\Model;


class FeedbackProduct
{
    /**
     * @var FeedbackDataLoader
     */
    private $feedbackDataLoader;

    /**
     * @var ResourceModel\FeedbackProduct
     */
    private $feedbackProductsResource;

    /**
     * FeedbackProducts constructor.
     * @param FeedbackDataLoader $feedbackDataLoader
     * @param ResourceModel\FeedbackProduct $feedbackProductsResource
     */
    public function __construct(
        \Training\FeedbackProduct\Model\FeedbackDataLoader $feedbackDataLoader,
        \Training\FeedbackProduct\Model\ResourceModel\FeedbackProduct $feedbackProductsResource
    ) {
        $this->feedbackDataLoader = $feedbackDataLoader;
        $this->feedbackProductsResource = $feedbackProductsResource;
    }

    public function loadProductRelations($feedback)
    {
        $productIds = $this->feedbackProductsResource->loadProductRelations($feedback->getId());
        return $this->feedbackDataLoader->addProductsToFeedbackByIds($feedback, $productIds);
    }

    public function saveProductRelations($feedback)
    {
        $productIds = [];
        $products = $feedback->getExtensionAttributes()->getProducts();
        foreach ($products as $product) {
            $productIds[] = $product->getId();
        }
        $this->feedbackProductsResource->saveProductRelations($feedback->getId(), $productIds);
        return $this;
    }
}