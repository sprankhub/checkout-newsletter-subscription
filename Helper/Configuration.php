<?php
declare(strict_types=1);

namespace MageSuite\CheckoutNewsletterSubscription\Helper;

class Configuration
{
    const XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_LOGGED_IN_CUSTOMER_IS_VISIBLE = 'checkout_newsletter_subscription/logged_in_customer/is_visible';
    const XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_LOGGED_IN_CUSTOMER_IS_VISIBLE_FOR_SUBSCRIBED = 'checkout_newsletter_subscription/logged_in_customer/is_visible_for_subscribed';
    const XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_LOGGED_IN_CUSTOMER_IS_CHECKED_BY_DEFAULT = 'checkout_newsletter_subscription/logged_in_customer/is_checked_by_default';
    const XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_LOGGED_IN_CUSTOMER_IS_CHECKED_FOR_UNSUBSCRIBED = 'checkout_newsletter_subscription/logged_in_customer/is_checked_for_unsubscribed';
    const XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_LOGGED_IN_CUSTOMER_IS_CHECKED_FOR_NOT_ACTIVE = 'checkout_newsletter_subscription/logged_in_customer/is_checked_for_not_active';

    const XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_GUEST_CUSTOMER_IS_VISIBLE = 'checkout_newsletter_subscription/guest_customer/is_visible';
    const XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_GUEST_CUSTOMER_IS_VISIBLE_FOR_SUBSCRIBED = 'checkout_newsletter_subscription/guest_customer/is_visible_for_subscribed';
    const XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_GUEST_CUSTOMER_IS_CHECKED_BY_DEFAULT = 'checkout_newsletter_subscription/guest_customer/is_checked_by_default';
    const XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_GUEST_CUSTOMER_IS_CHECKED_FOR_UNSUBSCRIBED = 'checkout_newsletter_subscription/guest_customer/is_checked_for_unsubscribed';
    const XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_GUEST_CUSTOMER_IS_CHECKED_FOR_NOT_ACTIVE = 'checkout_newsletter_subscription/logged_in_customer/is_checked_for_not_active';

    protected \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function isVisibleForLoggedInCustomer(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_LOGGED_IN_CUSTOMER_IS_VISIBLE);
    }

    public function isVisibleForSubscribedLoggedInCustomer(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_LOGGED_IN_CUSTOMER_IS_VISIBLE_FOR_SUBSCRIBED);
    }

    public function isCheckedByDefaultForLoggedInCustomer(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_LOGGED_IN_CUSTOMER_IS_CHECKED_BY_DEFAULT);
    }

    public function isCheckedForUnsubscribedLoggedInCustomer(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_LOGGED_IN_CUSTOMER_IS_CHECKED_FOR_UNSUBSCRIBED);
    }

    public function isCheckedForNotActiveLoggedInCustomer(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_LOGGED_IN_CUSTOMER_IS_CHECKED_FOR_NOT_ACTIVE);
    }

    public function isVisibleForGuestCustomer(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_GUEST_CUSTOMER_IS_VISIBLE);
    }

    public function isVisibleForSubscribedGuestCustomer(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_GUEST_CUSTOMER_IS_VISIBLE_FOR_SUBSCRIBED);
    }

    public function isCheckedByDefaultForGuestCustomer(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_GUEST_CUSTOMER_IS_CHECKED_BY_DEFAULT);
    }

    public function isCheckedForUnsubscribedGuestCustomer(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_GUEST_CUSTOMER_IS_CHECKED_FOR_UNSUBSCRIBED);
    }

    public function isCheckedForNotActiveGuestCustomer(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CHECKOUT_NEWSLETTER_SUBSCRIPTION_GUEST_CUSTOMER_IS_CHECKED_FOR_NOT_ACTIVE);
    }
}
