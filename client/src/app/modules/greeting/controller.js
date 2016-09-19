import Helpers from '../../system/helpers';

export default class GreetingController {
	constructor($location, $cookies, TestService) {
		this.$location = $location;
		this.$cookies = $cookies;

		Helpers.clearSystemCookie($cookies);

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

GreetingController.$inject = ['$location', '$cookies', 'TestService'];