// GO TO CREATE BASKET / ADD NEW PRODUCT TO BASKET
var addBasket = document.getElementById("add-to-basket");

if (addBasket !== null) {
    addBasket.addEventListener('click', function(){
        var productId = this.getAttribute("data-product-id");
        window.location.pathname = '/add-basket/' + productId;
    }, false)
}