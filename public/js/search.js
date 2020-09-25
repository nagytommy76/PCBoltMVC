const urlRoot = 'http://localhost/PCBoltMVC/';
export default class Search{
    
    static async showSearch(selectedMan,selectedCategory,input){
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

    static async productsManufacturers(productType){
        const response = await fetch(`http://localhost/PCBoltMVC/${productType}s/getManufacturers/`,{
            method : 'GET'
        });

        const data = await response.json();

        return data;
    }
}