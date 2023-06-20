<?php
declare(strict_types=1);

namespace MageSuite\CheckoutNewsletterSubscription\Service;

class GuestConfigManagement implements \MageSuite\CheckoutNewsletterSubscription\Api\GuestConfigManagementInterface
{
    protected \Magento\Framework\Serialize\SerializerInterface $serializer;

    protected \Magento\Store\Model\StoreManagerInterface $storeManager;

    protected \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory;

    protected \MageSuite\CheckoutNewsletterSubscription\Helper\Configuration $configuration;

    public function __construct(
        \Magento\Framework\Serialize\SerializerInterface $serializer,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory,
        \MageSuite\CheckoutNewsletterSubscription\Helper\Configuration $configuration
    ) {
        $this->serializer = $serializer;
        $this->storeManager = $storeManager;
        $this->subscriberFactory = $subscriberFactory;
        $this->configuration = $configuration;
    }

    public function getCheckoutFieldConfig(string $customerEmail): string
    {
        $websiteId = (int)$this->storeManager->getStore()->getWebsiteId();
        $subscription = $this->subscriberFactory->create()->loadBySubscriberEmail($customerEmail, $websiteId);

        $fieldConfig = [
            'isSubscriptionExist' => (bool)$subscription->getId(),
            'isVisible' => $this->isVisibleForGuest($subscription),
            'isChecked' => $this->isCheckedForGuest($subscription)
        ];

        return $this->serializer->serialize($fieldConfig);
    }

    public function isVisibleForGuest(\Magento\Newsletter\Model\Subscriber $subscription): bool
    {
        if ($subscription->getStatus() == \Magento\Newsletter\Model\Subscriber::STATUS_SUBSCRIBED) {
            return $this->configuration->isVisibleForSubscribedLoggedInCustomer();
        }

        return $this->configuration->isVisibleForLoggedInCustomer();
    }

    public function isCheckedForGuest(\Magento\Newsletter\Model\Subscriber $subscription): bool
    {
        if ($subscription->getStatus() == \Magento\Newsletter\Model\Subscriber::STATUS_UNSUBSCRIBED) {
            return $this->configuration->isCheckedForUnsubscribedLoggedInCustomer();
        }

        if ($subscription->getStatus() == \Magento\Newsletter\Model\Subscriber::STATUS_NOT_ACTIVE) {
            return $this->configuration->isCheckedForNotActiveGuestCustomer();
        }

        return $this->configuration->isCheckedByDefaultForLoggedInCustomer();
    }
}
