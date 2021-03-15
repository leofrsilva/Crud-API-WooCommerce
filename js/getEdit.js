function getDataEdit(rowId, prodId){
    var selector = 'table tbody tr.row' + rowId;
    var nome = document.querySelector(selector + ' td:nth-child(2)').innerText;
    var desc = document.querySelector(selector + ' td:nth-child(3)').innerText;
    var short_desc = document.querySelector(selector + ' td:nth-child(4)').innerText; //!
    var price = document.querySelector(selector + ' td:nth-child(5)').innerText;

    var price_sale = document.querySelector(selector + ' td:nth-child(6)').innerText;
    if (price_sale == 'R$ -') {
        price_sale = 'R$ ';
    }
    
    var featured = document.querySelector(selector + ' td:nth-child(8) i');
    var title = featured.getAttribute('class');
    if (title == 'material-icons featured') {
        featured = true;
    }
    else if (title == 'material-icons no-featured' ) {
        featured = false;
    }

    
    document.querySelector("#editProdModal #prodId").value = prodId;
    document.querySelector("#editProdModal #nome_edit").value = nome;
    document.querySelector("#editProdModal #descripton_edit").value = desc;
    document.querySelector("#editProdModal #short_descripton_edit").value = short_desc;
    document.querySelector("#editProdModal #price_edit").value = price.substring(3);
    document.querySelector("#editProdModal #price-sale_edit").value = price_sale.substring(3);
    document.querySelector("#editProdModal #featured_edit").checked = featured;  
}
