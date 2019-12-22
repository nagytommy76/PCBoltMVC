
const urlRoot = 'http://localhost/PCBoltMVC/';
// Init search
const search = new Search();
// Init Create text
const cText = new CreateText(urlRoot);
// Init storage
const ls = new Storage();




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
                    // console.log(response[0].manufacturer);
                    // modalOutput.innerHTML = cText.createModalText(response.MBtipus,{
                    //     man: response.manufacturer
                    // });
                    
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
    let priceSum = 0;
    CookieQuery.getSessionEmail()
    .then(email => {
        if (cookie.getCookie('Cart_'+email) !== undefined) {
            CookieQuery.queryCartItems()
            .then(response => {
                cartOutput.innerHTML = '';
                    response.forEach(res =>{
                        if (email === res.sessEmail) {
                            priceSum += parseInt(res.price * res.quantity);
                            cartOutput.append(ModalCartText.TextForMb(res.picUrl[0],res.manufacturer, res.product_name,res.price,res.cikkszam, res.product_type ,res.quantity));
                        }
                    })
                cartOutput.append(ModalCartText.showPrice(priceSum,'A Fizetendő végösszeg'));
            }).catch(error => console.log(error))
        }            
    }).catch(err => console.log(err));
})






// CHANGE THE ELEMENTS PRICE FOLYT KÖV!!!!----------------
//console.log(document.querySelectorAll('#numberOfItemsInSummary'));

const numberOfItems = document.querySelectorAll('#numberOfItemsInSummary');

numberOfItems.forEach((e, index) =>{
    let itemPrice = document.querySelectorAll('#itemPriceHidden');
    e.addEventListener('change',(e) => {
        console.log(e.target.value);
        let itemPricesText = document.querySelectorAll('#itemPrices');
        

        //console.log(itemPrice[index].value);
        itemPricesText[index].innerHTML = `Ár: ${(parseInt(e.target.value) * parseInt(itemPrice[index].value))} Ft`;
        itemPricesText[index].name = `${(parseInt(e.target.value) * parseInt(itemPrice[index].value))}`;

        let finalPrice = document.getElementById('finalPriceValue');

        console.log(finalPrice.innerHTML);
    });
    
})






//console.log(document.getElementsByClassName('numberOfItems'));
// numberChange.addEventListener('change', (e) =>{
//     alert(e.value);
// });

