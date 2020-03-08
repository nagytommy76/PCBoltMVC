class CartFunctions{
    /**
     * 
     * @param {outputField} overallPriceTextOutput LÁTHATÓ VÉGÖSSZEG
     * @param {*} overallPriceHiddenValue POST-on lehessen látni a végösszeget
     * @param {*} itemPricesSpanText Minden terméknek az egyes ára A LÁTHATÓ TEXT
     * @param {*} itemPriceHidden egy adott terméknek az egy darab ára amivel kiszámolom: darab*ár NEM VÁLTOZIK
     * @param {value} itemPricesHidden egy termék összesített ára db*ár VÁLTOZIK
     * @param {*} index th element
     * @param {*} e event
     */
    static calculatePrice(overallPriceTextOutput, overallPriceHiddenValue,itemPricesSpanText, itemPriceHidden,itemPricesHidden = '', itemType, index,e){
        CookieQuery.getSessionEmail()
        .then(email =>{
            // let itemType = document.querySelectorAll('#itemType');
            cookie.modifyNumberOfItemsCookie('Cart_'+email,itemType[index].value,1, e.target.value);
            CookieQuery.changeAnItemQuantity(itemType[index].value.split('_')[1],e.target.value);
        })
        .catch(err => console.log(err));

        // let priceCounter = (parseInt(e.target.value) * parseInt(itemPriceHidden[index].value));
        let priceCounter = this.getPrice(parseInt(e.target.value),parseInt(itemPriceHidden[index].value))

        itemPricesSpanText[index].innerHTML = priceCounter;
        if (itemPricesHidden !== '') {
            itemPricesHidden[index].value = priceCounter;
        }        
        
        let overallPrice = 0;
        itemPricesSpanText.forEach(price =>{
            overallPrice += parseInt(price.innerHTML);
        });

        overallPriceHiddenValue.value = overallPrice;
        overallPriceTextOutput.innerHTML = overallPrice;       
    }

    static getPrice(price, quantity){
        let priceCounter = price * quantity;
        return parseInt(priceCounter);
    }

    static createEmptyTextForSummaryPage(){
        
    }
}