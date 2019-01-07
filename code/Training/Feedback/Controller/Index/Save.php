<?php

namespace Training\Feedback\Controller\Index;

use \Magento\Framework\App\Action\Action;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    /**
     * @var \Training\Feedback\Model\FeedbackFactory
     */
    private $feedbackFactory;

    /**
     * @var \Training\Feedback\Model\ResourceModel\Feedback
     */
    private $feedbackResource;

    /**
     * Save constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory
     * @param \Training\Feedback\Model\FeedbackFactory $feedbackFactory
     * @param \Training\Feedback\Model\ResourceModel\Feedback $feedbackResource
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        \Training\Feedback\Model\FeedbackFactory $feedbackFactory,
        \Training\Feedback\Model\ResourceModel\Feedback $feedbackResource
    ) {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackResource = $feedbackResource;
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $result = $this->resultRedirectFactory->create();
        if ($post = $this->getRequest()->getPostValue()) {
            try {
                $this->validatePost($post);
                $feedback = $this->feedbackFactory->create();
                $feedback->setData($post);
                $this->feedbackResource->save($feedback);
                $this->messageManager->addSuccessMessage(__('Thank you for your feedback.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('An error occured while processing your form. Please try again later.' . $e->getMessage())
                );
                $result->setPath('*/*/form');
                return $result;
            }
        }
        return $result->setPath('*/*/index');
    }

    /**
     * @param $post
     * @throws LocalizedException
     * @throws \Exception
     */
    private function validatePost($post)
    {
        if (!isset($post['author_name']) || trim($post['author_name']) === '') {
            throw new LocalizedException(__('Name is Missing'));
        }
        if (!isset($post['message']) || trim($post['message']) === '') {
            throw new LocalizedException(__('Comment is Missing'));
        }
        if (!isset($post['author_email']) || trim($post['author_email']) === '') {
            throw new LocalizedException(__('Invalid email Address'));
        }
        if (trim($this->getRequest()->getParam('hideit')) !== '') {
            throw new \Exception();
        }
    }
}