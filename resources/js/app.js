require('./bootstrap');

window.addToBasket = function (productId, quantity) {
    let _token = document.getElementsByName('_token')[0].value; // from logout button

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/basket/add');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Product added to basket')
            console.log(xhr.responseText);
        }
    };
    xhr.setRequestHeader('X-CSRF-TOKEN', _token);
    xhr.send(JSON.stringify({
        product_id: productId,
        quantity: quantity,
    }));
}
