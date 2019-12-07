class CartFunctions{
    showMotherboardCartItems(outputElement){
        let routeToProductDetails = 'http://localhost/PCBoltMVC/';
    let currentCookie;
    if (Cookie.getCookie('mbCart') !== undefined) {
        currentCookie = JSON.parse(Cookie.getCookie('mbCart'));
    }
    if (currentCookie !== undefined) {
        if (currentCookie.length > 1) {
            CookieQuery.mbsQuery()
            .then(response => {
                outputElement.innerHTML = '';
                response.forEach(res => {
                    outputElement.append(ModalCartText.TextForMb(res.picUrl[0],res.manufacturer,res.MBName,res.price,routeToProductDetails+`mbs/details/${res.cikkszam}`));
                });              
            })
            .catch(err => console.log(err));

        }else{
            CookieQuery.mbQuery()
            .then(response => {
                outputElement.innerHTML = '';
                outputElement.append(ModalCartText.TextForMb(response.picUrl[0],response.manufacturer,response.MBName,response.price,response.cikkszam,routeToProductDetails+`mbs/details/${response.cikkszam}`));
            })
            .catch(err => console.log(err))
        }
    }
    }
}