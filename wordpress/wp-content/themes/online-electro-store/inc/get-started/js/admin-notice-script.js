

// Creta Testimonial Showcase plugin activation
document.addEventListener('DOMContentLoaded', function () {
    const online_electro_store_button = document.getElementById('install-activate-button');

    if (!online_electro_store_button) return;

    online_electro_store_button.addEventListener('click', function (e) {
        e.preventDefault();

        const online_electro_store_redirectUrl = online_electro_store_button.getAttribute('data-redirect');

        // Step 1: Check if plugin is already active
        const online_electro_store_checkData = new FormData();
        online_electro_store_checkData.append('action', 'check_creta_testimonial_activation');

        fetch(installcretatestimonialData.ajaxurl, {
            method: 'POST',
            body: online_electro_store_checkData,
        })
        .then(res => res.json())
        .then(res => {
            if (res.success && res.data.active) {
                // Plugin is already active → just redirect
                window.location.href = online_electro_store_redirectUrl;
            } else {
                // Not active → proceed with install + activate
                online_electro_store_button.textContent = 'Nevigate Getstart';

                const online_electro_store_installData = new FormData();
                online_electro_store_installData.append('action', 'install_and_activate_creta_testimonial_plugin');
                online_electro_store_installData.append('_ajax_nonce', installcretatestimonialData.nonce);

                fetch(installcretatestimonialData.ajaxurl, {
                    method: 'POST',
                    body: online_electro_store_installData,
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        window.location.href = online_electro_store_redirectUrl;
                    } else {
                        alert('Activation error: ' + (res.data?.message || 'Unknown error'));
                        online_electro_store_button.textContent = 'Try Again';
                    }
                })
                .catch(error => {
                    alert('Request failed: ' + error.message);
                    online_electro_store_button.textContent = 'Try Again';
                });
            }
        })
        .catch(error => {
            alert('Check request failed: ' + error.message);
        });
    });
});
