import $ from "jquery";

export default class RuController {
	constructor(WordRuService) {
		this.wordRuResource = WordRuService.getResource();
		this.wordRuResource.query().$promise.then(
			(data) => {
				this.words = data;
			}
		);

		this.clickedElements = [];
	}

	answer ($event, id) {
		if(this.clickedElements.indexOf(id) == -1) {
			let element = $($event.target).parent();
			this.wordRuResource.query({id: id}).$promise.then(
				(data) => {
					if (data.word != this.words.word.word) {
						element.removeClass("blue").addClass("red");
					}
					else {
						element.removeClass("blue").addClass("green");
					}
				}
			);
			this.clickedElements.push(id);
		}
	}
}

RuController.$inject = ['WordRuService'];