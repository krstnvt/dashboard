import React, { useState, useEffect } from 'react';
import { Area } from '@ant-design/charts';

export default function ActivityChart() {
  const [data, setData] = useState([]);

  useEffect(() => {
    fetch('/api/analytics/activity')
      .then(res => res.json())
      .then(setData);
  }, []);

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
