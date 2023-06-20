define([
  "jquery",
  "Magento_Checkout/js/model/quote",
  "MageSuite_CheckoutNewsletterSubscription/js/newsletter-subscribe",
], function ($, quote, newsletterSubscribe) {
  "use strict";

  return function (NextButton) {
    return NextButton.extend({
      continueToPayment: function () {
        const guestEmail = quote.guestEmail;

        // In case guestEmail is available, we run the newsletter update method to use the appropriate configuration
        if (guestEmail) {
          newsletterSubscribe().updateNewsletterTemplate();
        }

        this._super();
      },
    });
  };
});
