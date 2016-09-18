export default class RuController {
	constructor(WordRuService) {
		WordRuService.getResource().query().$promise.then(
			(data) => {
				this.words = data;
			}
		);
	}

	getRandomColor() {
		let color = [
			"green",
			"yellow",
			"blue",
			"purple",
			"red"
		];

		let colorClass = color[
			Math.floor(Math.random()*color.length)
		];

		while(document.querySelector("." + colorClass)) {
			colorClass = color[
				Math.floor(Math.random()*color.length)
			];
		}

		return colorClass;
	}
}

RuController.$inject = ['WordRuService'];