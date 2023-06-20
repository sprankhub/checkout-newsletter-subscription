define([
  "uiComponent",
  "jquery",
  "ko",
  "mage/url",
  "Magento_Checkout/js/model/quote",
], function (Component, $, ko, url, quote) {
  "use strict";
  return Component.extend({
    defaults: {
      displayArea: "newsletter-subscribe",
      template: "MageSuite_CheckoutNewsletterSubscription/newsletter-subscribe",
    },
    newsletterSubscriptionEndpoint:
      "rest/V1/checkout_newsletter_subscription/guest/getFieldConfig",

    isSubscriptionExist: ko.observable(
      window.checkoutConfig.newsletter_checkbox.isSubscriptionExist
    ),
    isVisible: ko.observable(
      window.checkoutConfig.newsletter_checkbox.isVisible
    ),
    isChecked: ko.observable(
      window.checkoutConfig.newsletter_checkbox.isChecked
    ),

    updateNewsletterTemplate: function () {
      $.post({
        url: url.build(this.newsletterSubscriptionEndpoint),
        data: JSON.stringify({ customerEmail: quote.guestEmail }),
        contentType: "application/json",
      }).done(
        function (response) {
          var response = JSON.parse(response);

          window.checkoutConfig.newsletter_checkbox.isSubscriptionExist =
            response.isSubscriptionExist;
          window.checkoutConfig.newsletter_checkbox.isVisible =
            response.isVisible;
          window.checkoutConfig.newsletter_checkbox.isChecked =
            response.isChecked;

          this.isSubscriptionExist(
            window.checkoutConfig.newsletter_checkbox.isSubscriptionExist
          );
          this.isVisible(window.checkoutConfig.newsletter_checkbox.isVisible);
          this.isChecked(window.checkoutConfig.newsletter_checkbox.isChecked);
        }.bind(this)
      );
    },
  });
});
