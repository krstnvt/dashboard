import React from 'react';
import { createRoot } from 'react-dom/client';
import AnalyticsPage from './react/AnalyticsPage.jsx';
import LoginPage from './react/LoginPage.jsx';
import RegisterPage from './react/RegisterPage.jsx';
import 'antd/dist/reset.css';

const analyticsElement = document.getElementById('analytics-page');
if (analyticsElement) {
  const root = createRoot(analyticsElement);
  root.render(<AnalyticsPage />);
}

const loginElement = document.getElementById('login-page');
if (loginElement) {
  const root = createRoot(loginElement);
  const { error, lastUsername } = window.loginData || {};
  root.render(<LoginPage error={error} lastUsername={lastUsername} />);
}

const registerElement = document.getElementById('register-page');
if (registerElement) {
  const root = createRoot(registerElement);
  root.render(<RegisterPage />);
}
