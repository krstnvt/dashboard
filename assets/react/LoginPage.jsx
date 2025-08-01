import React from 'react';
import { Form, Input, Button, Card, Alert } from 'antd';
import { UserOutlined, LockOutlined } from '@ant-design/icons';

export default function LoginPage({ error, lastUsername }) {
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
        title="Sign In" 
        style={{ width: 400, boxShadow: '0 4px 12px rgba(0,0,0,0.15)' }}
      >
        {error && (
          <Alert 
            message={error} 
            type="error" 
            style={{ marginBottom: 16 }} 
          />
        )}
        
        <form method="post" onSubmit={handleSubmit}>
          <div style={{ marginBottom: 16 }}>
            <label style={{ display: 'block', marginBottom: 8 }}>Username</label>
            <Input 
              prefix={<UserOutlined />}
              name="_username"
              defaultValue={lastUsername}
              size="large"
              required
            />
          </div>
          
          <div style={{ marginBottom: 16 }}>
            <label style={{ display: 'block', marginBottom: 8 }}>Password</label>
            <Input.Password 
              prefix={<LockOutlined />}
              name="_password"
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
            Sign In
          </Button>
        </form>
        
        <div style={{ textAlign: 'center' }}>
          <a href="/register">Don't have an account? Sign Up</a>
        </div>
      </Card>
    </div>
  );
}