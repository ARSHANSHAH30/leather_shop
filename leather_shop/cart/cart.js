document.addEventListener("DOMContentLoaded", function () {
    fetch("../data/products.json")
      .then(response => response.json())
      .then(data => {
        loadCart(data.products);
      })
      .catch(error => console.error("Error loading products:", error));
});


updateCartUICount();    

function loadCart(products) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const cartBody = document.getElementById("cart-body");
    cartBody.innerHTML = "";
    let totalAmount = 0;
    if (cart.length === 0) {
        cartBody.innerHTML = `<tr><td colspan='5' style="text-align:center">Your Cart is Empty.</td></tr>`;
    } else {
        Object.keys(cart).forEach(item => {
            let product = products.find(p => p.id == item);
            if (product) {
                let itemTotal = product.price * cart[item];
                totalAmount += itemTotal;

                cartBody.innerHTML += `
                    <tr id="product-${item.id}">
                        <td>${product.name}</td>
                        <td>$${product.price}</td>
                        <td class="quantity">
                            <button onclick="updateQuantity('${item}', 'decrease')">-</button>
                            <input type="text" style="width: 30px; text-align: center;" value="${cart[item]}" readonly>
                            <button onclick="updateQuantity('${item}', 'increase')">+</button>
                        </td>
                        <td id="total-${item}">$${itemTotal}</td>
                        <td><button class="remove-btn" onclick="removeItem('${item}')">Remove</button></td>
                    </tr>`;
            }
        });
    }
    document.getElementById("total-amount").textContent = `$${totalAmount}`;
}

function updateQuantity(productId,action) {
    let cart = JSON.parse(localStorage.getItem("cart")) || {};
    let item = cart[productId] || 0;
   
    if (action == "increase") {
        item += 1;
    } else if (action == "decrease" && item > 1) {
        item -= 1;
    }

    cart[productId] =item

    localStorage.setItem("cart", JSON.stringify(cart));

    fetch("../data/products.json")
      .then(response => response.json())
      .then(data => loadCart(data.products));

    updateCartUICount();
  }

  function updateCartUICount() {
    var cart = JSON.parse(localStorage.getItem("cart")) || {};
    const cartCount = Object.values(cart).reduce((sum, count) => sum + count, 0);
    document.getElementById("cartVal").textContent = `Cart (${cartCount})`;
  }
  
  


function removeItem(id) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    
    if(cart[id]){
        delete cart[id];
    }

    console.log(cart);
    localStorage.setItem("cart", JSON.stringify(cart));

    fetch("../data/products.json")
      .then(response => response.json())
      .then(data => loadCart(data.products));

      updateCartUICount();
}
