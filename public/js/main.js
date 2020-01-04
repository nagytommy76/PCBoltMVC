
const urlRoot = 'http://localhost/PCBoltMVC/';
// Init search
const search = new Search();
// Init Create text
const cText = new CreateText(urlRoot);



// Get the search modal output
const modalOutput = document.getElementById('modalOutput');

document.getElementById("category").addEventListener('change', () => {
    let man = document.getElementById('manufacture');
    const category = document.getElementById("category").value;

   //console.log(category)
   switch(category){
       case 'ram':
            search.showRamMan()
            .then(response => {
                //console.log(response);
                man.innerHTML = '<option value="">Nincs kiválasztva</option>';
                response.forEach(manufact => {
                    man.innerHTML += `
                        <option value="${manufact.man_id}">${manufact.manufacturer}</option>
                    `;
                })
            })
            .catch(err => console.log(err));
       break;
        case 'motherboard' :
            search.showMBMan()
            .then(response => {
                man.innerHTML = '<option value="">Nincs megadva</option>';
                //console.log(response);
                response.forEach(res => {
                    man.innerHTML += `
                        <option value="${res.manufacturer}">${res.manufacturer}</option>
                    `;
                });
            })
            .catch(err => console.log(err));
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
        //console.log(response);
        if (input === '') {
            modalOutput.innerHTML = '';
        }else{
            switch (selectedCategory) {
                case 'cpu':
                    modalOutput.innerHTML = cText.textForSearchModalCpu(response);
                    break;
                case 'motherboard':
                    modalOutput.innerHTML = cText.textForSearchModalMotherboard(response);      
                    break;
                case 'ram':
                    modalOutput.innerHTML = cText.textForSearchModalRAM(response);
                    break;
            }            
        }
    })
    .catch(err => console.log(err));
});

// CART FUNCTIONS--------------------------------------------------------------------------------

const addToCart = document.querySelectorAll("#addToCart");
const cartOutput = document.querySelector("#modalCartOutput");
const cartPriceOutput = document.querySelector("#modalCartPrice");
const cartBTN = document.getElementById('cartBTN');

let sessionEmail = '';

// Cookie
const cookie = new Cookie();

addToCart.forEach((e) =>{
    let priceSum = 0;
    e.addEventListener('click', () =>{   
        // let Cart = e.name.split('_');  
        // sessionEmail = Cart[1];
        CookieQuery.getSessionEmail()
        .then(email => {
            cookie.setCookie(e.name,e.value,1);
            if (cookie.getCookie('Cart_'+email) !== undefined) {
                CookieQuery.queryCartItems()
                .then(response => {
                    cartOutput.innerHTML = '';
                    response.forEach(res =>{
                        if (email === res.sessEmail) {
                            priceSum += parseInt(res.price * res.quantity);
                            cartOutput.append(ModalCartText.TextForMb(res.picUrl[0],res.manufacturer, res.product_name,res.price,res.cikkszam, res.product_type ,res.quantity));
                            //console.log(res.sessEmail);
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

const checkbox = document.querySelector('#deliveryAddress');
const deliveryOutput = document.querySelector('.deliveryAdressOutput');

    checkbox.addEventListener('change', () =>{
        if (checkbox.checked) {
            deliveryOutput.removeChild(document.getElementById('DeliveryBillingAdress'));
        }else{
            ModalCartText.showDeliveryAdress(deliveryOutput);
        }
    })


const messageCheckbox = document.getElementById('anyMessage');    
messageCheckbox.addEventListener('change', () =>{
    if (messageCheckbox.checked) {
        deliveryOutput.append(ModalCartText.createMessageBox());
    }else{
        deliveryOutput.removeChild(ModalCartText.removeMessageBox());
    }
});






// CHANGE THE ELEMENTS PRICE FOLYT KÖV!!!!----------------------------------------------

//const numberOfItemsInSummary = document.querySelectorAll('#numberOfItemsInSummary');

const numberOfItems = document.querySelectorAll('#numberOfItemsInSummary');
// A látható végösszeg
let overallPrice = document.querySelector('#finalPriceValue');
// a rejtett végösszeg, hogy POST-on eresztül le tudjam klérdezni
let overallPriceHidden = document.querySelector('#finalPriceValueHidden');



numberOfItems.forEach((e,index) =>{
    let itemPrice = document.querySelectorAll('#itemPriceHidden');
    
    e.addEventListener('change',(e) => {
        //console.log(e.target.value);
        CookieQuery.getSessionEmail()
        .then(email =>{
            let itemType = document.querySelectorAll('#itemType');
            //console.log(itemType[index].value);
            cookie.modifyNumberOfItemsCookie('Cart_'+email,itemType[index].value,1, e.target.value);

            CookieQuery.changeAnItemQuantity(itemType[index].value.split('_')[1],e.target.value);
        })
        .catch(err => console.log(err));

        let itemPricesText = document.querySelectorAll('#itemPrices');
        let itemPricesHidden = document.querySelectorAll('#itemPricesHidden');

        let priceCounter = (parseInt(e.target.value) * parseInt(itemPrice[index].value));
        

        itemPricesText[index].innerHTML = `${priceCounter}`;
        itemPricesHidden[index].value = priceCounter;
        //console.log(itemPricesHidden[index].value);
        //itemPricesText[index].value = `${priceCounter}`;
        
        let test = 0;
        itemPricesText.forEach(price =>{
            test += parseInt(price.innerHTML);
        });

        overallPriceHidden.value = test;
        //console.log(overallPriceHidden.value);
        (overallPrice.innerHTML = test);        
     }); 
    
})








