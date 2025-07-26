import React from 'react';
import { Card, Row, Col, Statistic, Avatar, Typography } from 'antd';
import { DollarOutlined, UserOutlined, RiseOutlined, ThunderboltOutlined } from '@ant-design/icons';
import RevenueChart from './components/RevenueChart.jsx';
import DevicePieChart from './components/DevicePieChart.jsx';
import ActivityChart from './components/ActivityChart.jsx';
import VisitsChart from './components/VisitsChart.jsx';

const { Title, Text } = Typography;

export default function AnalyticsPage() {
  return (
    <Row gutter={16}>
      <Col span={6}>
        <Card style={{ textAlign: 'center' }}>
          <Avatar size={120} style={{ marginBottom: 16 }} src="https://wallpapers.com/images/hd/default-profile-picture-placeholder-kal8zbcust2luxh3.jpg" />
          <Title level={4}>Администратор</Title>
          <Text>Добро пожаловать в панель управления</Text>
        </Card>
      </Col>

      <Col span={18}>
        <Row gutter={16}>
          <Col span={12}>
            <Card>
              <Statistic title="Revenue" value={42000} prefix={<DollarOutlined />} />
              <h3 style={{ marginTop: 24, marginBottom: 12 }}>Revenue Over Months</h3>
              <RevenueChart />
            </Card>
          </Col>

          <Col span={6}>
            <Card>
              <h3 style={{ marginTop: 24, marginBottom: 12 }}>Devices Pie Chart</h3>
              <DevicePieChart />
            </Card>
          </Col>

          <Col span={6}>
            <Card>
              <h3 style={{ marginTop: 24, marginBottom: 12 }}>Activity</h3>
              <ActivityChart />
            </Card>
          </Col>

          <Col span={6}>
            <Card>
              <h3 style={{ marginTop: 24, marginBottom: 12 }}>Visits</h3>
              <VisitsChart />
            </Card>
          </Col>
        </Row>
      </Col>
    </Row>
  );
}
