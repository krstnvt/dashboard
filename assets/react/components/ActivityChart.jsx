import React from 'react';
import { Area } from '@ant-design/charts';

const data = [
  { hour: '8am', active: 20 },
  { hour: '10am', active: 50 },
  { hour: '12pm', active: 70 },
  { hour: '2pm', active: 65 },
  { hour: '4pm', active: 90 },
  { hour: '6pm', active: 60 },
  { hour: '8pm', active: 30 },
];

export default function ActivityChart() {
  const config = {
    data,
    xField: 'hour',
    yField: 'active',
    height: 250,
    smooth: true,
    areaStyle: { fill: 'l(270) 0:#7b1fa2 1:#ffffff00' },
    color: '#7b1fa2',
  };

  return <Area {...config} />;
}
