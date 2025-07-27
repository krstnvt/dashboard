import React, { useState, useEffect } from 'react';
import { Card, Row, Col, Statistic, Typography, Space, Badge } from 'antd';
import { DollarOutlined, UserOutlined, RiseOutlined, ThunderboltOutlined } from '@ant-design/icons';
import RevenueChart from './components/RevenueChart.jsx';
import DevicePieChart from './components/DevicePieChart.jsx';
import ActivityChart from './components/ActivityChart.jsx';
import VisitsChart from './components/VisitsChart.jsx';

const { Title } = Typography;

export default function AnalyticsPage() {
  const [analytics, setAnalytics] = useState({ revenue: 0, users: 0, ctr: 0, signups: 0 });

  useEffect(() => {
    fetch('/api/analytics')
      .then(res => res.json())
      .then(setAnalytics);
  }, []);

  return (
    <div style={{ background: '#f0f2f5', minHeight: '100vh', padding: '24px' }}>
      <div style={{ marginBottom: '24px' }}>
        <Title level={2} style={{ margin: 0, color: '#1f1f1f' }}>Analytics Dashboard</Title>
        <p style={{ color: '#8c8c8c', margin: '8px 0 0 0' }}>Welcome to your analytics overview</p>
      </div>

      <Row gutter={[24, 24]}>
        <Col xs={24} sm={12} lg={6}>
          <Card hoverable>
            <Statistic 
              title="Total Revenue" 
              value={analytics.revenue} 
              prefix={<DollarOutlined style={{ color: '#52c41a' }} />}
              valueStyle={{ color: '#52c41a' }}
            />
          </Card>
        </Col>
        <Col xs={24} sm={12} lg={6}>
          <Card hoverable>
            <Statistic 
              title="Total Users" 
              value={analytics.users} 
              prefix={<UserOutlined style={{ color: '#1890ff' }} />}
              valueStyle={{ color: '#1890ff' }}
            />
          </Card>
        </Col>
        <Col xs={24} sm={12} lg={6}>
          <Card hoverable>
            <Statistic 
              title="Click Through Rate" 
              value={analytics.ctr} 
              suffix="%"
              prefix={<RiseOutlined style={{ color: '#722ed1' }} />}
              valueStyle={{ color: '#722ed1' }}
              precision={1}
            />
          </Card>
        </Col>
        <Col xs={24} sm={12} lg={6}>
          <Card hoverable>
            <Statistic 
              title="Total Signups" 
              value={analytics.signups} 
              prefix={<ThunderboltOutlined style={{ color: '#fa8c16' }} />}
              valueStyle={{ color: '#fa8c16' }}
            />
          </Card>
        </Col>
      </Row>

      <Row gutter={[24, 24]} style={{ marginTop: '24px' }}>
        <Col xs={24} lg={12}>
          <Card title="Revenue Trends" hoverable>
            <RevenueChart />
          </Card>
        </Col>
        <Col xs={24} lg={12}>
          <Card title="Device Distribution" hoverable>
            <DevicePieChart />
          </Card>
        </Col>
      </Row>

      <Row gutter={[24, 24]} style={{ marginTop: '24px' }}>
        <Col xs={24} lg={12}>
          <Card title="Activity by Hour" hoverable>
            <ActivityChart />
          </Card>
        </Col>
        <Col xs={24} lg={12}>
          <Card title="Daily Visits" hoverable>
            <VisitsChart />
          </Card>
        </Col>
      </Row>
    </div>
  );
}
