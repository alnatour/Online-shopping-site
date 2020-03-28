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
       
        }
    };

    xhttp.open("GET", "controlle/cart/add_to_cart_controller.php?pid=" + productId + "&pqty=" + 1, true);
    xhttp.send();

    // show cart List after add
    $('#cartDivHover').addClass("cartdisplay");

    if ( $("#cartDivHover").hasClass("cartdisplay") ) {
   
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {

                var products = JSON.parse(this.responseText);

                var container = document.getElementById('cartDivHover2');
                container.innerHTML = "";

                for (var product in products) {

                    var div = document.createElement('div');
                    container.appendChild(div);

                    div.innerHTML = "<table id='product-"+products[product]['id']+"' class='cart-table'><tbody><tr style='border-bottom:1px solid #000'><td class='si-pic'><a href=\"view/main/single.php?id=" + products[product]['id'] + "\"><img src='public/uploads/productImages/" 
                    + products[product]['image_url'] +"'  width='70' ></a></td><td class='si-text'><div class='product-selected'><p> $ " + (products[product]['price']-((products[product]['price']*products[product]['discount'])/100)).toFixed(2) + " * <span id='product-"+products[product]['quantity']+"-quantity'> " + products[product]['quantity'] + "</span></p><h6>"+ products[product]['title'] +
                    "</h6></div></td><td><a href='#' onclick='removeFromCart(" + products[product]['id']+ "," + (products[product]['price']-((products[product]['price']*products[product]['discount'])/100)).toFixed(2) + ")'><i class='fa fa-times text-danger'></i></a></td></tr></tbody></table>"

                }
            }
        };
        xhttp.open("GET", "controlle/cart/on_hover_cart.php", true);
        xhttp.send();
    };

    setTimeout(function(){ 
        $("#cartDivHover").removeClass("cartdisplay")
    }, 1000);
 
}

function addToCartSingle(productId, productPrice) {
    var xhttp = new XMLHttpRequest();
    var quantity = parseInt(document.getElementById("buyQuantity").value);
    if (quantity <= 0) {
        alert('quantity is false');
        throw new Error("Stopping the function!");
    }
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
    xhttp.open("GET", "../../controlle/cart/add_to_cart_controller.php?pid=" + productId + "&pqty=" + quantity, true);
    xhttp.send();
}