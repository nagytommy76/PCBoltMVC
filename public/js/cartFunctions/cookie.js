class Cookie{
    session;
    constructor(){
        // if (this.getCookie('Cart_') === undefined) {
        //     this.CartArray = [];
        // }else{
        //     this.CartArray = JSON.parse(this.getCookie('Cart'));
        // }
    }

    setCookie(cName,cValue, exDays, session_cookie = ''){
        let CartArray = [];
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

    expires(exDays){
        let d = new Date();
        d.setTime(d.getTime() + (exDays*24*60*60*1000));
        let expires = d.toUTCString();

        return expires;
    }    
}