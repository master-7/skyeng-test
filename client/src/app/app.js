import angular from 'angular';
import angularMaterial from 'angular-material';
import uiRouter from 'angular-ui-router';
import ngResource from 'angular-resource';
import ngCookies from 'angular-cookies';
import ngSessionStorage from 'angular-sessionstorage';

import 'angular-material/angular-material.css';
import '../style/app.css';

import CONSTANTS from './system/constants';
import Helpers from './system/helpers';

import routing from './config/app.config';

//Import modules
import greeting from './modules/greeting';
import test from './modules/test';
import testRu from './modules/test_ru';
import testEng from './modules/test_eng';

import error404 from './modules/errors/404';
import errorUndefined from './modules/errors/undefined';

let modules = [
	//Modules
	greeting,
	test,
	testRu,
	testEng,
	error404,
	errorUndefined
];

//System dependencies
let systemModules = [
	angularMaterial,
	uiRouter,
	ngResource,
	ngCookies,
	ngSessionStorage
];

const MODULE_NAME = 'app';

angular.module(MODULE_NAME, systemModules.concat(modules))
	.config(routing)
	.run(function ($rootScope, $state, $mdToast, $cookies, $sessionStorage) {
		Helpers.clearSystemData($cookies, $sessionStorage);

		$rootScope.$on('$stateChangeError', (event, toState, toParams, fromState, fromParams, error) => {
			switch (error) {
				case CONSTANTS.ERRORS.USER_NOT_EXISTS:
					$state.go("greetings");
					$mdToast.show(
						$mdToast.simple()
							.position("top right")
							.textContent('Вы не представились!')
					);
					break;
			}
		});
});

export default MODULE_NAME;