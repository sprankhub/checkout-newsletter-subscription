<?php

namespace MageSuite\CheckoutNewsletterSubscription\Api;

interface GuestConfigManagementInterface
{
    /**
     * @param string $customerEmail
     * @return string
     */
    public function getCheckoutFieldConfig(string $customerEmail): string;
}
