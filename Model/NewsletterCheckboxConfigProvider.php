<?php
declare(strict_types=1);

namespace MageSuite\CheckoutNewsletterSubscription\Model;

class NewsletterCheckboxConfigProvider implements \Magento\Checkout\Model\ConfigProviderInterface
{
    protected \Magento\Store\Model\StoreManagerInterface $storeManager;

    protected \Magento\Customer\Model\Session $customerSession;

    protected \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory;

    protected \MageSuite\CheckoutNewsletterSubscription\Helper\Configuration $configuration;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory,
        \MageSuite\CheckoutNewsletterSubscription\Helper\Configuration $configuration
    ) {
        $this->storeManager = $storeManager;
        $this->customerSession = $customerSession;
        $this->subscriberFactory = $subscriberFactory;
        $this->configuration = $configuration;
    }

    public function getConfig()
    {
        if (!$this->customerSession->isLoggedIn()) {
            return [
                'newsletter_checkbox' => [
                    'isSubscriptionExist' => false,
                    'isSubscriptionConfirmed' => false,
                    'isVisible' => $this->configuration->isVisibleForGuestCustomer(),
                    'isChecked' => $this->configuration->isCheckedByDefaultForGuestCustomer()
                ]
            ];
        }

        $websiteId = (int)$this->storeManager->getStore()->getWebsiteId();
        $customer = $this->customerSession->getCustomer();
        $subscription = $this->subscriberFactory->create()->loadBySubscriberEmail($customer->getEmail(), $websiteId);

        return [
            'newsletter_checkbox' => [
                'isSubscriptionExist' => (bool)$subscription->getId(),
                'isSubscriptionConfirmed' => $subscription->getStatus() == \Magento\Newsletter\Model\Subscriber::STATUS_SUBSCRIBED,
                'isVisible' => $this->isVisibleForLoggedIn($customer, $subscription),
                'isChecked' => $this->isCheckedForLoggedIn($customer, $subscription)
            ]
        ];
    }

    public function isVisibleForLoggedIn(\Magento\Customer\Model\Customer $customer, \Magento\Newsletter\Model\Subscriber $subscription): bool
    {
        if ($subscription->getStatus() == \Magento\Newsletter\Model\Subscriber::STATUS_SUBSCRIBED) {
            return $this->configuration->isVisibleForSubscribedLoggedInCustomer();
        }

        return $this->configuration->isVisibleForLoggedInCustomer();
    }

    public function isCheckedForLoggedIn(\Magento\Customer\Model\Customer $customer, \Magento\Newsletter\Model\Subscriber $subscription): bool
    {
        if ($subscription->getStatus() == \Magento\Newsletter\Model\Subscriber::STATUS_UNSUBSCRIBED) {
            return $this->configuration->isCheckedForUnsubscribedLoggedInCustomer();
        }

        if ($subscription->getStatus() == \Magento\Newsletter\Model\Subscriber::STATUS_NOT_ACTIVE) {
            return $this->configuration->isCheckedForNotActiveLoggedInCustomer();
        }

        return $this->configuration->isCheckedByDefaultForLoggedInCustomer();
    }
}
