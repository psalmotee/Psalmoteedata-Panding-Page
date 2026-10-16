/**
 * PsalmoteeData offline purchase page integration.
 */
(function () {
    'use strict';

    function initOfflinePage() {
        var headerBuyButton = document.getElementById('header-buy-services');

        if (!headerBuyButton || headerBuyButton.dataset.psdBound === 'true') {
            return;
        }

        headerBuyButton.dataset.psdBound = 'true';
        headerBuyButton.addEventListener('click', function () {
            // Reuse the original VTUPress shortcode card's existing click handler.
            // Do not duplicate or replace its service-selection/payment logic.
            var originalBuyCard = document.getElementById('vpo-mode-buy');

            if (!originalBuyCard) {
                console.warn('PsalmoteeData: the original Buy Services card (#vpo-mode-buy) was not found.');
                return;
            }

            originalBuyCard.click();

            // Keep the checkout area in view after its step changes or services load.
            var purchaseSection = document.getElementById('purchase');
            if (purchaseSection) {
                purchaseSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initOfflinePage, { once: true });
    } else {
        initOfflinePage();
    }
})();
