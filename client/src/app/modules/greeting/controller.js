import Helpers from '../../system/helpers';

export default class GreetingController {
	constructor($location, $cookies, $sessionStorage, TestService) {
		this.$location = $location;
		this.$cookies = $cookies;

		Helpers.clearSystemData($cookies, $sessionStorage);

		this.nameMaxLength = 255;
		this.username = "";

		this.testResource = TestService.getResource();
	}

	startTest() {
		this.testResource.save(
			{
				"username": this.username
			},
			(data) => {
				this.$cookies.put("test-id", data.id);
				this.$location.path("/test");
			},
			(error) => {
				this.$location.path("/error");
			}
		);
	}
}

GreetingController.$inject = ['$location', '$cookies', '$sessionStorage', 'TestService'];