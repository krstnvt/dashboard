import React from 'react';
import { createRoot } from 'react-dom/client';
import AnalyticsPage from './react/AnalyticsPage.jsx';
import 'antd/dist/reset.css';

const rootElement = document.getElementById('analytics-page');
if (rootElement) {
  const root = createRoot(rootElement);
  root.render(<AnalyticsPage />);
}
