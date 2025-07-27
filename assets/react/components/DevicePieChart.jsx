import React, { useState, useEffect } from 'react';
import { Pie } from '@ant-design/charts';

export default function DevicePieChart() {
  const [data, setData] = useState([]);

  useEffect(() => {
    fetch('/api/analytics/devices')
      .then(res => res.json())
      .then(setData);
  }, []);

  const config = {
    data,
    angleField: 'value',
    colorField: 'type',
    height: 250,
    radius: 1,
    label: { type: 'inner', offset: '-30%', content: '{value}' },
    interactions: [{ type: 'element-active' }],
  };

  return <Pie {...config} />;
}
