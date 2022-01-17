require('./bootstrap');

window.bootstrap = require('bootstrap');

window.sendDataAuthorized = async function (url = '', data = {}, method = 'POST') {
    let _token = document.getElementsByName('_token')[0].value; // from logout button

    let response;
    await fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _token,
        },
        body: JSON.stringify(data) // body data type must match "Content-Type" header
    }).then((response) => {
        if (response.status !== 200)
            return Promise.reject(response.json());
        return response.json(); // parses JSON response into native JavaScript objects
    }).then((json) => {
        response = json;
    }).catch((error) => {
        console.log(error);
        response = false;
    })
    return response;
}

window.sleep = function (ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
