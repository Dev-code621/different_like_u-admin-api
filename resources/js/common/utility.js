// export all shared funtions
export const getLocalStorage = (key) => {
  const storage = localStorage.getItem(key);

  try {
    if (storage && storage !== '') {
      return JSON.parse(storage);
    }

    return null;
  } catch (e) {
    return storage;
  }
};

export const saveLocalStorage = (key, value) => {
  try {
    if (typeof value === 'object') {
      localStorage.setItem(key, JSON.stringify(value));
    } else {
      localStorage.setItem(key, value);
    }

    return null;
  } catch ( e ) {
    return null;
  }
};

export const removeLocalStorage = (key) => {
  try {
    localStorage.removeItem(key);

    return key;
  } catch ( e ) {
    return null;
  }
};

/**
 * Get user role
 * @param  {Array} roles
 * @return {String}    Current role
 */
export const getRole = (roles) => {
  try {
    return roles[0].name;
  } catch (ex) {
    return null;
  }
};

export const getUiFriendlyGraphqlErrors = (graphqlError) => {
  const errors = [];

  graphqlError.forEach((error) => {
    const { extensions: { errors: extErrors } } = error;
    const extErrorsEntries = Object.entries(extErrors);

    if (extErrorsEntries.length > 0 ) {
      /*
       * Loop through each extension error
       * and add it to the global error array
       */
      extErrorsEntries.forEach((extError) => {
        errors.push(extError[1]);
      });
    } else {
      // If not extension error is present, add the general error message
      const { message } = error;
      errors.push(message);
    }
  });

  return errors;
};
