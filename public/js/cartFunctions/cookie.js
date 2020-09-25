import ModalCartText from '/PCBoltMVC/js/cartFunctions/modalCartText.js';
export default class Cookie{
    static setCookie(cName,cValue, exDays, CartArray = []){
        const days = Cookie.expires(exDays);

        if (this.getCookie(`${cName}`) !== undefined) {
            CartArray = JSON.parse(this.getCookie(`${cName}`));
            CartArray.push((cValue));
        }else{
            CartArray.push(cValue);
        }
        document.cookie = `${cName}=${JSON.stringify(CartArray)}; expires=${days}; path=/`;     
    }
    
    // GET the current user's cookie
    static getCookie(name) {
        let value = "; " + document.cookie;
        let parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }

    static destroyCookie(cName){
        document.cookie = `${cName}=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/`;
    }

    static modifyNumberOfItemsCookie(cName, cValue, exDays, numberOfItem){
        let toModify = false;
        if(this.getCookie(cName) != undefined){
            toModify = this.getNumberOfProductTypes(JSON.parse(this.getCookie(cName)));
        }
        // let toModify = this.getNumberOfProductTypes(JSON.parse(this.getCookie(cName)));
        const days = this.expires(exDays);
        if (toModify !== false) {
            if (numberOfItem > 0) {
                toModify[cValue] = numberOfItem;
                const modified = this.makeModifiedCookie((toModify));
                document.cookie = `${cName}=${JSON.stringify(modified)}; expires=${days}; path=/`;
            }else{
                // delete all item from cookie...
                toModify[cValue] = numberOfItem;
                let toStayInCookie = this.makeModifiedCookie((toModify));
                //console.log('TO toStayInCookie: '+toStayInCookie);
                document.cookie = `${cName}=${JSON.stringify(toStayInCookie)}; expires=${days}; path=/`;
                if (this.getCookie(cName).length == 2) {
                    this.destroyCookie(cName);
                    // REMOVE the price 
                    if (document.getElementById('overallPrice') != null) {
                        document.getElementById('overallPrice').remove();
                    }
                    /*cartOutput*/document.querySelector("#modalCartOutput").append(ModalCartText.emptyCartText());
                }
            }  
        }    
    }
    // creates an expire date in date type
    static expires(exDays){
        let d = new Date();
        d.setTime(d.getTime() + (exDays*24*60*60*1000));
        let expires = d.toUTCString();

        return expires;
    }
    // Loop through an array and get the key => value pair. (cikkszam => number of items)
    static getNumberOfProductTypes(array = []){
        if (array != []) {
            let currentCount = {};
            array.forEach((curr) =>{
                currentCount[curr] = currentCount[curr] ? currentCount[curr]+1 : 1;
            });
            return currentCount;
        }else{
            return false;
        }
        
    }

    // 
    static makeModifiedCookie(array){
        let result = [];
        for(let key of Object.keys(array)){
            for (let i = 0; i < array[key]; i++) {
                result.push(key);        
            }
        }
        return result;
    }
}