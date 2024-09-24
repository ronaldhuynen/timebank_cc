window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Include Messenger translation keys by replacing texts by translation keys
console.log('BOOTSTRAP-1');
console.log('BOOTSTRAP-1');
document.addEventListener('DOMContentLoaded', function () {
    const updateTranslations = () => {
        if (!window.translations) {
            console.error('window.translations is undefined');
            return;
        }

        const parentElement = document.getElementById('messenger-style-overrides');
        if (parentElement) {
            const translations = {
                'Search profiles...': window.translations.searchProfiles,
                [`Search above for other profiles on ${window.appName}`]: window.translations.searchAboveForProfiles,
                'Name the group conversation': window.translations.nameGroupConversation,
                'Create a group': window.translations.createGroup,
                'Create': window.translations.create,
                'Friends': window.translations.friends,
                'No friends to show': window.translations.noFriendsToShow

            };

            // Handle other translations generically
            Object.keys(translations).forEach(key => {

                // Find and update elements containing the translation key
                const elements = Array.from(parentElement.querySelectorAll('*')).filter(el =>
                    el.placeholder?.trim() === key || el.textContent.trim() === key
                );

                // console.log(`Found ${elements.length} elements for key: "${key}"`);

                elements.forEach(el => {
                    // Exclude the specific element from translation
                    if (el.closest('#messenger_search_content')) {
                        return;
                    }

                    if (el.placeholder?.trim() === key) {
                        // console.log(`Updating placeholder for element:`, el);
                        el.placeholder = translations[key];
                    } else if (el.textContent.trim() === key) {
                        // console.log(`Updating text content for element:`, el);
                        el.innerHTML = el.innerHTML.replace(key, translations[key]);
                    }
                });
            });

            return true;
        }
        return false;
    };

    // Initial call to handle elements already in the DOM
    updateTranslations();
    console.log('BOOTSTRAP-2');

    // Wait for ThreadManager to be fully loaded
    const checkThreadManagerLoaded = setInterval(() => {
        if (window.ThreadManager && window.ThreadTemplates) {
            clearInterval(checkThreadManagerLoaded);

            // Create a proxy to intercept all method calls on ThreadManager
            const proxyHandler = {
                get(target, propKey) {
                    const origMethod = target[propKey];
                    return function (...args) {
                        const result = origMethod.apply(this, args);
                        updateTranslations();
                        return result;
                    };
                }
            };

            // Replace ThreadManager with the proxy
            window.ThreadManager = new Proxy(window.ThreadManager, proxyHandler);
        }
    }, 100); // Check every 100ms
});

