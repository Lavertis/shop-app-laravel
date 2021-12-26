require('./bootstrap');

window.sendAddToBasketRequest = function (productId, quantity) {
    let _token = document.getElementsByName('_token')[0].value; // from logout button

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/basket/add');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(`${quantity} product(s) ${productId} added to basket`)
            // console.log(xhr.responseText);
        }
    };
    xhr.setRequestHeader('X-CSRF-TOKEN', _token);
    xhr.send(JSON.stringify({
        product_id: productId,
        quantity: quantity,
    }));
}

window.sendChangeBasketProductQuantityRequest = function (productId, quantity) {
    let _token = document.getElementsByName('_token')[0].value; // from logout button

    const xhr = new XMLHttpRequest();
    xhr.open('PATCH', '/basket/update');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(`Product ${productId} quantity changed to`, xhr.responseText);
        }
    };
    xhr.setRequestHeader('X-CSRF-TOKEN', _token);
    xhr.send(JSON.stringify({
        product_id: productId,
        quantity: quantity,
    }));
}

window.sleep = function (ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
