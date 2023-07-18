import isEmpty from 'lodash/isEmpty';

export const hasValue = (val) => !isEmpty(val);

export const validEmail = (val) => {
  if (val && /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i.test(val)) {
    return true;
  }

  return false;
};

export default {
  hasValue,
  validEmail
};
