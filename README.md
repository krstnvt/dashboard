# Analytics Dashboard

A modern analytics dashboard built with Symfony and React, featuring real-time data visualization and user authentication.

## Tech Stack

### Backend
- **PHP 8.3+** - Latest PHP version with improved performance and type system
- **Symfony 7.3** - Robust PHP framework for enterprise applications
- **PostgreSQL** - Reliable relational database for data persistence
- **Doctrine ORM** - Database abstraction layer and object-relational mapping

### Frontend
- **React 19.1** - Latest React version with improved performance and concurrent features
- **Ant Design 5.26** - Professional UI component library chosen for:
  - Comprehensive set of high-quality components
  - Consistent design language
  - Built-in accessibility features
  - Excellent TypeScript support
  - Enterprise-grade reliability
- **Ant Design Charts 2.6** - Data visualization library built on G2Plot
- **Webpack Encore** - Asset management and bundling

### Development Tools
- **Docker & Docker Compose** - Containerized development environment
- **Symfony UX** - Integration between Symfony and modern frontend tools
- **Asset Mapper** - Modern asset management for Symfony

## Features

- 🔐 User authentication (login/register)
- 📊 Interactive analytics dashboard with:
  - Revenue trends chart
  - Device distribution pie chart
  - Activity by hour area chart
  - Daily visits line chart
- 📱 Responsive design
- 🎨 Modern UI with Ant Design components
- 🔄 Real-time data from PostgreSQL database

## Installation & Setup

### Prerequisites
- Docker and Docker Compose

### 1. Clone the repository
```bash
git clone <repository-url>
cd kristina-safonova
```

### 2. Configure environment (for production)
```bash
# Copy example environment file
cp .env.example .env

# Edit .env and set secure passwords
# POSTGRES_PASSWORD=your_secure_password_here
```

### 3. Start the application (one command!)
```bash
docker-compose up --build
```

This single command will:
- Build the PHP/Symfony container with Node.js
- Build the Nginx container
- Start PostgreSQL database
- Install PHP dependencies
- Install Node.js dependencies and build frontend assets
- Run database migrations
- Load dummy test data automatically
- Start all services

### 4. Access the application
- Open your browser and go to `http://localhost:8000`
- Login with credentials: `admin` / `password`
- Or register a new account

## Development

### Start development server
```bash
docker-compose up --build
```

### Load test data
Test data is loaded automatically on startup. To reload manually:
```bash
docker-compose exec app php bin/console app:load-dummy-data
```

This command creates:
- 51 users (admin + user1-user50) with password "password"
- 6 revenue records for different months
- 100 activity records (clicks, signups, views, purchases)
- 30 visit records for the last 30 days
- 3 device statistics records (desktop, mobile, tablet)

## Project Structure

```
├── assets/                 # Frontend assets
│   ├── react/             # React components
│   │   ├── components/    # Chart components
│   │   ├── AnalyticsPage.jsx
│   │   ├── LoginPage.jsx
│   │   └── RegisterPage.jsx
│   └── app.js            # Main JavaScript entry point
├── src/
│   ├── Controller/       # Symfony controllers
│   ├── Entity/          # Database entities
│   ├── Repository/      # Data access layer
│   ├── Service/         # Business logic
│   ├── Command/         # Console commands
│   └── DTO/            # Data transfer objects
├── templates/           # Twig templates
├── migrations/         # Database migrations
├── docker/             # Docker configuration
│   └── nginx/          # Nginx configuration
├── Dockerfile          # Main application container
└── compose.yaml        # Docker Compose configuration
```

## API Endpoints

- `GET /` - Login page
- `GET /register` - Registration page
- `GET /dashboard` - Analytics dashboard (requires authentication)
- `GET /api/analytics` - Main analytics data
- `GET /api/analytics/revenue` - Revenue chart data
- `GET /api/analytics/visits` - Visits chart data
- `GET /api/analytics/devices` - Device statistics
- `GET /api/analytics/activity` - Activity chart data
- `POST /logout` - User logout

## Why Ant Design?

Ant Design was chosen as the UI framework because:

1. **Enterprise-Ready**: Designed for professional applications with consistent design patterns
2. **Comprehensive Components**: Rich set of components including advanced charts and data visualization
3. **Accessibility**: Built-in ARIA support and keyboard navigation
4. **Performance**: Optimized components with tree-shaking support
5. **Developer Experience**: Excellent documentation and TypeScript support
6. **Consistency**: Unified design language across all components
7. **Charts Integration**: Seamless integration with @ant-design/charts for data visualization

## Database Schema

The application uses the following main entities:
- `User` - User accounts and authentication
- `Revenue` - Monthly revenue data
- `Activity` - User activity tracking (clicks, signups, etc.)
- `Visit` - Daily visit statistics
- `DeviceStat` - Device usage statistics

## Docker Architecture

The application runs in 3 containers:
- **app**: PHP 8.3-FPM with Symfony application and Node.js for asset building
- **webserver**: Nginx reverse proxy serving the application
- **database**: PostgreSQL 16 for data persistence

All containers are orchestrated with Docker Compose and start with a single command.

## Testing

The application includes comprehensive tests covering critical functionality:

### Running Tests
```bash
# Run all tests
docker-compose exec app php bin/phpunit

# Run specific test suite
docker-compose exec app php bin/phpunit tests/Controller/
docker-compose exec app php bin/phpunit tests/Service/
docker-compose exec app php bin/phpunit tests/Entity/
```

### Test Coverage
- **Controller Tests**: Authentication, API endpoints, response validation
- **Service Tests**: Business logic, data processing, analytics calculations
- **Entity Tests**: User model validation and methods
- **Command Tests**: Data loading and console commands

### Test Categories
1. **Authentication Tests**: Login/logout functionality
2. **API Tests**: All analytics endpoints return valid JSON
3. **Security Tests**: Protected routes require authentication
4. **Data Tests**: Analytics service returns correct data structure
5. **Integration Tests**: End-to-end user workflows

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests: `docker-compose exec app php bin/phpunit`
5. Ensure all tests pass
6. Submit a pull request

## License

This project is proprietary software.