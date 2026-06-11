# BreezeBite

# BreezeBite- QR Menu System

## Group Information
**Group Name:** Broccoli
**Section:** 2

**Group Members :**
- Nur Afifah binti Mohamad Tahir - 2418240
- Nik Siti Nur Aisyah binti Nik Farizu - 2411436
- Nur Nasuha binti Abdul Aziz - 2411188
- Nur Najihah binti Mohd Asri - 2418718
- Nur Aisyah Safia binti Muhammad Asmavi - 2419864


## Project Overview
BreezeBite is an advanced web-based QR menu and food ordering system developed using the Laravel MVC framework. The application allows customer to scan a QR code placed at their table to access a digital menu directly from their mobile browser. Customers can place dine-in or takeaway orders, while administrators manage menu items and monitor order status in real time. 

## Project Objectives
- Primary Goal: To develop a QR-based food ordering web application using the Laravel MVC architecture
- Technical Goal: Implement Laravel MVC architecture with full CRUD operations
- User Experience Goal: To reduce customers waiting time and improve ordering efficiency
- Business Goal: To provide administrators with an efficient system to manage menu items and cutomers orders

## Target Users
- Customers: Individuals who scan the QR code to browse the digital menu and place orders
- Administrators: Restaurant staff who manage the menu and process incoming orders

## Features and Functionalities
**Customer Features**
- QR Code Access: ScanQR code at table to open digital menu via mobile browser
- Order Type Selection: Choose between DIne-in or Takeaway
- Table Number Selectio: Self-select table number from the system
- Category Filter: Browse menu items by food category(e.g., rice, drinks , snacks)
- Menu Browsing: View item name, description, price and image for each food item
- Shopping Cart: Add/remove items and adjust quantities before placing order
- Order Placement: Submit order with on-screen confirmation

**Admin Features**
- Admin Login: Secure authentication to access the dashboard
- View Orders: View all customer orders with full details in real time
- Update Order Status: Change status to Pending, Preparing or Completed
-Menu Management: Full CRUD such as add, edit and delete menu items with images and availability status.

## Technical Implementation
**Technology Stack**
- Backend Framework: Laravel(PHP)
- Frontend: Blade Templates, HTML, CSS
- Database: MySQL
- Authentication: Laravel Breeze
- Development Environment: XAMPP
- Image Storage: Laravel File Storage
- Version Control: GitHub

**Database Design**

Our database consists of 5 main tables designed to handle users, categories, menu items, order ad order items.
Core Tables:
- users: Stores admin credentials and authentication data
- categories: Stores food categories for menu items
- menu_items: Stores food items details (name, description, price, image, availability)
- order: Stores customer order records (order type, table number, total)
- order_items: Stores the specific items within each order

### Entity Relationship Diagram (ERD)
https://docs.google.com/document/d/1Xmu62Rd7DG5DYfYYfhA_1EmN0ug2kn8jc89NFda0Kt0/edit?usp=sharing

**Key reationships:**
- Users can have multiple Orders (One-to-Many)
- Categories can have multiple Menu Items (One-to-Many)
- Menu Items can appear in multiple Order Items (One-to-Many)
- Orders can have multiple Order Items (One-to-Many)
- Menu Items belong to a Category (Many-to-One)
- Orders Items belong to an Order (Many-to-One)

**Laravel Components Implementation**

- Routes (Web.php)
php

**Customer Routes**
    
    Route::get('/welcome', function () {
    return view('customer.welcome');
    })->name('customer.welcome');

    Route::post('/select-table', [CustomerController::class, 'selectTable'])->name('customer.selectTable');

    Route::get('/', [CustomerController::class, 'index'])->name('customer.menu');

    Route::get('/menu', [CustomerController::class, 'index']);

    Route::get('/menu/item/{id}', [CustomerController::class, 'showItem'])->name('customer.showItem');

    Route::get('/cart', [CustomerController::class, 'cart'])->name('customer.cart');
    
    Route::post('/cart/add/{id}', [CustomerController::class, 'addToCart'])->name('customer.cart.add');

    Route::delete('/cart/remove/{id}', [CustomerController::class, 'removeFromCart'])->name('customer.cart.remove');

    Route::get('/cart/confirm', [CustomerController::class, 'confirmOrder'])->name('customer.order.confirm');

    Route::post('/order/place', [CustomerController::class, 'placeOrder'])->name('customer.order.place');

    Route::get('/order/success', [CustomerController::class, 'orderSuccess'])->name('customer.order.success');

**Admin Authentication Routes**

    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');

    Route::post('/admin/login', [AuthController::class, 'login']);

    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

**Protected Admin Routes**

    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    
    Route::get('/orders/{id}/edit', [AdminController::class, 'editOrderStatus'])->name('orders.edit');
    
    Route::put('/orders/{id}/update', [AdminController::class, 'updateOrderStatus'])->name('orders.update');
    
    Route::get('/menu-items', [AdminController::class, 'menuItems'])->name('menu.items');
    
    Route::get('/menu-items/create', [AdminController::class, 'createItem'])->name('menu.create');
    
    Route::post('/menu-items', [AdminController::class, 'storeItem'])->name('menu.store');
    
    Route::delete('/menu-items/{id}', [AdminController::class, 'destroyItem'])->name('menu.destroy');
    
    Route::get('/menu-items/{id}/edit', [AdminController::class, 'editItem'])->name('menu.edit');
    
    Route::put('/menu-items/{id}', [AdminController::class, 'updateItem'])->name('menu.update');

    });

## Controllers

**Main Controllers implemented are below:**
1. AuthController: Handles admin login, authentication and logout
2. AdminController: Manages admin dashboard, menu items CRUD and order status updates
3. CustomerController: Handles customer menu display, cart management and order placement

**Models and Relationships**

    php

**User Model**

    class User extends Authenticatable {
    use HasFactory, Notifiable;
    protected $fillable = [ 'name', 'email','password',];
    protected $hidden = ['password','remember_token',];
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];}
         }

**Item Model (Menu Items)**

    class Item extends Model {

        public function orderItems() {
    
            return $this->hasMany(OrderItem::class);
            }
            
        public function category() {
            return $this->belongsTo(Category::class);
    
            }
        }

**Order Model**

    class Order extends Model {

        public function orderItems() {
    
            return $this->hasMany(OrderItem::class);
    
        }

    }

- Views and User Interface

**Blade Templates Structure:**
- layouts/app.blade.php: Main application layout
- customer/welcome.blade.php: Welcome page for table selection
- customer/menu.blade.php: Customer digital menu page
- customer/item_detail.blade.php: Food item detail page
- customer/cart.blade.php: Shopping cart page
- customer/confirm_order.blade.php: Order confirmation page
- customer/success.blade.php: Order success page
- admin/login.blade.php: Admin login page
- admin/order.blade.php: Admin order management page
- admin/update_status.blade.php: Order status update page
- admin/menu_items.blade.php: Admin menu items listing page
- admin/create_item.blade.php: Add new menu item form
- admin/edit_item.blade.php: Edit existing menu item form

**Design Features**
- Responsive Design: Mobile-first layout
- Color scheme: Red, black and white color
- Navigation: Simple and intuitive structure for fast customer ordering
- Interactive Elements: Category filtering and cart management

## User Authentication System

### Authentication Features
- Admin Login: Secure login using registered credentials via Laravel Breeze
- Session Management: Authenticated sessions to maintain admin access
- Role-Based Access: Only authenticated admins can access the dashboard and management features
- Logout: Secure session termination

### Security Measures
- Password encryption using Laravel's built-in hashing
- CSRF protection on all forms
- input validation and sanitisation
- Middleware protection for all admin routes

## Installation and Setup Instructions
### Prerequisites :
- PHP >= 8.1
- Composer
- Node.js and NPM
- MySQL 8.0
- XAMPP

### Step-by-Step Installation
**1. Clone the Repository**

    bash
    git clone https://github.com/afifah12579/breezebite.git
    cd breezebite

**2. Install Dependencies**

    bash 
    composer install
    npm install

**3. Environment Configuration**

    bash
    cp .env.example .env
    php artisan key:generate

**4. Database Setup**

    bash 
    php artisan migrate
    php artisan db:seed

**5. Start Development Server**

    bash 
    php artisan serve
    npm run dev

## Testing and Quality Assurance

### Functionality Testing
- QR code access to digital menu
- Order type selection (Dine-in/Takeaway)
- Table number selection
- Category-based menu filtering
- Add to cart and order placement
- Order confirmation display
- Admin login and authentication
- Admin order viewing and status update
- Menu item CRUD (Create, Read, Update, Delete)
- Responsive design on mobile devices

### Browser Compatibility
- Google Chrome (Latest)
- Microsoft Edge (Latest)

### Performance Testing
- Page load times under 3 seconds
- Databse queries optimised
- Mobile-optimised for smooth QR scan experience
- Responsive design tested on multiple screen sizes

## Challenges Faced and Solutions
### Challenge 1: QR Code Table Identification
- Problem: Linking each QR code to the correct table number without requiring customer login
- Solution: Encoded the table number directly into the QR code URL
### Challenge 2: Real-time Order Status Updates
- Problem: Admins needed to see new orders and updates statues without constantly refreshing the page
-Solution: Implemented periodic page refresh and clear status indicators on the admin dashboard
### Challenge 3: Mobile-Responsive Menu Display
- Problem: Ensuring the digital menu displays correctly across different customer devices and screen sizes
- Solution: Used mobile-first CSS design and tested across multiple device screen sizes

## Future Enhancements
### Phase 2 Features (Potential Improvements)
- Real-time Notifications: Push or browser notifications for new orders and status changes
- Payment Integration: Online payment options such as FPX or e-wallet
- QR Code Generator: Built-in admin tool to generate and print table QR codes
- Order History: Allow returning customers to vire their past orders
- Sales Analytics: Dashboard reports showing popular items and daily sales
- Mobile App: Native mobile application for iOS and Android

### Scalability Considerations
- Database optimisation for larger datasets
- Cachsing implementation for improved performance
- API development for mobile app integration
- Load balancing for high traffic scenarios

## Learning Outcomes
### Technical Skills Gained
- QR Code Integration: Understanding how to link QR codes to dynamic web routes for a contactless ordering experience
- Laravel MVC: Applying Model-View-Controller architecture in a real food ordering system with proper separation of concerns
- Session Management: Managing cart data and table selection using Laravel sessions without requiring customer login
- Database Relationships: Designing and implementing relational tables for orders, items and categories using ELoquent ORM
- Admin Panel Development: Building a fully functional backend dashboard for managing menu items and order statuses
- Version Control: Collaborating as a team using Git and GitHub to manage code changes across multiple members

### Soft Skills Developed 
- Team Collaboration: Coordinating tasks and resolving merge conflicts while working on a shared GitHub repository
- Time Management: Balancing coursework deadlines with the development of a complete functional web application
- Problem Solving: Identifying and resolving a real errors such as missing vendor folders, 500 server errors and database misconfigurations
GitHub
GitHub - afifah12579/breezebite
Contribute to afifah12579/breezebite development by creating an account on GitHub.
- Communication: Discussing features requirements and system design decisions effectively among five group members

## Conclusion
BreezeBite successfully demonstrate the implementation of a QR-based food ordering system using the Laravel framework. Through this project, we successfully built a fully functional QR-based food ordering system that allows customers to browse the menu, manage their cart and place orders simply by scanning a QR code at their table without needing to download any app or create an account.

### Key Achievements
- Built a complete contactless ordering flow from QR code scan to order confirmation
- Developed a working admin panel that allows restaurant staff to manage menu items and update order status in real time
- Implemented session-based cart management without requiring customer login, making the ordering experience and resolving fast and fricntionless
- Delivered a mobile-responsive interface optimised for real-world use on customers own smartphones

### Project Impact
BreezeBite demonstrates how a simple web application can meaningfully improve the dining experience for both customers and restaurant operators. For customers, it removes the frustration of waiting for a waiter to take orders. For restaurant staff, it provides a clear and organised system to track and manage incoming orders. Beyond the classroom, this project reflects a practical solution that could realistically be adopted by small and medium food businesses in Malayasia looking to modernise their operation. 
- Project Completion Date: 10/6/2026
- Course: BIIT 2305 Web Application Development

## References
1. Laravel Documentation. (2026). The PHP Framework for Web Artisans. Retrieved from https://laravel.com/docs
2. Figma. (n.d.). Web Project [Design mock-up]. Figma. Retrieved from https://www.figma.com/design/qd3hNKGgPipwVlCrQTY1O0/Web-Project
3. OddMenu. (2026). Oddmenu.com. Retrieved from https://oddmenu.com/p/demo
4. MySQL Documentation. (2024). MySQL 8.0 Reference Manual. Retrieved from https://dev.mysql.com/doc/refman/8.0/en/
