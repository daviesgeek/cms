module.exports = function(){
	return {
		restrict: 'C',
		template: require('../views/directive-epi-checkbox-switch'),
		scope: {
			id: '@inputId',
			value: '@value',
			name: '@name',
			checked: '=checked',
			model: '=model',
			onText: '@onText',
			offText: '@offText'
		}
	}
}