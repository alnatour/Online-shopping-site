function removeFromCart(productId, productPrice) {
    $('#product-' + productId).remove();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.status == 404 && this.readyState == 4) {
            window.location.replace("../error/error_404.php");
        } else if (this.status == 200 && this.readyState == 4) {
            var currentQuantity = document.getElementById("product-" + productId + "-quantity");
            var items = document.getElementById("cartItems");
            items.innerHTML = parseInt(items.innerHTML) - parseInt(currentQuantity.innerHTML);
            var price = document.getElementById("cartTotalPrice");
            price.innerHTML = (parseFloat(price.innerHTML) - (productPrice * parseInt(currentQuantity.innerHTML))).toFixed(2);

            $('#product-' + productId).remove();

        }
    };
    xhttp.open("GET", "controlle/cart/remove_from_cart_controller.php?pid=" + productId, true);
    xhttp.send();
    window.location.reload();
}

