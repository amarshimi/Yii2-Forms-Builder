/**
 * Created by amarshimi on 5/28/2015.
 */

/*
 * params type, element, obj, url
 * */

$(function () {

    var field = $('#add-field');
    var label = $('#add-label');
    var tabular = $('.tabular');
    var formId = $('#form-id');
    var deleteIcon = $('ul.ui-draggable-connect');


    deleteIcon.on('click','.delete',function(){

        var field = $(this).parent('.wrapper-input');
console.log(field);
        var obj = {
             group : this.group
        };

        if(!obj.group){
            if (!confirm('Are you sure you want to not save this item?'))
                return false;
            field.fadeOut();
        }else {
            AjaxRequest.deleteField('POST', field, obj, App.deleteFieldUrl.AjaxUrl);
        }
    });


    $('#add-field-ajax').click(function () {
        var $wrapper = $('.wrapper-filed').last();

        var obj = {
            input: field.val(),
            label: label.val(),
            formId: formId.val()
        };

        var object = {
            class: "form-control"
        };

        var Elabel = {
          class:'label'
        };
        var createElement = new CreateElements();

        var element =  createElement.addElement($wrapper, 'label', Elabel);
        element.innerHTML = 'New Label';
        createElement.addElement($wrapper,field.val(),object);

        AjaxRequest.tabularRequest('POST', tabular, obj, App.addField.AjaxUrl);

    });

});
