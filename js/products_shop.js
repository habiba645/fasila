document.addEventListener('DOMContentLoaded', () => {
    console.log('[DEBUG] DOMContentLoaded event fired.');

    // --- Attempt to get DOM elements ---
    console.log('[DEBUG] Attempting to get DOM elements (productGrid, loadingIndicator, noProductsMessage)...');
    const productGrid = document.getElementById('product-grid');
    const loadingIndicator = document.getElementById('loading-indicator');
    const noProductsMessage = document.getElementById('no-products-message');

    // --- Report on found DOM elements ---
    if (productGrid) {
        console.log('[DEBUG] productGrid element FOUND.');
    } else {
        console.error('[DEBUG] productGrid element NOT FOUND.');
    }
    if (loadingIndicator) {
        console.log('[DEBUG] loadingIndicator element FOUND.');
    } else {
        console.error('[DEBUG] loadingIndicator element NOT FOUND.');
    }
    if (noProductsMessage) {
        console.log('[DEBUG] noProductsMessage element FOUND.');
    } else {
        console.error('[DEBUG] noProductsMessage element NOT FOUND.');
    }

    // --- Constants ---
    const PRODUCTS_API_URL = 'products/get.php';
    const FALLBACK_IMAGE_URL = 'assets/pexels-ekrulila-2266851.jpg';
    console.log(`[DEBUG] PRODUCTS_API_URL set to: ${PRODUCTS_API_URL}`);
    console.log(`[DEBUG] FALLBACK_IMAGE_URL set to: ${FALLBACK_IMAGE_URL}`);


    async function fetchProducts() {
        console.log('[DEBUG] fetchProducts: Function called.');

        if (!productGrid || !loadingIndicator || !noProductsMessage) {
            console.error('[DEBUG] fetchProducts: One or more essential DOM elements missing. Aborting fetch.');
            if (loadingIndicator) loadingIndicator.style.display = 'none';
            if (noProductsMessage) noProductsMessage.style.display = 'flex';
            if (productGrid) productGrid.innerHTML = '<div class="col-12"><div class="alert alert-warning">Page setup error. Essential elements missing.</div></div>';
            return [];
        }

        console.log(`[DEBUG] fetchProducts: About to fetch from URL: ${PRODUCTS_API_URL}`);
        try {
            const response = await fetch(PRODUCTS_API_URL);
            console.log('[DEBUG] fetchProducts: Fetch request completed. Response status:', response.status, response.statusText); // Added statusText

            if (!response.ok) { // Checks for 200-299 status codes
                let errorText = `HTTP error! Status: ${response.status} ${response.statusText}`;
                try {
                    // Try to parse error response as JSON, as our PHP might send structured errors
                    const errorData = await response.json();
                    errorText = (errorData.error || errorData.message) ? `${errorData.error || ''} ${errorData.message || ''}`.trim() : errorText;
                    console.warn('[DEBUG] fetchProducts: HTTP error, parsed error data from JSON:', errorData);
                } catch (e) {
                    // If JSON parsing fails, try to get plain text from the response
                    const plainTextError = await response.text();
                    if (plainTextError) errorText += ` - Response: ${plainTextError.substring(0,150)}...`;
                    console.warn('[DEBUG] fetchProducts: HTTP error, could not parse error data as JSON. Raw text snippet:', plainTextError.substring(0, 150) + "...");
                }
                throw new Error(errorText);
            }

            const data = await response.json();
            console.log('[DEBUG] fetchProducts: Successfully parsed response JSON.');

            // Check if the successfully parsed JSON is actually a structured error message from our PHP
            if (data && typeof data === 'object' && data.error) {
                console.error("[DEBUG] fetchProducts: Server-side error reported in JSON:", data.details || data.error);
                let detailedErrorMessage = data.error;
                if (data.details) { // 'details' was used in your PHP's PDO catch
                    detailedErrorMessage += `: ${data.details}`;
                } else if (data.debug_details) { // For other errors if you add it
                     detailedErrorMessage += `: ${data.debug_details}`;
                }
                throw new Error(detailedErrorMessage);
            }

            if (!Array.isArray(data)) {
                console.error("[DEBUG] fetchProducts: API did not return an array of products. Data received:", data);
                throw new Error("Received unexpected data format from server.");
            }

            console.log(`[DEBUG] fetchProducts: Success. Returning ${data.length} products.`);
            return data;

        } catch (error) { // This catches errors from fetch itself, response.ok, response.json(), or thrown errors
            console.error('[DEBUG] fetchProducts: CATCH block. Error during fetch or processing:', error.message, error);
            if (loadingIndicator) loadingIndicator.style.display = 'none';
            if (productGrid) productGrid.innerHTML = `<div class="col-12"><div class="alert alert-danger">Could not load products: ${error.message}. Check console.</div></div>`;
            if (noProductsMessage) noProductsMessage.style.display = 'none';
            return [];
        }
    }

    function createProductCard(product) {
        const col = document.createElement('div');
        col.classList.add('col');
        const productName = product.name || 'Unnamed Plant';
        const productPrice = product.price ? parseFloat(product.price).toFixed(2) : '0.00';
        const imageUrl = product.img_url && product.img_url.trim() !== '' ? product.img_url : FALLBACK_IMAGE_URL;
        const productDescription = product.description || '';

        col.innerHTML = `
            <div class="card h-100 product-card">
                <img src="${imageUrl}" class="product-image" alt="${productName}" onerror="this.onerror=null;this.src='${FALLBACK_IMAGE_URL}'; console.warn('[DEBUG] Image load error for ${productName}, using fallback.');">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title lobster-regular">${productName}</h5>
                    <p class="card-text text-muted small mb-2">${productDescription.substring(0, 60)}${productDescription.length > 60 ? '...' : ''}</p>
                    <p class="product-price mb-3">$${productPrice}</p>
                    <button
                        class="btn btn-primary-action btn-add-to-cart mt-auto"
                        data-product-id="${product.id}"
                        data-product-name="${productName}">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                </div>
            </div>
        `;
        return col;
    }

    async function renderProducts() {
        console.log('[DEBUG] renderProducts: Function called.');
        const products = await fetchProducts();
        console.log('[DEBUG] renderProducts: fetchProducts returned. Number of products:', products ? products.length : 'null/undefined');

        if (loadingIndicator) {
            console.log('[DEBUG] renderProducts: Hiding loadingIndicator.');
            loadingIndicator.style.display = 'none';
        }

        if (!productGrid) {
            console.error("[DEBUG] renderProducts: Product grid element not found. Cannot render.");
            return;
        }
        productGrid.innerHTML = '';
        console.log('[DEBUG] renderProducts: Product grid cleared.');

        if (!products || products.length === 0) {
            console.log('[DEBUG] renderProducts: No products to display or products array is empty.');
            if (noProductsMessage && productGrid.innerHTML === '') {
                console.log('[DEBUG] renderProducts: Displaying noProductsMessage.');
                noProductsMessage.style.display = 'flex';
            }
            return;
        }

        if (noProductsMessage) {
            console.log('[DEBUG] renderProducts: Hiding noProductsMessage (as products are available).');
            noProductsMessage.style.display = 'none';
        }

        console.log('[DEBUG] renderProducts: Looping through products to create cards...');
        products.forEach(product => {
            const cardElement = createProductCard(product);
            productGrid.appendChild(cardElement);
        });
        console.log('[DEBUG] renderProducts: All product cards appended.');

        attachAddToCartListeners();
    }

    function updateCartBadge(totalItems) {
        console.log(`[DEBUG] updateCartBadge: Called with totalItems: ${totalItems}`);
        const badgeGuest = document.getElementById('cart-badge-guest');
        const badgeProfile = document.getElementById('cart-badge-profile');
        const badgeDropdown = document.getElementById('cart-badge-dropdown');
        const displayValue = totalItems > 0 ? totalItems.toString() : '0';
        const shouldDisplay = totalItems > 0;

        if (badgeGuest) { badgeGuest.textContent = displayValue; badgeGuest.style.display = shouldDisplay ? '' : 'none'; }
        if (badgeProfile) { badgeProfile.textContent = displayValue; badgeProfile.style.display = shouldDisplay ? '' : 'none'; }
        if (badgeDropdown) { badgeDropdown.textContent = displayValue; }
    }

    function attachAddToCartListeners() {
        console.log('[DEBUG] attachAddToCartListeners: Function called.');
        const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
        console.log(`[DEBUG] attachAddToCartListeners: Found ${addToCartButtons.length} 'Add to Cart' buttons.`);
        const cartHandlerUrl = 'cart_handler.php';

        addToCartButtons.forEach(button => {
            if (button.dataset.listenerAttached === 'true') {
                return;
            }

            button.addEventListener('click', async function handler() {
                const productId = this.dataset.productId;
                console.log(`[DEBUG] attachAddToCartListeners: 'Add to Cart' clicked for product ID: ${productId}`);
                const productName = this.dataset.productName;
                const originalButtonHTML = this.innerHTML;

                this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...';
                this.disabled = true;

                try {
                    const formData = new FormData();
                    formData.append('action', 'add');
                    formData.append('product_id', productId);

                    console.log(`[DEBUG] attachAddToCartListeners: Fetching from cart_handler.php for product ID: ${productId}`);
                    const response = await fetch(cartHandlerUrl, { method: 'POST', body: formData });
                    console.log(`[DEBUG] attachAddToCartListeners: Cart handler response status: ${response.status} for product ID: ${productId}`);

                    if (!response.ok) {
                        let errorDetail = `HTTP error! Status: ${response.status} ${response.statusText}`;
                        try { const errData = await response.json(); errorDetail = (errData.message || errData.error) ? `${errData.error || ''} ${errData.message || ''}`.trim() : errorDetail; } catch(e){}
                        throw new Error(errorDetail);
                    }

                    const data = await response.json();
                    console.log(`[DEBUG] attachAddToCartListeners: Cart handler response data:`, data);

                    if (data.success) {
                        this.innerHTML = '<i class="fas fa-check me-2"></i> Added!';
                        this.classList.remove('btn-primary-action');
                        this.classList.add('btn-success');
                        updateCartBadge(data.cart_total_items);

                        setTimeout(() => {
                            this.innerHTML = originalButtonHTML;
                            this.classList.remove('btn-success');
                            this.classList.add('btn-primary-action');
                            this.disabled = false;
                        }, 2000);
                    } else {
                        this.innerHTML = originalButtonHTML;
                        this.disabled = false;
                        alert(`Failed to add ${productName}: ${data.message || 'Unknown error'}`);
                    }
                } catch (error) {
                    console.error(`[DEBUG] attachAddToCartListeners: CATCH block. Error adding product ID ${productId} to cart:`, error.message, error);
                    this.innerHTML = originalButtonHTML;
                    this.disabled = false;
                    alert(`Error adding ${productName}. ${error.message}. Please try again.`);
                }
            });
            button.dataset.listenerAttached = 'true';
        });
    }

    // --- Initial call to render products ---
    console.log('[DEBUG] About to check if productGrid exists for initial render call...');
    if (productGrid) {
       console.log('[DEBUG] productGrid exists. Calling renderProducts().');
       renderProducts();
    } else {
        console.error("[DEBUG] Initial Call: Product grid element not found. Cannot render products.");
        if (loadingIndicator) loadingIndicator.style.display = 'none';
        if (noProductsMessage) noProductsMessage.style.display = 'flex';
    }
    console.log('[DEBUG] End of DOMContentLoaded script execution.');
});