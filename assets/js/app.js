// Runtime target: PHP 8.4+ / MySQL 8.4+
(() => {
    const activeLink = document.querySelector(`.app-sidebar .nav-link[href='${location.pathname.split('/').pop()}']`);
    if (activeLink) {
        activeLink.classList.add('active');
    }

    const runtimeBadge = document.querySelector('[data-runtime-badge="true"]');
    if (runtimeBadge) {
        const phpVersion = runtimeBadge.dataset.phpVersion;
        const mysqlVersion = runtimeBadge.dataset.mysqlVersion;
        runtimeBadge.title = `Running on PHP ${phpVersion} and MySQL ${mysqlVersion}`;
    }
})();

/**
 * AJAX helper function for dynamic form updates
 * Used by: student pages, exam pages, transport pages, fees pages
 * Loads content from a URL and updates a target element
 * 
 * @param {string} url - The URL to fetch content from
 * @returns {void}
 */
function getForm(url) {
    // Default target element if not specified
    const targetElement = document.getElementById('txtHint') || 
                         document.getElementById('result') || 
                         document.getElementById('ajax-content');
    
    if (!targetElement) {
        console.error('getForm: No target element found (txtHint, result, or ajax-content)');
        return;
    }
    
    // Show loading indicator
    targetElement.innerHTML = '<div style="padding: 20px; text-align: center;">Loading...</div>';
    
    // Use Fetch API instead of XMLHttpRequest
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            targetElement.innerHTML = data;
        })
        .catch(error => {
            console.error('getForm error:', error);
            targetElement.innerHTML = `<div style="padding: 20px; color: #D13438;">Error loading content. Please try again.</div>`;
        });
}

/**
 * AJAX helper function for vehicle/route selection
 * Used by: transport pages
 * Similar to getForm but specifically for transport vehicle/route cascading
 * 
 * @param {string} url - The URL to fetch vehicle data from
 * @returns {void}
 */
function getVehicle(url) {
    const targetElement = document.getElementById('vehicle_list') || 
                         document.getElementById('txtHint') || 
                         document.getElementById('result');
    
    if (!targetElement) {
        console.error('getVehicle: No target element found');
        return;
    }
    
    targetElement.innerHTML = '<div style="padding: 10px;">Loading vehicles...</div>';
    
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            targetElement.innerHTML = data;
        })
        .catch(error => {
            console.error('getVehicle error:', error);
            targetElement.innerHTML = `<div style="padding: 10px; color: #D13438;">Error loading vehicles.</div>`;
        });
}

/**
 * AJAX helper function for registration number validation
 * Used by: fees pages, student entry pages
 * Checks if registration number exists and displays student info
 * 
 * @param {string} url - The URL to validate registration against
 * @returns {void}
 */
function getCheckreg(url) {
    const targetElement = document.getElementById('reg_result') || 
                         document.getElementById('txtHint') || 
                         document.getElementById('result');
    
    if (!targetElement) {
        console.error('getCheckreg: No target element found');
        return;
    }
    
    targetElement.innerHTML = '<div style="padding: 10px; font-size: 12px; color: #666;">Checking...</div>';
    
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            targetElement.innerHTML = data;
        })
        .catch(error => {
            console.error('getCheckreg error:', error);
            targetElement.innerHTML = `<div style="padding: 10px; font-size: 12px; color: #D13438;">Error checking registration.</div>`;
        });
}

/**
 * Generic AJAX content loader
 * Can be used as a replacement for inline event handlers
 * 
 * @param {string} url - The URL to fetch content from
 * @param {string} targetId - The ID of the element to update with fetched content
 * @returns {void}
 * 
 * @example
 * loadContent('ajax_file.php?param=value', 'target-element-id')
 */
function loadContent(url, targetId) {
    const targetElement = document.getElementById(targetId);
    
    if (!targetElement) {
        console.error(`loadContent: Target element #${targetId} not found`);
        return;
    }
    
    targetElement.innerHTML = '<div style="padding: 15px; text-align: center;">Loading...</div>';
    
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            targetElement.innerHTML = data;
        })
        .catch(error => {
            console.error('loadContent error:', error);
            targetElement.innerHTML = `<div style="padding: 15px; color: #D13438; text-align: center;">Error loading content.</div>`;
        });
}

/**
 * Modern event listener setup for cascading dropdowns
 * Sets up a dropdown that loads content based on selection
 * 
 * @param {string} sourceId - The ID of the source dropdown element
 * @param {string} targetId - The ID of the element to update with loaded content
 * @param {string} ajaxFile - The AJAX file path to fetch content from
 * @returns {void}
 * 
 * @example
 * setupCascadingDropdown('class_id', 'section_dropdown', 'ajax_stream_code.php')
 */
function setupCascadingDropdown(sourceId, targetId, ajaxFile) {
    const sourceElement = document.getElementById(sourceId);
    
    if (!sourceElement) {
        console.error(`setupCascadingDropdown: Source element #${sourceId} not found`);
        return;
    }
    
    sourceElement.addEventListener('change', function() {
        // Properly encode both parameter name and value to prevent URL injection
        const encodedParam = encodeURIComponent(sourceId);
        const encodedValue = encodeURIComponent(this.value);
        const url = `${ajaxFile}?${encodedParam}=${encodedValue}`;
        loadContent(url, targetId);
    });
}

/**
 * Initialize data-attribute-based event handlers for security
 * This replaces inline event handlers to prevent XSS
 */
document.addEventListener('DOMContentLoaded', function() {
    // Handle data-action="check-reg" for registration number validation
    document.querySelectorAll('[data-action="check-reg"]').forEach(function(element) {
        element.addEventListener('blur', function() {
            const url = element.getAttribute('data-url');
            const value = encodeURIComponent(this.value);
            if (url && value) {
                getCheckreg(url + '?registration_no=' + value);
            }
        });
    });
    
    // Handle data-action="load-form" for cascading dropdowns
    document.querySelectorAll('[data-action="load-form"]').forEach(function(element) {
        element.addEventListener('change', function() {
            const url = element.getAttribute('data-url');
            const param = element.getAttribute('data-param');
            const value = encodeURIComponent(this.value);
            if (url && param && value) {
                getForm(url + '?' + encodeURIComponent(param) + '=' + value);
            }
        });
    });
});
