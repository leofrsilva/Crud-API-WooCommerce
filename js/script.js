$(document).ready(function() {
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();
    // Select / Deselect Checkbox
    var checkbox = $('table tbody input[type=checkbox]');

    $('#selectAll').click(function(){
        if (this.checked ) {
            checkbox.each(function(){
                this.checked = true;
            });
        }
        else{
            checkbox.each(function(){
                this.checked = false;
            });
        }
    });

    checkbox.click(function(){
        if (!this.checked) {
            $('#selectAll').prop("checked", false);
        }
    });

    //? ----------------------------------------------------------------------
    // $('.currency').keydown(function() {
    //     var oldvalue=$(this).val();
    //     var field=this;
    //     setTimeout(function () {
    //         if(field.value.indexOf('R$ ') !== 0) {
    //             $(field).val(oldvalue);
    //         }             
    //     }, 1);
    // });
    // $('.currency').keyup(function() {
    //     // alert(e.);
    //     var value = $(this).val(); 
    //     var field=this;  
    //     let formatter = new Intl.NumberFormat([], {
    //         style: 'currency',
    //         currency: 'BRL'
    //     });     
    //     setTimeout(function () {            
    //         console.log('--------------');
    //         console.log(value);
    //         console.log(value.substring(3));
    //         console.log(formatter.format(value.substring(3)));
    //         var valueFormater = formatter.format(value.substring(3));
    //         $(field).val(valueFormater);            
    //     }, 1);
    // });

    // https://www.blogson.com.br/como-formatar-campos-de-cpf-cep-telefone-e-moeda-com-jquery-jmask/
    // $('.currency').mask('R$ 999.990,00');
    $('.currency').mask('#.##0,00', {reverse: true});

    $('#linkProd_edit').keydown(function() {
        var oldvalue=$(this).val();
        var field=this;
        setTimeout(function () {
            if(field.value.indexOf('http://petmais.atwebpages.com/product/') !== 0) {
                $(field).val(oldvalue);
            }             
        }, 1);
    });
});