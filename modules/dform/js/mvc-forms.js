/**
 * Created by amarshimi on 6/28/2015.
 */



var FormModel = function () {
};

FormModel.prototype.getInputText = function (selector) {
    return selector.val();
};

FormModel.prototype.setInputText = function (selector, value) {
    selector.val(value);
};


var FormController = function (pModel) {

    this.model = pModel || new FormModel();

    this.fill_clicked = function () {
        this.model.setInputText('Hello World');
    };

    this.clear_clicked = function () {
        this.model.setInputText('');
    }

};

FormController.prototype.init = function () {

    var self = this;

    $('#fillbutton').click(function () {
        self.fill_clicked();
    });
    $('#clearbutton').click(function () {
        self.clear_clicked();
    });
};

FormController.prototype.getModel = function () {
    return this.model;
};


angular.module('elements', []).controller('ElementsController', function () {

    this.addCheckbox = function ($scope) {

        $scope.div = document.createElement("div");
        angular.element(document.getElementsByTagName('body')).append($scope.div);
    };

    this.addRadio = function () {

    };

    this.addTextInput = function () {

    };

    this.addFile = function () {

    };

});





