import $ from "jquery";

import CONSTANTS from '../../system/constants';

const STORAGE_FAIL_ANSWER_NAME = "fail-answer";
const STORAGE_FAIL_ANSWER_IDENTITY_NAME = "fail-answer-id";
const STORAGE_PASSED_WORDS_NAME = "passed-words";

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
	}

	/**
	 * @param $event
	 * @param id
	 * @param index
	 */
	answerEventHandler ($event, id, index) {
		let element = $($event.target).parent();
		if(!$(element).hasClass("red green")) {
			let errorData = {
				"word": this.words.word.word,
				"selected": this.words.transfer[index].word
			};
			this.wordRuResource.query({id: id}).$promise.then(
				(data) => {
					let testId = this.$cookies.get('test-id');
					let failAnswer = JSON.parse(this.$sessionStorage.get(STORAGE_FAIL_ANSWER_NAME));

					if (data.word != this.words.word.word) {
						this.notCorrectAnswer(element, testId, failAnswer, errorData);
					}
					else {
						this.correctAnswer(id, element);
					}
				}
			);
		}
	}

	/**
	 * If the user has made the right choice
	 * @param element
	 */
	correctAnswer (id, element) {
		let passedWords = JSON.parse(
			this.$sessionStorage.get(STORAGE_PASSED_WORDS_NAME)
		);
		if (!passedWords) {
			passedWords = [id];
			this.$sessionStorage.put(
				STORAGE_PASSED_WORDS_NAME,
				JSON.stringify([id])
			);
		}
		else {
			passedWords.push(id);
			this.$sessionStorage.put(
				STORAGE_PASSED_WORDS_NAME,
				JSON.stringify(passedWords)
			);
		}
		element.removeClass("blue").addClass("green");
		$(".pointer").removeClass("red green").addClass("blue");
		this.wordRuResource.query({
			"passed": JSON.stringify(passedWords)
		}).$promise.then(
			(data) => {
				if(data.word)
					this.words = data;
				else
					this.$mdDialog.show(
						this.$mdDialog.alert()
							.clickOutsideToClose(true)
							.title('Готово!')
							.textContent(`Конец!`)
							.ok('Повторить')
					).
					then(() => {
						this.$state.go('greetings');
					});
				return;
			}
		);
	}

	/**
	 * If the user has made the right fail choice
	 * @param element
	 * @param testId
	 * @param failAnswer
	 * @param errorData
	 */
	notCorrectAnswer (element, testId, failAnswer, errorData) {
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
}

RuController.$inject = ['$state', '$cookies', '$sessionStorage', '$mdDialog', '$mdToast', 'WordRuService', 'FailAnswerService'];