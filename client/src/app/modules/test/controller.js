export default class TestController {
	constructor($location, $cookies) {
		this.$location = $location;
		this.$cookies = $cookies;
	}
}

TestController.$inject = ['$location', '$cookies', '$mdToast'];