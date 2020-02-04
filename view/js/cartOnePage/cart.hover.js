$(document).ready(function () {
    $(".box_1").on("mouseenter", function () {
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {

                var products = JSON.parse(this.responseText);

                var container = document.getElementById('cartDivHover');
                container.innerHTML = "";

                for (var product in products) {

                    var div = document.createElement('div');
                    container.appendChild(div);

                    div.innerHTML = "<a href=\"article/view_one_artikel.php?id=" + products[product]['id'] + "\">" +
                        "<div class='search-result'>" + "<img class='search-result-img'" +
                        " src=view/images/" + products[product]['image_url'] + "><p class='search-result-p'>"
                        + products[product]['title'] + "<br/>" + "$" + products[product]['price'] +
                        "<br/>" + "Quantity: " + products[product]['quantity'] + "</p></div></a>"

                }

            }
        };
        xhttp.open("GET", "controlle/cart/on_hover_cart.php", true);
        xhttp.send();
    });
});