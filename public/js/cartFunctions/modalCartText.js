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
        number.name = 'numberOfItems[]';
        number.value = quantity;

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

    static showPrice(price, text = ''){

        let priceSum = document.createElement('h5');
        priceSum.className = 'priceColor';
        priceSum.innerHTML = `${text}: ${price} Ft`;

        return priceSum;
    }
}