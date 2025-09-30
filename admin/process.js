
// Get the checkbox element
var flexSwitchCheckDefault1 = document.getElementById('flexSwitchCheckDefault1');

var form = new FormData();
// Add an event listener for 'change' event
flexSwitchCheckDefault1.addEventListener('change', function () {
    if (this.checked) {
        form.append("query","UPDATE `admins` SET `logged` = 1  WHERE `code` === ;")
        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.status === 200 & request.readyState === 4) {

            }
        }
        request.open();
        request.send();
    } else {
        console.log('Checkbox is not checked');
    }
});

// Get the checkbox element
var flexSwitchCheckDefault2 = document.getElementById('flexSwitchCheckDefault2');

// Add an event listener for 'change' event
flexSwitchCheckDefault2.addEventListener('change', function () {
    if (this.checked) {
        console.log('Checkbox is checked');
    } else {
        console.log('Checkbox is not checked');
    }
});

var flexSwitchCheckDefault3 = document.getElementById('flexSwitchCheckDefault3');

flexSwitchCheckDefault3.addEventListener('change', function () {
    if (this.checked) {
        console.log('Checkbox is checked');
    } else {
        console.log('Checkbox is not checked');
    }
});

var flexSwitchCheckDefault4 = document.getElementById('flexSwitchCheckDefault4');

flexSwitchCheckDefault4.addEventListener('change', function () {
    if (this.checked) {
        console.log('Checkbox is checked');
    } else {
        console.log('Checkbox is not checked');
    }
});

// Get the checkbox element
var flexSwitchCheckDefault5 = document.getElementById('flexSwitchCheckDefault5');

// Add an event listener for 'change' event
flexSwitchCheckDefault5.addEventListener('change', function () {
    if (this.checked) {
        console.log('Checkbox is checked');
    } else {
        console.log('Checkbox is not checked');
    }
});
