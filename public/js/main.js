
const urlRoot = 'http://localhost/PCBoltMVC/';
// Init search
const search = new Search();
// Init Create text
const cText = new CreateText(urlRoot);
// Init storage
const ls = new Storage();
// Cookie
const cookie = new Cookie();



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
const cartBTN = document.getElementById('cartBTN');
const routeToProductDetails = urlRoot;

addToCart.forEach((e) =>{
    e.addEventListener('click', () =>{      
        //console.log(e.id);        
        //ls.setLocalStorage(e.value, e.name);
        CookieQuery.getSessionEmail().then(res => {
            cookie.setCookie(e.name,e.value,1,res.session);
                CookieQuery.mbsQuery()
                .then(response =>{
                    console.log(response);
                    response.forEach(res => {
                        cartOutput.append(ModalCartText.TextForMb(res.picUrl[0],res.manufacturer,res.MBName,res.price,e.value));
                    });  
                })
                .catch(err => console.log(err));
            
            $('#cartModal').modal('show');
            cartOutput.innerHTML = '';
            setTimeout(() =>{
                $('#cartModal').modal('hide');
            }, 2500);
        }).catch(err => console.log(err));
        
    });
});

cartBTN.addEventListener('click', () =>{
    let currentCookie;
    if (cookie.getCookie('Cart') !== undefined) {
        currentCookie = JSON.parse(cookie.getCookie('Cart'));
    }
    CookieQuery.getSessionEmail()
    .then(session_response => {
        if (currentCookie !== undefined) {
            if (session_response !== undefined) {        
                if (session_response.session !== 'unset') {
                    if(cookie.getCookie('cart_session') === session_response.session){
                        // if the output is an empty string i don't make a request, because it's     unnecessary
                        CookieQuery.mbsQuery()
                        .then(response => {
                            console.log(response);
                            cartOutput.innerHTML = '';
                            response.forEach(res => {
                                cartOutput.append(ModalCartText.TextForMb(res.picUrl[0],         res.manufacturer,res.MBName,res.price,res.cikkszam,        routeToProductDetails+`mbs/details/${res.cikkszam}`));
                            });              
                        })
                        .catch(err => console.log(err));
                    }
                }
        }
        }else{
            cartOutput.innerHTML = `<h3>A kosár jelenleg üres!</h3>`;
        }
    })
});











