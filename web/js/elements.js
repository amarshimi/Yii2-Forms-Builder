/**
 * Created by amarshimi on 6/2/2015.
 */


/*

 config
 events
 models
 controller

 */

/* edit name of inputs  */


function enable_edit_for_labels(createElement) {
    var replaceWith = $('<input name="temp" type="text" />'),
        connectWith = $('input[name="hiddenField"]'),
        label = $('label');
    createElement.inlineEdit($('.ui-draggable-connect'), '.wrapper-input .wrapper-filed label', replaceWith, connectWith, label);
}


function create_sortable() {
    var sortable = $(".sortable");
    sortable.sortable();
    sortable.disableSelection();
}


function create_random_id($wrapper) {
    var rand = Math.random();
    $wrapper.find('#glyphicon').attr('href', rand.toString());
    $wrapper.find('#collapse-target').attr('id', rand.toString());
}


function stop_callback(ui) {
    var hidden = $('#hidden-template');
    var template = hidden.html();

    var context = $(ui.helper.context);
    var $dataType = context.data('yii-input-type');
    $(ui.helper).after(template);

    var $wrapper = $('.hidden-wrapper-input').find('#hidden-new-div');
    var formId = $wrapper.data('form-id');
    var sort = $wrapper.data('sort');
    var group = $wrapper.data('group');

    var server = {
        input: $(this).data('yii-input-type'),
        label: 'New Label',
        formId: formId,
        group: group
    };

    var obj = {
        type: $dataType
    };

    var attrClass = {
        class: "form-control"
    };

    var label = {
        for: 'test'
    };
    var createElement = Singleton.getInstance();
    var labelToElement = createElement.addElement($wrapper, 'label', label);
    var type = createElement.getTypeOfElement(context);

    if (type == 'input' || type == 'select') {
        $.extend(obj, attrClass);
    }

    var element = createElement.addElement($wrapper, type, obj);
    console.log(type);

    labelToElement.innerHTML = 'New ' + $dataType + ' :-(0)';

    var addButton = $('<button type="button" class="btn btn-primary group-fields"></button>');
    createElement.addButtonByDataType(addButton, $dataType, '#add-place');
    console.log($dataType);

    create_random_id($wrapper);
    $wrapper.append(labelToElement);
    $wrapper.append(element);
    $wrapper.attr('id', '');
    $('#add-place').attr('id', '');

    $(ui.helper).remove();
    AjaxRequest.insertAjax('POST', $wrapper, server, App.addField.AjaxUrl);
}


function create_draggable() {
    var uiStart = $('ul li.ui-connect-start');
    $('.wrapper-buttons-draggable li').draggable({

        connectToSortable: '#ui-draggable-connect',
        revert: "invalid",
        zIndex: 999,
        helper: 'clone',

        start: function (event, ui) {
            uiStart.show();
        },

        stop: function (event, ui) {
            uiStart.hide();
            stop_callback.call(this, ui);
        }

    });
}

function create_new_element(createElement) {
    $('ul.ui-draggable-connect').on('click', '.group-fields', function () {
        var $wrapper = $(this).parents('.wrapper-input').find('.wrapper-filed').first();
        var type = $(this).parents('.wrapper-input').find('input').attr('type');
        var group = $wrapper.data('group');
        var formId = $wrapper.data('form-id');
        var sort = $wrapper.data('sort');

        var input = {
            type: type,
            group: group
        };
        var server = {
            input: type,
            label: 'New Label',
            formId: formId,
            group: group
        };

        var obj = {
            type: type,
            class: "form-control",
            name: "name-" + group,
            group: group,
            sort: sort
        };

        var label = {
            group: $wrapper.first().attr('group')
        };
        var element = createElement.addElement($wrapper, 'label', label);
        AjaxRequest.insertAjax('POST', $wrapper, server, App.addField.AjaxUrl);
        element.innerHTML = 'New Label';
        createElement.addElement($wrapper, 'input', obj);
    });
}

$(function () {
    var createElement = Singleton.getInstance();

    create_sortable();
    enable_edit_for_labels(createElement);
    create_new_element(createElement);
    create_draggable();

});


var Singleton = (function () {
    var instance;

    function createInstance() {
        instance = new CreateElements();
        return instance;
    }

    return {
        getInstance: function () {
            return instance ? instance : createInstance();
        }
    }
})();
