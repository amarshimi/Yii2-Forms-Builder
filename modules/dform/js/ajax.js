/**
 * Created by amarshimi on 5/28/2015.
 */

var AjaxRequest = {


    insertAjax: function (type, element, obj, url) {

        $.ajax({
            type: type,
            data: obj,
            url: url,
            cache: false

        }).success(function (html) {

            if (html == 'success')
                element.after('<i class="fa fa-check"></i>');
        })

    },

    tabularRequest: function (type, element, obj, url) {


        $.ajax({

            type: type,
            data: obj,
            url: url,
            cache: false

        }).success(function (html) {

            element.html(html);
            return true


        })

    },

    deleteField: function (type, $element, obj, url, successCallback) {

        if (!confirm('Are you sure you want to delete this item?'))
            return false;

        $.ajax({
            type: type,
            data: obj,
            url: url,
            cache: false
        }).success(function () {
            $element.fadeOut();
            $element.remove();

            if (typeof successCallback == 'function')
                successCallback();


        })
    }

};

