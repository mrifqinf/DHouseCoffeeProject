// MAIN VARIABELS LIBRARY
// MAIN COMPONENT
const searchForm = document.querySelector('.search-form');     // COMPONENT BOX SEARCH FORM
const navbarNav = document.querySelector('.navbar-nav');       // COMPONENT NAVBAR NAVIGATION
const shoppingCart = document.querySelector('.shopping-cart'); // COMPONENT SHOPPING CART
const hmenus = document.querySelector('#hmenu');               // COMPONENT HAMBURGERS MENU
// ALL VARIABLES INPUT
const searchBox = document.querySelector('#search-box');    // INPUT BOX SEARCH FORM
const pinAdding = document.querySelector('#pin');           // INPUT PIN FROM USER
const inputName = document.querySelector('#productName');   // INPUT PRODUCT NAME 
const inputPrice = document.querySelector('#productPrice'); // INPUT PRODUCT PRICE
const inputDesc = document.querySelector('#productDesc');   // INPUT PRODUCT DESCRIPTION
const inputPhoto = document.querySelector('#photo');        // INPUT PRODUCT PHOTO URL
// ALL VARIABLES MODAL
const modalCont = document.querySelectorAll('.modal');                 // MODAL DETAIL PRODUCT
const modalAdding = document.querySelector('#addproduct-modal');       // MODAL INPUT PIN 
const modalAddProduct = document.querySelector('#addproduct-modal-2'); // MODAL ADD NEW PRODUCT
// ALL VARIABLES BUTTON
const searchbt = document.querySelector('#search-button');               // BUTTON FOR SEARCHING
const shopCart = document.querySelector('#shopping-cart');               // BUTTON FOR SHOPPING CART
const buttonDetails = document.querySelectorAll('.detail-modal');        // BUTTON OPEN DETAIL PRODUCT
const buttonCloseDetails = document.querySelectorAll('.close-button');   // BUTTON CLOSE DETAIL PRODUCT
const buttonAdding = document.querySelector('.addproduct-modal');        // BUTTON OPEN PIN VALIDATION
const buttonCloseAdding = document.querySelector('.close-button-2');     // BUTTON CLOSE PIN VALIDATION
const buttonPinValidation = document.querySelector('#buttonSubmitAdd');  // BUTTON PIN VALIDATION
const buttonCloseAddProd = document.querySelector('.close-button-3');    // BUTTON CLOSE ADD NEW PRODUCT
// ALL OTHERS VARIABLES 
const registeredPins = ['0001', '251004', '777']; // ARRAY OF REGISTERED PINS

// JS FOR CLOSE ALL WITH ESCAPE KEY START //
window.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        modalAdding.style.display = 'none';
        modalAddProduct.style.display = 'none';
        modalCont.forEach(modal => {
            modal.style.display = 'none';
        });
        navbarNav.classList.remove('active');
        searchForm.classList.remove('active');
        shoppingCart.classList.remove('active');
        pinAdding.value = '';
        inputName.value = '';
        inputPrice.value = '';
        inputDesc.value = '';
        inputPhoto.value = '';
    }
});
// JS FOR CLOSE ALL WITH ESCAPE KEY END //

// FUNCTIONS OPEN START//
// HMENU
document.querySelector('#hmenu').onclick = () => {
    navbarNav.classList.toggle('active');
}
// SEARCH FORM
document.querySelector('#search-button').onclick = () => {
    searchForm.classList.toggle('active');
    searchBox.focus();
}
// SHOPPING CART
document.querySelector('#shopping-cart').onclick = () => {
    shoppingCart.classList.toggle('active');
}
// MODAL ITEM DETAIL
buttonDetails.forEach(link => {
    link.addEventListener('click', () => {
        const modalId = link.getAttribute('data-modal-id');
        const modal = document.getElementById(`detail-modal${modalId}`);
        modal.style.display = 'flex';
    });
});
// PIN MODAL
buttonAdding.onclick = () => {
    modalAdding.style.display = 'flex';
    pinAdding.focus();
}
// FUNCTIONS OPEN END //

// FUNCTIONS CLOSE START //
// MODAL ITEM DETAIL
buttonCloseDetails.forEach(link => {
    link.addEventListener('click', () => {
        const modalId = link.getAttribute('data-modal-id');
        const modal = document.getElementById(`detail-modal${modalId}`);
        modal.style.display = 'none';
    });
});
// PIN MODAL
buttonCloseAdding.onclick = () => {
    modalAdding.style.display = 'none';
    pinAdding.value = '';
}
// ADD PRODUCT MODAL
buttonCloseAddProd.onclick = () => {
    modalAddProduct.style.display = 'none';
    inputName.value = '';
    inputPrice.value = '';
    inputDesc.value = '';
    inputPhoto.value = '';
}
// FUNCTIONS CLOSE END //

// FUNCTIONS CLOSE CLICK ANYWHERE START //
// HMENU
document.addEventListener('click', function (e) {
    if (!hmenus.contains(e.target) && !navbarNav.contains(e.target)) {
        navbarNav.classList.remove('active');
    }
})
// SEARCH FORM
document.addEventListener('click', function (e) {
    if (!searchbt.contains(e.target) && !searchForm.contains(e.target)) {
        searchForm.classList.remove('active');
    }
})
// SHOPPING CART
document.addEventListener('click', function (e) {
    if (!shopCart.contains(e.target) && !shoppingCart.contains(e.target)) {
        shoppingCart.classList.remove('active');
    }
})
// MODAL DETAIL
modalCont.forEach(modal => {
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
// FUNCTIONS CLOSE CLICK ANYWHERE END //

// VALIDATION PIN #1
// buttonPinValidation.onclick = () => {
//     if (pinAdding.value.trim() === "251004") {
//         modalAddProduct.style.display = 'flex';
//         inputName.focus();
//         modalAdding.style.display = 'none';
//         event.preventDefault();
//         pinAdding.value = '';
//     } else {
//         alert("Wrong PIN, please try again");
//         event.preventDefault();
//         pinAdding.value = '';
//         pinAdding.focus();
//     }
// }

// VALIDATION PIN #2
buttonPinValidation.addEventListener('click', function() {
    const userEnteredPin = pinAdding.value;
    if (userEnteredPin === '') {
      alert('PIN cannot be empty');
    } else if (userEnteredPin % 1 !== 0 || userEnteredPin < 0) {
      alert('PIN must be a whole number and greater than 0');
    } else if (registeredPins.includes(userEnteredPin)) {
        modalAddProduct.style.display = 'flex';
        inputName.focus();
        modalAdding.style.display = 'none';
        event.preventDefault();
        pinAdding.value = '';
    } else {
        alert("Wrong PIN, please try again");
        event.preventDefault();
        pinAdding.value = '';
        pinAdding.focus();
    }
});