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
}