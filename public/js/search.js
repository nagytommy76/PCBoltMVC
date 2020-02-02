class Search{
    urlRoot = 'http://localhost/PCBoltMVC/';
    async showSearch(selectedMan,selectedCategory,input){
        try {
            const response = await fetch(`${urlRoot}searches/modalSearches/?category=${selectedCategory}&manufacture=${selectedMan}&modalInput=${input}`,{
            method: 'GET',
        });
    
        const data = await response.json();
    
        return data;
        } catch (error) {
            console.log(error);
        }
        
    }

    async productsManufacturers(productType){
        const response = await fetch(`${urlRoot}${productType}s/getManufacturers/`,{
            method : 'GET'
        });

        const data = await response.json();

        return data;
    }
}