import $ from "jquery";

import CONSTANTS from './system/constants';

const STORAGE_FAIL_ANSWER_NAME = "fail-answer";
const STORAGE_FAIL_ANSWER_IDENTITY_NAME = "fail-answer-id";

export default class RuController {
	constructor($state, $cookies, $sessionStorage, $mdDialog, $mdToast, WordRuService, FailAnswerService) {
		this.$mdDialog = $mdDialog;
		this.$mdToast = $mdToast;
		this.$cookies = $cookies;
		this.$sessionStorage = $sessionStorage;
		this.$state = $state;

		this.wordRuResource = WordRuService.getResource();
		this.failAnswerResource = FailAnswerService.getResource();

		this.wordRuResource.query().$promise.then(
			(data) => {
				this.words = data;
			}
		);

		this.clickedElements = [];
	}

	answer ($event, id, index) {
		if(this.clickedElements.indexOf(id) == -1) {
			let element = $($event.target).parent();
			this.wordRuResource.query({id: id}).$promise.then(
				(data) => {
					let errorData = {
						"word": this.words.word.word,
						"selected": this.words.transfer[index].word
					};

					let testId = this.$cookies.get('test-id');
					let failAnswer = JSON.parse(this.$sessionStorage.get(STORAGE_FAIL_ANSWER_NAME));

					if (data.word != this.words.word.word) {
						if(!failAnswer) {
							this.$sessionStorage.put(
                                STORAGE_FAIL_ANSWER_NAME,
								JSON.stringify([errorData])
							);
							this.failAnswerResource.save(
								{
									"test_id": testId,
									"data": JSON.stringify(errorData)
								},
								(data) => {
									this.$sessionStorage.put(
										STORAGE_FAIL_ANSWER_IDENTITY_NAME,
										data.id
									);
								}
							);
						}
						else {
							failAnswer.push(errorData);
							this.$sessionStorage.put(
                                STORAGE_FAIL_ANSWER_NAME,
								JSON.stringify(failAnswer)
							);
							this.failAnswerResource.update(
								{
									"id": this.$sessionStorage.get(STORAGE_FAIL_ANSWER_IDENTITY_NAME),
									"test_id": testId,
									"data": JSON.stringify(failAnswer)
								},
							);
							if(failAnswer.length > CONSTANTS.COUNT_FAIL_ANSWERS) {
								this.$mdDialog.show(
									this.$mdDialog.alert()
										.clickOutsideToClose(true)
										.title('Провал...')
										.textContent(`Вы ошиблись больше ${CONSTANTS.COUNT_FAIL_ANSWERS} раз, попробуйте еще раз!`)
										.ok('Повторить')
								).
								then(() => {
									this.$state.go('greetings');
								});
								return;
							}
						}
						element.removeClass("blue").addClass("red");
						this.$mdToast.show(
							this.$mdToast.simple()
								.position("top left")
								.textContent('Неправильно, попробуйте еще раз!')
						);
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

RuController.$inject = ['$state', '$cookies', '$sessionStorage', '$mdDialog', '$mdToast', 'WordRuService', 'FailAnswerService'];