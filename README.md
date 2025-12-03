# 👨‍💼 Employee Management System

A simple yet powerful web-based Employee Management System built with PHP and MySQL. This application allows administrators to securely manage employee records through a clean, modern interface.

![Employee Management System](https://i.postimg.cc/Pfm2bc0D/a575087a-700b-46fb-924f-c62c4c4bd6f5.png)

## ✨ Features

### 🔐 **Secure Authentication**
- Admin login with password hashing
- Session-based authentication
- Protected admin-only routes

### 📋 **Full CRUD Operations**
- **Create**: Add new employees with comprehensive details
- **Read**: View all employees and individual profiles
- **Update**: Edit employee information
- **Delete**: Remove employees from the system

### 🎨 **Modern Interface**
- Responsive Bootstrap 5 design
- Professional dashboard with statistics
- Clean and intuitive navigation
- Attractive login page with gradient design

### 👥 **Employee Management**
- View employee list with search/sort capabilities
- Detailed employee profiles
- Department categorization
- Employment information tracking

## 🚀 Quick Start

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Composer (optional)

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/employee-management-system.git
cd employee-management-system
```

2. **Create MySQL Database**
```sql
CREATE DATABASE employee_management;
USE employee_management;

-- Create admins table
CREATE TABLE admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create employees table
CREATE TABLE employees (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    department VARCHAR(50),
    position VARCHAR(50),
    salary DECIMAL(10,2),
    hire_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin (username: admin, password: admin123)
INSERT INTO admins (username, password, email) 
VALUES ('admin', '$2y$10$KlWWCmMst2uQWBqwYj5vMOrZTvKzjqSjZZc1g4V7YUltTfw1lmbgm', 'admin@example.com');
```

3. **Configure Database Connection**
Edit `config/database.php`:
```php
private $host = "localhost";
private $db_name = "employee_management";
private $username = "root";  // Your MySQL username
private $password = "";      // Your MySQL password
```

4. **Set Up Project Structure**
Place all PHP files in your web server's document root:
```
htdocs/employee-management/
├── config/
│   └── database.php
├── login.php
├── index.php
├── employees.php
├── add_employee.php
├── view_employee.php
├── edit_employee.php
├── logout.php
├── navbar.php
└── sidebar.php
```

5. **Access the Application**
- Open your browser
- Navigate to: `http://localhost/employee-management/login.php`
- Login with:
  - **Username**: `admin`
  - **Password**: `admin123`

## 📁 Project Structure

```
employee-management/
├── config/
│   └── database.php        # Database configuration and connection
├── login.php              # Admin login page
├── index.php             # Admin dashboard
├── employees.php         # View all employees
├── add_employee.php      # Add new employee
├── view_employee.php     # View employee details
├── edit_employee.php     # Edit employee information
├── logout.php           # Logout functionality
├── navbar.php           # Navigation bar component
├── sidebar.php          # Sidebar navigation component
└── README.md           # This file
```

## 🛠️ Technical Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: Bootstrap 5, HTML5, CSS3
- **Security**: Password hashing, Prepared statements, Session management
- **Architecture**: PDO for database operations, Component-based structure

## 🔒 Security Features

- ✅ Password hashing with bcrypt
- ✅ SQL injection prevention using PDO prepared statements
- ✅ Session-based authentication
- ✅ Input validation and sanitization
- ✅ Access control for admin-only pages
- ✅ CSRF protection ready

## 🚀 Deployment

### For Production:
1. Change default admin credentials
2. Update database credentials
3. Enable HTTPS
4. Configure proper file permissions
5. Set up regular database backups
6. Configure error logging

### Environment Configuration:
```php
// In config/database.php for production
private $host = "production-db-host";
private $db_name = "employee_management";
private $username = "secure_username";
private $password = "strong_password_here";
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📋 To-Do / Roadmap

- [ ] Add search functionality
- [ ] Implement pagination
- [ ] Add employee photo upload
- [ ] Export data to CSV/PDF
- [ ] Email notifications
- [ ] Role-based access control
- [ ] Audit logging
- [ ] REST API development

## ⚠️ Troubleshooting

### Common Issues:

1. **Database Connection Error**
   - Verify MySQL is running
   - Check database credentials
   - Ensure database exists

2. **Login Issues**
   - Clear browser cookies
   - Check session configuration
   - Verify password hash

3. **Permission Denied**
   - Check file permissions
   - Verify .htaccess configuration
   - Ensure proper session handling

### Debug Mode:
Enable debugging in `config/database.php`:
```php
// Add this for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
```

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [Bootstrap](https://getbootstrap.com/) for the CSS framework
- [Unsplash](https://unsplash.com/) for beautiful images
- [PDO](https://www.php.net/manual/en/book.pdo.php) for database operations
- [Font Awesome](https://fontawesome.com/) for icons (via Bootstrap Icons)

## 📞 Support

For support, email: support@example.com or create an issue in the GitHub repository.

---

<div align="center">
  Made with ❤️ by David
  <br>
  <sub>If you find this project helpful, please give it a ⭐!</sub>
</div>
