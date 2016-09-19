import angular from 'angular';
import angularMaterial from 'angular-material';
import uiRouter from 'angular-ui-router';
import ngResource from 'angular-resource';
import ngCookies from 'angular-cookies';

import 'angular-material/angular-material.css';
import '../style/app.css';

import routing from './config/app.config';

//Import modules
import greeting from './modules/greeting';
import test from './modules/test';
import testRu from './modules/ru';

import error404 from './modules/errors/404';
import errorUndefined from './modules/errors/undefined';

let modules = [
	//Modules
	greeting,
	test,
	testRu,
	error404,
	errorUndefined
];

//System dependencies
let systemModules = [
	angularMaterial,
	uiRouter,
	ngResource,
	ngCookies
];

const MODULE_NAME = 'app';

angular.module(MODULE_NAME, systemModules.concat(modules))
	.config(routing);

export default MODULE_NAME;