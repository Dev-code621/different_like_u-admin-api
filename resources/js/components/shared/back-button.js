import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';

const BackButton = (props) => (
  <button type="button" className="btn ghost sm text-left uppercase">
    <Link to={props.to}>
      <i className="icon-arrow-left mr-4" />
      Back
    </Link>
  </button>
);

BackButton.propTypes = {
  to: PropTypes.string.isRequired
};

export default BackButton;
