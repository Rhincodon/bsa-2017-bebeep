import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { bindActionCreators } from 'redux';
import { connect } from 'react-redux';

import { getVehicle } from '../actions';

class VehicleProfile extends Component {

    constructor(props) {
        super(props);

        this.props.getVehicle(this.props.id);
    }

    render() {
        const { vehicle } = this.props.vehicleState;

        return (
            <div className="card">
              <div className="card-block">
                <h4 className="card-title">{ vehicle.name }</h4>
                <p className="card-text">{ vehicle.type }</p>
              </div>
            </div>
        );
    }
}

VehicleProfile.propTypes = {
    getVehicle: PropTypes.func,
};

const VehicleProfileConnected = connect(
    (state) => {
        return { vehicleState: state.vehicle };
    },
    (dispatch) => bindActionCreators({ getVehicle }, dispatch)

)(VehicleProfile);

export default VehicleProfileConnected;
