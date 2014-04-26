/**
 * Validation directive
 * Added April 26th, 2014
 */
module.exports = function() {

  this.form = form;
  this.control = control;
  this.toCamelCase = toCamelCase;

  return {
    restrict: 'A',
    controller: require('./controllers/epi-validate'),
    link: function(scope, element, attrs) {

      // prepare objects on scope
      if(!('forms' in scope))
        scope.forms = {};
      if(!('controls' in scope))
        scope.controls = {};
      
      var control = new this.control(attrs, element);
      var model = attrs.ngModel;

      // find closest parent form; if found, add this model to the named form object in scope
      var formElem = element.closest('form[name]');
      var formName = '';
      // make camelCase name
      if(formElem)
        formName = this.toCamelCase(formElem.attr('name'));
      
      // create form object if necessary
      if(formName && typeof scope.forms[formName] == 'undefined')
        scope.forms[formName] = new form(!!formElem.attr('epi-validate-show-messages'));

      // add control to form and watch control in form object
      if(formName)
        scope.forms[formName].addControl(control);

      // if no form, add to controls object so it's at least in the scope
      else
        scope.controls[control.name] = control;

      // watch element's value for change
      scope.$watch(attrs.ngModel, function(newVal, oldVal) {
        control.value = newVal;
        
        if(newVal == oldVal)
          return;

        // add dirty class (will make parent form dirty too)
        control.setDirty(true);

        // run validation rules via controller (set invalid class if necessary)
        scope._validateControl(control);
      });
          
    }
  }
}



function form(showMessages) {
  this._dirty = false;
  this._invalid = false;
  this._errors = {};
  this._showMessages = !!showMessages;

  this.controls = {};
};


form.prototype = {
  /**
   * Return whether this form is valid
   * @return {boolean}
   */
  isValid: function() {
    return !this._invalid;
  },

  /**
   * Set whether this form is valid
   * @param {boolean} valid
   * @return {void}
   */
  setValidity: function(valid) {
    this._invalid = !valid;
  },

  /**
   * Go through all the controls and figure out if this form is valid
   * @return {void}
   */
  checkValidity: function() {
    for(name in this.controls) {
      if(!this.controls[name].isValid())
        return;
    }

    // no invalid controls were found, so set to valid
    this._invalid = false;
  },

  /**
   * Return whether this form is dirty
   * @return {boolean}
   */
  isDirty: function() {
    return this._dirty;
  },

  /**
   * Set whether this form is dirty
   * @param {boolean} dirty
   * @return {void}
   */
  setDirty: function(dirty) {
    this._dirty = dirty;
  },

  /**
   * Get all errors in this form organized by name of control
   * @return {object}
   */
  getErrors: function() {
    return this._errors;
  },

  /**
   * Set errors in form by control name
   * @param {string} name
   * @param {array} errors
   * @return {void}
   */
  setErrors: function(name, errors) {
    this._errors[name] = errors;
  },

  /**
   * Add a control to this form
   * @param {object} control A control object
   * @return {void}
   */
  addControl: function(control) {
    this.controls[control.name] = control;
    control.setForm(this);
  },
}



function control(attrs, elem) {
  this._dirty = false;
  this._invalid = false;
  this._errors = {};
  this._elem = elem;
  this._form = null;
  this._showMessages = attrs.epiValidateShowMessages ? true : false;
  this._messageTemplate = '<span class="text-danger"></span>';
  this.VALID_CLASS = 'valid';
  this.INVALID_CLASS = 'invalid';

  this.name = attrs.name;
  this.value = null; // set by a watcher
  this.rules = attrs.epiValidate;
  
  if(attrs.epiValidateMessages) {
    try {
      this.messages = eval('('+attrs.epiValidateMessages+')');
    }
    catch(err) {
      throw 'Unable to evaluate custom validation messages for "'+this.name+'"!';
    }
  }
};

control.prototype = {

  /**
   * Return whether this form is valid
   * @return {boolean}
   */
  isValid: function() {
    return !this._invalid;
  },

  /**
   * Set whether this control is valid (clear errors if valid; if invalid, make form invalid)
   * @param {boolean} valid
   * @return {void}
   */
  setValidity: function(valid) {
    this._invalid = !valid;

    // delete old error message
    this._elem.next('span.text-danger').remove();

    // if valid, clear errors, clear error class, and add valid class
    // also tell parent form to check its validity
    if(valid) {
      this._errors = [];
      this._elem.addClass(this.VALID_CLASS).removeClass(this.INVALID_CLASS);
      if(this._form)
        this._form.checkValidity();
    }

    if(!valid) {
      this._elem.addClass(this.INVALID_CLASS).removeClass(this.VALID_CLASS);

      // show message (assumes messages are set first)
      if(this._showMessages && this._errors.length) {
        var span = $(this._messageTemplate).html(this._errors[0]);
        this._elem.after(span);
      }
      
      if(this._form)
        this._form.setValidity(false);
    }
  },

  /**
   * Return whether this control is dirty
   * @return {boolean}
   */
  isDirty: function() {
    return this._dirty;
  },

  /**
   * Set whether this control is dirty
   * @param {boolean} dirty
   * @return {void}
   */
  setDirty: function(dirty) {
    this._dirty = dirty;
    if(this._form && dirty == true)
      this._form.setDirty(true);
  },

  /**
   * Get all errors in this control
   * @return {object}
   */
  getErrors: function() {
    return this._errors;
  },

  /**
   * Set all errors in this control
   * @param {array} errors
   * @return {void}
   */
  setErrors: function(errors) {
    this._errors = errors;
    if(this._form)
      this._form.setErrors(this.name, errors);
  },

  /**
   * Set this control's parent form
   * @param {object} form Form object
   * @return {void}
   */
  setForm: function(form) {
    this._form = form;
    this._showMessages = form._showMessages;
  },

  /**
   * Returns the form object
   * @return {object}
   */
  getForm: function() {
    return this._form;
  },
}


function toCamelCase(str) {
  return str.replace(/([\:\-\_]+(.))/g, function(_, separator, letter, offset) {
    return offset ? letter.toUpperCase() : letter;
  });
}