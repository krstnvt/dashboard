import React from 'react';
import { Form, Input, Button, Card } from 'antd';
import { UserOutlined, LockOutlined } from '@ant-design/icons';

export default function RegisterPage() {
  const handleSubmit = (e) => {
    e.target.submit();
  };

  return (
    <div style={{ 
      minHeight: '100vh', 
      display: 'flex', 
      alignItems: 'center', 
      justifyContent: 'center',
      background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'
    }}>
      <Card 
        title="Sign Up" 
        style={{ width: 400, boxShadow: '0 4px 12px rgba(0,0,0,0.15)' }}
      >
        <form method="post" onSubmit={handleSubmit}>
          <div style={{ marginBottom: 16 }}>
            <label style={{ display: 'block', marginBottom: 8 }}>Username</label>
            <Input 
              prefix={<UserOutlined />}
              name="name"
              size="large"
              required
            />
          </div>
          
          <div style={{ marginBottom: 16 }}>
            <label style={{ display: 'block', marginBottom: 8 }}>Password</label>
            <Input.Password 
              prefix={<LockOutlined />}
              name="password"
              size="large"
              required
            />
          </div>
          
          <Button 
            type="primary" 
            htmlType="submit" 
            size="large" 
            block
            style={{ marginBottom: 16 }}
          >
            Sign Up
          </Button>
        </form>
        
        <div style={{ textAlign: 'center' }}>
          <a href="/">Already have an account? Sign In</a>
        </div>
      </Card>
    </div>
  );
}