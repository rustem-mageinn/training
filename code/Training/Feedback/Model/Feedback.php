<?php

namespace Training\Feedback\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use \Training\Feedback\Api\Data\FeedbackInterface;

class Feedback extends AbstractExtensibleModel implements \Training\Feedback\Api\Data\FeedbackInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $_eventPrefix = 'training_feedback';

    protected $_eventObject = 'feedback';

    protected function _construct()
    {
        $this->_init(\Training\Feedback\Model\ResourceModel\Feedback::class);
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::FEEDBACK_ID);
    }

    /**
     * Get author name
     *
     * @return string
     */
    public function getAuthorName()
    {
        return $this->getData(self::AUTHOR_NAME);
    }

    /**
     * Get author email
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->getData(self::AUTHOR_EMAIL);
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE);
    }

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return FeedbackInterface
     */
    public function setId($id)
    {
        return $this->setData(self::FEEDBACK_ID, $id);
    }

    /**
     * Set author name
     *
     * @param string $authorName
     * @return FeedbackInterface
     */
    public function setAuthorName($authorName)
    {
        return $this->setData(self::AUTHOR_NAME, $authorName);
    }

    /**
     * Set author email
     *
     * @param string $authorEmail
     * @return FeedbackInterface
     */
    public function setAuthorEmail($authorEmail)
    {
        return $this->setData(self::AUTHOR_EMAIL, $authorEmail);
    }

    /**
     * Set message
     *
     * @param string $message
     * @return FeedbackInterface
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return FeedbackInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return FeedbackInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return FeedbackInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * {@inheritdoc}
     *
     * @return FeedbackExtensionIterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     *
     * @param \Training\Feedback\Api\Data\FeedbackExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Training\Feedback\Api\Data\FeedbackExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}