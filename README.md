# Thambapanni Travel Management System

A comprehensive Laravel-based travel management system designed for Sri Lankan travel agencies. This system provides a complete solution for managing travel packages, customer bookings, and business operations.

## Features

### 🏠 Public Features
- **Homepage**: Beautiful landing page showcasing Sri Lanka travel experiences
- **Package Browsing**: View all available travel packages with detailed information
- **Package Details**: Comprehensive package information including highlights, itinerary, inclusions/exclusions
- **Contact Form**: Customer inquiry submission system
- **About & Services**: Company information and service offerings

### 👤 Customer Features
- **User Registration & Authentication**: Secure customer account management
- **Package Booking**: Easy booking system with traveler count and date selection
- **Payment Processing**: Integrated payment system (simulated)
- **Booking Management**: View, track, and cancel bookings
- **Personal Dashboard**: Overview of booking history and spending

### 🛡️ Admin Features
- **Dashboard**: Comprehensive business overview with key metrics
- **Package Management**: Create, edit, and manage travel packages
- **Image Upload**: Support for package images with automatic storage
- **Booking Management**: Monitor and update booking statuses
- **Customer Management**: View customer accounts and activity
- **Contact Management**: Handle customer inquiries and update statuses
- **Reports & Analytics**: Business insights with charts and statistics

## Technology Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Breeze with role-based access control
- **File Storage**: Laravel Storage with public disk
- **Charts**: Chart.js for data visualization

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (for frontend assets)

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd thambapanni10
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database in .env**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=thambapanni_travel
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Create storage link**
   ```bash
   php artisan storage:link
   ```

8. **Build frontend assets**
   ```bash
   npm run build
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

## Default Accounts

After running the seeders, you'll have these default accounts:

### Admin Account
- **Email**: admin@thambapanni.com
- **Password**: password
- **Role**: Admin (full access)

### Customer Account
- **Email**: customer@example.com
- **Password**: password
- **Role**: Customer (limited access)

## System Structure

### Models
- **User**: Customer and admin user management
- **Package**: Travel package information and details
- **Booking**: Customer booking records
- **Contact**: Customer inquiry submissions

### Controllers
- **HomeController**: Public pages and contact form
- **AdminController**: Admin dashboard and management functions
- **CustomerController**: Customer booking and dashboard functions
- **Auth Controllers**: Authentication and user management

### Key Routes
- `/` - Homepage
- `/packages` - Package listing
- `/packages/{id}` - Package details
- `/admin/*` - Admin panel (requires admin role)
- `/customer/*` - Customer area (requires customer role)

## Features in Detail

### Package Management
- **Dynamic Fields**: Highlights, itinerary, inclusions, and exclusions as arrays
- **Image Support**: Automatic image upload and storage
- **Status Control**: Active/inactive package management
- **Flexible Pricing**: Support for various pricing models

### Booking System
- **Real-time Validation**: Traveler count and date validation
- **Status Tracking**: Multiple booking and payment statuses
- **Reference Numbers**: Unique booking references for tracking
- **Payment Integration**: Simulated payment processing

### Admin Dashboard
- **Key Metrics**: Revenue, bookings, customers, and growth statistics
- **Visual Charts**: Monthly booking trends and package performance
- **Quick Actions**: Status updates and management functions
- **Responsive Design**: Mobile-friendly admin interface

## Customization

### Adding New Roles
1. Update the `RoleSeeder.php` file
2. Add new permissions as needed
3. Run `php artisan db:seed --class=RoleSeeder`

### Package Fields
- Modify the `Package` model to add new fields
- Update migration files for database changes
- Modify admin forms and views accordingly

### Styling
- The system uses Tailwind CSS for styling
- Custom CSS can be added in `resources/css/app.css`
- Component styling in `resources/views/components/`

## Security Features

- **Role-based Access Control**: Admin and customer role separation
- **CSRF Protection**: Built-in Laravel CSRF protection
- **Input Validation**: Comprehensive form validation
- **File Upload Security**: Image type and size restrictions
- **Authentication**: Secure user authentication system

## Performance Optimization

- **Database Indexing**: Optimized database queries
- **Image Optimization**: Efficient image storage and retrieval
- **Caching**: Laravel's built-in caching mechanisms
- **Lazy Loading**: Efficient relationship loading

## Deployment

### Production Considerations
1. Set `APP_ENV=production` in `.env`
2. Configure proper database credentials
3. Set up SSL certificates
4. Configure web server (Apache/Nginx)
5. Set up proper file permissions
6. Configure backup systems

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
DB_CONNECTION=mysql
DB_HOST=your_db_host
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Support & Maintenance

### Regular Tasks
- Database backups
- Log file rotation
- Security updates
- Performance monitoring

### Troubleshooting
- Check Laravel logs in `storage/logs/`
- Verify database connections
- Check file permissions
- Monitor server resources

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Contact

For support or questions about this system, please contact the development team.

---

**Note**: This is a demonstration system. For production use, ensure proper security measures, testing, and compliance with local regulations.
