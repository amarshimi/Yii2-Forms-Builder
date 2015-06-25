/**
 * Created by amarshimi on 6/9/2015.
 */


var CreateElements = function () {

    this.inlineEdit = function (triger, target, replaceWith, connectWith, element) {

        triger.on('click', target, function () {

            var elem = $(this);

            elem.hide();
            elem.after(replaceWith);

            replaceWith.focus();
            replaceWith.val(elem.text());


            replaceWith.blur(function () {

                if ($(this).val() != "") {
                    connectWith.val($(this).val()).change();
                    elem.text($(this).val());
                }
                var obj = {
                    id: elem.attr('id'),
                    value: replaceWith.val(),
                    group: elem.attr('group')
                };
                AjaxRequest.insertAjax('POST', element, obj, App.updateName.AjaxUrl);

                $(this).remove();
                elem.show();
            });
        });
    };


    this.addElement = function (wrapper, type, obj) {

        var element = document.createElement(type);
        this.addAttributes($(element), obj);
        $(wrapper).append(element);
        return element;

    };

    this.addAttributes = function (element, obj) {
        for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
                element.attr(key, obj[key]);
            }
        }
    };

    this.getTypeOfElement = function (drag) {

        return $(drag).data('type')

    };

    this.addButtonByDataType = function (butoon, dataType, id) {

        switch (dataType) {
            case 'radio' :
                var obj = {
                    'data-add-type': 'radio'
                };
                this.addAttributes($(butoon), obj);
                $(butoon).html('add Radio');
                $(id).append(butoon);
                break;
            case 'checkbox' :
                var obj = {
                    'data-add-type': 'checkbox'
                };
                this.addAttributes($(butoon), obj);
                $(butoon).html('add Check Box');
                $(id).append(butoon);
                break;
            case 'dropDownList' :
                var obj = {
                    'data-add-type': 'options'
                };
                this.addAttributes($(butoon), obj);
                $(butoon).html('add Options :)');
                $(id).append(butoon);
                break;
            default :
        }

    };


};

var DForms = {};

DForms.Controller = function () {

    var elementsModels = {};

    this.createElement = function (type, properties) {


    }
};

DForms.ElementModel = function (properties) {

    var name,
        self = this,
        type,
        label,
        attributes = {};

    this.setAttributes = function (uAttributes, value) {

        if (!typeof uAttributes == 'object')
            attributes[uAttributes] = value;
        else {

            for (var key in uAttributes) {

                if (uAttributes.hasOwnProperty(key))
                    attributes[key] = uAttributes[key];
            }
        }
    };

    this.getAttributes = function (attribute) {

        if (attribute)
            return attributes[attribute];

        return attributes;
    };

    var init = function () {

        type = properties.type;
        name = properties.name;
        label = properties.label;

        self.setAttributes(properties.attributes);
    };

    init();
};