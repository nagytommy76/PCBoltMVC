class CookieQuery{
    static async queryCartItems(){
        const response = await fetch(`http://localhost/PCBoltMVC/carts/getItemsCookie/`,
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
        const response = await fetch('http://localhost/PCBoltMVC/carts/getSessionEmail',{
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
        const response = await fetch('http://localhost/PCBoltMVC/carts/getTheCurrentUserData',{
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            method : 'GET'
        });

        const data = await response.json();

        return data;
    }

    static async changeAnItemQuantity(cikksz, quantity){
        /*const response = */await fetch(`http://localhost/PCBoltMVC/carts/changeSessionsQuantity/?cikksz=${cikksz}&quantity=${quantity}`,{
            method : 'GET',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            }
        });

        // const data = await response.json();

        // return data;
    }

}