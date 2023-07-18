import React, { PureComponent } from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { authActions } from '@/store/modules/auth';
import Gate from './gate';

class Authenticated extends PureComponent {
  constructor(props) {
    super(props);

    this.state = {};
  }

  componentDidMount() {
    this.props.me();
  }

  render() {
    const { user, error, layout, component } = this.props;

    if (user && !error) {
      return (
        <Gate
          component={component}
          Layout={layout}
        />
      );
    }

    return null;
  }
}

Authenticated.defaultProps = {
  user: null,
  error: null
};

Authenticated.propTypes = {
  component: PropTypes.func.isRequired,
  layout: PropTypes.func.isRequired,
  me: PropTypes.func.isRequired,
  user: PropTypes.object,
  error: PropTypes.string
};

const mapStateToProps = (state) => ({
  error: state.auth.error,
  user: state.auth.user
});

export default connect(mapStateToProps, {
  me: authActions.me
})(Authenticated);
