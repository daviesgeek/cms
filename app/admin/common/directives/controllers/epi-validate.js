/**
 * Validation controller
 */

module.exports = function($scope, Validator) {

  /**
   * Validate a whole form
   * @param  {string} formName Name of form
   * @return {[object]} The form object
   */
  $scope.validateForm = function(formName) {
    var form = $scope.forms[formName];

    form.setValidity(true);
    for(name in form.controls) {
      $scope._validateControl(form.controls[name]);
    }

    return form;
  }


  // validate a single control
  $scope._validateControl = function(control) {

    // get validation rules from this control
    var rules = control.rules;

    // get all the other values in case they're needed by validation
    var form = control.getForm(),
        otherControls = form ? form.controls : $scope.controls,
        otherVals = {};

    for(name in otherControls) {
      otherVals[name] = otherControls[name].value;
    }

    // feed validation rules and value into service
    var results = Validator.validate(control.value, control.rules, control.messages, otherVals);

    // set control to invalid if necessary (will ascend to parent form)
    if(results !== true) {
      control.setErrors(results);
      control.setValidity(false);
    }
    else
      control.setValidity(true);
  }
}