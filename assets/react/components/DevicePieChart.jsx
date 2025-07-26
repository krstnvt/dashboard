import React from 'react';
import { Pie } from '@ant-design/charts';

const data = [
  { type: 'Mobile', value: 400 },
  { type: 'Desktop', value: 300 },
  { type: 'Tablet', value: 100 },
];

export default function DevicePieChart() {
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
