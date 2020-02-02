class CreateText{
    constructor(urlRoot){
        this.urlRoot = urlRoot;
    }

    // Create output text
    textForSearchModal(responseData, hashedEmail){
        let allCardDiv = document.createElement('div');
        responseData.forEach(resp => {
            if(resp.type == 'Not Found'){
                let h4 = document.createElement('h4');
                h4.className = 'pl-3 m-auto';
                h4.innerHTML = 'Nem található a keresett termék';
                allCardDiv.append(h4);
            }else{
                allCardDiv.className = 'searchCarddiv mb-3';

                //  horizontal line
                let hr = document.createElement('hr');
                // CARD DIV
                let cardDiv = document.createElement('div');
                cardDiv.className = 'card mx-auto pt-3 pb-3';
                cardDiv.id = 'ModalCard';
                // IMG HEADER
                let cardHead = document.createElement('div');
                cardHead.className = 'card-head';
                let img = document.createElement('img');
                img.className = 'd-block w-100';
                img.src = `${resp.picUrl[0]}`;

                // anchor to details
                let a = document.createElement('a');
                a.className = 'card-title';
                a.href = `${this.urlRoot}/${resp.productType}s/details/${resp.cikkszam}`;
                a.title = `A ${resp.type} termék részleteinek megtekintése`;
                a.id = 'ModalLinkToItem';
                a.target = '_blank';
                // H3 TITLE
                let h3 = document.createElement('h3');
                h3.innerHTML = `${resp.manufacturer} ${resp.type}`;
                // CAR BODY
                let cardBody = document.createElement('div');
                cardBody.className = 'card-body';

                // create list
                let ul = document.createElement('ul');
                ul.className = 'list-group list-group-flush';
                // LIST ITEM 1
                let li1 = document.createElement('li');
                li1.className = 'list-group-item';
                li1.innerHTML = `Gyártó: ${resp.manufacturer}`;
                // LIST ITEM 2
                let li2 = document.createElement('li');
                li2.className = 'list-group-item';
                li2.innerHTML = `Típus: ${resp.type}`;
                // LIST ITEM 3
                let li3 = document.createElement('li');
                li3.className = 'list-group-item';
                let h4 = document.createElement('h4');
                h4.innerHTML = `Ár: ${resp.price} Ft`;
                h4.className = 'priceColor';
                li3.appendChild(h4);

                // Create CART button
                let button = document.createElement('button');
                button.className = 'btn btn-dark btn-block';
                button.type = 'button';
                button.id = 'addToCartInSearch';
                button.innerHTML = 'Kosárba';
                button.name = `Cart_${hashedEmail}`;
                button.value = `${resp.productType}_${resp.cikkszam}`;

                // CHAIN TOGETHER
                ul.appendChild(li1);
                ul.appendChild(li2);
                ul.appendChild(li3);


                a.appendChild(h3);
                cardBody.appendChild(a);
                cardBody.appendChild(ul);
                cardBody.appendChild(button);
                cardBody.appendChild(hr);

                cardHead.appendChild(img)
                cardHead.appendChild(hr);

                cardDiv.appendChild(cardHead);
                cardDiv.appendChild(cardBody);
                allCardDiv.append(cardDiv);            
            }
        });
        return allCardDiv;
    }

    // Create a flash message in search modal
    flashMessageInModal(incomingMess, alertColor = 'primary'){
        let div = document.createElement('div');
        div.id = 'flashMessage';
        div.className = `alert alert-${alertColor}`;
        div.role = 'alert';
        div.setAttribute('role', 'alert');
        div.innerHTML = incomingMess;
        return div;
    }

    flashMessageInModalDestroy(){
        let div = document.querySelector('#flashMessage');
        div.remove();     
    }

    // Create text for product manufacturers
    createManOptions(responseData, outputField){
        outputField.innerHTML = '';
        let firstOpt = document.createElement('option');
        firstOpt.value = '';
        firstOpt.innerText = 'Nincs Megadva';
        outputField.appendChild(firstOpt);
        responseData.forEach(resp => {
            let secOutput = document.createElement('option');
            secOutput.value = resp.man_id;
            secOutput.innerText = resp.manufacturer;
            outputField.appendChild(secOutput);
        })
    }
}