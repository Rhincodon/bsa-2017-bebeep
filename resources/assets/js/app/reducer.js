import { combineReducers } from 'redux';

import user from '../features/user/reducer';
import trip from '../features/trip/reducer';
import vehicle from '../features/vehicle/reducer';

export default combineReducers({
    user,
    trip,
    vehicle,
});
