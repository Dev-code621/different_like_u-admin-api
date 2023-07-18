import React from 'react';
import { connect } from 'react-redux';
import PropTypes from 'prop-types';
import { authActions } from '@/store/modules/auth';

class Header extends React.Component {
  logout() {
    this.props.logout();
  }

  render() {
    const { user } = this.props;

    return (
      <header className="header px-view">
        <div className="flex items-center relative h-header">
              <div className="logo">
                {/* <img src="https://domandtom.com/wp-content/themes/domandtom/assets/images/logo.png" className="h-10" alt="logo" />*/}
                <a href="#">Sacki</a>
              </div>
              <nav className="ml-auto flex items-center ml-auto">
                <a href="#" activeclassname="font-archivo font-bold" className="ml-10 header-contact-menu"> Contact Us</a>
              {
                user ? (
                    <button type="button" activeclassname="font-archivo font-bold" className="header-login-logout border-2 border-purple-500 hover:border-gray-50" onClick={this.logout.bind(this)}>Logout</button>
                ) : (
                    <a href="/login" activeclassname="font-archivo font-bold" className="header-login-logout border-2 border-purple-500 hover:border-gray-50">Log in</a>
                )
              }
              </nav>
            </div>
      </header>
    );
  }
}

Header.defaultProps = {
  user: null
};

Header.propTypes = {
  user: PropTypes.object,
  logout: PropTypes.func.isRequired
};


const mapStateToProps = (state) => ({
  user: state.auth.user
});


export default connect(mapStateToProps, {
  logout: authActions.logout
})(Header);
