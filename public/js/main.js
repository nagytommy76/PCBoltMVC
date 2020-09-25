
//const urlRoot = 'http://localhost/PCBoltMVC/';
// Init search
//const search = new Search();
// Init Create text
//const cText = new CreateText(urlRoot);

// ====================================================================================
// ++                           IMPORT SEARCH FUNCTIONS                              ++
// ====================================================================================
import Search from '/PCBoltMVC/js/search.js';

import CreateText from '/PCBoltMVC/js/createOutputText.js';

import CookieQuery from '/PCBoltMVC/js/cartFunctions/cookieQuery.js';

// ====================================================================================
// ++                           IMPORT CART FUNCTIONS                                ++
// ====================================================================================

import cookie from '/PCBoltMVC/js/cartFunctions/cookie.js';

import ModalCartText from '/PCBoltMVC/js/cartFunctions/modalCartText.js';

import CartFunctions from '/PCBoltMVC/js/cartFunctions/cartFunctions.js';

// ====================================================================================
// ++                           IMPORT FILER FUNCTIONS                               ++
// ====================================================================================

import CreateFilterOutputText from '/PCBoltMVC/js/filterFunctions/createFilterOutputText.js';


// TESZT
// ===============================================================================================
// ===                                  SEARCH FUNCTIONS                                       ===
// ===============================================================================================

// ==================================================================================================
// ------------------------------ GET THE MANUFACTURERS ---------------------------------------------
// ==================================================================================================

// Get the search modal output
const modalOutput = document.getElementById('modalOutput');
const searchModal = document.getElementById('searchModal');

document.getElementById("category").addEventListener('change', () => {
    let man = document.getElementById('manufacture');
    const category = document.getElementById("category").value;

   //console.log(category)
   switch(category){
       case 'ram':
            /*search.*/Search.productsManufacturers(category)
            .then(response => {
                /*cText.*/CreateText.createManOptions(response,man);
            })
            .catch(err => console.log(err));
       break;
        case 'motherboard' :
            /*search.*/Search.productsManufacturers('mb')
            .then(response => {
                /*cText.*/CreateText.createManOptions(response,man);
            })
            .catch(err => console.log(err));
        break;
        case 'vga':
            /*search.*/Search.productsManufacturers(category)
            .then(response => {
                /*cText.*/CreateText.createManOptions(response, man);
            })
            .catch(error =>console.log(error));
        break;
        case 'cpu' :
            man.innerHTML = '<option value="">Nincs megadva</option>';
            man.innerHTML += `
                <option value="amd">AMD</option>
            `;
            man.innerHTML += `
                <option value="intel">Intel</option>
            `;
        break;
   }
});

// ==================================================================================================
// ------------------------------ GET THE RESULT IN SEARCH ------------------------------------------
// ==================================================================================================

document.getElementById('modalInput').addEventListener('keyup',() => {
    // Modal inputs--------------------------
    const selectedMan = document.getElementById('manufacture').value;
    const selectedCategory = document.getElementById('category').value;
    const input = document.querySelector('#modalInput').value;
    
    /*search.*/Search.showSearch(selectedMan,selectedCategory,input)
    .then(response => {
        CookieQuery.getSessionEmail().then(email =>{
           //console.log(response);
            if (input === '') {
                modalOutput.innerHTML = '';
            }else{
                modalOutput.innerHTML = '';
                switch (selectedCategory) {
                    case 'cpu':
                        modalOutput.append(/*cText.*/CreateText.textForSearchModal(response, email));
                        break;
                    case 'motherboard':
                        modalOutput.append(/*cText.*/CreateText.textForSearchModal(response, email));
                        break;
                    case 'ram':
                        modalOutput.append(/*cText.*/CreateText.textForSearchModal(response,email));
                        break;
                    case 'vga':
                        modalOutput.append(/*cText.*/CreateText.textForSearchModal(response, email))
                        break;
                }            
            }
        })
        
    })
    .catch(err => console.log(err));
});

// ==================================================================================================
// ------------------------------ ADD TO CART IN SEARCH MODAL ---------------------------------------
// ==================================================================================================

searchModal.addEventListener('click', (e) =>{
    //console.log(e.target);
    if (e.target.type === 'button' && e.target.id === 'addToCartInSearch') {
        //console.log(e.target.name);
        CookieQuery.getSessionEmail()
        .then(email => {
            if (email === e.target.name.split('_')[1]) {
                const productFlashOutput = document.querySelector('#'+e.target.value);
                if (e.target.value === productFlashOutput.id) {
                    if (document.querySelector('#flashMessage') === null) {
                        if (email === 'EmailNotSet') {
                            productFlashOutput.append(/*cText.*/CreateText.flashMessageInModal('A vásárláshoz be kell jelentkezni!', 'danger'));
                            /*cText.*/CreateText.destroyFlashMessageInSearchModal(productFlashOutput);
                        }else if(email === 'DataRequired'){
                            productFlashOutput.append(/*cText.*/CreateText.flashMessageInModal('A vásárláshoz ki kell tölteni az adatait!', 'danger'));
                            /*cText.*/CreateText.destroyFlashMessageInSearchModal(productFlashOutput);
                        }else{
                            cookie.setCookie(e.target.name,e.target.value,1);
                            productFlashOutput.append(/*cText.*/CreateText.flashMessageInModal('A termék sikeresen hozzáadva kosárhoz!'));
                            /*cText.*/CreateText.destroyFlashMessageInSearchModal(productFlashOutput);
                        }
                    }
                }
            }
        })
    }
})


// ==================================================================================================
// ===                                      CART FUNCTIONS                                        ===
// ==================================================================================================

const addToCart = document.querySelectorAll("#addToCart");
const cartOutput = document.querySelector("#modalCartOutput");
const cartPriceOutput = document.querySelector("#modalCartPrice");
const cartBTN = document.getElementById('cartBTN');
const cartModal = document.querySelector('#cartModal');

// Cookie
// const cookie = new Cookie();

addToCart.forEach((e) =>{
    let priceSum = 0;
    e.addEventListener('click', () =>{  
        CookieQuery.getSessionEmail()
        .then(email => {
            if (email === 'EmailNotSet') {
                cartOutput.append(ModalCartText.emptyCartText('A Vásárláshoz be kell jelentkezni'));
            } else if(email === 'DataRequired'){
                cartOutput.append(ModalCartText.emptyCartText('Vásárláshoz ki kell tölteni a szállítási adatokat'));
            }else {
                cookie.setCookie(e.name,e.value,1);
                CookieQuery.queryCartItems()
                    .then(response => {
                        cartOutput.innerHTML = '';
                        response.forEach(res =>{
                            if (email === res.sessEmail) {
                                priceSum += parseInt(res.price * res.quantity);
                                cartOutput.append(ModalCartText.TextForShowCartItems(res.picUrl[0],res.manufacturer, res.product_name,res.price,res.cikkszam, res.quantity, res.product_type));
                            }
                        })
                        cartOutput.append(ModalCartText.showPrice(priceSum,'A Fizetendő végösszeg'));
                    }).catch(error => console.log(error))
            }


        }).catch(err => console.log(err));
        
        $('#cartModal').modal('show');
        cartOutput.innerHTML = '';
        setTimeout(() =>{
            $('#cartModal').modal('hide');
        }, 2000);
        
    });
});

cartBTN.addEventListener('click', () =>{
    ModalCartText.getCartTextAndData(cartOutput);
});


const deliveryOutput = document.querySelector('.deliveryAdressOutput');
if(document.querySelector('#deliveryAddress') != undefined || document.querySelector('#deliveryAddress') != null){
    const checkbox = document.querySelector('#deliveryAddress');
    checkbox.addEventListener('change', () =>{
        if (checkbox.checked) {
            deliveryOutput.removeChild(document.getElementById('DeliveryBillingAdress'));
        }else{
            ModalCartText.showDeliveryAdress(deliveryOutput);
        }
    })
}
    

if(document.getElementById('anyMessage') != undefined || document.getElementById('anyMessage') != null){
    const messageCheckbox = document.getElementById('anyMessage');    
    messageCheckbox.addEventListener('change', () =>{
    if (messageCheckbox.checked) {
        deliveryOutput.append(ModalCartText.createMessageBox());
    }else{
        deliveryOutput.removeChild(ModalCartText.removeMessageBox());
    }
});
}


// ==============================================================================================
// -------------------------    CHANGE THE ELEMENTS PRICE SUMMARY PAGE     ----------------------
// ==============================================================================================

// summary cart elements
const summaryElements = document.querySelector('#summaryCartItems');
// the number input field
const numberOfItems = document.querySelectorAll('#numberOfItemsInSummary');
// overallPriceTextOutput LÁTHATÓ VÉGÖSSZEG SUMMMARY
let overallPrice = document.querySelector('#finalPriceValue');
// overallPriceHiddenValue POST SUMMARY
let overallPriceHidden = document.querySelector('#finalPriceValueHidden');
// Minden terméknek az egyes ára A LÁTHATÓ TEXT SUMMARY
let itemPricesSpanText = document.querySelectorAll('#itemPrices');
// egy adott terméknek az egy darab ára amivel kiszámolom: darab*ár NEM VÁLTOZIK SUMMARY
let itemPriceHidden = document.querySelectorAll('#itemPriceHidden');
// Item Type vga_BLABLA SUMMARY
let itemType = document.querySelectorAll('#itemType');
// VÁLTOZIK db*ár
let itemPricesHidden = document.querySelectorAll('#itemPricesHidden');

// Calculate overall price and modify $_SESSION[current] in SUMMARY +++++++++++++++++++++
numberOfItems.forEach((e,index) =>{    
    e.addEventListener('change',(e) => {    
        CartFunctions.calculatePrice(overallPrice,overallPriceHidden,itemPricesSpanText,itemPriceHidden,itemPricesHidden, itemType, index,e);    
     }); 
});

// ==============================================================================================
// -------------------------    DELETE ITEMS IN SUMMARY PAGE     -------------------------------
// ==============================================================================================
const sumItems = document.getElementById('summaryItems');

if(summaryElements !== null){
    summaryElements.addEventListener('click', (e) =>{
        if (e.target.type === 'button' && e.target.name === 'deleteFromCart') {
            if (e.target.id === e.target.parentElement.parentElement.id) {
                CookieQuery.getSessionEmail()
                .then(email =>{
                    CookieQuery.deleteFromSession(e.target.id);
                    cookie.modifyNumberOfItemsCookie('Cart_'+email, e.target.value+'_'+e.target.id,1,0);
                    e.target.parentElement.parentElement.remove();
                    //console.log(e.target.parentElement.parentElement.remove());
                    // if (e.target.parentElement.parentElement.remove() == null || e.target.parentElement.parentElement.remove() == undefined) {
                    //   sumItems.innerHTML = '<h1>A kosár üres</h1>';
                    // }
                   
                })                
            }            
        }
    });
}


// ==============================================================================================
// -------------------------    CHANGE THE ELEMENTS PRICE MODAL CART     ----------------------
// ==============================================================================================
// Calculate overall price and modify $_SESSION[current] in MODAL CART +++++++++++++++++++++

$('#cartModal').on('shown.bs.modal', (e) => {

//cartModal.addEventListener('click', (e) =>{
    const numberOfItemsModal = document.querySelectorAll('#numberOfItemsInModal');
    // overallPriceTextOutput LÁTHATÓ VÉGÖSSZEG CART MODAL
    let overallPriceModal = document.querySelector('#finalPriceValueModal');
    // overallPriceHiddenValue POST SUMMARY
    let overallPriceHiddenModal = document.querySelector('#finalPriceValueHiddenModal');
    // Minden terméknek az egyes ára A LÁTHATÓ TEXT CART MODAL
    let itemPricesSpanTextModal = document.querySelectorAll('#itemPricesModal');
    // egy adott terméknek az egy darab ára amivel kiszámolom: darab*ár NEM VÁLTOZIK CART
    let itemPriceHiddenModal = document.querySelectorAll('#itemPriceHiddenModal');
    // Item Type vga_BLABLA SUMMARY
    let itemTypeModal = document.querySelectorAll('#itemTypeModal');

    numberOfItemsModal.forEach((e,index) =>{
        e.addEventListener('change', (e) =>{
            if (e.target.name == 'numberOfItemsInModal[]') {
                CartFunctions.calculatePrice(overallPriceModal,overallPriceHiddenModal, itemPricesSpanTextModal, itemPriceHiddenModal,'', itemTypeModal, index,e);
            }
            
        })
    })
})

// ===========================================================================================
// ----------------------------    DELETE FROM MODAL CART     ------------------------------
// ===========================================================================================
cartModal.addEventListener('mouseup', (e) =>{
    // if the click type is button or name is deleteFromCart...
    if (e.target.name === 'deleteFromCart' && e.target.type === 'button') {
        //console.log(e.target.parentElement.parentElement.parentElement);
        if (e.target.id === e.target.parentElement.parentElement.parentElement.id) {
            CookieQuery.getSessionEmail()
            .then(email => {
                // TÖRLÉS
                // MEGOLDANI, HOGY TÖRLÉS UTÁN IS LEHESSEN NÖVELNI CSÖKKENTENI (VÁLTOZZON AZ ÁR)
                // FÉLSIKER

                CookieQuery.deleteFromSession(e.target.id);
                cookie.modifyNumberOfItemsCookie('Cart_'+email, e.target.value+'_'+e.target.id,1,0);
                e.target.parentElement.parentElement.parentElement.remove();
                // Recall the whole cart text function
                ModalCartText.getCartTextAndData(cartOutput);

                $('#cartModal').modal('hide');
                setTimeout(() => {
                    $('#cartModal').modal('show');
                },1000);
            });   
        }        
    }
})

// TEST
// GET THE URL PARAMS TO MANAGE THE SIDEBAR
if(document.querySelector('#tesztBTN') !== null){
    document.querySelector('#tesztBTN').addEventListener('click', () =>{
        let teszt = ''
        console.log(window.location.pathname);
        console.log(splitUrl(window.location.pathname));
    })
    
    function splitUrl(url){
        let array = url.split('/');
        array.shift();
        array.shift();
        return array;
    }
}

// import CreateFilterOutputText from '/filterFunctions/createFilterOutputText.js';