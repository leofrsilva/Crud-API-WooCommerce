$.fn.getProdsDel = function() {
    var names =  $('td:has(.custom-checkbox input[type="checkbox"]:checked) + td');
    $('#deleteSelectProdModal #namesProdDel').html('');
    names.each(function(index){
        var name = names[index].textContent;
        $('#deleteSelectProdModal #namesProdDel').html($('#deleteSelectProdModal #namesProdDel').html() + '<br/> - ' + name);
    });

    var inputs =  $(' td .custom-checkbox input[type="checkbox"]:checked');
    $('#deleteSelectProdModal #prodIdsDel').val('');
    inputs.each(function(index){
        var id = inputs[index].value;
        $('#deleteSelectProdModal #prodIdsDel').val($('#deleteSelectProdModal #prodIdsDel').val() + id + '|');
    });
};