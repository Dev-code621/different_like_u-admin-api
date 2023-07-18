import Layout from '../layout/layout';
// Public Components
import Playground from '../home/playground';

// Private Components
import Home from '../home';

export const publicRoutes = [
  {
    key: 'root',
    exact: true,
    path: '/',
    component: Home,
    layout: Layout,
  }
];

export const privateRoutes = [
  {
    key: 'playground',
    exact: true,
    path: '/playground',
    component: Playground,
    layout: Layout
  }
];
