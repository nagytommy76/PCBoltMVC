class CreateText{
    constructor(urlRoot){
        this.urlRoot = urlRoot;
    }

    // Create text for each searches
    /**
     * Like MBtipus, ramType (hyperX etc...)
     * @param productType 
     */
    createModalText(productType, incoming = {}){
        let output = '';
        if (productType === 'Not Found') {
            output = '';
            output += '<h4 class="pl-3 m-auto">Nem található a keresett termék</h4>';
        }else{
            output += `
            <div class="card m-auto pt-3 pb-3" id="ModalCard">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="" class="d-block w-100" alt="$" />
                        </div>                                
                    </div> <!-- CAROSEL INNER END -->
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Előző</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Következő</span>
                  </a> <!-- CAROSEL NAVIGATOR END -->
                </div> <!-- CAROSEL END -->
                <div id="ModalLinkToItem">
                    <div class="card-body">
                        <a href="${this.urlRoot}mbs/details/" class="card-title" title="Részletek megjelenítése" id="ModalLinkToItem" target="_blank"><h3></h3></a>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Gyártó: ${incoming["man"]}</li>
                        <li class="list-group-item">Chipset: </li>
                        <li class="list-group-item">Foglalat: </li>
                        <li class="list-group-item">Ár: Ft</li>
                    </ul>
                    <!--<a href="#" type="button" class="btn btn-success pt-2">Részletek</a>-->
                </div>
            </div>
        `;
        }
        return output;
    }

    // Creating text for Search Modal MOTHERBOARD
    textForSearchModalMotherboard(response, email){
        let output = '';
        if(response.MBtipus === 'Not Found'){
            output = '';
            output += '<h4 class="pl-3 m-auto">Nem található a keresett termék</h4>';
        }else{
        response.forEach(resp => {
            output += `
            <div class="card m-auto pt-3 pb-3" id="ModalCard">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="${resp.picUrl[0]}" class="d-block w-100" alt="${resp.picUrl[0]}" />
                        </div>                                
                    </div> <!-- CAROSEL INNER END -->
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Előző</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Következő</span>
                  </a> <!-- CAROSEL NAVIGATOR END -->
                </div> <!-- CAROSEL END -->
                <div id="ModalLinkToItem">
                    <div class="card-body">
                        <a href="${this.urlRoot}mbs/details/${resp.cikkszam}" class="card-title" title="Részletek megjelenítése" id="ModalLinkToItem" target="_blank"><h3>${resp.MBtipus}</h3></a>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Gyártó: ${resp.manufacturer}</li>
                        <li class="list-group-item">Chipset: ${resp.chipset}</li>
                        <li class="list-group-item">Foglalat: ${resp.foglalat}</li>
                        <li class="list-group-item">Ár: ${resp.price} Ft</li>
                    </ul>
                    <button name="Cart_${email}" data-toggle="modal" data-target="#cartModal" type="button" id="addToCart" class="btn btn-dark"  value="mb_${resp.cikkszam}">Kosárba</button>
                </div>
            </div>
        `;
        });
        }
        return output;
    }
    // CPU
    textForSearchModalCpu(response, email){
        let output = '';
        if(response.tipus === 'Not Found'){
            output = '';
            output += '<h4 class="pl-3 mx-auto">Nem található a keresett termék</h4>';
        }else{
        response.forEach(resp => {
            output += `
            <div class="card m-auto pt-3 pb-3" id="ModalCard">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="${resp.kepurl}" class="d-block w-100" alt="${resp.kepurl}" />
                        </div>                                
                    </div> <!-- CAROSEL INNER END -->
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Előző</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Következő</span>
                  </a> <!-- CAROSEL NAVIGATOR END -->
                </div> <!-- CAROSEL END -->
                <div id="ModalLinkToItem">
                    <div class="card-body">
                        <a href="${this.urlRoot}cpus/details/${resp.cikkszam}"><h3>${resp.tipus}</h3></a>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Gyártó: ${resp.gyarto}</li>
                        <li class="list-group-item">Fogyasztás: ${resp.fogyasztas} W</li>
                        <li class="list-group-item">Foglalat: ${resp.foglalat}</li>
                        <li class="list-group-item">Órajel: ${resp.orajel} MHz</li>
                        <li class="list-group-item">Turbo Órajel: ${resp.turbo_orajel} MHz</li>
                        <li class="list-group-item">Ár: ${resp.ar} Ft</li>
                    </ul>
                    <a href="#" type="button" class="btn btn-dark pt-2">Kosárba</a>
                </div>
            </div>
        `;
        });
        }
        return output;
    }


    // RAM
    textForSearchModalRAM(response, email){
        let output = '';
        if(response.ramType === 'Not Found'){
            output = '';
            output += '<h4 class="pl-3 m-auto">Nem található a keresett termék</h4>';
        }else{
        response.forEach(resp => {
            output += `
            <div class="card m-auto pt-3 pb-3" id="ModalCard">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="${resp.picUrl[0]}" class="d-block w-100" alt="${resp.picUrl[0]}" />
                        </div>                                
                    </div> <!-- CAROSEL INNER END -->
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Előző</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Következő</span>
                  </a> <!-- CAROSEL NAVIGATOR END -->
                </div> <!-- CAROSEL END -->
                <div id="ModalLinkToItem">
                    <div class="card-body">
                        <a href="${this.urlRoot}rams/details/${resp.cikkszam}" class="card-title" title="Részletek megjelenítése" id="ModalLinkToItem" target="_blank"><h3>${resp.manufacturer} ${resp.type}</h3></a>
 
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Gyártó: ${resp.manufacturer}</li>
                        <li class="list-group-item">Kapacitás: ${resp.capacity} Gb</li>
                        <li class="list-group-item">Gyártó kód: ${resp.typeCode}</li>
                        <li class="list-group-item">Órajel: ${resp.clock} MHz</li>
                        <li class="list-group-item">Feszültség: ${resp.voltage} V</li>
                        <li class="list-group-item">Ár: ${resp.ramPrice} Ft</li>
                    </ul>
                    <!--<a href="#" type="button" class="btn btn-success pt-2">Részletek</a>-->
                </div>
            </div>
        `;
        });
        }
        return output;
    }

}