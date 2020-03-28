//For index page
$(document).ready(function () {
    $(".box_1").on("mouseenter", function () {
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
    });
});

//For Single page
$(document).ready(function () {
    $(".box_1").on("mouseenter", function () {
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {

                var products = JSON.parse(this.responseText);

                var container = document.getElementById('cartDivHover2');
                container.innerHTML = "";

                for (var product in products) {

                    var div = document.createElement('div');
                    container.appendChild(div);

                    div.innerHTML = "<table class='cart-table'><tbody><tr style='border-bottom:1px solid #000'><td class='si-pic'><a href=\"single.php?id=" + products[product]['id'] + "\"><img src='../../public/uploads/productImages/" 
                    + products[product]['image_url'] +"'  width='70' ></a></td><td class='si-text'><div class='product-selected'><p> $ " + products[product]['price'] + " * <span id='product-"+products[product]['quantity']+"-quantity'> " + products[product]['quantity'] + "</span></p><h6>"+ products[product]['title'] +
                    "</h6></div></td></tr></tbody></table>"

                }

            }
        };
        xhttp.open("GET", "../../controlle/cart/on_hover_cart.php", true);
        xhttp.send();
    });
});

//For cart-panel page
$(document).ready(function () {
    $(".box_1").on("mouseenter", function () {
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {

                var products = JSON.parse(this.responseText);

                var container = document.getElementById('cartDivHover2');
                container.innerHTML = "";

                for (var product in products) {

                    var div = document.createElement('div');
                    container.appendChild(div);

                    div.innerHTML = "<table class='cart-table'><tbody><tr style='border-bottom:1px solid #000'><td class='si-pic'><a href=\"single.php?id=" + products[product]['id'] + "\"><img src='../../../public/uploads/productImages/" 
                    + products[product]['image_url'] +"'  width='70' ></a></td><td class='si-text'><div class='product-selected'><p> $ " + products[product]['price'] + " * <span id='product-"+products[product]['quantity']+"-quantity'> " + products[product]['quantity'] + "</span></p><h6>"+ products[product]['title'] +
                    "</h6></div></td></tr></tbody></table>"

                }

            }
        };
        xhttp.open("GET", "../../../controlle/cart/on_hover_cart.php", true);
        xhttp.send();
    });
});
