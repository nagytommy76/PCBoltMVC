class CookieQuery{
    // static async mbQuery(){
    //     const response = await fetch(`http://localhost/PCBoltMVC/carts/getMbItemCookie/`,
    //     {
    //         headers: {
    //             'Content-type': 'application/json',
    //             'Accept': 'application/json'
    //         },
    //         method : 'GET'
    //     }
    //     );

    //     const data = await response.json();

    //     return data;
    // }

    static async mbsQuery(){
        const response = await fetch(`http://localhost/PCBoltMVC/carts/getMbItemsCookie/`,
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
        const response = await fetch('http://localhost/PCBoltMVC/carts/getSession',{
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