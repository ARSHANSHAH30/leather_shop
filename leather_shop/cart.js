let cart = JSON.parse(localStorage.getItem("cart")) || {};
updateCartUI();

function addToCart(productId,btn) {
  cart[productId] = (cart[productId] || 0) + 1;
  localStorage.setItem("cart", JSON.stringify(cart));
  // btn.textContent = "Added to Cart";
  updateCartUI();
}

function removeFromCart(productId) {
  if (cart[productId]) {
    cart[productId]--;
    if (cart[productId] === 0) {
      delete cart[productId];
    }
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartUI();
  }
}

function updateCartUI() {
  const cartCount = Object.values(cart).reduce((sum, count) => sum + count, 0);
  document.getElementById("cartVal").textContent = `Cart (${cartCount})`;
}
