document.addEventListener("DOMContentLoaded", function () {
    fetch("data/products.json")
      .then((response) => response.json())
      .then((data) => {
        displayProducts(data.products);
      })
      .catch((error) => console.error("Error loading products:", error));
  });
  
  function displayProducts(products) {
    const productGrid = document.querySelector(".product-grid");
    productGrid.innerHTML = "";
  
    products.forEach((product) => {
      const productHTML = `
        <div class="product-item" data-id="${product.id}">
          <img src="${product.image}" alt="${product.name}">
          <p>${product.name}</p>
          <span>$${product.price}</span>
          <button class="btn add-to-cart" data-id="${product.id}">Add to Cart</button>
        </div>
      `;
      productGrid.innerHTML += productHTML;
    });
  
    document.querySelectorAll(".add-to-cart").forEach((btn) => {
      btn.addEventListener("click", function () {
        addToCart(this.dataset.id,this);
      });
    });
  }
  