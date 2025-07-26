import React from 'react';
import { Column } from '@ant-design/charts';

const data = [
  { month: 'Jan', revenue: 6000 },
  { month: 'Feb', revenue: 8000 },
  { month: 'Mar', revenue: 7000 },
  { month: 'Apr', revenue: 9000 },
];

export default function RevenueChart() {
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
