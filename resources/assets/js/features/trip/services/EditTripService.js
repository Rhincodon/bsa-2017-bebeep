import { securedRequest } from '../../../app/services/RequestService';
import moment from 'moment';

const EditTripService = {
    getTrip(id) {
        return securedRequest.get('/api/v1/trips/show/'+id)
            .then(
                response => Promise.resolve(response.data),
                error => Promise.reject(error.response.data)
            );
    },
    transformData(response) {
        response.start_at = moment(response.start_at +`0000`, "YYYY-MM-DD HH:mm:ss Z").format("YYYY-MM-DDThh:mm");
        response.price = parseInt(response.price);
        return response;
    }
};

export default EditTripService;