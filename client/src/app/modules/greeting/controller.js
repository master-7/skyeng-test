export default class GreetingController {
	constructor(TestService) {
		this.nameMaxLength = 255;
		this.username = "";

		this.testResource = TestService.getResource();
	}

	startTest() {
		this.testResource.save(
			{
				"username": this.username
			},
			function (data) {
				console.log("Good");
				console.log(data);
			},
			function (error) {
				console.log("Bad");
				console.log(error);
			}
		);
	}
}

GreetingController.$inject = ['TestService'];