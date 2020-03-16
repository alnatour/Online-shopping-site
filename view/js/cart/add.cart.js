function addToCart(productId, productPrice) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.status == 500 && this.readyState == 4) {
            window.location.replace("../error/error_500.php");
        } else if (this.status == 404 && this.readyState == 4) {
            window.location.replace("../error/error_404.php");
        } else if (this.status == 200 && this.readyState == 4) {
            var items = document.getElementById("cartItems");
            items.innerHTML = parseInt(items.innerHTML) + 1;
            var price = document.getElementById("cartTotalPrice");
            price.innerHTML = (parseFloat(price.innerHTML) + productPrice).toFixed(2);

            var price2 = document.getElementById("cartTotalPrice2");
            price2.innerHTML = (parseFloat(price2.innerHTML) + productPrice).toFixed(2);
        }
    };

    xhttp.open("GET", "controlle/cart/add_to_cart_controller.php?pid=" + productId + "&pqty=" + 1, true);
    xhttp.send();
    alert('The item was added to Cart');
}

function addToCartSingle(productId, productPrice) {
    var xhttp = new XMLHttpRequest();
    var quantity = parseInt(document.getElementById("buyQuantity").value);
    xhttp.onreadystatechange = function () {
        if (this.status == 500 && this.readyState == 4) {
            window.location.replace("../error/error_500.php");
        } else if (this.status == 404 && this.readyState == 4) {
            window.location.replace("../error/error_404.php");
        } else if (this.status == 200 && this.readyState == 4) {
            var items = document.getElementById("cartItems");
            items.innerHTML = parseInt(items.innerHTML) + quantity;
            var price = document.getElementById("cartTotalPrice");
            price.innerHTML = (parseFloat(price.innerHTML) + (productPrice * quantity)).toFixed(2);
        }
    };
    xhttp.open("GET", "controlle/cart/add_to_cart_controller.php?pid=" + productId + "&pqty=" + quantity, true);
    xhttp.send();
}