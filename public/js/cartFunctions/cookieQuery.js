class CookieQuery{
    urlRoot = 'http://localhost/PCBoltMVC/';
    static async queryCartItems(){
        const response = await fetch(`${urlRoot}carts/getItemsCookie/`,
            {
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json'
                },
                method : 'GET'
            }
        );

        const data = await response.json();

        return data;
    }

    // Get the session email
    static async getSessionEmail(){
        const response = await fetch(`${urlRoot}carts/getSessionEmail`,{
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            method : 'GET'
        });

        const data = await response.json();

        return data;
    }

    // get the current user's data
    static async getUserDeliveryData(){
        const response = await fetch(`${urlRoot}carts/getTheCurrentUserData`,{
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            method : 'GET'
        });

        const data = await response.json();

        return data;
    }

    // CHANGE thesession quantity
    static async changeAnItemQuantity(cikksz, quantity){
        await fetch(`${urlRoot}carts/changeSessionsQuantity/?cikksz=${cikksz}&quantity=${quantity}`,{
            method : 'GET',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            }
        });
    }

    // DELETE FROM $_SESSION[current]
    static async deleteFromSession(cikkszam){
        await fetch(`${urlRoot}carts/changeSessionsQuantity/?cikksz=${cikkszam}`,{
            method : 'GET',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            }
        });
    }

}