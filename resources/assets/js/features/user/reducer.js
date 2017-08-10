import * as actions from './actionTypes';

const initialState = {
    login: {
        success: false,
        errors: {}
    }
};

export default function (state = initialState, action) {
    switch(action.type) {
        case actions.LOGIN_SUCCESS:
            return {
                ...state,
                login: {
                    success: true,
                    errors: {}
                }
            };
        case actions.LOGIN_FAILED_NOUSER:
            return {
                ...state,
                login: {
                    ...state.login,
                    errors: action.data,
                    success: false
                }
            };

        case actions.LOGIN_FAILED_NOACTIVATION:
            return {
                ...state,
                login: {
                    ...state.login,
                    errors: action.data,
                    success: false
                }
            };

        default: {
            return state;
        }
    }
};
