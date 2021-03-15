function getDataDel(nameProd, id){
    document.querySelector("#deleteProdModal #nameProdDel").innerText = ' - ' + nameProd;  
    document.querySelector("#deleteProdModal #prodIdDel").value = id;
}