function addToCart(productId, quantity) {
    fetch('addToCart.php', {
        method: 'POST',
        body: JSON.stringify({ productId, quantity }),
        headers: { 'Content-Type': 'application/json' }
    }).then(response => response.json())
    .then(data => {
        console.log(data);
        // Optionally, refresh cart drawer content here
    }).catch(error => console.error('Error:', error));
}

function toggleCartDrawer() {
    const drawer = document.getElementById('cartDrawer');
    drawer.classList.toggle('open'); // This toggles the open class to slide in/out the drawer
}



function closeCartDrawer() {
    const drawer = document.getElementById('cartDrawer');
    drawer.classList.remove('open');
}

function toggleCartDrawer() {

    
    const drawer = document.getElementById('cartDrawer');
    const cartContents = document.getElementById('cartContents'); // Ensure this element exists in your HTML

    drawer.style.display = drawer.style.display === 'none' ? 'block' : 'none';

    fetch('getCartContents.php')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                let total = 0;
                let itemsHtml = data.map(item => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    return `
                        <div class="cart-item">
                            <img src="images/${item.image}" alt="${item.name}" class="cart-item-image">
                            <div class="cart-item-info">
                                <div class="cart-item-name">${item.name}</div>
                                <div class="cart-item-price">$${item.price}</div>
                                <div class="cart-item-quantity">Quantity: ${item.quantity}</div>
                                <div class="item-total">Total: $${itemTotal.toFixed(2)}</div>
                            </div>
                            <button onclick="removeFromCart(${item.id})" class="remove-item-btn">&times;</button>
                        </div>
                    `;
                }).join('');

                itemsHtml += `<div class="cart-total">Cart Total: $${total.toFixed(2)}</div>`;
                itemsHtml += `<button onclick="location.href='checkout.php'" class="checkout-button">Proceed to Checkout</button>`;
                
                cartContents.innerHTML = itemsHtml;
            } else {
                cartContents.innerHTML = '<div style="text-align:center; margin-top:20px;">Cart Is Empty!!</div>';
            }
        })
        .catch(error => console.error('Error:', error));
}







function closeCartDrawer() {
    const drawer = document.getElementById('cartDrawer');
    drawer.style.display = 'none';
}



function removeFromCart(productId) {
    fetch('removeFromCart.php', {
        method: 'POST',
        body: JSON.stringify({ productId }),
        headers: { 'Content-Type': 'application/json' }
    }).then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            // Optionally, refresh cart drawer content here
            toggleCartDrawer(); // Close and reopen the drawer to refresh the content
            toggleCartDrawer();
        } else {
            alert('Error removing item');
        }
    }).catch(error => console.error('Error:', error));
}



document.addEventListener("DOMContentLoaded", function() {
    const testimonials = document.querySelectorAll(".testimonial");
    let currentTestimonialIndex = 0;

    function showTestimonial(index) {
        testimonials.forEach(testimonial => {
            testimonial.style.transform = `translateX(-${index * 100}%)`;
        });
    }

    function showNextTestimonial() {
        currentTestimonialIndex++;
        if (currentTestimonialIndex >= testimonials.length) {
            currentTestimonialIndex = 0;
        }
        showTestimonial(currentTestimonialIndex);
    }

    function showPrevTestimonial() {
        currentTestimonialIndex--;
        if (currentTestimonialIndex < 0) {
            currentTestimonialIndex = testimonials.length - 1;
        }
        showTestimonial(currentTestimonialIndex);
    }

    document.querySelector(".next-btn").addEventListener("click", showNextTestimonial);
    document.querySelector(".prev-btn").addEventListener("click", showPrevTestimonial);
});


   