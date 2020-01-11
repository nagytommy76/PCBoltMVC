class Cookie{
    setCookie(cName,cValue, exDays, CartArray = []){
        //let CartArray = [];
        const days = this.expires(exDays);

        if (this.getCookie(`${cName}`) !== undefined) {
            CartArray = JSON.parse(this.getCookie(`${cName}`));
            CartArray.push((cValue));
        }else{
            CartArray.push(cValue);
        }
        document.cookie = `${cName}=${JSON.stringify(CartArray)}; expires=${days}; path=/`;     
    }
    
    // GET the current user's cookie
    getCookie(name) {
        let value = "; " + document.cookie;
        let parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }

    destroyCookie(cName){
        document.cookie = `${cName}=; expires=Thu, 01 Jan 1970 00:00:00 UTC`;
    }

    modifyNumberOfItemsCookie(cName, cValue, exDays, numberOfItem){
        let toModify = this.getNumberOfProductTypes(JSON.parse(this.getCookie(cName)));
        toModify[cValue] = numberOfItem;
       
        const modified = this.makeModifiedCookie((toModify));
        //console.log(toModify)
        const days = this.expires(exDays);

        document.cookie = `${cName}=${JSON.stringify(modified)}; expires=${days}; path=/`;
    }
    // creates an expire date in date type
    expires(exDays){
        let d = new Date();
        d.setTime(d.getTime() + (exDays*24*60*60*1000));
        let expires = d.toUTCString();

        return expires;
    }
    // Loop through an array and get the key => value pair. (cikkszam => number of items)
    getNumberOfProductTypes(array){
        let currentCount = {};
        array.forEach((curr) =>{
            currentCount[curr] = currentCount[curr] ? currentCount[curr]+1 : 1;
        });
        return currentCount;
    }

    // 
    makeModifiedCookie(array){
        let result = [];
        for(let key of Object.keys(array)){
            for (let i = 0; i < array[key]; i++) {
                result.push(key);         
            }
        }
        return result;
    }
}