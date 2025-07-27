import React, { useState, useEffect } from 'react';
import { Line } from '@ant-design/charts';

export default function VisitsChart() {
  const [data, setData] = useState([]);

  useEffect(() => {
    fetch('/api/analytics/visits')
      .then(res => res.json())
      .then(setData);
  }, []);

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
