import React, { useState } from 'react';
import { Form, Input, Button, Typography, Card } from 'antd';
import { UserOutlined, LockOutlined } from '@ant-design/icons';

const { Title } = Typography;

export default function LoginPage() {
  const [loading, setLoading] = useState(false);

  const onFinish = (values) => {
    setLoading(true);
    // TODO: Replace with actual API call
    fetch('/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `_username=${encodeURIComponent(values.username)}&_password=${encodeURIComponent(values.password)}`
    })
      .then(res => {
        if (res.ok) window.location.href = '/dashboard';
        else alert('Login failed');
      })
      .finally(() => setLoading(false));
  };

  return (
    <div style={{ height: '100vh', display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
      <Card style={{ width: 360 }}>
        <Title level={3} style={{ textAlign: 'center' }}>Sign In</Title>
        <Form name="login" onFinish={onFinish}>
          <Form.Item name="username" rules={[{ required: true, message: 'Please input your username!' }]}>
            <Input prefix={<UserOutlined />} placeholder="Username or Email" />
          </Form.Item>

          <Form.Item name="password" rules={[{ required: true, message: 'Please input your password!' }]}>
            <Input.Password prefix={<LockOutlined />} placeholder="Password" />
          </Form.Item>

          <Form.Item>
            <Button loading={loading} type="primary" htmlType="submit" block>
              Log in
            </Button>
          </Form.Item>
        </Form>
      </Card>
    </div>
  );
}
