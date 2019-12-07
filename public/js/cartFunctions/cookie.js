class Cookie{
    session;
    constructor(){
        if (this.getCookie('Cart') === undefined) {
            this.CartArray = [];
        }else{
            this.CartArray = JSON.parse(this.getCookie('Cart'));
        }
    }
    // Itt Majd eltárolom localStorage ban is mert különben pgae reloadnál újra inicializálódik... MEGOLDVA? ^
    setCookie(cName,cValue, exDays, session_cookie = ''){
        const days = this.expires(exDays);
        this.CartArray.push((`${cValue}`));
        document.cookie = `${cName}=${JSON.stringify(this.CartArray)}; expires=${days}; path=/`;
        document.cookie = `cart_session=${session_cookie}; expires=${days}; path=/`;
    }

    getCookie(name) {
        let value = "; " + document.cookie;
        let parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }

    destroyCookie(cName){
        document.cookie = `${cName}=; expires=Thu, 01 Jan 1970 00:00:00 UTC`;
        //this.CartArray = [];
    }

    expires(exDays){
        let d = new Date();
        d.setTime(d.getTime() + (exDays*24*60*60*1000));
        let expires = d.toUTCString();

        return expires;
    }
    setSessionEmail(){
        CookieQuery.getSessionEmail()
        .then(response => response)
        .catch(err => err);
    }
    
}