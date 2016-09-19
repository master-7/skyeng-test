import $ from "jquery";

import CONSTANTS from '../../system/constants';

const STORAGE_FAIL_ANSWER_NAME = "fail-answer";
const STORAGE_FAIL_ANSWER_IDENTITY_NAME = "fail-answer-id";
const STORAGE_PASSED_WORDS_NAME = "passed-words";

export default class TestController {
	constructor($state, $cookies, $sessionStorage, $mdDialog, $mdToast, WordService, FailAnswerService, TestService) {
		this.$mdDialog = $mdDialog;
		this.$mdToast = $mdToast;
		this.$cookies = $cookies;
		this.$sessionStorage = $sessionStorage;
		this.$state = $state;

		this.wordResource = WordService.getResource();
		this.failAnswerResource = FailAnswerService.getResource();
		this.testResource = TestService.getResource();

		this.wordResource.query().$promise.then(
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
			this.wordResource.query({id: id}).$promise.then(
				(data) => {
					let testId = this.$cookies.get('test-id');
					let failAnswer = JSON.parse(this.$sessionStorage.get(STORAGE_FAIL_ANSWER_NAME));

					if (data.word != this.words.word.word) {
						this.notCorrectAnswer(element, testId, failAnswer, errorData);
					}
					else {
						this.correctAnswer(id, testId, element);
					}
				}
			);
		}
	}

	/**
	 * If the user has made the right choice
	 * @param id
	 * @param testId
	 * @param element
	 */
	correctAnswer (id, testId, element) {
		element.removeClass("blue").addClass("green");
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

		$(".red, .green").removeClass("red green").addClass("blue");

		this.testResource.update({id: testId}).$promise.then(
			(data) => {
				this.wordResource.query({
					"passed": JSON.stringify(passedWords)
				}).$promise.then(
					(data) => {
						if(data.word)
							this.words = data;
						else {
							this.testResource.query(
								{
									id: testId
								},
								(data) => {
									this.$mdDialog.show(
										this.$mdDialog.alert()
											.clickOutsideToClose(true)
											.title('Готово!')
											.textContent(`Вы набрали ${data.evaluation} баллов!`)
											.ok('Повторить')
									).then(() => {
										this.$state.go('greetings');
									});
								}
							);
						}
						return;
					}
				);
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
				this.testResource.query(
					{
						id: testId
					},
					(data) => {
						console.log(data);

						this.$mdDialog.show(
							this.$mdDialog.alert()
								.clickOutsideToClose(true)
								.title('Провал...')
								.textContent(
									`Вы ошиблись больше ${CONSTANTS.COUNT_FAIL_ANSWERS} раз,
									набрали ${data.evaluation} баллов, попробуйте еще раз!`
								)
								.ok('Повторить')
						).
						then(() => {
							this.$state.go('greetings');
						});
					}
				);
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