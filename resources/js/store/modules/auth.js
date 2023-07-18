import { createAction, createReducer } from 'redux-starter-kit';

// Get Me
const me = createAction('auth/me');
const meSuccess = createAction('auth/meSuccess');
const meError = createAction('auth/meError');

// logout
const logout = createAction('auth/logout');

// Shared
const resetError = createAction('auth/resetError');

export const authActions = {
  me,
  meSuccess,
  meError,
  resetError,
  logout
};

// Initial State
const initialState = {
  user: null,
  error: null
};

// Reducer
export default createReducer(initialState, {
  // Reducer for me
  [me.type]: (state) => {
    state.loading = true;
    state.error = null;
  },
  [meSuccess.type]: (state, action) => {
    state.loading = false;
    state.user = action.payload;
    state.error = null;
  },
  [meError.type]: (state, action) => {
    state.loading = false;
    state.error = action.payload;
  },
  [logout.type]: (state) => {
    state.loading = false;
    state.user = null;
    state.error = null;
  },
  // Reducer for shared actions
  [resetError.type]: (state) => {
    state.error = null;
  }
});
