import React, { useState, useEffect } from 'react';
import { Column } from '@ant-design/charts';

export default function RevenueChart() {
  const [data, setData] = useState([]);

  useEffect(() => {
    fetch('/api/analytics/revenue')
      .then(res => res.json())
      .then(setData);
  }, []);

  const config = {
    data,
    xField: 'month',
    yField: 'revenue',
    height: 250,
    color: '#388e3c',
    columnWidthRatio: 0.6,
    label: { position: 'middle', style: { fill: '#fff' } },
  };

  return <Column {...config} />;
}
