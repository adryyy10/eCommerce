/** UPDATE LOGIC */
var elements = document.getElementsByClassName("item-row");

var updateProduct = function() {
    var productId = this.getAttribute("data-product-id");
    window.location.pathname = '/productForm/' + productId;
};

for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', updateProduct, false);
}

/** REMOVE PRODUCT LOGIC */
var removeButton = document.getElementById("remove-button");

if (removeButton !== null) {
    removeButton.addEventListener('click', function(){
        var productId = this.getAttribute("data-product-id");
        window.location.pathname = '/removeProduct/' + productId;
    }, false)
}