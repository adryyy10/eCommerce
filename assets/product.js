var elements = document.getElementsByClassName("item-row");

var updateProduct = function() {
    var productId = this.getAttribute("data-product-id");
    window.location.pathname = '/productForm/' + productId;
};

for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', updateProduct, false);
}



// document.addEventListener("click", function(event){
//     var targetElement = event.target;
//     console.log(targetElement);
// });