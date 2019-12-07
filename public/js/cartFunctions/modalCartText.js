class ModalCartText{
    static TextForMb(picUrl,manufacturer,productName,price,cikksz,urlToProductDetails = '#'){
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
        a.href = urlToProductDetails;
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

        // Create a number of products
        let number = document.createElement('input');
        number.type = 'number';
        number.step = 1;
        number.max = 10;
        number.min = 1;
        number.className = '';

        // Create a delete BTN
        let deleteBtn = document.createElement('button');
        deleteBtn.classList = 'btn btn-danger btn-sm';
        deleteBtn.innerText = 'Törlés a kosárból';
        deleteBtn.id = cikksz;

        // Chain together
        formControlDiv.appendChild(number);
        formControlDiv.appendChild(deleteBtn);

        a.appendChild(h5);
        mediaBodyDiv.appendChild(a);
        mediaBodyDiv.appendChild(priceP);
        mediaBodyDiv.appendChild(formControlDiv);

        

        mediaDiv.appendChild(img);
        mediaDiv.appendChild(mediaBodyDiv);

        return mediaDiv;

    }
}