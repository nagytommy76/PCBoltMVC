class ModalCartText{
    static TextForMb(picUrl,manufacturer,productName,price,cikksz,urlToProductDetails = '', quantity){
        // Create Media DIV
        let mediaDiv = document.createElement('div');
        mediaDiv.classList = 'media border border-white mt-1';

        // Create IMG tag
        let img = document.createElement('img');
        img.src = picUrl;
        img.classList = 'align-self-start mr-3';
        img.id = 'mediaPicture';

        // Create media body div
        let mediaBodyDiv = document.createElement('div');
        mediaBodyDiv.className = 'media-body';

        // Create H5 and a tag
        let a = document.createElement('a');
        a.href = `http://localhost/PCBoltMVC/${urlToProductDetails}s/details/${cikksz}`;
        a.target = '_blank';
        a.classList = 'text-white'
        let h5 = document.createElement('h5');
        h5.className = 'mt-0';
        h5.innerHTML = `${manufacturer} ${productName}`;

        // Create Price paragraph
        let priceP = document.createElement('p');
        priceP.innerHTML = `${price} Ft`;

        // Create FORM Control DIV
        let formControlDiv = document.createElement('div');
        formControlDiv.className = 'form-group';

        // Create a form to modify the quantity
        let form = document.createElement('form');
        form.action = 'http://localhost/PCBoltMVC/carts/summaryCartItems';
        form.method = 'POST';


        // Create a number of products
        let number = document.createElement('input');
        number.type = 'number';
        number.step = 1;
        number.max = 20;
        number.min = 1;
        number.id = 'numberOfItemsInSummary';
        number.name = 'numberOfItemsInSummary[]';
        number.value = quantity;

        // Create hidden price
        let hiddenPrice = document.createElement('input');
        hiddenPrice.type = 'hidden';
        hiddenPrice.name = 'itemPriceHidden';
        hiddenPrice.id = 'itemPriceHidden';
        hiddenPrice.value = price;


        // CREATE another input (HIDDEN) for the cikkszam
        let hiddenCikk = document.createElement('input');
        hiddenCikk.type = 'hidden';
        hiddenCikk.name = 'hiddenCikkszam[]';
        hiddenCikk.value = cikksz;

        // Create a delete BTN
        let deleteBtn = document.createElement('button');
        deleteBtn.classList = 'btn btn-danger btn-sm';
        deleteBtn.innerText = 'Törlés a kosárból';
        deleteBtn.id = cikksz;

        // Chain together
        formControlDiv.appendChild(number);
        formControlDiv.appendChild(hiddenPrice);
        formControlDiv.appendChild(hiddenCikk);

        //form.appendChild(number);
        form.appendChild(deleteBtn);

        a.appendChild(h5);
        mediaBodyDiv.appendChild(a);
        mediaBodyDiv.appendChild(priceP);
        mediaBodyDiv.appendChild(formControlDiv);
        //mediaBodyDiv.appendChild(form);


        mediaDiv.appendChild(img);
        mediaDiv.appendChild(mediaBodyDiv);
        //mediaDiv.append(priceSum);

        return mediaDiv;
    }
    // Shows the final price at summaryCartItems page
    static showPrice(price, text = ''){

        let priceSum = document.createElement('h5');
        priceSum.className = 'priceColor';
        priceSum.id = 'overallPrice'
        priceSum.innerHTML = `${text} ${price} Ft`;

        return priceSum;
    }

    /**
     * gets the data from the database asyncronously
     * @param {An output DIV} cartOutput 
     */
    static getCartTextAndData(cartOutput){
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
                cartOutput.append(this.showPrice(priceSum,'A Fizetendő végösszeg'));
            }).catch(error => console.log(error))
        }            
    }).catch(err => console.log(err));
    }


    // CREATE AND SHOW COOKIE
    static createAndShowCookieCart(cartOutput, e){
        let priceSum = 0;
        e.addEventListener('click', () => {
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
        })
    }

    /**
     * @param {An output DIV} outputField 
     * 
     */
    static showDeliveryAdress(outputField){
        /**
         * megjeleníteni egy hasonló form-ot mint fent, ez változhat. Ha nincs bepipálva akkor jelenjen meg.
         * Majd PHP-ben megvizsgálni, hogy isset($_POST['deliveryAddress']) ekkor más lesz a cím, akár név is...
         * Esetleg lemásolni a már beírt adatokat a létrehozott mezőkbe automatikusan
         * A termékkategóriánkénti árakat meg a fizetendő végösszeget be lehetne tenni egy hidden input field-be,
         * hogy ne keljen PHP-ban is számolni, max ellenőrizni
         */
        CookieQuery.getUserDeliveryData()
        .then(data => {
            this.createBillingAndDeliveryAdress(data,outputField,'Szállítási cím', 'D');
        })
        .catch(err => console.log(err));        
    }

    /**
     * 
     * @param {Object} userData 
     * @param {*} outputElement 
     * @param {*} theFormType 
     * @param {*} deliveryOrBilling delivery or billing form D for Delivery, empty string for Billing and Delivery
     */
    static createBillingAndDeliveryAdress(userData, outputElement, theFormType, deliveryOrBilling = ''){
        // CREATE A CONTAINING DIV
        //console.log(userData);
        let div = document.createElement('div');
        div.id = 'DeliveryBillingAdress';
        // create a header
        let header = document.createElement('h5');
        header.className = 'text-center';
        header.innerHTML = theFormType;

        // create first ROW +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        let row1 = document.createElement('div');
        row1.className = 'row';
        // CREATE FIRST ROW'S 1st COL
        let row1col1 = document.createElement('div');
        row1col1.className = 'col';
        // CREATE LABEL
        let label1 = document.createElement('label');
        label1.htmlFor = `${deliveryOrBilling}veznev`;
        label1.innerHTML = 'Vezetéknév:';
        let input1 = document.createElement('input');
        input1.className = 'form-control';
        input1.type = 'text';
        input1.name = `${deliveryOrBilling}veznev`;
        input1.value = userData.vezeteknev;
        input1.required;

        // MERGE ROW1
        row1col1.appendChild(label1);
        row1col1.appendChild(input1);
        row1.appendChild(row1col1);

        // create 2nd COL ----------------------------------------------------------------
        // CREATE FIRST ROW'S 2 COL
        let row1col2 = document.createElement('div');
        row1col2.className = 'col';
        // CREATE LABEL
        let label2 = document.createElement('label');
        label2.htmlFor = `${deliveryOrBilling}kernev`;
        label2.innerHTML = 'Keresztnév:';
        let input2 = document.createElement('input');
        input2.className = 'form-control';
        input2.type = 'text';
        input2.name = `${deliveryOrBilling}kernev`;
        input2.value = userData.keresztnev;
        input2.required;

        // MERGE 
        row1col2.appendChild(label2);
        row1col2.appendChild(input2);
        row1.appendChild(row1col2);

        // create 3rd COL ----------------------------------------------------------------
        // CREATE FIRST ROW'S 3 COL
        let row1col3 = document.createElement('div');
        row1col3.className = 'col';
        // CREATE LABEL
        let label3 = document.createElement('label');
        label3.htmlFor = `${deliveryOrBilling}varos`;
        label3.innerHTML = 'Város:';
        let input3 = document.createElement('input');
        input3.className = 'form-control';
        input3.type = 'text';
        input3.name = `${deliveryOrBilling}varos`;
        input3.value = userData.varos;
        input3.required;

        // MERGE 
        row1col3.appendChild(label3);
        row1col3.appendChild(input3);
        row1.appendChild(row1col3);

        // create 2nd ROW ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        let row2 = document.createElement('div');
        row2.className = 'row';
        // CREATE 2 ROW'S 1 COL
        let row2col1 = document.createElement('div');
        row2col1.className = 'col';
        // CREATE LABEL
        let label21 = document.createElement('label');
        label21.htmlFor = `${deliveryOrBilling}irszam`;
        label21.innerHTML = 'IR. szám:';
        let input21 = document.createElement('input');
        input21.className = 'form-control';
        input21.type = 'number';
        input21.min = 1000;
        input21.max = 9999;
        input21.name = `${deliveryOrBilling}irszam`;
        input21.value = userData.irszam;
        input21.required;

        // MERGE 
        row2col1.appendChild(label21);
        row2col1.appendChild(input21);
        row2.appendChild(row2col1);

        // CREATE 2 ROW 2 COL----------------------------------------------------------
        // CREATE 2 ROW'S 2 COL
        let row2col2 = document.createElement('div');
        row2col2.className = 'col';
        // CREATE LABEL
        let label22 = document.createElement('label');
        label22.htmlFor = `${deliveryOrBilling}utca`;
        label22.innerHTML = 'Utca:';
        let input22 = document.createElement('input');
        input22.className = 'form-control';
        input22.type = 'text';
        input22.name = `${deliveryOrBilling}utca`;
        input22.value = userData.utca;
        input22.required;

        // MERGE 
        row2col2.appendChild(label22);
        row2col2.appendChild(input22);
        row2.appendChild(row2col2);

        // CREATE 2 ROW 2 COL--------------------------------------------------------------
        // CREATE 2 ROW'S 2 COL
        let row2col3 = document.createElement('div');
        row2col3.className = 'col';
        // CREATE LABEL
        let label23 = document.createElement('label');
        label23.htmlFor = `${deliveryOrBilling}hazszam`;
        label23.innerHTML = 'Házszám:';
        let input23 = document.createElement('input');
        input23.className = 'form-control';
        input23.type = 'text';
        input23.name = `${deliveryOrBilling}hazszam`;
        input23.value = userData.hazszam;
        input23.required;

        // MERGE 
        row2col3.appendChild(label23);
        row2col3.appendChild(input23);
        row2.appendChild(row2col3);


        // create 3rd ROW ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        let row3 = document.createElement('div');
        row3.className = 'row';
        // CREATE 2 ROW'S 1 COL
        let row3col1 = document.createElement('div');
        row3col1.className = 'col';
        // CREATE LABEL
        let label31 = document.createElement('label');
        label31.htmlFor = `${deliveryOrBilling}emeletajto`;
        label31.innerHTML = 'Emelet/ajtó:';
        let input31 = document.createElement('input');
        input31.className = 'form-control';
        input31.type = 'text';
        input31.name = `${deliveryOrBilling}emeletajto`;
        input31.value = userData.emeletajto;

        // MERGE 
        row3col1.appendChild(label31);
        row3col1.appendChild(input31);
        row3.appendChild(row3col1);

        // CREATE 3 ROW'S 2 COL-----------------------------------------------------------
        let row3col2 = document.createElement('div');
        row3col2.className = 'col';
        // CREATE LABEL
        let label32 = document.createElement('label');
        label32.htmlFor = `${deliveryOrBilling}szulido`;
        label32.innerHTML = 'Emelet/ajtó:';
        let input32 = document.createElement('input');
        input32.className = 'form-control';
        input32.type = 'date';
        input32.name = `${deliveryOrBilling}szulido`;
        input32.value = userData.szulido;

        // MERGE 
        row3col2.appendChild(label32);
        row3col2.appendChild(input32);
        row3.appendChild(row3col2);


        div.appendChild(header);
        div.appendChild(row1);
        div.appendChild(row2);
        div.appendChild(row3);

        outputElement.appendChild(div);

    }

    // CREATE MESSAGE BOX
    static createMessageBox(){
        let div = document.createElement('div');
        div.id = 'messageBoxArea';

        let msgBoxLabel = document.createElement('label');
        msgBoxLabel.htmlFor = 'messageBox';
        msgBoxLabel.innerHTML = 'Szállítással kapcsolatos egyéb információ';

        let msgBox = document.createElement('textarea');
        msgBox.placeholder = 'A szállító cégnek illetve üzletünknek tud üzenni';
        msgBox.name = 'messageBox';
        msgBox.className = 'form-control';

        div.appendChild(msgBoxLabel);
        div.appendChild(msgBox);

        return div;
    }

    static removeMessageBox(){
       let remove = document.getElementById('messageBoxArea');
       return remove;
    }

}