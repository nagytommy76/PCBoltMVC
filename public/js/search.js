class Search{

    async showSearch(selectedMan,selectedCategory,input){
        try {
            const response = await fetch(`http://localhost/PCBoltMVC/searches/modalSearches/?category=${selectedCategory}&manufacture=${selectedMan}&modalInput=${input}`,{
            method: 'GET',
        });
    
        const data = await response.json();
    
        return data;
        } catch (error) {
            console.log(error);
        }
        
    }

    async showRamMan(){
        const response = await fetch("http://localhost/PCBoltMVC/rams/ramManufacts/",{
            method : 'GET'
        });

        const data = await response.json();

        return data;
    }

    async showMBMan(){
        const response = await fetch("http://localhost/PCBoltMVC/mbs/mbManufacturers/",{
            method : 'GET'
        });

        const data = await response.json();

        return data;
    }
}