import CONSTANTS from './constants';

export default class Helpers {
    constructor() {}

    /**
     * Check username for resolve section
     * @param $q
     * @param $cookies
     * @returns {*}
     */
    static checkUsername ($q, $cookies) {
        if (!$cookies.get("test-id")) {
            return $q.reject(CONSTANTS.ERRORS.USER_NOT_EXISTS);
        }
        return $q.resolve();
    }

    /**
     * @param $cookies
     * @param $sessionStorage
     */
    static clearSystemData ($cookies, $sessionStorage) {
        $cookies.remove("test-id");
        $sessionStorage.remove("passed-words");
        $sessionStorage.remove("fail-answer");
        $sessionStorage.remove("fail-answer-id");
    }
}