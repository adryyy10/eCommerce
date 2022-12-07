// GO TO PRODUCT'S PROFILE
var products = document.getElementsByClassName('item-content');

var profileProduct = function(){
    var $productId = this.getAttribute('data-product-id');
    window.location.pathname = '/product/' + $productId;
};

for (var i = 0; i < products.length; i++) {
    products[i].addEventListener('click', profileProduct, false);
}

console.log("HEHE");