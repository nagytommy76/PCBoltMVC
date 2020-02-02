
const urlRoot = 'http://localhost/PCBoltMVC/';
// Init search
const search = new Search();
// Init Create text
const cText = new CreateText(urlRoot);


// ===============================================================================================
// ===                                  SEARCH FUNCTIONS                                       ===
// ===============================================================================================

// Get the search modal output
const modalOutput = document.getElementById('modalOutput');
const searchModal = document.getElementById('searchModal');

document.getElementById("category").addEventListener('change', () => {
    let man = document.getElementById('manufacture');
    const category = document.getElementById("category").value;

   //console.log(category)
   switch(category){
       case 'ram':
            search.productsManufacturers(category)
            .then(response => {
                cText.createManOptions(response,man);
            })
            .catch(err => console.log(err));
       break;
        case 'motherboard' :
            search.productsManufacturers('mb')
            .then(response => {
                cText.createManOptions(response,man);
            })
            .catch(err => console.log(err));
        break;
        case 'vga':
            search.productsManufacturers(category)
            .then(response => {
                cText.createManOptions(response, man);
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

document.getElementById('modalInput').addEventListener('keyup',() => {
    // Modal inputs--------------------------
    const selectedMan = document.getElementById('manufacture').value;
    const selectedCategory = document.getElementById('category').value;
    const input = document.querySelector('#modalInput').value;
    
    search.showSearch(selectedMan,selectedCategory,input)
    .then(response => {
        CookieQuery.getSessionEmail().then(email =>{
           console.log(response);
            if (input === '') {
                modalOutput.innerHTML = '';
            }else{
                modalOutput.innerHTML = '';
                switch (selectedCategory) {
                    case 'cpu':
                        modalOutput.append(cText.textForSearchModal(response, email));
                        break;
                    case 'motherboard':
                        modalOutput.append(cText.textForSearchModal(response, email));
                        break;
                    case 'ram':
                        modalOutput.append(cText.textForSearchModal(response,email));
                        break;
                    case 'vga':
                        modalOutput.append(cText.textForSearchModal(response, email))
                        break;
                }            
            }
        })
        
    })
    .catch(err => console.log(err));
});



searchModal.addEventListener('click', (e) =>{
    const flashOutput = document.querySelector('.flashMessage');
    //console.log(e.target);
    if (e.target.type === 'button') {
        //console.log(e.target.name);
        CookieQuery.getSessionEmail()
        .then(email => {
            if (email === e.target.name.split('_')[1]) {
                if (email !== 'EmailNotSet') {
                    cookie.setCookie(e.target.name,e.target.value,1);
                    flashOutput.append(cText.flashMessageInModal('A termék sikeresen hozzáadva kosárhoz!'));
                    //console.log('CSÁ');
                    if(document.querySelector('#flashMessage') != undefined || document.querySelector('#flashMessage') != null){
                        setTimeout(() => {
                            cText.flashMessageInModalDestroy();
                        },2500);
                    }
                }else{
                    flashOutput.append(cText.flashMessageInModal('A vásárláshoz be kell jelentkezni!','danger'));
                    if (document.querySelector('#flashMessage') != undefined || document.querySelector('#flashMessage') != null) {
                        setTimeout(() => {
                            cText.flashMessageInModalDestroy();
                        },2500);
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
const cookie = new Cookie();

addToCart.forEach((e) =>{
    let priceSum = 0;
    e.addEventListener('click', () =>{  
        CookieQuery.getSessionEmail()
        .then(email => {
            cookie.setCookie(e.name,e.value,1);
            //console.log(email);
            if (cookie.getCookie('Cart_'+email) !== undefined) {
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
})


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

    // ===========================================================================================
    // --------------------    DELETE FROM MODAL CART     -------------------
    // ===========================================================================================
    cartModal.addEventListener('click', (e) =>{
    // if the click type is button or name is deleteFromCart...
    if (e.target.name === 'deleteFromCart' && e.target.type === 'button') {
        //console.log(e.target.parentElement.parentElement.parentElement);
        if (e.target.id === e.target.parentElement.parentElement.parentElement.id) {
            CookieQuery.getSessionEmail()
            .then(email => {
                cookie.modifyNumberOfItemsCookie('Cart_'+email, e.target.value+'_'+e.target.id,1,0);
                e.target.parentElement.parentElement.parentElement.remove();
                CookieQuery.deleteFromSession(e.target.id);
                //console.log(numberOfItemsModal);
                //$('#cartModal').modal('hide');
            });  
            // MEGOLDANI, HOGY AZ ÁR IS VÁLTOZZON   
        }        
    }
    })
})
