import React from 'react';
import { Line } from '@ant-design/charts';

const data = [
  { day: 'Mon', value: 200 },
  { day: 'Tue', value: 400 },
  { day: 'Wed', value: 350 },
  { day: 'Thu', value: 500 },
  { day: 'Fri', value: 700 },
  { day: 'Sat', value: 600 },
  { day: 'Sun', value: 300 },
];

export default function VisitsChart() {
  const config = {
    data,
    xField: 'day',
    yField: 'value',
    point: { size: 5, shape: 'diamond' },
    smooth: true,
    height: 300,
  };

  return <Line {...config} />;
}
