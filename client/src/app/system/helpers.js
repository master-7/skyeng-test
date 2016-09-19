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
     */
    static clearSystemCookie ($cookies) {
        $cookies.remove("test-id");
    }
}