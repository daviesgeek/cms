/**
 * Validator service
 */

module.exports = function() {
  var Validator = function() {
    // default error messages
    this._messages = {
      required: 'This field is required',
      alpha: 'This field must be letters only',
    };

    // custom validation rules & messages
    this._customRules = {};
    this._customMessages = {};

    // the default validation rules
    this._validationRules = {

      required: function(value) {
        return !(typeof value == 'undefined' || value === '' || value === null || value !== value);
      },

      requiredIf: function(value, args, controls) {
        var otherVal = typeof controls[args[0]] != 'undefined' ? controls[args[0]] : null,
            match = args[1];
        if(otherVal == match){
          return this._validationRules.required(value, args);
        }
        return true;
      },

      alpha: function(value) {
        var regex = /[^A-z]/;
        return !regex.test(value);
      },

      regex: function(value, args) {
        var regex = new RegExp(args[0]);
        return regex.test(value);
      }
    }


    /**
     * Validate a single value
     * @param  {mixed} value
     * @param  {string} rules Pipe-delimited string of rules
     * @param  {object} messages Hash of messages to override defaults
     * @return {boolean|array} If valid, returns boolean true; else return array of error messages
     */
    this.validate = function(value, rules, messages, controls) {
      // compile rules string into an object of functions
      var compiled = this._compileRules(rules),
          valid = true
          errors = [];

      // call each function, passing in the value
      for(name in compiled) {
        valid = compiled[name].func.call(this, value, compiled[name].args, controls);
        // console.log('Result of "'+name+'" test: '+(valid === true ? 'passed' : 'failed'));

        // if true, do nothing
        // if false, add appropriate error message to array
        if(!valid)
          errors.push(this._getMessage(name, messages));

      }

      if(errors.length)
        return errors;

      return true;
    }


    /**
     * Add an app-wide custom rule
     * @param {string} name
     * @param {string} message
     * @param {function} func
     * @return {void}
     */
    this.createCustomRule = function(name, message, func) {
      this._customRules[name] = func;
      if(message)
        this._customMessages[name] = message;
    }


    /**
     * Compile a string of rules into a hash of validation functions
     * @param  {string} rulesStr
     * @return {object}
     */
    this._compileRules = function(rulesStr) {
      var compiled = {},
          rules = rulesStr.split('|'),
          funcName = '',
          args = {},
          func;

      if(!rules)
        return false;

      for(var i=0; i<rules.length; i++) {
        // expected format is "function:arg1,arg2,arg3..."
        args = rules[i].split(':');
        funcName = args.splice(0, 1)[0];

        // find rule function in defaults
        if(funcName in this._validationRules)
          func = this._validationRules[funcName];

        // otherwise look for it in extended rules
        else if(funcName in this._customRules)
          func = this._customRules[funcName];

        else
          throw 'No validation rule named "'+funcName+'" could be found.';

        // save it in the compiled object
        compiled[funcName] = {
          func: func,
          args: args
        };
      }

      return compiled;
    }


    /**
     * Get the appropriate error message for a given rule
     * @param  {string} ruleName
     * @param {object} messages Hash of messages to override defaults
     * @return {string}
     */
    this._getMessage = function(ruleName, messages) {
      if(messages && ruleName in messages)
        return messages[ruleName];
      if(ruleName in this._customMessages)
        return this._customMessages[ruleName];

      return this._messages[ruleName];
    }
  };

  return new Validator;
}