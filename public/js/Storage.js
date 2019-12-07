class Storage{
    setLocalStorage(cikkszam, productName){
        localStorage.setItem(productName+'cikkszam', cikkszam)
    }

    getItemsFromLS(productName){
        if (localStorage.getItem(productName+'cikkszam') === null) {
            document.querySelector("#modalCartOutput").innerHTML = `<h1>A kosár üres</h1>`;
        }
    }
}